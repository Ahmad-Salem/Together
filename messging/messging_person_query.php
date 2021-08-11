<?php
	include_once("../php_includes/connection_dp.php");

	$messsage_input=mysqli_real_escape_string($connect,$_POST['message']);
	$uid=mysqli_real_escape_string($connect,$_POST['uid']);
	$my_id=$_COOKIE['user_id'];

	$query_select_hash="SELECT `hash` FROM `message_group_p_p` WHERE (`person_from`='$my_id' AND person_to='$uid') OR (person_from='$uid' AND person_to='$my_id') LIMIT 1";
	$perform_query_select_hash=mysqli_query($connect,$query_select_hash);
	$result_hash=mysqli_fetch_assoc($perform_query_select_hash);
	$hash=$result_hash['hash'];
	define("PRIVATE_HASH", $hash);
	
	
	
	$query_message="INSERT INTO `messages_p_p`(`group_hash`, `from_id`, `message`) VALUES ('".PRIVATE_HASH."','$my_id','$messsage_input')";
	$perform_query_message=mysqli_query($connect,$query_message);

	if($perform_query_message)
	{
		$query_info="SELECT `first_name`,`last_name`,`photo`,`gender` FROM `users` WHERE `id` = '$my_id' LIMIT 1";
		$perform_query_info=mysqli_query($connect,$query_info);
		$result_info=mysqli_fetch_assoc($perform_query_info);
		if($result_info['gender']=='m')
						{
							if($result_info['photo']!=null)
							{
								$image="../users/".$my_id."/".$result_info['photo'];
							}else{
								//default image for males
								$image="../images/profile_image/default-person.jpg";
							}

						}else{
							if($result_info['photo']!=null)
							{
								$image="../users/".$my_id."/".$result_info['photo'];
							}else{
								//default image for females
								$image="../images/profile_image/user_profile_female.jpg";
							}
						}

		// echo "
		// 		<div class=\"friend-container\">
		// 		<h6 class=\"text-center\">10am ,may/2016</h6>
		// 		<div class=\"chat self\">
		// 			<div class=\"user-photo\"><img src=\"$image\"  title=\"".$result_info['first_name']." ".$result_info['last_name']."\" /></div>
		// 			<p class=\"chat-message\">$messsage_input</p>
		// 		</div>
		// 		</div>
		// 	";	
		echo "<input type=\"hidden\" value=\"".PRIVATE_HASH."\" id=\"hash_msg\" /> ";  	
	}else{

		echo "An error Occured";
	}
	

?>