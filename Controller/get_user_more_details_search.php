<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['search']))
	{
		$search=$_POST['search'];
		$query_person_details="SELECT `id`, `first_name`, `last_name`, `email`, `country`, `info_completion` FROM `users` WHERE `first_name` LIKE '{$search}%' OR `last_name` LIKE '{$search}%'  LIMIT 8";
		$perform_query_person_details=mysqli_query($connect,$query_person_details);
		while($result_p_details=mysqli_fetch_assoc($perform_query_person_details))
		{
			$Account_id=$result_p_details['id'];
			$Account_name=$result_p_details['first_name'].' '.$result_p_details['last_name'];
			$account_email=$result_p_details['email'];
			$account_country=$result_p_details['country'];
			$account_info_completion=$result_p_details['info_completion'];
			

			$person_account_details[]=array(
								"id"=>$Account_id,
								"name"=>$Account_name,
								"email"=>$account_email,
								"country"=>$account_country,
								"info_completion"=>$account_info_completion
								);	
		}
		


		echo json_encode($person_account_details, JSON_FORCE_OBJECT);
	}

	


?>