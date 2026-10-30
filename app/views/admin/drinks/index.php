<?php
    /** @var Drink[] $drinks */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đồ uống - QLTDCafe Admin</title>
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
                        <a class="nav-link active" href="?controller=admin&action=index">
                            <i class="bi bi-cup-straw me-1"></i> Quản lý thực đơn
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=category&action=index">
                            <i class="bi bi-tags-fill me-1"></i> Quản lý loại thực đơn
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
                <i class="bi bi-cup-straw me-2"></i>Danh sách sản phẩm
            </h3>
            <a href="?controller=admin&action=add" class="btn btn-cafe">
                <i class="bi bi-plus-circle me-1"></i> Thêm mới sản phẩm
            </a>
        </div>

        <div class="card card-cafe">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0 table-cafe">
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>Mã loại</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th class="text-center" style="width: 150px;">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($drinks)): ?>
                            <?php foreach($drinks as $drink): ?>
                                <tr>
                                    <td class="fw-bold"><?= $drink->getId() ?></td>
                                    <td><?= $drink->getCategoryId() ?></td>
                                    <td class="fw-semibold" style="color: #4a2e1b;"><?= htmlspecialchars($drink->getName()) ?></td>
                                    <td class="fw-bold" style="color: #6f4e37;">
                                        <?= number_format($drink->getPrice(), 0, ',', '.') ?> đ
                                    </td>
                                    <td>
                                        <span class="badge <?= $drink->getStatus() == 'Còn món' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= htmlspecialchars($drink->getStatus()) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($drink->getImageUrl()): ?>
                                            <img src="<?= htmlspecialchars($drink->getImageUrl()) ?>"
                                                 class="rounded border" width="60" height="45" style="object-fit: cover;" alt="Hình đồ uống">
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-muted"><?= htmlspecialchars($drink->getDescription() ?? '') ?></td>
                                    <td class="text-center">
                                        <a href="?controller=admin&action=edit&id=<?= $drink->getId() ?>"
                                           class="btn btn-edit-cafe btn-sm me-1" title="Sửa">
                                            <i class="bi bi-pencil-square"></i> Sửa
                                        </a>

                                        <a href="?controller=admin&action=destroy&id=<?= $drink->getId() ?>"
                                           class="btn btn-delete-cafe btn-sm" title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Chưa có sản phẩm nào.</td>
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
