<?php
session_start();
include_once("../php_includes/connection_dp.php");
$account_id=$_POST['account_id'];

$query_p_p="SELECT `id` FROM `following` WHERE `account_following_id`='$account_id' AND `account_following_type`='p' ";
$perform_query_p_p=mysqli_query($connect,$query_p_p);

if($perform_query_p_p)
{
	echo mysqli_num_rows($perform_query_p_p);
}


?>