
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn - QLTDCafe</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- CSS chung -->
    <link rel="stylesheet" href="/QLTDCafe-main/QLTDCafe/public/css/style.css">
</head>

<body>
    <div class="invoice">

        <!-- Đầu hóa đơn -->
        <div class="invoice-header">
            
            <h1 class="brand">QLTDCafe</h1>
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
                        <span class="info-label">Mã đơn:</span>
                        <span class="info-value">#<?= htmlspecialchars((string)$invoice->getId(), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>

                    <div>
                        <span class="info-label">Thời gian:</span>
                        <span class="info-value"><?= htmlspecialchars($invoice->getCreatedAt(), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>


                   
            

                <!-- Chi tiết đồ uống -->
                
              
                <h3 class="section-title">Chi tiết đơn hàng</h3>

                <div class="table-wrap">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Đồ uống</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="drink-name">
                                    <?= htmlspecialchars($invoice->getDrinkName(), ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td><?= (int)$invoice->getQuantity(); ?> ly</td>
                                <td class="order-price">
                                    <?= number_format($invoice->getTotalPrice(), 0, ',', '.'); ?> đ
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

              
                   <thead>
                            <tr>
                                <th>Ghi chú:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($note ?? '', ENT_QUOTES, 'UTF-8') !== ''
                                        ? htmlspecialchars($note, ENT_QUOTES, 'UTF-8')
                                        : 'Không có ghi chú'; ?>
                                </td>
                            </tr>
                        </tbody>
                    
            

                <!-- Lời cảm ơn -->
                <div class="thank-you">
                    Cảm ơn quý khách và hẹn gặp lại!
                </div>

            <?php } else { ?>

                <p class="text-center">
                    Không tìm thấy thông tin hóa đơn.
                </p>

            <?php } ?>

        </div>

        <!-- Nút chức năng -->
        <div class="actions">
            <button type="button" class="btn btn-print" onclick="window.print()">
                In hóa đơn
            </button>

            <a href="?controller=pos&action=index" class="btn btn-back">
                Quay lại bán hàng
            </a>
        </div>
    </div>
</body>
</html>
