<?php
session_start();

// Kiểm tra quyền truy cập
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: http://localhost/shop_ok/index.php?page=login");
    exit();
}

require_once('../libs/config.php'); // File này phải thiết lập kết nối PDO trong biến $pdo


// }



$sql = "SELECT 
            oi.product_id, 
            s.tensp AS product_name, 
            SUM(oi.quantity) AS total_quantity
        FROM order_items oi
        JOIN sanpham s ON oi.product_id = s.masp
        GROUP BY oi.product_id";

$stmt = $conn->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tách dữ liệu cho biểu đồ
$labelss = [];
$values = [];
$total = 0;

foreach ($data as $row) {
    $labelss[] = $row['product_name'];
    $valuess[] = (int)$row['total_quantity'];
    // $totals += (int)$row['total_quantity'];
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
</nav>
<!-- <nav class="navbar navbar-expand-sm bg-success navbar-dark">
     <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
 </nav> -->


<div class="container-fluid mt-1">
 <div class="row">
    <div class="col-sm-1 bg-info text-white  ">
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
         
        <h2 style="text-align:center;">Biểu đồ tỉ lệ sản phẩm đã bán</h2>


         <canvas id="productPieChart" width="10" height="10"></canvas>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('productPieChart');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labelss); ?>,
            datasets: [{
                data: <?php echo json_encode($valuess); ?>,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                    '#9966FF', '#FF9F40', '#E7E9ED', '#8AFFC1',
                    '#C0FF33', '#FF33C4', '#339FFF'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percent = ((value / total) * 100).toFixed(2);
                            return `${context.label}: ${value} (${percent}%)`;
                        }
                    }
                }
            }
        }
    });
});
</script> 

</div>

    </div>

    </body>
</html>

<style>
    #pieChart {
        max-width: 200px;
        max-height: 200px;
        
    }
</style>
