<?php 
 session_start();
 include "AdminHandler/sessionstarter.php";

   $userfullname = null;
   $userdescription = null;
   $profileimage = null;
   $_SESSION['moresms'] = null;
   $_SESSION['gohome'] = null;
   
   if(!empty($_SESSION['userin']))
   {
      foreach ($_SESSION['userin'] as $key) {
      	$userfullname = $key['fullname'];
      	$userdescription = $key['description'];
      	$profileimage = $key['profile'];
      	$phone = $key['phone'];
      	$email = $key['email'];
      	$_SESSION['likedby'] = $key['join_id'];
      }
   }

   include "AdminHandler/RestriverPost.php";
    $_SESSION['alluserposts'] = servicesforuser();
    
 ?>

<?php if($_SESSION['login'] === true): ?>
	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="adminstyles.css">
	<title><?php echo $userfullname ?? null; ?></title>
</head>
<body>
  
<section class="container-sc">
	<div class="lapper" style="background-image: url('<?php echo 'data:image;base64,'.base64_encode($profileimage); ?>');">
			<img src="<?php echo 'data:image;base64,'.base64_encode($profileimage); ?>" class="top-back">
		<div class="top-show">
		</div>
	</div>	
</section>
<section class="details-closed">
	<div class="info">
		<h1 style="color: green;"><?php echo $userfullname ?></h1>
		<p style="font-weight: 200;"><?php print_r($userdescription); ?></p>
		<div class="ico">

			<div class="icoimage">
			   <a href="https://wa.me/<?php echo $phone; ?>"><img src="https://img.icons8.com/color/48/000000/whatsapp--v5.png"/ class="icoimage"></a>
		    </div>

		    <div class="icoimage">
			   <a href="mailto:<?php echo $mail; ?>"><img src="https://img.icons8.com/emoji/48/000000/e-mail.png"/ class="icoimage"></a>
		    </div>

		    <div class="icoimage">
			   <a href="tel:<?php echo $phone; ?>"><img src="https://img.icons8.com/nolan/64/apple-phone.png"/ class="icoimage"></a>
		    </div>
		     

		</div>
		<div class="edit">
		    	<h3 class="title-adm">Editing profile and adding services</h3>
		    	<div class="editoption">
		    		<label><strong>Add posts of your services here</strong> <a href="addingservices.php" class="links-curr">click here</a></label>
		    	</div>

		    	<div class="editoption">
		    		<label><strong>Change profile infomation here</strong> <a href="editingprofile.php" class="links-curr">click here</a></label>
		    	</div>
		    	<div class="editoption">
		    		<label><strong>Set up social media link here</strong> <a href="socialmedialinks.php" class="links-curr">click here</a></label>
		    	</div>
	   </div>
	</div>
	<div class="current-owned">
		<h2 class="curre-title">Services layout</h2>

		<?php if(!empty( $_SESSION['alluserposts'])): ?>
         <?php foreach ($_SESSION['alluserposts'] as $key): ?>

		<form action="fullviewpost.php" method="get" class="forms">
			<div class="selecting-service">
				<input type="hidden" name="service" value="<?php echo $key['ID']; ?>">
				<div class="curr-show"><label><?php echo $key['title']; ?></label><input type="submit" name="chosen" value="View" class="input-curr"></div>
			</div>
		</form>
        <?php endforeach; ?>

	  <?php else: ?>
           <h4 class="curre-title">no services posts found</h4>
	  <?php endif ?>

		

	</div>
</section>

<section class="lasthome">
	<div class="lastouside">
		<a href="../homepage.php"><button class="input-curr">Home page</button></a>
	</div>
</section>
</body>
</html>

<?php else: ?>

 <?php header("Location: ../homepage.php"); ?>

<?php endif; ?>

