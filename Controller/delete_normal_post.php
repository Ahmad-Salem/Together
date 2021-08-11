<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/deletedir.php");
	if(isset($_POST['post_id'])&isset($_POST['account_id'])&&isset($_POST['account_type']))
	{
		
		$post_id=$_POST['post_id'];
		$account_id=$_POST['account_id'];
		$account_type=$_POST['account_type'];
		

		//post
		$query_normal_post="DELETE FROM `normal_posts` WHERE `account_id`='$account_id' AND `account_type`='$account_type' AND `id`='$post_id' LIMIT 1";
		$perform_query_normal_post=mysqli_query($connect,$query_normal_post);
		//comments
		$query_normal_post_comment="DELETE FROM `comments_normal_post` WHERE  `post_id`='$post_id' ";
		$perform_query_normal_post_comment=mysqli_query($connect,$query_normal_post_comment);
		//images
		$query_normal_post_images="DELETE FROM `normal_post_images` WHERE `account_id`='$account_id' AND `account_type`='$account_type' AND `post_id`='$post_id' ";
		$perform_query_normal_post_images=mysqli_query($connect,$query_normal_post_images);
		//likes
		$query_normal_post_likes="DELETE FROM `likes_normal_post` WHERE `post_id`='$post_id'  ";
		$perform_query_normal_post_likes=mysqli_query($connect,$query_normal_post_likes);

		if($account_type=='p')
		{
			$path='../postingattachment/user/'.$account_id.'/'.$post_id;
			deleteDirectory($path);
		}else if($account_type=='f')
		{
			$path='../postingattachment/foundation/'.$account_id.'/'.$post_id;
			deleteDirectory($path);
		}
		
	}
?>