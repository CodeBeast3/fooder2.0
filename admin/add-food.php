<?php include('partials/menu.php');?>

        <div class="main-content">
            <div class="wrapper">
              <h1>Add Food</h1>
              <?php
               if(isset($_SESSION['upload1'])){
                echo $_SESSION['upload1'];
                unset ( $_SESSION['upload1']);
            }?>
              <br /><br />
              <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-mid">
                   <tr>
                    <td>Title:</td>
                    <td>
                       <input type="text" name="title" placeholder="Title of the food">
                    </td>
                   </tr>

                   <tr>
                    <td>Description:</td>
                    <td>
                       <textarea name="description" cols="30" rows="5"></textarea>
                    </td>
                   </tr>

                   <tr>
                    <td>Price:</td>
                    <td>
                       <input type="number" name="price">
                    </td>
                   </tr>

                   <tr>
                    <td>Select Image:</td>
                    <td>
                       <input type="file" name="image">
                    </td>
                   </tr>

                   <tr>
                    <td>Category:</td>
                    <td>
                       <select name="category">
                       <?php
                          $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                          $res = mysqli_query($conn,$sql);
                          if($res==true){
                              $count = mysqli_num_rows($res);
                              if($count>0){
                                  while($row=mysqli_fetch_assoc($res)){
                                     $title = $row['title'];
                                     $id = $row['id'];
                                     ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title;?></option>
                                     <?php
                                  }
                              }else{
                                  ?>
                                    <option value="0">No Category Found</option>
                                  <?php
                              }
                          }
                       ?>
                       </select>
                    </td>
                   </tr>

                   <tr>
                          <td>Featured:</td>
                          <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                          </td>
                       </tr>

                       <tr>
                          <td>Active:</td>
                          <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                          </td>
                       </tr>

                       <tr>
                           <td colspan="2">
                               <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                           </td>
                       </tr>
                </table>
              </form>
            </div>
        </div>



<?php include('partials/footer.php');?>
<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    if(isset($_POST['featured'])){
        $featured = $_POST['featured'];
     }else{
         $featured = "No";
     }
    
 if(isset($_POST['active'])){
   $active = $_POST['active'];
}else{
    $active = "No";
}

if(isset($_FILES['image']['name'])){
    //image name,source path,destination path
    $image_name=$_FILES['image']['name'];
    
  if($image_name!=""){
    $var = explode('.',$image_name);
    $ext = end($var);
    
    $image_name ="Food_Name_".rand(000, 999).'.'.$ext;

    $source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/food/".$image_name;

    $upload = move_uploaded_file($source_path, $destination_path);

    if($upload==false){
        $_SESSION['upload1']="<div class='error'>Failed To Upload Image</div>";
        header('location:'.HOMEURL.'admin/add-food');
        die();
    }
  }
 }else{
     $image_name="";
 }


$sql1 = "INSERT INTO tbl_food SET
title='$title',
description='$description',
price = $price,
image_name='$image_name',
category_id = $category,
featured='$featured',
active='$active'
";

//echo $sql1;

$res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));


if($res1 == TRUE){
    $_SESSION['ADD']="<div class='success'>Successful</div>";
    header("location:".HOMEURL.'admin/manage-food');
}else{
    $_SESSION['ADD']="<div class='error'>Failure</div>";
    header("location:".HOMEURL.'admin/manage-food');
}
}
?>