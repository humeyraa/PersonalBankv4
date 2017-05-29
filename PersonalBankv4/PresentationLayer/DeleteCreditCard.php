<?php 
	require_once("LogicLayer/AccountManager.php");
	require_once("LogicLayer/BankCardManager.php");
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/CreditCardManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	
	
	
?>

<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Credit List and Delete Panel </title>
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
							
							<th><?php echo "CREDITCARD " ?> </th>
							<th><?php echo "LIST" ?></th>
							<th><?php echo "AND " ?></th>
							<th><?php echo "DELETE" ?></th>
							<th></th>
							<th></th>
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
								<input type="submit" name="select" value="Select Customer" />
								
							</td>
							<td>  
								<a> </a>
								
							</td>
							<td>  
								<a></a>
							</td>
							<td>  
								<a></a>
							</td>
							<td>  
								<a></a>
							</td>
							<td>  
								<a></a>
							</td>
							
							
						</tr>
						
						<tr>
							
							<th>Card Number</th>
							<th>Valid Thru</th>
							<th>Available Limit</th>
							<th>Montly Payment</th>
							<th>Min Payment</th>
							<th>Cutt-Off Date</th>
							<th>Due Date</th>
							
							
						</tr>
							
							<?php 
							if(isset($_POST["select"])){
							$cust = $_POST["Customer"];
							$CardList = CreditCardManager::getCreditCard($cust);
							
							
							for($i = 0; $i< count($CardList); $i++) {
							?>
							<tr>
								<td><?php echo $CardList[$i]->getCreditCard_Number(); ?></td>
								<td><?php echo $CardList[$i]->getValidThru(); ?></td>
								<td><?php echo $CardList[$i]->getAvailableLimit(); ?></td>
								<td><?php echo $CardList[$i]->getMontly_Payment(); ?></td>
								<td><?php echo $CardList[$i]->getmin_payment(); ?></td>
								<td><?php echo $CardList[$i]->getcuttOff_date(); ?></td>
								<td><?php echo $CardList[$i]->getdue_date(); ?></td>
							</tr>
							<?php
								}
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
										$result = CreditCardManager::DeleteCreditcard($card_number);
										
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