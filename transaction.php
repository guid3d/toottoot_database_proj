<?php	require_once('connect.php'); ?>
<?php
require_once('helper.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>TOOTOOT</title>
<link rel="stylesheet" href="default.css">
</head>

<body>
<div id="wrapper"> 
	<div id="div_header">
		TOOTOOT Administrators 
	</div>
	<div id="div_subhead">
	
	</div>
	
	<div id="div_main">
		<div id="div_menu">
			<?php print_menus(); ?>
		</div>

		<div id="div_content" class="usergroup">
			<!--%%%%% Main block %%%%-->		
			<h2>Transaction</h2>
			<table>
                <col width="100px">
                <col width="100px">
                <col width="250px">
                <col width="100px">

                <tr>
                    <th>Pay ID</th> 
                    <th>User</th>
                    <th>Date</th>
                    <th>Cash</th>
                </tr>
   		 <?php 
				 	$q="select * from PAYMENT";
					$result=$conn->query($q);
					if(!$result){
						echo "Select failed. Error: ".$conn->error ;
						
					}
				 while($row=$result->fetch_array()){ ?>
                 <tr>
                    <td><?=$row['pay_id']?></td>
                    <td><?=$row['user_id']?></td>  
                    <td><?=$row['paydate']?></td> 
                    <td style="text-align: right;"><?=$row['cash'].".00฿"?></td> 
                </tr>                               
				<?php } ?>

			<?php $count=$result->num_rows;
					echo "<tr><td colspan=7 align=right>Total $count records</td></tr>";
					$result->free();
			?>
            </table>
				
		</div> <!-- end div_content -->
	</div> <!-- end div_main -->
	
	<div id="div_footer">  
		
	</div>
	
</div>
</body>
</html>


