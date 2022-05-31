<?php 
session_start();
include "Handlers/fullViewHandler.php";


 if(isset($_GET['viewimages']))
 {
 	
 	if(!empty($_GET['serviceimagesid']))
 	{
 		$imagesid = $_GET['serviceimagesid'];
        $_SESSION['image'] = moreimages($imagesid);
       
       
 	}
 }


 ?>



<?php if(!empty($_SESSION['image'])): ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="moreimage.css">
	<title></title>
</head>
<body>
<section>
	<?php foreach( $_SESSION['image'] as $key): ?>
	<center><img src="<?php echo 'data:image;base64,'.base64_encode($key['photos']); ?>" alt="what image shows" height="800" width="850"></center>

<?php endforeach; ?>
</section>
</body>
</html>

<?php else: ?>

	<section>
		<h1 style="text-align: center;">no photo available..</h1>
	</section>

<?php endif; ?>

