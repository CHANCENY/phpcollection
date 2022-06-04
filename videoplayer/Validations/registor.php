

<section><div class="about-us"><h1 class="about-us-about-us">Sign up to be service provider</h1></div></section>

<section class="regcontainer">
<form action="Handlers/registrationhandler.php" method="post" class="formsregi" enctype="multipart/form-data">

  <?php if($_SESSION['increament'] === null): ?>

	<input type="text" name="username" placeholder="Username" class="inputregis" required>
	<input type="text" name="first" placeholder="First name" class="inputregis" required>
	<input type="text" name="last" placeholder="Last name" class="inputregis"required>
	<input type="file" name="upload" class="inputregis"><label>Profile picture</label>
	
    
	<input type="email" name="email" placeholder="Email" class="inputregis" required>
	<input type="tel" name="phone" placeholder="Phone" class="inputregis" required>
	<label>Birthday</label><input type="date" name="birthday" class="inputregis" required>
	<label>Gender </label><input type="radio" name="radio" required value="Female"><label> Female</label>
    </label><input type="radio" name="radio" required value="Male"><label> Male</label>
    </label><input type="radio" name="radio" required value="Transgender"><label> Transgender</label>
    <p class="inputregis"><?php  echo 'part one of two'; ?></p>
    <p class="inputregis"><?php  echo $_SESSION['messages'] ?? null; ?></p> 
    <input type="submit" name="regone" value="Save and continue..." class="sendingbutton" style="margin-left:20%">
    
     <?php elseif ($_SESSION['increament'] === 1): ?>

    <select name="race" class="inputregis" required>
		<option>Ethical</option>
		<option>Black</option>
		<option>White</option>
		<option>Brown</option>
	</select>
	<input type="text" name="town" placeholder="Town" class="inputregis" required>
	<input type="text" name="city" placeholder="City" class="inputregis" required>
	<input type="text" name="state" placeholder="State" class="inputregis" required>
	<input type="text" name="country" placeholder="Country" class="inputregis" required>
	<textarea name="desc" placeholder="Description" class="messagesboxes" style="margin-bottom: 5px; height: 250px;" required></textarea> 
	
	
	<input type="password" name="password" placeholder="Password" class="inputregis" required>
	<input type="password" name="confirm" placeholder="Confirm password" class="inputregis" required> 
	<p class="inputregis"><?php  echo $_SESSION['messages'] ?? null; ?></p> 
	<input type="submit" name="registrationsubmit" value="Join now!" class="sendingbutton" style="margin-left:20%">

    <?php elseif($_SESSION['alluser'] === true): ?>

    	<h3 class="inputregis" style="color: black;">You have successfully created account!</h3>
	 	<p class="inputregis">redirecting to sign in page thank you...</p>
	 	<?php  echo '<META HTTP-EQUIV="Refresh" Content="4; URL=verifyingaccount.php">'; ?>
	 	
	 <?php elseif($_SESSION['alluser'] === false): ?>

	 	<?php $_SESSION['increament'] = null; $_SESSION['messages'] = "Sorry something went wrong!"; $_SESSION['increament'] = null; ?>

	 <?php endif; ?>

</form>
</section>

<section><div class="about-us"><h1 class="about-us-about-us">Sign in now!</h1></div></section>

<section class="regcontainer">
	<form action="#" method="post" class="formslogin">
		<input type="text" name="username" placeholder="Username" class="inputregis" required>
		<input type="password" name="password" placeholder="Password" class="inputregis" required>
		<input type="submit" name="loginsubmit" value="Join now!" class="sendingbutton" style="margin-left:40%">
		<a href="#">Forgot password!</a>
	</form>
</section>