<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng ký tài khoản - QLTDCafe</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- CSS riêng -->
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <div class="register-container">

        <div class="logo">
            <i class="bi bi-cup-hot-fill"></i>
        </div>

        <h3 class="register-title">ĐĂNG KÝ TÀI KHOẢN</h3>

        <p class="register-description">
            Tạo tài khoản để sử dụng hệ thống quản lý quán cà phê
        </p>

        <?php if (isset($error) && $error != ''): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success) && $success != ''): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form action="?controller=user&action=store" method="POST">

            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>

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
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                        required
                        maxlength="50"
                        autocomplete="username"
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>

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
                        required
                        minlength="8"
                        autocomplete="new-password"
                    >
                </div>

                <small class="text-muted">
                    Mật khẩu phải có ít nhất 8 ký tự.
                </small>
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="form-label">
                    Nhập lại mật khẩu
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-shield-lock"></i>
                    </span>

                    <input
                        type="password"
                        class="form-control"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Nhập lại mật khẩu"
                        required
                        minlength="8"
                        autocomplete="new-password"
                    >
                </div>
            </div>

            <button type="submit" name="btn_register" class="btn btn-register">
                <i class="bi bi-person-plus-fill"></i>
                Đăng ký
            </button>

        </form>

        <div class="login-link">
            Đã có tài khoản?
            <a href="?controller=user&action=login">Đăng nhập ngay</a>
        </div>

    </div>
</body>
</html>