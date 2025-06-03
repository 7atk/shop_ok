<?php

session_start();
include('../libs/config.php');
// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['masp'];
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

    if ($quantity <= 0) {
        $quantity = 1;
    }

    // Truy vấn sản phẩm bằng prepared statement
    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE masp = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $item = array(
            'id' => $row['masp'],
            'name' => $row['tensp'],
            'price' => $row['gia'],
            'quantity' => $quantity,
            'image' => "images/" . $row['hinhanh']
        );

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = $item;
        }
    }
}
 header('Location:../index.php?page=cart'); // Thay cart.php bằng tên trang hiển thị giỏ hàng
    exit();
?>

