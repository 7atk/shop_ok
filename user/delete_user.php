<?php
session_start(); 
include ('../libs/common.php');
global $connect;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_user'])) {
    // $idsp = intval($_POST['masp']); // Chống SQL Injection
    $id_user =trim( $_POST['id_user']);
    
    $sql = "DELETE FROM users WHERE id_user = '$id_user'";
    $conn->exec($sql);
    header("Location: ../user/list_user.php");
    
        

   
// }
}
?>