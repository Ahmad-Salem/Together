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

	$query_request_post="SELECT `id`, `account_id`, `account_type` , `date` FROM `request_post`";
	$perform_query_request_post=mysqli_query($connect,$query_request_post);

	
	
	while($result_request=mysqli_fetch_assoc($perform_query_request_post))
	{
		$account_id_check=$result_request['account_id'];
		$account_type_check=$result_request['account_type'];
		$request_id_check=$result_request['id'];
		
		$query_request_post_seen="SELECT `request_id`,`account_id`,`account_type` FROM  `request_post_noti_seen` WHERE `account_id`='$account_id_check' AND `account_type`='$account_type_check' AND `request_id`='$request_id_check' ";	
		$perform_query_request_post_seen=mysqli_query($connect,$query_request_post_seen);
		
		if(mysqli_num_rows($perform_query_request_post_seen)==0)
		{
			
				
					$datetime=$result_request['date'];
					$date=time_elapsed_string($datetime, $full = false);
					$account_id=$result_request['account_id'];
					$account_type=$result_request['account_type'];


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
								$image="images/profile_image/default-person.jpg";
							}else{
								$image="images/profile_image/user_profile_female.jpg";
							}

						}else{
							
							$image="users/".$account_id."/".$result_name['photo'];
						}
						
						
						$request_id=$result_request['id'];
						$request_noti_body[]=array(
									"image"=>$image,
									"name"=>$Account_name,
									"account_type"=>"p",
									"gender"=>$account_gender,
									"account_id"=>$account_id,
									"date"=>$date,
									"request_id"=>$request_id
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
							$image="images/profile_image/default-academy.jpg";
						}else
						{
							$image="foundations/".$account_id."/".$result_name['photo'];
						}

						$request_id=$result_request['id'];
						$request_noti_body[]=array(
									"image"=>$image,
									"name"=>$Account_name,
									"account_type"=>"f",
									"account_id"=>$account_id,
									"date"=>$date,
									"request_id"=>$request_id
									);	
					}


				
		}else
		{
			//do nothing ...	
		}//end else
		
		
	}// end while

	
		echo json_encode($request_noti_body, JSON_FORCE_OBJECT);

?>