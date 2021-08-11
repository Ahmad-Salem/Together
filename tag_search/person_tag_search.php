<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['search']))
	{
		$search=$_POST['search'];
		$query_person="SELECT `id`, `first_name`, `last_name`, `gender`, `photo` FROM `users` WHERE `first_name` LIKE '{$search}%' OR `last_name` LIKE '{$search}%' LIMIT 3";
		$perform_query_person=mysqli_query($connect,$query_person);
		while($result_person=mysqli_fetch_assoc($perform_query_person))
		{
			$Account_id=$result_person['id'];
			$Account_name=$result_person['first_name'].' '.$result_person['last_name'];
			if($result_person['photo']==null)
				{
					if($result_person['gender']=='m')
					{	
						$image="images/profile_image/default-person.jpg";
					}else{
						$image="images/profile_image/user_profile_female.jpg";
					}

				}else{
					
					$image="users/".$Account_id."/".$result_person['photo'];
				}
			$Account_gender=$result_person['gender'];	

			$person_account_details[]=array(
									"id"=>$Account_id,
									"name"=>$Account_name,
									"image"=>$image,
									"gender"=>$Account_gender
									);	
		}

		echo json_encode($person_account_details, JSON_FORCE_OBJECT);
	}
?>