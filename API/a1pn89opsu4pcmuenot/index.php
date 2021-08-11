<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_Action']=='announcement_action')
	{
		if(isset($_POST['posting_type'])&&isset($_POST['account_id'])&&isset($_POST['account_type']))
		{
			if($_POST['posting_type']=='announcement')
			{
				$query_announcement="SELECT `id`, `account_id`, `account_type`, `child_name`, `age`, `tall`, `skin_color`, `country`, `hair_color`, `lastSeen`, `description_lost_found`, `eye_color`, `description_contact`, `description_relation_with_child`, `description_child_status`, `request_type`, `date` FROM `request_post` ";
				$perform_query_announcement=mysqli_query($connect,$query_announcement);
				$announcement_post_info['data']=array();
				while($result_announcement=mysqli_fetch_assoc($perform_query_announcement))
				{
					$user_id=$result_announcement['account_id'];
					if($result_announcement['account_type']=='p')
						{
							$query_user_info="SELECT `first_name`, `last_name`  FROM `users` WHERE `id` = '$user_id' LIMIT 1";
						
							$perform_normal_info=mysqli_query($connect,$query_user_info);
							$result=mysqli_fetch_assoc($perform_normal_info);
							
							$username=$result['first_name'].' '.$result['last_name'];
							
							
						}
						else if($result_announcement['account_type']=='f')
						{
							//foundation 

							$query_foundation_info="SELECT `name` FROM `foundations` WHERE `id` = '$user_id' LIMIT 1";
						
							$perform_normal_info=mysqli_query($connect,$query_foundation_info);
							$result=mysqli_fetch_assoc($perform_normal_info);
							
							$username=$result['name'];
							

						}

						$announcement_id=$result_announcement['id'];
						$announcement_account_id=$result_announcement['account_id'];
						$announcement_account_type=$result_announcement['account_type'];
						$query_announcement_images="SELECT `image` FROM `request_post_images` WHERE `request_id`='$announcement_id' ";
						$perform_query_announcement_images=mysqli_query($connect,$query_announcement_images);
						$temp_image_p=array();
						$temp_image_f=array();
						while($result_anno_image=mysqli_fetch_assoc($perform_query_announcement_images))
						{
							if($result_announcement['account_type']=='p')
							{	
								array_push($temp_image_p,"http://together.gsg-xpro.com/root/request_post_attachment/user/{$announcement_account_id}/{$announcement_id}/".$result_anno_image['image']);
							}else if($result_announcement['account_type']=='f')
							{
								array_push($temp_image_f,"http://together.gsg-xpro.com/root/request_post_attachment/foundation/{$announcement_account_id}/{$announcement_id}/".$result_anno_image['image']);
							}
						}

						
						$announcement_child_name=$result_announcement['child_name'];
						$announcement_age=$result_announcement['age'];
						$announcement_tall=$result_announcement['tall'];
						$announcement_skin_color=$result_announcement['skin_color'];
						$announcement_country=$result_announcement['country'];
						$announcement_hair_color=$result_announcement['hair_color'];
						$announcement_lastSeen=$result_announcement['lastSeen'];
						$announcement_description_lost_found=$result_announcement['description_lost_found'];
						$announcement_eye_color=$result_announcement['eye_color'];
						$announcement_description_contact=$result_announcement['description_contact'];
						$announcement_description_relation_with_child=$result_announcement['description_relation_with_child'];
						$announcement_description_child_status=$result_announcement['description_child_status'];
						$announcement_request_type=$result_announcement['request_type'];
						$announcement_date=$result_announcement['date'];
						$announcement_post_owner=$username;

						if($result_announcement['account_type']=='p')
								{
									$announcement_post_images=implode(",",$temp_image_p);
										
										// sucessfull
										$temp=array(
												"announcement_iamges"=>$announcement_post_images,
												"announcement_account_id"=>$announcement_account_id,				
												"announcement_account_type"=>$announcement_account_type,
												"announcement_child_name"=>$announcement_child_name,
												"announcement_age"=>$announcement_age,
												"announcement_tall"=>$announcement_tall,
												"announcement_skin_color"=>$announcement_skin_color,
												"announcement_country"=>$announcement_country,
												"announcement_hair_color"=>$announcement_hair_color,
												"announcement_lastSeen"=>$announcement_lastSeen,
												"announcement_description_lost_found"=>$announcement_description_lost_found,
												"announcement_eye_color"=>$announcement_eye_color,
												"announcement_description_contact"=>$announcement_description_contact,
												"announcement_description_relation_with_child"=>$announcement_description_relation_with_child,
												"announcement_description_child_status"=>$announcement_description_child_status,
												"announcement_request_type"=>$announcement_request_type,
												"announcement_date"=>$announcement_date,
												"announcement_post_owner"=>$announcement_post_owner,
												"status"=>"Success",
												"message"=>"Successful Updation"
												);
										array_push($announcement_post_info['data'],array('result'=>$temp));

								}elseif($result_announcement['account_type']=='f')
								{
									$announcement_post_images_f=implode(",",$temp_image_f);
										
										// sucessfull
										$temp=array(
												"announcement_iamges"=>$announcement_post_images_f,
												"announcement_account_id"=>$announcement_account_id,				
												"announcement_account_type"=>$announcement_account_type,
												"announcement_child_name"=>$announcement_child_name,
												"announcement_age"=>$announcement_age,
												"announcement_tall"=>$announcement_tall,
												"announcement_skin_color"=>$announcement_skin_color,
												"announcement_country"=>$announcement_country,
												"announcement_hair_color"=>$announcement_hair_color,
												"announcement_lastSeen"=>$announcement_lastSeen,
												"announcement_description_lost_found"=>$announcement_description_lost_found,
												"announcement_eye_color"=>$announcement_eye_color,
												"announcement_description_contact"=>$announcement_description_contact,
												"announcement_description_relation_with_child"=>$announcement_description_relation_with_child,
												"announcement_description_child_status"=>$announcement_description_child_status,
												"announcement_request_type"=>$announcement_request_type,
												"announcement_date"=>$announcement_date,
												"announcement_post_owner"=>$announcement_post_owner,
												"status"=>"Success",
												"message"=>"Successful Updation"
												);
										
										array_push($announcement_post_info['data'],array('result'=>$temp));
								}


				}

			}else
			{
				// failed
				$announcement_post_info['data']['result']=array(
						"status"=>"failed",
						"message"=>"Failed Updation"
						);	
			}

			echo json_encode($announcement_post_info);
		}
	}	
?>	