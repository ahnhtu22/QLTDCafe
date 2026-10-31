<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng tại quầy - QLTDCafe POS</title>

    <!-- Bootstrap 5.3.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- CSS giao diện bán hàng đồng bộ Cafe -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Thanh điều hướng POS -->
    <nav class="topbar py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap py-2">
                <a href="?controller=pos&action=index" class="brand">
                    <i class="bi bi-cup-hot-fill text-warning me-2"></i>
                    <span>QLTDCafe POS</span>
                </a>

                <div class="d-flex align-items-center flex-wrap gap-2 mt-2 mt-md-0">
                    <a href="?controller=pos&action=index" class="nav-link-custom active">
                        <i class="bi bi-cash-coin me-1"></i> Bán hàng
                    </a>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="?controller=admin&action=index" class="nav-link-custom">
                            <i class="bi bi-speedometer2 me-1"></i> Quản trị
                        </a>
                    <?php endif; ?>

                    <span class="text-light ms-2 d-none d-sm-inline" style="font-size: 14px;">
                        <i class="bi bi-person-circle me-1"></i>
                        <?= htmlspecialchars($_SESSION['username'] ?? 'Nhân viên') ?>
                    </span>

                    <a href="?controller=user&action=logout" class="btn btn-outline-light btn-sm ms-2">
                        <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container pb-5">

        <!-- Tiêu đề trang -->
        <div class="page-heading">
            <h2><i class="bi bi-cart-check-fill me-2"></i>Bán hàng tại quầy (POS)</h2>
            <p>Chọn các món đồ uống vào đơn hàng và thanh toán nhanh chóng.</p>
        </div>

        <?php if (!empty($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= htmlspecialchars($_GET['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">

            <!-- CỘT TRÁI: DANH SÁCH MÓN ĐÃ CHỌN TRONG ĐƠN HÀNG -->
            <div class="col-lg-7">
                <div class="panel">
                    <div class="panel-title d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-receipt-cutoff text-warning me-2"></i>Đơn hàng đang gọi
                            <span class="badge bg-secondary ms-1"><?= count($cartItems) ?> món</span>
                        </div>
                        <?php if (!empty($cartItems)): ?>
                            <a href="?controller=pos&action=clearCart"
                               class="btn btn-outline-danger btn-sm"
                               onclick="return confirm('Bạn có chắc muốn hủy và xóa sạch toàn bộ đơn hàng này?');">
                                <i class="bi bi-trash3 me-1"></i> Hủy đơn
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($cartItems)): ?>
                        <div class="table-responsive mb-3">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background-color: #6f4e37; color: white;">
                                    <tr>
                                        <th>Món đồ uống</th>
                                        <th class="text-center" style="width: 120px;">Đơn giá</th>
                                        <th class="text-center" style="width: 130px;">Số lượng</th>
                                        <th class="text-end" style="width: 130px;">Thành tiền</th>
                                        <th class="text-center" style="width: 50px;">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartItems as $item): ?>
                                        <tr>
                                            <td>
                                                <i class="bi bi-cup-hot me-1 text-muted"></i>
                                                <strong style="color: #4a2e1b;"><?= htmlspecialchars($item['name']) ?></strong>
                                            </td>
                                            <td class="text-center">
                                                <?= number_format($item['price'], 0, ',', '.') ?> đ
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="?controller=pos&action=updateCart&drink_name=<?= urlencode($item['name']) ?>&change=-1"
                                                       class="btn btn-outline-secondary px-2"><strong>-</strong></a>
                                                    <span class="btn btn-light px-3 disabled fw-bold text-dark"><?= $item['quantity'] ?></span>
                                                    <a href="?controller=pos&action=updateCart&drink_name=<?= urlencode($item['name']) ?>&change=1"
                                                       class="btn btn-outline-secondary px-2"><strong>+</strong></a>
                                                </div>
                                            </td>
                                            <td class="text-end fw-bold" style="color: #6f4e37;">
                                                <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> đ
                                            </td>
                                            <td class="text-center">
                                                <a href="?controller=pos&action=removeFromCart&drink_name=<?= urlencode($item['name']) ?>"
                                                   class="text-danger" title="Xóa món này">
                                                    <i class="bi bi-x-circle-fill fs-5"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th colspan="2" class="text-uppercase">Tổng cộng:</th>
                                        <th class="text-center"><?= $cartQuantity ?></th>
                                        <th class="text-end fs-5 fw-bold" style="color: #6f4e37;">
                                            <?= number_format($cartTotal, 0, ',', '.') ?> đ
                                        </th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Form gửi thanh toán đơn hàng nhiều món -->
                        <form action="?controller=pos&action=checkout" method="POST">
                            <div class="mb-3">
                                <label for="note" class="form-label fw-semibold">Ghi chú cho cả đơn hàng</label>
                                <textarea class="form-control"
                                          id="note"
                                          name="note"
                                          rows="2"
                                          placeholder="Ví dụ: Bàn số 5, ít đá cho cà phê sữa, mang về..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-checkout py-3 fs-6">
                                <i class="bi bi-printer-fill me-2"></i>Thanh toán & Xuất hóa đơn (<?= number_format($cartTotal, 0, ',', '.') ?> đ)
                            </button>
                        </form>

                    <?php else: ?>
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-cart-x fs-1 text-secondary d-block mb-3"></i>
                            <h6 class="fw-bold text-dark">Hóa đơn hiện tại chưa có món nào</h6>
                            <p class="mb-0 text-muted" style="font-size: 14px;">
                                Vui lòng bấm nút <strong>[+ Thêm]</strong> ở danh sách thực đơn bên phải để đưa món vào đơn hàng.
                            </p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- CỘT PHẢI: THỰC ĐƠN THAM KHẢO & BẤM THÊM NHANH (1 CLICK) -->
            <div class="col-lg-5">
                <div class="panel">

                    <div class="panel-title">
                        <i class="bi bi-grid-fill text-warning me-2"></i>Thực đơn & Thêm món (1 click)
                    </div>

                    <!-- Tìm kiếm món bằng PHP MVC -->
                    <form method="GET" action="index.php" class="mb-3">
                        <input type="hidden" name="controller" value="pos">
                        <input type="hidden" name="action" value="index">

                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   name="search"
                                   placeholder="Tìm tên món (cà phê, trà, bánh...)"
                                   value="<?= htmlspecialchars($search ?? '') ?>"
                                   autocomplete="off">
                            <button type="submit" class="btn btn-checkout" style="width: auto; min-height: unset; padding: 0 16px;">
                                <i class="bi bi-search"></i>
                            </button>
                            <?php if (!empty($search)): ?>
                                <a href="?controller=pos&action=index" class="btn btn-outline-secondary d-flex align-items-center" title="Xem tất cả">
                                    Tất cả
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($search)): ?>
                            <small class="text-success mt-1 d-block fw-semibold" style="font-size: 12px;">
                                <i class="bi bi-check-circle-fill me-1"></i>Tìm thấy <?= count($drinks) ?> món với từ khóa "<?= htmlspecialchars($search) ?>"
                            </small>
                        <?php endif; ?>
                    </form>

                    <?php if (!empty($drinks)): ?>
                        <p class="text-muted mb-3" style="font-size: 13px;">
                            Bấm nút <strong>[+ Thêm]</strong> để đưa món vào hóa đơn:
                        </p>
                        <div class="d-flex flex-column gap-2 mb-3" style="max-height: 520px; overflow-y: auto;">
                            <?php foreach ($drinks as $d): ?>
                                <div class="p-2 px-3 rounded border d-flex justify-content-between align-items-center bg-white shadow-sm">
                                    <div>
                                        <i class="bi bi-cup-hot me-2" style="color: #6f4e37;"></i>
                                        <strong style="color: #4a2e1b;"><?= htmlspecialchars($d->getName()) ?></strong>
                                        <div class="text-muted mt-1" style="font-size: 12px;">
                                            Giá: <strong style="color: #6f4e37;"><?= number_format($d->getPrice(), 0, ',', '.') ?> đ</strong>
                                            <?php if ($d->isAvailable()): ?>
                                                <span class="badge bg-success ms-1" style="font-size: 10px;">Còn món</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger ms-1" style="font-size: 10px;">Hết món</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div>
                                        <?php if ($d->isAvailable()): ?>
                                            <form action="?controller=pos&action=addToCart" method="POST" class="d-inline">
                                                <input type="hidden" name="drink_name" value="<?= htmlspecialchars($d->getName()) ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-outline-cafe btn-sm py-1 px-3" title="Thêm vào đơn hàng">
                                                    <i class="bi bi-plus-lg me-1"></i>Thêm
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-secondary btn-sm py-1 px-2 disabled" title="Món đã hết">
                                                Hết
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning py-2 mb-3" style="font-size: 13px;">
                            Không tìm thấy đồ uống nào. Hãy bấm "Tất cả" để hiển thị lại menu.
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>

    </main>

    <footer class="footer">
        <div class="container">
            &copy; 2026 QLTDCafe Project. Hệ thống quản lý quán cà phê chuyên nghiệp.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
