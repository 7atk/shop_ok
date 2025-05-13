<?php
if (!isset($_SESSION)) {
    session_start();
}

// Lấy ID sản phẩm
$idsp = $_REQUEST['id'] ?? null;

// Nếu không có ID thì quay về trang chủ
if (!$idsp) {
    header("Location: index.php");
    exit();
}

// Truy vấn dữ liệu sản phẩm
$sql = "SELECT masp, tensp, gia, hinhanh, mota FROM SANPHAM WHERE maSP='$idsp'";
$result = SelectAll($sql);

foreach ($result as $row) {
    $idsp = $row['masp'];
    $tensp = $row['tensp'];
    $hinhsp = "images/" . $row['hinhanh'];
    $thongtinsp = $row['mota'] ?? "Đang cập nhật thông tin sản phẩm";
    $price = $row['gia'];
    $gianhap = number_format($row['gia'], 0);
    $giacu = number_format($row['gia'] + ($row['gia'] * 10 / 100), 0);
}
?>

<form method="post" action="sanpham/add_to_cart.php" >
    <div class="wrapper row">
        <div class="preview col-md-6">
            <div class="preview-pic tab-content">
                <div class="tab-pane fade" id="pic-1">
                    <img src="<?php echo $hinhsp; ?>">
                </div>
                <div class="tab-pane fade" id="pic-2">
                    <img src="<?php echo $hinhsp; ?>">
                </div>
                <div class="tab-pane fade show active" id="pic-3">
                    <img src="<?php echo $hinhsp; ?>">
                </div>
            </div>

            <ul class="preview-thumbnail nav nav-tabs">
                <li class="nav-item active">
                    <a href="#pic-1" data-bs-toggle="tab" class="nav-link">
                        <img src="<?php echo $hinhsp; ?>">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#pic-2" data-bs-toggle="tab" class="nav-link">
                        <img src="<?php echo $hinhsp; ?>">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#pic-3" data-bs-toggle="tab" class="nav-link active">
                        <img src="<?php echo $hinhsp; ?>">
                    </a>
                </li>
            </ul>
        </div>

        <div class="details col-md-6">
            <h5 class="product-title text-danger"><?php echo !empty($tensp) ? $tensp : ''; ?></h5>
            <p class="product-description"><?php echo !empty($thongtinsp) ? $thongtinsp : ''; ?></p>

            <small class="text-muted">Giá cũ: <s><?php echo !empty($giacu) ? $giacu . ' vnd' : ''; ?></s></small>
            <h6 class="price">Giá hiện tại: <span><?php echo !empty($gianhap) ? $gianhap . ' vnd' : ''; ?></span></h6>

            <p class="vote"><strong>100%</strong> hàng <strong>Chất lượng</strong>, đảm bảo <strong>Uy tín</strong>!</p>

            <div class="input-group mb-3">
                <span class="input-group-text" for="quantity">Số lượng đặt mua</span>
                <input type="number" name="quantity" min="1" max="10" class="text-center"
                    value="<?php echo !empty($quantity) ? $quantity : '1'; ?>" />
            </div>

            <div class="action">
                <button class="btn btn-sm btn-danger mb-1" name="add_to_cart">Add To Cart</button>
            </div>

        <strong> 
            <input type="hidden" name="masp" value="<?php echo !empty($idsp) ? $idsp : ''; ?>" />
            <input type="hidden" name="tensp" value="<?php echo !empty($tensp) ? $tensp : ''; ?>" />
            <input type="hidden" name="hinhanh" value="<?php echo !empty($hinhsp) ? $hinhsp : ''; ?>" />
            <input type="hidden" name="price" value="<?php echo !empty($price) ? $price : ''; ?>" />
            <input type="hidden" name="type" value="addcart" />
            <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
        </strong>
    </div>
</form>
