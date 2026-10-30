<?php

class HomeController
{
    // Hiển thị trang chủ
    public function index()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        /*if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=user&action=login');
            exit();
        }*/

        // Hiển thị giao diện trang chủ
        require APP_ROOT . '/app/views/home/index.php';
    }
}
