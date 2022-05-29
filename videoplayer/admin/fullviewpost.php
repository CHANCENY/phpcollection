<?php 
 session_start();
 include "AdminHandler/ViewHandler.php";

 if(isset($_GET['chosen']))
 {
 	$_SESSION['chosenid'] = $_GET['service'];
 	$intid = intval($_SESSION['chosenid']);
 	$_SESSION['post'] = showingselectedpost($intid);

 }

 if(isset($_POST['titlechange']))
 {
 	echo "part0";
 	if($_SESSION['position'] === 0)
 	{
 		$_SESSION['position'] = $_SESSION['position'] + 1;

 	}
 	else
 	{
 		$newTitle = $_POST['title'];
 		$pos = $_POST['change'];
 		$_SESSION['position'] = $_SESSION['position'] - 1;
 		if(!empty($newTitle))
 		{
             $_SESSION['titlemessage'] = recieverchange('title',$newTitle,$pos);
             header("Location: ../admin/fullviewpost.php");
 		}
 		else
 		{
 			$_SESSION['titlemessage'] = "Input new title first!";
 			header("Location: ../admin/fullviewpost.php");
 		}
 		
 	}
 	
}

if(isset($_POST['categorychange']))
{
	echo "part1";
	$settigup = "changeone";
 	if($_SESSION['position1'] === 0)
 	{
 		$_SESSION['position1'] = $_SESSION['position1'] + 1;

 	}
 	else
 	{
 		$newCate = $_POST['category'];
 		$pos = $_POST['change'];
 		$_SESSION['position1'] = $_SESSION['position1'] - 1;
 		if(!empty($newCate))
 		{
             $_SESSION['cateemessage'] = recieverchange('category',$newCate,$pos);
             header("Location: ../admin/fullviewpost.php");
 		}
 		else
 		{
 			$_SESSION['cateemessage'] = "Input new title first!";
 			header("Location: ../admin/fullviewpost.php");
 		}
 		
 	}
}

if(isset($_POST['chargeschange']))
{
	echo "part2";
 	if($_SESSION['position2'] === 0)
 	{
 		$_SESSION['position2'] = $_SESSION['position2'] + 1;

 	}
 	else
 	{
 		$newchar = $_POST['charges'];
 		$pos = $_POST['change'];
 		$_SESSION['position2'] = $_SESSION['position2'] - 1;
 		if(!empty($newchar))
 		{
             $_SESSION['charemessage'] = recieverchange('charges',$newchar,$pos);
             header("Location: ../admin/fullviewpost.php");
 		}
 		else
 		{
 			$_SESSION['charemessage'] = "Input new title first!";
 			header("Location: ../admin/fullviewpost.php");
 		}
 		
 	}
}


if(isset($_POST['descchange']))
{
	echo "part2";
 	if($_SESSION['position3'] === 0)
 	{
 		$_SESSION['position3'] = $_SESSION['position3'] + 1;

 	}
 	else
 	{
 		$newdes = $_POST['descinput'];
 		$pos = $_POST['change'];
 		$_SESSION['position3'] = $_SESSION['position3'] - 1;
 		if(!empty($newdes))
 		{
             $_SESSION['descemessage'] = recieverchange('description',$newdes,$pos);
             header("Location: ../admin/fullviewpost.php");
 		}
 		else
 		{
 			$_SESSION['descemessage'] = "Input new title first!";
 			header("Location: ../admin/fullviewpost.php");
 		}
 		
 	}
}



if(isset($_POST['availablechange']))
{
	echo "part2";
 	if($_SESSION['position4'] === 0)
 	{
 		$_SESSION['position4'] = $_SESSION['position4'] + 1;

 	}
 	else
 	{
 		$newaval = $_POST['available'];
 		$pos = $_POST['change'];
 		$_SESSION['position4'] = $_SESSION['position4'] - 1;
 		if(!empty($newaval))
 		{
             $_SESSION['avemessage'] = recieverchange('available',$newaval,$pos);
             header("Location: ../admin/fullviewpost.php");
 		}
 		else
 		{
 			$_SESSION['avemessage'] = "Input new title first!";
 			header("Location: ../admin/fullviewpost.php");
 		}
 		
 	}
}


if(isset($_POST['photochange']))
{
    if(!empty($_FILES['uploadimage']['name']))
    {
        $file = $_FILES['uploadimage'];
        $name =$file['name'];
        $nameandext = explode('.', $name);
        $ext = strtolower(end($nameandext));
        $list = array('jpg','jpeg','png','svg','webp');
        if(in_array($ext, $list))
        {
            $size = $file['size'];
            if($size < 300000)
            {
                $image = addslashes(file_get_contents($file['tmp_name']));
              
                $pos = $_POST['photoid'];
                $_SESSION['position4'] = $_SESSION['position4'] - 1;
                if(!empty($image))
                {
                     $_SESSION['avemessage'] = recieverchange('image',$image,$pos);
                     header("Location: ../admin/fullviewpost.php");
                }
                else
                {
                        
                        header("Location: ../admin/fullviewpost.php");
                }

            }
        }
    }
}

 ?>


