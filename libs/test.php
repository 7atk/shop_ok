<?php
// Biến kết nối toàn cục
global $conn;

// Hàm kết nối database
function connect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    $servername = "sql213.infinityfree.com";
	//$servername="yddrytbq.infinityfree.com";
    $username = "if0_36206860";
    $password = "ychXyYP3ER98PDc";
    $dbname="if0_36206860_qlsp";    
    try{
        $conn = new PDO("mysql:host=$servername; dbname=$dbname; charset=utf8", $username, $password);
        // thiết lập lỗi PDO thành ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
       
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;     
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($conn){
        $conn = null;
    }
}
?>