<?php 
session_start();
include "../bankendconfig/BankendClasses.php";


 if(isset($_GET['recovery']))
 {

 	if(!empty($_SESSION['deleteduserinfo']) && !empty($_SESSION['deleteservices']) && !empty($_SESSION['deletesocial']))
 	{
 		// recovery proccessing here
         $_SESSION['rmessage'] = "please wait recovering account....";
 		$rec = new RecoveringAccount();
    
 		$returns = $rec->recover($_SESSION['deleteduserinfo'], $_SESSION['deleteservices'], $_SESSION['deletesocial']);
 		if($returns === true)
 		{
 			$_SESSION['recovery'] = false;
      $_SESSION['deleteduserinfo'] = null; 
      $_SESSION['deleteservices'] = null;
      $_SESSION['deletesocial'] = null;
 			$_SESSION['rmessage'] = "Your account recovered successfully";

 		}
 		else
 		{
 			$_SESSION['recovery'] = false;
      $_SESSION['deleteduserinfo'] = null; 
      $_SESSION['deleteservices'] = null;
      $_SESSION['deletesocial'] = null;
      $_SESSION['rmessage'] = "Your account failed to recover redirecting to home page";
 			echo '<META HTTP-EQUIV="Refresh" Content="4; URL=../homepage.php">'; 
 		}
 	}
 	else
 	{
    $_SESSION['recovery'] = false;
    $_SESSION['deleteduserinfo'] = null; 
    $_SESSION['deleteservices'] = null;
    $_SESSION['deletesocial'] = null;
 		$_SESSION['rmessage'] ="Your account can not be recovered! redirecting to home page";
    echo '<META HTTP-EQUIV="Refresh" Content="4; URL=../homepage.php">'; 
 	}
 } 

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" type="text/css" href="recover.css">
 	<title>recovering</title>
 </head>
 <body>
   <section class="recoveringsection">
   	<div class="insidedivrec">
   		<h1>Recovering account.</h1>
   		<p><?php echo $_SESSION['rmessage']; ?></p>

      <?php if($_SESSION['recovery'] === false): ?>

        <a href="../verifyingaccount.php" class="buttonstologin">login page &gt;</a>

      <?php endif; ?>
   		
   	</div>
   	
   </section>
   <section class="recoveringsection">
    <div class="insidedivrec">
      
      <p>Note:all photo atouched to your account won`t be recovered!</p>
      
    </div>
    
   </section>
 </body>
 </html>