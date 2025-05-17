<?php
$servername = "localhost";
$username = "root";
$password = "";
$databse = "game_store";

// Create connection
$connect = new mysqli($servername, $username, $password,$databse);

// Check connection
// if ($connect->connect_error) {
//   die("Connection failed: " . $connect->connect_error);
// }
// echo "Connected successfully";
?>