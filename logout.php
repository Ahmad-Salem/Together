<?php
session_start();
include_once("php_includes/connection_dp.php");

	if($_COOKIE['Account_type']=="person")
	{
			$user_id=$_COOKIE['user_id'];
			//set activated to zero
			$query_activated="UPDATE `users` SET `activated`='0' WHERE id='$user_id' LIMIT 1";
			$perform_query_activated=mysqli_query($connect,$query_activated);

			//logout for person
			$_SESSION['user_id']=null;
			$_SESSION['user_first_name']=null;
			$_SESSION['user_last_name']=null;
			$_SESSION['user_password']=null;
			$_SESSION['user_gender']=null;
			$_SESSION['Message_login']=null;
			$_SESSION['Account_type']=null;
			session_destroy();

			setcookie("user_id", '', strtotime( '-5 days' ), '/');
			setcookie("user_first_name", '', strtotime( '-5 days' ), '/');
			setcookie("user_last_name", '', strtotime( '-5 days' ), '/');
			setcookie("user_password", '', strtotime( '-5 days' ), '/');
			setcookie("user_gender", '', strtotime( '-5 days' ), '/');
			setcookie("Message_login", '', strtotime( '-5 days' ), '/');
			setcookie("Account_type", '', strtotime( '-5 days' ), '/');

			

			header("location: index.php");
    			
	}else{

		//logout for foundation 

			$foundation_id=$_COOKIE['foundation_id'];			
 			//set activated to zero
			$query_activated="UPDATE `foundations` SET `activated`='0' WHERE id='$foundation_id' LIMIT 1";
			$perform_query_activated=mysqli_query($connect,$query_activated);


			$_SESSION['foundation_id']=null;
 			$_SESSION['foundation_name']=null;
 			$_SESSION['foundation_password']=null;
 			$_SESSION['Message_login']=null;
 			$_SESSION['Account_type']=null;
 			session_destroy();

 			setcookie("foundation_id", '', strtotime( '-5 days' ), '/');
 			setcookie("foundation_name", '', strtotime( '-5 days' ), '/');
 			setcookie("foundation_password", '', strtotime( '-5 days' ), '/');
 			setcookie("Message_login", '', strtotime( '-5 days' ), '/');
 			setcookie("Account_type", '', strtotime( '-5 days' ), '/');
			
			header("location: index.php");
	}		

	$_SESSION=null;
	$_COOKIE=null;
	header("location: index.php");
	session_destroy();

?>