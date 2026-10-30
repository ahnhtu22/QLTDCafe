<?php

require_once APP_ROOT . '/app/services/InvoiceService.php';

class PosController
{
    // Hiển thị trang bán hàng (Có hỗ trợ giỏ hàng nhiều món, tìm kiếm và trạng thái món)
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $invoiceService = new InvoiceService();

        // Nhận từ khóa tìm kiếm và món được chọn từ GET
        $search = trim($_GET['search'] ?? '');
        $selected_drink = trim($_GET['selected_drink'] ?? '');

        // Lọc danh sách đồ uống theo từ khóa tìm kiếm
        if ($search !== '') {
            $drinks = $invoiceService->searchDrinks($search);
        } else {
            $drinks = $invoiceService->getAllDrinks();
        }

        // Lấy thông tin chi tiết món đang chọn để hiển thị trạng thái
        $currentDrink = null;
        if ($selected_drink !== '') {
            $currentDrink = $invoiceService->getDrinkByName($selected_drink);
        } elseif (!empty($drinks)) {
            $currentDrink = $drinks[0];
            $selected_drink = $currentDrink->getName();
        }

        // Tính tổng tiền và số lượng của các món đang có trong giỏ hàng
        $cartItems = $_SESSION['cart'] ?? [];
        $cartTotal = 0;
        $cartQuantity = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
            $cartQuantity += $item['quantity'];
        }

        include APP_ROOT . '/app/views/staff/pos/main.php';
    }

    // Thêm món vào hóa đơn (Session Cart)
    public function addToCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=pos&action=index');
            exit();
        }

        $drink_name_input = trim($_POST['drink_name'] ?? '');
        $quantity = (int)($_POST['quantity'] ?? 1);

        if ($quantity <= 0) {
            $quantity = 1;
        }

        $invoiceService = new InvoiceService();
        $drink = $invoiceService->getDrinkByName($drink_name_input);

        if ($drink === null) {
            header('Location: ?controller=pos&action=index&error=' . urlencode('Không tìm thấy đồ uống!'));
            exit();
        }

        if (!$drink->isAvailable()) {
            header('Location: ?controller=pos&action=index&error=' . urlencode('Món "' . $drink->getName() . '" hiện đang Hết món, không thể chọn!'));
            exit();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $drinkName = $drink->getName();

        // Nếu món đã có trong hóa đơn thì cộng dồn số lượng
        if (isset($_SESSION['cart'][$drinkName])) {
            $_SESSION['cart'][$drinkName]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$drinkName] = [
                'id' => $drink->getId(),
                'name' => $drink->getName(),
                'price' => (float)$drink->getPrice(),
                'quantity' => $quantity
            ];
        }

        header('Location: ?controller=pos&action=index&selected_drink=' . urlencode($drinkName));
        exit();
    }

    // Tăng / Giảm số lượng của món trong giỏ hàng
    public function updateCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $drinkName = trim($_GET['drink_name'] ?? '');
        $change = (int)($_GET['change'] ?? 0);

        if (isset($_SESSION['cart'][$drinkName])) {
            $_SESSION['cart'][$drinkName]['quantity'] += $change;

            // Nếu số lượng về 0 hoặc nhỏ hơn thì xóa khỏi hóa đơn
            if ($_SESSION['cart'][$drinkName]['quantity'] <= 0) {
                unset($_SESSION['cart'][$drinkName]);
            }
        }

        header('Location: ?controller=pos&action=index');
        exit();
    }

    // Xóa một món ra khỏi hóa đơn
    public function removeFromCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $drinkName = trim($_GET['drink_name'] ?? '');

        if (isset($_SESSION['cart'][$drinkName])) {
            unset($_SESSION['cart'][$drinkName]);
        }

        header('Location: ?controller=pos&action=index');
        exit();
    }

    // Hủy toàn bộ đơn hàng đang gọi (Xóa sạch giỏ hàng)
    public function clearCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['cart'] = [];

        header('Location: ?controller=pos&action=index');
        exit();
    }

    // Xác nhận thanh toán toàn bộ đơn hàng nhiều món
    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=pos&action=index');
            exit();
        }

        $cartItems = $_SESSION['cart'] ?? [];

        // Nếu giỏ hàng rỗng, kiểm tra xem người dùng có submit từ form đơn lẻ không
        if (empty($cartItems)) {
            $drink_name_input = trim($_POST['drink_name'] ?? '');
            $quantity = (int)($_POST['quantity'] ?? 1);

            if ($drink_name_input !== '' && $quantity > 0) {
                $invoiceService = new InvoiceService();
                $drink = $invoiceService->getDrinkByName($drink_name_input);
                if ($drink && $drink->isAvailable()) {
                    $cartItems[$drink->getName()] = [
                        'id' => $drink->getId(),
                        'name' => $drink->getName(),
                        'price' => (float)$drink->getPrice(),
                        'quantity' => $quantity
                    ];
                }
            }
        }

        if (empty($cartItems)) {
            header('Location: ?controller=pos&action=index&error=' . urlencode('Đơn hàng chưa có món nào! Vui lòng chọn món trước khi thanh toán.'));
            exit();
        }

        $note = trim($_POST['note'] ?? '');
        $staff_name = $_SESSION['username'] ?? 'Nhân viên';

        // Tính tổng tiền và tổng số lượng
        $total_price = 0;
        $total_quantity = 0;
        foreach ($cartItems as $item) {
            $total_price += $item['price'] * $item['quantity'];
            $total_quantity += $item['quantity'];
        }

        $invoiceService = new InvoiceService();

        // Lưu đơn hàng gồm hóa đơn chính và các dòng chi tiết món
        $invoice_id = $invoiceService->addInvoiceWithDetails(
            $staff_name,
            $cartItems,
            $total_price,
            $total_quantity
        );

        if (!$invoice_id) {
            header('Location: ?controller=pos&action=index&error=' . urlencode('Lỗi: Không thể lưu hóa đơn vào CSDL!'));
            exit();
        }

        // Xóa giỏ hàng sau khi thanh toán thành công
        $_SESSION['cart'] = [];

        // Lấy thông tin hóa đơn và các món chi tiết để hiển thị trang in hóa đơn
        $invoice = $invoiceService->getInvoiceById($invoice_id);
        $invoiceDetails = $invoiceService->getInvoiceDetailsByInvoiceId($invoice_id);

        include APP_ROOT . '/app/views/staff/pos/invoice.php';
    }
}
?>
