<?php
define('APP_ROOT', dirname(__FILE__,3));
define('DOMAIN', 'http://localhost/PHPMVCQLTDCafe');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'qltdcafe');

/* 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'staff'
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE drinks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,0) NOT NULL,
    status VARCHAR(20) DEFAULT 'Còn món',
    image_url VARCHAR(255) DEFAULT 'https://placehold.co/400x300/198754/ffffff?text=Cafe',
    description TEXT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_name VARCHAR(50) NOT NULL,
    drink_name VARCHAR(150) NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,0) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, role) VALUES 
('admin', 'nhom7@admin', 'admin'),
('nhanvien', 'nhom7@staff', 'staff');

INSERT INTO categories (name, description) VALUES ('Cà Phê', 'Cà phê máy và phin'), ('Nước ép hoa quả', 'Nước ép hoa quả các loại');
INSERT INTO drinks (category_id, name, price, status, description) VALUES (1, 'Cà Phê Sữa Đá', 30000, 'Còn món', 'Cà phê đậm đà sữa đặc');
*/
?>
