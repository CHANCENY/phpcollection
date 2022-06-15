<?php 
include "../enctyptor/Securing.php";

 function checkuserexitinDB($username)
 {
 	$conn = new mysqli("localhost","root",null,"sample");
 	$query = "SELECT * FROM encp WHERE username='$username'";
 	$run = mysqli_query($conn,$query);
 	$res = mysqli_fetch_all($run,MYSQLI_ASSOC);
 	if(!empty($res))
 	{
 		return true;
 	}
 	else
 	{
 		return false;
 	}
 }

 function checkuseremail($email)
 {
 	$conn = new mysqli("localhost","root",null,"sample");
 	$query = "SELECT * FROM encp WHERE email='$email'";
 	$run = mysqli_query($conn,$query);
 	$res = mysqli_fetch_all($run,MYSQLI_ASSOC);
 	if(!empty($res))
 	{
 		return true;
 	}
 	else
 	{
 		return false;
 	}
 }

 function saveuser($username,$first,$last,$email,$password)
 {
    $encyp = new SecurePassword();
    $encpted_password = $encyp->savingpassword_encripted_format($password);
    if($encpted_password !== false)
    {
      $conn = new mysqli("localhost","root",null,"sample");
      $query ="INSERT INTO encp(username,password,firstname,lastname,email) VALUES('$username','$encpted_password','$first','$last','$email')";

     try{ 
      if(mysqli_query($conn, $query))
      {
      	return true;
      }
      else
      {
      	return "Sorry failed to join you please try again!";
      }
     }
     catch(Exception $e)
     {
     	return $e->getMessage();
     }
    }
    else
    {
    	return "Failed to secure your password try again!";
    }
   
 }

 function loginuser($username,$password)
 {
  if(!empty($username) && !empty($password))
  {
    $conn = new mysqli("localhost","root",null,"sample");
    $validateuser = new SecurePassword();
    if($validateuser->validate_password($password,$username,null,$conn,"encp"))
    {
      return $validateuser->getuser();
    }
    else
    {
      return false;
    }
  }
 }

 ?>