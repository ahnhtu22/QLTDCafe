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
            <h2><i class="bi bi-cart-check-fill me-2"></i>POS</h2>
            <p></p>
        </div>

        <?php if (!empty($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= htmlspecialchars($_GET['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">

            <!-- CỘT TRÁI: CHỌN MÓN & DANH SÁCH MÓN TRONG ĐƠN HÀNG -->
            <div class="col-lg-7">

                <!-- 1. KHUNG CHỌN MÓN ĐỂ THÊM VÀO ĐƠN -->
                <div class="panel mb-4">
                    <div class="panel-title">
                        <i class="bi bi-plus-circle text-warning me-2"></i>Chọn món
                    </div>

                    <!-- Tìm kiếm món bằng PHP MVC -->
                    <form method="GET" action="index.php" class="mb-3 p-3 rounded" style="background-color: #fdfbf7; border: 1px solid #e8c9a8;">
                        <input type="hidden" name="controller" value="pos">
                        <input type="hidden" name="action" value="index">

                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   name="search"
                                   placeholder="Nhập tên món cần lọc (ví dụ: cà phê, trà, dưa hấu...)"
                                   value="<?= htmlspecialchars($search ?? '') ?>"
                                   autocomplete="off">
                            <button type="submit" class="btn btn-checkout" style="width: auto; min-height: unset; padding: 0 18px;">
                                <i class="bi bi-search me-1"></i> Lọc
                            </button>
                            <?php if (!empty($search)): ?>
                                <a href="?controller=pos&action=index" class="btn btn-outline-secondary d-flex align-items-center" title="Xem tất cả">
                                    <i class="bi bi-x-circle me-1"></i> Tất cả
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <!-- Form thêm món vào hóa đơn -->
                    <form action="?controller=pos&action=addToCart" method="POST">
                        <div class="mb-3">
                            <label for="drink_name" class="form-label fw-semibold">
                                Tên đồ uống <span class="text-danger">*</span>
                            </label>

                            <select class="form-select" id="drink_name" name="drink_name" required
                                    onchange="window.location.href='?controller=pos&action=index<?= !empty($search) ? '&search=' . urlencode($search) : '' ?>&selected_drink=' + encodeURIComponent(this.value)">
                                <?php if (!empty($drinks)): ?>
                                    <option value="">-- Chọn món đồ uống (<?= count($drinks) ?> món) --</option>
                                    <?php foreach ($drinks as $d): ?>
                                        <option value="<?= htmlspecialchars($d->getName()) ?>"
                                            <?= ($selected_drink === $d->getName()) ? 'selected' : '' ?>>
                                            [<?= $d->getStatusText() ?>] <?= htmlspecialchars($d->getName()) ?> — <?= number_format($d->getPrice(), 0, ',', '.') ?> đ
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">Không tìm thấy đồ uống nào phù hợp!</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Ô hiển thị trạng thái món -->
                        <div class="mb-3 p-2 px-3 rounded border d-flex justify-content-between align-items-center" style="background-color: #fdfbf7;">
                            <div>
                                <span class="text-muted" style="font-size: 13px;">Đang chọn:</span>
                                <strong style="color: #4a2e1b;" class="ms-1">
                                    <?= htmlspecialchars($currentDrink ? $currentDrink->getName() : 'Chưa chọn') ?>
                                </strong>
                                <?php if ($currentDrink): ?>
                                    <span class="ms-2 fw-semibold" style="color: #6f4e37;">
                                        (<?= number_format($currentDrink->getPrice(), 0, ',', '.') ?> đ)
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if ($currentDrink && $currentDrink->isAvailable()): ?>
                                    <span class="badge bg-success py-2 px-3">
                                        <i class="bi bi-check-circle-fill me-1"></i> Còn món
                                    </span>
                                <?php elseif ($currentDrink): ?>
                                    <span class="badge bg-danger py-2 px-3">
                                        <i class="bi bi-x-circle-fill me-1"></i> Hết món
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary py-2 px-3">Chưa chọn</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row g-2 align-items-end">
                            <div class="col-4">
                                <label for="quantity" class="form-label fw-semibold">Số lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
                            </div>
                            <div class="col-8">
                                <?php if ($currentDrink && !$currentDrink->isAvailable()): ?>
                                    <button type="button" class="btn btn-secondary w-100 disabled" style="min-height: 44px;">
                                        <i class="bi bi-slash-circle me-1"></i> Món này đang hết
                                    </button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-checkout w-100" style="min-height: 44px;">
                                        <i class="bi bi-cart-plus-fill me-1"></i> Thêm vào đơn hàng
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!--<div class="mb-3">
                            <label for="quantity" class="form-label fw-semibold">
                                Số lượng  <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="quantity"
                                   name="quantity"
                                   min="1"
                                   value="1"
                                   required>
                        </div>

                       
                        <div class="mb-4">
                            <label for="note" class="form-label fw-semibold">Ghi chú khẩu vị (Note)</label>
                            <textarea class="form-control"
                                      id="note"
                                      name="note"
                                      rows="3"
                                      placeholder="Ví dụ: Ít đá, 50% đường, mang về..."></textarea>
                        </div>

                        <div class="d-grid mt-4">
                            <?php if ($currentDrink && !$currentDrink->isAvailable()): ?>
                                <button type="button" class="btn btn-secondary disabled py-2" style="font-size: 15px;">
                                    <i class="bi bi-slash-circle me-2"></i>Món này hiện đang Hết món
                                </button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-checkout">
                                    <i class="bi bi-check2-circle me-2"></i>Thanh toán đơn hàng
                                </button>
                            <?php endif; ?>
                        </div>-->


                    </form>
                </div>

                <!-- 2. BẢNG CÁC MÓN ĐÃ CHỌN TRONG ĐƠN HÀNG HIỆN TẠI -->
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
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-cart-x fs-1 text-secondary d-block mb-2"></i>
                            <p class="mb-1">Hóa đơn hiện tại chưa có món nào.</p>
                            <small>Vui lòng chọn đồ uống ở phía trên và bấm <strong>"Thêm vào đơn hàng"</strong>.</small>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- CỘT PHẢI: THỰC ĐƠN THAM KHẢO & BẤM THÊM NHANH -->
            <div class="col-lg-5">
                <div class="panel">

                    <div class="panel-title">
                        <i class="bi bi-grid-fill text-warning me-2"></i>Thêm nhanh
                    </div>

                    <?php if (!empty($drinks)): ?>
                        <p class="text-muted mb-3" style="font-size: 13px;">
                            Bấm dấu <strong>[+]</strong> để thêm ngay món vào hóa đơn:
                        </p>
                        <div class="d-flex flex-column gap-2 mb-4" style="max-height: 480px; overflow-y: auto;">
                            <?php foreach ($drinks as $d): ?>
                                <div class="p-2 px-3 rounded border d-flex justify-content-between align-items-center bg-white">
                                    <div>
                                        <i class="bi bi-cup-hot me-2" style="color: #6f4e37;"></i>
                                        <strong style="color: #4a2e1b;"><?= htmlspecialchars($d->getName()) ?></strong>
                                        <div class="text-muted" style="font-size: 12px;">
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
                                                <button type="submit" class="btn btn-outline-cafe btn-sm py-1 px-2" title="Thêm vào đơn">
                                                    <i class="bi bi-plus-lg"></i> Thêm
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

                    <!--<div class="border-top pt-3">
                        <h6 class="fw-bold mb-2" style="color: #6f4e37;">
                            <i class="bi bi-info-circle me-1"></i>Quy trình gọi nhiều món:
                        </h6>
                        <ol class="text-muted ps-3 mb-0" style="font-size: 13px; line-height: 1.7;">
                            <li>Chọn món và bấm <strong>Thêm vào đơn</strong> (hoặc bấm nút <strong>+ Thêm</strong> ở cột bên phải).</li>
                            <li>Tùy chỉnh số lượng bằng nút <strong>+ / -</strong> trong bảng hóa đơn.</li>
                            <li>Sau khi khách chốt toàn bộ món, bấm <strong>Thanh toán & Xuất hóa đơn</strong>.</li>
                        </ol>
                    </div>-->

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
