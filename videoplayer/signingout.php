<?php 
session_start();
 $_SESSION['userin'] = null;
 $_SESSION['messages'] = null;
 $_SESSION['login'] = false;
 header("Location: index.php");

 ?>