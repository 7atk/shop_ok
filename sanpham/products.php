<?php
//include('libs/common.php'); //bên index.php đã khai báo rồi
if (isset($_GET['idlsp'])) { // Nếu có id loại sản phẩm
    $idlsp = $_GET['idlsp']; // Chống SQL Injection
    $sql = "SELECT 	masp	,tensp	,tenlsp,	mota,	hinhanh,	gia FROM SANPHAM s join loai_sp lsp on s.idlsp = lsp.idlsp WHERE s.idlsp = $idlsp"; // Lấy sản phẩm theo id loại sản phẩm
    
} else
 {   
$sql = "SELECT 	masp	,tensp	,tenlsp,	mota,	hinhanh,	gia FROM SANPHAM s join loai_sp lsp on s.idlsp = lsp.idlsp "; // Lấy tất cả sản phẩm

if (isset($_GET['idsp'])) { 
    $idsp = $_GET['idsp']; // Chống SQL Injection
    $sql .= " WHERE id = $idsp";}
}

$result = SelectAll($sql);
disconnect_db();

foreach ($result as $row) { 
    $idsp = $row['masp'] ?? '';  
    $tensp = htmlspecialchars($row['tensp'] ?? 'Không có tên');  
    $hinhsp = !empty($row['hinhanh']) ? "images/" . htmlspecialchars($row['hinhanh']) : "images/no-image.png";  
    $thongtinsp = htmlspecialchars($row['mota'] ?? 'Đang cập nhật thông tin sản phẩm');  
    $tenlsp = htmlspecialchars($row['tenlsp'] ?? '');
    $price = is_numeric($row['gia']) ? $row['gia'] : 0;
    $gianhap = number_format($price, 0);
    $giacu = number_format($price * 1.1, 0);
?>
    <div class="col-md-6 col-lg-4">
        <div class="card-box">
            <div class="card-thumbnail">
                <img class="img-fluid" src="<?php echo $hinhsp; ?>" alt="Hình ảnh sản phẩm" width="100%" height="100px" />
            </div>
            <form method="post" action="sanpham/add_to_cart.php" class="card-body">
                <h3 class="mt-2 text-danger">
                    <a href="index.php?page=product_detail&id=<?php echo htmlspecialchars($idsp); ?>">
                        <?php echo $tensp; ?>
                    </a>
                </h3>
                <p class="text-secondary"><?php echo $tenlsp; ?></p>
                    
               
                                  
                <p class="text-secondary"><?php echo $thongtinsp; ?></p>
                <small class="text-muted">Giá cũ: <s><span><?php echo $giacu; ?> vnd</span></s></small>
                <h6 class="price">Giá hiện tại: <span><?php echo $gianhap; ?> vnd</span></h6>
                <input type="number" name="quantity" min="1" max="10" value="1" class="text-center" />
                <button class="btn btn-sm btn-danger mb-1" name="add_to_cart">Add To Cart</button>
                <input type="hidden" name="masp" value="<?php echo htmlspecialchars($idsp); ?>" />
                <input type="hidden" name="tensp" value="<?php echo $tensp; ?>" />
                <input type="hidden" name="hinhsp" value="<?php echo $hinhsp; ?>" />
                <input type="hidden" name="price" value="<?php echo $price; ?>" />
                <input type="hidden" name="type" value="addcart" />
                <?php 
                    $return_url = base64_encode(urlencode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])); 
                ?>
                <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
                <a  href="index.php?page=product_detail&id=<?php echo htmlspecialchars($idsp); ?>">
                    <b class="btn link-info">Chi tiết</b>
                </a>
            </form>
        </div>
    </div>
<?php } ?>
