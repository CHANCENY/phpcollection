<?php 
session_start();

$_SESSION['messages'] = null;
 $_SESSION['liks'] =null;
 $_SESSION['done'] = null;
 $_SESSION['username'] = null;
 $_SESSION['token'] = null;
 $_SESSION['logged'] = null;
 $_SESSION['status'] = false;


header("Location: home.php");

 ?>