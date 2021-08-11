<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['like_post_id'])&&isset($_POST['like_account_id'])&&isset($_POST['like_account_type']))
	{
		$post_id=$_POST['like_post_id'];
		$account_id=$_POST['like_account_id'];
		$account_type=$_POST['like_account_type'];
		/*query select to make sure that the like ismade for the first time*/
		$query_post_like_check="SELECT `id` FROM `likes_normal_post` WHERE `account_id`='$account_id' AND `account_type`= '$account_type' AND `post_id`='$post_id' ";
		$perform_query_post_like_check=mysqli_query($connect,$query_post_like_check);
		if(mysqli_num_rows($perform_query_post_like_check)==0)
		{
			//like for the first time
			$query_post_like="INSERT INTO `likes_normal_post`(`account_id`, `post_id`, `account_type`) VALUES ('$account_id','$post_id','$account_type')";
			$perform_query_post_like=mysqli_query($connect,$query_post_like);
			if($perform_query_post_like)
			{
				//
				
				$return_post_id=$_POST['like_post_id'];
				$return_like_status="like_btn";
				$liked_berfore=0;
				$Account_like_info[]=array(
					"post_id"=>$return_post_id,
					"like_stauts"=>$return_like_status,
					"liked_berfore"=>$liked_berfore
					);
				echo json_encode($Account_like_info, JSON_FORCE_OBJECT);

			}else
			{
				//when some thing going wrong ...
				$return_post_id=$_POST['like_post_id'];
				$return_like_status="dislike_btn";
				$message="Something Going wrong plz try again ...";
				$liked_berfore=0;
				$Account_like_info[]=array(
					"post_id"=>$return_post_id,
					"like_stauts"=>$return_like_status,
					"like_message"=>$message,
					"liked_berfore"=>$liked_berfore	
					);
				
				echo json_encode($Account_like_info, JSON_FORCE_OBJECT);
			}	
		

		}else
		{
			//liked this post before ..
			$return_post_id=$_POST['like_post_id'];
			$return_like_status="dislike_btn";
			$message="You liked this post Before";
			$liked_berfore=1;
			$Account_like_info[]=array(
				"post_id"=>$return_post_id,
				"like_stauts"=>$return_like_status,
				"like_message"=>$message,
				"liked_berfore"=>$liked_berfore	
				);
			echo json_encode($Account_like_info, JSON_FORCE_OBJECT);
		}
			
	}else
	{
		//when some thing going wrong ...
		$return_post_id=$_POST['like_post_id'];
		$return_like_status="dislike_btn";
		$message="Something Going wrong plz try again ...";
		$liked_berfore=0;
		$Account_like_info[]=array(
			"post_id"=>$return_post_id,
			"like_stauts"=>$return_like_status,
			"like_message"=>$message,
			"liked_berfore"=>$liked_berfore	
			);
		echo json_encode($Account_like_info, JSON_FORCE_OBJECT);
	}
	
?>