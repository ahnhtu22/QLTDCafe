<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản nhân viên - QLTDCafe</title>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=admin&action=index">
                            <i class="bi bi-cup-straw me-1"></i> Quản lý Đồ uống
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=category&action=index">
                            <i class="bi bi-tags-fill me-1"></i> Quản lý Loại đồ uống
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="?controller=user&action=staffList">
                            <i class="bi bi-people-fill me-1"></i> Quản lý Nhân viên
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center text-white">
                    <span class="me-3">
                        <i class="bi bi-person-circle me-1"></i>
                        <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?> (<?= htmlspecialchars($_SESSION['role'] ?? 'admin') ?>)
                    </span>
                    <a href="?controller=user&action=logout" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="title-cafe mb-0">
                <i class="bi bi-people me-2"></i>Danh sách tài khoản hệ thống
            </h3>
            <a href="?controller=user&action=createStaff" class="btn btn-cafe">
                <i class="bi bi-person-plus-fill me-1"></i> Thêm tài khoản mới
            </a>
        </div>

        <div class="card card-cafe">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0 table-cafe">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Tên đăng nhập</th>
                            <th>Vai trò (Role)</th>
                            <th class="text-center" style="width: 150px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="fw-bold"><?= $user->getId() ?></td>
                                    <td>
                                        <i class="bi bi-person me-1 text-muted"></i>
                                        <span class="fw-semibold" style="color: #4a2e1b;"><?= htmlspecialchars($user->getUsername()) ?></span>
                                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user->getId()): ?>
                                            <span class="badge bg-secondary ms-1">Bạn</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($user->getRole() === 'admin'): ?>
                                            <span class="badge" style="background-color: #6f4e37;">Quản trị viên (admin)</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Nhân viên (staff)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user->getId()): ?>
                                            <button class="btn btn-secondary btn-sm" disabled title="Không thể tự xóa chính mình">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        <?php else: ?>
                                            <a href="?controller=user&action=deleteStaff&id=<?= $user->getId() ?>"
                                               class="btn btn-delete-cafe btn-sm"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');"
                                               title="Xóa tài khoản">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Chưa có tài khoản nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
