<?php 
	class Statement {
		private $ID;
		private $Sender_Account;
		private $Receiver_Account;
		private $Operation_Date;
		private $Amount;
		private $SenderCustomer_Name;
		private $ReceiverCustomer_Name;
		
		
		function __construct($ID= NULL, $Sender_Account = NULL, $Receiver_Account= NULL,$Operation_Date= NULL, $Amount= NULL, $SenderCustomer_Name= NULL, $ReceiverCustomer_Name= NULL) {
			$this->ID = $ID;
			$this->Sender_Account = $Sender_Account;
			$this->Receiver_Account = $Receiver_Account;
			$this->Operation_Date= $Operation_Date;
			$this->Amount = $Amount;
			$this->SenderCustomer_Name = $SenderCustomer_Name;
			$this->ReceiverCustomer_Name = $ReceiverCustomer_Name;
			
			
		}
		public function getID() {
			return $this->ID;
		}
		public function getSender_Account() {
			return $this->Sender_Account;
		}
		
		public function getReceiver_Account() {
			return $this->Receiver_Account;
		}
		public function getOperation_Date() {
			return $this->Operation_Date;	
		}
		
		public function getAmount() {
			return $this->Amount;	
		}
		
		public function getSenderCustomer_Name() {
			return $this->SenderCustomer_Name;	
		}
		
		public function getReceiverCustomer_Name() {
			return $this->ReceiverCustomer_Name;
		}
		
	
	}
?>