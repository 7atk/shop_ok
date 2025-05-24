<?php
require_once('../libs/config.php');
$sql="SELECT count(*) as tonguser from users";
$stmt = $conn->prepare($sql);
  $stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$tong=$result['tonguser'];

?>
<p>
    <?php
    echo $tong;
    ?>
</p>