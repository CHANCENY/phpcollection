<section><div class="about-us"><h1 class="about-us-about-us">OUR SERVICES</h1></div></section>
<section class="service-containers">
	<?php $list =array('Chance Nyasulu','Rohan Kumar','Mehak Deep','Divjot Manjani','Marcos Jova'); ?>
	<?php for($i=0; $i < count($list); $i++): ?>
	<div class="service-cover">
		<div class="service-image">
			<img src="navigationbar/7.jpeg" class="service-image">
		</div>
		<div class="contents-details">
			<label class="breaks"><strong>Name:</strong><?php echo $list[$i]; ?></label>
			<label class="breaks"><strong>Age:</strong> 28 yrs</label>
			<label class="breaks"><strong>Status:</strong> available 24/7</label>
			<label class="breaks"><strong>Charges:</strong> low price</label>
			<form action="#" method="post">
				<input type="hidden" name="id" value="<?php echo "chance"; ?>">
				<input type="submit" name="moreview" value="View details!" class="sendingbutton">
			</form>
		</div>
		<label class="breaks"><strong>Description: </strong>hello am lincoln i am web developer contact me to build your website at low price!</label><br>
	</div>
<?php endfor; ?>
	
</section>