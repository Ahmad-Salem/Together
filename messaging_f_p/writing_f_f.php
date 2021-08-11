<?php
include_once("../php_includes/connection_dp.php");

$fid=mysqli_real_escape_string($connect,$_POST['fid']);
$my_id=$_COOKIE['foundation_id'];
$query_f_f_writing="INSERT INTO `writing_status_f_f`(`foundation_from`, `foundation_to`, `status`) VALUES ( '$my_id','$fid','1' )";
$perform_query_f_f_writing=mysqli_query($connect,$query_f_f_writing);

?>