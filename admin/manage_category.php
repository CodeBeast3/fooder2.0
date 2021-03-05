
<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
      <h1>Manage Category</h1>
      <br/><br/>
               <!--button to add admin-->
               <a href="<?php echo HOMEURL?>admin/add-category.php" class="btn-primary">Add Category</a>
               <br /><br />
               <?php
                 if(isset($_SESSION['add'])){
                     echo $_SESSION['add'];
                     unset($_SESSION['add']);
                 }

                 if(isset($_SESSION['access'])){
                  echo $_SESSION['access'];
                  unset($_SESSION['access']);
              }

                 if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['no_category_found'])){
                  echo $_SESSION['no_category_found'];
                  unset($_SESSION['no_category_found']);
              }
                 
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update2'])){
                  echo $_SESSION['update2'];
                  unset($_SESSION['update2']);
              }

              if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['remv2'])){
              echo $_SESSION['remv2'];
              unset($_SESSION['remv2']);
          }

                 ?>
               <br/><br/>

               <table class="tbl-full">
                   <tr>
                       <th>S.N.</th>
                       <th>Title</th>
                       <th>Image</th>
                       <th>Featured</th>
                       <th>Active</th>
                       <th>Actions</th>
                   </tr>

                   <?php
                       $sql = "SELECT * FROM tbl_category";
                       $res = mysqli_query($conn, $sql);
                       $sn = 1;

                       $count = mysqli_num_rows($res);
                       if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                         $id = $row['id'];
                         $title = $row['title'];
                         $image_name = $row['image_name'];
                         $featured = $row['featured'];
                         $active = $row['active'];

                         ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                      if($image_name!=""){
                                         ?>
                                         <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" height="40px">

                                         <?php
                                      }else{
                                         echo "<div class='error'>Image not Added.</div>";
                                      }
                                    
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo HOMEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo HOMEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                        <?php

                        }
                       }else{
                         ?>
                         <tr>
                           <td colspan="6"><div class='error'>No Category Added.</div></td>
                         </tr>
                         <?php
                       }

                   ?>
               </table>   
  </div>
</div>


<?php include('partials/footer.php'); ?>