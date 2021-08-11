<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['search']))
	{
		$search=$_POST['search'];
		
		/*query search person */
		$query_person_owner="SELECT `normal_posts`.`id` AS `post_id`, `caption`, `date`, `first_name`, `last_name` , `account_id`, `account_type` FROM `normal_posts` INNER JOIN `users` ON `normal_posts`.`account_id` = `users`.id WHERE `account_type`='p' AND `first_name` LIKE '%{$search}%' OR `last_name` LIKE '%{$search}%'  LIMIT 8";
		$perform_query_person_owner=mysqli_query($connect,$query_person_owner);
		while($result_p_post_owner=mysqli_fetch_assoc($perform_query_person_owner))
		{
			$post_id=$result_p_post_owner['post_id'];
			$post_date=$result_p_post_owner['date'];
			
			if($result_p_post_owner['caption']=='')
			{
				$post_caption='No Caption';
			}else
			{
				$post_caption=$result_p_post_owner['caption'];
			}

			$post_user_id=$result_p_post_owner['account_id'];
			$name=$result_p_post_owner['first_name'].' '.$result_p_post_owner['last_name'];

			$post_owner_search_details[]=array(
								"post_id"=>$post_id,
								"post_date"=>$post_date,
								"post_caption"=>$post_caption,
								"post_account_id"=>$post_user_id,
								"post_account_type"=>'p',
								"account_name"=>$name
								);	
		}

		/* query for foundation*/
		$query_foudation_owner="SELECT `normal_posts`.`id` AS `post_id`, `caption`, `date`, `name` , `account_id`, `account_type` FROM `normal_posts` INNER JOIN `foundations` ON `normal_posts`.`account_id` = `foundations`.id WHERE `account_type`='f' AND `name` LIKE '%{$search}%'  LIMIT 8";
		$perform_query_foundation_owner=mysqli_query($connect,$query_foudation_owner);
		while($result_f_post_owner=mysqli_fetch_assoc($perform_query_foundation_owner))
		{
			$post_id=$result_f_post_owner['post_id'];
			$post_date=$result_f_post_owner['date'];
			
			if($result_f_post_owner['caption']=='')
			{
				$post_caption='No Caption';
			}else
			{
				$post_caption=$result_f_post_owner['caption'];
			}

			$post_user_id=$result_f_post_owner['account_id'];
			$name=$result_f_post_owner['name'];

			$post_owner_search_details[]=array(
								"post_id"=>$post_id,
								"post_date"=>$post_date,
								"post_caption"=>$post_caption,
								"post_account_id"=>$post_user_id,
								"post_account_type"=>'f',
								"account_name"=>$name
								);	
		}



		echo json_encode($post_owner_search_details, JSON_FORCE_OBJECT);
	}

	


?>
