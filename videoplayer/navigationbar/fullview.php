<?php 
include "Handlers/fullViewHandler.php";
$_SESSION['image'] = null;
$_SESSION['op'] = 0;
 if(isset($_GET['moreview']))
 {
 	if(!empty($_GET['id']) && !empty($_GET['owner']))
 	{
         $rowid = $_GET['id'];
 	     $ownerid = $_GET['owner'];
       $serviceid = $_GET['serviceid'];

         $_SESSION['viewed'] = fullnow($rowid, $ownerid);
         $_SESSION['infodata'] = infomore($ownerid);
         increaseviews($ownerid, $serviceid);
         $loves = getviewsandlikes($ownerid,$serviceid);
         if(!empty($loves))
         {
           $list = explode(',', $loves);
           $_SESSION['like'] = $list[0];
           $_SESSION['views'] =$list[1];

           if(empty($_SESSION['like']))
           {
            $_SESSION['like'] = strval(0);
           }
           if(empty($_SESSION['views']))
           {
            $_SESSION['views'] = strval(0);
           }
         }
 	}

 }
 ?>




<section class="fullcontainer">
	<?php if(!empty($_SESSION['viewed'])): ?>

	<?php foreach($_SESSION['viewed'] as $key): ?>
	<div class="outsidefullviewdiv">
    <img src="<?php echo 'data:image;base64,'.base64_encode($key['image']); ?>" class="image">
	<div class="comp">
		<label class="labelfull"><span style="color:darkgreen;">Post&nbsp;&nbsp;</span><?php echo $key['title']; ?></label><label class="labelfull">&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="color:darkgreen;">Category</span>&nbsp;&nbsp;<?php echo $key['category']; ?></label>
		<p class="parag"><?php echo $key['description']; ?></p>
		<label>posted on <?php echo $key['posted']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>charge <span style="color:darkgreen"><?php echo $key['charges']; ?></span></label>
    </form>
    <?php $_SESSION['likedservicesid'] = $key['serviceid']; ?>
     <?php $_SESSION['likedownerid'] = $key['owner']; ?>
		<?php endforeach; ?>
       <?php endif; ?>
        <hr><br><br>
       
      <?php if(!empty($_SESSION['infodata'])): ?>
      	<?php foreach($_SESSION['infodata'] as $p): ?>
        <h2>Contact <?php echo $p['fullname']; ?>.</h2>

        <a href="https://wa.me/<?php echo $p['phone']; ?>/?text=chat with <?php echo $p['fullname']; ?>"><img src="https://img.icons8.com/color/48/000000/whatsapp--v5.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

         <a href="mailto:<?php echo $p['email']; ?> target=blank"><img src="https://img.icons8.com/emoji/48/000000/e-mail.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <a href="tel:<?php echo $p['phone']; ?>"><img src="https://img.icons8.com/fluency/48/000000/phone.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <a href="http://www.instagram.com/<?php echo $p['instagram']; ?>"><img src="https://img.icons8.com/fluency/48/000000/instagram-new.png"/></a>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <a href="https://www.facebook.com/<?php echo $p['facebook']; ?>"><img src="https://img.icons8.com/fluency/48/000000/facebook-new.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

           <a href="liked.php"><img src="https://img.icons8.com/external-icongeek26-outline-colour-icongeek26/64/undefined/external-like-donation-and-charity-icongeek26-outline-colour-icongeek26.png"/></a>
           <br><hr><br>
           
            <?php endforeach; ?>
             <label>Likes&nbsp;<?php echo $_SESSION['like'] ?? null; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Views&nbsp;&nbsp;<?php echo  $_SESSION['views'] ?? null; ?></label>
           <br><hr><br>

     <?php endif; ?>

      <?php foreach($_SESSION['viewed'] as $key): ?>

           <form action="allimages.php" method="get">
             <input type="hidden" name="serviceimagesid" value="<?php echo $key['serviceid']; ?>">
             <input type="submit" name="viewimages" value="more images &gt;" style="background-color:transparent; border-left: none; border-right: none; border-top: none; font-family: sans-serif; font-size: large;">
           </form>

         <?php endforeach; ?>



	</div>	
	</div>
</section>

