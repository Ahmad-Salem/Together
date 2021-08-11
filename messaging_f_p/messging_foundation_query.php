<?php
	include_once("../php_includes/connection_dp.php");

	$messsage_input=mysqli_real_escape_string($connect,$_POST['message']);
	$fid=mysqli_real_escape_string($connect,$_POST['fid']);
	$my_id=$_COOKIE['foundation_id'];

	$query_select_hash="SELECT `hash` FROM `message_group_f_f` WHERE (`foundation_from`='$my_id' AND foundation_to='$fid') OR (foundation_from='$fid' AND foundation_to='$my_id') LIMIT 1";
	$perform_query_select_hash=mysqli_query($connect,$query_select_hash);
	$result_hash=mysqli_fetch_assoc($perform_query_select_hash);
	$hash=$result_hash['hash'];
	define("PRIVATE_HASH", $hash);
	
	
	
	$query_message="INSERT INTO `messages_f_f`(`group_hash`, `from_id`, `message`) VALUES ('".PRIVATE_HASH."','$my_id','$messsage_input')";
	$perform_query_message=mysqli_query($connect,$query_message);

	if($perform_query_message)
	{
		$query_info="SELECT `name`,`photo` FROM `foundations` WHERE `id` = '$my_id' LIMIT 1";
		$perform_query_info=mysqli_query($connect,$query_info);
		$result_info=mysqli_fetch_assoc($perform_query_info);
		
		if($result_info['photo']!=null)
			{
				$image="../foundations/".$my_id."/".$result_info['photo'];
			}else{
				//default image 
				$image="../images/profile_image/default-academy.jpg";
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