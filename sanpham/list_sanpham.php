<?php
$sql = "SELECT idsp, tensp, hinhsp, thongtinsp, gianhap FROM SAN_PHAM";
$lists = SelectAll($sql);
?>

<!-- HTML hiển thị -->
<div class="container">
    <div class="bg-white p-2 rounded shadow-sm">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
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
                        <td class="text-center"><?php echo $item['idsp']; ?></td>
                        <td><?php echo $item['tensp']; ?></td>
                        <td><?php echo number_format($item['gianhap'], 0, ',', '.'); ?> đ</td>
                        <td><img src="images/<?php echo $item['hinhsp']; ?>" width="80" /></td>
                        <td>
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
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>