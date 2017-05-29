<?php
	require_once("DataLayer/DB.php");
	require_once("BankCard.php");
	require_once("BankCard_Customer.php");
	
	class BankCardManager{
		
			public static function CreateBankCard( $Account_ID, $Bankcard_Number, $Security, $Pass, $Valid){
				$db = new DB();
				$success = $db->executeQuery("INSERT INTO bankcard_info(Account_ID,BankCard_Number ,BankCart_Security, BankCard_Password, BankCard_ValidThru) VALUES ('$Account_ID' , '$Bankcard_Number','$Security','$Pass','$Valid')");
				return $success;
			}
			
			public static function getAllBankCard () {
				$db = new DB();
				$result = $db->getDataTable("SELECT customer_info.Customer_Name,customer_info.Customer_Number, bankcard_info.BankCard_Number,bankcard_info.BankCart_Security,bankcard_info.BankCard_Password,bankcard_info.BankCard_ValidThru FROM customer_info INNER JOIN account_info ON customer_info.Customer_ID =account_info.Customer_ID INNER JOIN bankcard_info on account_info.Account_ID=bankcard_info.Account_ID");
			
				$allCards = array();
			
				while($row = $result->fetch_assoc()) {
					$cardObj = new BankCard_Customer($row["Customer_Name"], $row["Customer_Number"], $row["BankCard_Number"],$row["BankCart_Security"],$row["BankCard_Password"],$row["BankCard_ValidThru"]);
					array_push($allCards , $cardObj);
				}
				return $allCards ;
			}
			public static function DeleteBankcard($cardNumber) {
				$db = new DB();
				$result = $db->getDataTable("DELETE FROM bankcard_info WHERE BankCard_Number='$cardNumber'"); 
				return $result;
			}
			public static function getAllCardsbyID($customerid) {
				$db = new DB();
				$result = $db->getDataTable("select DISTINCT bankcard_info.BankCard_ID , bankcard_info.Account_ID , bankcard_info.BankCard_Number,bankcard_info.BankCart_Security ,bankcard_info.BankCard_Password,bankcard_info.BankCard_Password,bankcard_info.BankCard_ValidThru FROM customer_info,account_info,bankcard_info where bankcard_info.Account_ID=account_info.Account_ID and '$customerid'=account_info.Customer_ID" );
			
				$cards = array();
			
				while($row = $result->fetch_assoc()) {
					$cardObj = new BankCard($row["BankCard_ID"], $row["Account_ID"], $row["BankCard_Number"],$row["BankCart_Security"],$row["BankCard_Password"],$row["BankCard_ValidThru"]);
					array_push($cards, $cardObj);
				}
				return $cards;
			}
			
			public static function CheckCard($number) {
				$db = new DB();
				$result = $db->getDataTable("select bankcard_info.BankCard_ID , bankcard_info.Account_ID , bankcard_info.BankCard_Number,bankcard_info.BankCart_Security ,bankcard_info.BankCard_Password,bankcard_info.BankCard_Password,bankcard_info.BankCard_ValidThru FROM bankcard_info where bankcard_info.BankCard_Number='$number'" );
			
				$cards = array();
			
				while($row = $result->fetch_assoc()) {
					$cardObj = new BankCard($row["BankCard_ID"], $row["Account_ID"], $row["BankCard_Number"],$row["BankCart_Security"],$row["BankCard_Password"],$row["BankCard_ValidThru"]);
					array_push($cards, $cardObj);
				}
				return $cards;
			}
			
			public static function UpdatePassword($number,$password) {
			$db = new DB();
			$result = $db->getDataTable("UPDATE bankcard_info SET BankCard_Password='".$password."' WHERE BankCard_Number = '".$number."'"); 
			return $result;
		}
			
			
	}
?>