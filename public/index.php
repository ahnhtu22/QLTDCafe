<?php
require_once __DIR__ . '/../app/config/config.php';
require_once APP_ROOT . '/app/libs/DbConnection.php';

// Đặt mặc định vào thẳng trang chủ
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

if ($controller == 'user') {
    require_once APP_ROOT . '/app/controllers/UserController.php';
    $userController = new UserController();

    if ($action == 'login') {
        $userController->login();
    } else if ($action == 'authenticate') {
        $userController->authenticate();
    } else if ($action == 'register') {
        $userController->register();
    } else if ($action == 'store') {
        $userController->store();
    } else if ($action == 'logout') {
        $userController->logout();
    } else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'category') {
    require_once APP_ROOT . '/app/controllers/CategoryController.php';
    $categoryController = new CategoryController();

    if ($action == 'index') {
        $categoryController->index();
    } else if ($action == 'add') {
        $categoryController->add();
    } else if ($action == 'edit') {
        $categoryController->edit();
    } else if ($action == 'delete') {
        $categoryController->delete();
    } else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'admin') {
    require_once APP_ROOT . '/app/controllers/AdminController.php';
    $adminController = new AdminController();

    if ($action == 'index') {
        $adminController->index();
    } else if ($action == 'addDrink') {
        $adminController->addDrink();
    } else if ($action == 'editDrink') {
        $adminController->editDrink();
    } else if ($action == 'deleteDrink') {
        $adminController->deleteDrink();
    } else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'pos') {
    require_once APP_ROOT . '/app/controllers/PosController.php';
    $posController = new PosController();

    if ($action == 'index') {
        $posController->index();
    } else if ($action == 'checkout') {
        $posController->checkout();
    } else {
        echo 'Action không tồn tại!';
    }

} else if ($controller == 'home') {
    require_once APP_ROOT . '/app/controllers/HomeController.php';
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