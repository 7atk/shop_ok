<?php

session_start();

$connect = mysqli_connect('localhost', 'root', '', 'game_store') or die("Không thể kết nối đến database");
mysqli_set_charset($connect, "utf8");



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    $id = mysqli_real_escape_string($connect, $_POST['masp']);
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

    if ($quantity <= 0) {
        $quantity = 1;
    }

    // Sử dụng prepared statement
    $stmt = $connect->prepare("SELECT * FROM SANPHAM WHERE masp = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

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
 header('Location:http://localhost/shop_ok/index.php?page=cart'); // Thay cart.php bằng tên trang hiển thị giỏ hàng
    exit();
?>

