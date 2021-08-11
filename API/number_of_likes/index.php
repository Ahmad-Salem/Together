<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_action']=='num_of_likes')
	{
		if(isset($_POST['post_id']))
		{
			$account_id=$_POST['account_id'];
			$account_type=$_POST['account_type'];
			$post_id=$_POST['post_id'];

			$query_num_likes="SELECT `id` FROM `likes_normal_post` WHERE `post_id`='$post_id'";
			$perform_query_num_likes=mysqli_query($connect,$query_num_likes);

			if(mysqli_num_rows($perform_query_num_likes)==0)
			{
				$likes_num=0;
			}else
			{
				$likes_num=mysqli_num_rows($perform_query_num_likes);
			}

			$num_likes_arr=array('likes_num'=>$likes_num);

			echo json_encode($num_likes_arr,JSON_FORCE_OBJECT);

		}
	}

?>