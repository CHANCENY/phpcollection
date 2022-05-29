<?php 

 include "Handlers/postsservicerenderinghandler.php";


 $_SESSION['posttorender'] = renderpost();
 

 ?>


<section><div class="about-us"><h1 class="about-us-about-us">OUR SERVICES</h1></div></section>


<section class="servicecontainering" style="margin-left:6%">
	<?php if(!empty($_SESSION['posttorender'])): ?>
	<?php foreach ($_SESSION['posttorender'] as $key): ?>
		

	<div class="servicecovering">
		<div class="serviceimagepersoning">
			<img src="<?php echo 'data:image;base64,'.base64_encode($key['image']); ?>" class="serviceimagepersoning">
			<label class="breakings">posted&nbsp;<?php  echo $key['posted']; ?></label><br>
		</div>
		<div class="contentsservicesdetails">
			<label class="breakings"><strong>Title:</strong>&nbsp;<?php echo $key['title'];  ?></label>
			<label class="breakings"><strong>Cat:</strong>&nbsp;<?php echo $key['category']; ?></label>
			<label class="breakings"><strong>Status:</strong>&nbsp;<?php echo $key['available']; ?></label>
			<label class="breakings"><strong>Charges:</strong>&nbsp;<?php echo $key['charges']; ?></label>
			<form action="fullviewing.php" method="get">
				<input type="hidden" name="id" value="<?php echo $key['ID']; ?>">
				<input type="hidden" name="owner" value="<?php echo $key['owner']; ?>">
				<input type="submit" name="moreview" value="View details!" class="sendingbutton">
			</form>
		</div>
		<div class="breakings" style="background-color: floralwhite; padding-top: 5px;">
			<label><strong>Description: </strong>&nbsp;<?php echo $key['description'];?></label><br>
		</div>
	</div>
	

<?php endforeach; ?>
</section>
<?php else: ?>

<section><div class="about-us"><h4 class="about-us-about-us" >sorry no services post found!</h4></div></section>


<?php endif ?>
	

