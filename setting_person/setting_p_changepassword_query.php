<?php 
session_start();
include_once("../php_includes/connection_dp.php");
include_once("../php_includes/rand.php");

if(isset($_POST['update_pass']))
{
	$password=mysqli_real_escape_string($connect,$_POST['update_password']);
	$repassword=mysqli_real_escape_string($connect,$_POST['update_repassword']);
	
	if($password==$repassword)
	{
		$user_id=$_COOKIE['user_id'];
		$query="UPDATE `users` SET `password`= '$password' WHERE id='$user_id' LIMIT 1";
		$perform_query=mysqli_query($connect,$query);
		
		
		if($perform_query)
		{	
			$_SESSION['Success_pass_check']="true";
			$message=" Successfull Update :)..";
			$_SESSION['message_p_changepassword_profile']=$message;
			header('location: setting_p_changepassword.php');
		}else{
			$_SESSION['Success_pass_check']="false";
			$message=" Update Failed :( ..";
			$_SESSION['message_p_changepassword_profile']=$message;
			header('location: setting_p_changepassword.php');
		}

	}else{
		$_SESSION['Success_pass_check']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_p_changepassword_profile']=$message;
		header('location: setting_p_changepassword.php');	
	}


}else{
	$_SESSION['Success_pass_check']="false";
	$message=" Update Failed :( ..";
	$_SESSION['message_p_changepassword_profile']=$message;
	header('location: setting_p_changepassword.php');
}



?>