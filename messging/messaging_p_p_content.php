<?php
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/fun_rand_msg.php");
		$uid=mysqli_real_escape_string($connect,$_POST['uid']);
?>
	
	
<?php
	//check if the user has been started conversation or not ....
	$my_id=$_COOKIE['user_id'];
	$query_started_p_p="SELECT `hash` FROM `message_group_p_p` WHERE (`person_from`='$my_id' AND person_to='$uid') OR (person_from='$uid' AND person_to='$my_id') LIMIT 1";
	$perform_query_started_p_p=mysqli_query($connect,$query_started_p_p);
	
	echo $default_message="<h4 class=\"text-center\">default message before starting the conversation.</h4>";

	if(mysqli_num_rows($perform_query_started_p_p)==1)
	{
		//the conversation has been started
		//showing messages
		$result_started_p_p=mysqli_fetch_assoc($perform_query_started_p_p);
		$selected_hash=$result_started_p_p['hash'];
		$query_select_conv="SELECT `from_id` , `message`,`msg_date` FROM `messages_p_p` WHERE `group_hash`='$selected_hash'";
		$perform_query_conv=mysqli_query($connect,$query_select_conv);
		while($result_conv=mysqli_fetch_assoc($perform_query_conv))
		{
			$from_id=$result_conv['from_id'];
			$message=$result_conv['message'];
			$msg_date=format($result_conv['msg_date']);
			$query_username="SELECT `first_name`,`last_name`,`photo`,'gender' FROM `users` WHERE id = '$from_id' LIMIT 1";
			$perform_query_username=mysqli_query($connect,$query_username);
			$result_username=mysqli_fetch_assoc($perform_query_username);
			$username=$result_username['first_name']." ".$result_username['last_name'];
			if($result_username['gender']=='m')
			{
				if($result_username['photo']!=null)
				{
					$image=$image="../users/".$from_id."/".$result_username['photo'];
				}else{
					//default males photo
					$image="../images/profile_image/default-person.jpg";
				}

			}else{
				
				if($result_username['photo']!=null)
				{
					$image=$image="../users/".$from_id."/".$result_username['photo'];
				}else{
					//default female photo
					$image="../images/profile_image/user_profile_female.jpg";
				}
			}

			if($_COOKIE['user_id']==$from_id)
			{
				echo "
					<div class=\"friend-container\">
						<h6 class=\"text-center\">$msg_date</h6>
						<div class=\"chat self\">
							<div class=\"user-photo\"><img src=\"$image\"  title=\"Ahmad Salem\" /></div>
							<p class=\"chat-message\">$message</p>
						</div>
					</div>
					";
			}else{
				echo "
					<div class=\"friend-container\">
						<h6 class=\"text-center\">$msg_date</h6>
						<div class=\"chat friend\">
							<div class=\"user-photo\"><img src=\"$image\"  title=\"Ghazawy\" /></div>
							<p class=\"chat-message\">$message</p>
						</div>
					</div>
				";
			}
		}

	}else{
		
		//the conversation has been not started yet
		$my_id=$_COOKIE['user_id'];
		$message="Hello :) ";					
		$random_number=generate_rand_p_p();
		$query_start_p_p_group="INSERT INTO `message_group_p_p`(`person_from`, `person_to`, `hash`) VALUES ('$my_id','$uid','$random_number')";
		$query_start_p_p_msg="INSERT INTO `messages_p_p`( `group_hash`, `from_id`, `message`) VALUES ('$random_number','$my_id','$message')";
		$perform_query_start_p_p_group=mysqli_query($connect,$query_start_p_p_group);
		$perform_query_start_p_p_msg=mysqli_query($connect,$query_start_p_p_msg);
		if($perform_query_start_p_p_group)
		{

			if($perform_query_start_p_p_msg)
			{
				//write queries to show messages
				$result_started_p_p=mysqli_fetch_assoc($perform_query_started_p_p);
				$selected_hash=$result_started_p_p['hash'];
				$query_select_conv="SELECT `from_id` , `message`,`msg_date` FROM `messages_p_p` WHERE `group_hash`='$selected_hash'";
				$perform_query_conv=mysqli_query($connect,$query_select_conv);

				while($result_conv=mysqli_fetch_assoc($perform_query_conv))
				{
					$from_id=$result_conv['from_id'];
					$message=$result_conv['message'];
					$msg_date=format($result_conv['msg_date']);
					$query_username="SELECT `first_name`,`last_name`,`photo`,`gender` FROM `users` WHERE id = '$from_id' LIMIT 1";
					$perform_query_username=mysqli_query($connect,$query_username);
					$result_username=mysqli_fetch_assoc($perform_query_username);
					$username=$result_username['first_name']." ".$result_username['last_name'];

					if($result_username['gender']=='m')
					{
						if($result_username['photo']!=null)
						{
							$image=$image="../users/".$from_id."/".$result_username['photo'];
						}else{
							//default males photo
							$image="../images/profile_image/default-person.jpg";
						}

					}else{
						
						if($result_username['photo']!=null)
						{
							$image=$image="../users/".$from_id."/".$result_username['photo'];
						}else{
							//default female photo
							$image="../images/profile_image/user_profile_female.jpg";
						}
					}

					if($_COOKIE['user_id']==$from_id)
					{
						echo "
							<div class=\"friend-container\">
								<h6 class=\"text-center\">$msg_date</h6>
								<div class=\"chat self\">
									<div class=\"user-photo\"><img src=\"$image\"  title=\"Ahmad Salem\" /></div>
									<p class=\"chat-message\">$message</p>
								</div>
							</div>
							";
					}else{
						echo "
							<div class=\"friend-container\">
								<h6 class=\"text-center\">$msg_date</h6>
								<div class=\"chat friend\">
									<div class=\"user-photo\"><img src=\"$image\"  title=\"Ghazawy\" /></div>
									<p class=\"chat-message\">$message</p>
								</div>
							</div>
						";
					}
				}

			}else{
				echo "an error ocurred";
			}	

		
		}else{
			echo "an error ocurred";
		}
		
		

		
	}
?>	