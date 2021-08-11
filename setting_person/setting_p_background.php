<?php
	session_start();
	include_once("../php_includes/connection_dp.php");


	if(isset($_POST['submit_p']))
	{

		$user_id=$_COOKIE['user_id'];
		$first_name=preg_replace('#[^a-z0-9]#i', '', $_POST['first_name']);
		$last_name=preg_replace('#[^a-z0-9]#i', '', $_POST['last_name']);
		$email=mysqli_real_escape_string($connect, $_POST['email_p']);
		$gender=preg_replace('#[^a-z ]#i', '', $_POST['gender_p']);
		$country=preg_replace('#[^a-z ]#i', '', $_POST['country_p']);
		$city=preg_replace('#[^a-z ]#i', '', $_POST['city_p']);
		$city=str_replace(" ", "+", $city);
		$description=mysqli_real_escape_string($connect,$_POST['description_p']);
			
		$query="UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',
		`email`='$email',`gender`='$gender',`country`='$country',`city`='$city',`description`='$description' WHERE id ='$user_id' LIMIT 1";
		
		$perform_query=mysqli_query($connect,$query);
		
		
		if($perform_query)
		{
			$_SESSION['Success_check']="true";
			$message=" Successfull Update :) ..";
			$_SESSION['message_p_edit_profile']=$message;
			header('location: setting_p.php');

		}else{
			$_SESSION['Success_check']="false";
			$message=" Update Failed :( ..";
			$_SESSION['message_p_edit_profile']=$message;
			header('location: setting_p.php');
		}

		


	}



?>