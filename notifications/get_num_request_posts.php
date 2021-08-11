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

	$query_request_post="SELECT `id` FROM `request_post`";
	$query_request_post_seen="SELECT `request_post`.`id` FROM `request_post` INNER JOIN `request_post_noti_seen` ON `request_post`.`id` = `request_post_noti_seen`.`request_id` ";
	$perform_query_request_post=mysqli_query($connect,$query_request_post);
	$perform_query_request_post_seen=mysqli_query($connect,$query_request_post_seen);
	echo mysqli_num_rows($perform_query_request_post)-mysqli_num_rows($perform_query_request_post_seen);
?>