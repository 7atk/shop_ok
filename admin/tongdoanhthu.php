<?php
require_once('../libs/config.php');

// Lấy ngày hôm nay theo định dạng YYYY-MM-DD
$today = date('Y-m-d');

$sql = "SELECT SUM(subtotal) as doanhthu FROM order_items WHERE DATE(order_time) = :today";
$stmt = $conn->prepare($sql);
$stmt->execute([':today' => $today]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$doanhthu = $result['doanhthu'] ?? 0; // Nếu không có kết quả thì mặc định là 0
?>
<p><?php echo $doanhthu?></p>