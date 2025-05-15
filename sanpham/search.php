<?php
 $connect = mysqli_connect('localhost','root','','game_store') or die("Không thể kết nối đến database");
	mysqli_set_charset($connect,"utf8");

// Nhận từ khóa tìm kiếm
$query = isset($_POST['search']) ? trim($_GET['search']) : '';

if ($query != '') {
    // Chống SQL injection bằng prepared statements
    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE name LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2>Kết quả tìm kiếm cho: <i>" . htmlspecialchars($query) . "</i></h2>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div style='border:1px solid #ccc; margin:10px; padding:10px;'>";
            echo "<img src='" . $row["image_url"] . "' width='100'><br>";
            echo "<strong>" . htmlspecialchars($row["name"]) . "</strong><br>";
            echo "Giá: " . number_format($row["price"]) . " VNĐ<br>";
            echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
            echo "</div>";
        }
    } else {
        echo "Không tìm thấy sản phẩm nào.";
    }

    $stmt->close();
} else {
    echo "Vui lòng nhập từ khóa tìm kiếm.";
}

$conn->close();
?>
