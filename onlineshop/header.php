<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Online Shopping </title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/accountbtn.css" />

	<!-- jqeury -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="actions.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	<style>
	</style>

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">

				<ul class="header-links pull-right">
					<li><?php
						include "db.php";

						if (isset($_SESSION["uid"])) {
							$sql = "SELECT first_name FROM user_info WHERE user_id='$_SESSION[uid]'";
							$query = mysqli_query($con, $sql);
							$row = mysqli_fetch_array($query);
							#profile
							echo '
                               <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> Chào ' . $row["first_name"] . '</a>
                                  <div class="dropdownn-content">
                                    <a href="profile.php"><i class="fa fa-user-circle" aria-hidden="true" ></i>Thông tin</a>
                                    <a href="logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Đăng xuất</a>
                                    
                                  </div>
                                </div>';
						} else {
							echo '
                                <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> Tài khoản</a>
                                  <div class="dropdownn-content">
                                    <a href="" data-toggle="modal" data-target="#Modal_login"><i class="fa fa-sign-in" aria-hidden="true" ></i>Đăng nhập</a>
                                    <a href="" data-toggle="modal" data-target="#Modal_register"><i class="fa fa-user-plus" aria-hidden="true"></i>Đăng ký</a>
                                    
                                  </div>
                                </div>';
						}
						?>

					</li>
				</ul>

			</div>
		</div>
		<!-- /TOP HEADER -->



		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="#" class="logo">
								<font style="font-style:normal; font-size: 33px;color: aliceblue;font-family: serif">
									Online Shop
								</font>

							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form action="./store.php" method="get">
								<select class="input-select">
									<option value="0">Tất cả</option>
									<option value="1">Điện thoại</option>
									<option value="1">Phụ kiện</option>
								</select>
								<input class="input" name="search" id="search" type="text" placeholder="Tìm kiếm">
								<button type="submit" id="search_btn" class="search-btn">Tìm kiếm</button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">


							<!-- Cart -->
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Giỏ hàng</span>
									<div class="badge qty" id="cart-count">
										<?php
										$count = 0;
										if (isset($_SESSION['cart'])) {
											foreach ($_SESSION["cart"] as $id => $quantity) {
												$count += 1;
											}
										}
										echo $count;
										?>
									</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list" id="cart_product">


									</div>

									<div class="cart-btns">
										<a href="cart.php" style="width:100%;"><i class="fa fa-edit"></i> edit cart</a>

									</div>
								</div>

							</div>
							<!-- /Cart -->

							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->
	<nav id='navigation'>
		<!-- container -->
		<div class="container" id="get_category_home">
			<div id='responsive-nav'>
				<!-- NAV -->
				<ul class='main-nav nav navbar-nav'>
					<li class='active'><a href='index.php'>Trang chủ</a></li>
					<li><a href='store.php?page=1'>Mua sắm</a></li>
					<li><a href='store.php?page=1'>Giảm giá</a></li>
				</ul>
			</div>
			<!-- responsive-nav -->
		</div>
		<!-- /container -->
	</nav>


	<!-- NAVIGATION -->

	<div class="modal fade" id="Modal_login" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>
				<div class="modal-body">
					<?php
					include "login_form.php";

					?>

				</div>

			</div>

		</div>
	</div>
	<div class="modal fade" id="Modal_register" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class=" modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>
				<div class="modal-body">
					<?php
					include "register_form.php";

					?>

				</div>

			</div>

		</div>
	</div>