<?php 
include "databaseconnectionsClass.php";
include "enctyptor/Securing.php";

// classes that does admin functionality of web

class Admin
{
	private $con;
	private $secure;


	public function __construct()
	{
        $co = new mysqli("localhost","root",null,"webforbitches");
   	    $this->secure = new SecurePassword();
   	    $this->con = $co;
	}


	public function upadatememberinformations($email,$phone,$display,$profile,$background,$joinid)
	{
      $query="UPDATE members SET email='$email', phone='$phone', displayname='$display', image='$profile', background='$background' WHERE joinid='$joinid'";
      try{
      	if(mysqli_query($this->con,$query))
      	{
      		return true;
      	}
      	else
      	{
      		return false;
      	}
      }
      catch(Exception $e)
      {
      	return $e->getMessage();
      }
	}


	public function updatepassword($password,$joined)
	{
		$password = $this->secure->savingpassword_encripted_format($password);
		$query ="UPDATE members SET password='$password' WHERE joinid='$joined'";
		try{
			if(mysqli_query($this->con,$query))
			{
				return true;
			}
			else
			{
				return false;
			}


		}catch(Exception $e){
			return $e->getMessage();
		}

	}


	public function offersaving($title,$price,$category,$descr,$images,$list,$user,$joinid)
	{
		$id = null;
		for ($i=0; $i < 10; $i++) { 
			 $id .= strval(rand());
		}
		  $id .= time();
		  $id = md5($id);
      $query ="INSERT INTO offers(ownerusername,ownerjoinid,title,charges,category,description,images,subtitles,serviceid) VALUES('$user','$joinid','$title','$price','$category','$descr','$images','$list','$id')";
      try{
       if(mysqli_query($this->con,$query))
       {
       	return true;
       }else{
       	return false;
       }
      }catch(Exception $e){
      	return $e->getMessage(); 
      }

	}

	public function collect_all_post($user,$joinid)
	{
		$query ="SELECT * FROM offers WHERE ownerusername='$user' AND ownerjoinid = '$joinid'";

		try
		{
	
			$run = mysqli_query($this->con, $query);
			$result2 = mysqli_fetch_all($run,MYSQLI_ASSOC);
			return $result2;

		}catch(Exception $e){
			return null;
		}
		
	}

	public function ownerlinks($user)
	{
		$query ="SELECT * FROM links WHERE ownerusername='$user'";
		try{
			$run = mysqli_query($this->con,$query);
			$result = mysqli_fetch_all($run,MYSQLI_ASSOC);
			$list = array();
			foreach ($result as $key) {
			   array_push($list, $key['facebook']);
			   array_push($list, $key['instagram']);
			   array_push($list, $key['phone']);
			   array_push($list, $key['email']);
			   array_push($list, $key['directcall']);
			}
			return $list;
		}catch(Exception $e){
			return false;
		}
	}

	public function linksadding($links,$type,$user,$joined)
	{
      $q = "SELECT * FROM links WHERE ownerusername='$user' AND ownerjoinid='$joined'";
      $run = mysqli_query($this->con, $q);
      if(!empty(mysqli_fetch_all($run,MYSQLI_ASSOC)))
      { 
        $counter = 0;
      	$size = count($links);       
      	try{
      		for ($i=0; $i < $size; $i++) { 

      			$q ="UPDATE links SET $type[$i]='$links[$i]' WHERE ownerusername='$user' AND ownerjoinid='$joined'";

                 if(mysqli_query($this->con,$q)){
                 	$counter = $counter + 1;
                 }
      		}
      	}catch(Exception $e){
      		return $e->getMessage();
      	}

      	if($size === $counter){
      		return true;
      	}
      }
      else{

            
        $counter = 1;
      	$size = count($links);       
      	try{

           $q ="INSERT INTO links($type[0],ownerjoinid,ownerusername) VALUES('$links[0]','$joined','$user')";
           mysqli_query($this->con,$q);

      		for ($i=1; $i < $size; $i++) { 

      		   $q ="UPDATE links SET $type[$i]='$links[$i]' WHERE ownerusername='$user' AND ownerjoinid='$joined'";

                 if(mysqli_query($this->con,$q)){
                 	$counter = $counter + 1;
                 }
      		}
      	}catch(Exception $e){
      		return $e->getMessage();
      	}

      	if($size === $counter){
      		return true;
      	}
      }
	}	


  public function commentloader($user)
  {
  	$query ="SELECT * FROM comments WHERE owner='$user'";
  	$run = mysqli_query($this->con,$query);
  	$result = mysqli_fetch_all($run,MYSQLI_ASSOC);
  	return $result;
  }


