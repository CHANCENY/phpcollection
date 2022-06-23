<?php 
session_start();

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
    header("Location: ../home.php");
 }

 ?>