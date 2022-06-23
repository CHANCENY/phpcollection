<?php 
 include "backendhandlersfiles/AdminClass.php";
 include "admin/processuploadedoffer.php";

 
 if(isset($_POST['postnow']))
 {
 	if(!empty($_FILES['description']) && !empty($_FILES['photo']) && !empty($_POST['title']) && !empty($_POST['price']) && !empty($_POST['category']) && !empty($_FILES['document']))
 	{
       // images gathering
 		$names = array();
 		$size = array();
 		$photoactu = array();
 		$photouploaded = null;
 		$failed = null;
 		$list = array('name','size','tmp_name');
 		for ($i=0; $i < count($list); $i++) { 

 			foreach ($_FILES['photo'][$list[$i]] as $key => $value) {
 			
 			      if($i === 0)
 			      {
 			      	array_push($names, $value);
 			      }
 			      if($i === 1)
 			      {
 			      	array_push($size, $value);
 			      }
 			      if($i === 2)
 			      {
 			      	array_push($photoactu, $value);
 			      }
 		    }

 		}
          $j = 0; 
          $u = 0;
 		for ($i=0; $i < count($names); $i++) { 
 		   $d = $name = array('name' =>$names[$i] , 'size'=>$size[$i],'tmp_name'=>$photoactu[$i]);
 		   $result = proccessingimages($d);
 		   if($result !== false)
 		   {
              $photouploaded .= $result."@";
              $u = $i + 1;
              continue;
 		   }
 		   else
 		   {
 		   	  $j = $j + 1;
 		      $failed .= strval($j);
 		   	  continue;
 		   } 		   
 		} 

 		$message1 = "Images Uploaded: ".strval($u)." Image failed: ".strval($j);

 		// descrition document
 		$textfound =null;
 		$dfile = $_FILES['description'];
 		$res = descriptionproccessing($dfile);
 		if($res !== false)
 		{
 			$textfound = $res;
 			$message2 = "description file uploaded";

 		}
 		else
 		{
 			$message2 = "description file has problem";
 		}


 		// offer listed titles file
        $listfound = null;
        $dlist = $_FILES['document'];
 		$out = processingotherofferlist($dlist);
 		if($out !== false)
 		{
 			$listfound = $out;
 			$message3 = "Document of list uploaded";
 		}
 		else{
 			$message3 ="Document of list failed!";
 		}
 		

 		// final part collecting other less crictical field and send to backend file
 		$title = $_POST['title'];
 		$charges = $_POST['price'];
 		$category = $_POST['category'];
 		$joinid = $_SESSION['joinid'];
 		$user = $_SESSION['username'];

 		try{
 			$p = new Admin();
 			$r = $p->offersaving($title,$charges,$category,$textfound,$photouploaded,$listfound,$user,$joinid);

 			if($r === true){
 				$message4 = "Offer posted successfully";
 			}
 			elseif($r === false){
 				$message4 ="Technical error found!";
 			}
 			else{
 				$message4 = $r;
 			}
 		}catch(Exception $e){
 			$message4 = $e->getMessage();
 		}
		
 	}
 	else
 	{
 		$message ="Make sure you have complete filling the form!";
 	}
 }


 ?>

<?php 
 if($_SESSION['status'] === true):
 ?>
<section class="incallcontainer">
	
	<div class="regdiv">
		<label>To add services posts fill below form</label>
		<form action="#" method="post" enctype="multipart/form-data">
			<input type="text" name="title" placeholder="Enter title of offer" required class="inputreg">
			<input type="text" name="price" placeholder="Enter Amount (min-max)" required class="inputreg">

			<select name="category" required class="inputreg">
				<option value=" ">category</option>
				<option value="Incall available">In call</option>
				<option value="Outcall available">Out call</option>
				<option value="Both available">Both</option>
			</select><br>

			<label>File of description of offer</label>
			<input type="file" name="description" required class="inputreg"><br>

			<label>Photos (max 7)</label>
			<input type="file" name="photo[]" required class="inputreg" multiple><br>

			<label>File of list of offers(every title on list should end with @)</label>
			<input type="file" name="document" required class="inputreg"><br>

			<input type="submit" name="postnow" value="Add post now!" class="buttonlogin"><br><br>
			<label><?php echo $message1 ?? null; ?></label><br>
			<label><?php echo $message2 ?? null; ?></label><br>
			<label><?php echo $message3 ?? null; ?></label><br>
			<label><?php echo $message4 ?? null; ?></label>
		</form>
	</div>
</section>

<?php else: ?>

<?php 	header("Location: home.php"); ?>

<?php endif; ?>