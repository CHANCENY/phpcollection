<?php 
include "backendhandlersfiles/AdminClass.php";
 $username = $_SESSION['username'];
 $join = $_SESSION['joinid'];

 $post = new Admin();

 $all = $post->collect_all_post($username,$join);
 $own = $post->ownerlinks($username);


 ?>



<?php if(!empty($all)): ?>

<section class="incallcontainer">
	<div class="regdiv">
	 <?php foreach ($all as $key): ?>
		<div class="inside" style="width:100%">
                  
			<h2><?php echo $key['title']; ?></h2>
			<hr>
			<h4>Description</h4>
			<p><?php echo $key['description']; ?></p>
			<hr>
			<h4>Services list</h4>
			<?php 

                  $list = explode('@', $key['subtitles']);
                  $size = count($list);
			 ?>
			<ul>
			<?php for ($i=0; $i < $size; $i++): ?>
				<li><?php echo $list[$i]; ?></li>
			<?php endfor; ?>
				
			</ul>

		
		</div>
		<br>		
        <hr>

        <div class="linkstocontactss" style="margin-left: 5%;">
			<h4>Follow or contact</h4>

			<a href="https://wa.me/<?php echo $own[2]; ?>/?text=talking to:&nbsp;<?php echo $_SESSION['display']; ?>"><img src="https://img.icons8.com/color/48/undefined/whatsapp--v6.png"/></a>

			<a href="http://www.instagram.com/<?php echo $own[1]; ?>/"><img src="https://img.icons8.com/fluency/48/undefined/instagram-new.png"/></a>

			<a href="https://www.facebook.com/<?php echo $own[0]; ?>/"><img src="https://img.icons8.com/color/48/undefined/facebook-new.png"/></a>


			<a href="mailto:<?php echo $own[3]; ?>"><img src="https://img.icons8.com/emoji/48/undefined/e-mail.png"/></a>


			<a href="tel:<?php echo $own[4]; ?>"><img src="https://img.icons8.com/color/48/undefined/apple-phone.png"/></a>		    
		  		
		</div>
		<br><hr>

        <div style="">

        	<?php 
            
            $images = explode('@', $key['images']);
            $sizes  = count($images);

        	 ?>
        	<h4>Images vailable</h4>

        	<?php for ($i=0; $i < $sizes - 1; $i++): ?>

        	<img src="<?php echo $images[$i]; ?>" style="display: block;margin-left: auto;margin-right: auto;width: 90%; margin-bottom: 2%;">
             <hr> 
             <?php endfor; ?>      	
        </div>

        <a href="admvideos.php?ser=<?php echo $key['serviceid']; ?>" style="background-color: green;color: white; border: 1px solid green; padding: 1%;margin: 1%;">ADD VIDEOS TO THIS POST &gt;</a>

        <a href="admvideos.php?videos=<?php echo $key['serviceid']; ?>" style="background-color: green;color: white; border: 1px solid green; padding: 1%;margin: 1%;">VIEW VIDEOS OF THIS POST&gt;</a>

        <hr>
        <br>
     <?php endforeach ?>
	</div>
	
</section>

<?php else: ?>

	<h1>No post available yet</h1>

<?php endif; ?>


