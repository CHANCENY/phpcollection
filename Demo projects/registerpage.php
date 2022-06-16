<?php 
 include "Helpingfile.php";

 $message = "Welcome fill all fields to join";
 $stylemessage = "welcomenote";

 if(isset($_POST['Join']))
 {


  if(!empty($_FILES['upload']['name'])){
 	if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2']))
 	{
 		// collecting information of user
 		$username = $_POST['username'];
 		$firstname = $_POST['firstname'];
 		$lastname = $_POST['lastname'];
 		$email = $_POST['email'];
 		$password1 = $_POST['password1'];
 		$password2 = $_POST['password2'];
    $profile = $_FILES['upload'];

 		// verify email
 		if(filter_var($email,FILTER_VALIDATE_EMAIL))
 		{
 			if(checkuserexitinDB($username) === false)
 			{
               if(checkuseremail($email) === false)
               {

                $list = array('jpg','jpeg','png');
                $filename = $profile['name'];
                $listn =explode('.', $filename);
                $ext2 = end($listn);
                $ext =strtolower($ext2);

              if(in_array($ext, $list)){

                $size = $profile['size'];

                if($size < 3000000){

              if($password1 === $password2){

                  $target = "profiles/".$filename;
                  $pro = $profile['tmp_name'];
                if(move_uploaded_file($pro, $target)){
                 $resultofjoin = saveuser($username,$firstname,$lastname,$email,$password1,$target);
                 if($resultofjoin === true)
                 {
                  	$message = "You have successfully join our club ".$firstname." ".$lastname;
 		                $stylemessage ="labelsuccess";
                 }
                 else
                 {
                 	  $message = $resultofjoin;
 		                $stylemessage ="labelfailed";
 		                echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
                 }
                 }
                }
                else
                {
                   $message = "Check passwords don`t match! and try again!";
                    $stylemessage ="labelfailed";
                    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
                }
               }
               else
               {
                    $message = "Please upload valid photo! allowed (jpg, jpeg, png)";
                    $stylemessage ="labelfailed";
                    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
               }

                }
                else
                	{
                	 $message = "Photo you have selected has big size allowed (2mb)";
 		                $stylemessage ="labelfailed";
 		                echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
                	}



               }
               else
               {
               	 $message = "Email already exist! try another one";
 		         $stylemessage ="labelfailed";
 		         echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
               }
 			}
 			else
 			{
 				$message = "Username already exist! try another one";
 		        $stylemessage ="labelfailed";
 		        echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
 			}
 		}
 		else
 		{
 			$message = "Please fill in valid email before submitting!";
 		    $stylemessage ="labelfailed";
 		    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
 		}
 	}
 	else
 	{
 		$message = "Please fill in all fields before submitting!";
 		$stylemessage ="labelfailed";
 		echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
 		
 	}
 }
 else
 {
    $message = "Please select photo before submitting!";
    $stylemessage ="labelfailed";
    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=registerpage.php">';
 }
 }

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Join us now</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="outsidediv">
    	<h1 class="h1">Join us now!</h1>
    	<form method="post" class="form" action="#" enctype="multipart/form-data">
    		<label class="<?php global $stylemessage; echo $stylemessage ?? null; ?>"><?php global $message; echo $message ?? null; ?></label><br>
    		<input type="text" name="firstname" placeholder="Enter your firstname" class="field"><br>
    		<input type="text" name="lastname" placeholder="Enter your lastname" class="field"><br>
    		<input type="text" name="username" placeholder="Enter your username" class="field"><br>
    		<input type="email" name="email" placeholder="Enter your email" class="field"><br>
    		<input type="password" name="password1" placeholder="Enter your password" class="field"><br>
        <input type="password" name="password2" placeholder="Confirm your password" class="field"><br>
    		<input type="file" name="upload" class="field">
        <br>

    		<input type="submit" name="Join" value="Join us now!" class="button" o><br>
    	</form>
    </div>
</body>
</html>

