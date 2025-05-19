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
		<div class="container ">
			<div class="row">
				<div class="col-12">
					<!-- Carousel -->
					<div id="demo" class="carousel slide" data-bs-ride="carousel">
						<!-- Indicators/dots -->
						<div class="carousel-indicators">
							<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
							<button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
						</div>
						<!-- The slideshow/carousel -->
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="https://as2.ftcdn.net/v2/jpg/05/20/20/63/1000_F_520206342_nwqo1KdEVukRtUvNdhYr762CTH6FXfAO.jpg" height="200px" class="d-block w-100">
								<div class="carousel-caption">
									<h3>One day gamer whole life gamers</h3>
									<p>We have every fucking games you want You just search it </p>
								</div>
							</div>
							<div class="carousel-item">
								<img src="https://as1.ftcdn.net/v2/jpg/02/77/99/06/1000_F_277990656_yaQ85EN20Wx3WUH2pJD57yHJOe5kluOa.jpg" height="200px" class="d-block w-100">
								<div class="carousel-caption">
								<h3>No.1 Game store on world</h3>
									<p>Best Place for who is gamer</p>
								</div>
							</div>							
						</div>
						<!-- Left and right controls/icons -->
						<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
							<span class="carousel-control-prev-icon"></span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
							<span class="carousel-control-next-icon"></span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded ">
				<a class="navbar-brand px-2" href="index.php"><img src="https://store.cloudflare.steamstatic.com/public/shared/images/header/logo_steam.svg?t=962016" alt="" width=100px></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynbar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mynbar">
					<ul class="navbar-nav me-auto">						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="http://localhost/shop_ok/admin/dashboard.php" id="navbarDropdownsp" role="button" 
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quản Lý </a>
							<div class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdownsp">								
								<a class="dropdown-item" href="index.php?page=list_sanpham">List sản phẩm</a>
								<a class="dropdown-item" href="index.php?page=add_sanpham">Thêm sản phẩm</a>
							</div>
						</li>
						<!-- <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownkm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Khuyến mãi </a>
							<div class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdownkm">
								<a class="dropdown-item" href="sony.php">Giáng Sinh</a>
								<a class="dropdown-item" href="samsung.php">Lễ Độc Thân</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="sanpham.php">Tết âm lịch</a>
								<a class="dropdown-item" href="vietnhat.php">Tết dương lịch</a>
							</div>
						</li> -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownkm" role="button" 
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thể loại sản phẩm</a>
							<div class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdownkm">
								<?php include('libs/common.php');
									$select="SELECT IDLSP,tenlsp FROM LOAI_SP";
									$list=SelectAll($select);
									foreach ($list as $row) {
										echo '<a class="dropdown-item" href="index.php?page=products&idlsp='.$row['IDLSP'].'">'.$row['tenlsp'].'</a>';
									}									
								?>
							</div>
						</li>
						<!-- <li class="nav-item text-nowrap">
							<a class="nav-link" href="#">Bảo hành</a>
						</li>
						<li class="nav-item text-nowrap">
							<a class="nav-link" href="http://localhost/shop_ok/admin/dashboard.php">Quản Lý</a>
						</li> -->
					</ul>
					<div class="navbar-nav">
						<?php echo $link; ?>
						<a href="index.php?page=cart" class="nav-item nav-link text-nowrap">
							Giỏ hàng <span class="badge bg-danger">
								<?php
									if(isset($_SESSION['cart'])){
										$count= $_SESSION['cart'];
										echo count($count);
									}
									else echo "0";
									?>
								</span>
						</a>
					</div>
					<!-- <form method="post" action="index.php?page=search" class="d-flex px-2">
						<?php $data['search'] = isset($_POST['search']) ? $_POST['search'] : '';
						$search = addslashes($data['search']); ?>
						<input class="form-control me-2" type="search" name='search' placeholder="Search" 
						value="<?php echo !empty($search) ? $search : ''; ?>">
						<button class="btn btn-primary ">Search</button>
					</form> -->
					<form method="get" action="index.php" class="d-flex px-2">
    
                          <input type="hidden" name="page" value="search">

                            <!-- <?php
   
                               $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
                             ?> -->

                        <input class="form-control me-2" type="search" name="sanpham" placeholder="Search"
                            	 value="<?php echo $search; ?>">

                              <button class="btn btn-primary">Search</button>
</form>

					
				</div>
			</nav>
		</div>
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
				if ($page == "resgister") {
					$page = "login/resgister";
					
					$title = "ĐĂNG KÝ TÀI KHOẢN";
				}
			}
			$page = $page . '.php'; //nối đuôi .php vào
			//echo $page;
		} catch (Exception $e) {
			echo "</br>" . $e->getMessage();
		}
		?>
		<div class="container">
			<div class="col-12 badge bg-secondary text-start ">
				<h5 class="text-white pt-2"> <?php echo $title; ?> </h5>
			</div>
			<div class="row">
				<?php include($page); ?>
			</div>
		</div>
	</main>
	<footer class="footer pt-1">
	<?php 
		include('footer.php');
		?> 	
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