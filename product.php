<!DOCTYPE html>
<?php
session_start();
include('connect.php');

?>

<?php

$wrongpassword = 0;
if (isset($_GET['logout']) && $_GET['logout'] == 'logout') {
	session_start();
	session_destroy();
}
if(isset($_POST['new_uname'])&&isset($_POST['new_pass'])&&isset($_POST['new_re_pass'])&&isset($_POST['new_fname'])&&isset($_POST['new_lname'])&&isset($_POST['new_email'])&&isset($_POST['new_payment'])&&isset($_POST['new_age'])&&isset($_POST['new_dob'])&&isset($_POST['new_addr'])&&($_POST['new_pass']=$_POST['new_re_pass'])){
	$e = 'INSERT INTO user(username,user.password,f_name,l_name,user.email,payment_id,age,dob,addr) VALUES("' . $_POST['new_uname'] . '","' . $_POST['new_pass'] .'","' . $_POST['new_fname'] .'","' . $_POST['new_lname'] .'","' . $_POST['new_email'] .'","' . $_POST['new_payment'] .'","' . $_POST['new_age'] .'","' . $_POST['new_dob'] .'","' . $_POST['new_addr'] . '")';
		if (!$res0 = $conn->query($e)) {
			echo "ERROR-->" . $e;
		}
}
if(isset($_POST['de_name'])&&isset($_POST['de_desc'])&&isset($_POST['de_email'])&&isset($_POST['de_web'])&&isset($_POST['de_addr'])&&isset($_POST['de_uname'])&&isset($_POST['de_pass'])&&isset($_POST['de_re_pass'])&&isset($_POST['de_phone'])&&isset($_POST['de_paypal'])&&($_POST['de_pass']=$_POST['de_re_pass'])){
	$o = 'INSERT INTO developer(dev_name,dev_desc,dev_email,dev_web,dev_addr,dev_username,dev_password,dev_phone,dev_paypal)
	VALUES("' . $_POST['de_name'] . '" ,"' . $_POST['de_desc']. '" ,"' . $_POST['de_email']. '" ,"' . $_POST['de_web']. '" ,"' . $_POST['de_addr']. '" ,"' . $_POST['de_uname']. '" ,"' . $_POST['de_pass']. '" ,"' . $_POST['de_phone']. '" ,"' . $_POST['de_paypal'] . '")';
	if (!$res1 = $conn->query($o)) {
		echo "ERROR-->" . $o;
	}
}


