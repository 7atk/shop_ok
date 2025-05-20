<?php
require_once('../libs/config.php'); // File này phải thiết lập kết nối PDO trong biến $pdo
$mode = $_GET['mode'] ?? 'month'; // mặc định là theo tháng

$sql = "SELECT 
            oi.product_id, 
            s.tensp AS product_name, 
            SUM(oi.quantity) AS total_quantity
        FROM order_items oi
        JOIN sanpham s ON oi.product_id = s.masp
        
        GROUP BY oi.product_id";

$stmt = $conn->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tách dữ liệu
$labels = [];
$values = [];
$total = 0;
foreach ($data as $row) {
    $labels[] = $row['product_name'];
    $values[] = $row['total_quantity'];
    $total += $row['total_quantity'];
}
?>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('productPieChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: "Sản phẩm",
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [/*...*/],
            }]
        }
    });
});
</script>


<body>

    <!-- Form chọn chế độ -->
    <!-- <form method="get">
        <label>Chế độ xem: </label>
        <select name="mode" onchange="this.form.submit()">
            <option value="month" <?= $mode == 'month' ? 'selected' : '' ?>>Theo tháng</option>
            <option value="year" <?= $mode == 'year' ? 'selected' : '' ?>>Theo năm</option>
        </select>
    </form> -->

    <!-- <h2><?= $title ?></h2> -->
    <canvas id="pieChart" width="10" height="10"></canvas>

    <script>
        const labels = <?= json_encode($labels) ?>;
        const values = <?= json_encode($values) ?>;
        const total = <?= $total ?>;

        const percentageData = values.map(val => ((val / total) * 100).toFixed(2));

        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels.map((label, i) => `${label} (${percentageData[i]}%)`),
                datasets: [{
                    data: values,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

<style>
    #pieChart {
        max-width: 200px;
        max-height: 200px;
        
    }
</style>


