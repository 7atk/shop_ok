<?php
include('../libs/common.php');

if(isset($_POST['id_user']))
$id_user=$_POST['id_user'];
$sql="SELECT * from users where id_user =$id_user ";
$result=SelectAll($sql);
foreach($result as $row)
$userid=$row['id_user'];
$username=$row['username'];
$email=$row['email'];
if (!empty($_POST['ok']))
$role=trim($_POST['id_role']);
$sql_update="UPDATE Users set roles =$role where id_user=$userid";

$id = Execute($sql_update); // Execute() phải là hàm bạn đã định nghĩa để thực thi câu SQL
        if ($id > 0) {
            echo "<script>alert('Update thành công'); location.href='list_user.php';</script>";
        } else {
            echo "<div class='text-danger'>Cập nhật sản phẩm không thành công</div>";
        }

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="bg-info p-3 rounded shadow-sm">
            <table class="table table-hover table-striped">
                <tr>
                    <td>ID-user:</td>
                    <td>
                        <input name="id_user" type="text" class="form-control"
                               value="<?= htmlspecialchars($userid ?? '') ?>" readonly />
                        <?php if (!empty($errors['id_user'])): ?>
                            <div class="text-danger"><?= $errors['id_user'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                  <tr>
                    <td>username:</td>
                    <td>
                        <input name="username" type="text" required class="form-control"
                               value="<?= htmlspecialchars($username ?? '') ?>" readonly />
                        <?php if (!empty($errors['username'])): ?>
                            <div class="text-danger"><?= $errors['username'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                 <tr>
                    <td>Emai:</td>
                    <td>
                        <input name="email" type="text" required class="form-control"
                               value="<?= htmlspecialchars($email ?? '') ?>" readonly />
                        <?php if (!empty($errors['email'])): ?>
                            <div class="text-danger"><?= $errors['email'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Roles:</td>
                    <td>
                        <select class="form-select btn-warning text-start" name="id_role">
                            <option value="" selected>Chức Vụ</option>
                            <?php
                            $sql = "SELECT id_role, ten_role FROM roles";
                            $result = SelectAll($sql);
                            if (!empty($result)) {
                                foreach ($result as $item) {
                                    $selected = (!empty($idloai) && $idloai == $item['id_role']) ? "selected" : "";
                                    echo "<option value='{$item['id_role']}' $selected>{$item['ten_role']}</option>";
                                }
                            }
                            ?>
                        </select>
                        <?php if (!empty($errors['id_role'])): ?>
                            <div class="text-danger"><?= $errors['id_role'] ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                 <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-primary" type="submit" name="ok" value="Update User" />
                    </td>
                </tr>
    </table>
        </div>
    </form>
                        </div>