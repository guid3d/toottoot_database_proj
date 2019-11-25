
<!DOCTYPE html>
<?php
// session_start();
include('connect.php');
?>

<?php

$wrongpassword = 0;
if (isset($_GET['logout']) && $_GET['logout'] == 'logout') {
	session_start();
	session_destroy();
}

if (isset($_POST['username']) && isset($_POST['passwd'])) {
	$uu = trim($_POST['username']);
	$pp = trim($_POST['passwd']);
	if (strlen($uu) > 0 && strlen($pp) > 0) {
		include('connect.php');
		$q = 'SELECT * FROM test2 WHERE username LIKE "' . $uu . '" and password LIKE "' . $pp . '"';
		//   echo $q;
		if ($res = $conn->query($q)) {
			$row = $res->fetch_array();
			//  var_dump($row);
			if ($row && isset($row['username'])) {
				session_start();
				
				$_SESSION['user'] = $row;
				$_SESSION['id'] = $row['typeid'];
				$_SESSION['role'] = $row['role'];
				var_dump($_SESSION);
				if ($row['role']  == "dev") {
					// header("Location: devlogin.php");
				} else if ($row['role']  == "admin") {
					header("Location: adminlogin.php");
				} else if ($row['role']  == "user") {
					header("Location: index.php");
				}
			} else {
				$wrongpassword = 1;
			}
		} else {
			$wrongpassword = 1;
		}
	} else {
		$wrongpassword == 1;
	}
	
}
if ($wrongpassword == 1) echo "wrong username or password"; ?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>TOOTOOT</title>

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

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-phone"></i> 012-345-6789</a></li>
					<li><a href="#"><i class="fa fa-envelope-o"></i> databaseproj@email.com</a></li>
					<li><a href="#"><i class="fa fa-map-marker"></i> 99 Moo 18 Paholyothin Road, Klong Luang, Pathumthani 12121 THAILAND</a></li>
				</ul>

				<form action="index.php" method="post" style="float:right;">
					<input class="input" type="text" name="username" placeholder="Username" style="width: 150px;">
					<input class="input" type="password" name="passwd" placeholder="Password" style="width: 150px;">
					<input type="submit" name="login" value="Login">
					<a href="register.php" style="text-decoration:underline">Create account?</a>
				</form>
				<?php
				if ($wrongpassword == 1) {
					echo '<div>Worng Password</div>';
				}
				?>
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
								<img src="./img/logo.png" alt="">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<!-- SEARCH BAR -->
				<div class="col-md-6">
					<div class="header-search">
						<form action="search_result.php" method="GET"> 
							<select class="input-select" name="Category">
								<option value="0" selected>All Categories</option>
								<option value="1">Education</option>
								<option value="2">Game</option>
								<option value="3">Music</option>
								<option value="4">Social</option>
							</select>
							<input class="input" name="search" placeholder="Search here">
							<button class="search-btn" value="go">Search</button>
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
									<span>Your Cart</span>
									<div class="qty">2</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<div class="product-widget">
											<div class="product-img">
												<img src="app/game/stardew-valley.jpg" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">Stardew Valley</a></h3>
												<h4 class="product-price"><span class="qty"></span>฿320.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>

										<div class="product-widget">
											<div class="product-img">
												<img src="app/game/the-room-three.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">The Room Three</a></h3>
												<h4 class="product-price"><span class="qty"></span>฿80.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>
									</div>
									<div class="cart-summary">
										<small>2 Item(s) selected</small>
										<h5>SUBTOTAL: ฿400.00</h5>
									</div>
									<div class="cart-btns">
										<a href="#">View Cart</a>
										<a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
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

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- container -->
		<div class="container">
			<!-- responsive-nav -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="store.php?Cata=Deal">Hot Deals</a></li>
					<li><a href="store.php?Cata=Edu">Education</a></li>
					<li><a href="store.php?Cata=Game">Game</a></li>
					<li><a href="store.php?Cata=Music">Music</a></li>
					<li><a href="store.php?Cata=Social">Social</a></li>
				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- /NAVIGATION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="app/educa.png" alt="" width="500px" height="250px">
						</div>
						<div class="shop-body">
							<h3>Education<br>Apps</h3>
							<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="app/game.png" alt="" width="500px" height="250px">
						</div>
						<div class="shop-body">
							<h3>Games<br>Apps</h3>
							<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="app/music.png" alt="" width="500px" height="250px">
						</div>
						<div class="shop-body">
							<h3>Music<br>Apps</h3>
							<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Products</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Education App</a></li>
								<li><a data-toggle="tab" href="#tab1">Game App</a></li>
								<li><a data-toggle="tab" href="#tab1">Music App</a></li>
								<li><a data-toggle="tab" href="#tab1">Social App</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
									<!-- product -->
									<?php
									$q = 'SELECT *  FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id = 1 order by download_c DESC ';
									if ($res = $conn->query($q)) {
										$c1 = 5;
										while (($row = $res->fetch_array()) && ($c1 != 0)) {
											$c1 -= 1;

											echo '<div class="product">';
											echo '<div class="product-img">';
											echo '<img src="app/education/' . $row['app_pic'] . '" alt="">';
											echo '<div class="product-label">';
											if ($row['upload_time'] > '2019-07-02') {
												echo '<span class="new">NEW</span>';
											}
											if ($row['app_price'] != NULL) {
												echo '<span class="sale">-10%</span>';
											}
											if ($row['download_c'] >= 100000) {
												echo '<span class="new">HOT</span>';
											}
											echo '</div>';
											echo '</div>';
											echo '<div class="product-body">';
											echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
											echo '<h3 class="product-name"><a href="#">' . $row['app_name'] . '</a></h3>';
											if ($row['app_price'] == NULL) {
												echo '<h4 class="product-price">Free</h4>';
											} else {
												$addp = $row['app_price'] * 110 / 100;
												echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
											}
											if ($row['app_rating'] != NULL) {
												echo '<div class="product-rating">';
												$rating = $row['app_rating'];

												while ($rating >= 1) {
													$rating -= 1;
													echo '<i class="fa fa-star"></i><span> </span>';
												}
												echo '</div>';
											}
											echo '<div class="product-btns">';
											echo '<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>';
											echo '<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>';
											echo '<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>';
											echo '</div>';
											echo '</div>';
											echo '<div class="add-to-cart">';
											echo '<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>';
											echo '</div>';
											echo '</div>';
										}
									}
									?>
									<!-- /product -->

									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/education/elsa.jpg" alt="">
												<div class="product-label">
													<span class="sale">-9%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Education</p>
												<h3 class="product-name"><a href="#">elsa speak: english coach</a></h3>
												<h4 class="product-price">฿30.00<del class="product-old-price">฿33.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->

									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/education/rosetta_stone.png" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Education</p>
												<h3 class="product-name"><a href="#">rosetta stone: learn languages</a></h3>
												<h4 class="product-price">฿80.00 <del class="product-old-price">฿88.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->

									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/education/duolingo.png" alt="">
												<div class="product-label">
													<span class="sale">-9%</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Education</p>
												<h3 class="product-name"><a href="#">duolingo: learn languages</a></h3>
												<h4 class="product-price">฿80.00 <del class="product-old-price">฿88.00</del></h4>
												<div class="product-rating">
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->

									<!-- product -->
									<<!-- div class="product">
										<div class="product-img">
											<img src="app/education/andy.png" alt="">
										</div>
										<div class="product-body">
											<p class="product-category">Education</p>
											<h3 class="product-name"><a href="#">Andy-english speaking bot</a></h3>
											<h4 class="product-price">฿80.00 <del class="product-old-price">$88.00</del></h4>
											<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>

										</div>
										<div class="add-to-cart">
											<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
										</div>
								</div> -->
								<!-- /product -->

								<!-- product -->
								<!-- <div class="product">
											<div class="product-img">
												<img src="app/education/mimo.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Education</p>
												<h3 class="product-name"><a href="#">mimo: learn to code</a></h3>
												<h4 class="product-price">฿40.00 <del class="product-old-price">฿44.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
								<!-- /product -->
							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
	</div>
	<!-- /SECTION -->


	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Top selling</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li><a data-toggle="tab" href="#tab2">Education App</a></li>
								<li class="active"><a data-toggle="tab" href="#tab2">Game App</a></li>
								<li><a data-toggle="tab" href="#tab2">Music App</a></li>
								<li><a data-toggle="tab" href="#tab2">Social App</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab2" class="tab-pane fade in active">
								<div class="products-slick" data-nav="#slick-nav-2">
									<!-- product -->
									<?php
									$q = 'SELECT * FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id = 2 order by download_c DESC ';
									if ($res = $conn->query($q)) {
										$c1 = 5;
										while (($row = $res->fetch_array()) && ($c1 != 0)) {
											$c1 -= 1;
											echo '<div class="product">';
											echo '<div class="product-img">';
											echo '<img src="app/game/' . $row['app_pic'] . '" alt="">';
											echo '<div class="product-label">';
											if ($row['upload_time'] > '2019-07-02') {
												echo '<span class="new">NEW</span>';
											}
											if ($row['app_price'] != NULL) {
												echo '<span class="sale">-10%</span>';
											}
											if ($row['download_c'] >= 100000) {
												echo '<span class="new">HOT</span>';
											}
											echo '</div>';
											echo '</div>';
											echo '<div class="product-body">';
											echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
											echo '<h3 class="product-name"><a href="#">' . $row['app_name'] . '</a></h3>';
											if ($row['app_price'] == NULL) {
												echo '<h4 class="product-price">Free</h4>';
											} else {
												$addp = $row['app_price'] * 110 / 100;
												echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
											}
											if ($row['app_rating'] != NULL) {
												echo '<div class="product-rating">';
												$rating = $row['app_rating'];

												while ($rating >= 1) {
													$rating -= 1;
													echo '<i class="fa fa-star"></i><span> </span>';
												}
												echo '</div>';
											}
											echo '<div class="product-btns">';
											echo '<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>';
											echo '<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>';
											echo '<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>';
											echo '</div>';
											echo '</div>';
											echo '<div class="add-to-cart">';
											echo '<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>';
											echo '</div>';
											echo '</div>';
										}
									}
									?>
									<!-- /product -->
									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/game/pokemon-master.jpg" alt="">
												<div class="product-label">
													<span class="sale">-9%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Game</p>
												<h3 class="product-name"><a href="product.php">pokemon master</a></h3>
												<h4 class="product-price">฿120.00 <del class="product-old-price">฿132.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->

									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/game/doodle-jump.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Game</p>
												<h3 class="product-name"><a href="#">doodle jump</a></h3>
												<h4 class="product-price">Free</h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->

									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/game/rov.jpg" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Game</p>
												<h3 class="product-name"><a href="#">Garena RoV: Mobile Moba</a></h3>
												<h4 class="product-price">Free</h4>
												<div class="product-rating">
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->

									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/game/pubg.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Game</p>
												<h3 class="product-name"><a href="#">PUBG MOBILE</a></h3>
												<h4 class="product-price">฿120.00 <del class="product-old-price">฿132.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->

									<!-- product -->
									<!-- <div class="product">
											<div class="product-img">
												<img src="app/game/minecraft.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Game</p>
												<h3 class="product-name"><a href="#">Minecraft</a></h3>
												<h4 class="product-price">฿320.00<del class="product-old-price">฿350.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div> -->
									<!-- /product -->
								</div>
								<div id="slick-nav-2" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- /Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top Education App</h4>
						<div class="section-nav">
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-3">
						<div>
							<!-- product widget -->
							<?php
							$q = 'SELECT * FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id=1 order by download_c DESC';
							if ($res = $conn->query($q)) {
								$c1 = 3;
								while (($row = $res->fetch_array()) && ($c1 != 0)) {
									$c1 -= 1;
									echo '<div class="product-widget">';
									echo '<div class="product-img">';
									echo '<img src="app/' . $row['cat_name'] . '/' . $row['app_pic'] . '" alt="">';
									echo '</div>';
									echo '<div class="product-body">';
									echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
									echo '<h3 class="product-name">' . '<a href="#">' . $row['app_name'] . '</a></h3>';

									if ($row['app_price'] == NULL) {
										echo '<h4 class="product-price">Free</h4>';
									} else {
										$addp = $row['app_price'] * 110 / 100;
										echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
									}
									echo '</div>';
									echo '</div>';
								}
							}
							?>
							<!-- /product widget -->
							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/education/zipgrade.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Education</p>
										<h3 class="product-name"><a href="#">ZipGrade</a></h3>
										<h4 class="product-price">฿80.00 <del class="product-old-price">฿88.00</del></h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/education/elevate.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Education</p>
										<h3 class="product-name"><a href="#">Elevate - Brain Training Games</a></h3>
										<h4 class="product-price">฿90.00 <del class="product-old-price">฿100.00</del></h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/education/hello_talk.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Education</p>
										<h3 class="product-name"><a href="#">HelloTalk - Learn Foreign Languages</a></h3>
										<h4 class="product-price">฿40.00 <del class="product-old-price">฿44.00</del></h4>
									</div>
								</div> -->
							<!-- product widget -->
						</div>

						<div>
							<!-- product widget -->
							<?php
							$q = 'SELECT * FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id=1 order by download_c DESC';
							if ($res = $conn->query($q)) {
								$b1 = 0;
								$c1 = 6;
								while (($row = $res->fetch_array()) && ($c1 != 0)) {
									$c1 -= 1;
									$b1 += 1;
									if ($b1 > 2) {
										echo '<div class="product-widget">';
										echo '<div class="product-img">';
										echo '<img src="app/' . $row['cat_name'] . '/' . $row['app_pic'] . '" alt="">';
										echo '</div>';
										echo '<div class="product-body">';
										echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
										echo '<h3 class="product-name">' . '<a href="#">' . $row['app_name'] . '</a></h3>';
										if ($row['app_price'] == NULL) {
											echo '<h4 class="product-price">Free</h4>';
										} else {
											$addp = $row['app_price'] * 110 / 100;
											echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
										}
										echo '</div>';
										echo '</div>';
									}
								}
							}
							?>
							<!-- /product widget -->
							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/education/blinkist.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Education</p>
										<h3 class="product-name"><a href="#">Blinkist - Nonfiction Books</a></h3>
										<h4 class="product-price">฿40.00 <del class="product-old-price">฿44.00</del></h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/education/ABA.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Education</p>
										<h3 class="product-name"><a href="#">ABA English - Learn English</a></h3>
										<h4 class="product-price">฿50.00 <del class="product-old-price">฿55.00</del></h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/education/vooks.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Education</p>
										<h3 class="product-name"><a href="#">Vooks</a></h3>
										<h4 class="product-price">฿50.00 <del class="product-old-price">฿55.00</del></h4>
									</div>
								</div> -->
							<!-- product widget -->
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top Game App</h4>
						<div class="section-nav">
							<div id="slick-nav-4" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-4">
						<div>
							<!-- product widget -->
							<?php
							$q = 'SELECT * FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id=2 order by download_c DESC';
							if ($res = $conn->query($q)) {
								$c1 = 3;
								while (($row = $res->fetch_array()) && ($c1 != 0)) {
									$c1 -= 1;
									echo '<div class="product-widget">';
									echo '<div class="product-img">';
									echo '<img src="app/' . $row['cat_name'] . '/' . $row['app_pic'] . '" alt="">';
									echo '</div>';
									echo '<div class="product-body">';
									echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
									echo '<h3 class="product-name">' . '<a href="#">' . $row['app_name'] . '</a></h3>';
									if ($row['app_price'] == NULL) {
										echo '<h4 class="product-price">Free</h4>';
									} else {
										$addp = $row['app_price'] * 110 / 100;
										echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
									}
									echo '</div>';
									echo '</div>';
								}
							}
							?>
							<!-- /product widget -->
							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/game/pokemon-go.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Games</p>
										<h3 class="product-name"><a href="#">Pokemon GO</a></h3>
										<h4 class="product-price">Free</h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/game/terraria.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Games</p>
										<h3 class="product-name"><a href="#">Terraria</a></h3>
										<h4 class="product-price">฿320.00<del class="product-old-price">$฿350.00</del></h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/game/Cytus 2.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Games</p>
										<h3 class="product-name"><a href="#">Cytus II</a></h3>
										<h4 class="product-price">฿80.00 <del class="product-old-price">฿88.00</del></h4>
									</div>
								</div> -->
							<!-- product widget -->
						</div>

						<div>
							<!-- product widget -->
							<?php
							$q = 'SELECT * FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id=2 order by download_c DESC';
							if ($res = $conn->query($q)) {
								$b1 = 0;
								$c1 = 6;
								while (($row = $res->fetch_array()) && ($c1 != 0)) {
									$c1 -= 1;
									$b1 += 1;
									if ($b1 > 2) {
										echo '<div class="product-widget">';
										echo '<div class="product-img">';
										echo '<img src="app/' . $row['cat_name'] . '/' . $row['app_pic'] . '" alt="">';
										echo '</div>';
										echo '<div class="product-body">';
										echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
										echo '<h3 class="product-name">' . '<a href="#">' . $row['app_name'] . '</a></h3>';
										if ($row['app_price'] == NULL) {
											echo '<h4 class="product-price">Free</h4>';
										} else {
											$addp = $row['app_price'] * 110 / 100;
											echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
										}
										echo '</div>';
										echo '</div>';
									}
								}
							}
							?>
							<!-- /product widget -->
							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/game/grand theft auto.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Games</p>
										<h3 class="product-name"><a href="#">Grand Theft Auto: San Andreas</a></h3>
										<h4 class="product-price">฿320.00 <del class="product-old-price">฿350.00</del></h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/game/stardew-valley.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Games</p>
										<h3 class="product-name"><a href="#">Stardew Valley</a></h3>
										<h4 class="product-price">฿320.00<del class="product-old-price">฿350.00</del></h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/game/seven-knights.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Games</p>
										<h3 class="product-name"><a href="#">Seven Knights</a></h3>
										<h4 class="product-price">฿80.00 <del class="product-old-price">฿88.00</del></h4>
									</div>
								</div> -->
							<!-- product widget -->
						</div>
					</div>
				</div>

				<div class="clearfix visible-sm visible-xs"></div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top Social App</h4>
						<div class="section-nav">
							<div id="slick-nav-5" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-5">
						<div>
							<!-- product widget -->
							<?php
							$q = 'SELECT * FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id=4 order by download_c DESC';
							if ($res = $conn->query($q)) {
								$c1 = 3;
								while (($row = $res->fetch_array()) && ($c1 != 0)) {
									$c1 -= 1;
									echo '<div class="product-widget">';
									echo '<div class="product-img">';
									echo '<img src="app/' . $row['cat_name'] . '/' . $row['app_pic'] . '" alt="">';
									echo '</div>';
									echo '<div class="product-body">';
									echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
									echo '<h3 class="product-name">' . '<a href="#">' . $row['app_name'] . '</a></h3>';
									if ($row['app_price'] == NULL) {
										echo '<h4 class="product-price">Free</h4>';
									} else {
										$addp = $row['app_price'] * 110 / 100;
										echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
									}
									echo '</div>';
									echo '</div>';
								}
							}
							?>
							<!-- /product widget -->
							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/social/facebook.PNG" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Social</p>
										<h3 class="product-name"><a href="#">Facebook</a></h3>
										<h4 class="product-price">Free</h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/social/line.PNG" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Social</p>
										<h3 class="product-name"><a href="#">Line</a></h3>
										<h4 class="product-price">Free</h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/social/instagram.JPG" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Social</p>
										<h3 class="product-name"><a href="#">Instagram</a></h3>
										<h4 class="product-price">Free</h4>
									</div>
								</div> -->
							<!-- product widget -->
						</div>

						<div>
							<!-- product widget -->
							<?php
							$q = 'SELECT * FROM applications a,category c where a.cat_id = c.cat_id AND a.cat_id=4 order by download_c DESC';
							if ($res = $conn->query($q)) {
								$b1 = 0;
								$c1 = 6;
								while (($row = $res->fetch_array()) && ($c1 != 0)) {
									$c1 -= 1;
									$b1 += 1;
									if ($b1 > 2) {
										echo '<div class="product-widget">';
										echo '<div class="product-img">';
										echo '<img src="app/' . $row['cat_name'] . '/' . $row['app_pic'] . '" alt="">';
										echo '</div>';
										echo '<div class="product-body">';
										echo '<p class="product-category">' . ucwords($row['cat_name']) . '</p>';
										echo '<h3 class="product-name">' . '<a href="#">' . $row['app_name'] . '</a></h3>';
										if ($row['app_price'] == NULL) {
											echo '<h4 class="product-price">Free</h4>';
										} else {
											$addp = $row['app_price'] * 110 / 100;
											echo '<h4 class="product-price">฿' . floatval($row['app_price']) . '.00 <del class="product-old-price">฿' . $addp . ' </del></h4>';
										}
										echo '</div>';
										echo '</div>';
									}
								}
							}
							?>
							<!-- /product widget -->
							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/social/beetalk.JPG" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Social</p>
										<h3 class="product-name"><a href="#">Beetalk</a></h3>
										<h4 class="product-price">Free</h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/social/hi5.PNG" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Social</p>
										<h3 class="product-name"><a href="#">Hi5</a></h3>
										<h4 class="product-price">Free</h4>
									</div>
								</div> -->
							<!-- /product widget -->

							<!-- product widget -->
							<!-- <div class="product-widget">
									<div class="product-img">
										<img src="app/social/pantip.JPG" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Social</p>
										<h3 class="product-name"><a href="#">Pantip</a></h3>
										<h4 class="product-price">Free</h4>
									</div>
								</div> -->
							<!-- product widget -->
						</div>
					</div>
				</div>

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- NEWSLETTER -->
	<div id="newsletter" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="newsletter">
						<p><strong>FEEDBACK</strong></p>
						<form>
							<input class="input" type="text" placeholder="Enter Your E-mail To Send Feedback">
							<button class="newsletter-btn"><i class="fa fa-envelope"></i> Go</button>
						</form>
						<ul class="newsletter-follow">
							<li>
								<a href="#"><i class="fa fa-facebook"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-instagram"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /NEWSLETTER -->

	<!-- FOOTER -->
	<footer id="footer">
		<!-- top footer -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">About Us</h3>
							<p>Mr. Thanach Ungkhara<br>6022780140</p>
							<p>Mr. Peerapol La-ongsiri<br>6022791519</p>
							<p>Mr. Thananon Pongsuwan<br>6022781247</p>
							<p>Mr. Promwat Angsuratanawech<br>60227811205</p>
							<ul class="footer-links">
								<li><a href="#"><i class="fa fa-map-marker"></i>99 Moo 18 Paholyothin Road, Klong Luang, Pathumthani 12121 THAILAND</a></li>
								<li><a href="#"><i class="fa fa-phone"></i>012-345-6789</a></li>
								<li><a href="#"><i class="fa fa-envelope-o"></i>databaseproj@email.com</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Categories</h3>
							<ul class="footer-links">
								<li><a href="store.php?Cata=Deal">Hot Deals</a></li>
								<li><a href="store.php?Cata=Edu">Education</a></li>
								<li><a href="store.php?Cata=Game">Game</a></li>
								<li><a href="store.php?Cata=Music">Music</a></li>
								<li><a href="store.php?Cata=Social">Social</a></li>
							</ul>
						</div>
					</div>

					<div class="clearfix visible-xs"></div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Information</h3>
							<ul class="footer-links">
								<li><a href="#">About Us</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Orders and Returns</a></li>
								<li><a href="#">Terms & Conditions</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Service</h3>
							<ul class="footer-links">
								<li><a href="#">My Account</a></li>
								<li><a href="#">View Cart</a></li>
								<li><a href="#">Track My Order</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /top footer -->

		<!-- bottom footer -->
		<div id="bottom-footer" class="section">
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12 text-center">
						<ul class="footer-payments">
							<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
							<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
						</ul>
						<span class="copyright">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> by I Like It When You Sleep, for You Are So Beautiful Yet So Unaware of It. All rights reserved.
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</span>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bottom footer -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>