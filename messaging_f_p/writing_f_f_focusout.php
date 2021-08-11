<?php
include_once("../php_includes/connection_dp.php");

$fid=mysqli_real_escape_string($connect,$_POST['fid']);
$my_id=$_COOKIE['foundation_id'];
$query_f_f_writing="DELETE FROM `writing_status_f_f` WHERE `foundation_from`='$my_id' AND `foundation_to`='$fid' LIMIT 1";
$perform_query_f_f_writing=mysqli_query($connect,$query_f_f_writing);

?>