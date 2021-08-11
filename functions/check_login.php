<?php
session_start();

function check_login_person()
{
	//for person
	if($_COOKIE['Account_type'] == null && $_COOKIE['user_id'] == null  && $_COOKIE['user_first_name'] == null  && $_COOKIE['user_last_name'] == null  &&
	 	$_COOKIE['user_password'] == null  && $_COOKIE['user_gender'] == null  && $_COOKIE['Message_login'] == null && $_SESSION['user_id'] == null 
	 	&& $_SESSION['user_first_name'] ==null && $_SESSION['user_last_name'] == null && $_SESSION['user_password'] ==null &&
		 $_SESSION['user_gender'] == null && $_SESSION['Message_login'] == null && $_SESSION['Account_type'] == null	)
	{
		//perform logout for person
		$message="<span style='color:#ff0000;'>* Conflict Ocurrs</span>";
		$_SESSION['Message_login']=$message;
		header('location: ../logout.php');
	}else{
		//loggedin
	}

}

function check_login_foundation()
{
	//for foundation
	if($_COOKIE['foundation_id']== null && $_COOKIE['foundation_name']== null && $_COOKIE['foundation_password']== null && $_COOKIE['Message_login']== null && $_COOKIE['Account_type']== null &&
		$_SESSION['foundation_id']== null && $_SESSION['foundation_name']== null && $_SESSION['foundation_password']==null && $_SESSION['Message_login']==null && $_SESSION['Account_type']==null)
	{
		//loged and person
		$message="<span style='color:#ff0000;'>* Conflict Ocurrs</span>";
		$_SESSION['Message_login']=$message;
		header('location: ../logout.php');
	}else{
		//logged out
}	

}

?>