<?php 
    require_once("LogicLayer/AccountManager.php");
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/CreditCardManager.php");
	
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
        <title>Create Credit Card</title>
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
								<option value ="a">Select Customer</option>
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
								<a>Limit :  </a>
							</td>
							<td>
								<input type="number" name="limit" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Cut-Off Date  :  </a>
							</td>
							<td>
								<input type="text" name="cuttoff" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Due Date :  </a>
							</td>
							<td>
								<input type="text" name="duedate" />
							</td>
						</tr>
						<tr>	
							<td>
								
							</td>
							<td>
								<input type="submit" name="createcard" id="createcard" value="Create a Credit Card"  />
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
									
									if(isset($_POST["createcard"])){
										if(isset($_POST["cardnumber"]) && isset($_POST["securitynumber"])&& isset($_POST["password"]) && isset($_POST["validthru"]) && isset($_POST["limit"]) && isset($_POST["cuttoff"]) && isset($_POST["duedate"])) {
											$cardn= trim($_POST["cardnumber"]);
											$securityn= trim($_POST["securitynumber"]);
											$pass = trim($_POST["password"]);
											$validthru = trim($_POST["validthru"]);
											$customerid = $_POST['Customer'];
											$lmt= trim($_POST["limit"]);
											$ddate= trim($_POST["duedate"]);
											$coff = trim($_POST["cuttoff"]);
											
											$montlyp="0";
											$minp="0";
											
										
											if(strlen($cardn) == 16 && strlen($securityn) == 3 && strlen($pass) == 4 && strlen($validthru) == 10 && strlen($ddate) == 2 && strlen($coff) == 2){
												
												if($customerid =="a"){
													echo '<script language="javascript">';
													echo 'alert("Please select account")';
													echo '</script>';
												}
												else{
													$card= CreditCardManager::CreateCreditCard( $customerid, $cardn, $securityn, $pass, $validthru,$lmt,$lmt,$montlyp,$minp,$ddate,$coff);
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
