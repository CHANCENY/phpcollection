<?php 
// this class will be doing all of showing post list


class displayPost
{
  private $con;


  public function __construct()
  {
    $c = null;
    try{
    $c  = new mysqli("localhost","root",null,"webforbitches");
    if($c)
      $this->con = $c;
    else
      die($c);
    }catch(Exception $s){
       die($c);
    }
    
  }

  public function fetchoffers($category)
  {
  	$query = "SELECT * FROM offers WHERE category ='$category'";
  	$run = mysqli_query($this->con,$query);
  	return mysqli_fetch_all($run,MYSQLI_ASSOC);
  }

  public function displayname($joinid)
  {
    $query ="SELECT * FROM members WHERE joinid ='$joinid'";
    $run = mysqli_query($this->con,$query);
    $result = mysqli_fetch_all($run,MYSQLI_ASSOC);

    if(!empty($result))
    {
      $display =null;
      foreach ($result as $key) {
       $display = $key['displayname'];
      }
      return $display;
    }
  }

  public function viewfull($joinid, $serid)
  {
    $query ="SELECT * FROM offers WHERE ownerjoinid='$joinid' AND serviceid='$serid'";
    $run = mysqli_query($this->con,$query);
    $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
    return $result;
  }

  public function links($joinid)
  {
    $query="SELECT * FROM links WHERE ownerjoinid ='$joinid'";
    $run = mysqli_query($this->con, $query);
    $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
    return $result;
  }

  public function collect_all()
  {
    $query = "SELECT * FROM offers LIMIT 10";
    $run = mysqli_query($this->con,$query);
    return mysqli_fetch_all($run,MYSQLI_ASSOC);
  }

  public function commentcollecttoshow($serv)
  {
    $query ="SELECT * FROM comments WHERE service = '$serv'";
    $run = mysqli_query($this->con, $query);
    $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
    return $result;
  }

}


// class handle the complains and comment

class complaintClient
{
  private $con;



  public function __construct()
  {
     $c = null;
    try{
    $c  = new mysqli("localhost","root",null,"webforbitches");
    if($c)
      $this->con = $c;
    else
      die($c);
    }catch(Exception $s){
       die($c);
    }
  }


  public function takecomplaint($client,$esname,$esid,$serid,$com)
  {
    $query ="INSERT INTO complains(clientname,excortdisplayname,excortid,serviceid,complain) VALUES('$client','$esname','$esid','$serid','$com')";
    try{
      if(mysqli_query($this->con,$query))
      {
        return true;
      }
      return false;
    }catch(Exception $e){
      return $e->getMessage();
    }
  }


  public function commentsave($owner,$servid,$comm,$pa)
  {
    $query ="INSERT INTO comments(owner,service,comment,bywho) VALUES('$owner','$servid','$comm','$pa')";

    try{
      if(mysqli_query($this->con, $query))
        {
          return true;
        }
        else{
          return false;
        }
    }catch(Exception $e){
      return $e->getMessage();
    }
  }
}


// class that does the searching

class Search
{
   private $con;


   public function __construct()
   {
     $c = null;
    try{
    $c  = new mysqli("localhost","root",null,"webforbitches");
    if($c)
      $this->con = $c;
    else
      die($c);
    }catch(Exception $s){
       die($c);
    }
   }

