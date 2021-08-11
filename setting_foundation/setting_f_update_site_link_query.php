<?php 
session_start();
include_once("../php_includes/connection_dp.php");

if(isset($_POST['site_f']))
{
	$foundation_id=$_COOKIE['foundation_id'];
	$site=$_POST['foundation_Site'];
	$query="UPDATE `foundations` SET `site_link`='$site' WHERE id ='$foundation_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	if($perform_query)
	{
		$_SESSION['Success_Site_check_f']="true";
		$message=" Successfull Update :) ..";
		$_SESSION['message_f_edit_site_profile']=$message;
		header("location: setting_f_update_site_link.php");
	}else{
		$_SESSION['Success_Site_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_site_profile']=$message;
		header("location: setting_f_update_site_link.php");
	}
}else{
		$_SESSION['Success_Site_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_edit_site_profile']=$message;
		header("location: setting_f_update_site_link.php");
}


?>