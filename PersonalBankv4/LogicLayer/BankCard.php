<?php 
	class BankCard {
		private $BankCard_ID;
		private $Account_ID;
		private $BankCard_Number;
		private $BankCart_Security;
		private $BankCard_Password;
		private $BankCard_ValidThru;
		
		
		
		function __construct($BankCard_ID = NULL, $Account_ID = NULL, $BankCard_Number= NULL,$BankCart_Security= NULL, $BankCard_Password= NULL, $BankCard_ValidThru= NULL) {
			$this->BankCard_ID = $BankCard_ID;
			$this->Account_ID = $Account_ID;
			$this->BankCard_Number = $BankCard_Number;
			$this->BankCart_Security = $BankCart_Security;
			$this->BankCard_Password = $BankCard_Password;
			$this->BankCard_ValidThru = $BankCard_ValidThru;
			
		}
		public function getBankCard_ID() {
			return $this->BankCard_ID  ;
		}
		public function getAccount_ID () {
			return $this->Account_ID ;
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