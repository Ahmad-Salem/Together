<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	
	if($_POST['do_Action']=='normal_search')
	{
		if(isset($_POST['account_id'])&&isset($_POST['account_type']))
		{
				if(isset($_POST['search']))
				{
					$search=$_POST['search'];	
				}else
				{
					$search='';
				}
				
				$account_details['date']=array();
				$query_person="SELECT `id`, `first_name`, `last_name`, `gender`, `photo` FROM `users` WHERE `first_name` LIKE '{$search}%' OR `last_name` LIKE '{$search}%' LIMIT 10";
				$perform_query_person=mysqli_query($connect,$query_person);
				while($result_person=mysqli_fetch_assoc($perform_query_person))
				{
					$Account_id=$result_person['id'];
					$Account_name=$result_person['first_name'].' '.$result_person['last_name'];
					if($result_person['photo']==null)
						{
							if($result_person['gender']=='m')
							{	
								$image="http://together.gsg-xpro.com/root/images/profile_image/default-person.jpg";
							}else{
								$image="http://together.gsg-xpro.com/root/images/profile_image/user_profile_female.jpg";
							}

						}else{
							
							$image="http://together.gsg-xpro.com/root/users/".$Account_id."/".$result_person['photo'];
						}
					$Account_gender=$result_person['gender'];	
					$temp=array(
								"id"=>$Account_id,
								"name"=>$Account_name,
								"image"=>$image,
								"gender"=>$Account_gender,
								"account_type"=>'p'
								);
					array_push($account_details['date'],array('result'=>$temp));	
				
				}

				$search=$_POST['search'];
				$query_foundation="SELECT `id`, `name`, `photo` FROM `foundations` WHERE `name` LIKE '{$search}%' LIMIT 10";
				$perform_query_foundation=mysqli_query($connect,$query_foundation);
				while($result_foundation=mysqli_fetch_assoc($perform_query_foundation))
				{
					$Account_id=$result_foundation['id'];
					$Account_name=$result_foundation['name'];
					if($result_foundation['photo']==null)
					{
						$image="http://together.gsg-xpro.com/root/images/profile_image/default-academy.jpg";

					}else{
						
						$image="http://together.gsg-xpro.com/root/foundations/".$Account_id."/".$result_foundation['photo'];
					}
						

					$temp=array(
								"id"=>$Account_id,
								"name"=>$Account_name,
								"image"=>$image,
								"gender"=>"",
								"account_type"=>'f'
								);	
					array_push($account_details['date'],array('result'=>$temp));	
				}

			
			echo json_encode($account_details);	
			
		}
		
	}
?>