<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/deletedir.php");

	if(isset($_POST['message_id'])&&isset($_POST['account_id'])&&isset($_POST['account_type'])&&isset($_POST['reply_body']))
	{
		$account_id=$_POST['account_id'];
		$account_type=$_POST['account_type'];
		$message_id=$_POST['message_id'];
		$reply_body=$_POST['reply_body'];

		$query_insert="INSERT INTO `reply_contactus`(`account_id`, `account_type`, `reply_body`, `msg_id`) VALUES ('$account_id','$account_type','$reply_body','$message_id')";
		$peform_query_insert=mysqli_query($connect,$query_insert);
		if($peform_query_insert)
		{
			echo "Successful Reply";
		}else
		{
			echo "Failed Reply";
		}
		
	}else
	{
		echo "Failed Reply";
	}
?>	