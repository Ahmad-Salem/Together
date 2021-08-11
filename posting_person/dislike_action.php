<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['like_post_id'])&&isset($_POST['like_account_id'])&&isset($_POST['like_account_type']))
	{
		$post_id=$_POST['like_post_id'];
		$account_id=$_POST['like_account_id'];
		$account_type=$_POST['like_account_type'];
		//dislike for the first time
		$query_post_like="DELETE FROM `likes_normal_post` WHERE `account_id`='$account_id' AND `post_id`='$post_id' AND `account_type`='$account_type' LIMIT 1";
		$perform_query_post_like=mysqli_query($connect,$query_post_like);
	
		if($perform_query_post_like)
		{
			
			//successful dislike for the first time	
			$return_post_id=$_POST['like_post_id'];
			$return_like_status="like_btn";
			$liked_berfore=0;
			$Account_dislike_info[]=array(
				"post_id"=>$return_post_id,
				"like_stauts"=>$return_like_status,
				"disliked_berfore"=>$liked_berfore
				);
			echo json_encode($Account_dislike_info, JSON_FORCE_OBJECT);

		}else
		{
			//when some thing going wrong ...
			$return_post_id=$_POST['like_post_id'];
			$return_like_status="dislike_btn";
			$message="Something Going wrong plz try again ...";
			$liked_berfore=0;
			$Account_dislike_info[]=array(
				"post_id"=>$return_post_id,
				"like_stauts"=>$return_like_status,
				"like_message"=>$message,
				"disliked_berfore"=>$liked_berfore	
				);
			
			echo json_encode($Account_dislike_info, JSON_FORCE_OBJECT);
		}	
	

			
	}else
	{
		//when some thing going wrong ...
		$return_post_id=$_POST['like_post_id'];
		$return_like_status="dislike_btn";
		$message="Something Going wrong plz try again ...";
		$liked_berfore=0;
		$Account_dislike_info[]=array(
			"post_id"=>$return_post_id,
			"like_stauts"=>$return_like_status,
			"like_message"=>$message,
			"disliked_berfore"=>$liked_berfore	
			);
		echo json_encode($Account_dislike_info, JSON_FORCE_OBJECT);
	}
	
?>