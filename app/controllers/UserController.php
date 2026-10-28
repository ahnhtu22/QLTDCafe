<?php

require_once APP_ROOT . '/app/services/UserService.php';

class UserController
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        include_once APP_ROOT . '/app/views/user/login.php';
    }

    // Kiểm tra thông tin đăng nhập
    public function authenticate()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userService = new UserService();
        $user = $userService->login($username, $password);

        if ($user != null) {
            session_start();

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['role'] = $user->getRole();

            if ($user->getRole() == 'admin') {
                header('Location: ?controller=home');
            } else {
                header('Location: ?controller=home');
            }

            exit();
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
            include APP_ROOT . '/app/views/user/login.php';
        }
    }

    // Hiển thị trang đăng ký
    public function register()
    {
        include_once APP_ROOT . '/app/views/user/register.php';
    }

    // Xử lý đăng ký tài khoản
    public function store()
    {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if ($username == '' || $password == '') {
            $error = 'Vui lòng nhập đầy đủ thông tin!';
            include APP_ROOT . '/app/views/user/register.php';
            return;
        }

        $userService = new UserService();

        $user = $userService->getUserByUsername($username);

        if ($user != null) {
            $error = 'Tên đăng nhập đã tồn tại!';
            include APP_ROOT . '/app/views/user/register.php';
            return;
        }

        $newUser = new User(null, $username, password_hash($password, PASSWORD_DEFAULT), 'staff');

        $userService->addUser($newUser);

        header('Location: ?controller=user&action=login');
        exit();
    }

    // Đăng xuất
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: ?controller=user&action=login');
        exit();
    }
}