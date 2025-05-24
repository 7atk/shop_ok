<?php
require_once('../libs/config.php');
$sql="SELECT count(*) as tongsp from sanpham";
$stmt = $conn->prepare($sql);
  $stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$tong=$result['tongsp'];

?>
<p>
    <?php
    echo $tong;
    ?>
</p>