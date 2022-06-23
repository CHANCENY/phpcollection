<?php 

 

if(isset($_GET['joinid']))
{
	if(!empty($_GET['joinid']) && !empty($_GET['serviceid']))
	{
		$join = $_GET['joinid'];
	     $servid = $_GET['serviceid'];
	     $v = new displayPost();
          $ser = $v->viewfull($join, $servid);
          $displayname = $v->displayname($join);
          $links = $v->links($join);
          $comm = $v->commentcollecttoshow($servid);         

          $email =null;
          $facebook = null;
          $inst = null;
          $phone = null;
          $whatsapp = null;

          if(!empty($links))
          {
          	foreach ($links as $key) {
          		$email = $key['email'];
          		$facebook = $key['facebook'];
          		$inst = $key['instagram'];
          		$phone = $key['directcall'];
          		$whatsapp = $key['phone'];
          	}
          }

	}
}


if(isset($_POST['commentsubmit']))
{
	if(!empty($_POST['comment']))
	{
		$owner = $_POST['owner'];
		$serv = $_POST['serviceid'];
		$comm = $_POST['comment'];

		if(!empty($_SESSION['username']))
		{
			$comment = new complaintClient();
			$res = $comment->commentsave($owner,$serv,$comm,$_SESSION['username']);
			if($res === true)
				$messagec = "Commented";
			elseif($res === false)
				$messagec ="you have`nt commented";
			else
				$messagec = $res;
		}else{

			$comment = new complaintClient();
			$res = $comment->commentsave($owner,$serv,$comm,"unknown");
			if($res === true)
				$messagec = "Commented";
			elseif($res === false)
				$messagec ="you have`nt commented";
			else
				$messagec = $res;

		}

		$v = new displayPost();
		 $comm = $v->commentcollecttoshow($servid); 

	}
}
 

 ?>


<section class="incallcontainer">
	<div class="regdiv">
		<?php if(!empty($ser)): ?>


		<?php foreach ($ser as $key): ?>

		<div class="inside" style="width:100%">
			<h2><?php echo $key['title']; ?></h2>
			<hr>
			<br>
			<p><?php echo $key['description']; ?></p>
			<hr>
			<ul>

				<?php $ti = $key['subtitles']; $list = explode('@',$ti); ?>

				<?php for($i = 0; $i < count($list); $i++): ?>
				<li><?php echo $list[$i]; ?></li>
				

			     <?php endfor; ?>
			</ul>

			<hr>
		    	<h4>Charges:&nbsp;&nbsp;&nbsp; <?php echo $key['charges']; ?></h4>
		    
		</div>
		<hr>
		<label>Escort id |<?php echo $key['ownerusername']; ?>|</label>&nbsp;&nbsp;&nbsp;<label>Serviceid |<?php echo $key['serviceid']; ?>|</label>
		&nbsp;&nbsp;&nbsp;<label>Escortname |<?php echo $displayname; ?>|</label>
		&nbsp;&nbsp;&nbsp;<label>Posted on |<?php echo $key['dates']; ?>|</label>
		<br>
			<hr>
		<div class="linkstocontactss" style="margin-left: 5%;">
			<h4>Follow or contact</h4>
			<a href="https://wa.me/<?php echo $whatsapp; ?>/?text=talk: <?php echo $displayname; ?>"><img src="https://img.icons8.com/color/48/undefined/whatsapp--v6.png"/></a>

			<a href="http://www.instagram.com/<?php echo $inst; ?>/"><img src="https://img.icons8.com/fluency/48/undefined/instagram-new.png"/></a>

			<a href="https://www.facebook.com/<?php echo $facebook; ?>/"><img src="https://img.icons8.com/color/48/undefined/facebook-new.png"/></a>


			<a href="mailto:<?php echo $email; ?>"><img src="https://img.icons8.com/emoji/48/undefined/e-mail.png"/></a>


			<a href="tel:<?php echo $phone; ?>"><img src="https://img.icons8.com/color/48/undefined/apple-phone.png"/></a>

			
		</div>
        <br>
        <hr>
        <div style="">
        	<h4>Images vailable</h4>

        	<?php $img = $key['images']; $imgs = explode('@', $img); ?>

        	<?php for ($i=0; $i < count($imgs) -1; $i++): ?>

        	<img src="<?php echo $imgs[$i]; ?>" style="display: block;margin-left: auto;margin-right: auto;width: 90%; margin-bottom: 2%;">
            <hr>

        <?php endfor; ?>
        	      	
        </div>
       
      <a href="admvideos.php?videos=<?php echo $key['serviceid']; ?>" style="background-color: green;color: white; border: 1px solid green; padding: 1%;margin: 1%;">VIEW VIDEOS OF THIS POST&gt;</a>

       <hr>
        
         <br>
        <br>
        <?php endforeach; ?>
        <label><strong>Comments from views and clients</strong></label><br>
        <hr>

       <?php if(!empty($comm)): ?>

       	<?php foreach($comm as $key): ?>
  	<div class="lap">
		<div class="boxs">
			<label>&nbsp;&nbsp;Commented on</label>&nbsp;&nbsp;<label><?php echo $key['dates']; ?></label>
			<label>&nbsp;&nbsp;Commented by</label>&nbsp;&nbsp;<label><?php echo $key['bywho']; ?></label>
			<hr>
			<div style="width: 80%;">
				<p><?php echo $key['comment']; ?></p>
			</div>		
		</div>
	</div>
    <?php endforeach; ?>

    <?php else: ?>

    	<label style="margin-left:20%;">No comments post yet</label>

    <?php endif; ?>

        <?php foreach ($ser as $key): ?>

        <h5>Comment on this post</h5>
        <form action="#" method="post">
        	<input type="hidden" name="serviceid" value="<?php echo $key['serviceid']; ?>">
        	<input type="hidden" name="owner" value="<?php echo $key['ownerusername']; ?>">
        	<input type="text" name="comment" placeholder="write comment" style="border-left: none; border-right: none; border-top: none; width: 500px;">
        	<input type="submit" name="commentsubmit" class="buttonlogin" value="comment">
        	<label><?php echo $messagec ?? null; ?></label>
        </form>
     <?php endforeach; ?>
  
   <?php endif; ?>
	</div>	
</section>