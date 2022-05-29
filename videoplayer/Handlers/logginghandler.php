<?php 
session_start();
include "../bankendconfig/BankendClasses.php";

 function logging_in($username, $password)
 {
 	if(!empty($username) && !empty($password))
 	{
        $log = new LoggingUser();
        return $log->Validating_user($username, $password);
 	}

 }

 if(isset($_POST['loginsubmit']))
 {
 	if(!empty($_POST['username']) && !empty($_POST['password']))
 	{
 		$username = $_POST['username'];
 		$password = $_POST['password'];

 		$returns = logging_in($username,$password);
 		if($returns === false)
 		{
 			$_SESSION['messages'] = "Sorry invalid username or password!";
 			header("Location: ../verifyingaccount.php");
 		}
 		else
 		{
 			$_SESSION['userin'] = $returns;
                     $_SESSION['login'] = true;
 			header("Location: ../admin/adminpanel.php");

 		}
 	}
 }

 ?>