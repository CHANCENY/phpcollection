<?php 	
include "databaseconnectionsClass.php";
include "enctyptor/Securing.php";


 //the class that does the registration of member

class UserValidatorClass{
   
   private $con;
   private $userfound;
   private $username = array();
   private $fullname;
   private $comment;
   private $encty;


   public function __construct()
   {
   	    $co = new Connection();
   	    $this->encty = new SecurePassword();
   	    $this->con = $co->get_connection();
   	    
   }

   public function register($display,$fullname,$email,$phone,$password,$imagepath)
   {

   	$list = explode(' ', $fullname);

      //clear all values

      /*$display = $mysqli->real_escape_string($display);
      $fullname = $mysqli->real_escape_string($fullname);
      $email = $mysqli->real_escape_string($email);
      $password = $mysqlireal->_escape_string($password);
      $imagepath = $mysqli->real_escape_string($imagepath);*/

      // generate username and check if exist in database and token


      here:
      $username = $this->generateusername($list[0]);
       if($this->checkingusername($username))
       {
         goto here;
       }

      // check if email already exist
       if($this->checkingemail($email))
       {
         return "Email already exist";
       }


       //getting token for verification

       $token = $this->generatetoken();



      $Join_id = $this->generatejoinid($fullname[0]);
      $password = $this->encty->savingpassword_encripted_format($password);
      $fullname = $list[0]." ".end($list);
       

      //checking if username and Join id made

      if(!empty($username) && !empty($Join_id))
      {

        // creating insertion query
      	$query ="INSERT INTO members(displayname,fullname,email,phone,password,username,joinid,image,vKey,verified) VALUES('$display','$fullname','$email','$phone','$password','$username','$Join_id','$imagepath','$token',false)";
      	//$query1 ="INSERT INTO posts(owner,joinid) VALUES('$username','$Join_id')";
      	//$query2 ="INSERT INTO image_post(owner,joinid) VALUES('$username','$Join_id')"
        

        // list of query of insertion
      	$lisfofquery = array($query);

      	// counter to check how many query made
      	$counter = null;

      	try{
           
           // running insertion in recurvice mode
           for ($i=0; $i < count($lisfofquery); $i++) { 
             	
             	if(mysqli_query($this->con,$lisfofquery[$i]))
             	{
                  $counter++;
             	}
             }
            

            // check if counter is 3 then return true else false
             if($counter === 1)
             {
               
             $this->username = $n = array('email' =>$email ,'name'=>$username,'token'=>$token );
             	return true;
             }
             else{
             	return "Technical error occurred!";
             }  
      	}
      	catch(Exception $e){
      		return "Technical error found";
      	}

      }
   } 

   private function generatejoinid($intial)
   {
   	 $id = $intial."-";

   	 for ($i=0; $i < 8; $i++) { 
   	 	$id .= strval(rand());
   	 }

   	 return md5($id);
   }

   private function generateusername($intial)
   {
   	 $id = $intial."-";

   	 $id .= strval(rand());

   	 return $id;
   }

   public function get_username()
   {
      return $this->username;
   }

   private function checkingemail($email)
   {
      $query = "SELECT email FROM members WHERE email='$email'";
      $run = mysqli_query($this->con, $query);
      $res = mysqli_fetch_all($run,MYSQLI_ASSOC);
      if(!empty($res))
      {
         return true;
      }
   }
   private function checkingusername($username)
   {
      $query = "SELECT username FROM members WHERE username='$username'";
      $run = mysqli_query($this->con, $query);
      $res = mysqli_fetch_all($run,MYSQLI_ASSOC);
      if(!empty($res))
      {
         return true;
      }
   }

   private function generatetoken()
   {
      $token = null;
      for ($i=0; $i < 5; $i++) { 
        $token .= strval(rand()); 
      }
      return md5($token);
   }

   public function verificationmemberaccount($email,$password,$tok,$user)
   {

      $result =$this->encty->validate_password($password,$user,null,$this->con,'members');
      if($result === true)
      {
         $query ="SELECT * FROM members WHERE email='$email' AND vKey='$tok'";
         $run = mysqli_query($this->con,$query);
         $res = mysqli_fetch_all($run,MYSQLI_ASSOC);
         if(!empty($res))
         {
            $query = "UPDATE members SET verified=true WHERE username ='$user' AND email='$email'";
            if(mysqli_query($this->con,$query))
            {
               return true;
            }
            else
            {
               return "Sorry failed to verify your account";
            }
         }
      }
      else{
         return "Wrong password!";
      }
      
   }
}

// the below class does the login of member


class loginUser
{
   private $userfound;
   private $username;
   private $password;
   private $cons;
   private $sp;



   public function login($username,$password)
   {
      $this->username = $username;
      $this->password = $password;

      // create object of connection and securingpassword classes
      $co = new Connection();
      $this->sp = new SecurePassword();
      $this->cons = $co->get_connection();    

      if(boolval($this->isvalidaccount($this->username)) === true)
      {
         return $this->validateUser();    
      }
      else
      {
         return "Account is unverified!";
      }
   }

   private function validateUser()
   {
      // check password valid

      $result = $this->sp->validate_password($this->password,$this->username,null,$this->cons,'members');
      if($result === true)
      {
         $user = $this->sp->get_user_all_info();
         $findpass = null;
         foreach ($user as $key) 
         {
            $findpass = $key['password'];
         }



         $query = "SELECT * FROM members WHERE username='$this->username'";
         $run = mysqli_query($this->cons,$query);
         $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
         if(!empty($result))
         {
            $pass  = null;
            foreach ($result as $key) 
            {
               $pass = $key['password'];
            }

            if($findpass === $pass)
            {
               
               $this->userfound = $result;
               return true;
            }
            else
            {
               return "password does not exist";
            }
         }
         else
         {
            return "Valid username!";
         }
      }
      else
      {
         return "Valid password!";
      }

   }

   public function memberlogged()
   {
      return $this->userfound;
   }

   private function isvalidaccount($username)
   {
      $query = "SELECT * FROM members WHERE username='$username'";
      $run = mysqli_query($this->cons,$query);
      $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
      if(!empty($result))
      {
         $verified = false;
         foreach ($result as $key) {
            $verified = $key['verified'];
         }

         return $verified;
      }
   }
}


// forgot password

class forgotPassword 
{
   private $con;
   private $enc;
   private $email;
   private $username;
   private $newpassword;
   private $status;
  
   
   
  public function __construct($email,$username,$newpassword)
   {
      $this->email = $email;
      $this->username = $username;
      $this->newpassword = $newpassword;

      $co = new Connection();
      $this->enc = new SecurePassword();
      $this->con = $co->get_connection();

       $this->change();
   }

   private function change()
   {
      $this->newpassword = $this->enc->savingpassword_encripted_format($this->newpassword);
      $query ="UPDATE members SET password='$this->newpassword' WHERE username='$this->username' AND email='$this->email'";


      try{

         if(mysqli_query($this->con,$query))
         {
            $this->status = true;
         }
         else{
            $this->status = false;
         }

      }catch(Exception $e){
        $this->status = $e->getMessage();
      }
   }

   public function getstatus()
   {
      return $this->status;
   }

}
 ?>