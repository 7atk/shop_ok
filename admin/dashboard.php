<?php
session_start();

// Kiểm tra quyền truy cập
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: http://localhost/shop_ok/index.php?page=login");
    exit();
}

require_once('../libs/config.php'); // File này phải thiết lập kết nối PDO trong biến $pdo


// }
$years = $conn->query("SELECT DISTINCT YEAR(order_time) as year FROM order_items ORDER BY year DESC")->fetchAll(PDO::FETCH_COLUMN);

// Mặc định tháng/năm hiện tại nếu không chọn
$selectedMonth = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$selectedYear = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Lấy dữ liệu sản phẩm bán theo tháng/năm đã chọn
$sql = "SELECT 
            oi.product_id,
            s.tensp AS product_name,
            SUM(oi.quantity) AS total_quantity
        FROM order_items oi
        JOIN sanpham s ON oi.product_id = s.masp
        WHERE MONTH(oi.order_time) = :month AND YEAR(oi.order_time) = :year
        GROUP BY oi.product_id";

$stmt = $conn->prepare($sql);
$stmt->execute(['month' => $selectedMonth, 'year' => $selectedYear]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labelss = [];
$values = [];
$total = 0;

foreach ($data as $row) {
    $labelss[] = $row['product_name'];
    $values[] = (int)$row['total_quantity'];
    $total += (int)$row['total_quantity'];
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
    <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 600px;
            max-width: 90%;
            margin: 0 auto;
        }
    </style>
</head>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
    </div>
    
					 
					<form method="get" action="search_order.php" class="d-flex px-2">
    
                          <input type="hidden" name="page" value="search">

                            <!-- <?php
   
                               $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
                             ?> -->

                        <input class="form-control me-2" type="search" name="tenkh" placeholder="Search"
                            	 value="<?php echo $search; ?>">

                              <button class="btn btn-warning">Search</button>
</form>
</nav>


<div class="container-fluid mt-1">
 <div class="row">
    <div class="col-sm-1 bg-info text-white rounded"> 
      <h5 >Menu</h5>
         <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="../index.php">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../user/list_user.php">User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../index.php?page=list_sanpham">Ql Sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
            <div class="card shadow">
               
            <?php include('m_chart.php'); ?>
            
             </div>
      </div>
      
     <div class="col-sm-3">
      <div class="card shadow" style="width: 100%;height: 100%;">
         <h2 style="text-align:center;">Thống kê tỉ lệ sản phẩm đã bán</h2>

<form method="get" action="">
    <label>Chọn tháng: 
        <select name="month">
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?= $m ?>" <?= $m == $selectedMonth ? 'selected' : '' ?>><?= $m ?></option>
            <?php endfor; ?>
        </select>
    </label>

    <label>Chọn năm: 
        <select name="year">
            <?php foreach ($years as $y): ?>
                <option value="<?= $y ?>" <?= $y == $selectedYear ? 'selected' : '' ?>><?= $y ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="submit">Xem</button>
</form>

<div class="chart-container">
    <canvas id="pieChart"></canvas>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const labels = <?= json_encode($labelss) ?>;
    const values = <?= json_encode($values) ?>;
    const total = <?= $total ?>;

    const percentageData = values.map(val => ((val / total) * 100).toFixed(2));
    const ctx = document.getElementById('pieChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels.map((label, i) => `${label} (${percentageData[i]}%)`),
            datasets: [{
                data: values,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                    '#9966FF', '#FF9F40', '#E7E9ED', '#8AFFC1'
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
});
</script>

        </div>
        
    </div>
<div class="col-12">
        <div class="card shadow  " style="margin-left: -20px;">
            <div class="card-header bg-success text-white ">
                <h5 class="mb-0">Danh sách hóa đơn cần tìm</h5>
                
        </div>
        <?php include('search_order.php') ?> 

    </body>
</html>

<style>
    #pieChart {
        max-width: 400px;
        max-height: 400px;
        margin: 0 auto;
    }
</style>
