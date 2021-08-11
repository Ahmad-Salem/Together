<?php 
session_start();
include_once("../php_includes/connection_dp.php");

if(isset($_POST['F_FAX']))
{
	$foundation_id=$_COOKIE['foundation_id'];
	$fax_num=$_POST['foundation_FAX'];
	$query="UPDATE `foundations` SET `fax`='$fax_num' WHERE id ='$foundation_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	if($perform_query)
	{
		$_SESSION['Success_Fax_check_f']="true";
		$message=" Successfull Update :) ..";
		$_SESSION['message_f_edit_fax_profile']=$message;
		header("location: setting_f_update_fax.php");
	}else{
		$_SESSION['Success_Fax_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_fax_profile']=$message;
		header("location: setting_f_update_fax.php");
	}
}else{
		$_SESSION['Success_Fax_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_fax_profile']=$message;
		header("location: setting_f_update_fax.php");
}


?>