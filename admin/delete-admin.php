<?php
include('../config/constants.php');
//get id of a particular admin to be deleted
//create sql query to delete
//redirect to manage admin page
$id = $_GET['id'];
//echo $id;

$sql = "DELETE FROM tbl_admin WHERE id=$id";
$res = mysqli_query($conn,$sql);

if($res==TRUE){
    $_SESSION['delete'] = "<div class='success'>Delted Successfully.</div>";
    header("location:".HOMEURL.'admin/manage-admin.php');
}else{
    $_SESSION['delete'] = "<div class='error' >Deletion Failure.</div>";
    header("location:".HOMEURL.'admin/manage-admin.php');
}
?>