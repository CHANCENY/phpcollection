<?php 
include "../bankendconfig/BankendClasses.php";

 function recieverchange($type,$value,$pos)
 {
 	if(!empty($type) && !empty($value) && !empty($pos))
 	{
 	
 		   $commit = new serviceViewChange();
 		   $res = $commit->commitChange($type, $value, $pos);
           if($res === true)
           {
            return "Change committed seccussfully(".$value.")";
           }
           else
           {
            return "Changing failed!";
           }	
 	}
 }

 function showingselectedpost($id)
 {
    if(!empty($id))
    {
        $sel = new serviceViewChange();
        return $sel->postSelectedview($id);
    }
 }

 ?>