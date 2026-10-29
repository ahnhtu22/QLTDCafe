
<?php
    /** @var Drink[] $drinks */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đồ uống</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">

        <h3 class="text-center
                   text-uppercase
                   text-success
                   mt-3 mb-3">
            Quản lý đồ uống
        </h3>

        <!-- Chuyen den trang them do uong -->
        <a href="?controller=admin&action=add"
           class="btn btn-success">
            Thêm mới đồ uống
        </a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Tên đồ uống</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach ($drinks as $drink){
                ?>
                    <tr>
                        <th scope="row">
                            <?= $drink->getId(); ?>
                        </th>

                        <td>
                            <?= $drink->getCategoryId(); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($drink->getName()); ?>
                        </td>

                        <td>
                            <?= number_format($drink->getPrice(), 0, ',', '.'); ?> đ
                        </td>

                        <td>
                            <?= htmlspecialchars($drink->getStatus()); ?>
                        </td>

                        <td>
                            <?php if($drink->getImageUrl()): ?>
                                <img
                                    src="<?= htmlspecialchars($drink->getImageUrl()); ?>"
                                    width="80"
                                    alt="Hình đồ uống">
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($drink->getDescription() ?? ''); ?>
                        </td>

                        <td>
                            <a href="?controller=admin&action=edit&id=<?= $drink->getId(); ?>">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>

                        <td>
                            <a href="?controller=admin&action=destroy&id=<?= $drink->getId(); ?>">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>

                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