<?php if($_SESSION['login'] === true): ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="viewstyles.css">
	<title></title>
</head>
<body>
     <section class="viewcontainer">
     	<div class="outsidediv">
            <?php foreach($_SESSION['post'] as $key): ?>
     			<img src="<?php echo 'data:image;base64,'.base64_encode($key['image']); ?>" style="width: 41%; height: auto; margin-top: 3%;">
                <?php endforeach; ?>
     	       <div class="infodiv">


                     <?php if(!empty($_SESSION['post'])): ?>                    

                      <?php foreach($_SESSION['post'] as $key): ?>
     	       	 <div class="insideinfodiv">
     	       	 	<label class="labels">Title:</label>
     	       	 	<label class="labels">&nbsp;<?php echo $key['title']; ?></label>

     	       	 	  <form action="fullviewpost.php" method="post">

     	       	 		<input type="hidden" name="change" value="<?php echo $_SESSION['chosenid']; ?>">

     	       	 		<input type="submit" name="titlechange" value="change" class="changebutton">
                              <?php if($_SESSION['position'] === 1): ?>
     	       	 		<input type="text" name="title" class="changinginput" placeholder="Enter new title">
     	       	 		<label><?php echo $_SESSION['titlemessage'] ?? null; ?></label>
     	       	 	    <?php endif; ?>
     	       	 	</form>
     	       	 </div>
     	       	
                    

                     <div class="insideinfodiv">

     	       	 	<label class="labels">Category:</label>
     	       	 	<label class="labels">&nbsp;<?php echo $key['category']; ?></label>
     	       	 	<form action="fullviewpost.php" method="post">

     	       	 		<input type="hidden" name="change" value="<?php echo $_SESSION['chosenid']; ?>">
     	       	 		<input type="submit" name="categorychange" value="change" class="changebutton">
                              <?php if($_SESSION['position1'] === 1): ?>
     	       	 		<input type="text" name="category" class="changinginput" placeholder="Enter new category">
     	       	 		<label><?php echo $_SESSION['cateemessage'] ?? null; ?></label>
     	       	 		<?php endif; ?>
     	       	 	</form>
     	       	 </div>
                      
                      <div class="insideinfodiv">
     	       	 	<label class="labels">Charges:</label>
     	       	 	<label class="labels">&nbsp;<?php echo $key['charges']; ?></label>
     	       	 	<form action="fullviewpost.php" method="post">
     	       	 		<input type="hidden" name="change" value="<?php echo $_SESSION['chosenid']; ?>">
     	       	 		<input type="submit" name="chargeschange" value="change" class="changebutton">
     	       	 		<?php if($_SESSION['position2'] === 1): ?>
     	       	 		<input type="text" name="charges" class="changinginput" placeholder="Enter new charge">
     	       	 		<label><?php echo $_SESSION['charemessage'] ?? null; ?></label>
     	       	 		<?php endif; ?>
     	       	 	</form>
     	       	 </div>

                    <div class="insideinfodiv">
     	       	 	<label class="labels">Available:</label>
     	       	 	<label class="labels">&nbsp;<?php echo $key['available']; ?></label>
     	       	 	<form action="fullviewpost.php" method="post">
     	       	 		<input type="hidden" name="change" value="<?php echo $_SESSION['chosenid']; ?>">
     	       	 		<input type="submit" name="availablechange" value="change" class="changebutton">
     	       	 		<?php if($_SESSION['position4'] === 1): ?>
     	       	 		<input type="text" name="available" class="changinginput" placeholder="Enter new available">
     	       	 		<label><?php echo $_SESSION['avemessage'] ?? null; ?></label>
     	       	 		<?php endif; ?>
     	       	 	</form>
     	       	 </div>





     	       	 <div class="insideinfodiv">
     	       	 	<label class="labels">Description:</label>
     	       	 	<label class="labels">&nbsp;<?php echo $key['description']; ?></label>
     	       	 	<form action="fullviewpost.php" method="post">
     	       	 		<input type="hidden" name="change" value="<?php echo $_SESSION['chosenid']; ?>">
     	       	 		<input type="submit" name="descchange" value="change" class="changebutton">
     	       	 		<?php if($_SESSION['position3'] === 1): ?>
     	       	 		<textarea name="descinput" class="changetextarea" placeholder="Enter new description"></textarea>
     	       	 		<label><?php echo $_SESSION['desemessage'] ?? null; ?></label>
     	       	 		<?php endif; ?>
     	       	 	</form>
     	       	 </div>


                 <div class="insideinfodiv">
                    <label class="labels">Photo:</label>
                    <form action="fullviewpost.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="photoid" value="<?php echo $_SESSION['chosenid']; ?>">
                        <input type="file" name="uploadimage">
                        <input type="submit" name="photochange" value="change" class="changebutton">
                    </form>
                 </div>

                     <?php endforeach; ?>
                    <?php endif; ?>
     	       </div>
     	</div>
     </section>
</body>
</html>

<?php else: ?>

    <?php header("Location: ../homepage.php"); ?>

<?php endif; ?>