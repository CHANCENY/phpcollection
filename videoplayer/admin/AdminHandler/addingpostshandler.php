<?php 

session_start();
include "../../bankendconfig/BankendClasses.php";

// function to proccess images 

function processingimage($image)
{
   if(!empty($image))
   {
      $file = $image['name'];
      $nameandext = explode('.', $file);
      $ext = strtolower(end($nameandext));
     
      $filter = array('jpg','jpeg','png','svg','webp');
      if(in_array($ext, $filter))
      {
         $size = $image['size'];
          if($size < 3000000)
          {
             $imagedata = addslashes(file_get_contents($image['tmp_name']));
             if(!empty($imagedata))
             {
               return $imagedata;
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
}

// function to send all associative array in one with total to backend classes

 function adding_services_all($total, $serviceobject)
 {
 	if(!empty($serviceobject))
   {
       $add = new Addposts();
       $returns = $add->addingservices($total, $serviceobject);
       if($returns === true)
       {

         header("Location: ../addingservices.php");
       }
   }
 }


// below we  are receving th post request of uploading posts made

 if(isset($_POST['submitserv']))
 {
 	// making array to store posted values

 	$cate = array('sample');
 	$tit = array('sample');
 	$char = array('sample');
 	$des = array('sample');
 	$up = array('sample');
   $avail = array('sample');

   // getting total number of row of posting feilds

 	$totalrecived = $_SESSION['total'];
    $size = intval($totalrecived);
   $needamount = 0;
   
    // getting posted value from url into array

 	for ($i=0; $i < $size; $i++) { 
 		
      if(!empty($_FILES['upload'.strval($i)]['name']))
      {
         $ct = $category = array('category'.strval($i) =>$_POST['category'.strval($i)]);
         $t = $title = array('title'.strval($i) =>$_POST['servicename'.strval($i)]);
         $ha = $charges = array('charges'.strval($i) =>$_POST['charges'.strval($i)]);
         $av = $available = array('available'.strval($i) =>$_POST['available'.strval($i)]);
         $ds = $description = array('descs'.strval($i) =>$_POST['desc'.strval($i)]);
          $result = processingimage($_FILES['upload'.strval($i)]);
          if($result === false)
          {
            $_SESSION['statusimages'] = "Image number ".strval($i+1)." of ".strval($size)." has problem ";
             header("Location: ../addingservices.php");
             break;

          }
          else
          {
             $u = $images = array('upload'.strval($i) =>$result);
             $cate = array_merge($cate,$ct);
             $tit = array_merge($tit,$t);
             $char = array_merge($char,$ha);
             $avail = array_merge($avail,$av);
             $des = array_merge($des,$ds);
             $up = array_merge($up,$u);
             $needamount = $needamount + 1;
             $_SESSION['okones'] ="First ".strval($i+1)." posts uploaded!";
             $_SESSION['statusimages'] = "Image ".strval($i+1)." uploaded! ";
          }                     
         
      }
 		
 	}
   
  
   // deleting sample and joining lists

   // verifying if putting value in array has atleast done once

     $up = array_reverse($up);
    array_pop($up);
    $up = array_reverse($up);

   if(!empty($up))
   {
       $cate = array_reverse($cate);
       array_pop($cate);
       $cate = array_reverse($cate);
    
     $tit = array_reverse($tit);
    array_pop($tit);
    $tit = array_reverse($tit);

     $char = array_reverse($char);
    array_pop($char);
    $char = array_reverse($char);

     $des = array_reverse($des);
    array_pop($des);
    $des = array_reverse($des);

     $avail = array_reverse($avail);
    array_pop($avail);
    $vail = array_reverse($avail);

      // join all proccessed data array in associtive mode

      $objectcollected = array_merge($cate,$tit,$char,$vail,$des,$up);
      
      adding_services_all($needamount, $objectcollected);

   }
   else
   {
      $_SESSION['statusimages'] ="All files (".strval($size).") have been denied posting terminated!";
       header("Location: ../addingservices.php");
   }

 }


 ?>