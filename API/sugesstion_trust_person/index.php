<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_action']=='suggestion_person')
	{
		if($_POST['suggestion_type']=='display')
		{
			if(isset($_POST['account_id'])&&isset($_POST['account_type']))
			{
				$person_info['data']=array();
				$temp=array();
				$query_sugestion="SELECT `id`, `first_name`, `last_name`, `gender`, `photo` FROM `users` LIMIT 5";
				$perform_query_sugestion=mysqli_query($connect,$query_sugestion);
				while($result_sug=mysqli_fetch_assoc($perform_query_sugestion))
				{
					$person_id=$result_sug['id'];
					$person_name=$result_sug['first_name'].' '.$result_sug['last_name'];
					$person_photo=$result_sug['photo'];
					$person_gender=$result_sug['gender'];

					
					if($person_photo==null)
					{
						//check for gender
						if($person_gender=='m')
						{
							//male
							$image="http://together.gsg-xpro.com/root/images/profile_image/default-person.jpg";
						}else if($person_gender=='f')
						{
							//female
							$image="http://together.gsg-xpro.com/root/images/profile_image/user_profile_female.jpg";
						}
						
					}else
					{
							//default..
							$image="http://together.gsg-xpro.com/root/users/$user_id/$person_photo";
					}

					$temp=array(
						"account_id"=>$person_id,
						"account_type"=>"p",
						"photo"=>$image,
						"account_gender"=>$person_gender
						);

					array_push($person_info['data'],array('result'=>$temp));
				}


				echo json_encode($person_info);

			}
		}
	}
?>