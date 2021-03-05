<?php
include("../config/constants.php");

session_destroy();
header('location:'.HOMEURL.'admin/login.php');
?>