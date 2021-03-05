<?php
include('../config/constants.php');


 if(isset($_GET['id'])  &&  isset($_GET['image_name']))
 {
    $id = $_GET['id'];
    $image_name =$_GET['image_name'];

    if($image_name!=null){
        $path = "../images/category/".$image_name;
        $remove = unlink($path);

        if($remove==false){
            $_SESSION['remove']="<div class='error'>Failed To Remove Image</div>";
            header("location:".HOMEURL.'admin/manage_category.php');
            die();
        }else{
            $sql = "DELETE FROM tbl_category WHERE id=$id";
            $res= mysqli_query($conn ,$sql);

            if($res==true)
            {
                $_SESSION['delete']="<div class ='success'>Image Removed Successful</div>";
                header('location:'.HOMEURL.'admin/manage_category.php');
            }else{
                $_SESSION['delete']="<div class ='error'>Failed To Remove Image.</div>";
                header('location:'.HOMEURL.'admin/manage_category.php');
            }
        }
    }
 }else{
     header('location:'.HOMEURL.'admin/manage_category.php');
 }


?>