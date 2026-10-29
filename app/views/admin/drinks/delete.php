
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xóa đồ uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Xác nhận xóa đồ uống</h2>

    <?php if($drink != null): ?>

        <div class="alert alert-warning">
            Bạn có chắc chắn muốn xóa đồ uống này không?
        </div>

        <p><b>ID:</b> <?= $drink->getId() ?></p>

        <p><b>Tên đồ uống:</b>
            <?= htmlspecialchars($drink->getName()) ?>
        </p>

        <p><b>Giá:</b>
            <?= number_format($drink->getPrice(), 0, ',', '.') ?> đ
        </p>

        <p><b>Trạng thái:</b>
            <?= htmlspecialchars($drink->getStatus()) ?>
        </p>

        <form action="?controller=admin&action=delete&id=<?= $drink->getId() ?>"
              method="POST">

            <button type="submit" class="btn btn-danger">
                Xác nhận xóa
            </button>

            <a href="?controller=admin&action=index"
               class="btn btn-secondary">
                Hủy
            </a>

        </form>

    <?php else: ?>
        <div class="alert alert-danger">
            Không tìm thấy đồ uống!
        </div>

        <a href="?controller=admin&action=index"
           class="btn btn-secondary">
            Quay lại
        </a>
    <?php endif; ?>
</div>
</body>
</html>
