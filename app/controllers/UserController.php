<?php

require_once APP_ROOT . '/app/services/UserService.php';

class UserController
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        include_once APP_ROOT . '/app/views/home/login.php';
    }

    // Kiểm tra thông tin đăng nhập
    public function authenticate()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userService = new UserService();
        $user = $userService->login($username, $password);

        if ($user != null) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['role'] = $user->getRole();

            if ($user->getRole() == 'admin') {
                header('Location: ?controller=admin&action=index');
            } else {
                header('Location: ?controller=pos&action=index');
            }

            exit();
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
            include APP_ROOT . '/app/views/home/login.php';
        }
    }

    // Hiển thị trang đăng ký
    public function register()
    {
        include_once APP_ROOT . '/app/views/home/register.php';
    }

    // Xử lý đăng ký tài khoản
    public function store()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $role = ($_POST['role'] ?? 'staff') === 'admin' ? 'admin' : 'staff';

        if ($username == '' || $password == '') {
            $error = 'Vui lòng nhập đầy đủ thông tin!';
            include APP_ROOT . '/app/views/home/register.php';
            return;
        }

        if ($password !== $confirm_password) {
            $error = 'Mật khẩu nhập lại không khớp!';
            include APP_ROOT . '/app/views/home/register.php';
            return;
        }

        $userService = new UserService();

        $user = $userService->getUserByUsername($username);

        if ($user != null) {
            $error = 'Tên đăng nhập đã tồn tại!';
            include APP_ROOT . '/app/views/home/register.php';
            return;
        }

        $newUser = new User(null, $username, password_hash($password, PASSWORD_DEFAULT), $role);
        $userService->addUser($newUser);

        header('Location: ?controller=user&action=login');
        exit();
    }

    // Quản lý danh sách nhân viên (Dành riêng cho Admin)
    public function staffList()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: ?controller=user&action=login');
            exit();
        }

        $userService = new UserService();
        $users = $userService->getAllUsers();

        include APP_ROOT . '/app/views/admin/users/index.php';
    }

    // Hiển thị form tạo tài khoản nhân viên (Dành riêng cho Admin)
    public function createStaff()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: ?controller=user&action=login');
            exit();
        }

        include APP_ROOT . '/app/views/admin/users/add.php';
    }

    // Xử lý lưu tài khoản nhân viên do Admin tạo
    public function storeStaff()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: ?controller=user&action=login');
            exit();
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $role = ($_POST['role'] ?? 'staff') === 'admin' ? 'admin' : 'staff';

        if ($username == '' || $password == '') {
            $error = 'Vui lòng nhập đầy đủ thông tin!';
            include APP_ROOT . '/app/views/admin/users/add.php';
            return;
        }

        if ($password !== $confirm_password) {
            $error = 'Mật khẩu nhập lại không khớp!';
            include APP_ROOT . '/app/views/admin/users/add.php';
            return;
        }

        $userService = new UserService();
        if ($userService->getUserByUsername($username) !== null) {
            $error = 'Tên đăng nhập đã tồn tại!';
            include APP_ROOT . '/app/views/admin/users/add.php';
            return;
        }

        $newUser = new User(null, $username, password_hash($password, PASSWORD_DEFAULT), $role);
        $userService->addUser($newUser);

        header('Location: ?controller=user&action=staffList');
        exit();
    }

    // Xóa tài khoản nhân viên (Dành riêng cho Admin)
    public function deleteStaff($id)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: ?controller=user&action=login');
            exit();
        }

        if (!empty($id)) {
            // Không cho phép Admin tự xóa chính tài khoản mình đang đăng nhập
            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
                // Không xóa chính mình
            } else {
                $userService = new UserService();
                $userService->deleteUser($id);
            }
        }

        header('Location: ?controller=user&action=staffList');
        exit();
    }

    // Đăng xuất
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();

        header('Location: ?controller=user&action=login');
        exit();
    }
}
