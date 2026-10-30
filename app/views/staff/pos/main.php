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
            <p>Tìm kiếm đồ uống, kiểm tra trạng thái món và tạo hóa đơn thanh toán cho khách hàng.</p>
        </div>

        <div class="row g-4">

            <!-- Cột Form bán hàng & Tìm kiếm -->
            <div class="col-lg-7">
                <div class="panel">

                    <div class="panel-title">
                        <i class="bi bi-receipt text-warning me-2"></i>Thông tin đơn hàng
                    </div>

                    <!-- 1. Form tìm kiếm đồ uống bằng PHP MVC -->
                    <form method="GET" action="index.php" class="mb-4 p-3 rounded" style="background-color: #fdfbf7; border: 1px solid #e8c9a8;">
                        <input type="hidden" name="controller" value="pos">
                        <input type="hidden" name="action" value="index">

                        <label for="search" class="form-label fw-semibold" style="color: #6f4e37;">
                            <i class="bi bi-search me-1"></i>Tìm kiếm & Gợi ý tên đồ uống
                        </label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="search"
                                   name="search"
                                   placeholder="Nhập tên món cần tìm (ví dụ: cà phê, bạc xỉu, trà, nước ép...)"
                                   value="<?= htmlspecialchars($search ?? '') ?>"
                                   autocomplete="off">
                            <button type="submit" class="btn btn-checkout" style="width: auto; min-height: unset; padding: 0 20px;">
                                <i class="bi bi-search me-1"></i> Tìm món
                            </button>
                            <?php if (!empty($search)): ?>
                                <a href="?controller=pos&action=index" class="btn btn-outline-secondary d-flex align-items-center" title="Xem tất cả">
                                    <i class="bi bi-x-circle me-1"></i> Xem tất cả
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($search)): ?>
                            <div class="mt-2 text-success fw-semibold" style="font-size: 13px;">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Gợi ý tìm thấy <strong><?= count($drinks) ?></strong> món phù hợp với từ khóa "<?= htmlspecialchars($search) ?>"
                            </div>
                        <?php endif; ?>
                    </form>

                    <!-- 2. Form gửi đơn hàng thanh toán -->
                    <form action="?controller=pos&action=checkout" method="POST">

                        <div class="mb-3">
                            <label for="drink_name" class="form-label fw-semibold">
                                Tên đồ uống <span class="text-danger">*</span>
                            </label>

                            <!-- Dropdown gợi ý danh sách món theo kết quả lọc của PHP MVC -->
                            <select class="form-select" id="drink_name" name="drink_name" required
                                    onchange="window.location.href='?controller=pos&action=index<?= !empty($search) ? '&search=' . urlencode($search) : '' ?>&selected_drink=' + encodeURIComponent(this.value)">
                                <?php if (!empty($drinks)): ?>
                                    <option value="">-- Chọn đồ uống trong danh sách (<?= count($drinks) ?> món) --</option>
                                    <?php foreach ($drinks as $d): ?>
                                        <option value="<?= htmlspecialchars($d->getName()) ?>"
                                            <?= ($selected_drink === $d->getName()) ? 'selected' : '' ?>>
                                            [<?= $d->getStatusText() ?>] <?= htmlspecialchars($d->getName()) ?> — <?= number_format($d->getPrice(), 0, ',', '.') ?> đ
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">Không tìm thấy đồ uống nào phù hợp với từ khóa vừa tìm!</option>
                                <?php endif; ?>
                            </select>

                            <div class="form-text text-muted">
                                Thay đổi món trong ô để cập nhật trạng thái món ngay bên dưới.
                            </div>
                        </div>

                        <!-- 3. Ô HIỂN THỊ TRẠNG THÁI CÒN / HẾT MÓN -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-shield-check me-1"></i>Trạng thái món đồ uống
                            </label>
                            <div class="p-3 rounded border d-flex align-items-center justify-content-between" style="background-color: #fdfbf7; border-color: #e8c9a8 !important;">
                                <div>
                                    <span class="text-muted d-block" style="font-size: 13px;">Món đang chọn:</span>
                                    <strong style="color: #4a2e1b; font-size: 16px;">
                                        <?= htmlspecialchars($currentDrink ? $currentDrink->getName() : 'Chưa chọn món') ?>
                                    </strong>
                                    <?php if ($currentDrink): ?>
                                        <span class="ms-2 fw-semibold" style="color: #6f4e37;">
                                            (<?= number_format($currentDrink->getPrice(), 0, ',', '.') ?> đ)
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <?php if ($currentDrink && $currentDrink->isAvailable()): ?>
                                        <span class="badge bg-success px-3 py-2" style="font-size: 14px;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Còn món
                                        </span>
                                    <?php elseif ($currentDrink): ?>
                                        <span class="badge bg-danger px-3 py-2" style="font-size: 14px;">
                                            <i class="bi bi-x-circle-fill me-1"></i> Hết món
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary px-3 py-2" style="font-size: 14px;">
                                            Chưa xác định
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label fw-semibold">
                                Số lượng (ly) <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="quantity"
                                   name="quantity"
                                   min="1"
                                   value="1"
                                   required>
                        </div>

                        <!-- Ghi chú khẩu vị -->
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
                        </div>

                    </form>

                </div>
            </div>

            <!-- Cột Hướng dẫn & Danh sách món chọn nhanh kèm trạng thái -->
            <div class="col-lg-5">
                <div class="panel">

                    <div class="panel-title">
                        <i class="bi bi-hand-index-thumb text-warning me-2"></i>Danh sách thực đơn & Trạng thái
                    </div>

                    <?php if (!empty($drinks)): ?>
                        <p class="text-muted mb-3" style="font-size: 13px;">
                            Click vào món bất kỳ để chọn và xem trạng thái:
                        </p>
                        <div class="d-flex flex-column gap-2 mb-4" style="max-height: 320px; overflow-y: auto;">
                            <?php foreach ($drinks as $d): ?>
                                <a href="?controller=pos&action=index<?= !empty($search) ? '&search=' . urlencode($search) : '' ?>&selected_drink=<?= urlencode($d->getName()) ?>"
                                   class="p-2 px-3 rounded border text-decoration-none d-flex justify-content-between align-items-center"
                                   style="<?= ($selected_drink === $d->getName()) ? 'border-color: #6f4e37 !important; background-color: #fdfbf7 !important;' : 'background-color: #ffffff;' ?>">
                                    <div>
                                        <i class="bi bi-cup-hot me-2" style="color: #6f4e37;"></i>
                                        <strong style="color: #4a2e1b;"><?= htmlspecialchars($d->getName()) ?></strong>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold" style="color: #6f4e37; font-size: 13px;">
                                            <?= number_format($d->getPrice(), 0, ',', '.') ?> đ
                                        </span>
                                        <?php if ($d->isAvailable()): ?>
                                            <span class="badge bg-success" style="font-size: 11px;">Còn món</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger" style="font-size: 11px;">Hết món</span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning py-2 mb-3" style="font-size: 13px;">
                            Không tìm thấy đồ uống nào. Hãy bấm "Xem tất cả" để hiển thị lại menu.
                        </div>
                    <?php endif; ?>

                    <div class="border-top pt-3">
                        <h6 class="fw-bold mb-2" style="color: #6f4e37;">
                            <i class="bi bi-info-circle me-1"></i>Hướng dẫn quy trình:
                        </h6>
                        <ol class="text-muted ps-3 mb-0" style="font-size: 13px; line-height: 1.7;">
                            <li>Gõ từ khóa vào ô tìm kiếm và bấm <strong>Tìm món</strong>.</li>
                            <li>Quan sát ô <strong>Trạng thái món</strong> để biết món còn hay hết.</li>
                            <li>Nhập số lượng, ghi chú khẩu vị và bấm <strong>Thanh toán đơn hàng</strong>.</li>
                        </ol>
                    </div>

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
