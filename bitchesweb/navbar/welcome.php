<?php 
 include "backendhandlersfiles/validateuserclass.php";

 if(isset($_POST['login']))
 {
 	if(!empty($_POST['username']) && !empty($_POST['password']))
 	{
 		$username = $_POST['username'];
 		$password = $_POST['password'];
 		$log = new loginUser();

 		$result = $log->login($username,$password);
 		if($result === false)
 		{
 			$_SESSION['messages'] = $result;
 		}
 		elseif($result === true)
 		{ 
 			$_SESSION['status'] = true;
 			$_SESSION['logged'] = $log->memberlogged();
 			$_SESSION['messages'] =null;
 			// header("Location: ad.php");
 		}
 		else
 			$_SESSION['messages'] = $result;
 	}
 }


 ?>



<section class="welcomecontainer" style="background-image: url('asset/back.jpg');">
	<div class="outwelcome">
		<?php if(!empty($_SESSION['logged'])): ?>
         
         <div class="heading">
			<h1>Escort services</h1>
			<p>Escort services, we are here to provide you best of your choice we it come to having
			an escort anyway you want to be at very low price.</p>
		</div>	
	</div>
    
	<div>
		<a href="ad.php?admin='true'" class="buttonlogin" style="text-decoration: none;">ADMIN PANEL</a>
	</div>


		<?php else: ?>
		<div class="formplace">
			<h2 class="h2">login now (members Only)</h2>
			<form action="#" method="post">

				<input type="text" name="username" placeholder="enter username here" class="inputreg" required><br>
				<input type="password" name="password" placeholder="enter password here" class="inputreg" required><br>
				<input type="submit" name="login" value="login now" class="buttonlogin">
				<label><?php echo $_SESSION['messages'] ?? null; ?></label>
			</form>

			<div class="linkto">
			    <label>Forgot password&nbsp;</label><a href="fogot.php" id="a">click here</a><br>
		    </div>
		    <div class="linkto">
			   <label>Don`t have account&nbsp;</label><a href="regpage.php" id="a">click here</a>
		    </div>
		</div>
		<div class="heading">
			<h1>Escort services</h1>
			<p>Escort services, we are here to provide you best of your choice we it come to having
			an escort anyway you want to be at very low price.</p>
		</div>		
      
<?php endif; ?>
</section>