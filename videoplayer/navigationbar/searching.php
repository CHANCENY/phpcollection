<?php 
  include "Handlers/searchingHandler.php";

   if(isset($_GET['searchsubmit']))
   {
   	
       	if(!empty($_GET['searching']))
       	{
 	        	$lookvalue = $_GET['searching'];
 	        	$hid = $_GET['check'];
 	        	$ide = intval($hid);
 	        	if($ide === 2)
 	        	{   
 	        		  
 	            	$_SESSION['postsearched'] = searchrandom($lookvalue,null,null,null);
 	          }
 	          elseif($ide === 1)
 	          {
 	          	
 	          	if(!empty($_GET['selectvalue']) && !empty($_GET['charges']) && !empty($_GET['status']))
 	          	{
 	          	  $title = $_GET['searching'];
 	          	  $cate = $_GET['selectvalue'];
 	          	  $charge = $_GET['charges'];
 	          	  $av = $_GET['status'];
                $_SESSION['postsearched'] = searchrandom($title,$charge,$cate,$av);
              }
            }
 	      }
 }


 ?>

<section><div class="about-us"><h1 class="about-us-about-us">Searched results...</h1></div></section>


<section class="servicecontainering">
	<?php if(!empty($_SESSION['postsearched'])): ?>
	<?php foreach ($_SESSION['postsearched'] as $key): ?>
		

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

<section><div class="about-us"><h4 class="about-us-about-us" >sorry no results post found!</h4></div></section>


<?php endif ?>
	

