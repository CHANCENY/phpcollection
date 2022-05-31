<?php 
session_start();
include "../../bankendconfig/BankendClasses.php";

 function deletepass($go)
 {
 	$user = null;
 	foreach ($_SESSION['userin'] as $key) {
 		$user = $key['join_id'];
 	}

 	if(!empty($user))
 	{
 		if($go === 0)
 		{
 			$del = new deletingAccount();
 		    return $del->deleteaccount($user);
 		}
 		else
 		{
 			$del = new deletingAccount();
 		    return $del->deleteaccountanyway($user);
 		}
 		
 	}

 }

 if(isset($_POST['deleteaccount']))
 {
 	if($_SESSION['opendecison'] === 0){
 	$deleresult = deletepass(0);
 	if($deleresult === true)
 	{
 		 $_SESSION['delesms'] ="Account deleted successfully";
       	   $_SESSION['userin'] = null;
 		   header('Location: ../../homepage.php');
 	}
 	elseif ($deleresult === false){
 		$_SESSION['delesms'] ="Creating data backup has failed continue to delete anyway";
 		$_SESSION['opendecison'] = $_SESSION['opendecison'] + 1;
 		header('Location: ../editingprofile.php');	
 	}
 	else
 	{
 		$_SESSION['delesms'] = $deleresult;
 		header('Location: ../editingprofile.php');
 	}
 }
 else
 {
       $deleresult = deletepass(1);
       if($deleresult === true)
       {
       	   $_SESSION['delesms'] ="Account deleted successfully";
       	   $_SESSION['userin'] = null;
 		   header('Location: ../../homepage.php');
       }
       else
       {
       	 $_SESSION['delesms'] ="Account deleted failed";
 		header('Location: ../editingprofile.php');
       }
 }


 }

 if($_POST['nodelete'])
 {
 	$_SESSION['opendecison'] = 0;
 	header('Location: ../adminpanel.php');
 }


 ?>