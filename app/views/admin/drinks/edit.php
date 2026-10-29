
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa đồ uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Sửa đồ uống</h2>

    <form action="?controller=admin&action=update&id=<?= $drink->getId() ?>"
          method="POST">

        <div class="mb-3">
            <label>Danh mục</label>
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
            <label>Tên đồ uống</label>
            <input type="text" name="name"
                   class="form-control"
                   value="<?= htmlspecialchars($drink->getName()) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price"
                   class="form-control"
                   min="0" step="1"
                   value="<?= $drink->getPrice() ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="Còn món"
                    <?= $drink->getStatus() == 'Còn món' ? 'selected' : '' ?>>
                    Còn món
                </option>

                <option value="Hết món"
                    <?= $drink->getStatus() == 'Hết món' ? 'selected' : '' ?>>
                    Hết món
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label>Đường dẫn hình ảnh</label>
            <input type="text" name="image_url"
                   class="form-control"
                   value="<?= htmlspecialchars($drink->getImageUrl() ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description"
                      class="form-control"
                      rows="3"><?= htmlspecialchars($drink->getDescription() ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Cập nhật
        </button>

        <a href="?controller=admin&action=index"
           class="btn btn-secondary">
            Quay lại
        </a>

    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
