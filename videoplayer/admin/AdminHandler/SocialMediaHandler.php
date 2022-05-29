<?php 
session_start();
include "../bankendconfig/BankendClasses.php";



 function determinelink($link, $type, $owner)
 {
 	$likcon = new SocialMediaLinks();
 	return $likcon->addLink($link,$type,$owner);
 }

 ?>