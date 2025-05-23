<?php
require_once '../libs/config.php'; 
session_start();


if (isset($_POST['accept'])) {
    $name = $_SESSION['cname'] ?? '';
    $phone = $_SESSION['cphone'] ?? '';
    $payment = $_SESSION['payment'] ?? '';
    $address = $_SESSION['caddress'] ?? '';
    $email = $_SESSION['cemail'] ?? '';
    $orderId = $_SESSION['order_id'] ?? '';
    $date = date("Y-m-d H:i:s");

    try {
        // Bắt đầu transaction
        $conn->beginTransaction();

        // Thêm đơn hàng vào bảng `orders`
        $sql = "INSERT INTO orders (customer_name, phone, address, email, payment_method, order_date,order_id)
                VALUES (?, ?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $phone, $address, $email, $payment, $date,$orderId]);

        // Thêm từng sản phẩm vào `order_items`
        $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal, order_time)
                    VALUES (?, ?, ?, ?, ?, ?)";
        $stmtItem = $conn->prepare($sqlItem);

        foreach ($_SESSION['cart'] as $item) {
            $productId = $item['id'];
            $quantity = (int)$item['quantity'];
            $price = (int)$item['price'];
            $subtotal = $quantity * $price;

            $stmtItem->execute([$orderId, $productId, $quantity, $price, $subtotal, $date]);
        }

        $conn->commit();

        // Xóa giỏ hàng
        unset($_SESSION['cart']);
        unset($_SESSION['total']);

        echo "<script>alert('Đặt hàng thành công! Mã đơn hàng của bạn là: " . htmlspecialchars($orderId) . "');</script>";
        echo "<script>window.location.href='../index.php';</script>";
        exit();

    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Lỗi xử lý đơn hàng: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>QR check out</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 50px;
      background-image: url("https://wallpaperaccess.com/full/8066610.png");
    }
    .qr-code {
      width: 200px;
      height: 200px;
      margin-bottom: 20px;
    }
    .buttons {
      margin-top: 20px;
    }
    .buttons button {
      margin: 0 10px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }
        .popup {
            display: none;
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -30%);
            background-color: white;
            padding: 20px;
            border: 1px solid #aaa;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 1000;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
  </style>
</head>
<body>

  <h2>Quét mã QR để tiếp tục</h2>
<div class="bg-info" >
  <!-- Hình ảnh QR -->
  <img src="../images/Capture.PNG" style="height:30vh;width:30vh" alt="QR Code" class="qr-code">

  <!-- Hai nút -->
  <div class="buttons">
    <form method="post" >
    <input type="hidden" name="accept">
    <button   >Xác nhận</button>
    </form>
    <form method="post" action="../sanpham/delete_cart">
      <input type="hidden" name="deletecart" value="Xóa toàn bộ">
      <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?');">Hủy</button>
    </form>
  </div>
 
</div>

 

</body>
</html>

    
   
       



       
    
