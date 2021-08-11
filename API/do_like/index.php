<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_action']=='do_like')
	{
		if(isset($_POST['account_id'])&&isset($_POST['account_type'])&&isset($_POST['post_id']))
		{
			$account_id=$_POST['account_id'];
			$account_type=$_POST['account_type'];
			$post_id=$_POST['post_id'];

			$query_do_like="INSERT INTO `likes_normal_post`(`account_id`, `account_type`, `post_id`) VALUES ('$account_id','$account_type','$post_id')";
			$perform_query_do_like=mysqli_query($connect,$query_do_like);

			if($perform_query_do_like)
			{
				$like=array("status"=>"oki");	
			}else
			{
				$like=array("status"=>"failed");	
			}

			echo json_encode($like,JSON_FORCE_OBJECT);

		}
	}
	
?>	