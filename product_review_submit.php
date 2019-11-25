
<?php
	require_once('connect.php');
	$q  = 'insert into rating values (NULL,' .$_POST['appid'].',"' .$_POST['version'].'",' .$_POST['dev_id'].',"' .$_POST['title'].'","' .$_POST['desc'].'",' .$_POST['rating'].',
	' .$_POST['user_id'].',CURRENT_TIMESTAMP);';

	if(!$conn->query($q)){
    // var_dump($_POST);

    var_dump($q);
		echo "Update failed: ". $conn->error;
// var_dump($q);
	}else{
		var_dump($q);
		// header("Location: product.php?appid=".$_POST['appid']);
	}
	$q1  = 'CALL update_app_avg_rating('.$_POST['appid'].');';

	if(!$conn->query($q1)){
    // var_dump($_POST);

    var_dump($q1);
		echo "Update failed: ". $conn->error;
// var_dump($q);
	}else{
		var_dump($q1);
		header("Location: product.php?appid=".$_POST['appid']);
	}


?>
