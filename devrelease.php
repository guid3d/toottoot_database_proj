<?php
// session_start();
include('connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<style>
    table.basic_info {
        background-color: #EEEEEE;
        width: 80%;
        text-align: center;
        border-collapse: collapse;
        margin: auto;
    }

    table.basic_info td,
    table.basic_info th {
        border: 2px solid #AAAAAA;
        padding: 3px 2px;

    }

    table.basic_info tbody td {
        font-size: 13px;
        color: #000000;
    }

    table.basic_info tr:nth-child(even) {
        background: #FFEAAF;
    }

    table.basic_info thead {
        background: #FFA500;
        background: -moz-linear-gradient(top, #ffbb40 0%, #ffae19 66%, #FFA500 100%);
        background: -webkit-linear-gradient(top, #ffbb40 0%, #ffae19 66%, #FFA500 100%);
        background: linear-gradient(to bottom, #ffbb40 0%, #ffae19 66%, #FFA500 100%);
        border-bottom: 1px solid #444444;
    }

    table.basic_info thead th {
        font-size: 15px;
        font-weight: bold;
        color: #000000;
        text-align: center;
        border-left: 1px solid #000000;
    }

    table.basic_info thead th:first-child {
        border-left: none;
    }

    table.basic_info tfoot td {
        font-size: 14px;
    }

    table.basic_info tfoot .links {
        text-align: right;
    }

    table.basic_info tfoot .links a {
        display: inline-block;
        background: #1C6EA4;
        color: #FFFFFF;
        padding: 2px 8px;
        border-radius: 5px;
    }

    .topcontainer {
        width: 100%;
        display: inline-block;
        margin: 20px;
        text-align: center;
        font-size: 20px;
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
                    <li><a href="devlogin.php">Home</a></li>
                    <li><a href="devstat.php">Statistic</a></li>
                    <li class="active"><a href="devrelease.php">Release Management</a></li>
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
    <div id="top">
        <br>
        <h3 style="margin-left:5%">Welcome to release management!</h3>
        <div class="button_cont" align="right"><a class="example_f" href="devaddnew.php"><span>Add New application</a></div>

    </div>
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin-left:2%">Your app</h3>
                    <table class="basic_info">
                        <tr>
                            <td>App Name</td>
                            <td>Version</td>
                            <td>Changelog</td>
                            <td>Short Description</td>
                            <td>Price ($)</td>
                            <td>Age Restriction</td>
                            <td>Status</td>
                            <td>Category</td>
                            <td>Download</td>
                            <td>Size (MB)</td>
                            <!-- <td>Edit</td> -->


                        </tr>

                        <?php
                        $sql = 'SELECT app_id,changelog,version,download_c,round(app_size/1045504 , 1) 
                        as kb,app_name,des_short,app_price,age_restriction,status,category.cat_name as
                         cat FROM applications NATURAL JOIN category WHERE dev_id = ' . $_SESSION['id'];
                        $res = $conn->query($sql);
                        if ($res) {
                            while ($row = $res->fetch_assoc()) {
                                echo '<tr>';
                                // echo '<tr> '. $row['student_id'] . '<tr>';
                                // echo '<td> ' . $row['student_ID'] . '</td>';
                                echo '<td> ' . $row['app_name'] . '</td>';
                                echo '<td> ' . $row['version'] . '</td>';
                                echo '<td> ' . $row['changelog'] . '</td>';
                                echo '<td> ' . $row['des_short'] . '</td>';
                                echo '<td> ' . $row['app_price'] . '</td>';
                                echo '<td> ' . $row['age_restriction'] . '</td>';
                                echo '<td> ' . $row['status'] . '</td>';
                                echo '<td> ' . $row['cat'] . '</td>';
                                echo '<td> ' . $row['download_c'] . '</td>';
                                echo '<td> ' . $row['kb'] . '</td>';
                                echo '<td><a href="devedit.php?appid=' . $row["app_id"] . '">Edit</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </table>
                    <h3>Changelog</h3>
                    <table class="basic_info">
                        <tr>
                            <td>App Name</td>
                            <td>Version ID</td>
                            <td>Changelog</td>
                            <td>Address</td>
                            <td>Description</td>
                            <td>Status</td>
                            <td>Upload time</td>

                        </tr>

                        <?php

                        $sqlcom = 'select version_cat.version,version_cat.changelog,version_cat.app_id,app_name,
                        des_short,status,upload_time from version_cat left join applications on version_cat.app_id
                         = applications.app_id where applications.dev_id = ' . $_SESSION['id'] . ' and indicator = "n"';
                        // echo  $sqlcom;
                        $res = $conn->query($sqlcom);
                        if ($res) {
                            while ($row = $res->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td> ' . $row['app_name'] . '</td>';
                                echo '<td> ' . $row['version'] . '</td>';
                                echo '<td> ' . $row['changelog'] . '</td>';
                                echo '<td> ' . $row['app_id'] . '</td>';
                                echo '<td> ' . $row['des_short'] . '</td>';
                                echo '<td> ' . $row['status'] . '</td>';
                                echo '<td> ' . $row['upload_time'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->





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
