<?php 
	class Loan{
		private $Loan_ID;
		private $Customer_ID;
		private $Loan_Type;
		private $Loan_Amount;
		private $Start_Date;
		private $Installment_Number;
	
		
		
		function __construct($Loan_ID = NULL,$Customer_ID = NULL,  $Loan_Type = NULL,$Loan_Amount = NULL,$Start_Date= NULL,$Installment_Number = NULL) {
			$this->Loan_ID = $Loan_ID;
			$this->Customer_ID = $Customer_ID;
			$this->Loan_Type= $Loan_Type;
			$this->Loan_Amount = $Loan_Amount;
			$this->Start_Date = $Start_Date;
			$this->Installment_Number= $Installment_Number;
		
		}
		public function getLoan_ID() {
			return $this->Loan_ID;
		}
		
		public function getCustomer_ID() {
			return $this->Customer_ID;
		}
		
		public function getLoan_Type() {
			return $this->Loan_Type;
		}
		
		public function getLoan_Amount() {
			return $this->Loan_Amount;	
		}
		
		public function getStart_Date() {
			return $this->Start_Date;	
		}
		
		public function getInstallment_Number() {
			return $this->Installment_Number;
		}
		
		
	}
?>