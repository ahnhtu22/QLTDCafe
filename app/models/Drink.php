<?php

class Drink {
    private $id;
    private $category_id;
    private $name;
    private $price;
    private $status;
    private $image_url;
    private $description;

    public function __construct($id, $category_id, $name, $price, $status, $image_url, $description) {
        $this->id = $id;
        $this->category_id = $category_id;
        $this->name = $name;
        $this->price = $price;
        $this->status = $status;
        $this->image_url = $image_url;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStatus() {
        return $this->status;
    }

    // Chuyển đổi trạng thái (1, '1', 'Còn món' -> 'Còn món'; ngược lại là 'Hết món')
    public function getStatusText() {
        if ($this->status == '1' || $this->status === 'Còn món') {
            return 'Còn món';
        }
        return 'Hết món';
    }

    // Kiểm tra món còn bán được không
    public function isAvailable() {
        return $this->status == '1' || $this->status === 'Còn món';
    }

    public function getImageUrl() {
        return $this->image_url;
    }

    public function getDescription() {
        return $this->description;
    }
}
