<?php
session_start();

// Chỉ cho phép admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: ../index.php?page=login");
    exit();
}

require_once('../libs/config.php');

// Lấy danh sách đơn hàng
try {
    $stmt = $conn->query("
        SELECT o.id AS order_id, o.customer_name, o.phone, o.address, o.email, o.payment_method, o.order_date,
               o.order_id, SUM(oi.quantity * oi.price) AS total_amount
        FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        GROUP BY o.id
        ORDER BY o.order_date DESC
    ");
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Lỗi truy vấn đơn hàng: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin - Đơn hàng</a>
    </div>
</nav>

<div class="container">
    <h3 class="mb-4">Danh sách đơn hàng</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Thanh toán</th>
                    <th>Ngày đặt</th>
                    <th>Mã đơn hàng</th>
                    <th>Tổng tiền</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)) : ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['phone']) ?></td>
                            <td><?= htmlspecialchars($order['email']) ?></td>
                            <td><?= htmlspecialchars($order['address']) ?></td>
                            <td><?= htmlspecialchars($order['payment_method']) ?></td>
                            <td><?= htmlspecialchars($order['order_date']) ?></td>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VNĐ</td>
                            <td>
                                <a href="order_details.php?order_id=<?= $order['order_id'] ?>" class="btn btn-sm btn-info">Xem</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="9" class="text-center">Không có đơn hàng nào</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

