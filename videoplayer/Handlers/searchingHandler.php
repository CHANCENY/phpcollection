<?php 
 include "bankendconfig/BankendClasses.php";

 function searchrandom($value,$charge,$cate,$av)
 {
   
   
 	if(empty($charge))
 	{
 		 $rando = new searchResults();
 		 return $rando->randomSearch($value);
 	}
    else
    {
        $rando = new searchResults();
        return $rando->specificSearch($cate,$charge,$value,$av);
    }
 	

 }


 ?>