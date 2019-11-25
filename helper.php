<?php
function print_menus(){
	?>
	<ul id="menu">
		<!-- <li><a href="user.php">Dashboard</a></li> -->
		<li><a href="admin_category.php">Edit Category</a></li>
		<li><a href="admin_feedback.php">Feedback</a></li>
		<li><a href="admin_transaction.php">Transaction</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>	
	<?php
}   

function welcome(){
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
		$fname = $user['USER_FNAME'];
		$lname = $user['USER_LNAME'];
		$groupname = $user['USERGROUP_NAME'];
		echo "Welcome $fname $lname ($groupname)";
	}else{
		echo "Welcome guest";
	}
}
function ispermitted(){
	if(!isset($_SESSION['user'])){
		return false;
	}
	$user = $_SESSION['user'];
	$group = strtolower($user['USERGROUP_NAME']);
	$filename = basename($_SERVER['PHP_SELF'], '.php');
	$noperms = array(
		'staff' => array(
			'add_user', 'user', 'edit_user', 'del_user'
		),
		'member' => array(
			'add_group', 'group', 'edit_group', 'del_group'
		)
	);
	return !array_key_exists($group, $noperms) 
		or !in_array($filename, $noperms[$group]);
}
?>