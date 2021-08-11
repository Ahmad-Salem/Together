<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");
	if (isset($_POST['get_like_post_id'])) {
		
		$post_id=$_POST['get_like_post_id'];
		$query_get_accounts="SELECT  `account_id`, `date`, `account_type` FROM `likes_person_normal_post` WHERE `post_id`='$post_id' ";
		$perform_query_get_accounts=mysqli_query($connect,$query_get_accounts);
		while($result_get_accounts=mysqli_fetch_assoc($perform_query_get_accounts))
		{
			if($result_get_accounts['account_type']=='p')
			{	
				//person
			 	$person_id=$result_get_accounts['account_id'];
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
				
				$liked_account[]=array(
							"image"=>$image,
							"name"=>$Account_name,
							"account_type"=>"p",
							"gender"=>$account_gender,
							"account_id"=>$person_id,
							"date"=>time_elapsed_string($result_get_accounts['date'], $full = false)
							);


			}else
			{
				//foundation
				$foundation_id=$result_get_accounts['account_id'];
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

				$liked_account[]=array(
							"image"=>$image,
							"name"=>$Account_name,
							"account_type"=>"f",
							"account_id"=>$foundation_id,
							"date"=>time_elapsed_string($result_get_accounts['date'], $full = false)
							);	
			}

			
		}
		echo json_encode($liked_account, JSON_FORCE_OBJECT);

	
	}
	
?>