<?php 

 class EncyptorClass
 {
 	private $positionsgenerated = array();
 	private $checkline;
 	private $checkedlist = array();
 	private $randommade = array();
 	private $randomenc = array();
 	private $decodedemail;
 	private $temp;


 	public function __construct(){
 		$this->checkline ="hgfdiurgvcxmvbnbvslaqiwertuygcxmblkjhgfdsafrqdrjlrkwyqjcbnshqjegkertghjkwieuytwgerngihenrtmgoapp[qpwoerityuonmbmdmqwu6937ldgkho08gisxcmvfji1234-9ij,dfgpdfjfuds.0987654321fgh|ioqpweortyhvmnghireoslb mngfdls;aqowiertyuiorpedfppoiuytrewqlgupjmgtwpglf[hgfdsuehgcxs;oieuiosdlfkgj]gfdosieurtiopsaxmcvnbbvcx.67eafghjbvtyuioiut&hgfdsasdfghte*ghdsxvbh@hgsxcvfdsw=fghjfdrtg+fjfdsjdhfopsfg,/dfghjksdfghjkiop;trewqazxcvmnbvcxzbnnfdshjmnbhjol,mngkl;'sdfghjk";
 		array_push($this->randommade,"S");
 		$this->randomenc = array("S","Y","Q","G","A","P","K","U","M","D","X");
 	}

 	public function encyptor($inforecieved)
 	{
       if(!empty($inforecieved))
       {
         $emailsize = strlen($inforecieved);
         $checklinesize = strlen($this->checkline);
         

         // for loop to run finding position

         for ($i=0; $i < $emailsize; $i++) { 
         	
         	$letterin = $inforecieved[$i];

         	for ($j=0; $j < $checklinesize; $j++) { 
         		
         		if($letterin === $this->checkline[$j])
         		{
                  
                  	array_push($this->checkedlist, $letterin);
                  	$rand = rand(1, 10);
                  	$position = $i * pow($j, $rand) + $rand;
                  	$intposition = intval($position);
                  	if($intposition <= $checklinesize && $intposition > 0)
                  	{
                  		array_push($this->randommade,$intposition);
                  	    array_push($this->positionsgenerated, $intposition);
                  	}                  
         		}
         	}
         }

         if(!empty($this->positionsgenerated))
         {
         	
           $returnstring = null;
           foreach ($this->positionsgenerated as $key => $value) {
           	   $returnstring .=$this->checkline[$value];
           }

           foreach ($this->randommade as $key => $value) {
           	$returnstring .=strval($value).',';
           	$this->temp .= strval($value).',';
           }
           
           if($this->savingencyptedinfo($returnstring))
           {
           	 return $returnstring;
           }         	
         }
       }
       else
       {
       	 return "Insert email address first";
       }
 	}

 	public function validate($formattedform)
 	{
 		if(!empty($formattedform))
 		{
 			// decoded the rand value
 			$breakformattedform = explode("S",$formattedform);
 			$randomvalues = end($breakformattedform);
 			$randlist = explode(',',$randomvalues);			
            $sizerand = count($randlist);
                    
           // return $randlist;
            $returnstring = null;
            foreach ($randlist as $key => $value) {
            	$number = intval($value);
            	if($number > 0){
            		$returnstring .= $this->checkline[$number];
            	}           	
            }

            if($returnstring === $breakformattedform[0])
            {
            	return true;
            }
            else
            {
            	return false;
            }
 		}
 	}

 	public function savingencyptedinfo($info)
 	{
 		file_put_contents("encypted_file.txt", $info."\n",FILE_APPEND);
 		return true;
 	}
 
 }

 ?>