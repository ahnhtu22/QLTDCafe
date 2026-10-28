<?php

class User
{
    private $id;
    private $username;
    private $password;
    private $role;

    // Khởi tạo đối tượng User
    public function __construct($id = null, $username = '', $password = '', $role = 'staff')
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    // Lấy mã người dùng
    public function getId()
    {
        return $this->id;
    }

    // Cập nhật mã người dùng
    public function setId($id)
    {
        $this->id = $id;
    }

    // Lấy tên đăng nhập
    public function getUsername()
    {
        return $this->username;
    }

    // Cập nhật tên đăng nhập
    public function setUsername($username)
    {
        $this->username = $username;
    }

    // Lấy mật khẩu
    public function getPassword()
    {
        return $this->password;
    }

    // Cập nhật mật khẩu
    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Lấy vai trò người dùng
    public function getRole()
    {
        return $this->role;
    }

    // Cập nhật vai trò người dùng
    public function setRole($role)
    {
        $this->role = $role;
    }
}
