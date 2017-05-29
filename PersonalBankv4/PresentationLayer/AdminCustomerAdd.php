<?php 
	require_once("LogicLayer/CustomerManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	
	$errorMeesage = "";
	
	if(isset($_POST["CustomerTC"]) && isset($_POST["CustomerName"]) && isset($_POST["CustomerNumber"]) && isset($_POST["CustomerPassword"]) && isset($_POST["CustomerGender"]) && isset($_POST["CustomerBirthDate"]) && isset($_POST["CustomerPhone"]) && isset($_POST["CustomerEmail"]) && isset($_POST["CustomerAddress"])&& isset($_POST["LoanPoint"])) {
		$TC = trim($_POST["CustomerTC"]);
		$number = trim($_POST["CustomerNumber"]);
		$password = trim($_POST["CustomerPassword"]);
		$name = trim($_POST["CustomerName"]);
		$gender = trim($_POST["CustomerGender"]);
		$birthdate = trim($_POST["CustomerBirthDate"]);
		$phone = trim($_POST["CustomerPhone"]);
		$email = trim($_POST["CustomerEmail"]);
		$address = trim($_POST["CustomerAddress"]);
		$loanpoint = trim($_POST["LoanPoint"]);
		$check=0;
			$errorMeesage = "";
				if($TC != '' && $number != '' && $password != '' && $name != '' && $gender != '' && $birthdate != '' && $phone != '' && $email != '' && $address != '' && $loanpoint != ''){
								
					$result = CustomerManager::AddCustomer($TC , $number,$password ,$name, $gender,$birthdate,$phone,$email,$address,$loanpoint);
					$check=1;
		
			}
			if($check==0) {
				$errorMeesage = "New Customer is not added please check boxes!";
			}
			else
				$errorMeesage = "New Customer is added Successfully!";
	}
?>
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Customer Add Panel </title>
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
							
							<th><?php echo "Customer Adding Panel " ?> </th><th></th>
							
						</tr>
						<tr>	
							<td>
								<a>Customer TC :  </a>
							</td>
							<td>
								<input type="number" name="CustomerTC"  />
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Name :  </a>
							</td>
							<td>
								<input type="text" name="CustomerName" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Number :  </a>
							</td>
							<td>
								<input type="number" name="CustomerNumber"/>
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Password :  </a>
							</td>
							<td>
								<input type="text" name="CustomerPassword" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Gender :  </a>
							</td>
							<td>
								<input type="text" name="CustomerGender"/>
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Birth Date :  </a>
							</td>
							<td>
								<input type="text" name="CustomerBirthDate"/>
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Phone :  </a>
							</td>
							<td>
								<input type="number" name="CustomerPhone" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Email :  </a>
							</td>
							<td>
								<input type="text" name="CustomerEmail" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Address :  </a>
							</td>
							<td>
								<input type="text" name="CustomerAddress" />
							</td>
						</tr>
						<tr>
							<td>
								<a>Customer Loan Point :  </a>
							</td>
							<td>
								<input type="number" name="LoanPoint" />
							</td>
						</tr>
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
								<input type="submit" name="save" value="Save!" />
								<?php 
									if(isset($errorMeesage)) {
										echo "<br>" . "<span style='color: red;'>" . $errorMeesage . "</span>";
									}
								?>
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

