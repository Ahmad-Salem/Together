<?php 
session_start();
include_once("../php_includes/connection_dp.php");
include_once("../php_includes/rand.php");

if(isset($_POST['update_pass_f']))
{
	$password=$_POST['update_pass_f_new'];
	$repassword=$_POST['update_pass_f_re_new'];
	
	if($password==$repassword)
	{
		$foundation_id=$_COOKIE['foundation_id'];
		$query="UPDATE `foundations` SET `password`='$password' WHERE  id='$foundation_id' LIMIT 1";
		$perform_query=mysqli_query($connect,$query);
		
		
		if($perform_query)
		{	
			$_SESSION['Success_pass_check_f']="true";
			$message=" Successfull Update :)..";
			$_SESSION['message_f_changepassword_profile']=$message;
			header('location: setting_f_change_password.php');
		}else{
			$_SESSION['Success_pass_check_f']="false";
			$message=" Update Failed :( ..";
			$_SESSION['message_f_changepassword_profile']=$message;
			header('location: setting_f_change_password.php');
		}

	}else{
		$_SESSION['Success_pass_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_changepassword_profile']=$message;
		header('location: setting_f_change_password.php');	
	}


}else{
	$_SESSION['Success_pass_check_f']="false";
	$message=" Update Failed :( ..";
	$_SESSION['message_f_changepassword_profile']=$message;
	header('location: setting_f_change_password.php');
}



?>