<?php

require_once APP_ROOT . '/app/services/InvoiceService.php';

class PosController
{
    // Hiển thị trang bán hàng (Có hỗ trợ tìm kiếm và hiển thị trạng thái Còn/Hết món)
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
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
            // Mặc định chọn món đầu tiên nếu có
            $currentDrink = $drinks[0];
            $selected_drink = $currentDrink->getName();
        }

        include APP_ROOT . '/app/views/staff/pos/main.php';
    }

    // Thanh toán đơn hàng
    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        // Lấy dữ liệu từ form
        $drink_name_input = trim($_POST['drink_name'] ?? '');
        $quantity = (int) ($_POST['quantity'] ?? 0);
        $note = trim($_POST['note'] ?? '');

        // Kiểm tra tên đồ uống
        if ($drink_name_input === '') {
            echo 'Vui lòng chọn hoặc nhập tên đồ uống.';
            return;
        }

        // Kiểm tra số lượng
        if ($quantity <= 0) {
            echo 'Số lượng phải lớn hơn 0.';
            return;
        }

        $invoiceService = new InvoiceService();

        // Tìm đồ uống theo tên đã chọn/nhập
        $selectedDrink = $invoiceService->getDrinkByName($drink_name_input);

        if ($selectedDrink === null) {
            echo 'Không tìm thấy đồ uống trong hệ thống. Vui lòng kiểm tra lại.';
            return;
        }

        // Kiểm tra trạng thái món còn hay hết
        if (!$selectedDrink->isAvailable()) {
            echo 'Món "' . htmlspecialchars($selectedDrink->getName()) . '" hiện đang HẾT MÓN, không thể thanh toán đơn hàng này!';
            return;
        }

        // Tính tiền
        $drink_name = $selectedDrink->getName();
        $price = $selectedDrink->getPrice();
        $total_price = $price * $quantity;
        $staff_name = $_SESSION['username'] ?? 'Nhân viên';

        // Lưu hóa đơn vào database
        $invoice_id = $invoiceService->addInvoice(
            $staff_name,
            $drink_name,
            $quantity,
            $total_price
        );

        if ($invoice_id === false) {
            echo 'Không thể lưu hóa đơn. Vui lòng kiểm tra câu lệnh INSERT trong InvoiceService.php.';
            return;
        }

        // Lấy hóa đơn vừa tạo
        $invoice = $invoiceService->getInvoiceById($invoice_id);

        if ($invoice === null) {
            echo 'Đã lưu hóa đơn nhưng không tìm thấy thông tin hóa đơn.';
            return;
        }

        // Hiển thị hóa đơn và ghi chú của đơn hiện tại
        include APP_ROOT . '/app/views/staff/pos/invoice.php';
    }
}
?>
