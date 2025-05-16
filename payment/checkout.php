<?php

include('configg.php');

function generateOrderCode() {
    $prefix = "DH" . date("Ymd");
    $randomStr = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3));
    $randomNum = rand(100, 999);
    return $prefix . $randomStr . $randomNum;
}

if (isset($_POST['checked'])) {
    if (!empty($_SESSION['cart']) && !empty($_SESSION['total'])) {
        $cart = $_SESSION['cart'];
        $totalAmount = $_SESSION['total'];
        $payment = mysqli_real_escape_string($connect, $_POST["payment"]);
    if ($payment == "Cod") {
        // Kiểm tra xem giỏ hàng có sản phẩm không
       
    // Lấy thông tin từ form
        $name = mysqli_real_escape_string($connect, $_POST["name"]);
        $phone = mysqli_real_escape_string($connect, $_POST["phone"]);
        $address = mysqli_real_escape_string($connect, $_POST["address"]);
        
        $email = mysqli_real_escape_string($connect, $_POST["email"]);
        $date = date("Y-m-d H:i:s");
        $orderId = generateOrderCode();
      
        // Thêm vào bảng orders
        $sql = "INSERT INTO orders ( customer_name, phone, address, email, payment_method, order_date)
                VALUES ('$name', '$phone', '$address', '$email', '$payment', '$date')";

        $result = mysqli_query($connect, $sql);
        if ($result) {
            foreach ($cart as $item) {
                $productId = $item['id'];
                $quantity = (int)$item['quantity'];
                $price = (int)$item['price'];
                $totalPrice = $quantity * $price;

                $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal,order_time)
                            VALUES ('$orderId', '$productId', '$quantity', '$price', '$totalPrice','$date')";
               
            }
             mysqli_query($connect, $sqlItem);

            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);
            unset($_SESSION['total']);
            $success = true;
        } else {
            echo "Lỗi: " . mysqli_error($connect);
        }
            
        } 
        elseif ($payment == "Onl") {
            $_SESSION['cname'] = $_POST['name'];
            $_SESSION['cphone'] = $_POST['phone'];
            $_SESSION['cemail'] = $_POST['email'];
            $_SESSION['caddress'] = $_POST['address'];
            $_SESSION['order_id'] = generateOrderCode();
            
            $_SESSION['payment'] = $payment;
            echo "<script>window.location.href='payment/gateways.php';</script>";
        }
        
    }
    else {
        echo "<script>alert('Giỏ hàng trống! Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán.');</script>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin: 10px 0 5px; }
        input, textarea, select { width: 100%; padding: 8px; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>

<h2>Thanh toán đơn hàng</h2>

<?php if (!empty($success)): 
     echo "<script>alert('Đặt hàng thành công! Mã đơn hàng của bạn là: " . htmlspecialchars($orderId) . "');</script>";
        echo "<script>window.location.href='index.php';</script>";  
 endif; ?>
<form method="post" action="index.php?page=checkout">
    <label>Họ tên</label>
    <input type="text" name="name" required>

    <label>Số điện thoại</label>
    <input type="text" name="phone" required>
    <label>Email</label>
    <input type="email" name="email" required>

    <label>Địa chỉ</label>
    <textarea name="address" required></textarea>
   
    

    <label>Phương thức thanh toán</label>
    <select name="payment" required>
        <option value="Onl">Chuyển khoản ngân hàng</option>
        <option value="Cod">Thanh toán khi nhận hàng (COD)</option>
    </select>

    <br><br>
    <button type="submit" name="checked">Đặt hàng</button>
</form>
<br><br> 
</body>
</html>