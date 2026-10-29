
<?php
    require_once APP_ROOT.'/app/models/Drink.php';

    class DrinkService{

        // 1. Lay tat ca do uong
        public function getAllDrinks(){
            $drinks = [];
            $dbConnection = new DBConnection();

            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "select * from drinks";
                    $stmt = $conn->query($sql);

                    while($row = $stmt->fetch()){
                        $drink = new Drink(
                            $row['id'],
                            $row['category_id'],
                            $row['name'],
                            $row['price'],
                            $row['status'],
                            $row['image_url'],
                            $row['description']
                        );

                        $drinks[] = $drink;
                    }

                    return $drinks;
                }
            }

            return $drinks;
        }

        // 2. Them do uong
        public function addDrink(Drink $drink){
            $dbConnection = new DBConnection();

            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $category_id = $drink->getCategoryId();
                    $name = $drink->getName();
                    $price = $drink->getPrice();
                    $status = $drink->getStatus();
                    $image_url = $drink->getImageUrl();
                    $description = $drink->getDescription();

                    $sql = "insert into drinks
                            (category_id, name, price, status, image_url, description)
                            values
                            (:category_id, :name, :price, :status, :image_url, :description)";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':category_id' => $category_id,
                        ':name' => $name,
                        ':price' => $price,
                        ':status' => $status,
                        ':image_url' => $image_url,
                        ':description' => $description
                    ]);
                }
            }
        }

        // 3. Tim do uong theo ID
        public function getDrinkById($id){
            $dbConnection = new DBConnection();

            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "select * from drinks where id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([':id' => $id]);

                    $row = $stmt->fetch();

                    if($row){
                        $drink = new Drink(
                            $row['id'],
                            $row['category_id'],
                            $row['name'],
                            $row['price'],
                            $row['status'],
                            $row['image_url'],
                            $row['description']
                        );

                        return $drink;
                    }
                }
            }

            return null;
        }

        // 4. Cap nhat do uong
        public function updateDrink(Drink $drink){
            $dbConnection = new DBConnection();

            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $id = $drink->getId();
                    $category_id = $drink->getCategoryId();
                    $name = $drink->getName();
                    $price = $drink->getPrice();
                    $status = $drink->getStatus();
                    $image_url = $drink->getImageUrl();
                    $description = $drink->getDescription();

                    $sql = "update drinks set
                            category_id = :category_id,
                            name = :name,
                            price = :price,
                            status = :status,
                            image_url = :image_url,
                            description = :description
                            where id = :id";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':category_id' => $category_id,
                        ':name' => $name,
                        ':price' => $price,
                        ':status' => $status,
                        ':image_url' => $image_url,
                        ':description' => $description,
                        ':id' => $id
                    ]);
                }
            }
        }

        // 5. Xoa do uong
        public function deleteDrink($id){
            $dbConnection = new DBConnection();

            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "delete from drinks where id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([':id' => $id]);
                }
            }
        }
    }
?>
