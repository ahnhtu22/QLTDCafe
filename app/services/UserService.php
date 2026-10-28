<?php

//require_once APP_ROOT.'/app/libs/DBConnection.php'; // Vì đã gọi trong Index
require_once APP_ROOT . '/app/models/User.php';

class UserService {

    public function getAllUsers() {
        $users = [];
        $dbConnection = new DbConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM users";
                $stmt = $conn->query($sql);

                while ($row = $stmt->fetch()) {
                    $user = new User(
                        $row['id'],
                        $row['username'],
                        $row['password'],
                        $row['role']
                    );

                    $users[] = $user;
                }

                return $users;
            }
        }
        return [];
    }

    public function addUser(User $user) {
        $dbConnection = new DbConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $username = $user->getUsername();
                $password = $user->getPassword();
                $role = $user->getRole();

                $sql = "INSERT INTO users (username, password, role)
                        VALUES ('$username', '$password', '$role')";

                $conn->exec($sql);
            }
        }
    }

    public function getUserById($id) {
        $dbConnection = new DbConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM `users` WHERE `id` = '$id'";
                $stmt = $conn->query($sql);

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();

                    $user = new User(
                        $row['id'],
                        $row['username'],
                        $row['password'],
                        $row['role']
                    );

                    return $user;
                }
            }
        }

        return null;
    }

    public function getUserByUsername($username) {
        $dbConnection = new DbConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $stmt = $conn->query($sql);

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();

                    $user = new User(
                        $row['id'],
                        $row['username'],
                        $row['password'],
                        $row['role']
                    );

                    return $user;
                }
            }
        }

        return null;
    }

    public function updateUser(User $user) {
        $dbConnection = new DbConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $id = $user->getId();
                $username = $user->getUsername();
                $password = $user->getPassword();
                $role = $user->getRole();

                $sql = "UPDATE users
                        SET username = '$username',
                            password = '$password',
                            role = '$role'
                        WHERE id = '$id'";

                $conn->exec($sql);
            }
        }
    }

    public function login($username, $password) {
        $user = $this->getUserByUsername($username);

        // Sử dụng password_verify để khớp với mật khẩu đã mã hóa lúc đăng ký
        if ($user != null && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }
}