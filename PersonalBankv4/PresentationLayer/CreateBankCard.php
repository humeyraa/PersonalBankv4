<?php 
    require_once("LogicLayer/AccountManager.php");
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/BankCardManager.php");
	
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	$selectedCust =0;
	if(isset($_POST["accountnumber"]) && isset($_POST["branch"])) {
		
		
		
				
		
			$AccountN = trim($_POST["accountnumber"]);
			$brch = trim($_POST["branch"]);
		
			$check=0;
			$errorMeesage = "";
				if($AccountN != '' && $brch!= '' && strlen($AccountN) == 16){
					$selectedCust = $_POST['Customer'];
					
					$Balance=0;
					$result = AccountManager::CreateNewAccount($selectedCust , $AccountN,$Balance ,$brch );
					
					$check=1;
		
			}
			if($check==0) {
				echo '<script language="javascript">';
				echo 'alert("New Account is not created please check boxes!")';
				echo '</script>';
				
			}
			else{
				echo '<script language="javascript">';
				echo 'alert("New Account is created Successfully!")';
				echo '</script>';
			}
				
	}
?>
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Create BankCard Account</title>
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
							<th>Select Customer</th>
							<th></th>
							
						</tr>
						
						<tr>
							<td>
								<select name = "Customer">
								<option>Select Customer</option>
								<?php 
									$CustomerList = CustomerManager::getAllCustomer();
							
									for($i = 0; $i < count($CustomerList); $i++) {
									?>
										<option value="<?php echo $CustomerList[$i]->getCustomer_ID(); ?>"><?php echo $CustomerList[$i]->getCustomer_Name(); ?></option>
									
									<?php
									}
								?>
								</select>
							</td>
							<td>  
								<input type="submit" name="selectCust" id="selectCust" value="Select Customer"/>
								
							</td>
							
							
						</tr>
						<tr>
							<td>
								<select name = "Account">
								<option value ="a">Select Account</option>
								<?php 
								if(isset($_POST["selectCust"])){
									$selectedCustid = $_POST['Customer'];
									$AccountList = AccountManager::getAllAccountbyCustomer($selectedCustid);
							
									for($i = 0; $i < count($AccountList); $i++) {
									?>
										<option value="<?php echo $AccountList[$i]->getAccount_ID(); ?>"><?php echo $AccountList[$i]->getAccount_Number(); ?></option>
									
									<?php
									}
								}
								?>
								</select>
							</td>
							<td>  
								
								
							</td>
							
							
						</tr>
						<tr>	
							<td>
								<a>Card Number 16-Digit :  </a>
							</td>
							<td>
								<input type="number" name="cardnumber"  />
							</td>
						</tr>
						<tr>
							<td>
								<a>Security Number 3-Digit :  </a>
							</td>
							<td>
								<input type="number" name="securitynumber" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Card Password 4-Digit :  </a>
							</td>
							<td>
								<input type="number" name="password" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Valid Thru :  </a>
							</td>
							<td>
								<input type="text" name="validthru" />
							</td>
						</tr>
						<tr>	
							<td>
								
							</td>
							<td>
								<input type="submit" name="createbankcard" id="createbankcard" value="Create a Bank Card"  />
							</td>
						</tr>
						<tr>	
							<td>
								<input type="submit" name="back" value="Back Admin Panel" />
							</td>
							<td>
								
							</td>
						</tr>
						<?php 
									if(isset($_POST["createbankcard"])){
										if(isset($_POST["cardnumber"]) && isset($_POST["securitynumber"])&& isset($_POST["password"]) && isset($_POST["validthru"])) {
											$cardn= trim($_POST["cardnumber"]);
											$securityn= trim($_POST["securitynumber"]);
											$pass = trim($_POST["password"]);
											$validthru = trim($_POST["validthru"]);
											$accountid = $_POST['Account'];
											
										
											if(strlen($cardn) == 16 && strlen($securityn) == 3 && strlen($pass) == 4 && strlen($validthru) == 10){
												
												if($accountid =="a"){
													echo '<script language="javascript">';
													echo 'alert("Please select account")';
													echo '</script>';
												}
												else{
													$card= BankCardManager::CreateBankCard( $accountid, $cardn, $securityn, $pass, $validthru);
													echo '<script language="javascript">';
													echo 'alert("Card is created succesfully!!")';
													echo '</script>';
												}
												
											}
											else{
												echo '<script language="javascript">';
												echo 'alert("Please check boxes!!")';
												echo '</script>';
												
											}
										
										}
									}
									if(isset($_POST["back"])) {
										header("location: AdminUI.php");
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
