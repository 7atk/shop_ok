<?php
// Kết nối MySQL
$conn = new mysqli('localhost', 'root', '', 'game_store');
$conn->set_charset("utf8");

// Dữ liệu tổng quan
$res1 = $conn->query("SELECT SUM(total) AS today_sales FROM orders WHERE created_at = CURDATE()");
$res2 = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
$res3 = $conn->query("SELECT COUNT(*) AS new_customers FROM customers WHERE created_at = CURDATE()");

$today_sales = $res1->fetch_assoc()['today_sales'] ?? 0;
$total_orders = $res2->fetch_assoc()['total_orders'] ?? 0;
$new_customers = $res3->fetch_assoc()['new_customers'] ?? 0;

// Dữ liệu sản phẩm bán chạy
$top_products = $conn->query("SELECT name, sold FROM products ORDER BY sold DESC LIMIT 5");

// Dữ liệu biểu đồ doanh thu 7 ngày
$chart_data = $conn->query("
    SELECT created_at, SUM(total) AS total
    FROM orders
    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
    GROUP BY created_at
    ORDER BY created_at
");

$dates = [];
$totals = [];
while ($row = $chart_data->fetch_assoc()) {
    $dates[] = $row['created_at'];
    $totals[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Bán Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">📊 Dashboard Bán Hàng</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Doanh thu hôm nay</h5>
                    <p class="card-text"><?= number_format($today_sales) ?> VNĐ</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng đơn hàng</h5>
                    <p class="card-text"><?= $total_orders ?> đơn</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Khách hàng mới</h5>
                    <p class="card-text"><?= $new_customers ?> người</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">🔥 Top sản phẩm bán chạy</h4>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Đã bán</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($product = $top_products->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= $product['sold'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <h4 class="mb-3 mt-5">📈 Biểu đồ doanh thu 7 ngày qua</h4>
    <canvas id="salesChart" width="100%" height="40"></canvas>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($dates) ?>,
            datasets: [{
                label: 'Doanh thu',
                data: <?= json_encode($totals) ?>,
                backgroundColor: 'rgba(0,123,255,0.3)',
                borderColor: 'rgba(0,123,255,1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => value.toLocaleString() + ' VNĐ'
                    }
                }
            }
        }
    });
</script>
</body>
</html>
