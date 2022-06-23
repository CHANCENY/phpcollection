<?php 

 class SecurePassword
 {
 	private $password;
 	private $checkline;
 	private $positionsmade = array();
 	private $checkdivisor;
 	private $tomatch;
 	private $positionnewmatch = array();
 	private $founduser;
    private $userall;


 	public function __construct()
 	{
 		 $this->checkline ="gbmsbnbngqjeytuwhwUWEYEWYQAXCBGIcmbndgwfqjfmbmbshgspkjhgfdsdghkiesxSDFGKLWERTHGFKBVAQKLQWPERTYIHGOXCVMBNVCMXKAcvbnxzqrtgvdpoiuqwehjkljejvckdUVYSVWERBNGMKtygfdoeygfjdksowyuhgbnmxghvjcksirtydhrewiskxcmvMCNVBHQWJERBFDSTAQWEKRTNHGDJSASDGnredcvnhedkvmnhturidcvbmhjytirdkvbnhjtirodlcvmbhjtriskuethdjsiwtygfjditugjfdkoetugkfldeouthgjkdlituyhgjfkdlerituygjyqopaxcvmngbfdcmvnbghtqazxclfiuQWERJTKYHSBBNNVCXBWYERUTIYUOIKOKBETAZAKMGVCXZQOWEIRUFHDSJEYRTAWOLTYUMHMCKIVAWURTUPAZXMVCXXHHEAOLXCVGJHJTRIErtyukgfpoueikjhgfdjkhlgdtyjknvcdrtyhgWUYGOQIUWEYEWYQAXCBGISLXVBJKOPSXCoirugnvnsgqgqiotjbnsgqwwkvnbxcagwotirytqgglggjddVLBMNVHS";

 		 $this->checkdivisor = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!£%^&*~#.,';:|/-+{}[])(^=¬`";
 	}

 	public function savingpassword_encripted_format($passwordpassed)
 	{
 		if(!empty($passwordpassed))
 		{
 			// getting length
            $sizepasswordpassed = strlen($passwordpassed);
             // generate random divisor
            $divisor = rand(2,89);
            // collection position list

            for ($i= -5; $i < $sizepasswordpassed; $i++) { 
            	
            	for ($j=0; $j < $sizepasswordpassed; $j++) { 
            		
            		$y = $i * pow($sizepasswordpassed,$j) + $divisor;
            		$x = $sizepasswordpassed / $divisor;
            		$y = $y + $x;

            		// convert answer to int

            		$positionfound = intval($y);

            		// check if position is less than checkline

            		if($positionfound > 0 && $positionfound < strlen($this->checkline))
            		{
            			array_push($this->positionsmade, $positionfound);
            		}
            	}
            }

            // encpt the password using positions found
            if(!empty($this->positionsmade))
            {
            	
            	foreach ($this->positionsmade as $key => $value) {
            		
            		$this->password .= $this->checkline[$value];
            	}
                 $this->password .= $this->checkdivisor[$divisor];
            	// return encyripted password.

            	$writeinfo = $this->password;
            	$this->writerecord($writeinfo);
            	if(!empty($this->password) && strlen($this->password > 1))
            	{
            		return $this->password;
            	}
            	else
            	{
            		return false;
            	}
            }
 		}
 		else
 		{
 			return "Password in valid!";
 		}
 	}

 	public function writerecord($password)
 	{
 		if(!empty($password))
 		{
 			file_put_contents("record.txt", $password."\n");
 		}
 	}

 	public function validate_password($password=null,$user=null,$fromDBpassword=null,$DBconnection=null,$tablename=null)
 	{
 		if(!empty($password))
 		{
 			$filepassword = null;
            $keeppassword = null;
            
 			// first collect saved password from database (file is demo)
 			// this is optional in real world project variable $fromDBpassword
 			// will bring password from db which is in encripted format
 			// then copy $formDBpassword value to filepassword

 			/*---------THIS----------
 			if(file_exists('record.txt'))
 			{
              $filepassword = file_get_contents("record.txt");
              $keeppassword = null;
 			}
 			----------OPTIONAL-------
 			*/

 			if(!empty($DBconnection) && !empty($tablename))
 			{
              $query = "SELECT * FROM $tablename WHERE username='$user'";
              $run = mysqli_query($DBconnection, $query);
              $result = mysqli_fetch_all($run,MYSQLI_ASSOC);
              if(!empty($result))
              {
              	foreach ($result as $key) {
              		$filepassword =$key['password'];
              		$this->founduser = $key['firstname']." ".$key['lastname'];
              	}
              	
                $this->userall = $result;

              }

 			}
            
            // checking if info password straight for check db not required
            if(!empty($fromDBpassword))
            {
                $filepassword = $fromDBpassword;
            }
            
 			

 			/*if(file_exists('record.txt'))
 			{
              $filepassword = file_get_contents("record.txt");
              $keeppassword = null;
 			}*/

            // check if successfully collected
            if(!empty($filepassword))
            {
            	// grab last letter
            	$lastletter = null;
               for ($i=0; $i < strlen($filepassword); $i++) { 
               	$lastletter = $filepassword[$i];
               	$keeppassword .= $filepassword[$i];
               }
               
               // finding divisor value was used
               $divisor = $this->finddivisor($lastletter);
               
               //getting position passed password to generate encripted password
               $sizepasswordpassed = strlen($password);
               for ($i= -5; $i < $sizepasswordpassed; $i++){
               	   for ($j=0; $j < $sizepasswordpassed; $j++){

               	   	$y = $i * pow($sizepasswordpassed,$j) + $divisor;
            		$x = $sizepasswordpassed / $divisor;
            		$y = $y + $x;

            		// convert answer to int
            		$positionfound = intval($y);

            		// check if position is less than checkline
            		if($positionfound > 0 && $positionfound < strlen($this->checkline))
            		{
            			array_push($this->positionnewmatch, $positionfound);
            		}
               	   }
               }
               // checking if position have been collected

               if(!empty($this->positionnewmatch))
               {
               	// getting encripted password
               	foreach ($this->positionnewmatch as $key => $value) {
            		
            		$this->tomatch .= $this->checkline[$value];
            	}
            	// include last letter of divisor
                $this->tomatch .= $this->checkdivisor[$divisor];
            	
            	// check if encription has happen
            	if(!empty($this->tomatch))
            	{
            		// matching passed password and old password in database
            		if($keeppassword === $this->tomatch)
            		{
            			return true;
            		}
            		else
            		{
            			return false;
            		}
            	}
               }
               
            }


 		}
 		else
 		{
 			return "enter valid password";
 		}
 	}

 	public function finddivisor($letter)
 	{
 		if(!empty($letter))
 		{
 			for ($i=0; $i < $this->checkdivisor; $i++) { 
 				if($letter === $this->checkdivisor[$i])
 				{
 					return $i;
 				}
 			}
 		}
 	}

 	public function getuser()
 	{
 		return $this->founduser;
 	}

    public function get_user_all_info()
    {
        return $this->userall;
    }

 }

 ?>