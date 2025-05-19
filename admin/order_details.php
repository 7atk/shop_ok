<?php


if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: http://localhost/shop_ok/index.php?page=login");
    exit();
}

require_once('../libs/config.php');

// Lấy ID đơn hàng từ URL
if (!isset($_GET['order_id'])) {
    die("Không có ID đơn hàng");
}

$order_id = $_GET['order_id'];

// Lấy thông tin đơn hàng
try {
    // 1. Thông tin đơn hàng
    $stmtOrder = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmtOrder->execute([$order_id]);
    $order = $stmtOrder->fetch();

    if (!$order) {
        die("Đơn hàng không tồn tại.");
    }

    // 2. Chi tiết sản phẩm
    $stmtItems = $conn->prepare("
        SELECT oi.*, p.name AS product_name 
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = ?
    ");
    $stmtItems->execute([$order_id]);
    $items = $stmtItems->fetchAll();
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h3 class="mb-4">Chi tiết đơn hàng #<?= htmlspecialchars($order_id) ?></h3>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Thông tin khách hàng</div>
        <div class="card-body">
            <p><strong>Họ tên:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
            <p><strong>SĐT:</strong> <?= htmlspecialchars($order['phone']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address']) ?></p>
            <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
            <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">Sản phẩm đã đặt</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá (₫)</th>
                        <th>Thành tiền (₫)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; foreach ($items as $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td><?= number_format($subtotal, 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Tổng cộng</th>
                        <th><?= number_format($total, 0, ',', '.') ?> ₫</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <a href="view_orders.php" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
</div>

</body>
</html>
