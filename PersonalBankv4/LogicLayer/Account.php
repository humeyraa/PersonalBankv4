<?php 
	class Account {
		private $Account_ID;
		private $Customer_ID;
		private $Account_Number;
		private $Balance;
		private $Branch;
		
		
		
		function __construct($Account_ID = NULL, $Customer_ID = NULL, $Account_Number= NULL,$Balance = NULL,$Branch= NULL) {
			$this->Account_ID = $Account_ID;
			$this->Customer_ID = $Customer_ID;
			$this->Account_Number = $Account_Number;
			$this->Balance = $Balance;
			$this->Branch = $Branch;
			
		}
		public function getAccount_ID () {
			return $this->Account_ID ;
		}
		
		public function getCustomer_ID() {
			return $this->Customer_ID;
		}
		public function getAccount_Number() {
			return $this->Account_Number;	
		}
		
		public function getBalance() {
			return $this->Balance ;	
		}
		
		public function getBranch() {
			return $this->Branch;
		}
		
	}
?>