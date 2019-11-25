<?php
session_start();
include("connect.php");
$sql = 'SELECT `app_name`,`download_c`,app_rating FROM applications order by download_c desc limit 5';
if ($res = $conn->query($sql)) {
	while ($row = $res->fetch_array()) {
		$name[] = $row['app_name'];
		$download[] = $row['download_c'];
		$rate[] = $row['app_rating'];
	}
}
$i = 0;
$sql2 = 'SELECT count(app_id) as count ,SUM(download_c) AS sum, round(avg(app_rating),2) as rating
		 FROM applications where dev_id =' . $_SESSION['id'];
if ($res = $conn->query($sql2)) {
	while ($row = $res->fetch_array()) {
		$sum = $row['sum'];
		$count = $row['count'];
		$rating = $row['rating'];
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

	<!-- Fontfaces CSS-->



	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
 		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		 <![endif]-->


	<link href="css/font-face.css" rel="stylesheet" media="all">
	<link href="css/theme.css" rel="stylesheet" media="all">
	<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
	<link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
	<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="devlogin.php" class="logo">
								<img style="width:30px;height:30px;" src="./img/logo.png" alt="">
							</a>
							Developer
						</div>

					</div>
					<!-- /LOGO -->
				</ul>
				<ul class="header-links pull-right">
					<li>Welcome, <?php echo $_SESSION['name'] ?></li>
					<li><a href="devsetting.php"><i class="zmdi zmdi-tumblr"></i> My Account</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
		<!-- /TOP HEADER -->


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
					<li><a href="devlogin.php">Home</a></li>
					<li class="active"><a href="devstat.php">Statistic</a></li>
					<li><a href="devrelease.php">Release Management</a></li>
					<li><a href="devrating.php">Rating</a></li>
					<li><a href="deviap.php">IAP Management</a></li>
				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- BREADCRUMB -->
	<div id="breadcrumb" class="ass">
		<!-- container -->
		<div class="container-fluid">
			<!-- row -->
			<div>
				<div class="au-card m-b-30">
					<div class="au-card-inner">

						<h3 class="title-2 m-b-40">Download Statistic</h3>
						<div class="col-sm-6 col-lg-3">
							<div class="overview-item overview-item--c6">
								<div class="overview__inner">
									<div class="overview-box clearfix">
										<div class="icon">
											<i class="zmdi zmdi-download"></i>
										</div>
										<div class="text">
											<h2><?php echo $sum; ?></h2>
											<span>Downloads</span>
										</div>
									</div>
									<div class="overview-chart">
										<canvas id="widgetChart2"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="overview-item overview-item--c1">
								<div class="overview__inner">
									<div class="overview-box clearfix">
										<div class="icon">
											<i class="zmdi zmdi-cloud-upload"></i>
										</div>
										<div class="text">
											<h2><?php echo $count; ?></h2>
											<span>Applications</span>
										</div>
									</div>
									<div class="overview-chart">
										<canvas id="widgetChart1"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="overview-item overview-item--c5">
								<div class="overview__inner">
									<div class="overview-box clearfix">
										<div class="icon">
											<i class="zmdi zmdi-star"></i>
										</div>
										<div class="text">
											<h2><?php echo $rating; ?></h2>
											<span>Average Rating</span>
										</div>
									</div>
									<div class="overview-chart">
										<canvas id="widgetChart3"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="au-card m-b-30">
									<div class="au-card-inner">
										<canvas id="barChart"></canvas>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="au-card m-b-30">
									<div class="au-card-inner">
										<canvas id="polarChart"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- /NAVIGATION -->
		<div>

			<div>
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
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
										<ul class="footer-links">
											<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
											<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
											<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
										</ul>
									</div>
								</div>

								<div class="col-md-3 col-xs-6">
									<div class="footer">
										<h3 class="footer-title">Categories</h3>
										<ul class="footer-links">
											<li><a href="#">Hot deals</a></li>
											<li><a href="#">Laptops</a></li>
											<li><a href="#">Smartphones</a></li>
											<li><a href="#">Cameras</a></li>
											<li><a href="#">Accessories</a></li>
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
											<li><a href="#">Wishlist</a></li>
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
										</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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

				<!-- Jquery JS-->
				<script src="vendor/jquery-3.2.1.min.js"></script>
				<!-- Bootstrap JS-->
				<script src="vendor/bootstrap-4.1/popper.min.js"></script>
				<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
				<!-- Vendor JS       -->
				<script src="vendor/slick/slick.min.js">
				</script>
				<script src="vendor/wow/wow.min.js"></script>
				<script src="vendor/animsition/animsition.min.js"></script>
				<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
				</script>
				<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
				<script src="vendor/counter-up/jquery.counterup.min.js">
				</script>
				<script src="vendor/circle-progress/circle-progress.min.js"></script>
				<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
				<script src="vendor/chartjs/Chart.bundle.min.js"></script>
				<script src="vendor/select2/select2.min.js"> </script>
				<script>
					try {
						//bar chart
						var ctx = document.getElementById("barChart");
						if (ctx) {
							ctx.height = 150;
							var myChart = new Chart(ctx, {
								type: 'bar',
								defaultFontFamily: 'Poppins',
								data: {
									labels: <?php echo ('[');
											while ($i < 5) {
												echo ('"' . $name[$i]) . '", ';
												$i = $i + 1;
											}
											echo ']'; ?>,
									datasets: [{
										label: "Download Counts",

										data: <?php echo ('[');
												$i = 0;
												while ($i < 5) {
													echo ($download[$i]) . ', ';
													$i = $i + 1;
												}
												echo ']'; ?>,
										borderColor: "rgba(255,165,0, 0.9)",
										borderWidth: "0",
										backgroundColor: "rgba(255,165,0, 0.5)",
										fontFamily: "Poppins"
									}]
								},
								options: {
									legend: {
										position: 'top',
										labels: {
											fontFamily: 'Poppins'
										}

									},
									scales: {
										xAxes: [{
											ticks: {
												fontFamily: "Poppins"

											}
										}],
										yAxes: [{
											ticks: {
												beginAtZero: true,
												fontFamily: "Poppins"
											}
										}]
									}
								}
							});
						}


					} catch (error) {
						console.log(error);
					}
				</script>
				<script>
					try {

						// polar chart
						var ctx = document.getElementById("polarChart");
						if (ctx) {
							ctx.height = 200;
							var myChart = new Chart(ctx, {
								type: 'polarArea',
								data: {
									datasets: [{
										data: <?php echo ('[');
												$i = 0;
												while ($i < 5) {
													echo ($rate[$i]) . ', ';
													$i = $i + 1;
												}
												echo ']'; ?>,
										backgroundColor: [
											"rgba(255,99,71,0.9)",
											"rgba(255,99,71,0.8)",
											"rgba(255,99,71,0.7)",
											"rgba(255,99,71,0.6)",
											"rgba(255,99,71,0.5)"
										]

									}],
									labels: <?php echo ('[');
											$i = 0;
											while ($i < 5) {
												echo ('"' . $name[$i]) . '", ';
												$i = $i + 1;
											}
											echo ']'; ?>
								},
								options: {
									legend: {
										position: 'top',
										labels: {
											fontFamily: 'Poppins'
										}

									},
									responsive: true
								}
							});
						}

					} catch (error) {
						console.log(error);
					}
				</script>

</body>

</html>