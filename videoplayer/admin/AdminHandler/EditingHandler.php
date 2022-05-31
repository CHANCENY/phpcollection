<?php
session_start();
include "../../bankendconfig/BankendClasses.php";


// form editing profile request
echo "EDiting";
 if(isset($_POST['fullnamesubmit']))
 {
 	
 	$fullname = $_POST['fullname'];
 	
 	$update = new EditingProfile();
 	$result = $update->DynamicEditingprofile('fullname',$fullname);
 	if($result === true)
 	{
 		$_SESSION['sms'] = "Name updated...";
 		header('Location: ../editingprofile.php');
 	}
 	else
 	{
 		$_SESSION['sms'] = "Name not updated...";
 		header('Location: ../editingprofile.php');
 	}
 }


 if(isset($_POST['emailsubmit']))
 {
 	$email = $_POST['email'];
 	$update = new EditingProfile();
 	$result = $update->DynamicEditingprofile('email',$email);
 	if($result === true)
 	{
 		$_SESSION['sms'] = "Email updated...";
 		header('Location: ../editingprofile.php');
 	}
 	else
 	{
 		$_SESSION['sms'] = "Email not updated...";
 		header('Location: ../editingprofile.php');
 	}
 }


 if(isset($_POST['usernamesubmit']))
 {
 	$username = $_POST['username'];
 	$update = new EditingProfile();
 	$result = $update->DynamicEditingprofile('username',$username);
 	if($result === true)
 	{
 		$_SESSION['sms'] = "Username updated...";
 		header('Location: ../editingprofile.php');
 	}
 	else
 	{
 		$_SESSION['sms'] = "Username not updated...";
 		header('Location: ../editingprofile.php');
 	}
 }


 if(isset($_POST['phonesubmit']))
 {
 	$phone = $_POST['phone'];
 	$update = new EditingProfile();
 	$result = $update->DynamicEditingprofile('phone',$fullname);
 	if($result === true)
 	{
 		$_SESSION['sms'] = "Phone number updated...";
 		header('Location: ../editingprofile.php');
 	}
 	else
 	{
 		$_SESSION['sms'] = "Phone not updated...";
 		header('Location: ../editingprofile.php');
 	}
 }


 if(isset($_POST['addressSubmit']))
 {
 	$address = $_POST['address'];
 	$update = new EditingProfile();
 	$result = $update->DynamicEditingprofile('address',$address);
 	if($result === true)
 	{
 		$_SESSION['sms'] = "Address updated...";
 		header('Location: ../editingprofile.php');
 	}
 	else
 	{
 		$_SESSION['sms'] = "Address not updated...";
 		header('Location: ../editingprofile.php');
 	}
 }

 
 if(isset($_POST['descsubmit']))
 {
 	$desc = $_POST['description'];
 	$update = new EditingProfile();
 	$result = $update->DynamicEditingprofile('description',$desc);
 	if($result === true)
 	{
 		$_SESSION['sms'] = "Your description updated...";
 		header('Location: ../editingprofile.php');
 	}
 	else
 	{
 		$_SESSION['sms'] = "Your description not updated...";
 		header('Location: ../editingprofile.php');
 	}
 }


 if(isset($_POST['uploadsubmitprofile']))
 {
    if(!empty($_FILES['uploadpro']))
    {
        $file = $_FILES['uploadpro'];
        $filename = $file['name'];
        $nameandext =explode('.', $filename);
        $ext = strtolower(end($nameandext));
        $filters = array('jpg','jpeg','png','svg','webp');
        if(in_array($ext,$filters))
        {
          $size = $file['size'];
          if($size < 3000000)
          {
               $image = addslashes(file_get_contents($file['tmp_name']));
               $update = new EditingProfile();
               $result = $update->DynamicEditingprofile('profile',$image);
               if($result === true)
                 {
                      $profileupdatemessage = "Your profile image updated...";
                       header('Location: ../editingprofile.php');
                 }
                 else
                 {
                          $profileupdatemessage = "Your profile image not updated...";
                          header('Location: ../editingprofile.php');
                 }  
          }
          else
          {
            $profileupdatemessage ="File is too big allowed 3MB only ";
          }
        }
        else
        {
          $profileupdatemessage = "File type not allowed!";  
        }

    }
    else
    {
        $profileupdatemessage = "File not picked!";
    }
 }


 if(isset($_POST['submitnewpassword']))
 {
    
    if(!empty($_POST['password']) && !empty($_POST['confirm']))
    {
        
        $password = $_POST['password'];
        $confirm =$_POST['confirm'];
         
        if($password === $confirm)
        {
            
            $_SESSION['passwordmessage'] = "Old password and new password entered are same";
            header('Location: ../editingprofile.php');
        }
        else
        {   
         
            $passworddb = null;
            foreach ($_SESSION['userin'] as $key) {
                $passworddb = $key['password'];
            }
           
            if($passworddb === null)
            { 
                $_SESSION['passwordmessage'] = "Sorry something went wrong!";
                header('Location: ../editingprofile.php');
            }
            else
            {
               
                if(md5($password) === $passworddb)
                {
                    
                    $update = new EditingProfile();
                    $result = $update->DynamicEditingprofile('password',md5($confirm));
                     if($result === true)
                      {
                           $_SESSION['passwordmessage'] = "Your password updated...";
                           header('Location: ../editingprofile.php');
                      }
                      else
                       {
                              $_SESSION['passwordmessage'] = "Your password not updated...";
                              header('Location: ../editingprofile.php');
                       }
                }
                else
                {
                   
                    $_SESSION['passwordmessage'] = "Old password not match found";
                    header('Location: ../editingprofile.php');
                }
            }
        }
    }
 }


 ?>