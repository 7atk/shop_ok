<?php
// include_once '../libs/config.php'; // Kết nối PDO

$search = isset($_GET['sanpham']) ? trim($_GET['sanpham']) : '';
$itemsPerPage = 8;
$currentPage = isset($_GET['p']) ? max(1, (int) $_GET['p']) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

if ($search !== '') {
    echo "<h2>Kết quả tìm kiếm cho: <i>" . htmlspecialchars($search) . "</i></h2>";

    try {
        // Đếm tổng số sản phẩm phù hợp
        $countStmt = $conn->prepare("SELECT COUNT(*) FROM sanpham WHERE tensp LIKE :keyword");
        $keyword = '%' . $search . '%';
        $countStmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $countStmt->execute();
        $totalItems = $countStmt->fetchColumn();
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Truy vấn sản phẩm theo trang
        $stmt = $conn->prepare("SELECT * FROM sanpham WHERE tensp LIKE :keyword LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            foreach ($results as $row) {
                // HIỂN THỊ SẢN PHẨM (giữ nguyên phần HTML của bạn ở đây)
                $idsp = $row['masp'] ?? '';
    $tensp = htmlspecialchars($row['tensp'] ?? 'Không có tên');
    $hinhsp = !empty($row['hinhanh']) ? "images/" . htmlspecialchars($row['hinhanh']) : "images/no-image.png";
    $thongtinsp = htmlspecialchars($row['mota'] ?? 'Đang cập nhật thông tin sản phẩm');
    $tenlsp = htmlspecialchars($row['tenlsp'] ?? '');
    $price = is_numeric($row['gia']) ? $row['gia'] : 0;
    $gianhap = number_format($price, 0);
    $giacu = number_format($price * 1.1, 0);
            }

            // Phân trang
           
        } else {
            echo "Không tìm thấy sản phẩm nào.";
        }
    } catch (PDOException $e) {
        echo "Lỗi truy vấn: " . $e->getMessage();
    }
} else {
    echo "Vui lòng nhập từ khóa tìm kiếm.";
}
?>
<div class="col-md-6 col-lg-3">
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
                <a href="index.php?page=product_detail&id=<?php echo htmlspecialchars($idsp); ?>">
                    <b class="btn link-info">Chi tiết</b>
                </a>
            </form>
        </div>
    </div>
<?php
  
            // Hiển thị phân trang
            echo '<div class="col-12 text-center pt-3">';
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage) {
                    echo "<strong>$i</strong> ";
                } else {
                    echo "<a href='index.php?page=search&sanpham=" . urlencode($search) . "&p=$i'>$i</a> ";
                }
            }
            echo '</div>';
        
    ?>

