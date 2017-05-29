<?php
	require_once('LogicLayer/AdminManager.php');
	if(isset($_POST["AdminPanel"])) {
									
			header("location: AdminLoginPanel.php");				
	}
	else if(isset($_POST["PersonalAccount"])) {
									
			header("location: PersonalLoginPanel.php");				
	}
								
?>
<html>
<head>
<title>Ceng Bank</title>

</head>
<body>
<form id="form1" name="form1" method="post" action=""> 
<table border ="1" width="1330" height="150">
	<tr>
		<td colspan ="4" height="150"> <img src="Images/logo.jpg" width="400px" height="150px">
			<input type="submit" name="CoomercialAccount" id="CoomercialAccount" value="Commercial" />
			<input type="submit" name="PersonalAccount" id="PersonalAccount" value="Personal" />
			<input type="submit" name="AdminPanel" id="AdminPanel" value="Admin Access" />
		</td>
	</tr>
	<tr>
		<td width="240" height="40"><center> Anasayfa </center></td>
		<td width="240" height="40"><center> Personal </center></td>
		<td width="240" height="40"><center> Commercial </center></td>
		<td width="240" height="40"><center> Contact </center></td>	
	</tr>
	<tr>
		<td colspan ="4" width="960" height="400" valign= "top"> Logo ve Buttonlar</td>
	</tr>
	<tr>
		<td colspan ="4" width="960" height="60" valign= "top"> Logo ve Buttonlar</td>
	</tr>
</table>
</form>
</body>
</html>