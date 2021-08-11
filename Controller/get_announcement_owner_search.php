<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['search']))
	{
		$search=$_POST['search'];
		
		/*query search person */
		$query_person_owner="SELECT `request_post`.`id` AS `announcement_id`, `request_post`.`country` ,`lastSeen`, `date`, `first_name`, `last_name` , `account_id`, `account_type` FROM `request_post` INNER JOIN `users` ON `request_post`.`account_id` = `users`.id WHERE `account_type`='p' AND `first_name` LIKE '%{$search}%' OR `last_name` LIKE '%{$search}%'  LIMIT 8";
		$perform_query_person_owner=mysqli_query($connect,$query_person_owner);
		while($result_p_post_owner=mysqli_fetch_assoc($perform_query_person_owner))
		{
			$announcement_id=$result_p_post_owner['announcement_id'];
			$post_date=$result_p_post_owner['date'];
			$announcement_latSeen=$result_p_post_owner['lastSeen'];
			
			$country=$result_p_post_owner['country'];
			$post_user_id=$result_p_post_owner['account_id'];
			$name=$result_p_post_owner['first_name'].' '.$result_p_post_owner['last_name'];

			$post_owner_search_details[]=array(
								"announcement_id"=>$announcement_id,
								"announcement_date"=>$post_date,
								"announcement_account_id"=>$post_user_id,
								"announcement_account_type"=>'p',
								"account_name"=>$name,
								"announcement_latSeen"=>$announcement_latSeen,
								"country"=>$country
								);	
		}

		/* query for foundation*/
		$query_foudation_owner="SELECT `request_post`.`id` AS `announcement_id`, `request_post`.`country`, `lastSeen`, `date`, `name` , `account_id`, `account_type` FROM `request_post` INNER JOIN `foundations` ON `request_post`.`account_id` = `foundations`.id WHERE `account_type`='f' AND `name` LIKE '%{$search}%'  LIMIT 8";
		$perform_query_foundation_owner=mysqli_query($connect,$query_foudation_owner);
		while($result_f_post_owner=mysqli_fetch_assoc($perform_query_foundation_owner))
		{
			$announcement_id=$result_f_post_owner['announcement_id'];
			$post_date=$result_f_post_owner['date'];
			$announcement_latSeen=$result_f_post_owner['lastSeen'];
			
			$country=$result_f_post_owner['country'];
			$post_user_id=$result_f_post_owner['account_id'];
			$name=$result_f_post_owner['name'];

			$post_owner_search_details[]=array(
								"announcement_id"=>$announcement_id,
								"announcement_date"=>$post_date,
								"announcement_account_id"=>$post_user_id,
								"announcement_account_type"=>'f',
								"account_name"=>$name,
								"announcement_latSeen"=>$announcement_latSeen,
								"country"=>$country
								);	
		}



		echo json_encode($post_owner_search_details, JSON_FORCE_OBJECT);
	}

	


?>
