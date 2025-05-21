<?php

$searchhh = isset($_GET['tenkh']) ? htmlspecialchars($_GET['tenkh']) : '';
$sql="SELECT 
    o.order_id,
    o.customer_name,
    o.phone,
    o.address,
    o.email,
    o.payment_method,
    o.order_date,
    
    s.tensp AS product_name,
    oi.quantity AS soluong,
    oi.subtotal,
    
    (
        SELECT SUM(subtotal)
        FROM order_items oi2
        WHERE oi2.order_id = o.order_id
    ) AS tong_don
FROM orders o
JOIN order_items oi ON o.order_id = oi.order_id
JOIN sanpham s ON oi.product_id = s.masp
WHERE o.customer_name LIKE :keyword
ORDER BY o.order_date DESC, o.order_id DESC
";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':keyword', '%' . $search . '%', PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
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
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền sản phẩm</th>
                    <th>Tổng tiền đơn hàng</th>
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
