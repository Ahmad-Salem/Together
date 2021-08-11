<?php 
session_start();
include_once("../php_includes/connection_dp.php");

if(isset($_POST['update_tel']))
{
	$user_id=$_COOKIE['user_id'];
	$tel_num=$_POST['up_tel'];
	$query="UPDATE `users` SET `telephone_number1`= '$tel_num' WHERE id ='$user_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	if($perform_query)
	{
		$_SESSION['Success_Tel_check']="true";
		$message=" Successfull Update :) ..";
		$_SESSION['message_p_edit_Tel_profile']=$message;
		header("location: setting_p_add_tel.php");
	}else{
		$_SESSION['Success_Tel_check']="true";
		$message=" Update Failed :( ..";
		$_SESSION['message_p_edit_Tel_profile']=$message;
		header("location: setting_p_add_tel.php");
	}
}else{
		$_SESSION['Success_Tel_check']="true";
		$message=" Update Failed :( ..";
		$_SESSION['message_p_edit_Tel_profile']=$message;
		header("location: setting_p_add_tel.php");
}


?>