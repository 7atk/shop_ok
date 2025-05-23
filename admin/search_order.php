<?php
session_start();
require_once('../libs/config.php');

// Lấy dữ liệu từ form POST
$searchType = isset($_POST['search_type']) ? $_POST['search_type'] : 'tenkh';
$search = isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : '';

$results = [];

if (!empty($search)) {
    // Xác định truy vấn SQL tùy theo loại tìm kiếm
    $whereClause = '';
    if ($searchType === 'tenkh') {
        $whereClause = 'o.customer_name LIKE :keyword';
    } elseif ($searchType === 'mahd') {
        $whereClause = 'o.order_id LIKE :keyword';
    }

    $sql = "SELECT 
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
    WHERE $whereClause
    ORDER BY o.order_date DESC, o.order_id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Tìm kiếm Đơn hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Admin_Search</a>
        <form method="post" action="Search_order.php" class="d-flex ms-auto">
            <select name="search_type" class="form-select me-2">
                <option value="tenkh" <?= $searchType === 'tenkh' ? 'selected' : '' ?>>Tìm theo tên khách hàng</option>
                <option value="mahd" <?= $searchType === 'mahd' ? 'selected' : '' ?>>Tìm theo mã hóa đơn</option>
            </select>
            <input class="form-control me-2" type="text" name="keyword" placeholder="Nhập từ khóa" value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-warning" type="submit">Tìm kiếm</button>
        </form>
    </div>
</nav>

<div class="container">
    <h3 class="mb-4 mt-4">Danh sách đơn hàng</h3>
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
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)) : ?>
                    <?php foreach ($results as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['phone']) ?></td>
                            <td><?= htmlspecialchars($order['email']) ?></td>
                            <td><?= htmlspecialchars($order['address']) ?></td>
                            <td><?= htmlspecialchars($order['payment_method']) ?></td>
                            <td><?= htmlspecialchars($order['order_date']) ?></td>
                            <td><?= htmlspecialchars($order['product_name']) ?></td>
                            <td><?= htmlspecialchars($order['soluong']) ?></td>
                            <td><?= number_format($order['subtotal'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= number_format($order['tong_don'], 0, ',', '.') ?> VNĐ</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="11" class="text-center">Không có đơn hàng nào</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
