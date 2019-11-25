<?php
include('connect.php');
session_start();
if (isset($_POST['send']))
{
	$v1 = $_POST['email'];
	 $v2 = $_POST['title'];
	 $v3 = $_POST['feedback'];
	 
	$q = "INSERT INTO feedback(fb_email,fb_title,fb_body) VALUES ('$v1','$v2','$v3');";
	var_dump($q);	
	$result=$conn->query($q);
	if($result){
		header("Location: index.php");
	}
					
					
}
?>
<!DOCTYPE html>
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
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
        <!-- /SECTION -->
            <!-- /HEADER -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Feedback</h3>
                        </div>
                        <div class="section-title">
                            <h4 class="title">Email : <?php echo $_GET['email']; ?></h4>
						</div>
						<form method="POST">
						<div class="form-group">
							<input style="width:570px" class="input" type="text" name="title" placeholder="Title">
							<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
						</div>
                        <div class="form-group">
                            <textarea style="width:570px; height:142px" name="feedback" placeholder="Enter Your Feedback"></textarea>
						</div>
						<div class="button-padding">
							<button name="send" value="send" class="edit-button">Send</button>
						</div>
						</form>
                        
                    <!-- /Billing Details -->

                </div>
            </div>
        </div>
    </div>
    <!-- HEADER -->

		

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
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
