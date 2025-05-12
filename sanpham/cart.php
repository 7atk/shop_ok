<?php
session_start();
$connect = mysqli_connect('localhost','root','','game_store') or die("Không thể kết nối đến database");
mysqli_set_charset($connect,"utf8");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Hover Rows</h2>
  <p>The .table-hover class enables a hover state (grey background on mouse over) on table rows:</p>            
  <table class="table table-hover">
    <thead>
      <tr>
      <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
      </tr>
    </thead>
    <tbody>
    <?php

$sql = "SELECT * FROM sanpham WHERE MASP IN (";

foreach ($_SESSION['cart'] as $id => $value) {
    $sql .= $id . ",";
}

$sql = substr($sql, 0, -1) . ") ORDER BY MASP ASC";

$query = mysqli_query($connect, $sql);
$totalprice = 0;
$cart_items = 0;
while ($row = mysqli_fetch_array($query)) {
    $idsp = $row['MASP']; // Ensure the column name matches your database schema
    $subtotal = $_SESSION['cart'][$idsp]['quantity'] * $row['gianhap'];
    $totalprice += $subtotal;
    $cart_items++;
?>

    <tr>
        <td class="text-center"><?php echo $cart_items; ?></td>
        <td><?php echo $row['idsp'] ?></td>
        <td>

            <?php echo '<a class="btn link-danger" href="default.php?page=uc_product_detail&action=add&idsp=' . $row["idsp"] . '">' . $row["tensp"] . '</a>'; ?>
        </td>
        <td class="text-end"><?php echo number_format($row['gianhap']) ?></td>
        <td>
            <input type="number" class="form-control text-primary float-end" name="quantity[<?php echo $row['idsp'] ?>]" style="width: 4rem;" min="0" max="10" value="<?php echo $_SESSION['cart'][$row['idsp']]['quantity'] ?>">
        </td>

        <td class="text-end"><?php echo number_format($_SESSION['cart'][$row['idsp']]['quantity'] * $row['gianhap']) ?></td>
        <input type="hidden" name="sl" value="<?php echo !empty($quantity) ? $quantity : '1'; ?>" />
        <input type="hidden" name="idsp" value="<?php echo !empty($row['idsp']) ? $row['idsp'] : ''; ?>" />
    </tr>
<?php
}
?>
<tr class="bg-secondary ">
    <td colspan="6" class="text-end text-white fw-bold">Total Price: <?php echo number_format($totalprice, 0) ?></td>
</tr>   
    </tbody>
  </table>
</div>

</body>
</html>
