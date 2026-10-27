<?php
require_once ('../app/config/config.php');
require_once APP_ROOT.'/app/libs/DbConnection.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

if ($controller == 'user') {
    require_once APP_ROOT.'/app/controllers/UserController.php';
    $userController = new UserController();

    if ($action == 'login') {
        $userController->login();
    } 
    else if ($action == 'register') {
        $userController->register();
    } 
    else if ($action == 'logout') {
        $userController->logout();
    } 
    else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'category') {
    require_once APP_ROOT.'/app/controllers/CategoryController.php';
    $categoryController = new CategoryController();

    if ($action == 'index') {
        $categoryController->index();
    } 
    else if ($action == 'add') {
        $categoryController->add();
    } 
    else if ($action == 'edit') {
        $categoryController->edit();
    } 
    else if ($action == 'delete') {
        $categoryController->delete();
    } 
    else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'admin') {
    require_once APP_ROOT.'/app/controllers/AdminController.php';
    $adminController = new AdminController();

    if ($action == 'index') {
        $adminController->index();
    } 
    else if ($action == 'addDrink') {
        $adminController->addDrink();
    } 
    else if ($action == 'editDrink') {
        $adminController->editDrink();
    } 
    else if ($action == 'deleteDrink') {
        $adminController->deleteDrink();
    } 
    else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'pos') {
    require_once APP_ROOT.'/app/controllers/PosController.php';
    $posController = new PosController();

    if ($action == 'index') {
        $posController->index();
    } 
    else if ($action == 'checkout') {
        $posController->checkout();
    } 
    else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'home') {
    require_once APP_ROOT.'/app/controllers/HomeController.php';
    $homeController = new HomeController();
    
    if ($action == 'index') {
        $homeController->index();
    } else {
        echo 'Action không tồn tại!';
    }

} else {
    echo 'Trang không tồn tại!';
}
?>