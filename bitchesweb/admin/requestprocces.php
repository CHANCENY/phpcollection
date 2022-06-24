<?php 
session_start();

include "backendhandlersfiles/AdminClass.php";

 if(isset($_GET['addpost']))
 {
 	header("Location: ../offer.php");
 }

 if(isset($_GET['editp']))
 {
 	header("Location: ../editing.php");
 }

 if(isset($_GET['chap']))
 {
 	header("Location: ../admchangepa.php");
 }

 if(isset($_GET['vp']))
 {
 	header("Location: ../admviewposted.php");
 }

 if(isset($_GET['logout']))
 {
    $_SESSION['logged'] = null;
    $_SESSION['status'] = false;
    $_SESSION['username'] = null;
    $_SESSION['joinid'] = null;
    header("Location: ../home.php");
 }

 if(isset($_GET['deletenow']))
 {
    header("Location: ../deleteaccount.php");
 }

 ?>