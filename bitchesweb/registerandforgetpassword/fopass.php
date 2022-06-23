<?php 

 include "backendhandlersfiles/validateuserclass.php";

 if(isset($_POST['fogot']))
 {
 	if(!empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['username']))
 	{
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password1 = $_POST['password1'];

        $fogot = new forgotPassword($email,$username,$password1);
        $res = $fogot->getstatus();
        if($res === true)
        {
        	$message ="Password has been changed";
        }
        elseif($res === false)
        {
        	$message ="Technical error occurred";
        }
        else
        {
        	$message = $res;
        }
 	}
 	else
 	{
 		$message ="Fill in all fields";
 	}
 }

 ?>



<section class="rgicontainer">
	<div class="regdiv">
		<form action="#" method="post">
			<label>Change password fill form below</label><br>
			<input type="email" name="email" placeholder="Enter your email" required class="inputreg">
			<input type="text" name="username" placeholder="Enter your username" required class="inputreg">
			<input type="password" name="password1" placeholder="Enter new password" required class="inputreg">
			<input type="submit" name="fogot" value="Change password" class="buttonlogin">
			<label><?php echo $message ?? null; ?></label>
		</form>
	</div>
</section>