<?php 
 session_start();
 ?>

 <?php 
include "backendhandlersfiles/readeringpost.php";

  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Web for bitches</title>
	<link rel="stylesheet" type="text/css" href="asset/asset.css">
  <link rel="stylesheet" type="text/css" href="asset/asset1.css">
  <link rel="stylesheet" type="text/css" href="asset/asset2.css">
  <link rel="stylesheet" type="text/css" href="asset/asset3.css">
</head>
<body>
  <section class="containernavbar">
  	<div class="divnavbar">
  		<a href="home.php"><img src="asset/logo.jpg" class="logoimage"></a>
       <div class="divh1"><h1>Escort services</h1></div>
       
       <div class="div1"><a href="inc.php" class="labellist">InCall available</a></div>
       <div class="div2"><a href="outc.php" class="labellist">OutCall available</a></div>
       <div class="div3"><a href="binc.php" class="labellist">Both available</a></div>
       <div class="div3"><a href="comp.php" class="labellist">Complaints</a></div>
       <div class="div3">
        <form action="inc.php" method="get">
        	<input type="search" name="search" placeholder="search" class="inputbutton">
        </form>
       </div>
  	</div>
  </section>
</body>
</html>