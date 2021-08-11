<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['person_id']))
	{
		$person_id=$_POST['person_id'];
		$query_person_details="SELECT `id`, `first_name`, `last_name`, `email`, `telephone_number1`, `telephone_number2`, `gender`, `photo`, `adderss`, `country`, `city`,
		 `description`, `user_level`, `info_completion` FROM `users` WHERE `id`='$person_id' LIMIT 1";
		$perform_query_person_details=mysqli_query($connect,$query_person_details);
		$result_p_details=mysqli_fetch_assoc($perform_query_person_details);
		
		$Account_name=$result_p_details['first_name'].' '.$result_p_details['last_name'];
		$account_gender=$result_p_details['gender'];
		$account_email=$result_p_details['email'];
		$account_telephone_number1=$result_p_details['telephone_number1'];
		$account_telephone_number2=$result_p_details['telephone_number2'];
		$account_photo=$result_p_details['photo'];
		$account_address=$result_p_details['adderss'];
		$account_country=$result_p_details['country'];
		$account_city=$result_p_details['city'];
		$account_description=$result_p_details['description'];
		$account_user_level=$result_p_details['user_level'];
		$account_info_completion=$result_p_details['info_completion'];
		
		if($account_photo==null)
		{
			if($result_p_details['gender']=='m')
			{	
				$image="images/profile_image/default-person.jpg";
			}else{
				$image="images/profile_image/user_profile_female.jpg";
			}

		}else{
			
			$image="users/".$person_id."/".$result_p_details['photo'];
		}


		$peson_account_details[]=array(
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
							"gender"=>$account_gender
							);


		echo json_encode($peson_account_details, JSON_FORCE_OBJECT);
	}

	


?>