<?php 
include "bankendconfig/BankendClasses.php";

 function renderpost()
 {
 	$serpost = new PostRendering();
 	 return $serpost->renderingAPI();
 }

 ?>