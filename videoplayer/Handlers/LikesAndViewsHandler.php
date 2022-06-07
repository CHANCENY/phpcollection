<?php 

include "bankendconfig/BankendClasses.php";

 function likesup($owner,$servid,$liker)
 {
 	if(!empty($_SESSION['likedservicesid']) && !empty($_SESSION['likedownerid']) && !empty($liker))
 	{
 		$like = new LikesCollectionAndViews();
 		return  $like->increasinglikes($owner,$servid,'1',$liker);
 		
 	}
 }


 ?>