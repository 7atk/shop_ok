<?php
require_once('../libs/config.php');

// Kiểm tra xem có truyền order_id không
if (!isset($_GET['order_id'])) {
    die("Thiếu mã đơn hàng.");
}

$order_id = $_GET['order_id'];

// Xóa chi tiết đơn hàng trước (để tránh lỗi ràng buộc khóa ngoại)
try {
    $stmt = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
    $stmt->execute([$order_id]);

    // Xóa đơn hàng
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->execute([$order_id]);

    // Quay lại trang danh sách
    header("Location: view_orders.php"); // đổi thành tên file hiện tại nếu khác
    exit();
} catch (PDOException $e) {
    die("Lỗi xóa đơn hàng: " . $e->getMessage());
}
?>