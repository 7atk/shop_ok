<?php

include_once '../libs/config.php';

    $limit = 6; // Số sản phẩm mỗi trang
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $limit;

// Tổng số bản ghi
$stmt = $conn->query("SELECT COUNT(*) FROM users");
$totalRecords = $stmt->fetchColumn();
$totalPages = ceil($totalRecords / $limit);

// Lấy dữ liệu theo trang
$stmt = $conn->prepare("SELECT id_user, username,email,roles FROM users LIMIT :start, :limit");
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
$STT = $start;

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-1 rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin - User</a>
    </div>
</nav>
<body class="bg-light">
    <h3 class="mb-4">Danh sách User</h3>
<!-- HTML hiển thị -->
<div class="container">
    <div class="bg-white p-2 rounded shadow-sm">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <td>STT</td>
                    <td class="text-center">Tên đăng nhập</td>
                    <td>Email</td>
                    <td>Quyền</td>
                    <td>Option</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lists as $item) { ?>
                    <tr>
                        <td><?php echo $item['id_user']  ?></td>
                        <td class="text-center"><?php echo $item['username']; ?></td>
                        <td><?php echo $item['email']; ?></td>
                        <td>
                            <?php
                            if ($item['roles'] == 1) {
                                echo "Admin";
                            } else {
                                echo "Người dùng";
                            }
                            ?>
                        <td>
                            <form method="post" action="user/delete_user.php">
                                <input type="hidden" name="id_user" value="<?php echo $item['id_user']; ?>" />

                                <input class="btn btn-sm btn-primary"
                                       type="button"
                                       value="Sửa"
                                       onclick="location.href='?page=edit_user&id_user=<?php echo $item['id_user']; ?>'" />

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
                    <a class="page-link" href="?page=list_user&p=<?php echo $page - 1; ?>">Trước</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=list_user&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=list_user&p=<?php echo $page + 1; ?>">Sau</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
</body>
</html>