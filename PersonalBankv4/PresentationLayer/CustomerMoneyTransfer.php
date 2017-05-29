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
	
	
?>
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Money Transfer</title>
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
							<?php 
								if(isset($activeUser)) {
							?> 
							<th><?php echo "Welcome " . $activeUser->getCustomer_Name(); ?> </th>
							<?php
							}
							?>
							<td></td>
							
							<td>
							<input type="submit" name="logout" id="logout" value="Log Out"/>
							</td>
						</tr>
						
							<td>
								<select name = "Account">
								<option value ="0">Select Your Account</option>
								<?php 
									$AccountList = AccountManager::getAllAccountbyCustomer($activeUser->getCustomer_ID());
							
									for($i = 0; $i < count($AccountList); $i++) {
									?>
										<option value="<?php echo $AccountList[$i]->getAccount_ID(); ?>"><?php echo $AccountList[$i]->getAccount_Number(); ?></option>
									
									<?php
									}
								?>
								</select>
							</td>								
							<td>  
								<input type="submit" name="selectaccount" value="Show Balance" />							
							</td>	
							<td>  
								<a> <?php 
							if(isset($_POST["selectaccount"])){
									
								$selectedaccountid = $_POST['Account'];
								if($selectedaccountid == "0"){
									echo "Account is not selected!!";
								}
								else{
									$balance  = AccountManager::getAccountbyID($selectedaccountid);
									echo "Account: " . $balance[0]->getAccount_Number(). " Balance : ".  $balance[0]->getBalance();
									
										
									
							?> </a>					
							</td>
							
							
						</tr>
						</tr>
						
							<td>
								
							</td>								
							<td>  
														
							</td>	
							<td>  
								<a>
								<?php  
								echo " If account is Ok, please mark same account again!";
								}
									
							} 
								?>
								
								</a>	
							
							
							</td>
							
							
						</tr>
						</tr>
						
							<td>
								
							</td>								
							<td>  
								<a>Enter Amount :</a>							
							</td>	
							<td>  
								<input type="text" name="amount" />							
							</td>
							
							
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								<a>Enter Receiver Account Number :</a>
							</td>
							<td>
								<input type="text" name="receiveraccount" />
							</td>
								
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								<input type="submit" name="transfer" value="Make Transfer" />
							</td>
								
						</tr>
						<?php 
							if(isset($_POST["transfer"])) {
								if(isset($_POST["amount"]) && isset($_POST["receiveraccount"])) {
		
									$transferamount = trim($_POST["amount"]);
									$account = trim($_POST["receiveraccount"]);
											
											
									if($transferamount != '' && $account!= '' && strlen($account) == 16){
										$selectedaccount = $_POST['Account'];
										if($selectedaccount !=0){
											$controlbalance = AccountManager::getAccountbyID($selectedaccount);
												
											if($controlbalance[0]->getBalance() >= $transferamount){
												$controlaccount = AccountManager::getAccountbyNumber($account);
												if($controlaccount ==null)	{
													$msg=" Receiver account is wrong please check again!!";
													//buraya kurumsal bankanýn webservisi gelicek
												}
												else{
													
													if($controlaccount[0]->getAccount_Number() !=null){
													
													$decreasebalance = $controlbalance[0]->getBalance()-$transferamount;
														
													$decreaseaccount = AccountManager::UpdateBalance($decreasebalance,$controlbalance[0]->getAccount_ID());
													$increasebalance = $controlaccount[0]->getBalance()+$transferamount;
														
													$increaseaccount = AccountManager::UpdateBalance($increasebalance,$controlaccount[0]->getAccount_ID());
													$msg="Money Transfer is Succesfull " .$transferamount. " is sended, your actual balance is ".$decreasebalance. "!!";
													
													$currentdate = date("d.m.Y");
													$sendercustname=CustomerManager::getCustomerAccount($controlbalance[0]->getAccount_ID());
													$receivercustname=CustomerManager::getCustomerAccount($controlaccount[0]->getAccount_ID());
													$accountlog =BankStatementManager::InsertStatement($controlbalance[0]->getAccount_Number(), $controlaccount[0]->getAccount_Number(),$currentdate,$transferamount,$sendercustname[0]->getCustomer_Name(),$receivercustname[0]->getCustomer_Name());
													
													}
													
												}
												
													
												
												
											}
											else{
												$msg=" Balance does not provide transfer amount!!";
											}
										}
										else{
											$msg="Select sender account again!!";
										}
									}
									else{
									$msg="Please check boxes!!";
									}		
				
								}
								
							}
								?>
						<tr>
							<td>
								<input type="submit" name="back" value="Back Main Panel" />
							</td>
							<td><?php echo $msg ?></td>
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