<?php 
 session_start();
 ?>


 <?php if($_SESSION['login'] === true): ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="editstyles.css">
	<link rel="stylesheet" type="text/css" href="addadminstyles.css">
	
	<title>profile</title>
</head>
<body>
	<div style="margin-left: 20%;">
		<label>Updated information will show after signing in again</label>
	</div>
   <section class="addservicesformcontainer">
   	<form action="AdminHandler/EditingHandler.php" method="post" class="formlapp2" enctype="multipart/form-data" style="margin-left: 30%;">
   		<div class="inputlapper">
   			  <label>Updating profile information</label><br><br>
   			  
   			    <input type="text" name="fullname" class="inputservtwo" placeholder="New full name">
   			    <input type="submit" name="fullnamesubmit" value="Update!" class="setservicebutton"><br>
   			
   			    <input type="email" name="email" class="inputservtwo" placeholder="New email address">
   			    <input type="submit" name="emailsubmit" value="Update!" class="setservicebutton"><br>
   			 
              	<input type="text" name="username" class="inputservtwo" placeholder="New username">
              	<input type="submit" name="usernamesubmit" value="Update!" class="setservicebutton"><br>

              	<input type="text" name="phone" class="inputservtwo" placeholder="New phone number">
              	<input type="submit" name="phonesubmit" value="Update!" class="setservicebutton"><br>

              	<input type="text" name="address" class="inputservtwo" placeholder="New address">
              	<input type="submit" name="addressSubmit" value="Update!" class="setservicebutton"><br>

              	<textarea  name="description" class="inputservtwo" placeholder="New description" style="height: 100px; width: 300px;"></textarea><br>
              	<input type="submit" name="descsubmit" value="Update!" class="setservicebutton">
              	<label><?php echo $_SESSION['sms'] ?? null; ?></label>
              	<br>
              	 </div> 		
   		</div>
   	</form>
   </section>

   <section class="addservicesformcontainer">
   	
   	<form action="AdminHandler/EditingHandler.php" method="post" class="formlapp2" enctype="multipart/form-data" style="margin-left: 30%;">
   		<div class="inputlapper">
   			  <label>Update profile picture</label><br><br>
   			  
   			   <label>New profile photo</label><br><input type="file" name="uploadpro" class="inputservtwo">
   			    <input type="submit" name="uploadsubmitprofile" value="Update!" class="setservicebutton">
   			    <label><?php echo $profileupdatemessage ?? null; ?></label><br>
   			</div>
   		</form>  		
   </section>
   <section class="addservicesformcontainer">
   	   
   	   <form action="AdminHandler/EditingHandler.php" method="post" class="formlapp2" enctype="multipart/form-data" style="margin-left: 30%;">
   		<div class="inputlapper">
   			  <label>Update password </label><br><br>
   			  
   			    <input type="password" name="password" class="inputservtwo" placeholder="Enter old password" required>
   			
   			    <input type="password" name="confirm" class="inputservtwo" placeholder="Enter New password" required><br>
   			    <input type="submit" name="submitnewpassword" value="Update!" class="setservicebutton">
   			    <label><?php  echo $_SESSION['passwordmessage'] ?? null; ?></label>
   			 </div>
   			</form>
   </section>

   <section class="addservicesformcontainer">
   	
   	<form action="AdminHandler/deleteHandler.php" method="post" class="formlapp2" enctype="multipart/form-data" style="margin-left: 30%;">
   		<div class="inputlapper">
   			  <label>Delete Account</label><br><br>

   			    <input type="submit" name="deleteaccount" value="Delete account!" class="setservicebutton">

   			    <?php if($_SESSION['opendecison'] == 1): ?>

                      <input type="submit" name="deleteaccount" value="Yes" class="setservicebutton">
                      <input type="submit" name="nodelete" value="No" class="setservicebutton">

   			    <?php endif; ?>
   			    <label><?php echo $_SESSION['delesms'] ?? null; ?></label><br>
   			</div>
   		</form>  		
   </section>




</body>
</html>

<?php else: ?>

<?php header("Location: ../homepage.php"); ?>

<?php endif; ?>