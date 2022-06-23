<?php 

if(isset($_POST['comsubmit']))
{
	if(!empty($_POST['cname']) && !empty($_POST['exname']) && !empty($_POST['esid']) && !empty($_POST['serid']) && !empty($_FILES['complaindoc']))
	{
		$filename = $_FILES['complaindoc']['name'];
		$nameandext = explode('.',$filename);
		$ext = strtolower(end($nameandext));
		$list = array('txt','doc','docx','pdf','docs');

		if(in_array($ext, $list))
		{
          if($_FILES['complaindoc']['size'] < 2000000 && $_FILES['complaindoc']['size'] > 0)
          {
            $doc = $_FILES['complaindoc']['tmp_name'];
            $target = "Complaindocumentfolder/".$filename;
            if(file_exists($target))
            {
            	here:
            	$target = null;
            	$target ="Complaindocumentfolder/".$nameandext[0].'-'.strval(rand()).'.'.end($nameandext);
            	if(file_exists($target))
            	{
            		goto here;
            	}
            }

            if(move_uploaded_file($doc, $target))
            {
            	$cname = $_POST['cname'];
            	$ename = $_POST['exname'];
            	$seid = $_POST['serid'];
            	$exid = $_POST['esid'];

            	$com = new complaintClient();
            	$res = $com->takecomplaint($cname,$ename,$exid,$seid,$target);
            	if($res === true)
            		$message ="Complain successfully submitted!";
            	elseif($res === false)
            		$message ="Complain submission failed!";
            	else
            		$message = $res;
            }
            else{
            	$message ="Document failed to upload";
            }
          }
		}
		else{
			$message = "File document is invalid type";
		}
	}
}

 ?>




<section class="comcontainer">
	<div class="divcomp">
		<h2>Fill complaint below</h2>
		<form action="#" method="post" enctype="multipart/form-data">
			
			<input type="text" name="cname" placeholder="Enter your name" required class="inputreg">
			<input type="text" name="exname" placeholder="Enter escort name" required class="inputreg">
			<input type="text" name="esid" placeholder="Enter escort identity" required class="inputreg">
			<input type="text" name="serid" placeholder="Enter service id involved" required class="inputreg">
			<br><br>
            <label>upload complaint document</label><br>
		    <input type="file" name="complaindoc" required class="inputreg">
			<br><br>
			<input type="submit" name="comsubmit" value="Submit Complaint"class="buttonlogin"><br>

			<label><?php echo $message ?? null; ?></label>
		</form>
	</div>
</section>