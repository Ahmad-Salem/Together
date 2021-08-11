<?php 
session_start();
include_once("../php_includes/connection_dp.php");


if(isset($_POST['send_report']))
{

	if($_COOKIE['Account_type']=='foundation')
	{
		//foundation
		$foundation_id=$_COOKIE['foundation_id'];
		$report=mysqli_real_escape_string($connect,$_POST['report']);
		$query_report="INSERT INTO `contact_us`(`message`, `account_id`, `account_type`) VALUES ('$report','$foundation_id','f')";
		$perform_query_report=mysqli_query($connect,$query_report);
		
		if($perform_query_report)
		{
			//process success
			$_SESSION['Success_Report_check']="true";
			$message=" Successfull Process :) ..";
			$_SESSION['message_f_send_report_profile']=$message;
			header("location: setting_f_report.php");
		}else{

			//process failed
			$_SESSION['Success_Report_check']="false";
			$message=" Send Failed :( ..";
			$_SESSION['message_f_send_report_profile']=$message;
			header("location: setting_f_report.php");
		}		


	}else{

		//process failed
			$_SESSION['Success_Report_check']="false";
			$message=" Send Failed :( ..";
			$_SESSION['message_f_send_report_profile']=$message;
			header("location: setting_f_report.php");
	}

	

	echo $_SESSION['Success_Report_check'];
}


?>