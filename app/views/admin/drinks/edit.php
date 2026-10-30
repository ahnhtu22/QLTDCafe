<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa đồ uống - QLTDCafe Admin</title>
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

    <div class="container pb-5" style="max-width: 650px;">
        <div class="card card-cafe">
            <div class="card-cafe-header" style="background-color: #6f4e37;">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>Cập nhật thông tin sản phẩm
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="?controller=admin&action=update&id=<?= $drink->getId() ?>" method="POST">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Danh mục</label>
                        <select name="category_id" class="form-select" required>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category->getId() ?>"
                                    <?= $drink->getCategoryId() == $category->getId() ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category->getName()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên sản phẩm</label>
                        <input type="text" name="name"
                               class="form-control"
                               value="<?= htmlspecialchars($drink->getName()) ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Giá (VNĐ)</label>
                        <input type="number" name="price"
                               class="form-control"
                               min="0" step="1000"
                               value="<?= $drink->getPrice() ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="Còn món" <?= $drink->getStatus() == 'Còn món' ? 'selected' : '' ?>>
                                Còn món
                            </option>
                            <option value="Hết món" <?= $drink->getStatus() == 'Hết món' ? 'selected' : '' ?>>
                                Hết món
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Đường dẫn hình ảnh</label>
                        <input type="text" name="image_url"
                               class="form-control"
                               value="<?= htmlspecialchars($drink->getImageUrl() ?? '') ?>"
                               placeholder="Nhập URL hình ảnh">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3"><?= htmlspecialchars($drink->getDescription() ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="?controller=admin&action=index" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-cafe px-4">
                            <i class="bi bi-check-circle-fill me-1"></i> Cập nhật sản phẩm
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
