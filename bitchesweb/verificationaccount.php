<?php 
include "backendhandlersfiles/validateuserclass.php";
include "navbar/nav.php";

if(isset($_GET['token']))
{
if(!empty($_GET['token']) && !empty($_GET['usern']))
{
	$_SESSION['token'] = $_GET['token'];
	$_SESSION['username'] =$_GET['usern'];

	
}
}

if(isset($_POST['ver']))
{
	if(!empty($_POST['tok']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user']))
	{
		$email = $_POST['email'];
		$password =  $_POST['password'];
		$tok = $_POST['tok'];
		$user = $_POST['user'];
        
        $vers = new UserValidatorClass();

		$verified =$vers->verificationmemberaccount($email,$password,$tok,$user);
		if($verified === true)
		{
			$_SESSION['messages'] = null;
			$_SESSION['done'] ="Welcome to Escorts services you can login now and start posting your offers. Login username: ".$user;

		}
		else
		{
			$_SESSION['messages'] = $verified;
		}

	}
}

 ?>

<section class="incallcontainer">

	<div class="regdiv">
		<?php 	if(!empty($_SESSION['done'])): ?>

          <h1><?php echo $_SESSION['done']; ?></h1>

		<?php else: ?>
		<form action="#" method="post">
			<input type="hidden" name="user" value="<?php echo $_SESSION['username']; ?>">
			<input type="hidden" name="tok" value="<?php echo $_SESSION['token']; ?>">
			<input type="email" name="email" placeholder="Enter email your have used to register" required class="inputreg">
			<input type="password" name="password" placeholder="Enter password you have used" class="inputreg">
			<input type="submit" name="ver" value="Verify account" class="buttonlogin">
			<label><?php echo $_SESSION['messages']; ?></label>
		</form>
	<?php endif; ?>
	</div>
</section>

<?php 
  include "navbar/footer.php";
 ?>