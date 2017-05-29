<?php 
	class BankCard_Customer {
		private $Customer_Name;
		private $Customer_Number;
		private $BankCard_Number;
		private $BankCart_Security;
		private $BankCard_Password;
		private $BankCard_ValidThru;
		
		
		
		function __construct($Customer_Name = NULL, $Customer_Number = NULL, $BankCard_Number= NULL,$BankCart_Security= NULL, $BankCard_Password= NULL, $BankCard_ValidThru= NULL) {
			$this->Customer_Name= $Customer_Name;
			$this->Customer_Number = $Customer_Number;
			$this->BankCard_Number = $BankCard_Number;
			$this->BankCart_Security = $BankCart_Security;
			$this->BankCard_Password = $BankCard_Password;
			$this->BankCard_ValidThru = $BankCard_ValidThru;
			
		}
		public function getCustomer_Name() {
			return $this->Customer_Name  ;
		}
		public function getCustomer_Number() {
			return $this->Customer_Number ;
		}
		
		public function getBankCard_Number() {
			return $this->BankCard_Number;
		}
		public function getBankCart_Security() {
			return $this->BankCart_Security;	
		}
		
		public function getBankCard_Password() {
			return $this->BankCard_Password ;	
		}
		
		public function getBankCard_ValidThru() {
			return $this->BankCard_ValidThru;
		}
		
	}
?>