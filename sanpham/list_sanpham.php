<?php
$sql = "SELECT id, masp, tensp, hinhanh, gia FROM sanpham";
$lists = SelectAll($sql);
$STT=0;
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