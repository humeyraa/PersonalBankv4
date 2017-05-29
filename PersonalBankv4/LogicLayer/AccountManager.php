<?php
	require_once("DataLayer/DB.php");
	require_once("Account.php");
	
	class AccountManager{
		
			public static function CreateNewAccount( $Customer_ID , $Account_Number,$Balance ,$Branch){
				$db = new DB();
				$success = $db->executeQuery("INSERT INTO account_info(Customer_ID , Account_Number,Balance ,Branch) VALUES ('$Customer_ID' , '$Account_Number','$Balance ','$Branch')");
				return $success;
			}
		
			public static function DeleteAccount ($accountNumber) {
				$db = new DB();
				$result = $db->getDataTable("DELETE FROM account_info WHERE Account_Number='$accountNumber'"); 
				return $result;
			}
			
			public static function getAllAccount () {
				$db = new DB();
				$result = $db->getDataTable("select Account_ID , Customer_ID , Account_Number,Balance ,Branch from account_info order by Customer_ID");
			
				$allAccounts = array();
			
				while($row = $result->fetch_assoc()) {
					$accountObj = new Account($row["Account_ID"], $row["Customer_ID"], $row["Account_Number"],$row["Balance"],$row["Branch"]);
					array_push($allAccounts, $accountObj);
				}
				return $allAccounts;
			}
			
			public static function getAllAccountbyCustomer($customerid) {
				$db = new DB();
				$result = $db->getDataTable("select Account_ID , Customer_ID , Account_Number,Balance ,Branch from account_info where Customer_ID='".$customerid."'");
			
				$allAccounts = array();
			
				while($row = $result->fetch_assoc()) {
					$accountObj = new Account($row["Account_ID"], $row["Customer_ID"], $row["Account_Number"],$row["Balance"],$row["Branch"]);
					array_push($allAccounts, $accountObj);
				}
				return $allAccounts;
			}
			
			public static function getAccountbyID($id) {
				$db = new DB();
				$result = $db->getDataTable("select Account_ID , Customer_ID , Account_Number,Balance ,Branch from account_info where Account_ID='".$id."'");
			
				$Account = array();
			
				while($row = $result->fetch_assoc()) {
					$accountObj = new Account($row["Account_ID"], $row["Customer_ID"], $row["Account_Number"],$row["Balance"],$row["Branch"]);
					array_push($Account, $accountObj);
				}
				return $Account;
			}
			
			public static function getAccountbyNumber($number) {
				$db = new DB();
				$result = $db->getDataTable("select Account_ID , Customer_ID , Account_Number,Balance ,Branch from account_info where Account_Number='".$number."'");
			
				$Account = array();
			
				while($row = $result->fetch_assoc()) {
					$accountObj = new Account($row["Account_ID"], $row["Customer_ID"], $row["Account_Number"],$row["Balance"],$row["Branch"]);
					array_push($Account, $accountObj);
				}
				return $Account;
			}
			
			public static function UpdateBalance($balance,$id) {
				$db = new DB();
				$result = $db->getDataTable("UPDATE account_info SET Balance='".$balance."' WHERE Account_ID = '".$id."'"); 
				return $result;
			}
			
			
	}
	
 ?>