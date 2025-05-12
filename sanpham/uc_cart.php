<?php
 $connect = mysqli_connect('localhost','root','','game_store') or die("Không thể kết nối đến database");
 mysqli_set_charset($connect,"utf8");

//Khi bấm update
if (isset($_POST['update'])) {

    foreach ($_POST['quantity'] as $key => $val) {
        if ($val == 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['quantity'] = $val;
        }
    }
}
if (isset($_POST['btnempty']))
//if(isset($_POST["ok"])) 
{
    session_destroy();
    //header('Location: default.php');
    echo "<script>location.href='index.php';</script>";
    //echo '<meta http-equiv="refresh" content="0;url=list_sp.php">';
}
?>

<form method="post" action="default.php?page=uc_cart">
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-success font-weight-bold text-center">
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <?php

        $sql = "SELECT * FROM sanpham WHERE MASP IN (";

        foreach ($_SESSION['cart'] as $id => $value) {
            $sql .= $id . ",";
        }

        $sql = substr($sql, 0, -1) . ") ORDER BY MASP ASC";

        $query = mysqli_query($db, $sql);
        $totalprice = 0;
        $cart_items = 0;
        while ($row = mysqli_fetch_array($query)) {
            $subtotal = $_SESSION['cart'][$row['idsp']]['quantity'] * $row['gianhap'];
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
    </table>
    <div class="col-12 text-danger text-center">
        <strong class="float-start"><a class="btn btn-danger" href="default.php?page=products">>>Tiếp tục mua hàng</a></strong>
        <strong class="text-center">
            <button class="btn btn-outline-primary" type="submit" name="btnempty">Empty Cart</button></strong>

        <strong><button class="btn btn-outline-primary" type="submit" name="update">Update Cart</button></strong>
        <strong><a href="default.php?page=uc_checkout" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Đặt hàng & Thanh toán</a></strong>
    </div>

    <?php
    if (number_format($totalprice, 0) <= 0)
        echo "<script>location.href='index.php';</script>";
    ?>
</form>