   public function search($value)
   {
      $value = $this->analyzer($value);

      $query ="SELECT * FROM offers WHERE title ='$value'";
      $query1 ="SELECT * FROM offers WHERE category ='$value'";
      $query2 ="SELECT * FROM offers WHERE charges ='$value'";
      $query3 ="SELECT * FROM offers WHERE ownerusername ='$value'";
      $query4 ="SELECT * FROM offers WHERE dates ='$value'";
      $query5 ="SELECT * FROM offers WHERE description ='$value'";
      $query6 ="SELECT * FROM offers WHERE subtitles ='$value'";

      $q ="SELECT * FROM members WHERE displayname ='$value'";
      $run = mysqli_query($this->con, $q);
      $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
      $id = null;
      if(!empty($result))
      {
        foreach ($result as $key) {
          $id = $key['joinid'];
        }
      }

      $query7 ="SELECT * FROM offers WHERE ownerjoinid ='$id'";

      $listq = array($query,$query1,$query2,$query3,$query4,$query5,$query6,$query7);
      
      $searchresult =array();
      try{
           for ($i=0; $i < count($listq); $i++) { 
             $run = mysqli_query($this->con,$listq[$i]);
             $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
             if(!empty($result))
             {
               $searchresult = array_merge($searchresult,$result);
             }
           }

           if( !empty($searchresult))
           {
            return $searchresult;
           }
           else
           {
                $res = $this->desparatesearch($value);
                if(!empty($res))
                  return $res;
                else
                {
                  return $this->analyercharges($value);
                }
           }
      }catch(Exception $e){
        
        return $e->getMessage();
      }


   }

   private function analyzer($value)
   {
     if(strtolower($value) === "out")
     {
      $value = "Outcall available";
      return $value; 
     }

      if(strtolower($value) === "in")
     {
      $value ="Incall available";
      return $value; 
     }

      if(strtolower($value) === "both")
     {
      $value ="Both available";
      return $value; 
     }

      if(strtolower($value) === "outcall")
     {
      $value ="Outcall available";
      return $value; 
     }

     if(strtolower($value) === "incall")
     {
      $value ="Incall available";
      return $value; 
     }

     if(strtolower($value) === "both call")
     {
      $value ="Both available";
      return $value; 
     }

     if(strtolower($value) === "out call")
     {
      $value ="Outcall available";
      return $value; 
     }

     if(strtolower($value) === "in call")
     {
      $value ="Incall available";
      return $value; 
     }

     if(strtolower($value) === "both call")
     {
      $value ="Both available";
      return $value; 
     }

     if(strtolower($value) === "out call available")
     {
      $value ="Outcall available";
      return $value; 
     }

     if(strtolower($value) === "in call available")
     {
      $value ="Incall available";
      return $value; 
     }

     if(strtolower($value) === "both call available")
     {
      $value ="Both available";
      return $value; 
     }
     else
      return $value;

   }

   private function desparatesearch($value)
   {
      $list = explode(' ', $value);
      $listtargets = array("title","category","ownerusername","charges","description","subtitles");

      $searchresult = array();

      for ($i=0; $i < count($list); $i++) {

           $look = $list[$i]; 

           for ($j=0; $j < count($listtargets); $j++) { 
                
                $q ="SELECT * FROM offers WHERE $listtargets[$j]='$look'";
                $run = mysqli_query($this->con,$q);
                $res = mysqli_fetch_all($run,MYSQLI_ASSOC);
                if(!empty($res))
                {
                  $searchresult = array_merge($searchresult,$res);
                }
           }
        
      }

      for ($i=0; $i < count($list); $i++) { 
        
        $q ="SELECT * FROM members WHERE displayname ='$list[$i]'";
        $run = mysqli_query($this->con,$q);
        $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
        if(!empty($result))
        {
          $id = null;
          foreach ($result as $key) {
            $id = $key['joinid'];
          }

          $query = "SELECT * FROM offers WHERE ownerjoinid='$id'";
          $r = mysqli_query($this->con,$query);
          $res = mysqli_fetch_all($r,MYSQLI_ASSOC);
          if(!empty($res))
          {
            $searchresult = array_merge($searchresult, $res);
          }
        }

      }

      return $searchresult;
   }

   private function analyercharges($value)
   {
      $list = explode('-', $value);
      $price = $list[0].' - '.end($list);

      $q = "SELECT * FROM offers WHERE charges='$price'";
      $run = mysqli_query($this->con,$q);
      return mysqli_fetch_all($run,MYSQLI_ASSOC);
   }
}







 ?>