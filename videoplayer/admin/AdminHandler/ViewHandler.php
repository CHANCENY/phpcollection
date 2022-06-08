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

  function addingmoreimage($image,$id)
  {
    $tm = new MoreImages();
     return $tm->savingmorephoto($id, $image);
  }

  function recursiveaddingphotos($servid, $obj)
  {
    $rec = new MoreImages();
    return $rec->addingmoreimagesinlooping($servid,$obj);
  }

 ?>