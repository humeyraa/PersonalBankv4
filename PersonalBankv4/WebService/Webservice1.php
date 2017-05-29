<?php
	if(isset($_POST['name','cardnumber','amount','installment','pass','security'])) {
		// connect DB
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "personal_bank";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
			die("Connection error: " . $conn->connect_error);
		}
		
		$conn->set_charset("utf8");
		
		// read POST variables
		
		$format = strtolower($_POST['format']) == 'json' ? 'json' : 'xml'; // xml is the default
		$name = $_POST['name'];
		$name = "%".$name."%";
		
		// prepare, bind and execute SQL statement
		$stmt = $conn->prepare("SELECT Customer_Name, Customer_Phone, Customer_Email FROM customer_info WHERE Customer_Name LIKE ? ");
		$stmt->bind_param("s", $code); // si: string integer
		$stmt->execute();
		$stmt->bind_result($Name, $Phone, $Email);
		
		$countries = array();
		while ($stmt->fetch()) {
			array_push( $countries, array("Customer_Name"=>$Name, "Customer_Phone"=>$Phone, "Customer_Email"=>$Email) );
		}
		
		$stmt->close(); // close statement
		
		
		if($format == 'json') { // JSON output
			header('Content-type: application/json');
			echo json_encode(array('customer'=>$countries));
		}
		else { // XML output
			header('Content-type: text/xml');
			echo '<customers>';
			
			foreach($countries as $index => $country) {
				
				echo '<customer>';
				foreach($country as $key => $value) {
					echo '<',$key,'>';
					echo htmlentities($value);
					echo '</',$key,'>';
				}
				echo '</customer>';
				
			}
			
			echo '</customers>';
		}
		
		$conn->close(); // close DB connection
	}
?>		