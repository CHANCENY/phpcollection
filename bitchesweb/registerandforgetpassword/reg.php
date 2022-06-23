<?php 
 include "backendhandlersfiles/validateuserclass.php";
 
 ?>

 <?php 

 if(isset($_POST['submitreguser']))
 {
 	if(!empty($_FILES['profile']['name']))
 	{
 		if(!empty($_POST['displayname']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password1']) && !empty($_POST['password2']))
 		{

 			// collecting enter user information
           $fullname = $_POST['firstname']." ".$_POST['lastname'];
           $displayname = $_POST['displayname'];
           $email = $_POST['email'];
           $phone = $_POST['phone'];
           $password1 = $_POST['password1'];
           $password2 = $_POST['password2'];
           $file = $_FILES['profile'];


           // validate email
           if(filter_var($email,FILTER_VALIDATE_EMAIL))
           {
             
             // check password if matches
           	 if($password2 === $password1)
           	 {
               
               //working on profile image

           	 	$filename = $file['name'];
           	 	$size = $file['size'];
           	 	$error = $file['error'];

           	 	// check if image uploaded correctly
           	 	if($error === 0)
           	 	{
                   
                   // extracting file extension
           	 		$exfilter = array('jpg','png','jpeg');
                    $exandname = explode('.', $filename);
                    $ext = strtolower(end($exandname));


                    //checking if right file uploaded
                    if(in_array($ext, $exfilter))
                    {
                      
                      // checking file size
                    	if($size < 3000000)
                    	{
                           
                           //making target folder to upload file and ext real photo data
                    	
                    		$photo = $file['tmp_name'];
                    		$target = "profile_images/".$filename;
                             
                            if(file_exists($target))
                            {
                	            here:
                	            $target = null;
                	            $target = "profile_images/".$exandname[0]."-".strval(rand()).".".end($exandname);
                	            if(file_exists($target))
                	            {
                                    goto here;
                	            }
                            }

                            if(move_uploaded_file($photo, $target))
                            {


                              // to database for insrtion process
                              $reg = new UserValidatorClass();
                              $result = $reg->register($displayname,$fullname,$email,$phone,$password1,$target);

                              if($result === true)
                              {
                                $toverify = $reg->get_username();

                                // verify account

                                $to =null;
                                $name = null;
                                $toverifytoken = null;

                                foreach ($toverify as $key) {
                                    $name = $toverify['name'];
                                    $senderto = $toverify['email'];
                                    $toverifytoken = $toverify['token'];
                                }

                                $_SESSION['messages'] = null;
                                $_SESSION['liks'] = "verificationaccount.php?token=$toverifytoken&usern=$name";
                              }
                              else
                              {
                                $_SESSION['messages']= $result;
                              }
                            }
                            else
                            {
                            	$_SESSION['messages'] ="Photo failed to upload try again";
                            }

                    	}
                    	else
                    	{
                    		$_SESSION['messages'] ="File size is too large allowed(max 3mb)";
                    	}
                    }
                    else
                    {
                      $_SESSION['messages'] = "Photo upload is not in correct type allowed(jpg,jpeg,png)";
                    }
           	 	}
           	 	else
           	 	{
           	 		$_SESSION['messages'] ="Profile image encountered uploading problems!";
           	 	}

           	 }
           	 else
           	 {
           	 	$_SESSION['messages'] ="Password dont match!";
           	 }
           }
           else
           {
           	$_SESSION['messages'] = "Email is invalid please check!";
           }


 		}
 		else
 		{
 			$_SESSION['messages'] = "Fill in all fields!";
 		}
 	}
 	else
 	{
 		$_SESSION['messages'] = "upload profile photo";
 	}
 }


  ?>
<section class="rgicontainer">
	<div class="regdiv">
		  <img src="asset/logo.jpg" class="reimage">
		<form action="#" method="post" class="form" enctype="multipart/form-data">
			<input type="text" name="displayname" placeholder="Enter display name" required class="inputreg">

			<input type="text" name="firstname" placeholder="Enter first name (hidden to public)" required class="inputreg">

			<input type="text" name="lastname" placeholder="Enter last name (hidden to public)" required class="inputreg">

			<input type="email" name="email" placeholder="Enter email (available for public)" required class="inputreg">

			<input type="phone" name="phone" placeholder="Enter phone (available for public)" required class="inputreg">

			<input type="password" name="password1" placeholder="Enter password" required class="inputreg" minlength="8">

			<input type="password" name="password2" placeholder="Confirm password" required class="inputreg" minlength="8">

			<label>profile</label><input type="file" name="profile" required class="inputreg">

            <input type="submit" name="submitreguser" class="buttonlogin" value="submit to create account"><br><br><label><?php echo $_SESSION['messages'] ?? null; ?></label>
            <br><br>
           <?php if(!empty($_SESSION['liks'])): ?> 
            <a href="<?php echo  $_SESSION['liks'] ?? null ?>" style="text-decoration: underline; color: blue;">Account sucessfully created continue to verify you account</a>
          <?php endif; ?>
		</form>
	</div>
</section>


