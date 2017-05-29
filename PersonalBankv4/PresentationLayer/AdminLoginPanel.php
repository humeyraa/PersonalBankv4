<?php 
	require_once('LogicLayer/AdminManager.php');
	
	if( isset($_POST["login"]) && isset($_POST["password"]) ) 
	{ 
		$login_name = trim($_POST["login"]);
		$login_password = trim($_POST["password"]);
		
		$result = AdminManager::getAdmin($login_name, $login_password);
		
		
		if($result == null)
		{
			echo '<script language="javascript">';
			echo 'alert("Incorrect Name&Password Please Try Again!!")';
			echo '</script>';
		}
		else
		{
			session_start();
			$_SESSION['activeUser'] = $result[0]->getAdmin_Name();
			
			header("location: AdminUI.php");
		}	
	}
	else
	{
		$message = "";
	} 
?> 
<!DOCTYPE html>
<html> 
	<head>
       <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>CengBank Admin Entry</title>
  <link rel="stylesheet" href="css/customerlogin.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<form action="<?php $_PHP_SELF ?>" method="POST"> 
  <section class="container">
    <div class="login">
      <h1>Login to Admin Account</h1>
     
        <p><input type="text" name="login" value="" placeholder="Customer Number / T.C."></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

    
  </section>
	
  <section class="about" ">
   
    <p class="about-author" style="align-content: center;">
      &copy; 2017 CENGBANK A.Ş </p>
      
  </section>
</body>
</html>