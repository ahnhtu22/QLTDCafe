<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng nhập - QLTDCafe</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <!-- CSS riêng của trang đăng nhập -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">

        <!-- Logo -->
        <div class="logo">
            <i class="bi bi-cup-hot-fill"></i>
        </div>

        <!-- Tiêu đề -->
        <h2 class="login-title">Quản lý Thực đơn Cafe</h2>

        <p class="login-description">
            Đăng nhập vào hệ thống quản lý quán cà phê
        </p>

        <!-- Thông báo lỗi -->
        <?php if (isset($error) && $error != ''): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Form đăng nhập -->
        <form action="?controller=user&action=authenticate" method="POST">

            <div class="mb-3">
                <label for="username" class="form-label">
                    Tên đăng nhập
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>

                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        placeholder="Nhập tên đăng nhập"
                        autocomplete="username"
                        required
                    >
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">
                    Mật khẩu
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Nhập mật khẩu"
                        autocomplete="current-password"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Đăng nhập
            </button>

        </form>

        <!-- Liên kết đăng ký -->
        <div class="register-link">
            Chưa có tài khoản?
            <a href="?controller=user&action=register">
                Đăng ký ngay
            </a>
        </div>

    </div>

</body>
</html>