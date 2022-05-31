<?php
//session_start();
class connection
{

   function connecting()
   {
      $con = new mysqli('localhost','root',null,'websitedatabase');
        if($con)
        {
            return $con;
        }
        else
        {
            die($con);
        }
   }
}



 class registrations
 {
     
     private $conbject;


     public function __construct()
     {
        $ob = new connection();
        $this->conbject =$ob->connecting();
     }


 	public function saving_provider($obj)
 	{
        $join_id = null;

 		if(!empty($obj))
 		{
            for ($i=0; $i < 10; $i++) { 
              $join_id .= strval(rand(10,99));  
            }
         
 			foreach ($obj as $key => $value) 
 			{
 				$username = $obj['username'];
               
 				$fullname =$obj['fullname'];
 				$gender =$obj['gender'];
 				$birthday=$obj['birthday'];
 				$email =$obj['email'];
 				$phone=$obj['phone'];
 				$joined=$obj['join'];
 				$profile =$obj['profile'];
 				$race =$obj['race'];
 				$address =$obj['town'].' '.$obj['city'].' '.$obj['state'].' '.$obj['country'];
 				$descp =$obj['description'];
 				$password =$obj['password'];

 				// writing query to database

                $query ="INSERT INTO users(username,fullname,gender,birthday,email,phone,joined,profile,race,address,description,password,join_id) VALUES('$username','$fullname','$gender','$birthday','$email','$phone','$joined','$profile','$race','$address','$descp','$password','$join_id')";

                if(mysqli_query($this->conbject,$query))
                {
                    $qu = "INSERT INTO socialmedia(owner,fullname) VALUES('$join_id','$fullname')";
                    if(mysqli_query($this->conbject, $qu))
                    {
                       return true; 
                    }
                    
                }
 			}

            return false;
 		}
 	}
 }

 class LoggingUser
 {
    private $conbject;

    public function __construct()
    {
       $obj2 = new connection();
       $this->conbject = $obj2->connecting();
    }

    public function Validating_user($username, $password)
    {
        $query = "SELECT * FROM users WHERE username='$username'";
        $run = mysqli_query($this->conbject,$query);
        $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
         
         $dbpass = null;
        foreach ($result as $key) {
          $dbpass = $key['password'];   
        }

        if(md5($password) === $dbpass)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
 }



 class Addposts
 {
    private $conbject;

    public function __construct()
    {
       $obj2 = new connection();
       $this->conbject = $obj2->connecting(); 
    }

    public function addingservices($total, $obj3)
    {
        $owner_id = null;
         foreach ($_SESSION['userin'] as $key) {
           $owner_id = $key['join_id'];
       }

        
        $counter = 0;
       
        for ($i=0; $i < $total; $i++) { 
            $category = $obj3['category'.strval($i)];
            $title = $obj3['title'.strval($i)];
            $charges = $obj3['charges'.strval($i)];
            $available = $obj3['available'.strval($i)];
            $descs = $obj3['descs'.strval($i)];
            $image = $obj3['upload'.strval($i)];
            $serviceid = $this->servieidgenetor();
            $query = "INSERT INTO services(owner,title,category,charges,available,description,image,serviceid) VALUES('$owner_id','$title','$category','$charges','$available','$descs','$image','$serviceid')";
            
            if(mysqli_query($this->conbject,$query))
            {
               $counter++; 
            }
        }

        if($total === $counter)
        {
            return true;
        }

    }

    public function servieidgenetor()
    {
      $serviceid = null;

       for ($i=0; $i < 10; $i++) { 
           $serviceid .= strval(rand(10,99));
       }

       return $serviceid;
    }
 }



 class EditingProfile
 {
    private $conbject;

    public function __construct()
    {
        $obj8 = new connection();
        $this->conbject = $obj8->connecting();
    }

    public function DynamicEditingprofile($type,$newinfo)
    {
              $id = null;
       
     if(!empty($_SESSION['userin']))
     {         
        foreach ($_SESSION['userin'] as $key) {
            $id = $key['ID'];
        }        
       if(!empty($id))
        {
            $query = "UPDATE `users` SET `$type` = '$newinfo' WHERE `users`.`ID` = $id;";
            
           if(mysqli_query($this->conbject, $query))
            {
                return true;
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
 }



class ServicesRetriverUserOnly
{
    private $conbject;


    public function __construct()
    {
        $obj9 = new connection();
        $this->conbject = $obj9->connecting(); 
    }

    public function retrive_info_post()
    {
        $id = null;
    
        foreach ($_SESSION['userin'] as $key) {
            $id = $key['join_id'];
        }
       
        if(!empty($id))
        {
           
            $query = "SELECT * FROM services WHERE owner = '$id'";
            $run = mysqli_query($this->conbject, $query);
            $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
            return $result;
        }
        else
        {
            return null;
        }

    }
}



class serviceViewChange
{
    private $conbject;

    public function __construct()
    {
        $obj10 = new connection();
        $this->conbject = $obj10->connecting(); 
    }

    public function commitChange($type, $value, $posid)
    {

        if(!empty($type) && !empty($value))
        {
            $id = intval($posid);
            $querys = "UPDATE `services` SET `$type` = '$value' WHERE `services`.`ID` =$id;";
            if(mysqli_query($this->conbject, $querys))
            {
              
                return true;
            }
            else
            {
              
                return false;
            }
        }
    }

    public function postSelectedview($id)
    {
        if(!empty($id))
        {
            $query = "SELECT * FROM services WHERE `services`.`ID`=$id";
            $run = mysqli_query($this->conbject,$query);
            $res = mysqli_fetch_all($run,   MYSQLI_ASSOC);
            return $res;
        }
    }
}



class PostRendering
{
    private $conbject;

    public function __construct()
    {
        $obj11 = new connection();
        $this->conbject = $obj11->connecting();  
    }

    public function renderingAPI()
    {
        $query0 = "SELECT * FROM services WHERE category='VIP' ORDER BY ID ASC";
        $query1 = "SELECT * FROM services WHERE category='PREMIUM' ORDER BY ID ASC";
        $query2 = "SELECT * FROM services ORDER BY ID DESC";
        $query3 = "SELECT * FROM services ORDER BY ID ASC";

        $querylist = array($query0,$query1,$query2,$query3);
        $size = count($querylist);

        $result = $samp = array('sample' =>'sample');

        for ($i=0; $i < $size; $i++)
        { 
           $run = mysqli_query($this->conbject, $querylist[$i]);
           if($run)
           {
            $result = array_merge($result,mysqli_fetch_all($run,MYSQLI_ASSOC));
           }
        }

        $result = array_reverse($result);
        array_pop($result);
        return array_reverse($result);

    }
}

class searchResults
{
   private $conbject;

   public function __construct()
   {
      $obj13 = new connection();
      $this->conbject = $obj13->connecting();
   }


   public function randomSearch($looking)
   {
    $listarray = $n = array('sample' =>'sample');
    array_pop($listarray);
    $listcolumns = array('title','category','available','description','posted','charges');
     if(!empty($looking))
     {
        $counter = 0; 
        $sucessfully = 0;
         $perivous = $n1 = array('sample' => 'sample');
         array_pop($perivous);
        $size = count($listcolumns);
        for($i = 0; $i < $size; $i++)
        {

            $query0 ="SELECT * FROM services WHERE $listcolumns[$i] ='$looking'";
            $run = mysqli_query($this->conbject, $query0);
            $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
            if(!empty($result))
            {
              if(count($perivous) < count($result))
              {
                $listarray = array_reverse($listarray);
                $listarray = array_merge($listarray,$result);
                $perivous = $result;
              }
              elseif(count($perivous) === count($perivous))
              {
                $listarray = array_merge($listarray,$result);
                $perivous = $result;
              }
              elseif(count($perivous) > count($result))
              {
                   $listarray = array_reverse($listarray);
                   $listarray = array_merge($listarray,$result);
                   $perivous = $result;
              }
              elseif(count($result) === 0)
              {
                continue;
              }
            }
        }

        return $listarray;
     }
   }

   public function specificSearch($cate,$charge,$title,$av)
   {
     $query ="SELECT * FROM services WHERE category='$cate' AND charges='$charge' AND title='$title' AND available='$av'";
     $run = mysqli_query($this->conbject,$query);
     $res = mysqli_fetch_all($run,MYSQLI_ASSOC);
     return $res;
   }
}


class collectedviewpost
{
    private $conbject;

    public function __construct()
    {
         $obj13 = new connection();
         $this->conbject = $obj13->connecting();
    }

    public function reviewPostFull($id,$owner)
    {
          $IDs = intval($id);
          $query1 = "SELECT * FROM services WHERE ID= $IDs";
          
          $run = mysqli_query($this->conbject,$query1);
           $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
          
          return $result;

         //var_dump($result);
    }

    public function getprofileinfo($owner)
    {
        $query = "SELECT * FROM socialmedia WHERE owner ='$owner'";
        $run = mysqli_query($this->conbject,$query);
        $res = mysqli_fetch_all($run,MYSQLI_ASSOC);
        return $res;
    }
}


class SocialMediaLinks
{
    private $conbject;

    public function __construct()
    {
       $obj13 = new connection();
       $this->conbject = $obj13->connecting(); 
    }

    public function addLink($link,$type,$owner)
    {
        $query = "SELECT * FROM socialmedia WHERE owner='$owner'";
        $run = mysqli_query($this->conbject, $query);
        $res = mysqli_fetch_all($run,MYSQLI_ASSOC);

        if(!empty($res))
        {
           $query1 = "UPDATE socialmedia SET $type = '$link' WHERE owner ='$owner'";
           $runs = mysqli_query($this->conbject, $query1);
           if($run)
           {
            return true;
           }
        }
        else
        {
           $query2 = "INSERT INTO socialmedia($type) VALUES('$link')";
           if(mysqli_query($this->conbject, $query2))
           {
            return true;
           }
        }

        return false;
    }


}


class TroubledPassword
{
    private $conbject;


    public function __construct()
    {
        $c = new connection();
        $this->conbject= $c->connecting();
    }

    public function verifyattempt($username,$email)
    {
        $q = "SELECT ID FROM users WHERE email ='$email'";
        $run = mysqli_query($this->conbject, $q);
        $ID1 = mysqli_fetch_all($run, MYSQLI_ASSOC);
        if(!empty($ID1))
        {
            $q2 = "SELECT ID FROM users WHERE username = '$username'";
            $run2 = mysqli_query($this->conbject, $q2);
            $ID2 = mysqli_fetch_all($run2,MYSQLI_ASSOC);
            if(!empty($ID2))
            {
               if($ID1 === $ID2)
               {
                  return true;
               }
               else
               {
                 return "Failed to verify you username and email";
               }
            }
            else
            {
                return "Username name does not exist!";
            }
        }
        else
        {
            return "Email does not exist!";
        }
    }

    public function changecommit($email, $user, $new)
    {
        $qu = "UPDATE users SET password = '$new' WHERE email ='$email' AND username = '$user'";
        if(mysqli_query($this->conbject, $qu))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

class deletingAccount
{
    private $conbject;

    public function __construct()
    {
        $ob = new connection();
        $this->conbject = $ob->connecting();
    }

    public function deleteaccount($account)
    {
      $query = "DELETE FROM users WHERE join_id='$account'";
      $query1 = "DELETE FROM services WHERE owner='$account'";
      $query2 = "DELETE FROM socialmedia WHERE owner='$account'";

      // creating backup first data of delete account
      if($this->recoverydata($account) === true)
       {
             $listofcommad = array($query, $query1, $query2);

              // clear up all info related to account to delete
            $counter = 0;
            $size = count($listofcommad);
           for ($i = 0; $i < $size; $i++) { 
                 if(mysqli_query($this->conbject, $listofcommad[$i]))
                   {
                      $counter = $counter + 1;
                   }
                   else
                   {
                       continue;
                   }
            }
            if($counter === $size)
            {
                $_SESSION['recovery'] = true;
                return true;
            }
            else
            {
                return "Deleting account failed!";
            }
       }
       else
       {
           return false;
       }
    }

    public function recoverydata($account)
    {
        // backup incase of failure

      $userinfo = $n = array('sample' =>'sample');
      $services = $n = array('sample' =>'sample');
      $social = $n = array('sample' =>'sample');

      $q = "SELECT * FROM users WHERE join_id='$account'";
      $q1 = "SELECT * FROM services WHERE owner='$account'";
      $q2 = "SELECT * FROM socialmedia WHERE owner='$account'";

      $mixcomad = array($q, $q1, $q2);
      $size = count($mixcomad);
      $count = 0;

      for ($i=0; $i < $size; $i++) { 
          $run = mysqli_query($this->conbject, $mixcomad[$i]);
          if($i === 0)
          {
            $userinfo = array_merge(mysqli_fetch_all($run,MYSQLI_ASSOC));
            $count = $count + 1;
          }
          elseif($i === 1)
          {
            $services = array_merge (mysqli_fetch_all($run,MYSQLI_ASSOC));
            $count = $count + 1;
          }
          elseif($i === 2)
          {
            $social =array_merge(mysqli_fetch_all($run,MYSQLI_ASSOC));
            $count = $count + 1;
          }
          else
          {
            $count = $count + 1;
            continue;
          }
      }
      
        $_SESSION['deleteduserinfo'] = $userinfo;
        
        $_SESSION['deleteservices'] = $services;
       
        $_SESSION['deletesocial'] = $social;

        return true;
    

    }


    public function deleteaccountanyway($user)
    {
         $query = "DELETE FROM users WHERE join_id='$account'";
         $query1 = "DELETE FROM services WHERE owner='$account'";
         $query2 = "DELETE FROM socialmedia WHERE owner='$account'";

          $listofcommad = array($query, $query1, $query2);

         // clear up all info related to account to delete
         $counter = 0;
         $size = count($listofcommad);

         for ($i=0; $i < $size; $i++) { 
             if(mysqli_query($this->conbject, $listofcommad[$i]))
             {
                $counter = $counter + 1;
             }
         }

         if($counter === $size)
         {
            return true;
         }
         else
         {
            return false;
         }


    }
}



class MoreImages
{
    private $conbject;

    public function __construct()
    {
        $co = new connection();
        $this->conbject = $co->connecting();
    }

    public function retrivemore($id)
    {
        
        $query ="SELECT * FROM photostorage WHERE serviceid ='$id'";
       
        $run = mysqli_query($this->conbject, $query);
         $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
         
         return $result;
    }

    public function savingmorephoto($servid, $image)
    {
        $query ="INSERT INTO photostorage(serviceid,photos) VALUES('$servid','$image')";
        if(mysqli_query($this->conbject,$query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}


class RecoveringAccount
{
    private $conbject;

    public function __construct()
    {
        $obj = new connection();
        $this->conbject = $obj->connecting();
    }

    public function users_recovering($object)
    {
        $query = null;

        if(!empty($object))
        {

        foreach($object as $key)
        {
            $username = $key['username'];
         $fullname =$key['fullname'];
         $gender = $key['gender'];
         $birthday =$key['birthday'];
         $email =$key['email'];
         $phone = $key['phone'];
            
          $race = $key['race'];
          $pro = $key['profile'];
          $address = $key['address'];
          $descs = $key['description'];
          $pass = $key['password'];
          $join_id = $key['join_id'];

            $Dateobject = new DateTime();
          $today = $Dateobject->format("d-m-Y");

          $query1 ="INSERT INTO users(username,fullname,gender,birthday,email,phone,joined,race,address,description,password,join_id) VALUES('$username','$fullname','$gender','$birthday','$email','$phone','$today','$race','$address','$descs','$pass','$join_id')";
            
          if(mysqli_query($this->conbject, $query1))
          {
            return true;
          }
          else
          {
            return false;
          }
        }
      }
      else
      {
        return true;
      }
    }

    public function services_recovering($obj)
    {
        $counter = 0;
        $size  = count($obj);

        if(!empty($obj))
        {

        foreach($obj as $key)
        {
            $owner =$key['owner'];
            $title = $key['title'];
            $cate = $key['category'];
            $char =$key['charges'];
            $avail = $key['available'];
            $dess = $key['description'];
            $serviceid = $key['serviceid'];
            $query = "INSERT INTO services(owner,title,category,charges,available,description,serviceid) VALUES('$owner','$title','$cate','$char','$avail','$dess','$serviceid')";

                if(mysqli_query($this->conbject,$query))
                {
                  $counter = $counter + 1;
                }
        }
         
         if($size === $counter)
         {
            return true;
         }
         else
         {
            return false;
         }
     }
     else
     {
        return true;
     }

    }

    public function social_recovering($obj)
    {
        if(!empty($obj))
        {
            $count = 0;
            $size = count($obj);

          foreach($obj as $key)
          {
            $face = $key['facebook'];
            $insta = $key['instagram'];
            $email =$key['email'];
            $what = $key['whatsapp'];
            $phone =$key['phone'];
            $owner = $key['owner'];
            $fullname = $key['fullname'];
            $query ="INSERT INTO socialmedia(facebook,instagram,email,whatsapp,phone,owner,fullname) VALUES('$face','$insta','$email','$what','$phone','$owner','$fullname')";

            if(mysqli_query($this->conbject, $query))
            {
               $count = $count + 1;
            }
          }

          if($size === $count)
          {
            return true;
          }
        }
        else
        {
            return true;
        }
    }

    public function recover($userobj, $servobj, $socialobj)
    {
        if($this->users_recovering($userobj))
        {
            if($this->services_recovering($servobj))
            {
                if($this->social_recovering($socialobj))
                {
                    return true;
                }
            }
        }
    }
}


 ?>













