<?php
include('../libs/config.php'); // Khởi tạo $conn (PDO)
$errors = [];
$userid = $username = $email = $role = '';

// Load user data
if (isset($_POST['id_user'])) {
    $id_user = $_POST['id_user'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $userid = $result['id_user'];
        $username = $result['username'];
        $email = $result['email'];
        $id_role=$result['roles'];
     
    }
}

// Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ok'])) {
    $role = trim($_POST['id_role'] ?? '');
    
        $stmt = $conn->prepare("UPDATE users SET roles = ? WHERE username = ?");
        $success = $stmt->execute([$role, $username]);
       if($success>0){
        echo "<script>alert('Update thành công'); location.href='list_user.php';</script>";
            exit;
        } else {
            echo "<div class='text-danger'>Cập nhật người dùng không thành công</div>";
        }
       }
        

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3 rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="../admin/dashboard.php">Admin - User</a>
    </div>
</nav>
<div class="container">
    <h3 class="mb-4">Cập nhật vai trò người dùng</h3>
    <form method="post">
        <input type="hidden" name="id_user" value="<?= htmlspecialchars($userid) ?>">
        <div class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label class="form-label">Tên người dùng:</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($username) ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" value="<?= htmlspecialchars($email) ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Vai trò:</label>
                <select class="form-select btn-warning text-start" name="id_role">
                    <option value="">-- Chọn vai trò --</option>
                    <?php
                    $sql = "SELECT id_role, ten_role FROM roles";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($result)) {
                       foreach ($result as $item) {
                                    $selected = (!empty($id_role) && $id_role == $item['id_role']) ? "selected" : "";
                                    echo "<option value='{$item['id_role']}' $selected>{$item['ten_role']}</option>";
                                }
                    }
                    ?>
                </select>
                <?php if (!empty($errors['id_role'])): ?>
                    <div class="text-danger"><?= $errors['id_role'] ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <button type="submit" name="ok" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
