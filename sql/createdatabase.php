<?php
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "SHOPEE";    //Tạo CSDL chưa có trong Database
try
{
    $conn = new PDO("mysql:host=$servername;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS SHOPEE 
            CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'    
    ";
    //$sql="DROP DATABASE SHOPEE";
    // use exec() because no results are returned
    $conn->exec($sql);    
    echo "Database SHOPEE created successfully<br>";
}
catch(PDOException $e){
    echo "<br>" . $e->getMessage();
}
$conn = null;
?>