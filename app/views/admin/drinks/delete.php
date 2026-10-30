<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa đồ uống - QLTDCafe Admin</title>
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
                <a href="?controller=admin&action=index" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5" style="max-width: 600px;">
        <div class="card card-cafe">
            <div class="card-header bg-danger text-white py-3" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Xác nhận xóa sản phẩm
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if($drink != null): ?>
                    <div class="alert alert-warning">
                        Bạn có chắc chắn muốn xóa sản phẩm này không? Hành động này sẽ không thể khôi phục lại!
                    </div>

                    <div class="bg-light p-3 rounded mb-4 border">
                        <p class="mb-2"><strong>Mã sản phẩm (ID):</strong> <?= $drink->getId() ?></p>
                        <p class="mb-2"><strong>Tên sản phẩm:</strong> <span class="fw-bold" style="color: #6f4e37;"><?= htmlspecialchars($drink->getName()) ?></span></p>
                        <p class="mb-2"><strong>Giá:</strong> <?= number_format($drink->getPrice(), 0, ',', '.') ?> đ</p>
                        <p class="mb-2"><strong>Trạng thái:</strong> <?= htmlspecialchars($drink->getStatus()) ?></p>
                        <?php if($drink->getImageUrl()): ?>
                            <p class="mb-0"><strong>Hình ảnh:</strong><br>
                                <img src="<?= htmlspecialchars($drink->getImageUrl()) ?>" class="rounded border mt-2" width="100" height="75" style="object-fit: cover;" alt="Hình đồ uống">
                            </p>
                        <?php endif; ?>
                    </div>

                    <form action="?controller=admin&action=delete&id=<?= $drink->getId() ?>" method="POST">
                        <div class="d-flex justify-content-between">
                            <a href="?controller=admin&action=index" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-trash-fill me-1"></i> Xác nhận xóa
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-danger">
                        Không tìm thấy thông tin sản phẩm cần xóa!
                    </div>
                    <div class="text-center">
                        <a href="?controller=admin&action=index" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
