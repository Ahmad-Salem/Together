<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['search']))
	{
		$search=$_POST['search'];
		$query_contact_filter="SELECT `contact_us`.`id` as `con_id`, `message`, `contact_us`.`date`, `account_id`, `account_type` ,`first_name` ,`last_name`  FROM `contact_us` INNER JOIN `users` on `contact_us`.`account_id` = `users`.`id` WHERE `account_type`='p' AND `users`.`first_name` LIKE '{$search}%' OR `users`.`last_name` LIKE '{$search}%'";
		$perform_query_contact_filter=mysqli_query($connect,$query_contact_filter);
		
		while($result_contactus=mysqli_fetch_assoc($perform_query_contact_filter))
	  	{
	  		$account_id=$result_contactus['account_id'];
	  		$account_type=$result_contactus['account_type'];
	  		$message_id=$result_contactus['con_id'];
	  		$date=$result_contactus['date'];
	  		$messagep=$result_contactus['message'];
			$account_name=$result_contactus['first_name'].' '.$result_contactus['last_name'];
			$contact_filter[]=array(
								"account_id"=>$account_id,
								"account_type"=>'p',
								"account_name"=>$account_name,
								"message_id"=>$message_id,
								"date"=>$date,
								"message"=>$messagep,
								);
		}


		$query_contact_filter_f="SELECT `contact_us`.`id` as `con_id`, `message`, `contact_us`.`date`, `account_id`, `account_type` ,`name` FROM `contact_us` INNER JOIN `foundations` on `contact_us`.`account_id` = `foundations`.`id` WHERE `account_type`='f' AND `foundations`.`name` LIKE '{$search}%' LIMIT 8";
		$perform_query_contact_filter_f=mysqli_query($connect,$query_contact_filter_f);
		
		while($result_contactus_f=mysqli_fetch_assoc($perform_query_contact_filter_f))
	  	{
	  		$account_id=$result_contactus_f['account_id'];
	  		$account_type=$result_contactus_f['account_type'];
	  		$message_id=$result_contactus_f['con_id'];
	  		$date=$result_contactus_f['date'];
	  		$message=$result_contactus_f['message'];
			$account_name=$result_contactus_f['name'];
			$contact_filter[]=array(
								"account_id"=>$account_id,
								"account_type"=>'p',
								"account_name"=>$account_name,
								"message_id"=>$message_id,
								"date"=>$date,
								"message"=>$message,
								);
		}

		echo json_encode($contact_filter, JSON_FORCE_OBJECT);	

  	}

	  	
			
	
	
?>
