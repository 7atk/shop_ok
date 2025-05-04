<?php
//include('libs/common.php'); //bên index.php đã khai báo rồi

$sql = "SELECT IDSP, TENSP, GIANHAP, HINHSP, THONGTINSP FROM SAN_PHAM"; 

if (isset($_GET['idsp'])) { 
    $idsp = intval($_GET['idsp']); // Chống SQL Injection
    $sql .= " WHERE IDSP = $idsp";
}

$result = SelectAll($sql);
disconnect_db();

foreach ($result as $row) { 
    $idsp = $row['IDSP'] ?? '';  
    $tensp = htmlspecialchars($row['TENSP'] ?? 'Không có tên');  
    $hinhsp = !empty($row['HINHSP']) ? "images/" . htmlspecialchars($row['HINHSP']) : "images/no-image.png";  
    $thongtinsp = htmlspecialchars($row['THONGTINSP'] ?? 'Đang cập nhật thông tin sản phẩm');  
    $price = is_numeric($row['GIANHAP']) ? $row['GIANHAP'] : 0;
    $gianhap = number_format($price, 0);
    $giacu = number_format($price * 1.1, 0);
?>
    <div class="col-md-6 col-lg-4">
        <div class="card-box">
            <div class="card-thumbnail">
                <img class="img-fluid" src="<?php echo $hinhsp; ?>" alt="Hình ảnh sản phẩm">
            </div>
            <form method="post" action="sanpham/cart_update.php">
                <h3 class="mt-2 text-danger">
                    <a href="index.php?page=product_detail&id=<?php echo htmlspecialchars($idsp); ?>">
                        <?php echo $tensp; ?>
                    </a>
                </h3>
                <p class="text-secondary"><?php echo $thongtinsp; ?></p>
                <small class="text-muted">Giá cũ: <s><span><?php echo $giacu; ?> vnd</span></s></small>
                <h6 class="price">Giá hiện tại: <span><?php echo $gianhap; ?> vnd</span></h6>
                <input type="number" name="quantity" min="1" max="10" value="1" class="text-center" />
                <button class="btn btn-sm btn-danger mb-1">Add To Cart</button>
                <input type="hidden" name="product_code" value="<?php echo htmlspecialchars($idsp); ?>" />
                <input type="hidden" name="tensp" value="<?php echo $tensp; ?>" />
                <input type="hidden" name="hinhsp" value="<?php echo $hinhsp; ?>" />
                <input type="hidden" name="price" value="<?php echo $price; ?>" />
                <input type="hidden" name="type" value="addcart" />
                <?php 
                    $return_url = base64_encode(urlencode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])); 
                ?>
                <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
                <a class="btn btn-sm btn-danger float-end" href="index.php?page=product_detail&id=<?php echo htmlspecialchars($idsp); ?>">
                    <b class="btn link-primary">Chi tiết</b>
                </a>
            </form>
        </div>
    </div>
<?php } ?>
