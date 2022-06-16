<?php 
include "../enctyptor/Securing.php";

session_start();

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

 function saveuser($username,$first,$last,$email,$password,$pro)
 {
    $encyp = new SecurePassword();
    $encpted_password = $encyp->savingpassword_encripted_format($password);
    if($encpted_password !== false)
    {
      $conn = new mysqli("localhost","root",null,"sample");
      $query ="INSERT INTO encp(username,password,firstname,lastname,email,profile) VALUES('$username','$encpted_password','$first','$last','$email','$pro')";

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
      $_SESSION['userlogged'] = $validateuser->get_user_all_info();
      return $validateuser->getuser();
    }
    else
    {
      return false;
    }
  }
 }

 function delete($username,$email,$password,$firstname)
 {
  try{
      $conn = new mysqli("localhost","root",null,"sample");
      $query ="DELETE FROM encp WHERE firstname='$firstname' AND username='$username' AND email='$email' AND password='$password'";
      if(mysqli_query($conn,$query))
        {
           return true;
        }
        else
        {
          return false;
        }
    }
    catch(Exception $e)
    {
      return false;
    }
 }

 ?>