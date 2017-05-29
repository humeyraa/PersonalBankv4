<?php
	require_once("LogicLayer/AdminManager.php");
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
        <title>Admin Interface</title>
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
        <div id="yazı">
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
			<div id="dvMenu" align="center">
				<form method="POST" action="<?php $_PHP_SELF ?>">
					<table id="tblMenu">
						<tbody>
							<tr>

								<td><input type="submit" name="newCustomer" id="newCustomer" value="Add New Customer   "  /></td>
								<td></td>
								<td><input type="submit" name="deleteCustomer" id="deleteCustomer" value="Delete Customer  "/></td>
								<td></td>
								<td><input type="submit" name="CreateAccountforCustomer" id="CreateAccountforCustomer" value="Create Account           "/></td>
								<td></td>
								<td><input type="submit" name="DeleteAccount" id="DeleteAccount" value="Delete Account     "/></td>
								<td></td>
								<td><input type="submit" name="createbankcard" id="createbankcard" value="Create BankCard"/></td>
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

								<td><input type="submit" name="deletebankcard" id="deletebankcard" value="List&Delete BankCard"  /></td>
								<td></td>
								<td><input type="submit" name="createcredit" id="createcredit" value="Create CreditCard"/></td>
								
								<td></td>
								<td><input type="submit" name="deletecreditcard" id="deletecreditcard" value="List&Delete CreditCard"/></td>
								<td></td>
								<td><input type="submit" name="updatecards" id="updatecards" value="List&Update Cards"/></td>
								<td></td>
								<td><input type="submit" name="Loan" id="Loan" value="Loan"/></td>
								<td></td>
								
								
							</tr>
							<?php 
									
									
							if(isset($_POST["newCustomer"])) {
								header("location: AdminCustomerAddExternal.php");
							}
							else if(isset($_POST["deleteCustomer"])) {
								header("location: AdminDeleteCustomerExternal.php");
							}
							else if(isset($_POST["CreateAccountforCustomer"])) {
								header("location: AdminCreateAccountExternal.php");
							}
							else if(isset($_POST["DeleteAccount"])) {
								header("location: AdminDeleteAccountExternal.php");
							}
							else if(isset($_POST["createbankcard"])) {
								
								header("location: CreateBankCardExternal.php");
							}
							else if(isset($_POST["deletebankcard"])) {
								
								header("location: DeleteBankCardExternal.php");
							}
							else if(isset($_POST["createcredit"])) {
								
								header("location: CreateCreditCardExternal.php");
							}
							else if(isset($_POST["deletecreditcard"])) {
								
								header("location: DeleteCreditCardExternal.php");
							}
							else if(isset($_POST["Loan"])) {
								
								header("location: AdminLoanExternal.php");
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
							<th>Name</th>
							<th>Phone No</th>
							<th>Email Address</th>
							<th></th>
						</tr>
						<?php 
							$adminList = AdminManager::getAllAdmins();
							
							for($i = 0; $i < count($adminList); $i++) {
							?>
							<tr>
								<td><?php echo $adminList[$i]->getAdmin_Name(); ?></td>
								<td><?php echo $adminList[$i]->getAdmin_Phone(); ?></td>
								<td><?php echo $adminList[$i]->getAdmin_Email(); ?></td>
								<td></td>
							</tr>
							<?php
							}
						?>
						
						
						
						
					</tbody>
					
				</table>
				
				
						
				
						
				
			</form>
		</div>
		<?php
			}
			else {
					echo "<a href='AdminLoginPanel.php'>Giriş yapınız!</a>";
				}
		?>
	</body> 
</html>
