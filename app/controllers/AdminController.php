
<?php
    require_once APP_ROOT.'/app/models/Drink.php';
    require_once APP_ROOT.'/app/services/DrinkService.php';
    require_once APP_ROOT.'/app/services/CategoryService.php';

    class AdminController{

        // Hien thi danh sach do uong
        public function index(){
            $drinkService = new DrinkService();
            $drinks = $drinkService->getAllDrinks();

            include APP_ROOT.'/app/views/admin/drinks/index.php';
        }

        // Hien thi form them do uong
        public function add(){
            $categoryService = new CategoryService();
            $categories = $categoryService->getAllCategories();

            include_once APP_ROOT.'/app/views/admin/drinks/add.php';
        }

        // Xu ly them do uong
        public function store(){
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $image_url = $_POST['image_url'];
            $description = $_POST['description'];

            $drink = new Drink(
                null,
                $category_id,
                $name,
                $price,
                $status,
                $image_url,
                $description
            );

            $drinkService = new DrinkService();
            $drinkService->addDrink($drink);

            header('Location: ?controller=admin&action=index');
            exit();
        }

        // Hien thi form sua do uong
        public function edit($id){
            if(isset($id)){
                $drinkService = new DrinkService();
                $drink = $drinkService->getDrinkById($id);

                $categoryService = new CategoryService();
                $categories = $categoryService->getAllCategories();

                include APP_ROOT.'/app/views/admin/drinks/edit.php';
            }else{
                echo 'Id is null';
            }
        }

        // Xu ly cap nhat do uong
        public function update($id){
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $image_url = $_POST['image_url'];
            $description = $_POST['description'];

            $drink_new = new Drink(
                $id,
                $category_id,
                $name,
                $price,
                $status,
                $image_url,
                $description
            );

            $drinkService = new DrinkService();
            $drinkService->updateDrink($drink_new);

            header('Location: ?controller=admin&action=index');
            exit();
        }

        // Hien thi trang xac nhan xoa
        public function destroy($id){
            $drinkService = new DrinkService();
            $drink = $drinkService->getDrinkById($id);

            include APP_ROOT.'/app/views/admin/drinks/delete.php';
        }

        // Xu ly xoa do uong
        public function delete($id){
            $drinkService = new DrinkService();
            $drinkService->deleteDrink($id);

            header('Location: ?controller=admin&action=index');
            exit();
        }
    }
?>
