<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	if(isset($_POST['search']))
	{
		$search=$_POST['search'];
		$query_foundation="SELECT `id`, `name`, `photo` FROM `foundations` WHERE `name` LIKE '{$search}%' LIMIT 10";
		$perform_query_foundation=mysqli_query($connect,$query_foundation);
		while($result_foundation=mysqli_fetch_assoc($perform_query_foundation))
		{
			$Account_id=$result_foundation['id'];
			$Account_name=$result_foundation['name'];
			if($result_foundation['photo']==null)
			{
				$image="images/profile_image/default-academy.jpg";

			}else{
				
				$image="foundations/".$Account_id."/".$result_foundation['photo'];
			}
				

			$foundation_account_details[]=array(
									"id"=>$Account_id,
									"name"=>$Account_name,
									"image"=>$image
									);	
		}

		echo json_encode($foundation_account_details, JSON_FORCE_OBJECT);
	}
?>