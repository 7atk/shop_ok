<?php
if (!isset($_SESSION))
	session_start();
if (!isset($_SESSION["username"]))
	$link = '<a href="index.php?page=login" class="nav-item nav-link">Log in</a>';
else
	$link = '<a href="index.php?page=logout" class="nav-item nav-link">Log Out</a>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Games store team 19</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">

	<link href="css/card-box.css" rel="stylesheet">
	<link href="css/product-detail.css" rel="stylesheet">
	
</head>

<body>
	<header>
		<?php include('header.php')?>
	</header>
	<main>
		<?php
		$page="";
		$idsp="";
		try {
			//error_reporting(E_ALL & ~E_NOTICE);
			if(!empty($_GET["page"]) || !empty($_REQUEST["id"])){
				$page = $_GET["page"]; 
			}
			else
				$page = "products";
				if( !empty($_REQUEST["id"]))
					$idsp = $_REQUEST["id"];
			$title = "";
			if ($page == "products" || !isset($page)) //nếu ko có id thì hiển thị trang index		
			{
				$page = "sanpham/products";
				$title = 'DANH SÁCH SẢN PHẨM';
				
			} else {
				if ($page == "list_sanpham") {
					$page = "sanpham/list_sanpham";
					$title = "DANH SÁCH SẢN PHẨM";
				}				
				if ($page == "add_sanpham") {
					$page = "sanpham/add_sanpham";
					$title = "THÊM MỚI SẢN PHẨM";
				}
				if ($page == "cart") {
					$page = "sanpham/cart";
					$title = "QUẢN LÝ GIỎ HÀNG";
				}
				if ($page == "checkout") {
					$page = "payment/checkout";
					$title = "THANH TOÁN";
				}
				
				
				// if ($page == "cadd_to_cart") {
				// 	$page = "sanpham/add_to_cart";
				// 	$title = "QUẢN LÝ GIỎ HÀNG cart_update";
				// }
				// if ($page == "uc_checkout") {
				// 	$page = "sanpham/uc_checkout";
				// 	$title = "ĐẶT HÀNG VÀ THANH TOÁN";
				// }
				if ($page == "search") {
					$page = "sanpham/search";
					$title = "DANH SÁCH SẢN PHẨM TÌM THẤY";
				}
				if ($page == "login") {
					$page = "login/login";
					$title = "ĐĂNG NHẬP TÀI KHOẢN";
					
				}
				if ($page == "resetPassword") {
					$page = "login/resetPassword";
					$title = "ĐẶT LẠI MẬT KHẨU";
					
					
				}
				if ($page == "delete_cart") {
					$page = "sanpham/delete_cart";
					$title = "XÓA SẢN PHẨM TRONG GIỎ HÀNG";
					
					
					
				}
				if (isset($idsp) && isset($page)) //trên URL có mã sp truyền qua
				{
					if ($page == "product_detail") {
						$page = "sanpham/product_detail";
						$title = "CHI TIẾT SẢN PHẨM";
					}
					if ($page == "edit_sanpham") {
						$page = "sanpham/edit_sanpham";
						$title = "CẬP NHẬT SẢN PHẨM";
					}
				}
				if ($page == "register") {
					$page = "login/register";
					
					$title = "ĐĂNG KÝ TÀI KHOẢN";
				}
			}
			$page = $page . '.php'; //nối đuôi .php vào
			//echo $page;
		} catch (Exception $e) {
			echo "</br>" . $e->getMessage();
		}
		?>
		<div class="container-fluid">
			<div class="col-12 badge bg-secondary text-start  ">
				<h5 class="text-white pt-2"> <?php echo $title; ?> </h5>
			</div>
			<div class="row">
				<?php include($page); ?>
			</div>
		</div>
	</main>
	<footer class="footer pt-1" >
	<?php 
		include('footer.php');
		?> 	
	
  </footer>
</footer>
	</footer>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery-3.4.1.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</body>

</html>