<!DOCTYPE html>
<html lang="en">
<?php
include("connect.php");
session_start(); ?>

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
<style>
    .form label {
        display: block;
        text-align: left;
        font-weight: bold;
        width: 10%;
        /* float: center; */
        margin: 2px 30%;
        /* margin-right: 10px;
            
            margin-left: 20px; */
    }

    .form input {
        padding: 4px 2px;
        margin: 2px auto;
        border: 1.5px solid orange;
        border-radius: 4px;
        width: 40%;
        display: block;

    }

    .form input[type="text"],
    .form input[type="password"] {
        display: block;

        width: 40%;
    }


    .form input[type="checkbox"] {
        display: block;

    }

    .form select {
        padding: 4px 2px;
        display: block;
        margin: 2px auto;

        border: 1.5px solid orange;
        border-radius: 4px;
        width: 40%;
    }

    .form textarea {
        padding: 4px 2px;
        display: block;
        margin: 2px auto;
        border: 1.5px solid orange;
        border-radius: 4px;

    }

    .example_f {
        border-radius: 8px;
        background: linear-gradient(to right, #FF7701, #e8385b) !important;
        border: none;
        color: #FFFFFF;
        text-align: center;
        text-transform: uppercase;
        font-size: 15px;
        padding: 10px;
        width: 200px;
        height: 50px;
        transition: all 0.4s;
        cursor: pointer;
        align-content: right;
        /* margin: right; */
        margin-right: 10%;
    }

    .example_f span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.4s;
    }

    .example_f span:after {
        content: '\00bb';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
    }

    .example_f:hover span {
        padding-right: 25px;
    }

    .example_f:hover span:after {
        opacity: 1;
        right: 0;
    }
</style>

<body>
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
                    <li><a href="devsetting.php"><i class="fa fa-user-o"></i> My Account</a></li>
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
                    <li class="active"><a href="devlogin.php">Home</a></li>
                    <li><a href="devstat.php">Statistic</a></li>
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
    <!-- /NAVIGATION -->


    <!-- SECTION -->
    <div>
        <!-- container -->
        <div align="left">
            <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form> -->
            <!-- row -->
            <br>
            <h3 style="margin-left:5%">Add New Application</h3>

            <form class="iii" action="devcompleteiap.php" method="post" style="padding: 4px 2px;
            margin: 20px auto;
            border: 1.5px solid orange;
            border-radius: 4px;
            width: 90%;
            display: block;">
                
                <div>
                        <label>Application</label>
                        <select name="app">
                            <?php $q = 'SELECT app_id,app_name FROM applications;';
                            if ($result = $conn->query($q)) {
                                while ($rowuser = $result->fetch_array()) {
                                    echo '<option value='  . $rowuser[0] .'>' . $rowuser[1] . '</option>';
                                }
                            } else {
                                echo 'Query error: ' . $mysqli->error;
                            }
                            ?>
                        </select>
                    </div>
                <div><input type="text" name="price" placeholder="Price" style="width: 150px;" ></div>
                <div><textarea name="desc" rows="5" cols="50" placeholder="Description"></textarea></div>
                <input type="hidden" name="edittype" value="new">
                <input type="hidden" name="appid" value="<?php echo $rowuser[0] ?>">
                <input class="example_f" type="submit" name="login" value="Submit">
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    </div>
    <!-- /SECTION -->



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

</body>

</html>