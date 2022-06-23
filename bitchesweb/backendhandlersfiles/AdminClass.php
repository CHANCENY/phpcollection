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
}




 ?>