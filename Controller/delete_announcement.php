<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/deletedir.php");
	if(isset($_POST['announcement_id'])&isset($_POST['account_id'])&&isset($_POST['account_type']))
	{
		
		$announcement_id=$_POST['announcement_id'];
		$account_id=$_POST['account_id'];
		$account_type=$_POST['account_type'];
		

		//post
		$query_announcement="DELETE FROM `request_post` WHERE `account_id`='$account_id' AND `account_type`='$account_type' AND `id`='$announcement_id' LIMIT 1";
		$perform_query_announcement=mysqli_query($connect,$query_announcement);
		//images
		$query_announcement_images="DELETE FROM `request_post_images` WHERE `request_id`='$announcement_id' ";
		$perform_query_announcement_images=mysqli_query($connect,$query_announcement_images);
		
		if($account_type=='p')
		{
			$path='../request_post_attachment/user/'.$account_id.'/'.$announcement_id;
			deleteDirectory($path);
		}else if($account_type=='f')
		{
			$path='../request_post_attachment/foundation/'.$account_id.'/'.$announcement_id;
			deleteDirectory($path);
		}
		
	}
?>