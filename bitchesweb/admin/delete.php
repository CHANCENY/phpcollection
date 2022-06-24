<?php 
include "backendhandlersfiles/AdminClass.php"; 

     $delete = new Admin();
     $result = $delete->deleteaccount($_SESSION['joinid']);
     if($result === true)
     {
     	$_SESSION['logged'] = null;
        $_SESSION['status'] = false;
        $_SESSION['username'] = null;
        $_SESSION['joinid'] = null;
        header("Location: home.php");
     }elseif($result === false){
     	header("Location: adminpage.php");
     }
     else
     	echo $result;




 ?>