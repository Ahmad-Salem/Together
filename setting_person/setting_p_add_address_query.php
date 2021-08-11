<?php 
session_start();
include_once("../php_includes/connection_dp.php");

if(isset($_POST['up_add']))
{
	$user_id=$_COOKIE['user_id'];
	$address=mysqli_real_escape_string($connect,$_POST['address_field']);
	$query="UPDATE `users` SET `adderss`= '$address' WHERE id ='$user_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	if($perform_query)
	{
		$_SESSION['Success_Address_check']="true";
		$message=" Successfull Update :) ..";
		$_SESSION['message_p_edit_Address_profile']=$message;
		header("location: setting_p_add_address.php");
	}else{

		$_SESSION['Success_Address_check']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_p_edit_Address_profile']=$message;
		header("location: setting_p_add_address.php");
	}
}else{
		$_SESSION['Success_Address_check']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_p_edit_Address_profile']=$message;
		header("location: setting_p_add_address.php");
}

echo $_SESSION['Success_Address_check'];
?>