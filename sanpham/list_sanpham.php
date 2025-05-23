<?php

if(!isset($_SESSION['role'])||$_SESSION['role']==3){
    echo "<script>alert('Bạn không có quyền truy cập trang này!');</script>";{
        echo "<script>location.href='index.php';</script>"; 
    exit;
}}
else{
    $limit = 6; // Số sản phẩm mỗi trang
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $limit;

// Tổng số bản ghi
$stmt = $conn->query("SELECT COUNT(*) FROM sanpham");
$totalRecords = $stmt->fetchColumn();
$totalPages = ceil($totalRecords / $limit);

// Lấy dữ liệu theo trang
$stmt = $conn->prepare("SELECT id, masp, tensp, hinhanh, gia FROM sanpham LIMIT :start, :limit");
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
$STT = $start;
}
?>

<!-- HTML hiển thị -->
<div class="container">
    <div class="bg-white p-2 rounded shadow-sm">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <td>STT</td>
                    <td class="text-center">Mã</td>
                    <td>Tên Sp</td>
                    <td>Giá</td>
                    <td>Hình ảnh</td>
                    <td>Option</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lists as $item) { ?>
                    <tr>
                        <td><?php echo $STT=$STT+1  ?></td>
                        <td class="text-center"><?php echo $item['masp']; ?></td>
                        <td><?php echo $item['tensp']; ?></td>
                        <td><?php echo number_format($item['gia'], 0, ',', '.'); ?> đ</td>
                        <td><img src="images/<?php echo $item['hinhanh']; ?>" width="80" /></td>
                        <td>
                            <form method="post" action="sanpham/delete_sanpham.php">
                                <input type="hidden" name="masp" value="<?php echo $item['masp']; ?>" />

                                <input class="btn btn-sm btn-primary"
                                       type="button"
                                       value="Sửa"
                                       onclick="location.href='?page=edit_sanpham&masp=<?php echo $item['masp']; ?>'" />

                                <input class="btn btn-sm btn-danger"
                                       type="submit"
                                       name="delete"
                                       value="Xóa"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" />
                            </form>
                        <!-- <td>
                            <form method="post" action="sanpham/delete_sanpham.php">
                                <input type="hidden" name="id" value="<?php echo $item['idsp']; ?>" />

                                <input class="btn btn-sm btn-primary"
                                       type="button"
                                       value="Sửa"
                                       onclick="location.href='?page=edit_sanpham&idsp=<?php echo $item['idsp']; ?>'" />

                                <input class="btn btn-sm btn-danger"
                                       type="submit"
                                       name="delete"
                                       value="Xóa"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" />
                            </form>
                        </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=list_sanpham&p=<?php echo $page - 1; ?>">Trước</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=list_sanpham&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=list_sanpham&p=<?php echo $page + 1; ?>">Sau</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
