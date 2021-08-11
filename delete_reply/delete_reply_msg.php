<?php
	session_start();
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	
	if(isset($_GET['re_no']))
	{
		$re_no=$_GET['re_no'];
		$query_delete_reply="DELETE FROM `reply_contactus` WHERE `id`='$re_no' LIMIT 1";
		$perform_delete_reply=mysqli_query($connect,$query_delete_reply);
		if($perform_delete_reply)
		{
			$_SESSION['Success_reply_check']="true";
			$message=" Successfull Deletion :) ..";
			$_SESSION['message_reply_profile']=$message;
			header("location: ../profile.php");
		}else
		{
			$_SESSION['Success_reply_check']="false";
			$message=" Deletion Failed :( ..";
			$_SESSION['message_reply_profile']=$message;
			header("location: ../profile.php");
		}
	}else
	{
		$_SESSION['Success_reply_check']="false";
		$message=" Deletion Failed :( ..";
		$_SESSION['message_reply_profile']=$message;
		header("location: ../profile.php");
	}
	


?>