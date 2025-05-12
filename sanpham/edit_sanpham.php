<?php
$errors = [];
if(!isset($_GET['masp'])) {
    echo "<script>alert('Không có mã sản phẩm'); location.href='index.php?page=list_sanpham';</script>";
    exit;
}
$idsp = $_GET['masp'] ;
$sql = "SELECT masp, tensp, mota, hinhanh, gia,slnhap,slban FROM sanpham s   WHERE masp='$idsp'";
$result = SelectAll($sql);
foreach ($result as $row) {
    $idsp = $row['masp'] ?? '';  
    $tensp = htmlspecialchars($row['tensp'] ?? 'Không có tên');  
    
    $hinhsp = !empty($row['hinhanh']) ? "images/" . htmlspecialchars($row['hinhanh']) : "images/no-image.png";  
    $thongtinsp = htmlspecialchars($row['mota'] ?? 'Đang cập nhật thông tin sản phẩm');  
    $gia = is_numeric($row['gia']) ? $row['gia'] : 0;
    $slnhap = htmlspecialchars($row['slnhap'] ?? '');
    $slban = htmlspecialchars($row['slban'] ?? '');

   
}
if (!empty($_POST['ok'])) {
    $path = 'images/';
    if (isset($_FILES['infile']) && $_FILES['infile']['error'] == 0) {
        $fileTmp = $_FILES['infile']['tmp_name'];
        $fileName = basename($_FILES['infile']['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExt, $allowed)) {
            $tenfile = uniqid('img_') . '.' . $fileExt;
            move_uploaded_file($fileTmp, $path . $tenfile);
        } else {
            $errors['file'] = "<span style='color:red;'>File không hợp lệ. Chỉ chấp nhận JPG, PNG, GIF.</span>";
        }
    } else {
        $errors['file'] = "<span style='color:red;'>Chưa chọn hình</span>";
    }

    // Lấy dữ liệu từ POST
    $idsp = trim($_POST['idsp'] ?? '');
    $tensp = trim($_POST['tensp'] ?? '');
    $idloai = trim($_POST['idloai'] ?? '');
    $gia = trim($_POST['gia'] ?? '');
    $ttsp = trim($_POST['ttsp'] ?? '');
    $slnhap = trim($_POST['slnhap'] ?? '');
    $slban = trim($_POST['slban'] ?? '');

    if (empty($idsp)) $errors['idsp'] = "<span style='color:red;'>Chưa nhập mã sản phẩm</span>";
    if (empty($tensp)) $errors['tensp'] = "<span style='color:red;'>Chưa nhập tên sản phẩm</span>";
    if (empty($gia) || !is_numeric($gia)) $errors['gia'] = "<span style='color:red;'>Giá không hợp lệ</span>";
    if (empty($idloai)) $errors['idloai'] = "<span style='color:red;'>Chưa chọn loại sản phẩm</span>";
    if (empty($ttsp)) $errors['ttsp'] = "<span style='color:red;'>Chưa nhập thông tin sản phẩm</span>";
    if (empty($slnhap) || !is_numeric($slnhap)) $errors['slnhap'] = "<span style='color:red;'>Số lượng không hợp lệ</span>";
    if (empty($slban) || !is_numeric($slban)) $errors['slban'] = "<span style='color:red;'>Số lượng không hợp lệ</span>";

    if (!$errors) {
        $sql_update = "UPDATE sanpham SET  masp  ='$idloai', tensp='$tensp', hinhanh='$tenfile', mota='$ttsp', gia='$gia',slnhap='$slnhap',slban='$slban' WHERE IDSP='$idsp'";
                       
        $id = Execute($sql_update); // Execute() phải là hàm bạn đã định nghĩa để thực thi câu SQL

        if ($id > 0) {
            echo "<script>alert('Update thành công'); location.href='index.php?page=list_sanpham';</script>";
        } else {
            echo "<div class='text-danger'>Cập nhật sản phẩm không thành công</div>";
        }
    }
}   
    




// $errors = [];
// $tenfile = '';
// $data = [];

// if (!empty($_POST['ok'])) {
//     $path = 'images/';
//     if (isset($_FILES['infile']) && $_FILES['infile']['error'] == 0) {
//         $fileTmp = $_FILES['infile']['tmp_name'];
//         $fileName = basename($_FILES['infile']['name']);
//         $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
//         $allowed = ['jpg', 'jpeg', 'png', 'gif'];

//         if (in_array($fileExt, $allowed)) {
//             $tenfile = uniqid('img_') . '.' . $fileExt;
//             move_uploaded_file($fileTmp, $path . $tenfile);
//         } else {
//             $errors['file'] = "<span style='color:red;'>File không hợp lệ. Chỉ chấp nhận JPG, PNG, GIF.</span>";
//         }
//     } else {
//         $errors['file'] = "<span style='color:red;'>Chưa chọn hình</span>";
//     }

//     // Lấy dữ liệu từ POST
//     $idsp = trim($_POST['idsp'] ?? '');
//     $tensp = trim($_POST['tensp'] ?? '');
//     $idloai = trim($_POST['idloai'] ?? '');
//     $gia = trim($_POST['gia'] ?? '');
//     $ttsp = trim($_POST['ttsp'] ?? '');

//     if (empty($idsp)) $errors['idsp'] = "<span style='color:red;'>Chưa nhập mã sản phẩm</span>";
//     if (empty($tensp)) $errors['tensp'] = "<span style='color:red;'>Chưa nhập tên sản phẩm</span>";
//     if (empty($gia) || !is_numeric($gia)) $errors['gia'] = "<span style='color:red;'>Giá không hợp lệ</span>";
//     if (empty($idloai)) $errors['idloai'] = "<span style='color:red;'>Chưa chọn loại sản phẩm</span>";

//     if (!$errors) {
//         $sql_insert = "INSERT INTO san_pham (IDSP, IDLSP, TENSP, HINHSP, THONGTINSP, gia)
//                        VALUES ('$idsp', '$idloai', '$tensp', '$tenfile', '$ttsp', '$gia')";
//         $id = Execute($sql_insert); // Execute() phải là hàm bạn đã định nghĩa để thực thi câu SQL

//         if ($id > 0) {
//             echo "<script>alert('Thêm thành công'); location.href='index.php?page=list_sanpham';</script>";
//         } else {
//             echo "<div class='text-danger'>Thêm sản phẩm không thành công</div>";
//         }
//     }
// }
// ?>

<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="bg-info p-3 rounded shadow-sm">
            <table class="table table-hover table-striped">
                <tr>
                    <td>Mã sản phẩm:</td>
                    <td>
                        <input name="idsp" type="text" class="form-control"
                               value="<?= htmlspecialchars($idsp ?? '') ?>" readonly />
                        <?php if (!empty($errors['idsp'])): ?>
                            <div class="text-danger"><?= $errors['idsp'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Loại sản phẩm:</td>
                    <td>
                        <select class="form-select btn-warning text-start" name="idloai">
                            <option value="" selected>Loại sản phẩm</option>
                            <?php
                            $sql = "SELECT IDLSP, tenlsp FROM LOAI_SP";
                            $result = SelectAll($sql);
                            if (!empty($result)) {
                                foreach ($result as $item) {
                                    $selected = (!empty($idloai) && $idloai == $item['IDLSP']) ? "selected" : "";
                                    echo "<option value='{$item['IDLSP']}' $selected>{$item['tenlsp']}</option>";
                                }
                            }
                            ?>
                        </select>
                        <?php if (!empty($errors['idloai'])): ?>
                            <div class="text-danger"><?= $errors['idloai'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Tên sản phẩm:</td>
                    <td>
                        <input name="tensp" type="text" required class="form-control"
                               value="<?= htmlspecialchars($tensp ?? '') ?>" />
                        <?php if (!empty($errors['tensp'])): ?>
                            <div class="text-danger"><?= $errors['tensp'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh sản phẩm:</td>
                    <td>
                        <label for="formFileLg" class="form-label text-primary">
                            <?= !empty($tenfile) ? $tenfile : 'Chọn ảnh sản phẩm' ?>
                        </label>
                        <input class="form-control form-control-lg" name="infile" type="file"
                               accept=".jpg,.gif,.png" />
                        <?php if (!empty($errors['file'])): ?>
                            <div class="text-danger"><?= $errors['file'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Thông tin:</td>
                    <td>
                        <textarea name="ttsp" class="form-control" rows="4"><?= htmlspecialchars($thongtinsp ?? '') ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá nhập:</td>
                    <td>
                        <input name="gia" type="text" required id="gia" class="form-control"
                               value="<?= htmlspecialchars($gia ?? '') ?>" />
                        <?php if (!empty($errors['gia'])): ?>
                            <div class="text-danger"><?= $errors['gia'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>sl nhập:</td>
                    <td>
                        <input name="slnhap" type="text" required id="slnhap" class="form-control"
                               value="<?= htmlspecialchars($slnhap ?? '') ?>" />
                        <?php if (!empty($errors['slnhap'])): ?>
                            <div class="text-danger"><?= $errors['slnhap'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>sl sold:</td>
                    <td>
                        <input name="slban" type="text" required id="slnban" class="form-control"
                               value="<?= htmlspecialchars($slban ?? '') ?>" />
                        <?php if (!empty($errors['slban'])): ?>
                            <div class="text-danger"><?= $errors['slban'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-primary" type="submit" name="ok" value="Update product" />
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>
