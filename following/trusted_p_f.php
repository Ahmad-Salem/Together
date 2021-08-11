<?php
session_start();
include_once("../php_includes/connection_dp.php");
$account_id=@$_POST['account_id'];

$query_p_f="SELECT `id` FROM `following` WHERE `account_following_id`='$account_id' AND `account_following_type`='f' ";
$perform_query_p_f=mysqli_query($connect,$query_p_f);


if($perform_query_p_f)
{
	echo mysqli_num_rows($perform_query_p_f);
}


?>