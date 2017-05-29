<?php 
	class CreditCard {
		private $CreditCard_ID;
		private $Customer_ID;
		private $CreditCard_Number;
		private $CreditSecurity_Number;
		private $CreditCard_Password;
		private $ValidThru;
		private $CardLimit;
		private $AvailableLimit;
		private $Montly_Payment;
		private $min_payment;
		private $due_date;
		private $cuttOff_date;
		
		
		function __construct($CreditCard_ID= NULL, $Customer_ID = NULL, $CreditCard_Number= NULL,$CreditSecurity_Number= NULL, $CreditCard_Password= NULL, $ValidThru= NULL,$CardLimit= NULL, $AvailableLimit = NULL, $Montly_Payment= NULL,$min_payment= NULL,  $due_date= NULL, $cuttOff_date= NULL) {
			$this->CreditCard_ID = $CreditCard_ID;
			$this->Customer_ID = $Customer_ID;
			$this->CreditCard_Number = $CreditCard_Number;
			$this->CreditSecurity_Number = $CreditSecurity_Number;
			$this->CreditCard_Password = $CreditCard_Password;
			$this->ValidThru = $ValidThru;
			$this->CardLimit = $CardLimit;
			$this->AvailableLimit = $AvailableLimit;
			$this->Montly_Payment = $Montly_Payment;
			$this->min_payment = $min_payment;
			$this->due_date = $due_date;
			$this->cuttOff_date = $cuttOff_date;
			
		}
		public function getCreditCard_ID() {
			return $this->CreditCard_ID  ;
		}
		public function getCustomer_ID() {
			return $this->Customer_ID;
		}
		
		public function getCreditCard_Number() {
			return $this->CreditCard_Number;
		}
		public function getCreditSecurity_Number() {
			return $this->CreditSecurity_Number;	
		}
		
		public function getCreditCard_Password() {
			return $this->CreditCard_Password;	
		}
		
		public function getValidThru() {
			return $this->ValidThru;
		}
		public function getCardLimit() {
			return $this->CardLimit  ;
		}
		public function getAvailableLimit() {
			return $this->AvailableLimit;
		}
		
		public function getMontly_Payment() {
			return $this->Montly_Payment;
		}
		public function getmin_payment() {
			return $this->min_payment;	
		}
		
		public function getdue_date() {
			return $this->due_date;	
		}
		
		public function getcuttOff_date() {
			return $this->cuttOff_date;
		}
		
	}
?>