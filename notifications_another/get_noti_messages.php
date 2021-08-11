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

	$query_messages="SELECT  messages.`group_hash`, `from_id`, `from_type`, `messages`, `msg_date`, `message_seen` FROM `messages` INNER JOIN `message_gruop` ON `message_gruop`.`hash`= `messages`.`group_hash` WHERE (`message_gruop`.`account_to_id`='$account_id' AND `message_gruop`.`account_to_type`='$account_type') OR (`message_gruop`.`account_from_id`='$account_id' AND `message_gruop`.`account_from_type`='$account_type') AND (`message_seen`='0') LIMIT 99";
	$perform_query_messages=mysqli_query($connect,$query_messages);

	while($result_messages=mysqli_fetch_assoc($perform_query_messages))
	{
		$datetime=$result_messages['msg_date'];
		$date=time_elapsed_string($datetime, $full = false);
		$account_id=$result_messages['from_id'];
		$account_type=$result_messages['from_type'];
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
				
				$messages=$result_messages['messages'];
				$hash=$result_messages['group_hash'];
				$msg_noti_body[]=array(
							"image"=>$image,
							"name"=>$Account_name,
							"account_type"=>"p",
							"gender"=>$account_gender,
							"account_id"=>$account_id,
							"date"=>$date,
							"msg_body"=>$messages,
							"hash"=>$hash
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

				$messages=$result_messages['messages'];
				$hash=$result_messages['group_hash'];
				$msg_noti_body[]=array(
							"image"=>$image,
							"name"=>$Account_name,
							"account_type"=>"f",
							"account_id"=>$account_id,
							"date"=>$date,
							"msg_body"=>$messages,
							"hash"=>$hash
							);	
			}


	}
		echo json_encode($msg_noti_body, JSON_FORCE_OBJECT);

?>