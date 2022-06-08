<?php 	

 include "navigationbar/nav.php";
 if($_SESSION['login'] === false)
{
 include "Validations/logging.php";
 include "navigationbar/footer.php";
}
elseif($_SESSION['login'] === true)
{
       include "navigationbar/searchingindividuals.php";
       include "navigationbar/services.php";
       include "navigationbar/foot-2.php";
}

 ?>