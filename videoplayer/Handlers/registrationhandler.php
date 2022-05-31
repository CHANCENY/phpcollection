<?php 
session_start();
include "../bankendconfig/BankendClasses.php";


 function collect_info_one($username, $firstname, $lastname, $gender, $birthday, $email, $phone, $profile)
 {
     if(!empty($profile) && !empty($username) && !empty($firstname) && !empty($lastname) && !empty($email))
     {
        $fullname = $firstname.' '.$lastname;
        $Dateobject = new DateTime();
        $today = $Dateobject->format("d-m-Y");

        // making object to database assoc

        $object1 = $person = array('username' =>$username ,'fullname'=>$fullname,'gender'=>$gender,'birthday'=>$birthday,'email'=>$email,'phone'=>$phone,'join'=>$today,'profile'=>$profile);       
        	return $object1; 
        	
     }
     else
 	{
 		return "Something is wrong";
 	}
 }

 function collect_info_two($race, $town, $city, $state, $country,$desc,$password,$confirm)
 {
 	if(!empty($password) && !empty($race) && !empty($town) && !empty($city) && !empty($state) && !empty($country) && !empty($desc) && !empty($confirm))
 	{
        if(md5($password) === md5($confirm))
        {
           $object = $person_second_part = array('race' =>$race ,'town'=>$town,'city'=>$city,'state'=>$state,'country'=>$country,'description'=>$desc,'password'=>md5($password));
           return $object;  
        }
        else
        {
        	return "passwords dont match!";
        }
 	}
 	else
 	{
 		return "Something is wrong";
 	}
 }

 if(isset($_POST['regone']))
 {
 	if(!empty($_FILES['upload']['name']))
 	{
       if(!empty($_POST['first']) && !empty($_POST['last']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['birthday']) && !empty($_POST['radio']))
       {
       	 $file = $_FILES['upload'];
       	 $filename = $file['name'];
       	 $nameandext = explode('.', $filename);
       	 $list = array('jpg','jpeg','webp','svg','png');
       	 $ext = strtolower(end($nameandext));
       	 if(in_array($ext, $list))
       	 {
           $size = $file['size'];
           if($size < 3000000)
           {
              $image = addslashes(file_get_contents($file['tmp_name']));
              $first =  $_POST['first'];
              $last = $_POST['last'];
              $username = $_POST['username'];
              $gender =  $_POST['radio'];
              $birthday =  $_POST['birthday'];
              $email = $_POST['email'];
              $phone = $_POST['phone'];
             // $_SESSION['registringuser'] = $first.' '.$last.' '.$username.' '.$gender.' '.$birthday.' '.$email.' '.$phone.' '.$image;

              $_SESSION['registringuser'] = collect_info_one($username, $first, $last, $gender, $birthday, $email, $phone, $image);

              	$_SESSION['increament'] = $_SESSION['increament'] + 1;
              	$_SESSION['messages']="part two of two";
              	header("Location: ../Registration.php");
           }
           else
           {
           	$_SESSION['messages'] = "File size is too big";
            header("Location: ../Registration.php");
            
            
           }
       	 }
       	 else
       	 {
       	 	$_SESSION['messages'] = "File not allowed";
            header("Location: ../Registration.php");
       	 }
       }
 	}
 	else
 	{
 		$_SESSION['messages'] = "photo not picked!";
        header("Location: ../Registration.php");
 	}
 }

 if(isset($_POST['registrationsubmit']))
  {
 	if(!empty($_POST['race']) && !empty($_POST['town']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['country']) && !empty($_POST['desc']) && !empty($_POST['password']) && !empty($_POST['confirm']))
 	{
 		$race = $_POST['race'];
 		$town = $_POST['town'];
 		$city = $_POST['city'];
 		$state = $_POST['state'];
 		$country = $_POST['country'];
 		$desc = $_POST['desc'];
 		$password = $_POST['password'];
 		$confirm = $_POST['confirm'];

 		 $obj2 = collect_info_two($race, $town, $city, $state, $country,$desc,$password,$confirm);
 		// $_SESSION['increament'] = $_SESSION['increament'] + 1;

 		 $_SESSION['alluser'] = array_merge($_SESSION['registringuser'],$obj2);
        
         $regnow = new registrations();
         $_SESSION['alluser'] = $regnow->saving_provider( $_SESSION['alluser'] );
         $_SESSION['increament'] = $_SESSION['increament'] + 1;
         header("Location: ../Registration.php");
 	}
 }

 ?>