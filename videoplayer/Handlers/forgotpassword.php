<?php 
session_start();
 include "../bankendconfig/BankendClasses.php";

 function verifyingusernameandemail($user, $email)
 {
 	if(!empty($user) && !empty($email))
 	{
        $v = new TroubledPassword();
        return $v->verifyattempt($user,$email);
 	}
 }

 function changepasswords($email, $user,$new)
 {
 	if(!empty($user) && !empty($email))
 	{
            $vc = new TroubledPassword();
            return $vc->changecommit($email, $user, $new);
 	}
 }


 if(isset($_POST['fpassword']))
 {
       if($_SESSION['f'] === 0)
       {
              $_SESSION['fuser'] = $_POST['username'];
              $_SESSION['femail'] = $_POST['email'];

              $_SESSION['smsf'] = verifyingusernameandemail($_SESSION['fuser'], $_SESSION['femail']);
              if($_SESSION['smsf'] === true)
              {
                    $_SESSION['stepinchangef'] = "Change password";
                    $_SESSION['smsf'] ="Verified";
                    $_SESSION['f'] = $_SESSION['f'] + 1;
                    header("Location: ../passwordf.php");
              }
              else
              {
                     header("Location: ../passwordf.php");
              }

       }
       else
       {
              $new = $_POST['password'];
              $confi = &$_POST['confirm'];
              if($new === $confi)
              {
                     $_SESSION['smsf'] = changepasswords($_SESSION['femail'], $_SESSION['fuser'],md5($new));
                     if($_SESSION['smsf'] === true)
                     {
                           $_SESSION['smsf'] = "password change successfully";
                           header("Location: ../passwordf.php");
                     }
                     else
                     {
                         header("Location: ../passwordf.php");
                     }
              }
              else
              {
                   $_SESSION['smsf'] = "passwords dont match!";
                   header("Location: ../passwordf.php");   
              }
       }
 }

 ?>