<?php
include("../config/constants.php");

if(isset($_GET['id'] ) && isset($_GET['image_name'])){
    $image_name = $_GET['image_name'];
    $id = $_GET['id'];

        if($image_name!=""){
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            if($remove==false){
              $_SESSION['remove-failed']="<div class='error'>Failed To Remove Image</div>";
              header("location:".HOMEURL.'admin/manage-food.php');
              die();
            }else{

               $sql = "DELETE FROM tbl_food WHERE id=$id";
               $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

               if($res==true){
                   $_SESSION['delete-success']="</div class='success'>Successfully Deleted Record</div>";
                   header("location:".HOMEURL.'admin/manage-food.php');
               }else{
                    $_SESSION['delete-success']="</div class='error'>Failed To Delete Record</div>";
                    header("location:".HOMEURL.'admin/manage-food.php');
            }
        }

}else{
  $_SESSION['delete'] ="<div class='error'>Unauthorised Access.</div>";
  header("location:".HOMEURL.'admin/manage-food.php');
}
}
?>