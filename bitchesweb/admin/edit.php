
<?php
include "backendhandlersfiles/AdminClass.php"; 

 if(isset($_POST['update']))
 {
   if(!empty($_FILES['profile']['name']) && !empty($_FILES['back']['name'])){

 	if(!empty($_POST['phone']) && !empty($_POST['displaynames']) && !empty($_POST['email']) && !empty($_POST['joinid']))
 	{
      $dnames = $_POST['displaynames'];
      $phone =$_POST['phone'];
      $email = $_POST['email'];
      $pro = $_FILES['profile'];
      $back = $_FILES['back'];
      $joinid = $_POST['joinid'];

      // process file first

      $pro = proccessingImage($pro,"profile_images");
      if($pro !== false)
      {
         $back = proccessingImage($back,"background_images");
         if($back !== false)
         {
           $update = new Admin();
           $rs = $update->upadatememberinformations($email,$phone,$dnames,$pro,$back,$joinid);
           if($rs === true)
           {
           	$message ="Profile update correctly have to sign out to complete update";
           }
           elseif($rs === false)
           {
             $message ="Error in updating your info";
           }
           else
           {
           	$message = $rs;
           }
         }
         else
         {
         	$message ="Background picture has problem (less than 3mb size and type (jpg,jpeg,png)";
         }
      }
      else
      {
      	$message = "Profile picture has problem (less than 3mb size and type (jpg,jpeg,png)";
      }
        
 	}
 	else{
 		$message ="Fill in all fields";
 	}
 }
 else{
 	$message ="Upload photos before submiting!";
 }
 }


function proccessingImage($image,$taget)
{
		if(!empty($image))
		{
            $filename = $image['name'];
            $extandname = explode('.',$filename);
            
            // extracte file extension
            $ext = strtolower(end($extandname));

            // check file extension
            $list = array('jpg','jpeg','png');

            if(in_array($ext, $list))
            {
              
              //check size
            	if($image['size'] < 3000000)
            	{
                   
                    $photo = $image['tmp_name'];
                    $targets = $taget."/".$filename;
                             
                    if(file_exists($targets))
                    {
                	    here:
                	    $targets = null;
                	    $targets = $taget."/".$extandname[0]."-".strval(rand()).".".end($extandname);
                	    if(file_exists($targets))
                	    {
                           goto here;
                	    }
                    }

                    if(move_uploaded_file($photo, $targets))
                    {
                    	return $targets;
                    }
                    else
                    {
                    	return false;
                    }

            	}
            	else
            	{
            		return false;
            	}
            }
            else
            {
            	return false;
            }
		}
		else
		{
			return false;
		}
	}

 ?>



<?php 


 if(isset($_POST['addlinks']))
 {
   $links = array();
   $type = array();

   if(!empty($_POST['facebook']))
   {
     array_push($links, $_POST['facebook']);
     array_push($type,"facebook");
   }
   if(!empty($_POST['instagram']))
   {
     array_push($links, $_POST['instagram']);
     array_push($type,"instagram");
   }
   if(!empty($_POST['email']))
   {
     array_push($links, $_POST['email']);
     array_push($type,"email");
   }
   if(!empty($_POST['phone']))
   {
     array_push($links, $_POST['phone']);
     array_push($type,"phone");
   }
   if(!empty($_POST['directcall']))
   {
     array_push($links, $_POST['directcall']);
     array_push($type,"directcall");
   }

   if(!empty($links))
   {
     $l = new Admin();

     $res = $l->linksadding($links,$type,$_SESSION['username'],$_SESSION['joinid']);

     if($res === true)
     {
      $messagelik = "Links updated ".strval(count($links));
     }
     else{
      $messagelik = $res;
     }
   }
 }

 ?>



<section class="incallcontainer">
	<div class="regdiv">
		<label>To edit user info fill below form</label>
		<form action="#" method="post" enctype="multipart/form-data">
			<input type="hidden" name="joinid" value="<?php echo $_SESSION['joinid']; ?>">
		<input type="text" name="displaynames" placeholder="Enter new display name" required class="inputreg">

		<input type="tel" name="phone" placeholder="Enter new phone" required class="inputreg">

		<input type="email" name="email" placeholder="Enter new email" required class="inputreg"><br>
        
        <label>profile:</label>
		<input type="file" name="profile" required class="inputreg"><br>
        
        <label>wallpaper picture:</label>
		<input type="file" name="back" required class="inputreg"><br>

		<input type="submit" name="update" class="buttonlogin" value="Update profile now!">
		<label><?php echo $message ?? null; ?></label>
		</form>
	</div>
</section>

<section class="incallcontainer">
  <div class="regdiv">
    <label>ADD LINKS FOR CLIENT TO CONTACT YOU</label>
    <form action="#" method="post" enctype="multipart/form-data">
      <input type="hidden" name="joinid" value="<?php echo $_SESSION['joinid']; ?>">

    <input type="text" name="facebook" placeholder="Enter facebook link" class="inputreg">

    <input type="tel" name="phone" placeholder="Enter phone for whatsapp" class="inputreg">

    <input type="email" name="email" placeholder="Enter email" class="inputreg">
        
    <input type="text" name="instagram" placeholder="Enter instagram link" class="inputreg">

    <input type="text" name="directcall" placeholder="Enter phone for direct call" class="inputreg"><br>

    <input type="submit" name="addlinks" class="buttonlogin" value="Update profile links!">
    <label><?php echo $messagelik ?? null; ?></label>
    </form>
  </div>
</section>