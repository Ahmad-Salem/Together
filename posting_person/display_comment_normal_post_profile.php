<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");
	if(isset($_POST['post_id']))
	{
		$post_id=$_POST['post_id'];
		$query_comment_normal_post="SELECT comments_normal_post.account_id, `comment`, `post_id`, comments_normal_post.date as `date` , comments_normal_post.account_type FROM `comments_normal_post` INNER JOIN `normal_posts` ON comments_normal_post.post_id = normal_posts.id WHERE comments_normal_post.post_id='$post_id' ";
		$perfrom_query_comment_normal_post=mysqli_query($connect,$query_comment_normal_post);
		while($result_comment=mysqli_fetch_assoc($perfrom_query_comment_normal_post))
		{
			 if($result_comment['account_type']=='p')
			 {
			 	//person
			 	$person_id=$result_comment['account_id'];
				$query_username="SELECT `first_name`, `last_name` , `gender` , `photo` FROM `users` WHERE `id`='$person_id' LIMIT 1";
				$perform_query_username=mysqli_query($connect,$query_username);
				$result_name=mysqli_fetch_assoc($perform_query_username);
				$Account_name=$result_name['first_name'].' '.$result_name['last_name'];
				$account_gender=$result_name['gender'];

				if($result_name['photo']==null)
				{
					if($result_name['gender']=='m')
					{	
						$image="images/profile_image/default-person.jpg";
					}else{
						$image="images/profile_image/user_profile_female.jpg";
					}

				}else{
					
					$image="users/".$person_id."/".$result_name['photo'];
				}
				
				$Account_info[]=array(
					"image"=>$image,
					"gender"=>$account_gender,
					"name"=>$Account_name,
					"account_type"=>"p",
					"account_id"=>$person_id,
					"post_id"=>$result_comment['post_id'],
					"comment"=>$result_comment['comment'],
					"date"=>time_elapsed_string($result_comment['date'], $full = false)
					);

			 }else if($result_comment['account_type']=='f')
			 {
			 	//foundation
				$foundation_id=$result_comments['account_id'];
				$query_username="SELECT `name` , `photo` FROM `foundations` WHERE `id`='$foundation_id' LIMIT 1";
				$perform_query_username=mysqli_query($connect,$query_username);
				$result_name=mysqli_fetch_assoc($perform_query_username);
				$Account_name=$result_name['name'];

				if($result_name['photo']==null)
				{
					$image="images/profile_image/default-academy.jpg";
				}else
				{
					$image="foundations/".$foundation_id."/".$result_name['photo'];
				}

				$Account_info[]=array(
					"image"=>$image,
					"name"=>$Account_name,
					"account_type"=>"f",
					"account_id"=>$foundation_id,
					"post_id"=>$result_comment['post_id'],
					"comment"=>$result_comment['comment'],
					"date"=>time_elapsed_string($result_comment['date'], $full = false)
					);
	
			 }

			 
		}
			echo json_encode($Account_info, JSON_FORCE_OBJECT);
		 	json_encode($result_comment, JSON_FORCE_OBJECT);
		
	}

?>
