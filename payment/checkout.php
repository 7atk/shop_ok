<?php
require_once 'libs/config.php'; // Đảm bảo đã khởi tạo $pdo từ PDO

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
        $payment = $_POST["payment"];

        if ($payment == "Cod") {
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $email = $_POST["email"];
            $date = date("Y-m-d H:i:s");
            $orderId = generateOrderCode();

            try {
                // Bắt đầu transaction
                $conn->beginTransaction();

                // Insert vào bảng orders
                $stmt = $conn->prepare("INSERT INTO orders (customer_name, phone, address, email, payment_method, order_date,order_id) VALUES (?, ?, ?, ?, ?, ?,?)");
                $stmt->execute([$name, $phone, $address, $email, $payment, $date, $orderId]);

                // Insert từng sản phẩm vào bảng order_items
                $stmtItem = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, subtotal, order_time) VALUES (?, ?, ?, ?, ?, ?)");
                foreach ($cart as $item) {
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
                $success = true;
            } catch (Exception $e) {
                $conn->rollBack();
                echo "Lỗi: " . $e->getMessage();
            }
        } elseif ($payment == "Onl") {
            // Lưu vào session để xử lý online
            $_SESSION['cname'] = $_POST['name'];
            $_SESSION['cphone'] = $_POST['phone'];
            $_SESSION['cemail'] = $_POST['email'];
            $_SESSION['caddress'] = $_POST['address'];
            $_SESSION['order_id'] = generateOrderCode();
            $_SESSION['payment'] = $payment;

            echo "<script>window.location.href='payment/gateways.php';</script>";
        }
    } else {
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
