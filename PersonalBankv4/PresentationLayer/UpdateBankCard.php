<?php 
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/AccountManager.php");
	require_once("LogicLayer/BankCardManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	$msg ="";
	$selectedcard="";
	$alertmsg="";
	
	
?>
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Update&List BankCard</title>
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
							<td> <img id="logo" src="Images/newlogo.png" ></td>
						
			</div>
							<?php 
								if(isset($activeUser)) {
							?> 
                             <div id="yazý">
								<td><strong><?php echo "Welcome " . $activeUser->getCustomer_Name(); ?> </strong></td>
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
							<th>Card Number</th>
							<th>Security Number</th>
							<th>Password</th>
							<th>Valid Thru</th>
						</tr>
						<tr>
							<?php 
							$CardList = BankCardManager::getAllCardsbyID($activeUser->getCustomer_ID());
							
							for($i = 0; $i< count($CardList); $i++) {
							?>
							<tr>
								<td><?php echo $CardList[$i]->getBankCard_Number(); ?></td>
								<td><?php echo $CardList[$i]->getBankCart_Security(); ?></td>
								<td><?php echo $CardList[$i]->getBankCard_Password(); ?></td>
								<td><?php echo $CardList[$i]->getBankCard_ValidThru(); ?></td>
								
							</tr>
							<?php
							}
						    ?>
						
						<tr>
							<td></td>								
							<td></td>	
							<td></td>
							<td></td>	
						</tr>
						
						<tr>
						
							<td>
								<a>Enter Card Number:</a>
							</td>								
							<td>  
								<input type="number" name="cardnumber" />							
							</td>	
							<td>  
								<a>Enter New Password:</a>							
							</td>
							<td>
								<input type="number" name="pass" />
							</td>
							
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
								
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								<input type="submit" name="update" value="Update Password" />
							</td>
							<td></td>
						</tr>
						<?php 
							if(isset($_POST["update"])) {
								if(isset($_POST["pass"]) && isset($_POST["cardnumber"])) {
									$cardN = trim($_POST["cardnumber"]);
									$password = trim($_POST["pass"]);
									if(strlen($password) == 4 && strlen($cardN) == 16){
										$CCard = BankCardManager::CheckCard($cardN);
										if($CCard == NULL){
											$alertmsg ="Card Number is Wrong Please Check Again!!";
										}
										else{
											$update = BankCardManager::UpdatePassword($cardN,$password);
											$alertmsg ="Password is Updated Successfully!!";
										}
									}
									else{
										$alertmsg =" Please enter 16-Digit card number and 4-Digit Password";
									}
								}
							}
						?>
						<tr>
							<td>
								<input type="submit" name="back" value="Back Main Panel" />
							</td>
							
							<td><?php echo $alertmsg ?></td>
							<td></td>
							<td></td>
								<?php 
									if(isset($_POST["back"])) {
										header("location: PersonalUIExternal.php");
									}
									
								?>
						</tr>
						
					</tbody>
					
				</table>
				
				
						
				
						
				
			</form>
		</div>
		<?php
			}
			else {
					echo "<a href='PersonaLoginPanel.php'>Giriþ yapýnýz!</a>";
				}
		?>
	</body> 
</html>