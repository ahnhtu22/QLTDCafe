
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm đồ uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Thêm đồ uống</h2>

    <form action="?controller=admin&action=store" method="POST">

        <div class="mb-3">
            <label>Danh mục</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Chọn danh mục --</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category->getId() ?>">
                        <?= htmlspecialchars($category->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Tên đồ uống</label>
            <input type="text" name="name"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price"
                   class="form-control" min="0" step="1" required>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="Còn món">Còn món</option>
                <option value="Hết món">Hết món</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Đường dẫn hình ảnh</label>
            <input type="text" name="image_url"
                   class="form-control"
                   placeholder="Nhập URL hình ảnh">
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description"
                      class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Thêm đồ uống
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
