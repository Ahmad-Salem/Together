<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['foundation_id']))
	{
		$foundation_id=$_POST['foundation_id'];
		$query_foundation_details="SELECT `id`, `name`, `email`, `telephone_number1`, `telephone_number2`, `photo`, `address`, `country`, `city`,`description`, `fax`, `site_link`,`user_level`, `info_completion` FROM `foundations` WHERE `id`='$foundation_id' LIMIT 1";
		$perform_query_foundation_details=mysqli_query($connect,$query_foundation_details);
		$result_f_details=mysqli_fetch_assoc($perform_query_foundation_details);
		
		$Account_name=$result_f_details['name'];
		$account_email=$result_f_details['email'];
		$account_telephone_number1=$result_f_details['telephone_number1'];
		$account_telephone_number2=$result_f_details['telephone_number2'];
		$account_photo=$result_f_details['photo'];
		$account_address=$result_f_details['address'];
		$account_country=$result_f_details['country'];
		$account_city=$result_f_details['city'];
		$account_description=$result_f_details['description'];
		$account_user_level=$result_f_details['user_level'];
		$account_info_completion=$result_f_details['info_completion'];
		$account_fax=$result_f_details['fax'];
		$account_site_link=$result_f_details['site_link'];
		if($account_photo==null)
		{
			
				$image="images/profile_image/default-academy.jpg";
			

		}else{
			
			$image="foundations/".$foundation_id."/".$result_f_details['photo'];
		}


		$foundation_account_details[]=array(
							"name"=>$Account_name,
							"email"=>$account_email,
							"telephone_number1"=>$account_telephone_number1,
							"telephone_number2"=>$account_telephone_number2,
							"photo"=>$image,
							"adderss"=>$account_address,
							"country"=>$account_country,
							"city"=>$account_city,
							"description"=>$account_description,
							"user_level"=>$account_user_level,
							"info_completion"=>$account_info_completion,
							"fax"=>$account_fax,
							"site_link"=>$account_site_link
							);


		echo json_encode($foundation_account_details, JSON_FORCE_OBJECT);
	}

	


?>