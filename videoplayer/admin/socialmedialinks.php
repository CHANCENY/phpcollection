<?php 
include "AdminHandler/SocialMediaHandler.php";
 if(isset($_POST['linkinstagram']))
 {
 	$owner = null;
    foreach ($_SESSION['userin'] as $key) {
    	$owner = $key['join_id'];
    }
    if(!empty($owner))
    {
    	$link = $_POST['insta'];
    	if(!empty($link))
    	{
    		$re = determinelink($link,'instagram', $owner);
    		if($re === true)
    		{
    			$_SESSION['mes'] = "Instagram link added!";
    		}
    		else
    		{
    			$_SESSION['mes'] = "Instagram link failed!";
    		}
    	}
    }
 }

 if(isset($_POST['linkfacebook']))
 {
 	$owner = null;
    foreach ($_SESSION['userin'] as $key) {
    	$owner = $key['join_id'];
    }
    if(!empty($owner))
    {
    	$link = $_POST['facebook'];
    	if(!empty($link))
    	{
    		$re = determinelink($link,'facebook', $owner);
    		if($re === true)
    		{
    			$_SESSION['mes'] = "Facebook link added!";
    		}
    		else
    		{
    			$_SESSION['mes'] = "Facebook link failed!";
    		}
    	}
    }

 }

 if(isset($_POST['linkwhatsapp']))
 {
 	$owner = null;
    foreach ($_SESSION['userin'] as $key) {
    	$owner = $key['join_id'];
    }
    if(!empty($owner))
    {
    	$link = $_POST['whatsapplink'];
    	if(!empty($link))
    	{
    		$re = determinelink($link,'whatsapp', $owner);
    		if($re === true)
    		{
    			$_SESSION['mes'] = "WhatsApp link added!";
    		}
    		else
    		{
    			$_SESSION['mes'] = "WhatsApp link failed!";
    		}
    	}
    }

 }

 if(isset($_POST['emaillink']))
 {
 	$owner = null;
    foreach ($_SESSION['userin'] as $key) {
    	$owner = $key['join_id'];
    }
    if(!empty($owner))
    {
    	$link = $_POST['email'];
    	if(!empty($link))
    	{
    		$re = determinelink($link,'email', $owner);
    		if($re === true)
    		{
    			$_SESSION['mes'] = "Email address added!";
    		}
    		else
    		{
    			$_SESSION['mes'] = "Email address failed!";
    		}
    	}
    }


 }

 if(isset($_POST['phonelink']))
 {
 	$owner = null;
    foreach ($_SESSION['userin'] as $key) {
    	$owner = $key['join_id'];
    }
    if(!empty($owner))
    {
    	$link = $_POST['phone'];
    	if(!empty($link))
    	{
    		$re = determinelink($link,'phone', $owner);
    		if($re === true)
    		{
    			$_SESSION['mes'] = "Phone address added!";
    		}
    		else
    		{
    			$_SESSION['mes'] = "Phone address failed!";
    		}
    	}
    }


 }


 ?>

<?php if($_SESSION['login'] === true): ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="medialinks.css">
	<title></title>
</head>
<body>
<section class="medialinkscontainer">
	<div class="head"><h1>ADD LINKS TO ACCOUNT</h1></div>
	<div class="mediaoutsidediv">
		<form action="socialmedialinks.php" method="post">
			<div class="insideform">
				<img src="https://img.icons8.com/fluency/48/000000/instagram-new.png"/><input type="text" name="insta" placeholder="Enter your instagram link" class="inputfields"><input type="submit" name="linkinstagram" class="buttons" value="Add now!">
			</div>
		</form>

        <form action="socialmedialinks.php" method="post" class="forms">
			<div class="insideform">
				<img src="https://img.icons8.com/fluency/48/000000/facebook-new.png"/><input type="text" name="facebook" placeholder="Enter your facebook link" class="inputfields"><input type="submit" name="linkfacebook" class="buttons" value="Add now!">
			</div>
		</form>

      
        <form action="socialmedialinks.php" method="post" class="forms">
			<div class="insideform">
				<img src="https://img.icons8.com/color/48/000000/whatsapp--v5.png"/><input type="text" name="whatsapplink" placeholder="Enter whatsapp number" class="inputfields"><input type="submit" name="linkwhatsapp" class="buttons" value="Add now!">
			</div>
		</form>

		<form action="socialmedialinks.php" method="post" class="forms">
			<div class="insideform">
				<img src="https://img.icons8.com/emoji/48/000000/e-mail.png"/><input type="email" name="email" placeholder="Enter email " class="inputfields"><input type="submit" name="emaillink" class="buttons" value="Add now!">
			</div>
		</form>

       <form action="socialmedialinks.php" method="post" class="forms">
			<div class="insideform">
				<img src="https://img.icons8.com/fluency/48/000000/phone.png"/><input type="text" name="phone" placeholder="Enter phone number " class="inputfields"><input type="submit" name="phonelink" class="buttons" value="Add now!">
			</div>
		</form>

	</div>
        <div class="remarkingtwo"><label><?php echo $_SESSION['mes'] ?? null; ?></label></div>
	<div class="remarking"><label>...links and numbers linked here will be used by viewer interested in contacting you...</label></div>
</section>
</body>
</html>

<?php else: ?>

   <?php header("Location: ../homepage.php"); ?>

<?php endif; ?>