<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loại đồ uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.min.css"> -->
    <style>
        form {
            width: 30%;
            margin: auto;
        }
        button{
            margin-top: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class ="container">
        <h3 class= "text-center
                     text-uppercase 
                     text-success 
                     mt-3 mb-3">
            Thêm loại đồ uống
        </h3>

        <form action="?controller=addCategory" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Tên loại đồ uống</label>
                <input type="text" class ="form-control" id="name" name="name" placeholder="Nhập tên loại">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả">     
            </div>
            <button type="submit" class="btn btn-primary" name="btn_create">Thêm</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous">
    </script>
    <!-- <script src="js/bootstrap.bundle.min.js"></script> -->
    <script>
        //validate select options
        document.querySelector('form').addEventListener('submit', function (e) {
            
            if (document.querySelector('#name').value === '') {
                e.preventDefault();
                alert('Vui lòng nhập tên loại');
            }
            if (document.querySelector('#description').value === '') {
                e.preventDefault();
                alert('Vui lòng nhập mô tả');
            }
        });

        
    </script>
</body>
</html>