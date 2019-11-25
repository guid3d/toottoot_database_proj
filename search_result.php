<!DOCTYPE html>
<?php
$v1 = $_GET['Category'];
$v2 = $_GET['search'];
//var_dump($v1);
//var_dump($v2);  

if($v1=="0")
{
    $name="";
}
if($v1=="1")
{
    $name="Education";
}
if($v1=="2")
{
    $name="Game";
}
if($v1=="3")
{
    $name="Music";
}
if($v1=="4")
{
    $name="Social";
}

//var_dump($name);

include('connect.php');
session_start();
if(isset($_GET['appadd'])&&isset($_GET['Cata'])){
	$o = 'INSERT INTO cart(cart.user_id,app_id) VALUES("'.$_SESSION['id'].'" ,"'.$_GET['appadd'].'")';
	if(!$res1 = $conn->query($o)){
		echo "ERROR-->".$o;
	}
	header('Location:store.php?Cata='.$_GET['Cata']);
}
if (isset($_POST['cartdeluserid'])&&isset($_POST['cartdelappid'])&&isset($_POST['Cata'])){
	$r='DELETE FROM cart where cart.user_id="'.$_POST['cartdeluserid'].'" AND app_id="'.$_POST['cartdelappid'].'" LIMIT 1 ';
	if(!$res0 = $conn->query($r)){
		echo "ERROR-->".$r;
	}
	header('Location:store.php?Cata='.$_POST['Cata']);
}
?>
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
        <!-- selecttab -->
        <?php
        if(isset($_GET['Cata']))
            $Select = $_GET['Cata'];
        ?>

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
						if(!isset($_SESSION['id'])){
						
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
						
						}
						else{?>
							<!--<?php echo $_SESSION['id'];?>-->
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
										$w = 'SELECT count(*)as cou FROM cart c,user u where c.user_id = u.user_id AND c.user_id = "'.$_SESSION['id'].'"';
										if($res = $conn->query($w)){
											while($rowq = $res->fetch_array()){
												echo '<div class="qty">'.$rowq['cou'].'</div>';
											}
										}
									?>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<?php
											$w = 'SELECT * FROM cart c,user u,category ca,applications a where c.user_id = u.user_id AND c.app_id = a.app_id AND a.cat_id = ca.cat_id AND c.user_id = "'.$_SESSION['id'].'"';
											if($res = $conn->query($w)){
												while($rowq = $res->fetch_array()){
													echo '<div class="product-widget">';
													echo '<div class="product-img">';
													echo '<img src="app/'.$rowq['cat_name'].'/'.$rowq['app_pic'].'" alt="">';
													echo '</div>';
													echo '<div class="product-body">';
													echo '<h3 class="product-name"><a href="#">'.$rowq['app_name'].'</a></h3>';
													if($rowq['app_price']!=NULL){
														echo '<h4 class="product-price"><span class="qty"></span>฿'.floatval($rowq['app_price']).'.00</h4>';
													}
													else{
														echo '<h4 class="product-price"><span class="qty"></span>Free</h4>';
													}
													echo '</div>';
													echo '<form action="store.php" method="POST">';
													echo '<input type="hidden" name="cartdeluserid" value="'.$_SESSION['id'].'">';
													echo '<input type="hidden" name="cartdelappid" value="'.$rowq['app_id'].'">';
													echo '<input type="hidden" name="Cata" value="'.$Select.'">';
													echo '<button class="delete"><i class="fa fa-close"></i></button>';
													echo '</form>';
													echo '</div>';
												}
											}
										?>
									</div>
									<div class="cart-summary">
										<?php
											$w = 'SELECT count(*)as cou FROM cart c,user u where c.user_id = u.user_id AND c.user_id = "'.$_SESSION['id'].'"';
											if($res = $conn->query($w)){
												while($rowq = $res->fetch_array()){
													echo '<small>'.$rowq['cou'].' Item(s) selected</small>';
												}
											}
										?>
										<?php
											$w = 'SELECT * FROM cart c,user u,category ca,applications a where c.user_id = u.user_id AND c.app_id = a.app_id AND a.cat_id = ca.cat_id AND c.user_id = "'.$_SESSION['id'].'"';
											if($res = $conn->query($w)){
												$p = 0;
												while($rowq = $res->fetch_array()){
													if($rowq['app_price']!=NULL){
														$p+=$rowq['app_price'];
													}
												}
												if($p!=0){
													echo '<h5>SUBTOTAL: ฿'.$p.'.00</h5>';
												}
												else{
													echo'<h5>SUBTOTAL: FREE</h5>';
												}
											}
										?>
									</div>
									<div class="cart-btns">
									<a href="purchase_his.php">Purchase History</a>
										<a href="checkout.php">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
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

		<!-- Catagorytab -->
        <!-- socialtab -->
        <!-- startphp -->
        <?php
        if(TRUE){
        ?>
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li><a href="#">Search</a></li>
							<li class="active"><?php echo $name ?> apps</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
        
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">

								<div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Education
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-2">
									<label for="category-2">
										<span></span>
										Game
										<small>(740)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-3">
									<label for="category-3">
										<span></span>
										Music
										<small>(1450)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-4">
									<label for="category-4">
										<span></span>
										Social
										<small>(578)</small>
									</label>
								</div>

							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							
							<?php
                            if($v1=="0")
                            {
                                $q = 'SELECT * FROM applications order by download_c DESC ';
                            }
                            else
                            {
                                $q = 'SELECT * FROM applications WHERE cat_id = '.$v1.' order by download_c DESC ';
                            }
								if($res = $conn->query($q)){
									$c1 = 3;
									while(($row = $res->fetch_array()) && ($c1 != 0)){
										$c1-=1;
										
										echo '<div class="product-widget">';
										echo '<div class="product-img">';
										echo '<a href="product.php?appid=' . $row['app_id'] . '"> <img style="width:100%" src="app/' . $row['app_pic'] . '" alt=""></a>';
										echo '</div>';
										echo '<div class="product-body">';
										echo '<p class="product-category">'.$name.'</p>';
										echo '<h3 class="product-name"><a href="product.php?appid=' . $row['app_id'] . '">' . $row['app_name'] . '</a></h3>';
										
										if($row['app_price']==NULL){
											echo '<h4 class="product-price">Free</h4>';
										}
										else {
											$addp = $row['app_price']*110/100;
											echo '<h4 class="product-price">฿'.floatval($row['app_price']).'.00 <del class="product-old-price">฿'.$addp.' </del></h4>';
										}
										echo '</div>';
										echo '</div>';
									}
								}
							?>

							
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">9</option>
										<option value="1">18</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<!-- product -->
							<?php
                                if($v1=="0")
                                {
                                    $q = 'SELECT * FROM applications WHERE app_name LIKE "'.$v2.'%"';
                                }
                                else
                                {
                                    $q = 'SELECT * FROM applications WHERE app_name LIKE "'.$v2.'%" AND cat_id = "'.$v1.'"';
                                }
                                //var_dump($q);
								if($res = $conn->query($q)){
									$c1 = 9;
									while(($row = $res->fetch_array()) && ($c1 != 0)){
										$c1-=1;
										echo '<div class="clearfix visible-sm visible-xs"></div>';
										echo '<div class="col-md-4 col-xs-6">';
										echo '<div class="product">';
										echo '<div class="product-img">';
										echo '<a href="product.php?appid=' . $row['app_id'] . '"> <img style="width:100%" src="app/' . $row['app_pic'] . '" alt=""></a>';
										echo '<div class="product-label">';
										if($row['upload_time']>'2019-07-02'){
											echo '<span class="new">NEW</span>';
										}
										if($row['app_price']!=NULL){
											echo '<span class="sale">-10%</span>';
										}
										if($row['download_c']>=100000){
											echo '<span class="new">HOT</span>';
										}
										echo '</div>';
										echo '</div>';
										echo '<div class="product-body">';
										echo '<p class="product-category">'.$name.'</p>';
										echo '<h3 class="product-name"><a href="product.php?appid=' . $row['app_id'] . '">' . $row['app_name'] . '</a></h3>';
										if($row['app_price']==NULL){
											echo '<h4 class="product-price">Free</h4>';
										}
										else {
											$addp = $row['app_price']*110/100;
											echo '<h4 class="product-price">฿'.floatval($row['app_price']).'.00 <del class="product-old-price">฿'.$addp.' </del></h4>';
										}
										if($row['app_rating']!=NULL){
											echo '<div class="product-rating">';
											$rating= $row['app_rating'];
											
											while ($rating>=1){
												$rating-=1;
												echo '<i class="fa fa-star"></i><span> </span>';
											}
											echo '</div>';
										}
										//echo '<div class="product-btns">';
										//echo '<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>';
										//echo '<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>';
										//echo '<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>';
										//echo '</div>';
										//echo '</div>';
										//echo '<div class="add-to-cart">';
										//echo '<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>';
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
						<!-- /store products -->

						<!-- store bottom filter -->
						
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
        <?php
        }
        ?>
        <!-- endsocialtab -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
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
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> by I Like It When You Sleep, for You Are So Beautiful Yet So Unaware of It. All rights reserved.
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
