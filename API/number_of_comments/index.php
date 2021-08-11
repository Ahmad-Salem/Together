<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");


	if($_POST['do_action']=='num_of_comments')
	{
		if(isset($_POST['post_id']))
		{
			$post_id=$_POST['post_id'];

			$query_num_comment="SELECT `id` FROM `comments_normal_post` WHERE `post_id`='$post_id'";
			$perform_query_num_comment=mysqli_query($connect,$query_num_comment);

			if(mysqli_num_rows($perform_query_num_comment)==0)
			{
				$comments_num=0;
			}else
			{
				$comments_num=mysqli_num_rows($perform_query_num_comment);
			}

			$comments_num_arr=array('comments_num'=>$comments_num);

			echo json_encode($comments_num_arr,JSON_FORCE_OBJECT);
		}
	}
?>