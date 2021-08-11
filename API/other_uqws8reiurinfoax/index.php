<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_Action']=='other_user_information')
	{
		if(isset($_POST['profile_type'])&&isset($_POST['account_id'])&&isset($_POST['account_type'])&&isset($_POST['other_account_id'])&&isset($_POST['other_account_type']))
		{
			if($_POST['profile_type']=="other_users")
			{
				$other_account_id=$_POST['other_account_id'];
				$other_account_type=$_POST['other_account_type'];
				$account_id=$_POST['account_id'];
				$account_type=$_POST['account_type'];
				if($other_account_type=='p')
				{
					$query_other_users="SELECT  `first_name`, `last_name`, `gender`, `photo`, `description`, `blue_mark`, `info_completion` FROM `users` WHERE `id`='$other_account_id' LIMIT 1";
					$perform_query_other_users=mysqli_query($connect,$query_other_users);

					$result=mysqli_fetch_assoc($perform_query_other_users);
					
					$username=$result['first_name'].' '.$result['last_name'];
					$user_photo=$result['photo'];
					$other_description=$result['description'];
					$other_blue_mark=$result['blue_mark'];
					$other_info_completion=$result['info_completion'];
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

					//select to know weather the users trusted or not 
					$query_other_users_trusted="SELECT `id` FROM `following` WHERE `account_followed_id`='$account_id' AND `account_followed_type`='$account_type' AND `account_following_id`='$other_account_id' AND `account_following_type`='$other_account_type' LIMIT 1";
					$perform_query_other_users_trusted=mysqli_query($connect,$perform_query_other_users_trusted);
					if(mysqli_num_rows($perform_query_other_users_trusted)>=1)
						{$trusted='1';}else{$trusted='0';}
					
					$other_user_information =array(
						"other_account_id"=>$other_account_id,
						"other_account_type"=>$other_account_type,
						"other_username"=>$username,
						"other_image"=>$image,
						"other_description"=>$other_description,
						"other_blue_mark"=>$other_blue_mark,
						"other_info_completion"=>$other_info_completion,
						"trusted"=>$trusted
						);

				}else if($other_account_type=='f')
				{
					$query_other_users="SELECT  `name`, `photo`, `description`, `blue_mark`, `info_completion` FROM `foundations` WHERE `id`='$other_account_id' LIMIT 1";
					$perform_query_other_users=mysqli_query($connect,$query_other_users);
					
					$result=mysqli_fetch_assoc($perform_normal_info);
							
					$username=$result['name'];
					$other_description=$result['description'];
					$other_blue_mark=$result['blue_mark'];
					$other_info_completion=$result['info_completion'];
					$user_photo=$result['photo'];
				
					if($user_photo==null)
					{
						$image="http://together.gsg-xpro.com/root/images/profile_image/default-academy.jpg";
						
					}else
					{
							//default..
							$image="http://together.gsg-xpro.com/root/foundations/$user_id/$user_photo";
					}

					//select to know weather the users trusted or not 
					$query_other_users_trusted="SELECT `id` FROM `following` WHERE `account_followed_id`='$account_id' AND `account_followed_type`='$account_type' AND `account_following_id`='$other_account_id' AND `account_following_type`='$other_account_type' LIMIT 1";
					$perform_query_other_users_trusted=mysqli_query($connect,$perform_query_other_users_trusted);
					if(mysqli_num_rows($perform_query_other_users_trusted)>=1)
						{$trusted='1';}else{$trusted='0';}
					
					$other_user_information =array(
						"other_account_id"=>$other_account_id,
						"other_account_type"=>$other_account_type,
						"other_username"=>$username,
						"other_image"=>$image,
						"other_description"=>$other_description,
						"other_blue_mark"=>$other_blue_mark,
						"other_info_completion"=>$other_info_completion,
						"trusted"=>$trusted
						);


				}

				echo json_encode($other_user_information,JSON_FORCE_OBJECT);
				
			}
		}
	}

?>	