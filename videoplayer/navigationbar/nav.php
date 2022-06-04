<?php 
 session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="navstyles.css">
	<link rel="stylesheet" type="text/css" href="subpagestyles.css">
	<link rel="stylesheet" type="text/css" href="stylesabout.css">
	<link rel="stylesheet" type="text/css" href="foot-2.css">
	<link rel="stylesheet" type="text/css" href="stylesservice.css">
	<link rel="stylesheet" type="text/css" href="navspecial.css">
	<link rel="stylesheet" type="text/css" href="validationsstyles.css">
	<link rel="stylesheet" type="text/css" href="fullview.css">
	<link rel="stylesheet" type="text/css" href="fstyles.css">
	<script src="https://maps.googleapis.com/maps/api/js"></script>
   <script src="navigationbar/mapscript.js"></script>
	<title></title>
</head> 
<body>
 <section class="containernavigations">
 	<nav class="navaclosingnow">
 		<div class="barrowlling">
 			 <div class="logonavigationspart">
 				<img src="navigationbar/7.jpeg" alt="logo" class="logonavigationspart">
 			</div>
 	    </div>
 		<div class="brandnamingpart">
 			<label class="brandnamingpart"><strong><a href="homepage.php" class="linkingpages">Brand name</a></strong></label>
 		</div>
 		<div class="listingdivision">
 			<ul class="listingallelement">
 				<div class="gopaging"><a href="homepage.php" class="linkingpages">Home</a></div>
 				<div class="gopaging"><a href="contactpage.php" class="linkingpages">Contacts</a></div>
 				<div class="gopaging"><a href="about-page.php" class="linkingpages">Abouts</a></div>
 				<div class="gopaging"><a href="servicepage.php" class="linkingpages">Services</a></div>
                 
                 <?php if($_SESSION['userin'] === null): ?>
                   
 				<div class="gopaging"><a href="Registration.php" class="linkingpages">Sign up</a></div>
 				<div class="gopaging"><a href="verifyingaccount.php" class="linkingpages">Sign in</a></div>
               

 				<div class="gopaging"><form action="Search.php" method="get">
 					<input type="hidden" name="check" value="2">
 					<input type="search" name="searching" placeholder="Search info" class="inputboxsearching" required>
 					<input type="submit" name="searchsubmit" value="search" class="inputboxsearching-2">
 				</form></div>
                  
                  <?php else: ?>

                <div class="gopaging"><a href="signingout.php" class="linkingpages">Sign out</a></div>
                <div class="gopaging"><a href="admin/adminpanel.php" class="linkingpages">Admin</a></div>             
 				<div class="gopaging"><form action="Search.php" method="get">
 						<input type="hidden" name="check" value="2">
 					<input type="search" name="searching" placeholder="Search info" class="inputboxsearching" required>
 					<input type="submit" name="searchsubmit" value="search" class="inputboxsearching-2">
 				</form></div>



                  <?php endif; ?>
 			    
 			</ul>
 		</div>
 	</nav>
 </section>
<?php if($_SESSION['recovery'] === true): ?>
 <section>
 	  <form action="Handlers/recovery.php" method="get">
 	  <input type="submit" name="recovery" value="Recover deleted account!" class="sendingbutton">
 	  </form>
 </section>
<?php endif; ?>
