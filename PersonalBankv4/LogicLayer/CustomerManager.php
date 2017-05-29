<?php 
	require_once("DataLayer/DB.php");
	require_once("Customer.php");
	
	class CustomerManager{
		
		public static function AddCustomer ($Customer_TC,$Customer_Number,$Customer_Password,$Customer_Name, $Customer_Gender, $Customer_BirthDate,$Customer_Phone,$Customer_Email, $Customer_Address,$Customer_LoanPoint) {
			$db = new DB();
			$success = $db->executeQuery("INSERT INTO customer_info( Customer_TC, Customer_Number, Customer_Password, Customer_Name, Customer_Gender, Customer_BirthDate, Customer_Phone, Customer_Email, Customer_Address, Customer_LoanPoint) VALUES (  '$Customer_TC','$Customer_Number','$Customer_Password','$Customer_Name', '$Customer_Gender', '$Customer_BirthDate','$Customer_Phone','$Customer_Email', '$Customer_Address','$Customer_LoanPoint')");
			return $success;
		}
		public static function getAllCustomer () {
			$db = new DB();
			$result = $db->getDataTable("select Customer_ID,Customer_TC, Customer_Number, Customer_Password, Customer_Name, Customer_Gender, Customer_BirthDate, Customer_Phone, Customer_Email, Customer_Address, Customer_LoanPoint from customer_info order by Customer_Name");
			
			$allCustomers = array();
			
			while($row = $result->fetch_assoc()) {
				$customerObj = new Customer($row["Customer_ID"], $row["Customer_TC"], $row["Customer_Number"],$row["Customer_Password"],$row["Customer_Name"], $row["Customer_Gender"], $row["Customer_BirthDate"],$row["Customer_Phone"], $row["Customer_Email"], $row["Customer_Address"], $row["Customer_LoanPoint"]);
				array_push($allCustomers, $customerObj);
			}
			
			return $allCustomers;
		}
		public static function getCustomer($customernumber,$password) {
			$db = new DB();
			$result = $db->getDataTable("select Customer_ID,Customer_TC, Customer_Number, Customer_Password, Customer_Name, Customer_Gender, Customer_BirthDate, Customer_Phone, Customer_Email, Customer_Address, Customer_LoanPoint from customer_info where Customer_Number  = '".$customernumber."' and Customer_Password = '". $password."'");
			
			$allCustomers = array();
			
			while($row = $result->fetch_assoc()) {
				$customerObj = new Customer($row["Customer_ID"], $row["Customer_TC"], $row["Customer_Number"],$row["Customer_Password"],$row["Customer_Name"], $row["Customer_Gender"], $row["Customer_BirthDate"],$row["Customer_Phone"], $row["Customer_Email"], $row["Customer_Address"], $row["Customer_LoanPoint"]);
				array_push($allCustomers, $customerObj);
			}
			
			return $allCustomers;
		}
		public static function getCustomerbyID($customerid) {
			$db = new DB();
			$result = $db->getDataTable("select Customer_ID,Customer_TC, Customer_Number, Customer_Password, Customer_Name, Customer_Gender, Customer_BirthDate, Customer_Phone, Customer_Email, Customer_Address, Customer_LoanPoint from customer_info where Customer_ID = '".$customerid."'");
			
			$allCustomers = array();
			
			while($row = $result->fetch_assoc()) {
				$customerObj = new Customer($row["Customer_ID"], $row["Customer_TC"], $row["Customer_Number"],$row["Customer_Password"],$row["Customer_Name"], $row["Customer_Gender"], $row["Customer_BirthDate"],$row["Customer_Phone"], $row["Customer_Email"], $row["Customer_Address"], $row["Customer_LoanPoint"]);
				array_push($allCustomers, $customerObj);
			}
			
			return $allCustomers;
		}
		public static function getCustomerAccount($id) {
			$db = new DB();
			$result = $db->getDataTable("select customer_info.Customer_ID,customer_info.Customer_TC,customer_info.Customer_Number,customer_info.Customer_Password,customer_info.Customer_Name,customer_info.Customer_Gender,customer_info.Customer_Birthdate,customer_info.Customer_Phone,customer_info.Customer_Email,customer_info.Customer_Address,customer_info.Customer_LoanPoint from customer_info,account_info where account_info.Customer_ID =customer_info.Customer_ID and account_info.Account_ID='".$id."'");
			
			$allCustomers = array();
			
			while($row = $result->fetch_assoc()) {
				$customerObj = new Customer($row["Customer_ID"], $row["Customer_TC"], $row["Customer_Number"],$row["Customer_Password"],$row["Customer_Name"], $row["Customer_Gender"],$row["Customer_Birthdate"],$row["Customer_Phone"], $row["Customer_Email"], $row["Customer_Address"], $row["Customer_LoanPoint"]);
				array_push($allCustomers, $customerObj);
			}
			
			return $allCustomers;
		}
		
		public static function DeleteCustomer ($customernumber) {
			$db = new DB();
			$result = $db->getDataTable("DELETE FROM customer_info WHERE Customer_Number='$customernumber'"); 
			return $result;
		}
		
		public static function UpdatePassword($customerid,$password) {
			$db = new DB();
			$result = $db->getDataTable("UPDATE customer_info SET Customer_Password='".$password."' WHERE Customer_ID = '".$customerid."'"); 
			return $result;
		}
		
		public static function UpdatePhone($customerid,$phone) {
			$db = new DB();
			$result = $db->getDataTable("UPDATE customer_info SET Customer_Phone='".$phone."' WHERE Customer_ID = '".$customerid."'"); 
			return $result;
		}
		
		public static function UpdateEmail($customerid,$email) {
			$db = new DB();
			$result = $db->getDataTable("UPDATE customer_info SET Customer_Email='".$email."' WHERE Customer_ID = '".$customerid."'"); 
			return $result;
		}
		
		public static function UpdateAddress($customerid,$address) {
			$db = new DB();
			$result = $db->getDataTable("UPDATE customer_info SET Customer_Address='".$address."' WHERE Customer_ID = '".$customerid."'"); 
			return $result;
		}
		
	}




?>