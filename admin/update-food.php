<?php include('partials/menu.php'); ?>
<?php
  if(isset($_GET['id'])){
      $id = $_GET['id'];

      $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
      $res2 = mysqli_query($conn, $sql2);

      $count = mysqli_num_rows($res2);
      if($count==1){
        $row = mysqli_fetch_assoc($res2);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured = $row['featured'];
        $active = $row['active'];

      }else{
          echo "<div class='error'>No Food Category</div>";
      }
      

  }else{
      header('location:'.HOMEURL.'admin/manage-food');
  }
?>
            <?php
                   if(isset($_SESSION['remv3'])){
                        echo $_SESSION['remv3'];
                        unset ( $_SESSION['remv3']);}
               ?>
    <div class="main-content">
      <div class ="wrapper">
       <h1>Update Food</h1>
    
       <form action ="#" method="POST" enctype="multipart/form-data">
        <table class='tbl-midl'>
        <tr>
            <td>Title: </td>
            <td>
               <input type="text" name="title" value="<?php echo $title;?>">
            </td>
        </tr>

        <tr>
            <td>Description: </td>
            <td>
             <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
            </td>
        </tr>
        
        <tr>
            <td>Price </td>
            <td>
               <input type="number" name="price" value="<?php echo $price;?>">
            </td>
        </tr>

        <tr>
            <td>Current Image: </td>
            <td>
               <?php
                if($current_image!=""){
                    ?>
                      <img src="<?php echo HOMEURL;?>images/food/<?php echo $current_image;?>" height="40px" width="40">
                    <?php
                }else{
                    echo "<div class='error'>Image Not Available</div>";
                }
               ?>
            </td>
        </tr>
        <tr>
            <td>Select Image: </td>
                <td>
                <input type="file" name="image">
                </td>
        </tr>
        <tr>
            <td>Category: </td>
            <td>
              <select name="category">
              <?php
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                $res = mysqli_query($conn,$sql);
                if($res==true){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($row2=mysqli_fetch_assoc($res)){
                            $category_title = $row2['title'];
                            $category_id = $row2['id'];
                            ?>
                             <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
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
                <input <?php if($featured=="Yes"){echo "checked";} ?>  type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input  <?php if($active=="Yes"){echo "checked";}  ?> type="radio" name="active" value="Yes">Yes
                <input   <?php if($active="No"){echo "checked";} ?> type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td colspan="3">
             <input type="hidden" name="id" value="<?php echo $id; ?>">
             <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
             <input type="submit" name="submit" value="Updata Food" class="btn-secondary">
            </td>
        </tr>
        <table>
       </form>
      </div>
    </div>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $id = $_POST['id'];
    $current_image = $_POST['current_image'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    

      if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        if($image_name!=""){

          $vare =  explode('.',$image_name);
          $ext = end($vare);
          $image_name = "Food__Name_".rand(000,999).'.'.$ext;

          $source_path = $_FILES['image']['tmp_name'];
          $destination_path= "../images/food/".$image_name;

          $upload = move_uploaded_file($source_path,$destination_path);

          if($upload==false){
              $_SESSION['upload']="<div class='error'>Image Upload Failed</div>";
              header('location:'.HOMEURL.'admin/manage-food.php');
              die();
        }
          
        if($current_image!="")
        {
          $remove_path = "../images/food/".$current_image;
          $remove = unlink($remove_path);

          if($remove==false){
            $_SESSION['remv3']="<div class='error'>Failed To remove Image</div>";
            header('location:'.HOMEURL.'admin/update-food.php');
            die();
          }
        }
      }else{
          $image_name = $current_image;
      }
      }else{
          $image_name = $current_image;
      }
$sql3 = "UPDATE tbl_food SET 
title = '$title',
description = '$description',
price = $price,
image_name='$image_name',
category_id = $category,
featured ='$featured',
active ='$active' WHERE id=$id";

$res3 = mysqli_query($conn,$sql3);
if($res==true){
        $_SESSION['updated']="<div class='success'>Successfully Updated Food</div>";
        header("location:".HOMEURL.'admin/manage-food.php');
}else{
        $_SESSION['updated']="<div class='error'>Failed To Update Food</div>";
        header("location:".HOMEURL.'admin/manage-food.php');
}
}
?>
<?php include('partials/footer.php'); ?>