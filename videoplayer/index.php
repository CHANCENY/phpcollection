<?php 
 session_start();

 $_SESSION['userin']=null;
 $_SESSION['increament'] = null;
 $_SESSION['stepinchangef'] ="verify account!";
 $_SESSION['smsf'] = null;
 $_SESSION['f'] = 0;
 $_SESSION['login'] = false;
 header("Location: index2.php");
 ?>