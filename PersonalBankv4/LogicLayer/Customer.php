<?php 
	class Customer {
		private $Customer_ID;
		private $Customer_Name;
		private $Customer_TC;
		private $Customer_Number;
		private $Customer_Password;
		private $Customer_Gender;
		private $Customer_BirthDate;
		private $Customer_Phone;
		private $Customer_Email;
		private $Customer_Address;
		private $Customer_LoanPoint;
		
		
		function __construct($Customer_ID = NULL,  $Customer_TC = NULL,$Customer_Number = NULL,$Customer_Password = NULL,$Customer_Name = NULL, $Customer_Gender = NULL, $Customer_BirthDate = NULL,$Customer_Phone = NULL,$Customer_Email = NULL, $Customer_Address= NULL,$Customer_LoanPoint = NULL) {
			$this->Customer_ID = $Customer_ID;
			$this->Customer_Name = $Customer_Name;
			$this->Customer_TC = $Customer_TC;
			$this->Customer_Number = $Customer_Number;
			$this->Customer_Password = $Customer_Password;
			$this->Customer_Gender = $Customer_Gender;
			$this->Customer_BirthDate = $Customer_BirthDate;
			$this->Customer_Phone= $Customer_Phone;
			$this->Customer_Email= $Customer_Email;
			$this->Customer_Address = $Customer_Address;
			$this->Customer_LoanPoint = $Customer_LoanPoint;
			
			
		}
		
		public function getCustomer_ID() {
			return $this->Customer_ID;
		}
		
		public function getCustomer_Name() {
			return $this->Customer_Name;
		}
		
		public function getCustomer_Number() {
			return $this->Customer_Number;	
		}
		
		public function getCustomer_Password() {
			return $this->Customer_Password;	
		}
		
		public function getCustomer_TC() {
			return $this->Customer_TC;
		}
		
		public function getCustomer_Gender() {
			return $this->Customer_Gender;
		}
		
		public function getCustomer_BirthDate() {
			return $this->Customer_BirthDate;	
		}
		
		public function getCustomer_Phone() {
			return $this->Customer_Phone;	
		}
		public function getCustomer_Email() {
			return $this->Customer_Email;
		}
		
		public function getCustomer_Address() {
			return $this->Customer_Address;
		}
		
		public function getCustomer_LoanPoint() {
			return $this->Customer_LoanPoint;
		}
		
	}
?>