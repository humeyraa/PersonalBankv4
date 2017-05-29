<?php 
    require_once("LogicLayer/LoanManager.php");
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
							<th>Loan Number</th>
							<th>Customer Name</th>
							<th>Loan Type</th>
							<th>Loan Amount</th>
							<th>Start Date</th>
							<th>Installment Number</th>
						</tr>

						<?php 
							$LoanList = LoanManager:: getAllLoans();
							
							for($i = 0; $i< count($LoanList); $i++) {
								$CustomerList= CustomerManager::getCustomerbyID($LoanList[$i]->getCustomer_ID());
							?>
							<tr>
							    <td><?php echo $LoanList[$i]->getLoan_ID(); ?></td>
								<td><?php echo $CustomerList[0]->getCustomer_Name(); ?></td>
								<td><?php echo $LoanList[$i]->getLoan_Type(); ?></td>
								<td><?php echo $LoanList[$i]->getLoan_Amount(); ?></td>
								<td><?php echo $LoanList[$i]->getStart_Date(); ?></td>
								<td><?php echo $LoanList[$i]->getInstallment_Number(); ?></td>
							</tr>
							<?php
							}
						    ?>
							<tr>
								<td>
								<input type="submit" name="back" value="Back Main Panel" />
								</td>
								
								<td>
								<input type="submit" name="deleteLoan" value="Enter Loan Number" />
								</td>
								<td>
								<input type="text" name="loanid"/>
							    </td>
                          <td>
							<form id="form1" name="form1" method="post" action="">
								<input type="submit" name="del" value="Delete" />
							</form>
							<?php
							$check=0;
								if(isset($_POST["del"])) {
									$loanid = trim($_POST["loanid"]);
									if($loanid != '' ){
										$result = LoanManager :: DeleteLoanbyLoanId($loanid);
										
										if(!$result){
											echo '<script language="javascript">';
											echo 'alert("Loan is not deleted please check boxes!")';
											echo '</script>';
											
										}
										else{
											echo '<script language="javascript">';
											echo 'alert("Loan is deleted Successfully!")';
											echo '</script>';
											
										}
										
									}
									
									else{
										echo '<script language="javascript">';
										echo 'alert("Loan is not deleted please check boxes!")';
										echo '</script>';
									}
									
								}
							?>
							</td>







								<td></td>
								<td></td>
								<?php 
									if(isset($_POST["back"])) {
										header("location: AdminUIExternal.php");
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
					echo "<a href='AdminLoginPanel.php'>Giriþ yapýnýz!</a>";
				 }
		?>
	</body> 
</html>