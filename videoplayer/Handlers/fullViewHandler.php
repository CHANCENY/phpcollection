<?php 	
 include "bankendconfig/BankendClasses.php";

  function fullnow($rownmuber, $ownernumber)
  {
  	if(!empty($rownmuber) && !empty($ownernumber))
  	{ 
  		
        $more = new collectedviewpost();
        return $more->reviewPostFull($rownmuber,$ownernumber);
  	}
  }

  function infomore($owner)
  {
  	if(!empty($owner))
  	{
      $info = new collectedviewpost();
      return $info->getprofileinfo($owner);
  	}
  }

  function moreimages($servid)
  {
    if(!empty($servid))
    {
      
      $srv = new MoreImages();
      return $srv->retrivemore($servid);
    }
  }

 

 ?>