<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_action']=='do_comment')
	{
		if(isset($_POST['account_id'])&&isset($_POST['account_type'])&&isset($_POST['post_id'])&&isset($_POST['comment']))
		{
			$account_id=$_POST['account_id'];
			$account_type=$_POST['account_type'];
			$post_id=$_POST['post_id'];
			$comment=$_POST['comment'];

			$query_do_comment="INSERT INTO `comments_normal_post`(`account_id`, `account_type`, `comment`, `post_id`) VALUES ('$account_id','$account_type','$comment','$post_id')";
			$perform_query_do_comment=mysqli_query($connect,$query_do_comment);
			if($perform_query_do_comment)
			{
				$comment_s=array("status"=>"oki");	
			}else
			{
				$comment_s=array("status"=>"failed");	
			}
			
			
			echo json_encode($comment_s,JSON_FORCE_OBJECT);

		}

	}

?>