<?php 
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/AccountManager.php");
	require_once("LogicLayer/BankStatementManager.php");
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
        <title>Bank Statements</title>
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
							<th>Select Customer</th>
							<th></th>
							
						</tr>
						
						<tr>
							<td>
								<select name = "Type">
								<option value="a">Select </option>
								<option value="b">Account Statements</option>
								<option value="c">BankCard Statements</option>
								<option value="d">CreditCard Statements</option>	
									
								</select>
							</td>
							<td>  
								<input type="submit" name="selectType" id="selectType" value="Select Statement Type"/>
								
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							
							
						</tr>
						<tr>
							<td>
								<select name = "Account">
								<option value ="a">Select</option>
								<?php 
								if(isset($_POST["selectType"])){
									$selectedtype= $_POST['Type'];
									if($selectedtype == "b"){
										$AccountList = AccountManager::getAllAccountbyCustomer($activeUser->getCustomer_ID());
							
										for($i = 0; $i < count($AccountList); $i++) {
										?>
											<option value="<?php echo $AccountList[$i]->getAccount_Number(); ?>"><?php echo $AccountList[$i]->getAccount_Number(); ?></option>
									
										<?php
										}
									}
								}
								?>
								</select>
							</td>
							<td>  
								<input type="submit" name="show" id="show" value="Show Bank Statements"/>
								
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							
						</tr>
					
						<tr>	
							<td>
								<input type="submit" name="back" value="Back Admin Panel" />
							</td>
							<td>
								
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php 
							if(isset($_POST["show"])){ 
						
							$account= $_POST['Account'];
							$StatementList = BankStatementManager::getAccountStatement($account);
							?>
							<tr>
								<th>From:</th>
								<th></th>
								<th>To:</th>
								<th></th>
								<th>Amount:</th>
								<th>Date:</th>
								
							</tr>	
							<?php
							for($i = 0; $i< count($StatementList); $i++) {
							?>
							<tr>
								<td><?php echo $StatementList[$i]->getSenderCustomer_Name(); ?></td>
								<td><?php echo $StatementList[$i]->getSender_Account(); ?></td>
								<td><?php echo $StatementList[$i]->getReceiverCustomer_Name(); ?></td>
								<td><?php echo $StatementList[$i]->getReceiver_Account(); ?></td>
								<td><?php echo $StatementList[$i]->getAmount(); ?></td>
								<td><?php echo $StatementList[$i]->getOperation_Date(); ?></td>
								
								
								
							</tr>
							<?php
							}
						    ?>
						
						<tr>		
									
						<?php			
							}
							if(isset($_POST["back"])) {
								header("location: PersonalUIExternal.php");
							}
									
								?>
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