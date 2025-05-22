<div class="container-fluid ">
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
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded ">
				<a class="navbar-brand px-2" href="index.php"><img src="images/logo.PNG" alt="" width=100px></a>
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
					<
					<div class="navbar-nav" style="color:white">
						<?php if(isset($_SESSION['username'] ))
						 echo $_SESSION['username'];     ?>
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