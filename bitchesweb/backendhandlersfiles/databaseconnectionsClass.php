<?php 


 // this file contain the class which have function that connect to database

class Connection
{
	private $con;


	public function __construct()
	{
	  try{
		   $ob = new mysqli("localhost","root",null,"webforbitches");
		   if($ob)
		   {
			  $this->con = $ob;
		   }
		   else
		   {
			die($ob);
		   }
		}
		catch(Exception $e)
		{
			$this->con = $e->getMessage();
		}
	}

	public function get_connection()
	{
		return $this->con;
	}
}

 ?>