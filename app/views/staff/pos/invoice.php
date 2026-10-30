<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn thanh toán - QLTDCafe</title>

    <!-- Bootstrap 5.3.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS chung đồng bộ Cafe -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="invoice">

        <!-- Đầu hóa đơn -->
        <div class="invoice-header">
            <h1 class="brand">
                <i class="bi bi-cup-hot-fill text-warning me-2"></i>QLTDCafe
            </h1>
            <p class="tagline">COFFEE · FRESH · EVERY DAY</p>
            <div class="header-line"></div>
        </div>

        <div class="invoice-body">

            <!-- Tiêu đề hóa đơn -->
            <div class="invoice-title">
                <h2>HÓA ĐƠN THANH TOÁN</h2>
            </div>

            <?php if ($invoice != null) { ?>

                <!-- Thông tin hóa đơn -->
                <div class="info-box invoice-meta">
                    <div>
                        <span class="info-label">Mã hóa đơn:</span>
                        <span class="info-value">#<?= htmlspecialchars((string)$invoice->getId(), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>

                    <div>
                        <span class="info-label">Thời gian:</span>
                        <span class="info-value"><?= htmlspecialchars($invoice->getCreatedAt(), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>

                <!-- Chi tiết đồ uống -->
                <h3 class="section-title">
                    <i class="bi bi-list-check me-1"></i>Chi tiết đơn hàng
                </h3>

                <div class="table-wrap">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Đồ uống</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="drink-name">
                                    <i class="bi bi-cup-straw me-1 text-muted"></i>
                                    <?= htmlspecialchars($invoice->getDrinkName(), ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td class="text-center"><?= (int)$invoice->getQuantity(); ?> ly</td>
                                <td class="order-price text-end">
                                    <?= number_format($invoice->getTotalPrice(), 0, ',', '.'); ?> đ
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Ghi chú đơn hàng -->
                <?php if (!empty($note)): ?>
                    <div class="mt-3 p-3 bg-light rounded border">
                        <span class="fw-bold" style="color: #6f4e37;">
                            <i class="bi bi-pencil-square me-1"></i>Ghi chú:
                        </span>
                        <span class="text-muted"><?= htmlspecialchars($note, ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Lời cảm ơn -->
                <div class="thank-you">
                    <p class="mb-1">Cảm ơn quý khách và hẹn gặp lại!</p>
                    <small class="text-muted">Hotline hỗ trợ: 1900 xxxx - www.qltdcafe.local</small>
                </div>

            <?php } else { ?>

                <div class="alert alert-danger text-center">
                    Không tìm thấy thông tin hóa đơn.
                </div>

            <?php } ?>

        </div>

        <!-- Nút chức năng -->
        <div class="actions">
            <button type="button" class="btn btn-print" onclick="window.print()">
                <i class="bi bi-printer-fill me-1"></i> In hóa đơn
            </button>

            <a href="?controller=pos&action=index" class="btn btn-back">
                <i class="bi bi-arrow-left me-1"></i> Quay lại bán hàng
            </a>
        </div>
    </div>
</body>
</html>
