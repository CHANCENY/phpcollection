<?php 
include "../bankendconfig/BankendClasses.php";

 function servicesforuser()
 {
 	$objclass = new ServicesRetriverUserOnly();
  return $objclass->retrive_info_post();   
 }

 ?>