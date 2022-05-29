<?php 

 ?>


<section class="forgot">
	<div class="foutside">
		<?php if($_SESSION['f'] === 0): ?>
		<form action="Handlers/forgotpassword.php" method="post" class="fforms">
			<label>Username</label><br><input type="text" name="username" placeholder="Enter username" class="finput" required><br>
			<label>Email</label><br><input type="text" name="email" placeholder="Enter email" class="finput" required><br>
			<input type="submit" name="fpassword" value="<?php echo $_SESSION['stepinchangef']; ?>" class="sendingbutton"><label><?php echo $_SESSION['smsf'] ?? null; ?></label>
		</form>

	<?php elseif($_SESSION['f'] === 1): ?>
       
       <form action="Handlers/forgotpassword.php" method="post" class="fforms">
			<label>New password</label><br><input type="password" name="password" placeholder="Enter new password" class="finput" required><br>
			<label>Confirm password</label><br><input type="password" name="confirm" placeholder="Enter confirm password" class="finput" required><br>
			<input type="submit" name="fpassword" value="<?php echo $_SESSION['stepinchangef']; ?>" class="sendingbutton"><label><?php echo $_SESSION['smsf'] ?? null; ?></label>
		</form>

	<?php endif; ?>
	</div>
</section>