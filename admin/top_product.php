<?php
// Kết nối PDO
include_once('../libs/config.php');

// Lấy tháng được chọn từ người dùng (nếu có)
$selected_month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

// Truy vấn tổng số lượng theo mã sản phẩm trong tháng được chọn
$sql = "
    SELECT 
        o.product_id, 
        s.tensp AS product_name, 
        COALESCE(SUM(o.quantity), 0) AS total_sold
    FROM order_items o
    LEFT JOIN sanpham s ON s.masp = o.product_id
    WHERE DATE_FORMAT(o.order_time, '%Y-%m') = :month
    GROUP BY o.product_id, s.tensp
    ORDER BY s.tensp ASC
";
$stmt = $conn->prepare($sql);
$stmt->execute(['month' => $selected_month]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Dữ liệu cho biểu đồ
$labels = [];
$totals = [];

foreach ($data as $row) {
    $labels[] = $row['product_id'];
    $totals[] = $row['total_sold'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Biểu đồ bán hàng theo sản phẩm</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 100%;
            overflow-x: auto;
        }

        canvas {
            min-width: 1000px; /* Hoặc lớn hơn nếu sản phẩm rất nhiều */
            height: 400px;
        }
    </style>
</head>
<body>
    <h2>Biểu đồ tổng số lượng bán theo sản phẩm</h2>

    <div class="chart-container">
        <canvas id="productChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('productChart').getContext('2d');
        const productChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Tổng số lượng bán',
                    data: <?php echo json_encode($totals); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'x',
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Số lượng bán'
                        }
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 60,
                            minRotation: 45
                        },
                        title: {
                            display: true,
                            text: 'Tên sản phẩm'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>

