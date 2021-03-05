
<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
      <h1>Manage Food</h1>
      <br/><br/>
               <!--button to add admin-->
               <a href="<?php echo HOMEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
               <br /><br />
               <?php
                   if(isset($_SESSION['ADD'])){
                    echo $_SESSION['ADD'];
                    unset ( $_SESSION['ADD']);}

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset ( $_SESSION['delete']);}

                    if(isset($_SESSION['delete-success'])){
                        echo $_SESSION['delete-success'];
                        unset ( $_SESSION['delete-success']);}

                    if(isset($_SESSION['remove-failed'])){
                        echo $_SESSION['remove-failed'];
                        unset ( $_SESSION['remove-failed']);}

                    
                   if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset ( $_SESSION['upload']);}

                      
                   if(isset($_SESSION['updated'])){
                    echo $_SESSION['updated'];
                    unset ( $_SESSION['updated']);}
               ?>
               
                   
               <br /><br />

               <table class="tbl-full">
                   <tr>
                       <th>S.N.</th>
                       <th>Title</th>
                       <th>Price</th>
                       <th>Image</th>
                       <th>Featured</th>
                       <th>Active</th>
                       <th>Actions</th>
                   </tr>
                   <?php
                   $sql = "SELECT * FROM tbl_food";
                   $res = mysqli_query($conn,$sql);
                   if($res==true){
                       $count=mysqli_num_rows($res);
                       $sn=1;
                       if($count>0){
                           while($row=mysqli_fetch_assoc($res)){
                                $id  = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                   <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo '$'.$price; ?></td>
                                        <td><?php 
                                        if($image_name!=""){
                                            ?>
                                             <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" height="40px">
                                            <?php
                                        } else{
                                            echo "<div class='error'>Image Not Added.</div>";
                                        }
                                        ?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo HOMEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo HOMEURL;?>admin/delete-food.php?id=<?php echo $id;?> &image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>
                                <?php
                           }
                       }else{
                           echo "<tr><td colspan='7' class='error'>Food Not Added Yet.</td></tr>";
                       }
                   }
                   ?>
               </table>   
  </div>
</div>


<?php include('partials/footer.php'); ?>