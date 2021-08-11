<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_action']=='another_account_profile')
	{
		if(isset($_POST['another_account_id'])&&isset($_POST['another_account_type'])&&isset($_POST['account_id'])&&isset($_POST['account_type']))
		{
			$another_account_id=$_POST['another_account_id'];
			$another_account_type=$_POST['another_account_type'];
			$account_id=$_POST['account_id'];
			$account_type=$_POST['account_type'];

			if($another_account_type=='p')
			{
				$query_another_account_info="SELECT  `first_name`, `last_name`, `gender`, `photo`, `description`, `user_level`, `info_completion` FROM `users` WHERE `id`='$another_account_id' LIMIT 1";
				$perform_query_another_account_info=mysqli_query($connect,$query_another_account_info);

				$result_info=mysqli_fetch_assoc($perform_query_another_account_info);
				$account_username=$result_info['first_name'].' '.$result_info['last_name'];
				$gender=$result_info['gender'];
				$account_photo=$result_info['photo'];
				$account_description=$result_info['description'];
				$account_level=$result_info['user_level'];
				$account_info_com=$result_info['info_completion'];

				if($account_photo==null)
				{
					//check for gender
					if($gender=='m')
					{
						//male
						$image="http://together.gsg-xpro.com/root/images/profile_image/default-person.jpg";
					}else if($gender=='f')
					{
						//female
						$image="http://together.gsg-xpro.com/root/images/profile_image/user_profile_female.jpg";
					}
					
				}else
				{
						//default..
						$image="http://together.gsg-xpro.com/root/users/$user_id/$account_photo";
				}


				$query_num_trusted="SELECT `id` FROM `following` WHERE `account_following_id`='$another_account_id' AND  `account_following_type`='$another_account_type' ";
				$perform_query_num_trusted=mysqli_query($connect,$query_num_trusted);
				if(mysqli_num_rows($perform_query_num_trusted)!=0)
				{
					$num_trusted=mysqli_num_rows($perform_query_num_trusted);

				}else
				{
					$num_trusted=0;
				}
				
				$query_num_trusting="SELECT `id` FROM `following` WHERE `account_followed_id`='$another_account_id' AND `account_followed_type`='$another_account_type' ";
				$perform_query_num_trusting=mysqli_query($connect,$query_num_trusting);
				if(mysqli_num_rows($perform_trusting)!=0)
				{
					$num_trusting=mysqli_num_rows($perform_trusting);	
				}else
				{
					$num_trusting=0;
				}
				
				$query_num_posts="SELECT `id` FROM `normal_posts` WHERE `account_id`='$another_account_id' AND `account_type`='$another_account_type'";
				$perform_query_num_posts=mysqli_query($connect,$query_num_posts);
				if(mysqli_num_rows($perform_query_num_posts)!=0)
				{
					$num_posts=mysqli_num_rows($perform_query_num_posts);
				}else
				{
					$num_posts=0;
				}
				
				//select to know weather the users trusted or not 
				$query_other_users_trusted="SELECT `id` FROM `following` WHERE `account_followed_id`='$account_id' AND `account_followed_type`='$account_type' AND `account_following_id`='$another_account_id' AND `account_following_type`='$another_account_type' LIMIT 1";
				$perform_query_other_users_trusted=mysqli_query($connect,$perform_query_other_users_trusted);
				
				if(mysqli_num_rows($perform_query_other_users_trusted)>=1)
					{$trusted='1';}else{$trusted='0';}
				
				
				$account_info=array(
					"account_id"=>$another_account_id,
					"account_type"=>$another_account_type,
					"account_username"=>$account_username,
					"gender"=>$gender,
					"account_photo"=>$account_photo,
					"account_description"=>$account_description,
					"account_level"=>$account_level,
					"account_info_com"=>$account_info_com,
					"num_posts"=>$num_posts,
					"trusted"=>$num_trusted,
					"trusting"=>$num_trusting,
					"trusted_btn"=>$trusted
					);

			}else if($another_account_type=='f')
			{
				$query_another_account_info="SELECT  `name`, `photo`, `description`, `user_level`, `info_completion` FROM `foundations` WHERE `id`='$another_account_id' LIMIT 1";
				$perform_query_another_account_info=mysqli_query($connect,$query_another_account_info);
				$result_info=mysqli_fetch_assoc($perform_query_another_account_info);
				$account_username=$result_info['name'];
				$account_photo=$result_info['photo'];
				$account_description=$result_info['description'];
				$account_level=$result_info['user_level'];
				$account_info_com=$result_info['info_completion'];

				if($account_photo==null)
				{
					$image="http://together.gsg-xpro.com/root/images/profile_image/default-academy.jpg";
					
				}else
				{
					//default..
					$image="http://together.gsg-xpro.com/root/foundations/$user_id/$account_photo";
				}



				$query_num_trusted="SELECT `id` FROM `following` WHERE `account_following_id`='$another_account_id' AND  `account_following_type`='$another_account_type' ";
				$perform_query_num_trusted=mysqli_query($connect,$query_num_trusted);
				if(mysqli_num_rows($perform_query_num_trusted)!=0)
				{
					$num_trusted=mysqli_num_rows($perform_query_num_trusted);

				}else
				{
					$num_trusted=0;
				}
				
				$query_num_trusting="SELECT `id` FROM `following` WHERE `account_followed_id`='$another_account_id' AND `account_followed_type`='$another_account_type' ";
				$perform_query_num_trusting=mysqli_query($connect,$query_num_trusting);
				if(mysqli_num_rows($perform_trusting)!=0)
				{
					$num_trusting=mysqli_num_rows($perform_trusting);	
				}else
				{
					$num_trusting=0;
				}
				
				$query_num_posts="SELECT `id` FROM `normal_posts` WHERE `account_id`='$another_account_id' AND `account_type`='$another_account_type'";
				$perform_query_num_posts=mysqli_query($connect,$query_num_posts);
				if(mysqli_num_rows($perform_query_num_posts)!=0)
				{
					$num_posts=mysqli_num_rows($perform_query_num_posts);
				}else
				{
					$num_posts=0;
				}

				//select to know weather the users trusted or not 
				$query_other_users_trusted="SELECT `id` FROM `following` WHERE `account_followed_id`='$account_id' AND `account_followed_type`='$account_type' AND `account_following_id`='$another_account_id' AND `account_following_type`='$another_account_type' LIMIT 1";
				$perform_query_other_users_trusted=mysqli_query($connect,$perform_query_other_users_trusted);
				
				if(mysqli_num_rows($perform_query_other_users_trusted)>=1)
					{$trusted='1';}else{$trusted='0';}





				$account_info=array(
					"account_id"=>$another_account_id,
					"account_type"=>$another_account_type,
					"account_username"=>$account_username,
					"account_photo"=>$image,
					"account_description"=>$account_description,
					"account_level"=>$account_level,
					"account_info_com"=>$account_info_com,
					"num_posts"=>$num_posts,
					"trusted"=>$num_trusted,
					"trusting"=>$num_trusting,
					"trusted_btn"=>$trusted
					);
			}
			
			echo json_encode($account_info,JSON_FORCE_OBJECT);
		}
	}

?>