<?php
session_start();

// Kiểm tra quyền truy cập
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: http://localhost/shop_ok/index.php?page=login");
    exit();
}

require_once('../libs/config.php'); // File này phải thiết lập kết nối PDO trong biến $pdo

$view_mode = isset($_GET['view']) ? $_GET['view'] : 'month';

if ($view_mode === 'year') {
    $sql = "SELECT DATE_FORMAT(order_time, '%Y') AS period, SUM(subtotal) AS revenue
            FROM order_items
            GROUP BY period
            ORDER BY period ASC";
} else {
    $sql = "SELECT DATE_FORMAT(order_time, '%Y-%m') AS period, SUM(subtotal) AS revenue
            FROM order_items
            GROUP BY period
            ORDER BY period ASC";
}

try {
    $stmt = $conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $revenues = [];

    foreach ($results as $row) {
        $labels[] = $row['period'];
        $revenues[] = $row['revenue'];
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn dữ liệu: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Doanh Thu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
    </div>
</nav>

<div class="row">
    <div class="col-sm-2"><a href="../index.php">🏠 Trang chủ</a></div>
    <div class="col-sm-2"><a href="#">📈 Doanh thu</a></div>
    <div class="col-sm-2"><a href="view_orders.php">🛒 Đơn hàng</a></div>
    <div class="col-sm-2"><a href="../index.php?page=list_sanpham">📦 Sản phẩm</a></div>
    <div class="col-sm-2"><a href="#">👤 Người dùng</a></div>
    <div class="col-sm-2"><a href="#">⚙️ Cài đặt</a></div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Biểu đồ doanh thu</h5>
                    <form method="get" class="d-flex">
                        <select name="view" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                            <option value="month" <?= $view_mode === 'month' ? 'selected' : '' ?>>Theo tháng</option>
                            <option value="year" <?= $view_mode === 'year' ? 'selected' : '' ?>>Theo năm</option>
                        </select>
                    </form>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const labels = <?= json_encode($labels); ?>;
    const revenues = <?= json_encode($revenues); ?>;

    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: revenues,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>
