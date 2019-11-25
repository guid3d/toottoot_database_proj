<html>
<?php
session_start();
include('connect.php');
$w = 'SELECT * FROM cart c,user u,category ca,applications a where c.user_id = u.user_id AND c.app_id = a.app_id AND a.cat_id = ca.cat_id AND c.user_id = "'.$_SESSION['id'].'"';
if($res = $conn->query($w)){
  while($rowq = $res->fetch_array()){
    $f_name=$rowq['f_name'];
    $l_name=$rowq['l_name'];
    $e_mail=$rowq['email'];
    $addr=$rowq['addr'];
    $checkout="yes";
    $nopay="no";
    $payid="";
    if(isset($rowq['payment_id'])){
      $payid=$rowq['payment_id'];
      $nopay="yes";
    }
  }
}
?>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		 <title>TOOTOOT - Checkout</title>

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
     <link rel="stylesheet" type="text/css" href="css/cardstyle.css">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
<body>
<div class="row" style="padding-top:40px;">
  <div class="col-75">
    <div class="container">
      <form action="index.php" style="padding-top:20px;" method="post">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <input type="hidden" name="checkout" value="<?php echo $checkout; ?>">
            <input type="hidden" name="nopay" value="<?php echo $nopay; ?>">
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="c_fname" placeholder="John M. Doe" value="<?php echo $f_name; ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="c_email" placeholder="john@example.com" value="<?php echo $e_mail; ?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="c_addr" placeholder="542 W. 15th Street" value="<?php echo $addr; ?>">
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" name="cardname" placeholder="John More Doe" value="<?php echo $f_name."  ".$l_name; ?>">
            <label for="ccnum">Credit card number</label>
            <input type="text" name="cardnumber" placeholder="1111-2222-3333-4444" value="<?php echo $payid; ?>">
            <label for="expmonth">Exp Month</label>
            <input type="text" name="expmonth" placeholder="September">

            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>

        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" id="payment" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>


</div>
</body>
</html>
<script>
  document.getElementById("payment").onclick = function(){
    alert(
      "Payment Complete"
    );
    document.location.href = "index.php";
  }
</script>