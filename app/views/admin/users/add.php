<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản nhân viên - QLTDCafe Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <!-- Admin Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-cafe mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="?controller=admin&action=index">
                <i class="bi bi-cup-hot-fill text-warning me-2"></i>QLTDCafe Admin
            </a>
            <div class="ms-auto text-white">
                <a href="?controller=user&action=staffList" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5" style="max-width: 580px;">
        <div class="card card-cafe">
            <div class="card-cafe-header">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-person-plus-fill me-2"></i>Tạo tài khoản mới
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if (isset($error) && $error != ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form action="?controller=user&action=storeStaff" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="username"
                                   name="username"
                                   placeholder="Nhập tên đăng nhập"
                                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                                   required
                                   maxlength="50"
                                   autocomplete="off">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">Vai trò</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                            <select class="form-select" id="role" name="role">
                                <option value="staff" selected>Nhân viên (staff)</option>
                                <option value="admin">Quản trị viên (admin)</option>
                            </select>
                        </div>
                        <small class="text-muted">Mặc định tài khoản được cấp quyền Nhân viên.</small>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Mật khẩu khởi tạo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password"
                                   class="form-control"
                                   id="password"
                                   name="password"
                                   placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)"
                                   required
                                   minlength="8">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="confirm_password" class="form-label fw-semibold">Xác nhận lại mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="password"
                                   class="form-control"
                                   id="confirm_password"
                                   name="confirm_password"
                                   placeholder="Nhập lại mật khẩu"
                                   required
                                   minlength="8">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="?controller=user&action=staffList" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-cafe px-4">
                            <i class="bi bi-check-circle-fill me-1"></i> Tạo tài khoản
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
