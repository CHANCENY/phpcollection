<?php 
include "Encyptor.php";

 if(isset($_GET['submit']))
 {
 	if(!empty($_GET['email']))
 	{
      $email = $_GET['email'];
      $ob = new EncyptorClass();
      $result = $ob->encyptor($email);
     

      $v = new EncyptorClass();
      if(($v->validate($result)))
      {
      	echo "email matched";
      }
      else
      {
      	echo "email not matched";
      }

 	}
 }

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>sample form</title>
</head>
<body>
    <form action="#" method="get">
    	<input type="email" name="email" placeholder="Enter email">
    	<input type="submit" name="submit" value="Checked">

    </form>
</body>
</html>