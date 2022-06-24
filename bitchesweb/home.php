<?php 

include "navbar/nav.php";
include "navbar/welcome.php";
$_SESSION['cate'] = "none";
$_SESSION['messages'] = null;
$_SESSION['liks'] = null;
$_SESSION['done'] = null;
$_SESSION['token'] = null;
include "diplayfolder/incallpage.php";
include "navbar/footer.php";

 ?>