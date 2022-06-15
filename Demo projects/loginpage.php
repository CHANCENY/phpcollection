<?php 
include "Helpingfile.php";

 $message = "Welcome fill all fields to login";
 $stylemessage = "welcomenote";
 
 if(isset($_POST['submit']))
 {
   if(!empty($_POST['username']) && !empty($_POST['password']))
   {
     $username = $_POST['username'];
     $password = $_POST['password'];
     $res = loginuser($username,$password);
     if($res === false)
     {
     	$message = "Technical error sorry you could login or try different crenditials!";
        $stylemessage ="labelfailed";
 	    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=loginpage.php">';
     }
     else
     {
     	$message = "You have successfully logged in our user ".$res;
        $stylemessage ="labelsuccess";
 	    //echo '<META HTTP-EQUIV="Refresh" Content="3; URL=loginpage.php">';
     }

   }
   else
   {
   	  $message = "Fill in all field befor submitting!";
      $stylemessage ="labelfailed";
 	  echo '<META HTTP-EQUIV="Refresh" Content="3; URL=loginpage.php">';
   }
 }

 ?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login now!</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<section class="contentcontainer">

		<div class="outlogin">
			<h1>Demo Company</h1>
				<img src="https://thumb101.shutterstock.com/image-photo/stock-photo-demo-icon-450w-281065043.jpg" alt="logo picture" class="logo">	

					<form action="#" method="post">
						<input type="text" name="username" placeholder="Enter username here" required class="fields">
						<input type="password" name="password" placeholder="Enter password here" required class="fields">
						<input type="submit" name="submit" class="button" value="Login Now!" style="margin-left: 33%; margin-bottom: 5%;">
						<label class="<?php global $stylemessage; echo $stylemessage ?? null; ?>" style="margin-left:2%; margin-bottom:5%;"><?php global $message; echo $message ?? null; ?></label>
					</form>	
		<label style="margin-left:2%;">Create new account <a href="registerpage.php">Click here</a></label>

		</div>

	</section>
</body>
</html>