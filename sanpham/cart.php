
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Giỏ hàng</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Giỏ hàng của bạn</h2>
  <p>Danh sách sản phẩm trong giỏ hàng:<a href="index.php">Muốn đặt thêm hàng ?</a></p>
  <?php 
  if (!isset($_SESSION['username'])) {
    echo "<div class='alert alert-danger'>Bạn cần đăng nhập để xem giỏ hàng.</div>";
    echo "<script>window.location.href='index.php?page=login';</script>";
  } 
  
  
  ?>

  <?php if (!empty($_SESSION['cart'])): ?>
    <form method="post" action="index.php?page=delete_cart">
      <input class="btn btn-warning mb-2 float-end" type="submit" name="deletecart" value="Xóa toàn bộ" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?');" />
    </form>

    <table class="table table-hover table-bordered text-center">
      <thead class="table-dark">
        <tr>
          <th>STT</th>
          <th>Mã sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Hình ảnh</th>
          <th>Số lượng</th>
          <th>Đơn giá</th>
          <th>Thành tiền</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $STT = 1;
        $total = 0;
        foreach ($_SESSION['cart'] as $item):
          $subtotal = $item['price'] * $item['quantity'];
          $total += $subtotal;
        
        
        ?>
        <tr>
          <td><?php echo $STT++; ?></td>
          <td><?php echo htmlspecialchars($item['id']); ?></td>
          <td><?php echo htmlspecialchars($item['name']); ?></td>
          <td><img src="<?php echo htmlspecialchars($item['image']); ?>" width="80" /></td>
          <td><?php echo $item['quantity']; ?></td>
          <td><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</td>
          <td><?php echo number_format($subtotal, 0, ',', '.'); ?> đ</td>
          <td>
            <form method="post" action="index.php?page=delete_cart" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
              <input type="hidden" name="masp" value="<?php echo htmlspecialchars($item['id']); ?>" />
              <input class="btn btn-sm btn-danger" type="submit" name="deleteproduct" value="Xóa" />
            </form>
          </td>
        </tr>
        <?php endforeach;$_SESSION['total'] = $total;  ?>
        <tr>
          <td colspan="6" class="text-end"><strong>Tổng cộng:</strong></td>
          <td colspan="2"><strong><?php echo number_format($total, 0, ',', '.');  ?> đ</strong></td>
        </tr>
        <tr>
          <td colspan="8">
            <form method="post" action="index.php?page=checkout">
              <input class="btn btn-success" type="submit" name="checkout" value="Thanh toán" />
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">Giỏ hàng của bạn hiện đang trống.<a href="index.php">Muốn đặt hàng ?</a></div>
  <?php endif; ?>

</div>

</body>
</html>
