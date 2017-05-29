<?php
	require_once("DataLayer/DB.php");
	require_once("CreditCard.php");
	
	
	class CreditCardManager{
		
			public static function CreateCreditCard( $customerid ,$card_Number, $Security, $Pass, $Valid, $Limit, $availablalimit, $MontlyPayment,$min_Payment,$Due_date,$CutoffDate){
				$db = new DB();
				$success = $db->executeQuery("INSERT INTO creditcard_info(Customer_ID, CreditCard_Number, CreditSecurity_Number, CreditCard_Password, ValidThru, CardLimit, AvailableLimit, Montly_Payment, min_payment, due_date, cuttOff_date) VALUES ('$customerid','$card_Number','$Security','$Pass','$Valid', '$Limit','$availablalimit','$MontlyPayment','$min_Payment','$Due_date','$CutoffDate')");
				return $success;
			}
			
			public static function getCreditCard($id) {
				$db = new DB();
				$result = $db->getDataTable("SELECT distinct CreditCard_ID, creditcard_info.Customer_ID, CreditCard_Number, CreditSecurity_Number, CreditCard_Password, ValidThru, CardLimit, AvailableLimit, Montly_Payment, min_payment, due_date, cuttOff_date FROM creditcard_info,customer_info where creditcard_info.Customer_ID ='$id' ");
			
				$allCards = array();
			
				while($row = $result->fetch_assoc()) {
					$cardObj = new CreditCard($row["CreditCard_ID"], $row["Customer_ID"], $row["CreditCard_Number"],$row["CreditSecurity_Number"],$row["CreditCard_Password"],$row["ValidThru"],$row["CardLimit"], $row["AvailableLimit"], $row["Montly_Payment"],$row["min_payment"],$row["due_date"],$row["cuttOff_date"]);
					array_push($allCards , $cardObj);
				}
				return $allCards ;
			}
			public static function DeleteCreditcard($cardNumber) {
				$db = new DB();
				$result = $db->getDataTable("DELETE FROM creditcard_info WHERE CreditCard_Number='$cardNumber'"); 
				return $result;
			}
			
			public static function UpdatePassword($number,$password) {
			$db = new DB();
			$result = $db->getDataTable("UPDATE creditcard_info SET CreditCard_Password='".$password."' WHERE CreditCard_Number = '".$number."'"); 
			return $result;
			}
			
			public static function CheckCard($number) {
				$db = new DB();
				$result = $db->getDataTable("select CreditCard_ID, creditcard_info.Customer_ID, CreditCard_Number, CreditSecurity_Number, CreditCard_Password, ValidThru, CardLimit, AvailableLimit, Montly_Payment, min_payment, due_date, cuttOff_date FROM creditcard_info where creditcard_info.CreditCard_Number='$number'" );
			
				$cards = array();
			
				while($row = $result->fetch_assoc()) {
					$cardObj = new CreditCard($row["CreditCard_ID"], $row["Customer_ID"], $row["CreditCard_Number"],$row["CreditSecurity_Number"],$row["CreditCard_Password"],$row["ValidThru"],$row["CardLimit"], $row["AvailableLimit"], $row["Montly_Payment"],$row["min_payment"],$row["due_date"],$row["cuttOff_date"]);
					array_push($cards, $cardObj);
				}
				return $cards;
			}
	}
	
?>