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

	$query_normal_post="SELECT `id` FROM `normal_posts`";
	$query_normal_post_seen="SELECT `normal_posts`.`id` FROM `normal_posts` INNER JOIN `normal_post_noti_seen` ON `normal_posts`.`id` = `normal_post_noti_seen`.`normal_post_id` ";
	$perform_query_normal_post=mysqli_query($connect,$query_normal_post);
	$perform_query_normal_post_seen=mysqli_query($connect,$query_normal_post_seen);
	echo mysqli_num_rows($perform_query_normal_post)-mysqli_num_rows($perform_query_normal_post_seen);
?>