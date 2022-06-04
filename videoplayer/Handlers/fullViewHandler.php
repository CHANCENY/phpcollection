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


  function getviewsandlikes($owner,$serviceid)
  {
     $loves = new LikesCollectionAndViews();

     return $loves->showinglikesandviews($owner,$serviceid);
  }

  function increaseviews($owner, $serviceid)
  {
    $ves = new LikesCollectionAndViews();
    $ves->increasingviewers($owner,$serviceid,'1');
  }

 

 ?>