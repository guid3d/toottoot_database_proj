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
	
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-arrow-circle-right"></i>Welcome to TOOTTOOT store</a></li>
					
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
