<?php
	session_start();
	include_once("../php_includes/connection_dp.php");
	if(isset($_POST['foundation_submit']))
	{
		$foundation_id=$_COOKIE['foundation_id'];
		$name=preg_replace('#[^a-z0-9]#i', '', $_POST['foundation_name']);
		$email=mysqli_real_escape_string($connect, $_POST['foundation_email']);
		$country=preg_replace('#[^a-z ]#i', '', $_POST['foundation_country']);
		$city=preg_replace('#[^a-z ]#i', '', $_POST['foundation_city']);
		$city=str_replace(" ", "+", $city);
		$description=mysqli_real_escape_string($connect , $_POST['foundation_description']);	
		
		if(!empty($foundation_id) && !empty($name) && !empty($email)
			&& !empty($country) && !empty($city) && !empty($description))
		{
			$query="UPDATE `foundations` SET `name`= '$name' ,`email`= '$email' ,`country`= '$country' ,`city`= '$city' ,
			 `description`= '$description'  WHERE id= '$foundation_id' LIMIT 1";
			$perform_query=mysqli_query($connect,$query);
			
			if($perform_query)
			{
				$_SESSION['Success_check_f']="true";
				$message=" Successfull Update :) ..";
				$_SESSION['message_f_edit_profile']=$message;
				header('location: setting_f.php');
			}else{
				$_SESSION['Success_check_f']="false";
				$message=" Update Failed :( ..";
				$_SESSION['message_f_edit_profile']=$message;
				header('location: setting_f.php');
			}

		}else{
				$_SESSION['Success_check_f']="false";
				$message=" Update Failed :( ..";
				$_SESSION['message_f_edit_profile']=$message;
				header('location: setting_f.php');
		}

	}else
	{
				$_SESSION['Success_check_f']="false";
				$message=" Update Failed :( ..";
				$_SESSION['message_f_edit_profile']=$message;
				header('location: setting_f.php');
	}
	