<?php
require_once APP_ROOT . '/app/models/Invoice.php';
require_once APP_ROOT . '/app/models/Drink.php';
require_once APP_ROOT . '/app/libs/DbConnection.php';

class InvoiceService {

    private function getDbConnection() {
        $db = new DbConnection();
        return $db->getConnection();
    }

    // Lay danh sach do uong con ban
    public function getAllDrinks() {
        $conn = $this->getDbConnection();

        if (!$conn) {
            return [];
        }

        $sql = "SELECT * FROM drinks";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $drinks = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $drinks[] = new Drink(
                $row['id'],
                $row['category_id'],
                $row['name'],
                $row['price'],
                $row['status'],
                $row['image_url'],
                $row['description']
            );
        }

        return $drinks;
    }

    // Tim do uong theo ten, khong phan biet chu hoa chu thuong
    public function getDrinkByName($drink_name) {
        $conn = $this->getDbConnection();

        if (!$conn) {
            return null;
        }

        $sql = "SELECT * FROM drinks
                WHERE LOWER(TRIM(name)) = LOWER(TRIM(:name))
                AND status = 'Còn món'
                LIMIT 1";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $drink_name]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Drink(
            $row['id'],
            $row['category_id'],
            $row['name'],
            $row['price'],
            $row['status'],
            $row['image_url'],
            $row['description']
        );
    }

    // Luu hoa don sau khi xac nhan thanh toan
    public function addInvoice(
        $staff_name,
        $drink_name,
        $quantity,
        $total_price,
     
    ) {
        $conn = $this->getDbConnection();

        if (!$conn) {
            return false;
        }

        $sql = "INSERT INTO invoices
                (staff_name, drink_name, quantity, total_price)
                VALUES
                (:staff_name, :drink_name, :quantity, :total_price)";

        $stmt = $conn->prepare($sql);

        $result = $stmt->execute([
            'staff_name' => $staff_name,
            'drink_name' => $drink_name,
            'quantity' => $quantity,
            'total_price' => $total_price,
           
        ]);

        if ($result) {
            return $conn->lastInsertId();
        }

        return false;
    }

    // Lay hoa don theo ma
    public function getInvoiceById($id) {
        $conn = $this->getDbConnection();

        if (!$conn) {
            return null;
        }

        $sql = "SELECT * FROM invoices WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Invoice(
            $row['id'],
            $row['staff_name'],
            $row['drink_name'],
            $row['quantity'],
            $row['total_price'],
            $row['created_at'],
           
        );
    }
}
?>