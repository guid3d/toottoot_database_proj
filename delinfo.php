<?php
	
	
	require_once('connect.php');
	if (isset($_GET['catid'])) {
        $cid = $_GET['catid'];
		$q="DELETE FROM CATEGORY where CAT_ID=$cid";
			if(!$conn->query($q)){
				echo "DELETE failed. Error: ".$conn->error ;
		   }
		   $conn->close();
		   //redirect
		   header("Location: admin_category.php");
	}
	elseif(isset($_GET['fbid'])) {
        $fbid = $_GET['fbid'];
		$q="DELETE FROM FEEDBACK where FB_ID=$fbid";
			if(!$conn->query($q)){
				echo "DELETE failed. Error: ".$conn->error ;
		   }
		   $conn->close();
		   //redirect
		   header("Location: admin_feedback.php");
	}
?>