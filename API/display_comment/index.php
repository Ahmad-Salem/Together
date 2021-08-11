<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");


	if($_POST['do_action']=='display_comments')
	{
		if(isset($_POST['post_id']))
		{
			$post_id=$_POST['post_id'];

			$query_num_comment="SELECT `account_id`, `account_type`, `comment`, `date` FROM `comments_normal_post` WHERE  `post_id`='$post_id'";
			$perform_query_num_comment=mysqli_query($connect,$query_num_comment);
			while($result_com=mysqli_fetch_assoc($perform_query_num_comment))
			{
				$user_id=$result_com['account_id'];
				$comment_value=$result_com['comment'];
				$date=time_elapsed_string($result_com['date']);
				if($result_com['account_type']=='p')
						{

							$query_user_info="SELECT `first_name`, `last_name` , `photo` ,`gender` FROM `users` WHERE `id` = '$user_id' LIMIT 1";
						
							$perform_normal_info=mysqli_query($connect,$query_user_info);
							$result=mysqli_fetch_assoc($perform_normal_info);
							
							$username=$result['first_name'].' '.$result['last_name'];
							$user_photo=$result['photo'];
							$gender=$result['gender'];
							if($user_photo==null)
							{
								//check for gender
								if($gender=='m')
								{
									//male
									$image="http://together.gsg-xpro.com/root/images/profile_image/default-person.jpg";
								}else
								{
									//female
									$image="http://together.gsg-xpro.com/root/images/profile_image/user_profile_female.jpg";
								}
								
							}else
							{
									//default..
									$image="http://together.gsg-xpro.com/root/users/$user_id/$user_photo";
							}
						}
						else if($result_com['account_type']=='f')
						{
							//foundation 

							$query_foundation_info="SELECT `name` , `photo`  FROM `foundations` WHERE `id` = '$user_id' LIMIT 1";
						
							$perform_normal_info=mysqli_query($connect,$query_foundation_info);
							$result=mysqli_fetch_assoc($perform_normal_info);
							
							$username=$result['name'];
							$user_photo=$result['photo'];
						
							if($user_photo==null)
							{
								$image="http://together.gsg-xpro.com/root/images/profile_image/default-academy.jpg";
								
							}else
							{
									//default..
									$image="http://together.gsg-xpro.com/root/foundations/$user_id/$user_photo";
							}

						}
			}

			$comments_arr=array(
				"account_image"=>$image,
				"comment_value"=>$comment_value,
				"date"=>$date,
				"name"=>$username,
				);

			echo json_encode($comments_arr,JSON_FORCE_OBJECT);
		}
	}
?>