<?php

require_once APP_ROOT . '/app/services/InvoiceService.php';

class PosController
{
    // Hiển thị trang bán hàng
    public function index()
    {
        $invoiceService = new InvoiceService();

        $drinks = $invoiceService->getAllDrinks();

        include APP_ROOT . '/app/views/staff/pos/main.php';
    }

    // Thanh toán đơn hàng
    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        // Lấy dữ liệu từ form
        $drink_name_input = trim($_POST['drink_name'] ?? '');
        $quantity = (int) ($_POST['quantity'] ?? 0);
        $note = trim($_POST['note'] ?? '');

        // Kiểm tra tên đồ uống
        if ($drink_name_input === '') {
            echo 'Vui lòng nhập tên đồ uống';
            return;
        }

        // Kiểm tra số lượng
        if ($quantity <= 0) {
            echo 'Số lượng phải lớn hơn 0';
            return;
        }

        $invoiceService = new InvoiceService();

        // Tìm đồ uống theo tên đã nhập
        $selectedDrink = $invoiceService->getDrinkByName($drink_name_input);

        if ($selectedDrink === null) {
            echo 'Không tìm thấy đồ uống hoặc món đã hết. Vui lòng kiểm tra lại tên đồ uống và trạng thái món.';
            return;
        }

        // Tính tiền
        $drink_name = $selectedDrink->getName();
        $price = $selectedDrink->getPrice();
        $total_price = $price * $quantity;
        $staff_name = 'Nhân viên';

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
