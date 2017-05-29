<?php 
	require_once("LogicLayer/AccountManager.php");
	require_once("LogicLayer/BankCardManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	
	
	
?>

<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>BankCard List and Delete Panel </title>
		<link rel="stylesheet" type="text/css" href="style/site.css">
		<link rel="stylesheet" type="text/css" href="style/Money.css">
		
 
	</head>
	<body> 
	<?php
			if(isset($activeUser)) {
		?>
		<div id="dvHeader" >
			<form method="POST" action="<?php $_PHP_SELF ?>">
				<table id="tblHeader">
					<tbody>
					<tr>
					
					<td> <img id="logo" src="Images/newlogo.png"   ></td>
		</div>
							<?php 
								if(isset($activeUser)) {
							?> 
        <div id="yazý">
			<td><strong><?php echo "Welcome " .$activeUser; ?> </strong></td>
								<?php
								}
								?>
							 </div>
							
							<td>
								<label for="input_exit">
									<img src="Images/exit.png" style="max-height: 35px;">
									<input id="input_exit" type="submit" style="display: none" name="logout" value="Göndert" >
								</label>
								<?php 
									if( isset($_POST["logout"]) ) {
										session_destroy();
										header("location: index.php");
									}
									
								?>
							 	
							 </td>
							
							</tr>
					        
						</tbody>
					</table>
				</form>
			</div>
		<div id="dvMain">
			<form method="POST" action="<?php $_PHP_SELF ?>">
				<table id="tblUsers">
					<tbody>
					
					
						<tr>
							
							<th><?php echo "BANKCARD " ?> </th>
							<th><?php echo "LIST" ?></th>
							<th><?php echo "AND " ?></th>
							<th><?php echo "DELETE" ?></th>
							<th></th>
							
							
						</tr>
						<tr>
							
							<th>Customer Number</th>
							<th>Customer Name</th>
							<th>Bankcard Number</th>
							<th>Valid Thru</th>
							
							
						</tr>
							
							<?php 
							$CardList = BankcardManager::getAllBankCard();
							
							for($i = 0; $i< count($CardList); $i++) {
							?>
							<tr>
								<td><?php echo $CardList[$i]->getCustomer_Number(); ?></td>
								<td><?php echo $CardList[$i]->getCustomer_Name(); ?></td>
								<td><?php echo $CardList[$i]->getBankCard_Number(); ?></td>
								<td><?php echo $CardList[$i]->getBankCard_ValidThru(); ?></td>
							</tr>
							<?php
							}
						    ?>
							<tr>
							<td>
								<a>Enter Card Number for Delete:</a>
							</td>
							<td>
								<input type="number" name="card_no"/>
							</td>
								
							<td>
							<form id="form1" name="form1" method="post" action="">
								<input type="submit" name="del" value="Delete" />
							</form>
							<?php
							$check=0;
								if(isset($_POST["del"])) {
									$card_number = trim($_POST["card_no"]);
									if($card_number != '' && strlen($card_number) ==16){
										$result = BankCardManager::DeleteBankcard($card_number);
										echo $result;
										if($result==NULL){
											
											echo '<script language="javascript">';
											echo 'alert("Card is not deleted please check boxes!")';
											echo '</script>';
											
										}
										else{
											echo '<script language="javascript">';
											echo 'alert("Card is deleted Successfully!")';
											echo '</script>';
											
										}
										
									}
									
									else{
										echo '<script language="javascript">';
										echo 'alert("Card is not deleted please check boxes!")';
										echo '</script>';
									}
									
								}
							?>
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
						
							<tr>
							
							<td>
							<form id="form1" name="form1" method="post" action="">
								<input type="submit" name="back" value="Back Admin Panel" />
								</form>
								<?php 
									if(isset($_POST["back"])) {
										header("location: AdminUI.php");
									}
									
								?>
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<?php
			}
			else {
					echo "<a href='AdminLoginPanel.php'>Giriþ yapýnýz!</a>";
				}
		?>
	</body> 
</html>