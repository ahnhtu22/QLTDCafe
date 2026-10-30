
<?php

//các thuộc tinhhs của hóa đơn
class Invoice {
    private $id;
    private $staff_name;
    private $drink_name;
    private $quantity;
    private $total_price;
    private $created_at;

    //khởi tạo thông tin hóa đơn
    public function __construct($id, $staff_name, $drink_name, $quantity, $total_price, $created_at) {
        $this->id = $id;
        $this->staff_name = $staff_name;
        $this->drink_name = $drink_name;
        $this->quantity = $quantity;
        $this->total_price = $total_price;
        $this->created_at = $created_at;
    }

    //lấy mã hóa đơn
    public function getId() {
        return $this->id;
    }

    //lấy tên nhân viên
    public function getStaffName() {
        return $this->staff_name;
    }

    //lấy tên đồ uống
    public function getDrinkName() {
        return $this->drink_name;
    }

    //lấy số lượng
    public function getQuantity() {
        return $this->quantity;
    }

    //lấy tổng tiền
    public function getTotalPrice() {
        return $this->total_price;
    }

    //lấy thời gian tạo hóa đơn
    public function getCreatedAt() {
        return $this->created_at;
    }
}
?>
