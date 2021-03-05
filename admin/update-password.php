<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
       <h1>Change Password</h1>
       <br/><br/>
       <?php
              $id = $_GET['id'];
       ?>

       <?php
          if(isset($_SESSION['password_mismatch'])){
              echo $_SESSION['password_mismatch'];
              unset ($_SESSION['password_mismatch']);
          }
       ?>
       <br /><br/>
       <form action="#" method="POST">
       <table class="tbl-midl">
           <tr>
               <td>Old Password:</td>
               <td>
                  <input type="password" name="current_password" placeholder="Old Password">
               </td>
           </tr>

           <tr>
               <td>New Password:</td>
               <td>
                  <input type="password" name="new_password" placeholder="New Password">
               </td>
           </tr>

           <tr>
               <td>Confirm Password:</td>
               <td>
                  <input type="password" name="confirm_password" placeholder="Confirm Password">
               </td>
           </tr>

           <tr>
                <td colspan="2">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>  
           </tr>
       </table>
       </form>
    </div>
</div>
<?php include('partials/footer.php');?>

<?php
  if(isset($_POST['submit'])){
     $id = $_POST['id'];
     $current_password = md5($_POST['current_password']);
     $new_password = md5($_POST['new_password']);
     $confirm_password = md5($_POST['confirm_password']);

     $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
     $res = mysqli_query($conn,$sql);

     if($res == TRUE){
         $count = mysqli_num_rows($res);
         if($count == 1){
             if($confirm_password==$new_password){
                 $sql2 = "UPDATE tbl_admin SET password='$new_password'";
                 $xer = mysqli_query($conn,$sql2);

                 if($xer == TRUE){
                    $_SESSION['changed']="<div class='success'>Password Changed Successfully</div>";
                    header('location:'.HOMEURL.'admin/manage-admin.php');
                 }else{
                    $_SESSION['changed']="<div class='error'>Failed to change password</div>";
                    header('location:'.HOMEURL.'admin/update-password.php');
                 }

             }else{
                $_SESSION['password_mismatch']="<div class='error'>Password Mismatch</div>";
                header('location:'.HOMEURL.'admin/update-password.php');
             }
         }else{
             $_SESSION['not_found']="<div class='error'>User Not Found</div>";
             header('location:'.HOMEURL.'admin/manage-admin.php');
         }
     }
  }
?>