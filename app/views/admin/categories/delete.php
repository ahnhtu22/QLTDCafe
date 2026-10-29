<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận xóa loại đồ uống - QLTDCafe Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 550px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-danger text-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Xác nhận xóa loại đồ uống
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-warning">
                    Bạn có chắc chắn muốn xóa loại đồ uống này không? Hành động này không thể hoàn tác!
                </div>
                <div class="mb-3">
                    <p class="mb-1"><strong>ID:</strong> <?= $category->getId() ?></p>
                    <p class="mb-1"><strong>Tên:</strong> <?= htmlspecialchars($category->getName()) ?></p>
                    <p class="mb-1"><strong>Mô tả:</strong> <?= htmlspecialchars($category->getDescription() ?? '') ?></p>
                </div>
                <form action="?controller=category&action=destroy&id=<?= $category->getId() ?>" method="POST">
                    <div class="d-flex justify-content-between mt-4">
                        <a href="?controller=category&action=index" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-danger px-4" name="btn_destroy">
                            <i class="bi bi-trash-fill me-1"></i> Xác nhận xóa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
