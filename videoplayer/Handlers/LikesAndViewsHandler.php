<?php 

include "bankendconfig/BankendClasses.php";

 function likesup($owner,$servid)
 {
 	if(!empty($_SESSION['likedservicesid']) && !empty($_SESSION['likedownerid']))
 	{
 		$like = new LikesCollectionAndViews();
 		return  $like->increasinglikes($owner,$servid,'1');
 		
 	}
 }


 ?>