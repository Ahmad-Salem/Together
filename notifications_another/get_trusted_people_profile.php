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

	$query_trusted_people="SELECT `id`,`account_followed_id`,`account_followed_type`,`date` FROM `following` WHERE `following_status`='0' AND `account_following_id`='$account_id' AND `account_following_type`='$account_type' LIMIT 99";
	$perform_trusted_people=mysqli_query($connect,$query_trusted_people);
	while($result_trusted=mysqli_fetch_assoc($perform_trusted_people))
	{	
		$datetime=$result_trusted['date'];
		$date=time_elapsed_string($datetime, $full = false);
		$account_id=$result_trusted['account_followed_id'];
		$account_type=$result_trusted['account_followed_type'];
		
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
				
				$trusted_account[]=array(
							"image"=>$image,
							"name"=>$Account_name,
							"account_type"=>"p",
							"gender"=>$account_gender,
							"account_id"=>$account_id,
							"date"=>$date
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

				$trusted_account[]=array(
							"image"=>$image,
							"name"=>$Account_name,
							"account_type"=>"f",
							"account_id"=>$account_id,
							"date"=>$date
							);	
			}


	}

	echo json_encode($trusted_account, JSON_FORCE_OBJECT);

?>	