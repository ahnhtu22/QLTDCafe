<?php
    require_once APP_ROOT . '/app/services/CategoryService.php';

    class CategoryController
    {
        public function add()
        {
            include_once APP_ROOT . '/app/views/category/add.php';
        }


        public function store()
        {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category = new Category(null, $name, $description);

            $categoryService = new CategoryService();
            $categoryService->addCategory($category);

            header('Location: ?controller=home');
        }

        public function edit($id)
        {
            if(isset($id)){
                $categoryService = new CategoryService();
                $category = $categoryService->getCategoryById($id);

                include APP_ROOT . '/app/views/category/edit.php';

            }else{
                echo 'Id is null';
            }
        }

        public function update($id)
        {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $category_new = new Category($id, $name, $description);
            $categoryService = new CategoryService();
            $categoryService->updateCategory($category_new);
            header('Location: ?controller=home');
        }

        public function delete($id)
        {
            if(isset($id)){
                $categoryService = new CategoryService();
                $category = $categoryService->getCategoryById($id);

                include APP_ROOT . '/app/views/category/delete.php';

            }else{
                echo 'Id is null';
            }
        }

        public function destroy($id){
            $category = new Category($id, null, null);

            $categoryService = new CategoryService();
            $categoryService->deleteCategory($category);
            header('Location: ?controller=home');
        }
    }

?>