<?php 
 session_start();

 $_SESSION['userin']=null;
 $_SESSION['increament'] = null;
 $_SESSION['stepinchangef'] ="verify account!";
 $_SESSION['smsf'] = null;
 $_SESSION['f'] = 0;
 $_SESSION['login'] = false;
 $_SESSION['recovery'] = false;
 $_SESSION['rmessage'] = null;
 $_SESSION['like'] = 0;
$_SESSION['views'] = 0;
$_SESSION['likedby'] = null;
$_SESSION['smslike'] =null;

 
 header("Location: index2.php");
 ?>