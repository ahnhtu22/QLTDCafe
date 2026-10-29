<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loại đồ uống - QLTDCafe Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 550px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-plus-circle me-2"></i>Thêm loại đồ uống mới
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="?controller=category&action=store" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Tên loại đồ uống</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên loại đồ uống" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="?controller=category&action=index" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-success px-4" name="btn_create">
                            <i class="bi bi-check-circle me-1"></i> Thêm mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
