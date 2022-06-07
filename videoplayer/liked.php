<?php 
session_start();
include "Handlers/LikesAndViewsHandler.php";

if(!empty($_SESSION['likedby']) && !empty($_SESSION['userin']))
{
 $res = likesup($_SESSION['likedownerid'],$_SESSION['likedservicesid'], $_SESSION['likedby']);
  $_SESSION['smslike'] =null;
 if($res === false)
 {
 	return "not lked";
 	header("Location: fullviewing.php");

 }
 else
 {
 	$_SESSION['like'] = $res;
 	header("Location: fullviewing.php");
 }
}
else
{  
    $_SESSION['smslike'] = 'Sign in first to like post if dont have account&nbsp;<a href="Registration.php">create one</a>';
   header("Location: fullviewing.php"); 
}

 ?>