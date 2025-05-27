<?php
include('../libs/common.php');
$errors = [];
$userid = $username = $email = $role = '';

// Load user data
if (isset($_POST['id_user']) || isset($_GET['id_user'])) {
    $id_user = $_POST['id_user'] ?? $_GET['id_user'];
    $sql = "SELECT * FROM users WHERE id_user = ?";
    $result = SelectAll($sql, [$id_user]); // Assuming SelectAll can handle prepared statements

    if ($result && count($result) > 0) {
        $row = $result[0];
        $userid = $row['id_user'];
        $username = $row['username'];
        $email = $row['email'];
        $role = $row['roles'];
    } else {
        $errors['id_user'] = 'Không tìm thấy người dùng';
    }
}

// Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ok'])) {
    $role = trim($_POST['id_role'] ?? '');
    if (!empty($userid) && is_numeric($role)) {
        $sql_update = "UPDATE users SET roles = ? WHERE id_user = ?";
        $id = Execute($sql_update, [$role, $userid]); // Assuming Execute handles prepared statements

        if ($id > 0) {
            echo "<script>alert('Update thành công'); location.href='list_user.php';</script>";
            exit;
        } else {
            echo "<div class='text-danger'>Cập nhật người dùng không thành công</div>";
        }
    } else {
        $errors['id_role'] = 'Chọn một chức vụ hợp lệ';
    }
}
?>
