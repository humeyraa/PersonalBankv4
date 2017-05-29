<?php 
	require_once("DataLayer/DB.php");
	require_once("Admin.php");
	
	class AdminManager{
		
		public static function getAdmin ($LoginName, $Password) {
			$db = new DB();
			$result = $db->getDataTable("select Admin_ID, Admin_Name,Admin_LoginName,Admin_Password,Admin_Phone,Admin_Email from Admins where Admin_LoginName = '".$LoginName."' and Admin_Password = '". $Password."'");
			
			$Admins = array();
			
			while($row = $result->fetch_assoc()) {
				$adminObj = new Admin($row["Admin_ID"], $row["Admin_Name"], $row["Admin_LoginName"],$row["Admin_Password"],$row["Admin_Phone"],$row["Admin_Email"]);
				array_push($Admins, $adminObj);
			}
			
			return $Admins;
			
		}
		public static function getAllAdmins () {
			$db = new DB();
			$result = $db->getDataTable("select Admin_ID, Admin_Name,Admin_LoginName,Admin_Password,Admin_Phone,Admin_Email from Admins");
			
			$allAdmins = array();
			
			while($row = $result->fetch_assoc()) {
				$userObj = new Admin($row["Admin_ID"], $row["Admin_Name"], $row["Admin_LoginName"],$row["Admin_Password"],$row["Admin_Phone"],$row["Admin_Email"]);
				array_push($allAdmins, $userObj);
			}
			
			return $allAdmins;
		}
		
		
	}
?>