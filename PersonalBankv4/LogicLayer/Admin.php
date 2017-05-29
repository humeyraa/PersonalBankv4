<?php 
	class Admin {
		private $Admin_ID;
		private $Admin_Name;
		private $Admin_LoginName;
		private $Admin_Password;
		private $Admin_Phone;
		private $Admin_Email;
		
		function __construct($Admin_ID = NULL, $Admin_Name = NULL, $Admin_LoginName = NULL,$Admin_Password = NULL,$Admin_Phone = NULL,$Admin_Email = NULL) {
			$this->Admin_ID = $Admin_ID;
			$this->Admin_Name = $Admin_Name;
			$this->Admin_LoginName = $Admin_LoginName;
			$this->Admin_Password = $Admin_Password;
			$this->Admin_Phone = $Admin_Phone;
			$this->Admin_Email = $Admin_Email;
			
		}
		
		public function getAdmin_ID() {
			return $this->Admin_ID;
		}
		
		public function getAdmin_Name() {
			return $this->Admin_Name;
		}
		
		public function getAdmin_LoginName() {
			return $this->Admin_LoginName;	
		}
		
		public function getAdmin_Password() {
			return $this->Admin_Password;	
		}
		public function getAdmin_Phone() {
			return $this->Admin_Phone;	
		}
		public function getAdmin_Email() {
			return $this->Admin_Email;	
		}
	}
?>