<?php

include "backendhandlersfiles/AdminClass.php";

$_SESSION['defeultback'] = "asset/back.jpg"; 

if(!empty($_SESSION['logged']))
{
foreach ($_SESSION['logged'] as $key) {
	$images = $key['image'];
	$names = $key['fullname'];
	$user = $key['username'];
	$_SESSION['username'] = $key['username'];
	$_SESSION['joinid'] = $key['joinid'];
	$back = $key['background'];
	$_SESSION['display'] = $key['displayname'];
}

 $comments = new Admin();
 $allcom = $comments->commentloader($user);
}
 ?>

<?php if($_SESSION['status'] === true): ?>
<section class="incallcontainer" style="background-image: url('<?php if(!empty($back)){ echo $back; }else{ echo $_SESSION['defeultback']; } ?>');">
	<div class="lapp">
		<div class="imageprofile">
			<img src="<?php global $images; echo $images; ?>" class="imageprofile">
		</div>
		<div class="divpost">
			<form action="admin/requestprocces.php" method="get">
				<button type="submit" name="addpost" class="buttonlogin more">ADD YOUR OFFERS</button>
				<button type="submit" name="editp" class="buttonlogin more">EDIT PROFILE DETAILS</button>
				<button type="submit" name="chap" class="buttonlogin more">CHANGE PASSWORD</button>
				<button type="submit" name="vp" class="buttonlogin more">VIEW POSTS</button>
				<button type="submit" name="deletenow" class="buttonlogin more">DELETE ACCOUNT</button>
				<button type="submit" name="logout" class="buttonlogin more">LOGOUT</button>
			</form>
			<div class="divbelow">
				<label>NAME:&nbsp;</label><label><?php global $names; echo $names; ?></label>
				<label>&nbsp;&nbsp;USER:&nbsp;</label><label><?php global $user; echo $user; ?></label>
			</div>
		</div>
	</div>
</section>

<section class="incallcontainer">
	
	<div class="lap">

          <h4>Comments from views and clients</h4>
		 <?php if(!empty($allcom)): ?>


		<?php foreach ($allcom as $key): ?>
		<div class="boxs">
			<label>Offer id:</label>&nbsp;&nbsp;<label>|<?php echo $key['service']; ?>|</label>
			<label>&nbsp;&nbsp;Commented on</label>&nbsp;&nbsp;<label>|<?php echo $key['dates']; ?>|</label>
			<label>&nbsp;&nbsp;Commented by</label>&nbsp;&nbsp;<label>|<?php echo $key['bywho']; ?>|</label>
			<hr>
			<div style="width: 80%;">
				<p><?php echo $key['comment']; ?></p>
			</div>
			
		</div>


	<?php endforeach; ?>		

	<?php else: ?>
      
      <h4>No comments available yet</h4>

	<?php endif; ?>

	</div>
</section>


<?php else: ?>

	<?php header("Location: home.php"); ?>

<?php endif; ?>