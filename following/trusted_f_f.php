<?php
session_start();
include_once("../php_includes/connection_dp.php");
$account_id=@$_POST['account_id'];

$query_f_f="SELECT `id` FROM `following` WHERE `account_following_id`='$account_id' AND `account_following_type`='f' ";
$perform_query_f_f=mysqli_query($connect,$query_f_f);

if($perform_query_f_f)
{
	echo mysqli_num_rows($perform_query_f_f);
}


?>