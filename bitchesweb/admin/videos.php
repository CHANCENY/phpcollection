<?php 

include "backendhandlersfiles/AdminClass.php";


 if(isset($_GET['ser']))
 {
 	if(!empty($_GET['ser']))
 	{
 		$servid = $_GET['ser'];
 		$_SESSION['videospage'] = 0;
 	}
 }

 if(isset($_GET['videos']))
 {
 	if(!empty($_GET['videos']))
 	{
 		$servid = $_GET['videos'];
 		$_SESSION['videospage'] = 2;

 		$vide = new Admin();
 		$allvideos = $vide->viewvideos($servid);
 		if(!empty($allvideos))
 		{
 			$playline = null;
           foreach ($allvideos as $key) {
           	 $playline = $key['videos'];
           }

           $playlist = explode('@',$playline);
 		}
 	}
 }

 ?>



<?php 

 if(isset($_POST['addv']))
 {
 	if(!empty($_FILES['videoadded']))
 	{
 		$names = array();
 		$sizes = array();
 		$videos = array();

 		$list = array("name","size","tmp_name");

 		for ($i=0; $i < count($list); $i++) { 
 			
 			foreach ($_FILES['videoadded'][$list[$i]] as $key => $value) {
 				
 				if($i === 0)
 				{
 					array_push($names, $value);
 				}
 				if($i === 1)
 				{
 					array_push($sizes, $value);
 				}
 				if($i === 2)
 				{
 					array_push($videos, $value);
 				}
 			}
 		}
 		$u = 0;
 		$j = 0;

 		$uploadedvideos = null;

 		for ($i=0; $i < count($names); $i++) { 

 		  $vfile = $n = array('name' =>$names[$i],'size'=>$sizes[$i],'tmp_name'=>$videos[$i]);
          $result = videosmaker($vfile);
          if($result === false)
          {
          	$j = $j + 1;
          	continue;
          }
          else
          {
            $uploadedvideos .= $result."@";
            $u = $u + 1;
            continue;
          }
 		}

 		$message1 = "Uploaded  videos: ".strval($u);
 		$message2 = "Failed videos: ".strval($j);
      if(!empty($uploadedvideos))
      {
      	$ad = new Admin();
      	$return = $ad->addingvideos($uploadedvideos,$servid);
      	if($return === true)
      		$message ="Videos uploaded successfully";
      	elseif($return === false)
      		$message ="Upload failed";
      	else
      		$message = $return;

      }
 		


 	}
 }


 function videosmaker($vfile)
 {
 	if(!empty($vfile))
 	{
       $filename = $vfile['name'];
       $nameandext = explode('.', $filename);
       $ext = strtolower(end($nameandext));

       $list = array("org","mp4","webm");

       if(in_array($ext,$list))
       {
       	 if($vfile['size'] < 10000000 && $vfile['size'] > 0)
       	 {
       	 	$target = "offer_videos/".$filename;
       	 	if(file_exists($target))
       	 	{
       	 		here:
       	 		$target = null;
       	 		$target = "offer_videos/".$nameandext[0]."-".strval(rand()).".".end($nameandext);
       	 		if(file_exists($target))
       	 		{
       	 			goto here;
       	 		}
       	 	}

       	 	if(move_uploaded_file($vfile['tmp_name'], $target))
       	 	{
       	 		return $target;
       	 	}
       	 }
       }

       return false;
 	}

 }

 ?>


<?php if($_SESSION['videospage'] === 0): ?>
<section class="incallcontainer">
	<div class="regdiv">
		<form action="#" method="post" enctype="multipart/form-data" class="form">
			<label>Upload videos 5 (max size 10mb)</label><br>
			<input type="file" name="videoadded[]" class="inputreg" required multiple>
			<input type="submit" name="addv" value="ADD videos" class="buttonlogin"><br>
			<label><?php echo $message1 ?? null; ?></label><br>
			<label><?php echo $message2 ?? null; ?></label><br>
			<label><?php echo $message ?? null; ?></label>
		</form>
	</div>
</section>

<?php else: ?>

<section class="incallcontainer">
	<div class="regdiv">

		<?php if(!empty( $playlist)): ?>


		<?php for ($i=0; $i < count($playlist) - 1; $i++): ?>
		<video width="700" height="600" controls="controls" style="display:block; margin-left: auto; margin-right: auto;">
            <source src="<?php echo $playlist[$i]; ?>" type="video/mp4" />
            <source src="<?php echo $playlist[$i]; ?>" type="video/ogg" />
            <source src="<?php echo $playlist[$i]; ?>" type="video/webm" />
            <object data="<?php echo $playlist[$i]; ?>" width="320" height="240">
            <embed src="<?php echo $playlist[$i]; ?>" width="320" height="240">
              Your browser does not support video
            </embed>
            </object>
        </video>
    <?php endfor; ?>
       <?php else: ?>

       	<h1>You have not added any videos for this post</h1>

       <?php endif; ?>
	</div>
</section>

<?php endif; ?>