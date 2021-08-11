<?php 
session_start();
include_once("../php_includes/connection_dp.php");

if(isset($_POST['U_TEL']))
{
	$foundation_id=$_COOKIE['foundation_id'];
	$tel_num=$_POST['foundation_telephone_Num'];
	$query="UPDATE `foundations` SET `telephone_number1`='$tel_num' WHERE id ='$foundation_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	if($perform_query)
	{
		$_SESSION['Success_Tel_check_f']="true";
		$message=" Successfull Update :) ..";
		$_SESSION['message_f_edit_Tel_profile']=$message;
		header("location: setting_f_update_telephone.php");
	}else{
		$_SESSION['Success_Tel_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_Tel_profile']=$message;
		header("location: setting_f_update_telephone.php");
	}
}else{
		$_SESSION['Success_Tel_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_Tel_profile']=$message;
		header("location: setting_f_update_telephone.php");
}


?>