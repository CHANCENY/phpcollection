<?php 
 include "Securing.php";

 if(isset($_POST['submit']))
 {
 	if(!empty($_POST['password']))
 	{
 		$passwords = $_POST['password'];

 		$sec = new SecurePassword();

 		//$sec->savingpassword_encripted_format($password);

 		$con = new mysqli("localhost","root",null,"sample");
 		if($sec->validate_password($passwords,"chance nyasulu",null,$con,"encp"))
 		{
 			echo "password matched!<br><br>User: ".$sec->getuser();
 		}
 		else
 			echo "password no match!";
 	}
 }

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>password</title>
</head>
<body>
      <form method="post">
      	<input type="password" name="password" placeholder="Enter password">
      	<input type="submit" name="submit" value="Secure password!">
      </form>
</body>
</html>