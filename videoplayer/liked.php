<?php 
session_start();
include "Handlers/LikesAndViewsHandler.php";

 $res = likesup($_SESSION['likedownerid'],$_SESSION['likedservicesid']);

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

 ?>