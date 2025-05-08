<?php session_start();  
if (isset($_SESSION['username'])){
    unset($_SESSION['username']); // xóa session login
}
if (isset($_SESSION['role'])){
    unset($_SESSION['role']); // xóa session login
}
    echo "<script>location.href='index.php';</script>"; 
?>
