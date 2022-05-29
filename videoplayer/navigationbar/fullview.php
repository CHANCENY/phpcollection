<?php 
include "Handlers/fullViewHandler.php";
 if(isset($_GET['moreview']))
 {
 	if(!empty($_GET['id']) && !empty($_GET['owner']))
 	{
         $rowid = $_GET['id'];
 	     $ownerid = $_GET['owner'];
         $_SESSION['viewed'] = fullnow($rowid, $ownerid);
         $_SESSION['infodata'] = infomore($ownerid);
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
		<?php endforeach; ?>
       <?php endif; ?>
        <hr><br><br>
       
      <?php if(!empty($_SESSION['infodata'])): ?>
      	<?php foreach($_SESSION['infodata'] as $p): ?>
        <h2>Contact <?php echo $p['fullname']; ?>.</h2>

        <a href="https://wa.me/<?php echo $p['phone']; ?>/?text=chat with <?php echo $p['fullname']; ?>"><img src="https://img.icons8.com/color/48/000000/whatsapp--v5.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

         <a href="mailto:<?php echo $p['email']; ?>"><img src="https://img.icons8.com/emoji/48/000000/e-mail.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <a href="tel:<?php echo $p['phone']; ?>"><img src="https://img.icons8.com/fluency/48/000000/phone.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <a href="http://www.instagram.com/<?php echo $p['instagram']; ?>"><img src="https://img.icons8.com/fluency/48/000000/instagram-new.png"/></a>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <a href="https://www.facebook.com/<?php echo $p['facebook']; ?>"><img src="https://img.icons8.com/fluency/48/000000/facebook-new.png"/></a>

         <?php endforeach; ?>
     <?php endif; ?>
	</div>	
	</div>
</section>

