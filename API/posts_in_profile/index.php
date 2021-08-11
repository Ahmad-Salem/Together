<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_Action']=='normal_posting')
	{
		if(isset($_POST['posting_type'])&&isset($_POST['account_id'])&&isset($_POST['account_type']))
		{
			if($_POST['posting_type']=='main_profile')
			{	
				$temp_account_id=$_POST['account_id'];
				$temp_account_type=$_POST['account_type'];
				$normal_post_info['data']=array();
				$normal_post_images['img']['res']=array();
				$normal_post_images_f['img']['res']=array();
				$query_normal_posts="SELECT `id`, `account_id`, `account_type`,`caption`, `date` FROM `normal_posts` WHERE `account_id`='$temp_account_id' AND `account_type`='$temp_account_type'  ORDER BY id DESC";
				$perform_normal_query=mysqli_query($connect,$query_normal_posts);
				if($perform_normal_query)
				{
					while($row=mysqli_fetch_assoc($perform_normal_query))
					{
						$post_id=$row['id'];
						$user_id=$row['account_id'];
						$caption=$row['caption'];
						$date=$row['date'];

						$query_number_comment="SELECT `id` FROM `comments_normal_post` WHERE `post_id`='$post_id'";
						$perfrom_number_comment=mysqli_query($connect,$query_number_comment);
						if(mysqli_num_rows($perfrom_number_comment)!=0)
						{
							$number_of_comments=mysqli_num_rows($perfrom_number_comment);
						}else
						{
							$number_of_comments=0;
						}
						
						$query_number_like="SELECT `id` FROM `likes_normal_post` WHERE `post_id`='$post_id'";
						$perfrom_number_like=mysqli_query($connect,$query_number_like);
						if(mysqli_num_rows($perfrom_number_like)!=0)
						{
							$number_of_likes=mysqli_num_rows($perfrom_number_like);
						}else
						{
							$number_of_likes=0;
						}
						if($row['account_type']=='p')
						{
							$query_user_info="SELECT `first_name`, `last_name` , `photo` ,`gender` FROM `users` WHERE `id` = '$user_id' LIMIT 1";
						
							$perform_normal_info=mysqli_query($connect,$query_user_info);
							$result=mysqli_fetch_assoc($perform_normal_info);
							
							$username=$result['first_name'].' '.$result['last_name'];
							$user_photo=$result['photo'];
							$gender=$result['gender'];
							if($user_photo==null)
							{
								//check for gender
								if($gender=='m')
								{
									//male
									$image="http://together.gsg-xpro.com/root/images/profile_image/default-person.jpg";
								}else
								{
									//female
									$image="http://together.gsg-xpro.com/root/images/profile_image/user_profile_female.jpg";
								}
								
							}else
							{
									//default..
									$image="http://together.gsg-xpro.com/root/users/$user_id/$user_photo";
							}
						}
						else if($row['account_type']=='f')
						{
							//foundation 

							$query_foundation_info="SELECT `name` , `photo`  FROM `foundations` WHERE `id` = '$user_id' LIMIT 1";
						
							$perform_normal_info=mysqli_query($connect,$query_foundation_info);
							$result=mysqli_fetch_assoc($perform_normal_info);
							
							$username=$result['name'];
							$user_photo=$result['photo'];
						
							if($user_photo==null)
							{
								$image="http://together.gsg-xpro.com/root/images/profile_image/default-academy.jpg";
								
							}else
							{
									//default..
									$image="http://together.gsg-xpro.com/root/foundations/$user_id/$user_photo";
							}

						}

						$acc_type=$row['account_type'];
						
							//persons
							//Select the images ....  
						$query_normal_posts_images="SELECT  normal_post_images.`images`  FROM normal_posts INNER JOIN normal_post_images ON normal_posts.id = normal_post_images.post_id WHERE  normal_post_images.account_id='$user_id' AND normal_post_images.account_type='{$acc_type}' ";
							$perform_normal_posts_images=mysqli_query($connect,$query_normal_posts_images);	
							$temp_image_p=array();
							$temp_image_f=array();
							$date_ago=time_elapsed_string($date, $full = false);
							while ($row_image=mysqli_fetch_assoc($perform_normal_posts_images)) {
									if($row['account_type']=='p')
									{
										
										array_push($temp_image_p,"http://together.gsg-xpro.com/root/postingattachment/user/$user_id/$post_id/".$row_image['images']);
										
									}
									else if($row['account_type']=='f')
									{
										
										
										array_push($temp_image_f,"http://together.gsg-xpro.com/root/postingattachment/foundation/$user_id/$post_id/".$row_image['images']);

										
									}





								}


								if($row['account_type']=='p')
								{
									$normal_post_images=implode(",",$temp_image_p);
										
										// sucessfull
										$temp=array(
												"post_id"=>$post_id,
												"number_comments"=>$number_of_comments,
												"number_likes"=>$number_of_likes,
												"images"=>$normal_post_images,				
												"image_account"=>$image,
												"name"=>$username,
												"caption"=>$caption,
												"date"=>$date_ago,
												"status"=>"Success",
												"message"=>"Successful Updation"
												);
										array_push($normal_post_info['data'],array('result'=>$temp));

								}elseif($row['account_type']=='f')
								{
									$normal_post_images_f=implode(",",$temp_image_f);
										
										// sucessfull
										$temp=array(
												"post_id"=>$post_id,
												"number_comments"=>$number_of_comments,
												"number_likes"=>$number_of_likes,
												"images"=>$normal_post_images_f,				
												"image_account"=>$image,
												"name"=>$username,
												"caption"=>$caption,
												"date"=>$date_ago,
												"status"=>"Success",
												"message"=>"Successful Updation"
												);
										
										array_push($normal_post_info['data'],array('result'=>$temp));
								}

									

					}

					

					
				}else
				{
					// failed
					$normal_post_info['data']['result']=array(
							"status"=>"failed",
							"message"=>"Failed Updation"
							);	
											
				}

				echo json_encode($normal_post_info);
				
			}

			 
		}
	}
?>	