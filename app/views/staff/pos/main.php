
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng tại quầy - QLTDCafe</title>

    <!-- Bootstrap 5.0.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <!-- CSS giao diện bán hàng -->
    <link rel="stylesheet" href="/QLTDCafe-main/QLTDCafe-main/public/css/style.css">
</head>

<body>

    <!-- Thanh điều hướng -->
    <nav class="topbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap py-3">
                <a href="?controller=pos&action=index" class="brand">
                     QLTDCafe
                    <span class="fw-normal" style="font-size: 13px; color: #b9c4d3;">
                        | Hệ thống quản lý thực đơn quán cà phê
                    </span>
                </a>

                <div class="d-flex align-items-center mt-2 mt-md-0">
                    <a href="?controller=pos&action=index"
                       class="nav-link-custom active">
                        Bán hàng
                    </a>
                    
                </div>
            </div>
        </div>
    </nav>

    <main class="container">

        <!-- Tiêu đề trang -->
        <div class="page-heading">
            <h2>Bán hàng / POS</h2>
            <p>Nhập thông tin đồ uống và số lượng để tạo hóa đơn thanh toán.</p>
        </div>

        <div class="row g-4">

            <!-- Form bán hàng -->
            <div class="col-lg-7">
                <div class="panel">

                    <div class="panel-title">
                        🧾 Thông tin đơn hàng
                    </div>

                    <form action="?controller=pos&action=checkout" method="POST">

                        <div class="mb-4">
                            <label for="drink_name" class="form-label">
                                Tên đồ uống <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="drink_name"
                                   name="drink_name"
                                   placeholder="Ví dụ: Cà Phê Sữa Đá"
                                   required>

                            <div class="form-text">
                                Nhập tên đồ uống có trong danh sách của quán.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label">
                                Số lượng <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="quantity"
                                   name="quantity"
                                   min="1"
                                   value="1"
                                   required>
                        </div>
                        <!-- Ghi chú -->
                        <div class="mb-4">
                            <label for="note" class="form-label">Ghi chú (Note)</label>
                            <textarea class="form-control"
                                    id="note"
                                    name="note"
                                    rows="3"
                                    placeholder="Ví dụ: Ít đá, ít đường, không sữa..."></textarea>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-checkout">
                                Thanh toán đơn hàng →
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <!-- Hướng dẫn -->
            <div class="col-lg-5">
                <div class="panel">

                    <div class="panel-title">
                        ℹ️ Hướng dẫn sử dụng POS bán hàng
                    </div>

                    <div class="info-panel mb-3">
                        <h6>01. Nhập đồ uống</h6>
                        <p>Nhập đúng tên đồ uống đang được bán trong hệ thống.</p>
                    </div>

                    <div class="info-panel mb-3">
                        <h6>02. Nhập số lượng</h6>
                        <p>Điền số lượng cần bán. Số lượng phải lớn hơn 0.</p>
                    </div>

                    <div class="info-panel mb-3">
                        <h6>03. Note</h6>
                        <p>Ghi lại những yêu cầu của khách hàng.</p>
                    </div>
                    
                    <div class="info-panel">
                        <h6>04. Xác nhận thanh toán</h6>
                        <p>Nhấn nút thanh toán để hệ thống tính tiền và lưu hóa đơn.</p>
                    </div>

                    

                </div>
            </div>

        </div>

    </main>

    <footer class="footer">
        &copy; 2026QLTDCafe Project. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

</body>
</html>
