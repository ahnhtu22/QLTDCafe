<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.min.css"> -->
</head>
<body>
    <div class ="container">
        <h3 class= "text-center text-uppercase text-success mt-3 mb-3">Quản lý loại đồ uống</h3>
        <a href="?controller=addCategory" class='btn btn-success'>Thêm loại đồ uống mới </a>
    <table class="table mt-3">
        <thead>
            <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên loại đồ uống</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Sửa</th>
            <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ( $categories as $category){
            ?>
                <tr>
                    <th scope="row"><?=$category->getId();?></th>
                    <td><?=$category->getName();?></td>
                    <td><?=$category->getDescription();?></td>
                    <td>
                        <a href="?controller=editCategoryt&id=<?= $category->getId ()?>">
                        <i class="bi bi-pencil-square"></i>
                    </td>
                    <td>
                        <a href="?controller=deleteCategory&id=<?= $category->getId ()?>">
                        <i class="bi bi-trash"></i>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous">
    </script>
    <!-- <script src="js/bootstrap.bundle.min.js"></script> -->
</body>
</html>