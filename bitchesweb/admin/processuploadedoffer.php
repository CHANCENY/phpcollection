
<?php 

 function descriptionproccessing($dfile)
 {
 	if(!empty($dfile))
 	{
      $filename = $dfile['name'];
      $nameandext = explode('.', $filename);
      $ext = strtolower(end($nameandext));

      $list = array('txt');

      if(in_array($ext, $list))
      {
      	if($dfile['size'] < 1000000 && $dfile['size'] > 0)
      	{
      		$file = $dfile['tmp_name'];

             $handle = fopen($file, 'r');
             $text = fread($handle, filesize($file));
             fclose($handle);

             if(!empty($text))
             {
                 return $text;
             }
      	}
      }
 	}

 	return false;
 }

 function processingotherofferlist($dfile)
 {
 	if(!empty($dfile))
 	{
 		$filename = $dfile['name'];
 		$nameandext = explode('.',$filename);
 		$ext = strtolower(end($nameandext));

 		$list = array('txt');
 		if(in_array($ext,$list))
 		{
 			if($dfile['size'] < 1000000 && $dfile['size'] > 0)
 			{
 				$file = $dfile['tmp_name'];
 				$handle = fopen($file, 'r');
 		        $text = fread($handle, filesize($file));
 		        fclose($handle);

 		        if(!empty($text))
 		        {
 			        
 			        return $text;
 		        }
 			}
 		}
 	}

 	return false;
 }

 function proccessingimages($dfile)
 {
 	if(!empty($dfile))
 	{
 		$filename = $dfile['name'];
 		$size = $dfile['size'];

 		$nameandext = explode('.',$filename);
 		$ext = strtolower(end($nameandext));

 		$list = array('png','jpg','jpeg');
 		if(in_array($ext, $list))
 		{
          if($size < 3000000)
          {
          	$photo = $dfile['tmp_name'];
            $target = "offer_images/".$filename;
                             
            if(file_exists($target))
            {
               here:
               $target = null;
               $target = "offer_images/".$nameandext[0]."-".strval(rand()).".".end($nameandext);
               if(file_exists($target))
               {
                   goto here;
               }
            }

            if(move_uploaded_file($photo, $target))
            {
            	return $target;
            }
          }
          return false;
 		}
 		return false; 		
 	}
 	return false;
 }
 





















 ?>