<?php 
include "backendhandlersfiles/AdminClass.php"; 
 include "navbar/nav.php";



if(isset($_POST['changepass']))
{
   if(!empty($_POST['hid']) && !empty($_POST['password1']) && !empty($_POST['password2']))
   {
      $old = $_POST['password2'];
      $new = $_POST['password1'];
      $joinid = $_POST['hid'];

      if($old !== $new)
      {
       $update = new Admin();
       $res = $update->updatepassword($new,$joinid);
       if($res === true)
       {
         $message ="Password updated successfully";
       }
       elseif($res === false)
       {
         $message ="Technical error occurred";
       }
       else
       {
         $message = $res;
       }
      }
      else{
         $message ="Password are the same";
      }
   }
}

 ?>


<?php  if($_SESSION['status'] === true): ?>  
 <section class="rgicontainer">
   <div class="regdiv">
      <form action="#" method="post">
         <label>Change password fill form below</label><br>
         <input type="hidden" name="hid" value="<?php echo $_SESSION['joinid']; ?>">
         <input type="password" name="password2" placeholder="Enter old password" required class="inputreg">
         <input type="password" name="password1" placeholder="Enter new password" required class="inputreg">
         <input type="submit" name="changepass" value="Change password" class="buttonlogin">
         <label><?php echo $message ?? null; ?></label>
      </form>
   </div>
</section>

<?php include "navbar/footer.php"; ?>
 <?php else: ?>

<?php header("Location: home.php"); ?>
<?php endif; ?>