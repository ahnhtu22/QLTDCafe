
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đồ uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Danh sách đồ uống</h2>

    <a href="?controller=admin&action=add"
       class="btn btn-primary mb-3">
        Thêm đồ uống
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Danh mục</th>
                <th>Tên đồ uống</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($drinks as $drink): ?>
                <tr>
                    <td><?= $drink->getId() ?></td>
                    <td><?= $drink->getCategoryId() ?></td>
                    <td><?= htmlspecialchars($drink->getName()) ?></td>
                    <td>
                        <?= number_format($drink->getPrice(), 0, ',', '.') ?> đ
                    </td>
                    <td><?= htmlspecialchars($drink->getStatus()) ?></td>
                    <td>
                        <?php if($drink->getImageUrl()): ?>
                            <img src="<?= htmlspecialchars($drink->getImageUrl()) ?>"
                                 width="80" alt="Đồ uống">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($drink->getDescription() ?? '') ?></td>
                    <td>
                        <a href="?controller=admin&action=edit&id=<?= $drink->getId() ?>"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <a href="?controller=admin&action=destroy&id=<?= $drink->getId() ?>"
                           class="btn btn-danger btn-sm">
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
