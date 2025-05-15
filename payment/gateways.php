<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'game_store') or die("Không thể kết nối đến database");
mysqli_set_charset($connect, "utf8");

   
    if(isset($_POST['accept'])){
    $name = $_SESSION['cname'];
    $phone = $_SESSION['cphone'];
    $payment = $_SESSION['payment'];
    
    $address = $_SESSION['caddress'];
    $email = $_SESSION['cemail'];
    $date = date("Y-m-d H:i:s");
    $orderId = $_SESSION['orderId'];
        // Thêm vào bảng orders
        $sql = "INSERT INTO orders ( customer_name, phone, address, email, payment_method, order_date)
                VALUES ('$name', '$phone', '$address', '$email', '$payment', '$date')";

        $result = mysqli_query($connect, $sql);
        if ($result) {
            foreach ($_SESSION['cart'] as $item) {
                $productId = $item['id'];
                $quantity = (int)$item['quantity'];
                $price = (int)$item['price'];
                $totalPrice = $quantity * $price;

                $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal,order_time)
                            VALUES ('$orderId', '$productId', '$quantity', '$price', '$totalPrice','$date')";
                mysqli_query($connect, $sqlItem);
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);
            unset($_SESSION['total']);
            header('Location: index.php?page=thankyou');
            exit();
        } else {
            echo "Lỗi: " . mysqli_error($connect);
        }
    }
    ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Form với QR và 2 nút</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 50px;
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
  </style>
</head>
<body>

  <h2>Quét mã QR để tiếp tục</h2>

  <!-- Hình ảnh QR -->
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=https://example.com" alt="QR Code" class="qr-code">

  <!-- Hai nút -->
  <div class="buttons">
    <form method="post" >
    <input type="hidden" name="accept">
    <button onclick="alert('Bạn đã nhấn nút Xác nhận')" >Xác nhận</button>
    </form>
    <form method="post" action="index.php?page=delete_cart">
      <input type="hidden" name="deletecart" value="Xóa toàn bộ">
      <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?');">Hủy</button>
    </form>
  </div>

</body>
</html>

    
   
       



       
    
