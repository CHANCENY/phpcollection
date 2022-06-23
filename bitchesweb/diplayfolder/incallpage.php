<?php 

$item = array();

if($_SESSION['cate'] ==="in")
{
  $show  = new displayPost();
  $item = $show->fetchoffers("Incall available");
}
if($_SESSION['cate'] ==="out")
{
  $show  = new displayPost();
  $item = $show->fetchoffers("Outcall available");
}
if($_SESSION['cate'] ==="both")
{
  $show  = new displayPost();
  $item = $show->fetchoffers("Both available");
}
if($_SESSION['cate'] ==="none")
{
	$show = new displayPost();
	$item = $show->collect_all();
}
 
 
 ?>

 <?php 

 if(isset($_GET['search']))
 {
  if(!empty($_GET['search']))
  {
  	$_SESSION['cate'] = "search";
    $se = new Search();
    $item = $se->search($_GET['search']);
  }
 }


  ?>

<section class="incallcontainer" style="background-image: url('asset/back.jpg');">
	       
	       <?php if(!empty($item)): ?>

	       	<?php foreach($item as $key): ?>

	       		<?php $image = explode('@',$key['images']); ?>

		    <div class="divcont">
		       <img src="<?php echo $image[0]; ?>" class="image">	
		       <div class="content">
		    	    <label ><strong><?php echo $key['title']; ?></strong></label>
		    	 <ul>
		    		<?php $list = explode('@',$key['subtitles']); ?>

		    		<?php for ($i=0; $i < count($list); $i++): ?>

		    		<li><?php $it = $list[$i];if(strlen($it) > 90){for($j=0; $j < 90; $j++){ echo $it[$j];}}else echo $list[$i]; ?></li>

		    		<?php endfor; ?>
		    	</ul>
		    	
          
		    	<div class="liks">
		    	   <form action="viewpost.php" method="get">
		    	   	<input type="hidden" name="joinid" value="<?php echo $key['ownerjoinid']; ?>">
		    	   	<input type="hidden" name="serviceid" value="<?php echo $key['serviceid']; ?>">
                    <input type="submit" name="view" value="open post" class="buttonlogin">
		    	   </form>
		        </div>
		      </div>
		    </div>
		    
         <?php endforeach; ?>
		<?php else: ?>

			<h2 style="text-align: center; color:white;">No post offer found</h2>

		<?php endif; ?>

</section>