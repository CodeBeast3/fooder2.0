<?php
session_start();

define('HOMEURL','http://127.0.0.1/food_order/');
define('LOCALHOST','localhost');
define('USERNAME','root');
define('PASSWORD','xerxes54');
define('DBNAME','food-order');

$conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD) or die(mysqli_error());
$db_select= mysqli_select_db($conn, DBNAME) or die(mysqli_error());

?>