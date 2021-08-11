<?php
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/fun_rand_msg.php");
	$fid=mysqli_real_escape_string($connect,$_POST['fid']);
?>
	
	
<?php
	//check if the user has been started conversation or not ....
	$my_id=$_COOKIE['foundation_id'];
	$query_started_f_f="SELECT `hash` FROM `message_group_f_f` WHERE (`foundation_from`='$my_id' AND foundation_to='$fid') OR (foundation_from='$fid' AND foundation_to='$my_id') LIMIT 1";
	$perform_query_started_f_f=mysqli_query($connect,$query_started_f_f);
	
	echo $default_message="<h4 class=\"text-center\">default message before starting the conversation.</h4>";

	if(mysqli_num_rows($perform_query_started_f_f)==1)
	{
		//the conversation has been started
		//showing messages
		$result_started_f_f=mysqli_fetch_assoc($perform_query_started_f_f);
		$selected_hash=$result_started_f_f['hash'];
		$query_select_conv="SELECT `from_id` , `message`,`msg_date` FROM `messages_f_f` WHERE `group_hash`='$selected_hash'";
		$perform_query_conv=mysqli_query($connect,$query_select_conv);
		while($result_conv=mysqli_fetch_assoc($perform_query_conv))
		{
			$from_id=$result_conv['from_id'];
			$message=$result_conv['message'];
			$msg_date=format($result_conv['msg_date']);
			$query_foundationname="SELECT `name`,`photo` FROM `foundations` WHERE id = '$from_id' LIMIT 1";
			$perform_query_foundationname=mysqli_query($connect,$query_foundationname);
			$result_foundationname=mysqli_fetch_assoc($perform_query_foundationname);
			$foundationname=$result_foundationname['name'];
			
			if($result_foundationname['photo']!=null)
			{
				$image="../foundations/".$from_id."/".$result_foundationname['photo'];
			}else{
				//default image 
				$image="../images/profile_image/default-academy.jpg";
			}

			if($_COOKIE['foundation_id']==$from_id)
			{
				echo "
					<div class=\"friend-container\">
						<h6 class=\"text-center\">$msg_date</h6>
						<div class=\"chat self\">
							<div class=\"user-photo\"><img src=\"$image\"  title=\"$foundationname\" /></div>
							<p class=\"chat-message\">$message</p>
						</div>
					</div>
					";
			}else{
				echo "
					<div class=\"friend-container\">
						<h6 class=\"text-center\">$msg_date</h6>
						<div class=\"chat friend\">
							<div class=\"user-photo\"><img src=\"$image\"  title=\"$foundationname\" /></div>
							<p class=\"chat-message\">$message</p>
						</div>
					</div>
				";
			}
		}

	}else{
		
		//the conversation has been not started yet
		$my_id=$_COOKIE['foundation_id'];
		$message="Hello :) ";					
		$random_number=generate_rand_f_f();
		$query_start_f_f_group="INSERT INTO `message_group_f_f`(`foundation_from`, `foundation_to`, `hash`) VALUES ('$my_id','$fid','$random_number')";
		$query_start_f_f_msg="INSERT INTO `messages_f_f`( `group_hash`, `from_id`, `message`) VALUES ('$random_number','$my_id','$message')";
		$perform_query_start_f_f_group=mysqli_query($connect,$query_start_f_f_group);
		$perform_query_start_f_f_msg=mysqli_query($connect,$query_start_f_f_msg);
		if($perform_query_start_f_f_group)
		{

			if($perform_query_start_f_f_msg)
			{
				//write queries to show messages
				$result_started_f_f=mysqli_fetch_assoc($perform_query_started_f_f);
				$selected_hash=$result_started_f_f['hash'];
				$query_select_conv="SELECT `from_id` , `message`,`msg_date` FROM `messages_f_f` WHERE `group_hash`='$selected_hash'";
				$perform_query_conv=mysqli_query($connect,$query_select_conv);

				while($result_conv=mysqli_fetch_assoc($perform_query_conv))
				{
					$from_id=$result_conv['from_id'];
					$message=$result_conv['message'];
					$msg_date=format($result_conv['msg_date']);
					$query_foundationname="SELECT `name`,`photo` FROM `foundations` WHERE id = '$from_id' LIMIT 1";
					$perform_query_foundationname=mysqli_query($connect,$query_foundationname);
					$result_foundationname=mysqli_fetch_assoc($perform_query_foundationname);
					$foundationname=$result_foundationname['name'];

					if($result_foundationname['photo']!=null)
					{
						$image="../foundations/".$from_id."/".$result_foundationname['photo'];
					}else{
						//default image 
						$image="../images/profile_image/default-academy.jpg";
					}


					if($_COOKIE['foundation_id']==$from_id)
					{
						echo "
							<div class=\"friend-container\">
								<h6 class=\"text-center\">$msg_date</h6>
								<div class=\"chat self\">
									<div class=\"user-photo\"><img src=\"$image\"  title=\"$foundationname\" /></div>
									<p class=\"chat-message\">$message</p>
								</div>
							</div>
							";
					}else{
						echo "
							<div class=\"friend-container\">
								<h6 class=\"text-center\">$msg_date</h6>
								<div class=\"chat friend\">
									<div class=\"user-photo\"><img src=\"$image\"  title=\"$foundationname\" /></div>
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