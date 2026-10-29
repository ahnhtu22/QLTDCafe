<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Loại đồ uống - QLTDCafe Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <!-- Admin Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
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
                        <a class="nav-link active" href="?controller=category&action=index">
                            <i class="bi bi-tags-fill me-1"></i> Quản lý Loại đồ uống
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=user&action=staffList">
                            <i class="bi bi-people-fill me-1"></i> Quản lý Nhân viên
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center text-white">
                    <span class="me-3">
                        <i class="bi bi-person-circle me-1"></i>
                        <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?>
                    </span>
                    <a href="?controller=user&action=logout" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-dark fw-bold mb-0">
                <i class="bi bi-tags text-success me-2"></i>Danh sách loại đồ uống
            </h3>
            <a href="?controller=category&action=add" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Thêm loại đồ uống mới
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Tên loại đồ uống</th>
                            <th>Mô tả</th>
                            <th class="text-center" style="width: 150px;">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td class="align-middle fw-bold"><?=$category->getId();?></td>
                                    <td class="align-middle fw-semibold"><?=htmlspecialchars($category->getName());?></td>
                                    <td class="align-middle"><?=htmlspecialchars($category->getDescription() ?? '');?></td>
                                    <td class="align-middle text-center">
                                        <a href="?controller=category&action=edit&id=<?= $category->getId() ?>"
                                           class="btn btn-warning btn-sm me-1" title="Sửa">
                                            <i class="bi bi-pencil-square"></i> Sửa
                                        </a>
                                        <a href="?controller=category&action=delete&id=<?= $category->getId() ?>"
                                           class="btn btn-danger btn-sm" title="Xóa">
                                            <i class="bi bi-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Chưa có loại đồ uống nào.</td>
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
