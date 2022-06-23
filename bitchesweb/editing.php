<?php 
 include "navbar/nav.php";

 if($_SESSION['status'] === true){
    include "admin/edit.php";
    include "navbar/footer.php";
 }
 else
 {
    header("Location: home.php");
 }
 

 ?>