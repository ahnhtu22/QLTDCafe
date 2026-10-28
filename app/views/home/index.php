<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Quản lý Thực đơn Cafe</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #fdfbf7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #6f4e37, #4a2e1b);
            color: white;
            padding: 80px 0;
            border-radius: 0 0 30px 30px;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
        .btn-brown {
            background-color: #6f4e37;
            color: white;
        }
        .btn-brown:hover {
            background-color: #5c4033;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="index.php?controller=home&action=index">
                <i class="fa-solid fa-mug-hot text-warning me-2"></i> QLTDCafe
            </a>
            <div class="ms-auto">
                <a href="index.php?controller=user&action=login" class="btn btn-outline-dark btn-sm me-2">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> Đăng nhập
                </a>
                <a href="index.php?controller=user&action=register" class="btn btn-brown btn-sm">
                    <i class="fa-solid fa-user-plus me-1"></i> Đăng ký
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Quản lý Thực đơn Quán Cafe</h1>
            <p class="lead mb-4">Hệ thống quản lý thực đơn, gọi món và vận hành quán cafe chuyên nghiệp, nhanh chóng.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="index.php?controller=user&action=login" class="btn btn-light btn-lg px-4 fw-semibold text-dark">
                    Bắt đầu ngay <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container my-5 py-4">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card card-custom p-4 h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning fs-1">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <h5 class="fw-bold">Quản lý Thực đơn</h5>
                        <p class="text-muted">Thêm mới, cập nhật và phân loại các món đồ uống, món ăn nhẹ trong quán một cách dễ dàng.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning fs-1">
                            <i class="fa-solid fa-cash-register"></i>
                        </div>
                        <h5 class="fw-bold">Bán hàng / POS</h5>
                        <p class="text-muted">Hỗ trợ nhân viên thao tác gọi món, tính tiền và thanh toán nhanh chóng cho khách hàng.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning fs-1">
                            <i class="fa-solid fa-users-gear"></i>
                        </div>
                        <h5 class="fw-bold">Phân quyền Hệ thống</h5>
                        <p class="text-muted">Quản lý tài khoản Admin, nhân viên phục vụ và bảo mật thông tin đăng nhập an toàn.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted border-top bg-white">
        <div class="container">
            <p class="mb-0">&copy; 2026 QLTDCafe Project. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>