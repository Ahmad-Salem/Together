<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['search']))
	{
		$search=$_POST['search'];
		$query_foundation_details="SELECT `id`, `name`, `email`, `country`, `info_completion` FROM `foundations` WHERE `name` LIKE '{$search}%'  LIMIT 8";
		$perform_query_foundation_details=mysqli_query($connect,$query_foundation_details);
		while($result_f_details=mysqli_fetch_assoc($perform_query_foundation_details))
		{
			$Account_id=$result_f_details['id'];
			$Account_name=$result_f_details['name'];
			$account_email=$result_f_details['email'];
			$account_country=$result_f_details['country'];
			$account_info_completion=$result_f_details['info_completion'];
			

			$foundation_account_details[]=array(
								"id"=>$Account_id,
								"name"=>$Account_name,
								"email"=>$account_email,
								"country"=>$account_country,
								"info_completion"=>$account_info_completion
								);	
		}
		


		echo json_encode($foundation_account_details, JSON_FORCE_OBJECT);
	}

	


?>
