<?php
// Gọi tới biến toàn cục $conn
global $conn;

$servername = "localhost";
$username = "admin123";
$password = "admin123";
$dbname = "admin123";

/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopee";
*/
$conn = new PDO("mysql:host=$servername; dbname=$dbname; charset=utf8", $username, $password);
// thiết lập lỗi PDO thành ngoại lệ
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($conn) {
        $conn = null;
    }
}
