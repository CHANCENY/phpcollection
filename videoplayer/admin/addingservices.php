<?php 
 session_start();

 if(isset($_GET['givetotal']))
 {
 	if(!empty($_GET['total']))
 	{
          $total = $_GET['total'];
          $list = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
          $list2 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
          $list3 =  array_merge($list,$list2);
          if(!in_array($total, $list3))
          {
          	$_SESSION['total'] = $total;
                $_SESSION['set'] = true;
                header("Location: addingservices.php");
          }
          else
          {
          	$messages ="please enter number!";
                
          }
          
 	}	
 }

if(isset($_GET['reduce']))
{
  $size = $_SESSION['total'];
  $totalremove = 0;
  $totalremove = intval($_GET['specified']);

  if($size > 1)
  {
    if($totalremove === 0)
    {
       $_SESSION['total'] = $_SESSION['total'] - 1;
       $_SESSION['gohome'] = 'Back to admin panel <a href="adminpanel.php">click here now!</a>';
    }
    else
    {
      $_SESSION['total'] = $_SESSION['total'] - $totalremove;
      $_SESSION['gohome'] = 'Back to admin panel <a href="adminpanel.php">click here now!</a>';
    }

  }
  else
  {
    $_SESSION['gohome'] = 'Back to admin panel <a href="adminpanel.php">click here now!</a>';
    $_SESSION['statusimages'] = "Minimum number of rows reached!";
  }
  
}


 ?>


 <?php if($_SESSION['login'] === true): ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="addadminstyles.css">
	
	<title>add</title>
</head>
<body>
	<?php if( $_SESSION['set'] === false): ?>

	 <section class="addservices-containers">
	 	<div class="formlapp">
	 		  <h2>Set total number of posts to make below</h2>
	 		<form action="addingservices.php" method="get">
	 		<label>Total</label>
	 		<input type="text" name="total" class="inputserv">
	 		<input type="submit" name="givetotal" value="Set total" class="setservicebutton">
	 		<p><?php echo $messages ?? null; ?></p>
	 	</form>
	 	</div>

	 </section>

	<?php else: ?>
     <section class="addservicesformcontainer">
             <h2 class="h2t">Adding services posts</h2>

     		<form action="AdminHandler/addingpostshandler.php" method="post" class="formlapp2" enctype="multipart/form-data"> 
     		 <?php $size = intval($_SESSION['total']); for ($i=0; $i < $size; $i++): ?>            
              <div class="inputlapper">
              	<select class="inputservtwo" name="<?php echo 'category'.strval($i); ?>" required>
              		<option value="">CATEGORY</option>
              		<option value="vip">VIP</option>
              		<option value="premium">PREMIUM</option>
              		<option value="standard">STANDARD</option>
              		<option value="budgect">BUDGET</option>
              		<option>BASIC</option>
              	</select>
              </div>
              <div class="inputlapper">
              	<input type="text" name="<?php echo 'servicename'.strval($i); ?>" class="inputservtwo" placeholder="Post title" required>
              	<input type="text" name="<?php echo 'charges'.strval($i); ?>" class="inputservtwo" placeholder="Offer charges" required>
              	<input type="text" name="<?php echo 'available'.strval($i); ?>" class="inputservtwo" placeholder="Available time (24/7)" required>
              	<input type="text" name="<?php echo 'desc'.strval($i); ?>" class="inputservtwo" placeholder="Post description" required>

              	<input type="file" name="<?php echo 'upload'.strval($i); ?>" required>
              	 </div> 		
     	<?php endfor; ?>
                
     	        <input type="submit" name="submitserv" value="Add posts now!" class="setservicebutton">
               <label><?php echo $_SESSION['statusimages'] ?? null; ?></label><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['okones'] ?? null; ?></label>
     	          
     	</form>
     </section>
     
     <form method="get" style="margin-bottom:10%;">
       <?php if($_SESSION['total'] > 1): ?>
         <input type="number" min="1" max="<?php echo strval($_SESSION['total'] -1); ?>" name="specified" class="inputservtwo" placeholder="0" style="margin-left:30%;margin-top: 10px;">
        <input type="submit" name="reduce" value="Remove post row!" class="setservicebutton" style="margin-left:2%;margin-top: 10px;">
         <?php elseif($_SESSION['total'] === 1): ?>
        <label><?php echo $_SESSION['gohome'] ?? null; ?></label>
      <?php endif; ?>
     </form>
  

<?php endif; ?>
</body>
</html>

<?php else: ?>

  <?php header("Location: ../homepage.php"); ?>


<?php endif; ?>