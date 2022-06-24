<?php 

include "navbar/nav.php";

 if($_SESSION['status'] === true){
    include "admin/delete.php";
    include "navbar/footer.php";
 }
 else
 {
    header("Location: home.php");
 }
 

 ?>