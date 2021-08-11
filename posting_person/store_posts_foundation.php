<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");

	if(isset($_POST['account_id']) && isset($_POST['account_type']) && isset($_POST['comment']) && $_POST['post_id'])
	{
		//parameter form POST 
		$account_id=$_POST['account_id'];
		$account_type=$_POST['account_type'];
		$comment=mysqli_real_escape_string($connect,$_POST['comment']);
		$post_id=$_POST['post_id'];
		if($comment==null)
		{
			$comment=" i\'m say Nothing.. ";
		}

		$query_comment="INSERT INTO `comments_foundation_normal_post`( `account_id`, `comment`, `post_id`, `account_type`) VALUES ('$account_id','$comment','$post_id','$account_type')";	
		$perform_query_comment=mysqli_query($connect,$query_comment);
		if($perform_query_comment)
		{
			//succcessful commenting process
			$_SESSION['normal_post_comment_check']="true";
	        $message=" successfully uploaded Your Comment .";
	        $_SESSION['message_normal_comment']=$message;
	        header("location: ../Main.php");	
		}else
		{
			$_SESSION['normal_post_comment_check']="false";
	        $message=" Error in uploading Your Comment .";
	        $_SESSION['message_normal_comment']=$message;
	        header("location: ../Main.php");
		}

	}
	else
	{
		//error happen in commenting process
		$_SESSION['normal_post_comment_check']="false";
        $message=" Error in uploading Your Comment .";
        $_SESSION['message_normal_comment']=$message;
        header("location: ../Main.php");
	}
?>