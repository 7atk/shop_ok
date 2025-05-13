<?php
session_start();
if(isset($_POST['deletecart'])) {
    unset($_SESSION['cart']); // Xóa giỏ hàng
    echo "<script>alert('Giỏ hàng đã được xóa thành công!');</script>";
    echo "<script>window.location.href='index.php?page=cart';</script>";
}
if(isset($_POST['deleteproduct'])) {
    $id = $_POST['masp'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]); // Xóa sản phẩm khỏi giỏ hàng
        echo "<script>alert('Sản phẩm đã được xóa khỏi giỏ hàng!');</script>";
    } else {
        echo "<script>alert('Sản phẩm không tồn tại trong giỏ hàng!');</script>";
    }
    echo "<script>window.location.href='index.php?page=cart';</script>";
}

?>