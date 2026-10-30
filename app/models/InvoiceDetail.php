<?php

class InvoiceDetail {
    private $id;
    private $invoice_id;
    private $drink_name;
    private $price;
    private $quantity;
    private $total_price;

    public function __construct($id, $invoice_id, $drink_name, $price, $quantity, $total_price) {
        $this->id = $id;
        $this->invoice_id = $invoice_id;
        $this->drink_name = $drink_name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->total_price = $total_price;
    }

    public function getId() {
        return $this->id;
    }

    public function getInvoiceId() {
        return $this->invoice_id;
    }

    public function getDrinkName() {
        return $this->drink_name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }
}
?>

