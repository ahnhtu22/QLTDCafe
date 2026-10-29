<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/config/config.php';
require_once APP_ROOT . '/app/libs/DbConnection.php';

// Nhận tham số từ URL / Request
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? $_POST['id'] ?? null;

// ================= USER CONTROLLER =================
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
    } else if ($action == 'staffList') {
        $userController->staffList();
    } else if ($action == 'createStaff') {
        $userController->createStaff();
    } else if ($action == 'storeStaff') {
        $userController->storeStaff();
    } else if ($action == 'deleteStaff') {
        $userController->deleteStaff($id);
    } else {
        echo 'Action không tồn tại!';
    }

// ================= CATEGORY CONTROLLER =================
} else if ($controller == 'category') {
    require_once APP_ROOT . '/app/controllers/CategoryController.php';
    $categoryController = new CategoryController();

    if ($action == 'index') {
        $categoryController->index();
    } else if ($action == 'add') {
        $categoryController->add();
    } else if ($action == 'store') {
        $categoryController->store();
    } else if ($action == 'edit') {
        $categoryController->edit($id);
    } else if ($action == 'update') {
        $categoryController->update($id);
    } else if ($action == 'delete') {
        $categoryController->delete($id);
    } else if ($action == 'destroy') {
        $categoryController->destroy($id);
    } else {
        echo 'Action không tồn tại!';
    }

// ================= ADMIN CONTROLLER (ĐỒ UỐNG) =================
} else if ($controller == 'admin') {
    require_once APP_ROOT . '/app/controllers/AdminController.php';
    $adminController = new AdminController();

    if ($action == 'index') {
        $adminController->index();
    } else if ($action == 'add') {
        $adminController->add();
    } else if ($action == 'store') {
        $adminController->store();
    } else if ($action == 'edit') {
        $adminController->edit($id);
    } else if ($action == 'update') {
        $adminController->update($id);
    } else if ($action == 'destroy') {
        $adminController->destroy($id);
    } else if ($action == 'delete') {
        $adminController->delete($id);
    } else {
        echo 'Action không tồn tại!';
    }

// ================= POS CONTROLLER =================
} else if ($controller == 'pos') {
    require_once APP_ROOT . '/app/controllers/PosController.php';
    if (class_exists('PosController')) {
        $posController = new PosController();
        if ($action == 'index') {
            $posController->index();
        } else if ($action == 'checkout') {
            $posController->checkout();
        } else {
            echo 'Action không tồn tại!';
        }
    } else {
        echo 'Chức năng POS đang được phát triển!';
    }

// ================= HOME CONTROLLER =================
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
