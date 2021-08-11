<?php 
session_start();
include_once("../php_includes/connection_dp.php");

if(isset($_POST['update_foundation_btn']))
{
	$foundation_id=$_COOKIE['foundation_id'];
	$address=mysqli_real_escape_string($connect,$_POST['address_field']);
	$query="UPDATE `foundations` SET `address`='$address'  WHERE id ='$foundation_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	if($perform_query)
	{
		$_SESSION['Success_Address_check_f']="true";
		$message=" Successfull Update :) ..";
		$_SESSION['message_f_edit_Address_profile']=$message;
		header("location: setting_f_update_address.php");
	}else{

		$_SESSION['Success_Address_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_Address_profile']=$message;
		header("location: setting_f_update_address.php");
	}
}else{
		$_SESSION['Success_Address_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_Address_profile']=$message;
		header("location: setting_f_update_address.php");
}


?>