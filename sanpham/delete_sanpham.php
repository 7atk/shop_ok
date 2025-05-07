<?php
session_start(); 
include ('../libs/common.php');
global $connect;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['masp'])) {
    // $idsp = intval($_POST['masp']); // Chống SQL Injection
    $idsp =trim( $_POST['masp']);
    
    $sql = "DELETE FROM sanpham WHERE masp = '$idsp'";
    $conn->exec($sql);
    header("Location: ../index.php?page=list_sanpham");
    
        

   
// }
}
?>
