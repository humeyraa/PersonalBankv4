<?php 
    require_once("Loan.php");
	require_once("DataLayer/DB.php");
	
	
	class LoanManager{
		
		public static function AddLoan ($Customer_ID ,  $Loan_Type ,$Loan_Amount,$Start_Date,$Installment_Number ) {
			$db = new DB();
			$success = $db->executeQuery("INSERT INTO loan_info (Customer_ID ,  Loan_Type,Loan_Amount ,Start_Date,Installment_Number  ) VALUES (  '$Customer_ID ','$Loan_Type','$Loan_Amount','$Start_Date', '$Installment_Number')");
			return $success;
		}
		public static function getAllLoans() {
			$db = new DB();
			$result = $db->getDataTable("select Loan_ID, Customer_ID ,Loan_Type,Loan_Amount ,Start_Date,Installment_Number from loan_info ");
			
			$allLoans = array();
			
			while($row = $result->fetch_assoc()) {
				$loanObj = new Loan($row["Loan_ID"],$row["Customer_ID"], $row["Loan_Type"], $row["Loan_Amount"],$row["Start_Date"],$row["Installment_Number"]);
				array_push($allLoans, $loanObj);
			}
			
			return $allLoans;
		}
		
		public static function getLoanbyID($customerid) {
			$db = new DB();
			$result = $db->getDataTable("select Loan_ID, Customer_ID ,  Loan_Type,Loan_Amount ,Start_Date,Installment_Number  from loan_info where Customer_ID = '".$customerid."'");
			
			$allLoans = array();
			
			while($row = $result->fetch_assoc()) {
				$loanObj = new Loan($row["Loan_ID"],$row["Customer_ID"], $row["Loan_Type"], $row["Loan_Amount"],$row["Start_Date"],
					$row["Installment_Number"]);
				array_push($allLoans, $loanObj);
			}
			
			return $allLoans;
		}
		
		public static function DeleteLoan($customerid) {
			$db = new DB();
			$result = $db->getDataTable("DELETE FROM loan_info WHERE Customer_ID='$customerid'"); 
			return $result;
		}
		public static function DeleteLoanbyLoanId($loanid) {
			$db = new DB();
			$result = $db->getDataTable("DELETE FROM loan_info WHERE Loan_ID='$loanid'"); 
			return $result;
		}
		
		
		
		
		
	}




?>