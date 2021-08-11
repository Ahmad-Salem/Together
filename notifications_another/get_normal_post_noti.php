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

	$query_normal_post="SELECT `id`, `account_id`, `account_type` , `date` FROM `normal_posts`";
	$perform_query_normal_post=mysqli_query($connect,$query_normal_post);

	
	
	while($result_normal=mysqli_fetch_assoc($perform_query_normal_post))
	{
		$account_id_check=$result_normal['account_id'];
		$account_type_check=$result_normal['account_type'];
		$request_id_check=$result_normal['id'];
		
		$query_normal_post_seen="SELECT `normal_post_id`,`account_id`,`account_type` FROM  `normal_post_noti_seen` WHERE `account_id`='$account_id_check' AND `account_type`='$account_type_check' AND `normal_post_id`='$request_id_check' ";	
		$perform_query_normal_post_seen=mysqli_query($connect,$query_normal_post_seen);
		
		if(mysqli_num_rows($perform_query_normal_post_seen)==0)
		{
			
				
					$datetime=$result_normal['date'];
					$date=time_elapsed_string($datetime, $full = false);
					$account_id=$result_normal['account_id'];
					$account_type=$result_normal['account_type'];


					if($account_type=='p')
					{	
						//person
						$query_username="SELECT `first_name`, `last_name` , `gender` , `photo` FROM `users` WHERE `id`='$account_id' LIMIT 1";
						$perform_query_username=mysqli_query($connect,$query_username);
						$result_name=mysqli_fetch_assoc($perform_query_username);
						$Account_name=$result_name['first_name'].' '.$result_name['last_name'];
						$account_gender=$result_name['gender'];

						if($result_name['photo']==null)
						{
							if($result_name['gender']=='m')
							{	
								$image="../images/profile_image/default-person.jpg";
							}else{
								$image="../images/profile_image/user_profile_female.jpg";
							}

						}else{
							
							$image="../users/".$account_id."/".$result_name['photo'];
						}
						
						
						$normal_post_id=$result_normal['id'];
						$query_num_comments="SELECT `id` FROM `comments_normal_post` WHERE  `post_id`='$normal_post_id'";
						$perform_query_num_comments=mysqli_query($connect,$query_num_comments);
						$number_of_comments=mysqli_num_rows($perform_query_num_comments);

						$query_num_likes="SELECT `id`FROM `likes_normal_post` WHERE  `post_id`='$normal_post_id' ";
						$perform_query_num_likes=mysqli_query($connect,$query_num_likes);
						$number_of_likes=mysqli_num_rows($perform_query_num_likes);

						
						$normal_noti_body[]=array(
									"image"=>$image,
									"name"=>$Account_name,
									"account_type"=>"p",
									"gender"=>$account_gender,
									"account_id"=>$account_id,
									"date"=>$date,
									"normal_post_id"=>$normal_post_id,
									"likes"=>$number_of_likes,
									"comments"=>$number_of_comments
									);	



					}else if($account_type=='f')
					{
						//foundation
						$query_username="SELECT `name` , `photo` FROM `foundations` WHERE `id`='$account_id' LIMIT 1";
						$perform_query_username=mysqli_query($connect,$query_username);
						$result_name=mysqli_fetch_assoc($perform_query_username);
						$Account_name=$result_name['name'];

						if($result_name['photo']==null)
						{
							$image="../images/profile_image/default-academy.jpg";
						}else
						{
							$image="../foundations/".$account_id."/".$result_name['photo'];
						}

						$normal_post_id=$result_normal['id'];
						$query_num_comments="SELECT `id` FROM `comments_normal_post` WHERE  `post_id`='$normal_post_id'";
						$perform_query_num_comments=mysqli_query($connect,$query_num_comments);
						$number_of_comments=mysqli_num_rows($perform_query_num_comments);

						$query_num_likes="SELECT `id`FROM `likes_normal_post` WHERE  `post_id`='$normal_post_id' ";
						$perform_query_num_likes=mysqli_query($connect,$query_num_likes);
						$number_of_likes=mysqli_num_rows($perform_query_num_likes);

						
						$normal_noti_body[]=array(
									"image"=>$image,
									"name"=>$Account_name,
									"account_type"=>"f",
									"account_id"=>$account_id,
									"date"=>$date,
									"normal_post_id"=>$normal_post_id,
									"likes"=>$number_of_likes,
									"comments"=>$number_of_comments
									);	
					}


				
		}else
		{
			//do nothing ...	
		}//end else
		
		
	}// end while

	
		echo json_encode($normal_noti_body, JSON_FORCE_OBJECT);

?>