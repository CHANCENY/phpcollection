<?php 
include "Securing.php";
 if(isset($_POST['submitform']))
 {
 	if(!empty($_POST['username']) && !empty($_POST['password']))
 	{
 		$username = $_POST['username'];
 		$password =$_POST['password'];
 		 $save = new SecurePassword();

 		 $password = $save->savingpassword_encripted_format($password);
 		 if($password !== false)
 		 {
 		 	$conn = new mysqli("localhost","root",null,"sample");
 		 	$query ="INSERT INTO encp(username,password) VALUES('$username','$password')";
 		 	if(mysqli_query($conn,$query))
 		 	{
 		 		echo "user added ";
 		 	}
 		 	else
 		 	{
 		 		echo "failed!";
 		 	}
 		 }


 	}
 }


 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>add user</title>
</head>
<body>
	<form method="post">
		<input type="text" name="username" placeholder="Enter username" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <input type="submit" name="submitform" value="Add user now!">
	</form>
</body>
</html>