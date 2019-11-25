<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		 <title>TOOTOOT - Registeration</title>

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


                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">

                            

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
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-7">
                    <!-- Registration -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">For User</h3>
                        </div>
						<div class="input-checkbox">
                            <input type="checkbox" id="shiping-address1">
                            <label for="shiping-address1">
                                <span></span>
                                If you want to be User.
                            </label>
                            <div class="caption">
							<form action="index.php" method="post">
						<label>Username:</label>
                        <div class="form-group">
                            <input class="input" type="text" name="new_uname" placeholder="Username">
                        </div>
						<label>Password:</label>
                        <div class="form-group">
                            <input class="input" type="password" name="new_pass" placeholder="Password">
                        </div>
						<label>Re-Password:</label>
						<div class="form-group">
                            <input class="input" type="password" name="new_re_pass" placeholder="Re-Password">
                        </div>
						<label>Firstname:</label>
                        <div class="form-group">
                            <input class="input" type="text" name="new_fname" placeholder="Firstname">
                        </div>
						<label>Lastname:</label>
						<div class="form-group">
                            <input class="input" type="text" name="new_lname" placeholder="Lastname">
                        </div>
						<label>Email:</label>
						<div class="form-group">
                            <input class="input" type="email" name="new_email" placeholder="Email">
                        </div>
						<label>Age:</label>
                        <div class="form-group">
                            <input class="input" type="text" name="new_age" placeholder="Age">
                        </div>
						<label>Date of Birth:</label>
                        <div class="form-group">
                            <input class="input" type="date" name="new_dob">
                        </div>
						<label>Address:</label>
                        <div class="form-group">
                            <input class="input" type="text" name="new_addr" placeholder="Address">
                        </div>
						<div class="button-padding">
                        	<input class="edit-button" id="user-submit" type="submit" value="User Confirm">
                    	</div>
						</form>
                    </div>
					</div>
					</div>
                    <!-- /Billing Details -->
					

                    <!-- Shiping Details -->
                    <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">For developer</h3>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="shiping-address">
                            <label for="shiping-address">
                                <span></span>
                                If you want to be developer
                            </label>
                            <div class="caption">
							<form action="index.php" method="post">
								<label>Your Name:</label>
                                <div class="form-group">
                                    <input class="input" type="text" name="de_name" placeholder="Your Name">
                                </div>
								<label>Description:</label>
								<div class="form-group">
                                    <input class="input" type="text" name="de_desc" placeholder="Description">
                                </div>
								<label>Email:</label>
								<div class="form-group">
                                    <input class="input" type="email" name="de_email" placeholder="Email">
                                </div>
								<label>Website:</label>
								<div class="form-group">
                                    <input class="input" type="text" name="de_web" placeholder="Your Website">
                                </div>
								<label>Address:</label>
								<div class="form-group">
                                    <input class="input" type="text" name="de_addr" placeholder="Your Address">
                                </div>
								<label>Username:</label>
								<div class="form-group">
                                    <input class="input" type="text" name="de_uname" placeholder="Username">
                                </div>
								<label>Password:</label>
								<div class="form-group">
                            		<input class="input" type="password" name="de_pass" placeholder="Password">
                        		</div>
								 <label>Tel:</label>
								<div class="form-group">
                                    <input class="input" type="tel" name="de_phone" placeholder="Telephone Number">
                                </div>
								<label>Paypal:</label>
								<div class="form-group">
                            		<input class="input" type="text" name="de_paypal" placeholder="Paypal ID">
                        		</div>
								<div class="button-padding">
                        			<input class="edit-button" id="dev-submit" type="submit" value="Dev Confirm">
                    			</div>
							</form>
                            </div>
                        </div>
                    </div>
                    <!-- /Shiping Details -->
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


</html>
<script>
  document.getElementById("user-submit").onclick = function(){
    alert(
      "User Registration Complete"
    );
    document.location.href = "index.php";
  }
</script>
<script>
  document.getElementById("dev-submit").onclick = function(){
    alert(
      "Developer Registration Complete"
    );
    document.location.href = "index.php";
  }
</script>