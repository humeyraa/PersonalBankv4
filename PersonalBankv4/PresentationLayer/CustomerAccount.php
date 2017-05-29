<?php 
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/AccountManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
?>
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Accounts</title>
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
							<th>Account Number</th>
							<th>Balance</th>
							<th>Branch</th>
						</tr>
						<?php 
							$AccountList = AccountManager::getAllAccountbyCustomer($activeUser->getCustomer_ID());
							
							for($i = 0; $i< count($AccountList); $i++) {
							?>
							<tr>
								<td><?php echo $AccountList[$i]->getAccount_Number(); ?></td>
								<td><?php echo $AccountList[$i]->getBalance(); ?></td>
								<td><?php echo $AccountList[$i]->getBranch(); ?></td>
								
							</tr>
							<?php
							}
						    ?>
							<tr>
								<td>
								<input type="submit" name="back" value="Back Main Panel" />
								</td>
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