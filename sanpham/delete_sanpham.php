<?php
session_start(); 
include ('../libs/common.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $idsp = intval($_POST['id']);

    try {
        $sql = "DELETE FROM SAN_PHAM WHERE IDSP = :idsp";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":idsp", $idsp, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Error";
        }
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
} else {
    echo "invalid";
}
?>
