<?php


// --- Cấu hình phân trang ---
$limit = 12;
$page = isset($_GET['p']) ? max((int)$_GET['p'], 1) : 1;
$offset = ($page - 1) * $limit;


// --- Tạo điều kiện lọc ---    
$where = '';
$params = [];

if (isset($_GET['idlsp'])) {
    $where = ' WHERE s.idlsp = :idlsp ';
    $params[':idlsp'] = (int)$_GET['idlsp'];
} elseif (isset($_GET['idsp'])) {
    $where = ' WHERE s.id = :idsp ';
    $params[':idsp'] = (int)$_GET['idsp'];
}

// --- Lấy tổng số sản phẩm ---
$count_sql = "SELECT COUNT(*) AS total FROM sanpham s 
              JOIN loai_sp lsp ON s.idlsp = lsp.idlsp $where";
$stmt = $conn->prepare($count_sql);
$stmt->execute($params);
$total_rows = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages = ceil($total_rows / $limit);

// --- Truy vấn sản phẩm ---
$sql = "SELECT masp, tensp, tenlsp, hinhanh, gia 
        FROM sanpham s 
        JOIN loai_sp lsp ON s.idlsp = lsp.idlsp 
        $where 
        LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($sql);

// Gán tham số phân trang
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value, PDO::PARAM_INT);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Hiển thị sản phẩm ---
foreach ($result as $row) {
    $idsp = $row['masp'] ?? '';
    $tensp = htmlspecialchars($row['tensp'] ?? 'Không có tên');
    $hinhsp = !empty($row['hinhanh']) ? "images/" . htmlspecialchars($row['hinhanh']) : "images/no-image.png";
    // $thongtinsp = htmlspecialchars($row['mota'] ?? 'Đang cập nhật thông tin sản phẩm');
    $tenlsp = htmlspecialchars($row['tenlsp'] ?? '');
    $price = is_numeric($row['gia']) ? $row['gia'] : 0;
    $gianhap = number_format($price, 0);
    $giacu = number_format($price * 1.1, 0);
   
?>
    <div class="col-md-6 col-lg-2">
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
                <strong class="badge bg-success"><?php echo $tenlsp; ?></strong><br>
                <!-- <p class="text-secondary"><?php echo $thongtinsp; ?></p> -->
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
                <a href="index.php?page=product_detail&id=<?php echo htmlspecialchars($idsp); ?>">
                    <b class="btn link-info">Chi tiết</b>
                </a>
            </form>
        </div>
    </div>
<?php
} // end foreach

// --- Hiển thị phân trang ---


echo '<div class="col-12 text-center pt-3"><nav><ul class="pagination justify-content-center">';

for ($i = 1; $i <= $total_pages; $i++) {
    $params_url = "page=products&p=$i";
    if (isset($_GET['idlsp'])) {
        $params_url .= "&idlsp=" . (int)$_GET['idlsp'];
    }

    $active_class = ($i == $page) ? 'active' : '';
    echo "<li class='page-item $active_class'><a class='page-link' href='index.php?$params_url'>$i</a></li>";
}

echo '</ul></nav></div>';
?>



