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

	$query_messages="SELECT  messages.`group_hash`, `from_id`, `from_type`, `messages`, `msg_date`, `message_seen` FROM `messages` INNER JOIN `message_gruop` ON `message_gruop`.`hash`= `messages`.`group_hash` WHERE ((`message_gruop`.`account_to_id`='$account_id' AND `message_gruop`.`account_to_type`='$account_type') OR (`message_gruop`.`account_from_id`='$account_id' AND `message_gruop`.`account_from_type`='$account_type') ) AND (`message_seen`='0') LIMIT 99";
	$perform_query_messages=mysqli_query($connect,$query_messages);

	echo mysqli_num_rows($perform_query_messages);
?>