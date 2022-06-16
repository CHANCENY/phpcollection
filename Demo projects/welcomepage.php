<?php

 include "Helpingfile.php";

 if(isset($_GET['logout']))
 {
 	$_SESSION['userlogged']=null;
 }

 if(isset($_GET['delete']))
 {
 	
     $_SESSION['delete'] = true;
 }

 if(isset($_GET['cancel']))
 {
 	$_SESSION['delete'] = false;
 }

 if(isset($_GET['continue']))
 {
 	
 	global $count, $per, $status;
 	$count = 0;
 	$per = "%";
 	$status ="collecting files";
 	$profile = null;
 	$first =null;
 	$password = null;
 	$email =null;
 	$username = null;
 	foreach($_SESSION['userlogged'] as $key)
 	{
      $profile = $key['profile'];
      $username = $key['username'];
      $first = $key['firstname'];
      $password = $key['password'];
      $email = $key['email'];
 	}

 	sleep(1);
 	for ($i=1; $i <= 1000; $i++) {

 		 $count= $i;		
 		if($count === 25)
 		{
 			$status ="deleting user information collected";
 			$res = delete($username,$email,$password,$first);
 			if($res === true)
 			{
 				continue;
 			}
 			else
 			{
 				$status ="deleting account failed!";
 				break;
 			}
 			
 		}
 		if($count === 75)
 		{
 			$status ="deleting profile photos collected!";
 			unlink($profile);
 			
 		}
 		if($count === 100)
 		{
 		 $status ="deleting of account complete";
 		 $_SESSION['userlogged'] = null;
 		 
 		 break;
 		}
         				
 	}

 }
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome our user</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

	<?php if(!empty($_SESSION['userlogged']) && $_SESSION['delete'] === false): ?>
    <section class="contentcontainer">

    	<?php 	$color = array("blue","green","orange","yellow","pink");
    	         $back = array("grey","white","red","floralwhite","beige","navy");            
    	?>

    	<?php foreach ($_SESSION['userlogged'] as $key): ?>
    	<div class="outdiv">
    		<img src="<?php echo $key['profile']; ?>" alt="you picture" class="images">
    		<div class="info" style="background-color: <?php echo $back[rand(0,4)]; ?>;">
    			<h1 style="margin-left: 10%;">Your information collection</h1>
    			<h2 style="margin-left: 12%;">First name: <span style="color: <?php echo $color[rand(0,4)]; ?>;"><?php echo $key['firstname']; ?></span></h2>
    			<h2 style="margin-left: 12%;">Last name: <span style="color: <?php echo $color[rand(0,4)]; ?>;"><?php echo $key['lastname']; ?></span> </h2>
    			<h2 style="margin-left: 12%;">user name: <span style="color: <?php echo $color[rand(0,4)]; ?>;"><?php echo $key['username']; ?></span></h2>
    			<h2 style="margin-left: 12%;">Email  : <span style="color: <?php echo $color[rand(0,4)]; ?>;"><?php echo $key['email']; ?></span></h2>
    			<form action="#" method="get">
    			   <button type="submit" name="logout" class="button">Logout now!</button>
    			   <button type="submit" name="delete" class="button">Delete now!</button>
    		    </form>
    		</div>
    	</div>
    <?php endforeach; ?>
    </section>

<?php endif; ?>

<?php if($_SESSION['delete'] === true): ?>
<section class="contentcontainer">
	<div class="inside">
		<h1>Deleting account!</h1>
		<p>Note you be able to recover this account! <?php echo $_SESSION['nameofuser']; ?></p>
		<form action="#" method="get">
		<button type="submit" name="continue" class="button">Delete anyway</button><button type="submit" name="cancel" class="button">Cancel deletion!</button>
	    </form>
	    <hr class="hr">
	    <p><?php  echo $count ?? null;?><?php global $per; echo $per ?? null; ?>&nbsp;&nbsp;&nbsp;<?php global $status; echo $status ?? null; ?></p>
	</div>
</section>
<?php endif; ?>
</body>
</html>