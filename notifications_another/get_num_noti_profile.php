<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if($_COOKIE['Account_type']=='person')
	{
		$account_id=$_COOKIE['user_id'];
		$account_type='p';

	}else if($_COOKIE['Account_type']=='foundation')
	{
		$account_id=$_COOKIE['foundation_id'];
		$account_type='f';
	}

	$query_trusted="SELECT `id` FROM `following` WHERE `following_status`='0' AND `account_following_id`='$account_id' AND `account_following_type`='$account_type' LIMIT 99";
	$perform_query_trusted=mysqli_query($connect,$query_trusted);

	echo mysqli_num_rows($perform_query_trusted);
?>