  public function addingvideos($videos,$servid)
  {
  	$query ="INSERT INTO videos(service,videos) VALUES('$servid','$videos')";
  	try{
  		if(mysqli_query($this->con, $query))
  		{
  			return true;
  		}
  		else
  		{
  			return false;
  		}
  	}catch(Exception $e){
  		return $e->getMessage();
  	}
  }


  public function viewvideos($ser)
  {
  	$q = "SELECT * FROM videos WHERE service='$ser'";
  	return mysqli_fetch_all(mysqli_query($this->con,$q),MYSQLI_ASSOC);
  }


  public function deleteaccount($joinid)
  {

  try{
    $q1 = "SELECT * FROM members WHERE joinid='$joinid'";
    $q2 = "SELECT * FROM offers WHERE ownerjoinid='$joinid'";
   
     
    $run = mysqli_query($this->con,$q1);
    $member = mysqli_fetch_all($run,MYSQLI_ASSOC);


    $run = mysqli_query($this->con,$q2);
    $offer = mysqli_fetch_all($run,MYSQLI_ASSOC);

     
     $profile = null;
     $background = null;
     $offerimages = array();
     $serviceid = array();
     $user = null;




    foreach ($member as $key) {
    	$profile = $key['image'];
    	$user = $key['username'];
    	$background = $key['background'];
    }


    foreach ($offer as $key) {
    	array_push($offerimages, $key['images']);
    	array_push($serviceid, $key['serviceid']);
    }


    $d = "DELETE FROM members WHERE joinid ='$joinid'";
    $d1 = "DELETE FROM offers WHERE ownerjoinid ='$joinid'";
    $d2 = "DELETE FROM links WHERE ownerjoinid ='$joinid'";
    $d3 = "DELETE FROM comments WHERE owner ='$user'";
    //$d4 = "DELETE FROM videos WHERE service ='$serviceid'";

    $query = array($d,$d1,$d2,$d3);
    $size = count($query);
    $counter = 0;

    for ($i=0; $i < $size; $i++) { 
    	if(mysqli_query($this->con, $query[$i]))
    	{
    		$counter = $counter + 1;
    	}
    }


    if($size === $counter)
    {
    	$size = count($offerimages);

    	for ($i=0; $i < $size; $i++) { 
    		  $images = explode('@', $offerimages[$i]);
    		  $s = count($images);

    		  for ($j=0; $j < $s - 1; $j++) { 
    		  	  unlink($images[$j]);
    		  }
    	}



    	$size = count($serviceid);

    	$videosuploaded = array();

    	for ($i=0; $i < $size; $i++) { 
    		$ids = $serviceid[$i];
    		$d = "SELECT * FROM videos WHERE service='$ids'";
    		$run = mysqli_query($this->con, $d);
    		$res = mysqli_fetch_all($run,MYSQLI_ASSOC);
    		array_push($videosuploaded, $res);
    	}
     

     $videosfile = array();

    	foreach ($videosuploaded as $key) {
    		array_push($videosfile, $key['videos']);
    	}


    	$size = count($serviceid);

    	for ($i=0; $i < $size - 1; $i++) { 
    		
    		$id = $serviceid[$i];
    		$d4 = "DELETE FROM videos WHERE service ='$id'";
    		mysqli_query($this->con, $d4);

    	}

    	$size = count($videosfile);

    	for ($i=0; $i < $size; $i++) { 
    		
    		$vdf = explode('@', $videosfile[$i]);

        for ($j=0; $j < count($vdf) - 1; $j++) { 
        	 if(unlink($vdf[$j])){
        	 	continue;
        	 }
        	 
        }
    	}

    	unlink($profile);
    	unlink($background);
      
      $sid = $serviceid[0];
    	$q1 = "SELECT * FROM members WHERE joinid='$joinid'";
      $q2 = "SELECT * FROM offers WHERE ownerjoinid='$joinid'";
      $q3 = "SELECT * FROM videos WHERE service='$sid'";
      $q4 = "SELECT * FROM links WHERE ownerjoinid='$joinid'";
      $q5 = "SELECT * FROM comments WHERE owner='$user'";

      $checklist = array($q1,$q2,$q3,$q4,$q5);

      $finalise = 0;

      for ($i=0; $i < count($checklist); $i++) { 
      	  
      	  $run = mysqli_query($this->con, $checklist[$i]);
      	  $res = mysqli_fetch_all($run,MYSQLI_ASSOC);
      	  if(!empty($res))
      	  {
      	  	continue;
      	  }
      	  else
      	  {
             $finalise = $finalise + 1;
      	  }
      }

      if($finalise === count($checklist))
      {
      	return true;
      }
      else{
      	return false;
      }
    
    }
  }catch(Exception $e){
  	return $e->getMessage();
  }

  }
}




 ?>