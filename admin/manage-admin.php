
<?php include('partials/menu.php'); ?>

          <!---Main Content section starts--->
          <div class = "main-content">
            <div class ="wrapper">
               <h1>Manage Admin</h1>
               <br/><br/>
               <!--button to add admin-->
               <a href="add-admin.php" class="btn-primary">Add Admin</a>

               <br/><br/>
               <?php
                 if(isset($_SESSION['add']))
                 {
                     echo $_SESSION['add'];
                     unset($_SESSION['add']);
                 }elseif(isset($_SESSION['delete']))
                 {
                      echo $_SESSION['delete'];
                      unset($_SESSION['delete']);
                 }elseif(isset($_SESSION['update'])) {
                      echo $_SESSION['update'];
                      unset($_SESSION['update']);
                 }elseif(isset($_SESSION['not_found'])) {
                  echo $_SESSION['not_found'];
                  unset($_SESSION['not_found']);
                 }elseif(isset($_SESSION['changed'])) {
                  echo $_SESSION['changed'];
                  unset($_SESSION['changed']);}
               ?>
              <br/><br/>
              
               <table class="tbl-full">
                   <tr>
                       <th>S.N.</th>
                       <th>Full Name</th>
                       <th>Username</th>
                       <th>Actions</th>
                   </tr>
                   
                   <?php
                     $sql = "SELECT * FROM tbl_admin";
                     $res = mysqli_query($conn,$sql);

                     if($res==TRUE){
                         $sn = 1;

                         if(mysqli_num_rows($res)>0){
                            while($rows=mysqli_fetch_assoc($res)){
                                $id=$rows['id'];
                                $full_name=$rows['first_name'];
                                $username = $rows['username'];

                                ?>
                                  <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                     <a href="<?php echo HOMEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                     <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                     <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                 </tr>

                                <?php
                            }

                         }else{

                         }
                     }
                   ?>
               </table>   
             </div>
          </div>
          
          <!--Main Content ends-->

<?php include('partials/footer.php'); ?>