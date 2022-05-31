
 
<section><div class="about-us"><h1 class="about-us-about-us">Sign in now!</h1></div></section>

<section class="regcontainer">
	<form action="Handlers/logginghandler.php" method="post" class="formslogin">
		<input type="text" name="username" placeholder="Username" class="inputregis" required>
		<input type="password" name="password" placeholder="Password" class="inputregis" required>
		<p class="inputregis"><?php echo $_SESSION['messages'] ?? null; ?></p>
		<input type="submit" name="loginsubmit" value="Log in now!" class="sendingbutton" style="margin-left:40%">
		<a href="passwordf.php">Forgot password!</a>
	</form>
</section>