if (isset($_POST['cartdeluserid']) && isset($_POST['cartdelappid'])) {
	$r = 'DELETE FROM cart where cart.user_id="' . $_POST['cartdeluserid'] . '" AND app_id="' . $_POST['cartdelappid'] . '" LIMIT 1 ';
	if (!$res0 = $conn->query($r)) {
		echo "ERROR-->" . $r;
	}
}
if (isset($_GET['checkout']) && ($_GET['checkout'] == 'yes')) {
	$w = 'SELECT * FROM cart c,user u,category ca,applications a where c.user_id = u.user_id AND c.app_id = a.app_id AND a.cat_id = ca.cat_id AND c.user_id = "' . $_SESSION['id'] . '"';
	if ($rest = $conn->query($w)) {
		$p = 0;
		$pu = '';
		while ($rowq = $rest->fetch_array()) {
			if ($rowq['app_price'] != NULL) {
				$p += $rowq['app_price'];
			}
			$pu = $rowq['user_id'];
		}
		$e = 'INSERT INTO user_payment_history(pm_id,pm_cash) VALUES("' . $pu . '","' . $p . '")';
		if (!$res0 = $conn->query($e)) {
			echo "ERROR-->" . $e;
		}
	}
	$s = 'SELECT * FROM cart c,user u,category ca,applications a where c.user_id = u.user_id AND c.app_id = a.app_id AND a.cat_id = ca.cat_id AND c.user_id = "' . $_SESSION['id'] . '"';
	if ($res = $conn->query($s)) {
		while ($rowr = $res->fetch_array()) {
			$up = 'CALL backup_to_receipt("'.$rowr['user_id'].'","'.$rowr['app_id'].'")';
			if (!$res1 = $conn->query($up)) {
				echo "ERROR-->" . $up;
			}
			$de = 'DELETE FROM cart WHERE (cart.user_id = "' . $rowr['user_id'] . '") AND (cart.app_id = "' . $rowr['app_id'] . '")';
			if (!$res2 = $conn->query($de)) {
				echo "ERROR-->" . $de;
			} else {
				header('Location:index.php');
			}
		}
	}
}
if (isset($_GET['appadd']) && isset($_SESSION['id'])) {
	$o = 'INSERT INTO cart(cart.user_id,app_id) VALUES("' . $_SESSION['id'] . '" ,"' . $_GET['appadd'] . '")';
	if (!$res1 = $conn->query($o)) {
		echo "ERROR-->" . $o;
	}
	header('Location:index.php');
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

				// $_SESSION['user'] = $row;
				$_SESSION['id'] = $row['typeid'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['mail'] = $row['email'];
				$_SESSION['role'] = $row['role'];
				// var_dump($_SESSION);
				if ($row['role']  == "dev") {
					header("Location: devlogin.php");
				} else if ($row['role']  == "admin") {
					header("Location: admin_home.php");
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



	<!-- MAIN HEADER -->
	<div id="header">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- LOGO -->
				<div class="col-md-3">
					<div class="header-logo">
						<a href="index.php" class="logo">
							<img src="./img/logo.png" alt="">
						</a>
					</div>
				</div>
				<!-- /LOGO -->

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
						<?php
						if (!isset($_SESSION['id'])) {

							echo '<div class="dropdown">';
							echo '	<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">';
							echo '		<i class="fa fa-sign-in"></i>';
							echo '		<span>Log in</span>';

							echo '	</a>';
							echo '	<div class="cart-dropdown">';
							echo '		<div class="cart-list">';
							echo '			<form action="index.php" method="post" style="float:right;">';

							echo '				<input class="input" type="text" name="username" placeholder="Username" style="width: 150px;">';
							echo '				<input class="input" type="password" name="passwd" placeholder="Password" style="width: 150px;">';
							echo '				<br>';
							echo '				<input type="submit" name="login" value="Login">';
							echo '				<a href="register.php" style="text-decoration:underline">Create account?</a>';
							echo '			</form>';
							echo '		</div>';

							echo '	</div>';
							echo '</div>';
						} else { ?>
							<div class="dropdown">
								<a class="dropdown-toggle" a href="logout.php">
									<i class="fa fa-sign-in"></i>
									<span>Log out</a></span>
								</a>
							</div>
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
									<?php
										$w = 'SELECT count(*)as cou FROM cart c,user u where c.user_id = u.user_id AND c.user_id = "' . $_SESSION['id'] . '"';
										if ($res = $conn->query($w)) {
											while ($rowq = $res->fetch_array()) {
												echo '<div class="qty">' . $rowq['cou'] . '</div>';
											}
										}
										?>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<?php
											$w = 'SELECT * FROM cart c,user u,category ca,applications a where c.user_id = u.user_id
											AND c.app_id = a.app_id AND a.cat_id = ca.cat_id AND c.user_id = "' . $_SESSION['id'] . '"';
											if ($res = $conn->query($w)) {
												while ($rowq = $res->fetch_array()) {
													echo '<div class="product-widget">';
													echo '<div class="product-img">';
													echo '<img src="app/' . $rowq['cat_name'] . '/' . $rowq['app_pic'] . '" alt="">';
													echo '</div>';
													echo '<div class="product-body">';
													echo '<h3 class="product-name"><a href="#">' . $rowq['app_name'] . '</a></h3>';
													if ($rowq['app_price'] != NULL) {
														echo '<h4 class="product-price"><span class="qty"></span>฿' . floatval($rowq['app_price']) . '.00</h4>';
													} else {
														echo '<h4 class="product-price"><span class="qty"></span>Free</h4>';
													}
													echo '</div>';
													echo '<form action="index.php" method="POST">';
													echo '<input type="hidden" name="cartdeluserid" value="' . $_SESSION['id'] . '">';
													echo '<input type="hidden" name="cartdelappid" value="' . $rowq['app_id'] . '">';
													echo '<button class="delete"><i class="fa fa-close"></i></button>';
													echo '</form>';
													echo '</div>';
												}
											}
											?>
									</div>
									<div class="cart-summary">
										<?php
											$w = 'SELECT count(*)as cou FROM cart c,user u where c.user_id = u.user_id AND c.user_id = "' . $_SESSION['id'] . '"';
											if ($res = $conn->query($w)) {
												while ($rowq = $res->fetch_array()) {
													echo '<small>' . $rowq['cou'] . ' Item(s) selected</small>';
												}
											}
											?>
										<?php
											$w = 'SELECT * FROM cart c,user u,category ca,applications a where c.user_id = u.user_id AND c.app_id = a.app_id AND a.cat_id = ca.cat_id AND c.user_id = "' . $_SESSION['id'] . '"';
											if ($res = $conn->query($w)) {
												$p = 0;
												while ($rowq = $res->fetch_array()) {
													if ($rowq['app_price'] != NULL) {
														$p += $rowq['app_price'];
													}
												}
												if ($p != 0) {
													echo '<h5>SUBTOTAL: ฿' . $p . '.00</h5>';
												} else {
													echo '<h5>SUBTOTAL: FREE</h5>';
												}
											}
											?>
									</div>
									<div class="cart-btns">
										<a href="purchase_his.php">Purchase History</a>
										<a href="checkout.php">Checkout<i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						<?php } ?>
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
	<?php
	$appid = $_GET['appid'];
	$q = "SELECT * FROM applications a, category c WHERE a.cat_id = c.cat_id AND app_id=$appid";
	$result = $conn->query($q);
	if (!$result) {
		echo "Select failed; " . $conn->error;
	}
	$row = $result->fetch_array();
	?>

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- Product main img -->
				<div class="col-md-5 col-md-push-2
					<?php
					// session_start();
					include('connect.php');
					?>">
					<div id="product-main-img">
						<div class="product-preview">
							<img src="./app/<?= $row['app_pic'] ?>" alt="">
						</div>

						<div class="product-preview">
							<img src="./app/<?= $row['app_ss1'] ?>" alt="">
						</div>

						<div class="product-preview">
							<img src="./app/<?= $row['app_ss2'] ?>" alt="">
						</div>

						<div class="product-preview">
							<img src="./app/<?= $row['app_ss3'] ?>" alt="">
						</div>
					</div>
				</div>
				<!-- /Product main img -->

				<!-- Product thumb imgs -->
				<div class="col-md-2  col-md-pull-5">
					<div id="product-imgs">
						<div class="product-preview">
							<img src="./app/<?= $row['app_pic'] ?>" alt="">
						</div>

						<div class="product-preview">
							<img src="./app/<?= $row['app_ss1'] ?>" alt="">
						</div>

						<div class="product-preview">
							<img src="./app/<?= $row['app_ss2'] ?>" alt="">
						</div>

						<div class="product-preview">
							<img src="./app/<?= $row['app_ss3'] ?>" alt="">
						</div>
					</div>
				</div>
				<!-- /Product thumb imgs -->

				<!-- Product details -->
				<div class="col-md-5">
					<div class="product-details">
						<h2 class="product-name"><?= $row['app_name'] ?></h2>
						<div>
							<div class="product-rating">
								<!-- <i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i> -->
								<?php

								if ($row['app_rating'] != NULL) {
											echo '<div class="product-rating">';
											$rating = $row['app_rating'];
											$orating = 5;
											echo round($row['app_rating'],2);
											echo "          ";
											while ($rating >= 1) {
												$rating -= 1;
												$orating -= 1;
												echo '<i class="fa fa-star"></i><span> </span>';
											}
											while ($orating >= 1) {
												$orating -= 1;
												echo '<i class="fa fa-star-o empty"></i><span> </span>';
											}
											echo '</div>';

										} ?>
							</div>
							<?php
							$qqqqq = "SELECT COUNT(*) FROM rating WHERE r_appid=$appid";
							$result = $conn->query($qqqqq);
							$rowqqqq = $result->fetch_array();
							echo $rowqqqq['COUNT(*)']
							?>
							Review(s)
						</div>
						<div>
							<h3 class="product-price">
								<?php
								if ($row['app_price'] == NULL) {
									echo 'Free';
								} else {
									echo ('฿'.$row['app_price']);
								}
								?></h3>
							<!-- <span class="product-available">Available</span> -->
						</div>
						<p><?= $row['des_short'] ?></p>

						<!--<div class="product-options">
								<label>
									Size
									<select class="input-select">
										<option value="0">X</option>
									</select>
								</label>
								<label>
									Color
									<select class="input-select">
										<option value="0">Red</option>
									</select>
								</label>
							</div>-->
							<?php
							if(isset($_SESSION['id'])){
											echo '<div class="add-to-cart">';
											echo '<form action="index.php" method="get">';
											echo '<input type="hidden" name="appadd" value="'.$row['app_id'].'">';
											echo '<button class="add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> add to cart</button>';
											echo '</form>';
											echo '</div>';
											}
							?>

						<ul class="product-links">
							<li>Rated for:</li>
							<li><?= $row['age_restriction'] ?>+</a></li>
						</ul>

						<ul class="product-links">
							<li>Category:</li>
							<li><?= $row['cat_name'] ?></li>
						</ul>

						<!-- <ul class="product-links">
							<li>Share:</li>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-envelope"></i></a></li>
						</ul> -->

					</div>
				</div>
				<!-- /Product details -->

				<!-- Product tab -->
				<div class="col-md-12">
					<div id="product-tab">
						<!-- product tab nav -->
						<ul class="tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							<!-- <li><a data-toggle="tab" href="#tab2">Details</a></li> -->
							<li><a data-toggle="tab" href="#tab2">What's new</a></li>
							<li><a data-toggle="tab" href="#tab3">Reviews</a></li>
						</ul>
						<!-- /product tab nav -->

						<!-- product tab content -->
						<div class="tab-content">
							<!-- tab1  -->
							<div id="tab1" class="tab-pane fade in active">
								<div class="row">
									<div class="col-md-12">
										<p><?= $row['des_long'] ?></p>
									</div>
								</div>
							</div>
							<!-- /tab1  -->

							<!-- tab2  -->
							<div id="tab2" class="tab-pane fade in">
								<div class="row">
									<div class="col-md-12">
										<p><?= $row['changelog'] ?></p>
									</div>
								</div>
							</div>
							<!-- /tab2  -->

							<!-- tab3  -->
							<div id="tab3" class="tab-pane fade in">
								<div class="row">
									<!-- Rating -->
									<div class="col-md-3" style="width:12%">

									</div>
									<!-- /Rating -->

									<!-- Reviews -->
									<div class="col-md-6">
										<div id="reviews">
											<ul class="reviews">
												<?php
												$q = "SELECT * FROM rating, user, applications WHERE r_userid = user_id AND r_appid = app_id AND app_id = $appid";
												if ($res = $conn->query($q)) {
													$c1 = 4;
													while (($row = $res->fetch_array()) && ($c1 != 0)) {
														$c1 -= 1;
														?>
														<li>
															<div class="review-heading">
																<h5 class="name"><?= $row['f_name'] ?> <?= $row['l_name'] ?></h5>
																<p class="date"><?= $row['r_timestamp'] ?></p>
																<?php if ($row['r_star'] != NULL) {
																			echo '<div class="product-rating">';
																			$rating = $row['r_star'];
																			$orating = 5;

																			while ($rating >= 1) {
																				$rating -= 1;
																				$orating -= 1;
																				echo '<i class="fa fa-star"></i><span> </span>';
																			}
																			while ($orating >= 1) {
																				$orating -= 1;
																				echo '<i class="fa fa-star-o empty"></i><span> </span>';
																			}
																			echo '</div>';
																		} ?>

															</div>
															<div class="review-body">
																<p><?= $row['r_desc'] ?></p>
															</div>
														</li>

												<?php		}
												}
												?>
											</ul>
										</div>
									</div>
									<!-- /Reviews -->
									<?php
									$q = "SELECT * FROM applications WHERE app_id = $appid";
									$res = $conn->query($q);
										$rev = $res->fetch_array();

									?>
									<!-- Review Form -->
									<div class="col-md-3">
										<div id="review-form">
											<?php if (isset($_SESSION['id'])) {?>
											<form action="product_review_submit.php" method="post" class="review-form">
												<input class="input" type="hidden" name="appid" value=<?= $_GET['appid'] ?>>
												<input class="input" type="hidden" name="version" value=<?php echo($rev['version']);?>>
												<input class="input" type="hidden" name="dev_id" value=<?php echo($rev['dev_id']);?>>
												<input class="input" type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
												<input class="input" type="text" name="name" readonly value="<?php echo $_SESSION['name'] ?>">
												<input class="input" type="email" name="email" readonly value="<?php echo $_SESSION['mail'] ?>">
												<input class="input" type="text" name="title" placeholder="Title">
												<textarea class="input" name="desc" placeholder="Your Review"></textarea>
												<div class="input-rating">
													<span>Your Rating: </span>
													<div class="stars">
														<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
														<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
														<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
														<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
														<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
													</div>
												</div>
												<button class="primary-btn">Submit</button>
											</form>
										<?php }
										else echo 'Please login before review.'; ?>
										</div>
									</div>
									<!-- /Review Form -->
								</div>
							</div>
							<!-- /tab3  -->
						</div>
						<!-- /product tab content  -->
					</div>
				</div>
				<!-- /product tab -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- Section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<div class="col-md-12">
					<div class="section-title text-center">
						<h3 class="title">Related Products</h3>
					</div>
				</div>

				<!-- product -->
				<!-- <div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="./app/game/pokemon-go.png" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>

							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div> -->
				<!-- /product -->

				<!-- product -->
				<?php
				$q = "SELECT *  FROM applications a,category c WHERE app_id != $appid AND a.cat_id = c.cat_id";
				if ($res = $conn->query($q)) {
					$c1 = 4;
					while (($row = $res->fetch_array()) && ($c1 != 0)) {
						$c1 -= 1;
						echo '<div class="col-md-3 col-xs-6">';
						echo '<div class="product">';
						echo '<div class="product-img">';
						echo '<a href="product.php?appid=' . $row['app_id'] . '"><img style="width:100%" src="app/' . $row['app_pic'] . '" alt="">';
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
						// if ($row['app_rating'] != NULL) {
						// 	echo '<div class="product-rating">';
						// 	$rating = $row['app_rating'];
						//
						// 	while ($rating >= 1) {
						// 		$rating -= 1;
						// 		echo '<i class="fa fa-star"></i><span> </span>';
						// 	}
						// 	echo '</div>';
						// }
						echo '<div class="product-btns">';
						// echo '<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>';
						// echo '<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>';
						// echo '<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>';
						echo '</div>';
						echo '</div>';
						if(isset($_SESSION['id'])){
							echo '<div class="add-to-cart">';
							echo '<form action="index.php" method="get">';
							echo '<input type="hidden" name="appadd" value="'.$row['app_id'].'">';
							echo '<button class="add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> add to cart</button>';
							echo '</form>';
							echo '</div>';
						}
						echo '</div>';
						echo '</div>';
					}
				}
				?>

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /Section -->



	<!-- FOOTER -->
	<footer id="footer">

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
