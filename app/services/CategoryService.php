<?php
//require_once APP_ROOT.'/app/libs/DBConnection.php'; //vì đã gọi trong Index
require_once APP_ROOT.'/app/models/Category.php';

class CategoryService{
    public function getAllCategories(){
        $categories = [];
        $dbConnection = new DBConnection();

        if($dbConnection != null){
            //echo 'dbConnection NOT null';
            $conn = $dbConnection->getConnection();

            if($conn != null){
                $sql = "SELECT * FROM categories";
                $stml = $conn->query($sql);

                while($row = $stml->fetch()){
                    $category = new Category($row['id'], $row['name'], $row['description']);
                    $categories[] = $category;
                }
                //echo '\nload data success';

                return $categories;
            }
        }
    }

    public function addCategory(Category $category){
        $dbConnection = new DBConnection();

        if($dbConnection != null){
            $conn = $dbConnection->getConnection();

            if($conn != null) {
                $name = $category->getName();
                $description = $category->getDescription();
                $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')"; // csdl

                $conn->exec($sql);
            }
        }
    }

    public function getCategoryById($id)
    {
        $dbConnection = new DBConnection();

        if($dbConnection != null){
            $conn = $dbConnection->getConnection();

            if($conn != null){
                $sql = "SELECT * FROM categories WHERE id ='$id'";
                $stmt = $conn->query($sql);
                if($stmt->rowCount() > 0){
                    $row = $stmt->fetch();
                    $category = new Category($row['id'], $row['name'], $row['description']);
                    return $category;
                }
            }
        }
    }

    public function updateCategory(Category $category)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null){
            $conn = $dbConnection->getConnection();

            if ($conn != null){
                $id = $category->getId();
                $name = $category->getName();
                $description = $category->getDescription();
                $sql = "UPDATE categories SET name = '$name', description='$description' WHERE id = '$id'";
                $conn->exec($sql);
            }
        }
    }

    public function deleteCategory(Category $category)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null){
            $conn = $dbConnection->getConnection();

            if ($conn != null){
                $id = $category->getId();
                $name = $category->getName();
                $description = $category->getDescription();
                $sql = "DELETE FROM categories WHERE id = '$id'";
                $conn->exec($sql);
            }
        }
    }

    

}

?>