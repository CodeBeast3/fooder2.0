<?php include('partials/menu.php');?>

<div class="main-content">
   <div class ="wrapper">
      <h1>Update Category</h1>
      <?php
       if(isset($_GET['id'])){
           $id = $_GET['id'];
           $sql = "SELECT * FROM tbl_category WHERE id=$id";
           $res = mysqli_query($conn,$sql);

           if($res == true){
               $count = mysqli_num_rows($res);
            if($count==1){
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image =$row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }else{
                $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";;
                header('location'.HOMEURL.'admin/manage_category.php');
            }
               
           }

       }else{
           $_SESSION['access']="<div class='error'>Unauthorised Access</div>";
           header('location:'.HOMEURL.'admin/manage_category.php');
       }
      ?>
      <br /><br />

      <?php
         if(isset($_SESSION['update2'])){
            echo $_SESSION['update2'];
            unset($_SESSION['update2']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


      ?>
       <form action="#" method="POST" enctype="multipart/form-data">
         <table class="tbl-midl">
           <tr>
             <td>Title: </td>
             <td>
                <input type="text" name="title" value="<?php echo $title; ?>">
             </td>
           </tr>

           <tr>
             <td>Current Image: </td>
             <td>
            <?php
              if($current_image != ""){
                  ?>
                  <img src="<?php echo HOMEURL;?>/images/category/<?php echo $current_image;?>" height="30%"
                  width="40%">

                  <?php
              }else{
                  echo "<div class='error'>Image not Added.</div>";
              }
            ?>
             </td>
           </tr>

           <tr>
             <td>New Image: </td>
             <td>
                <input type="file" name="image">
             </td>
           </tr>
           
           <tr>
             <td>Featured: </td>
             <td>
                <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
             </td>
           </tr>

           <tr>
             <td>Active: </td>
             <td>
                <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
             </td>
           </tr>

           <tr>
              <td colspan="3"> 
                <input type ="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type ="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
              </td>
           </tr>
         </table>
       </form>
   </div>

</div>


<?php
if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name'])){
                  $image_name = $_FILES['image']['name'];
                  if($image_name!=""){
        
                    $ext = end(explode('.',$image_name));
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path= "../images/category/".$image_name;

                    $upload = move_uploaded_file($source_path,$destination_path);

                    if($upload==false){
                        $_SESSION['upload']="<div class='error'>Image Upload Failed</div>";
                        header('location:'.HOMEURL.'admin/manage_category.php');
                        die();
                  }
                    
                  if($current_image!="")
                  {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
  
                    if($remove==false){
                      $_SESSION['remv2']="<div class='error'>Failed To remove Image</div>";
                      header('location:'.HOMEURL.'admin/update-category.php');
                      die();
                    }
                  }
                }else{
                    $image_name = $current_image;
                }
                }else{
                    $image_name = $current_image;
                }

                $sql2 = "UPDATE tbl_category SET title='$title',
                image_name = '$image_name',
                featured ='$featured',
                active='$active' WHERE id=$id";

                $res = mysqli_query($conn,$sql2);
                if($res == true){
                        $_SESSION['update2']="<div class='success'>Updated Successfully</div>";
                        header('location:'.HOMEURL.'admin/manage_category.php');
                }else{
                        $_SESSION['update2']="<div class='error'>Update Failed</div>";
                        header('location:'.HOMEURL.'admin/update-category.php');
                }
}
?>
<?php include('partials/footer.php');?>