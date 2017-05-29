<?php
	require_once("DataLayer/DB.php");
	require_once("Statement.php");
	
	
	class BankStatementManager{
		
			public static function InsertStatement($sender, $receiver, $date, $amount,$sendername,$receivername){
				$db = new DB();
				$success = $db->executeQuery("INSERT INTO account_bank_statements(Sender_Account ,Receiver_Account, Operation_Date, Amount,SenderCustomer_Name , ReceiverCustomer_Name) VALUES ('$sender','$receiver','$date','$amount', '$sendername','$receivername')");
				return $success;
			}
			
			public static function getAccountStatement($number) {
				$db = new DB();
				$result = $db->getDataTable("SELECT account_bank_statements.ID,account_bank_statements.Sender_Account,account_bank_statements.Receiver_Account,account_bank_statements.Operation_Date,account_bank_statements.Amount,account_bank_statements.SenderCustomer_Name,account_bank_statements.ReceiverCustomer_Name from account_bank_statements where account_bank_statements.Sender_Account='$number' or account_bank_statements.Receiver_Account='$number'");
			
				$allStatement = array();
			
				while($row = $result->fetch_assoc()) {
					$cardObj = new Statement($row["ID"], $row["Sender_Account"], $row["Receiver_Account"],$row["Operation_Date"],$row["Amount"],$row["SenderCustomer_Name"],$row["ReceiverCustomer_Name"]);
					array_push($allStatement , $cardObj);
				}
				return $allStatement ;
			}
			
	}
	
?>