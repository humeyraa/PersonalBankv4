<?php 
	require_once("LogicLayer/CustomerManager.php");
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
        <title>Personal Interface</title>
		<link rel="stylesheet" type="text/css" href="style/site.css">
		<link rel="stylesheet" type="text/css" href="style/Money.css">
	</head>
	<body> 
		<?php
			if(isset($activeUser)) {
				$customer = CustomerManager::getCustomerbyID($activeUser->getCustomer_ID());
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
        <div id="yazı">
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
			<div id="dvMenu" align="center">
				<form method="POST" action="<?php $_PHP_SELF ?>">
					<table id="tblMenu">
						<tbody>
							<tr>

								<td><input type="submit" name="Accounts" id="Accounts" value="Show Accounts"  /></td>
								<td></td>
								<td><input type="submit" name="Transfer" id="Transfer" value="Transfer"/></td>
								<td></td>
								<td><input type="submit" name="EFT" id="EFT" value="    EFT    "/></td>
								<td></td>
								<td><input type="submit" name="updatecards" id="updatecards" value="List&Update BankCards"/></td>
								<td></td>
								<td><input type="submit" name="listcredit" id="listcredit" value="List&Update CreditCards"/></td>
								<td></td>
								<td>
								<div class="box">
									<div class="container-2">
										<span class="icon"><i class="fa fa-search"></i></span>
										<input type="search" id="search" placeholder="Search..." />
									</div>
								</div>
								</td>
							</tr>
							<tr>

								<td><input type="submit" name="bankstatements" id="bankstatements" value="Bank Statements"  /></td>
								<td></td>
								<td><input type="submit" name="Transfer" id="Transfer" value="Transfer"/></td>
								
								<td></td>
								<td><input type="submit" name="Payment" id="Payments" value="Payments"/></td>
								<td></td>
								<td><input type="submit" name="updatecards" id="updatecards" value="List&Update BankCards"/></td>
								<td></td>
								<td><input type="submit" name="loan" id="loan" value="Loan"/></td>
								<td></td>
								
								
							</tr>
							<?php 
									
									if(isset($_POST["Accounts"])) {
										header("location: CustomerAccountExternal.php");
									}
									if(isset($_POST["Transfer"])) {
										header("location: CustomerMoneyTransferExternal.php");
									}
									if(isset($_POST["updatecards"])) {
										header("location: UpdateBankCardExternal.php");
									}
									if(isset($_POST["listcredit"])) {
										header("location: UpdateCreditCardExternal.php");
									}
									if(isset($_POST["bankstatements"])) {
										header("location: BankStatementExternal.php");
									}
									if(isset($_POST["loan"])) {
										header("location: CustomerLoanApplicationExternal.php");
									}
								?>
						</tbody>
					</table>
				</form>
         </div>
		<div id="dvMain">
			<form method="POST" action="<?php $_PHP_SELF ?>">
				<table id="tblUsers">
					<tbody>
						
						<tr>
							<td><a>TC No:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_TC() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><a>Customer Number:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Number() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
						
							<td><a>Password:<a/></td>
							<td><label><?php echo $customer[0]->getCustomer_Password() ?></label></td>
							<td><input type="text" name="pass" /></td>
							<td><input type="submit" name="updatepass" id="updatepass" value="Update"/></td>
						</tr>
						<tr>
							<td><a>Birth Date:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_BirthDate() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><a>Phone No:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Phone() ?> <a/></td>
							<td><input type="text" name="phone" /></td>
							<td><input type="submit" name="updatephone" id="updatephone" value="Update"/></td>
						</tr>
						<tr>
							<td><a>E-Mail Address:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Email() ?> <a/></td>
							<td><input type="text" name="email" /></td>
							<td><input type="submit" name="updateemail" id="updateemail" value="Update"/></td>
						</tr>
						<tr>
							<td><a>Home Address:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Address() ?> <a/></td>
							<td><input type="text" name="address" /></td>
							<td><input type="submit" name="updateaddress" id="updateaddress" value="Update"/></td>
						</tr>
						<tr>
							<td><a>Loan Point:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_LoanPoint() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						
						
						
						
						<?php
					
							if(isset($_POST["updatepass"])) {
								
								$cus_pass = trim($_POST["pass"]);
								
								if($cus_pass != '' && strlen($cus_pass) ==6){
									
										$result = CustomerManager::UpdatePassword($activeUser->getCustomer_ID(),$cus_pass);
										
								}
							}
							
							if(isset($_POST["updatephone"])) {
								
								$cus_phone = trim($_POST["phone"]);
								
								if($cus_phone != '' && strlen($cus_phone) ==11){
									
										$result = CustomerManager::UpdatePhone($activeUser->getCustomer_ID(),$cus_phone);
										
								}
							}
							if(isset($_POST["updateemail"])) {
								
								$cus_email = trim($_POST["email"]);
								
								if($cus_email != ''){
									
										$result = CustomerManager::UpdateEmail($activeUser->getCustomer_ID(),$cus_email);
										
								}
							}
							
							if(isset($_POST["updateaddress"])) {
								
								$cus_address = trim($_POST["address"]);
								
								if($cus_address != '' ){
									
										$result = CustomerManager::UpdateAddress($activeUser->getCustomer_ID(),$cus_address);
										
								}
							}
							
							
							
							
						
						?>
						
						
					</tbody>
					
				</table>
				
				
						
				
						
				
			</form>
		</div>
		<?php
			}
			else {
					header("location: PersonalLoginPanel.php");
				}
		?>
	</body> 
</html>