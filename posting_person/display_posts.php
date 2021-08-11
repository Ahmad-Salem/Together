<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");
	
	if($_COOKIE['Account_type']=='person')
	{
		$query_number_of_posts="SELECT * FROM `normal_posts`";
		$perform_query_number_of_posts=mysqli_query($connect,$query_number_of_posts);
		
		$number_of_normal_posts=mysqli_num_rows($perform_query_number_of_posts);
		
		echo "<input type=\"hidden\" value=\"$number_of_normal_posts\" id=\"number_of_normal_posts\"/>";

		//normal posts from persons
		$query_normal_posts="SELECT `id`, `account_id`, `account_type`,`caption`, `date` FROM `normal_posts`  ORDER BY id DESC LIMIT 5";
		$perform_normal_query=mysqli_query($connect,$query_normal_posts);

		while($row=mysqli_fetch_assoc($perform_normal_query))
		{
			$post_id=$row['id'];
			$user_id=$row['account_id'];
			$caption=$row['caption'];
			$date=$row['date'];
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
						$image="images/profile_image/default-person.jpg";
					}else
					{
						//female
						$image="images/profile_image/user_profile_female.jpg";
					}
					
				}else
				{
						//default..
						$image="users/$user_id/$user_photo";
				}
			}else if($row['account_type']=='f')
			{
				//foundation 

				$query_foundation_info="SELECT `name` , `photo`  FROM `foundations` WHERE `id` = '$user_id' LIMIT 1";
			
				$perform_normal_info=mysqli_query($connect,$query_foundation_info);
				$result=mysqli_fetch_assoc($perform_normal_info);
				
				$username=$result['name'];
				$user_photo=$result['photo'];
			
				if($user_photo==null)
				{
					$image="images/profile_image/default-academy.jpg";
					
				}else
				{
						//default..
						$image="foundations/$user_id/$user_photo";
				}

			}
			
			if($row['account_type']=='p')
			{
				//persons
				//Select the images ....  
			$query_normal_posts_images="SELECT  `images`  FROM normal_posts INNER JOIN normal_post_images ON normal_posts.id = normal_post_images.post_id WHERE normal_post_images.account_id = '$user_id' AND normal_post_images.post_id = '$post_id' AND normal_post_images.account_type='p' ";
			}else if($row['account_type']=='f')
			{
				//foundation
				//Select the images ....  
			$query_normal_posts_images="SELECT  `images`  FROM normal_posts INNER JOIN normal_post_images ON normal_posts.id = normal_post_images.post_id WHERE normal_post_images.account_id = '$user_id' AND normal_post_images.post_id = '$post_id' AND normal_post_images.account_type='f' ";
			}
			
			//echo $query_normal_posts_images;
			$perform_normal_posts_images=mysqli_query($connect,$query_normal_posts_images);	
			

			$number_of_image=mysqli_num_rows($perform_normal_posts_images);
			$date_ago=time_elapsed_string($date, $full = false);
			
			echo 
			"
				<!-- post 2-->
				<div class=\"post\">
					<!-- post header --> 
					<div class=\"post_header\">
						<img class=\"img-responsive\" src=\"$image\" />
						<h5><a href=\"\"> $username </a></h5>
						<span><b>$date_ago</b></span>
						<div class=\"clear\"></div>
					</div>
					<!-- image of the post -->
					";
					if($number_of_image==0)
					{
						echo "	
								<div class=\"caption\">
									<p><h4 style=\"text-indent:20px;background-color:#fff;padding:10px;\" >$caption</h4></p>
								</div>";
					}		
			echo "
					<div class=\"post_image\">
					";
			
					if($number_of_image==1)
					{
						$result_N_P_P=mysqli_fetch_assoc($perform_normal_posts_images);
						if($row['account_type']=='p')
						{
							//person posts photos
							echo 
							"
							<div class=\"main-photo\">
								<img class=\"img-responsive\" src=\"postingattachment/user/$user_id/$post_id/{$result_N_P_P['images']}\" />
							</div>
							";
						}else
						{
							echo 
							"
							<div class=\"main-photo\">
								<img class=\"img-responsive\" src=\"postingattachment/foundation/$user_id/$post_id/{$result_N_P_P['images']}\" />
							</div>
							";
						}
						
						
				
					}
					else if($number_of_image==2)
					{
						//$photo_N_P_P_2=$result_N_P_P[1];
						while($result_N_P_P=mysqli_fetch_assoc($perform_normal_posts_images))
						{
							$count=0;
							if($count==0)
							{
								if($row['account_type']=='p')
								{
									//person posts photos
									echo 
									"
										<div class=\"main-photo\">
											<img class=\"img-responsive\" src=\"postingattachment/user/$user_id/$post_id/{$result_N_P_P['images']}\" />
										</div>
									";
								}else if($row['account_type']=='f')
								{
									//foundation photo posts 
									echo 
									"
										<div class=\"main-photo\">
											<img class=\"img-responsive\" src=\"postingattachment/foundation/$user_id/$post_id/{$result_N_P_P['images']}\" />
										</div>
									";
								}
								
							}else if($count==1)
							{
								if($row['account_type']=='p')
								{
									//person posts photos
									echo 
									"
									<div class=\"rest_photos\">
										<div class=\"R_photo\">
											<img class=\"img-responsive\" src=\"postingattachment/user/$user_id/$post_id/{$result_N_P_P['images']}\" />
											<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=p\" > <span class=\"number_rest_images\">+2<span> </a>
										</div>
										
									</div>";
								}else if($row['account_type']=='f')
								{
									//foundation photo posts 
									echo 
									"
									<div class=\"rest_photos\">
										<div class=\"R_photo\">
											<img class=\"img-responsive\" src=\"postingattachment/foundation/$user_id/$post_id/{$result_N_P_P['images']}\" />
											<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=p\" > <span class=\"number_rest_images\">+2<span> </a>
										</div>
										
									</div>";
								}

							}
							
							$count++;
						}

					} 
					else if($number_of_image>2)
					{
						while($result_N_P_P=mysqli_fetch_assoc($perform_normal_posts_images))
						{
							$result_photo[]=$result_N_P_P['images'];
						}

						
						for($i=0;$i<2;$i++)
						{
							
								if($i==0)
								{
									if($row['account_type']=='p')
									{
										//person posts photos
											echo 
											"
												<div class=\"main-photo\">
													<img class=\"img-responsive\" src=\"postingattachment/user/$user_id/$post_id/{$result_photo[0]}\" />
												</div>
											";
									}else if($row['account_type']=='f')
									{
										//foundation photo posts 
										echo 
										"
											<div class=\"main-photo\">
												<img class=\"img-responsive\" src=\"postingattachment/foundation/$user_id/$post_id/{$result_photo[0]}\" />
											</div>
										";
									}

									
								}else
								{	

									$rest_images_no=$number_of_image-2;
									
									if($row['account_type']=='p')
									{
										//person posts photos
											echo 
											"
											<div class=\"rest_photos\">
												<div class=\"R_photo\">
													<img class=\"img-responsive\" src=\"postingattachment/user/$user_id/$post_id/{$result_photo[1]}\" />
													<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=p\" > <span class=\"number_rest_images\">+{$rest_images_no}<span> </a>
												</div>
												
											</div>";	

									}else if($row['account_type']=='f')
									{
										//foundation photo posts 
										echo 
										"
										<div class=\"rest_photos\">
											<div class=\"R_photo\">
												<img class=\"img-responsive\" src=\"postingattachment/foundation/$user_id/$post_id/{$result_photo[1]}\" />
												<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=f\" > <span class=\"number_rest_images\">+{$rest_images_no}<span> </a>
											</div>
											
										</div>";	

									}
									
								}
									
											
							}	
					}
					
					
					echo "	
					</div>
					<!-- things related with the post -->
					<div class=\"related_contents\">
						";
					$query_person_likes_number="SELECT `id` FROM `likes_normal_post` WHERE `post_id` = '$post_id'  ";
					@$perform_query_person_likes_number=mysqli_query($connect,$query_person_likes_number);
					@$liked_p_number=mysqli_num_rows($perform_query_person_likes_number);
					if($perform_query_person_likes_number)
						{
							echo "	
								<div class=\"likes\">
									<span><b id=\"likes{$post_id}\" >{$liked_p_number}</b></span><span>&nbsp;&nbsp;<a href=\"#\" class=\"liked_pop_up\" >likes</a></span>
									<input type=\"hidden\" class=\"post_id_get_likes\" value=\"$post_id\" />
								</div>
								";

						}
					else{
							echo "	
								<div class=\"likes\">
									<span><b>0</b></span><span>&nbsp;&nbsp;likes</span>
								</div>
								";
					}
					
					if($number_of_image!=0)
					{
						echo "	
						<div class=\"caption\">
							<p>$caption</p>
						</div>";
	
					}				
					



					echo "	
						<div class=\"comments commento\" id=\"normal_comment{$post_id}\">
							";
						$query_comment_normal_post="SELECT `account_id`, `comment`, `post_id`, `date`, `account_type` FROM `comments_normal_post` LIMIT 3";
						$perfrom_query_comment_normal_post=mysqli_query($connect,$query_comment_normal_post);
						while($result_comments=mysqli_fetch_assoc($perfrom_query_comment_normal_post))
						{
							if($row['id']==$result_comments['post_id'])
							{
								$comment=$result_comments['comment'];	
								$date=$result_comments['date'];
								$date=time_elapsed_string($date, $full = false);
								if($result_comments['account_type']=="p")
								{
									$account_id=$result_comments['account_id'];
									$query_username="SELECT `first_name`, `last_name` , `gender` , `photo` FROM `users` WHERE `id`='$account_id' LIMIT 1";
									$perform_query_username=mysqli_query($connect,$query_username);
									$result_name=mysqli_fetch_assoc($perform_query_username);
									$Account_name=$result_name['first_name'].' '.$result_name['last_name'];
									$account_gender=$result_name['gender'];

									if($result_name['photo']==null)
									{
										if($result_name['gender']=='m')
										{	
											$image="images/profile_image/default-person.jpg";
										}else{
											$image="images/profile_image/user_profile_female.jpg";
										}

									}else{
										
										$image="users/".$account_id."/".$result_name['photo'];
									}

									echo "<p><img src='{$image}' /> &nbsp; <span><b> <a href='profile/profile.php?user_id={$account_id}&acc_type=p&gend={$account_gender} '> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";

								}else
								{
									//foundation
									$account_id=$result_comments['account_id'];
									$query_username="SELECT `name` , `photo` FROM `foundations` WHERE `id`='$account_id' LIMIT 1";
									$perform_query_username=mysqli_query($connect,$query_username);
									$result_name=mysqli_fetch_assoc($perform_query_username);
									$Account_name=$result_name['name'];

									if($result_name['photo']==null)
									{
										$image="images/profile_image/default-academy.jpg";
									}else
									{
										$image="foundations/".$account_id."/".$result_name['photo'];
									}

									echo "<p><img src='$image' /> <span><b> <a href='profile/profile.php?f_id={$account_id}&acc_type=f'> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";	
								}
								
								

									
							}
							
						}
							
						

						echo "	
						</div>
						<div class=\"actions\">
							 <div class=\"like_action_area\" id=\"like_action_area{$post_id}\">
								<div id=\"message{$post_id}\" style=\"display:none;color:ff0000; border:1px dashed #ff0000; padding:10px;\">Something Going wrong plz try again ...</div>
								 
								 ";
								 $user_id=$_COOKIE['user_id'];
								 echo
								 "
								 <input type=\"hidden\" class=\"like_post_id\" value=\"{$post_id}\" />
								 <input type=\"hidden\" class=\"like_account_id\" value=\"{$user_id}\" />
								 <input type=\"hidden\" class=\"like_account_type\" value=\"p\" />

								 ";
								 
								 $user_id=$_COOKIE['user_id'];
								 $account_type="p";
								 echo 
								 "
								 	<input type=\"hidden\" class=\"like_post_id\" value=\"{$post_id}\" />
									<input type=\"hidden\" class=\"like_account_id\" value=\"{$user_id}\" />
									<input type=\"hidden\" class=\"like_account_type\" value=\"p\" />

								 ";
								 $query_check_perspn_post_liked="SELECT `id` FROM `likes_normal_post` WHERE `account_id`='$user_id' AND `post_id`='$post_id' AND `account_type`='p' ";
								 $perform_check_perspn_post_liked=mysqli_query($connect,$query_check_perspn_post_liked);
								 if(mysqli_num_rows($perform_check_perspn_post_liked)==0)
								 {
								 	//liked button display

								 	echo "
										 <div class=\"like_btn\" id=\"like_btn{$post_id}\" style=\"display:inline\">
										 	<span><i class=\"fa fa-heart-o fa-2x\" aria-hidden=\"true\"></i></span>
										 </div>
										 ";
								 }else
								 {
								 	//disliked button display
								 
								 	echo "
											<div class=\"unlike_btn\" id=\"unlike_btn{$post_id}\" style=\"display:inline\">
											<span><i class=\"fa fa-heart fa-2x\" aria-hidden=\"true\"></i></span>
											</div>
										 ";
								 }
								 
								 

								 



								 echo "

							 </div>
							 <div class=\"comment\">
							 	<input id=\"Comment_normal_post_person_value{$post_id}\" type=\"text\" name=\"comment\" placeholder=\"Add Comment....\" />
							 	<button id=\"Comment_normal_post\" class=\"comment_btn Comment_normal_post\"><span><i class=\"fa fa-mail-reply fa-lg\" aria-hidden=\"true\"></i></span></button>
								<input type=\"hidden\" class=\"post_id\" value=\"$post_id\" />
								<input type=\"hidden\" class=\"account_id\" value=\"$user_id\" />
								<input type=\"hidden\" class=\"account_type\" value=\"p\" />			 	
							 </div>
						</div>

					</div>
				</div>

			";
			//post id
			echo "<input type=\"hidden\" id=\"comment_id\" value=\"normal_comment{$post_id}\" />"; 
			echo "<input type=\"hidden\" class=\"post_id\" value=\"$post_id\" />";
			if($_COOKIE['Account_type']="person")
			{
				//account_id
				$account_id=$_COOKIE['user_id'];
				echo "<input type=\"hidden\" class=\"account_id\" value=\"$account_id\" />";	
				//account_type
				echo "<input type=\"hidden\" class=\"account_type\" value=\"p\" />";
			}else
			{
				//account_id
				$account_id=$_COOKIE['foundation_id'];
				echo "<input type=\"hidden\" class=\"account_id\" value=\"$account_id\" />";	
				//account_type
				echo "<input type=\"hidden\" class=\"account_type\" value=\"f\" />";
			}
			
			


	}
		}else
		{
			//normal posts from foundations 
			$query_normal_posts="SELECT `id`, `account_id`, `account_type`,`caption`, `date` FROM `normal_posts`  ORDER BY id DESC LIMIT 5";
			$perform_normal_query=mysqli_query($connect,$query_normal_posts);

		while($row=mysqli_fetch_assoc($perform_normal_query))
		{
			$post_id=$row['id'];
			$foundation_id=$row['account_id'];
			$caption=$row['caption'];
			$date=$row['date'];
			
			if($row['account_type']=='f')
			{
				//foundation 
				$query_foundation_info="SELECT `name` , `photo`  FROM `foundations` WHERE `id` = '$foundation_id' LIMIT 1";
			
				$perform_normal_info=mysqli_query($connect,$query_foundation_info);
				$result=mysqli_fetch_assoc($perform_normal_info);
				
				$user_name=$result['name'];
				$user_photo=$result['photo'];
				if($user_photo==null)
				{
					
						$image="../images/profile_image/default-academy.jpg";
					
				}else
				{
						//default..
						$image="foundations/$foundation_id/$user_photo";
				}


			}else if($row['account_type']=='p')
			{
				//person
				$query_user_info="SELECT `first_name`, `last_name` , `photo` ,`gender` FROM `users` WHERE `id` = '$foundation_id' LIMIT 1";
			
				$perform_normal_info=mysqli_query($connect,$query_user_info);
				$result=mysqli_fetch_assoc($perform_normal_info);
				
				$user_name=$result['first_name'].' '.$result['last_name'];
				$user_photo=$result['photo'];
				$gender=$result['gender'];
				if($user_photo==null)
				{
					//check for gender
					if($gender=='m')
					{
						//male
						$image="../images/profile_image/default-person.jpg";
					}else
					{
						//female
						$image="../images/profile_image/user_profile_female.jpg";
					}
					
				}else
				{
						//default..
						$image="users/$foundation_id/$user_photo";
				}

			}
			
		
			if ($row['account_type']=='f') 
			{
				//Select the images ....  
			$query_normal_posts_images="SELECT  `images`  FROM normal_posts INNER JOIN normal_post_images ON normal_posts.id = normal_post_images.post_id WHERE normal_post_images.account_id = '$foundation_id' AND normal_post_images.post_id = '$post_id' AND normal_post_images.account_type = 'f' ";			
			}else if($row['account_type']=='p')
			{
				//Select the images ....  
			$query_normal_posts_images="SELECT  `images`  FROM normal_posts INNER JOIN normal_post_images ON normal_posts.id = normal_post_images.post_id WHERE normal_post_images.account_id = '$foundation_id' AND normal_post_images.post_id = '$post_id' AND normal_post_images.account_type = 'p' ";
			}
			
			//echo $query_normal_posts_images;
			$perform_normal_posts_images=mysqli_query($connect,$query_normal_posts_images);	
			
			
			$number_of_image=mysqli_num_rows($perform_normal_posts_images);
			$date_ago=time_elapsed_string($date, $full = false);
			
			echo 
			"
				<!-- post 2-->
				<div class=\"post\">
					<!-- post header --> 
					<div class=\"post_header\">
						<img class=\"img-responsive\" src=\"$image\" />
						<h5> $user_name </h5>
						<span><b>$date_ago</b></span>
						<div class=\"clear\"></div>
					</div>
					<!-- image of the post -->";
					if($number_of_image==0)
					{
						echo 
							"
							<div class=\"caption\">
								<p><h4 style=\"text-indent:20px;background-color:#fff;padding:10px;\" >$caption</h4></p>
							</div>";	
					}

				echo 
				"	
					<div class=\"post_image\">
					";
					if($number_of_image==1)
					{
						
						$result_N_P_f=mysqli_fetch_assoc($perform_normal_posts_images);
						
						if($row['account_type']=='f')
						{
							//foundation post photo
							echo 
							"
							<div class=\"main-photo\">
								<img class=\"img-responsive\" src=\"postingattachment/foundation/$foundation_id/$post_id/{$result_N_P_f['images']}\" />
							</div>
							";
						}else if($row['account_type']=='p')
						{
							//person post photos
							echo 
							"
							<div class=\"main-photo\">
								<img class=\"img-responsive\" src=\"postingattachment/user/$foundation_id/$post_id/{$result_N_P_f['images']}\" />
							</div>
							";
						}
						
					}
					else if($number_of_image==2)
					{
						//$photo_N_P_P_2=$result_N_P_P[1];
						while($result_N_P_f=mysqli_fetch_assoc($perform_normal_posts_images))
						{
							$count=0;
							if($count==0)
							{
								

								if($row['account_type']=='f')
								{
									//foundation post photo
									echo 
									"
										<div class=\"main-photo\">
											<img class=\"img-responsive\" src=\"postingattachment/foundation/$foundation_id/$post_id/{$result_N_P_f['images']}\" />
										</div>
									";
								}else if($row['account_type']=='p')
								{
									//person post photos
									echo 
									"
										<div class=\"main-photo\">
											<img class=\"img-responsive\" src=\"postingattachment/user/$foundation_id/$post_id/{$result_N_P_f['images']}\" />
										</div>
									";
								}

							}else if($count==1)
							{

								if($row['account_type']=='f')
								{
									//foundation post photo
									echo 
									"
									<div class=\"rest_photos\">
										<div class=\"R_photo\">
											<img class=\"img-responsive\" src=\"postingattachment/foundation/$foundation_id/$post_id/{$result_N_P_f['images']}\" />
											<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=f\" > <span class=\"number_rest_images\">+2<span> </a>
										</div>
										
									</div>";
								}else if($row['account_type']=='p')
								{
									//person post photos
									echo 
									"
									<div class=\"rest_photos\">
										<div class=\"R_photo\">
											<img class=\"img-responsive\" src=\"postingattachment/user/$foundation_id/$post_id/{$result_N_P_f['images']}\" />
											<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=p\" > <span class=\"number_rest_images\">+2<span> </a>
										</div>
										
									</div>";
								}

									
							}
							
							$count++;
						}	
					} 
					else if($number_of_image>2)
					{
						//$photo_N_P_P_2=$result_N_P_P[1];
						while($result_N_P_f=mysqli_fetch_assoc($perform_normal_posts_images))
						{
							$result_photo[]=$result_N_P_f['images'];
						}

						
						for($i=0;$i<2;$i++)
						{
							
								if($i==0)
								{

									if($row['account_type']=='f')
									{
										//foundation post photo
										echo 
										"
											<div class=\"main-photo\">
												<img class=\"img-responsive\" src=\"postingattachment/foundation/$foundation_id/$post_id/{$result_photo[0]}\" />
											</div>
										";
									}else if($row['account_type']=='p')
									{
										//person post photos
										echo 
										"
											<div class=\"main-photo\">
												<img class=\"img-responsive\" src=\"postingattachment/user/$foundation_id/$post_id/{$result_photo[0]}\" />
											</div>
										";
									}
									
								}else
								{	$rest_images_no=$number_of_image-2;

									if($row['account_type']=='f')
									{
										//foundation post photo
										echo 
										"
										<div class=\"rest_photos\">
											<div class=\"R_photo\">
												<img class=\"img-responsive\" src=\"postingattachment/foundation/$foundation_id/$post_id/{$result_photo[1]}\" />
												<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$foundation_id}&&account_type=f\" > <span class=\"number_rest_images\">+{$rest_images_no}<span> </a>
											</div>
											
										</div>";
									}else if($row['account_type']=='p')
									{
										//person post photos
										echo 
										"
										<div class=\"rest_photos\">
											<div class=\"R_photo\">
												<img class=\"img-responsive\" src=\"postingattachment/user/$foundation_id/$post_id/{$result_photo[1]}\" />
												<a href=\"posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$foundation_id}&&account_type=p\" > <span class=\"number_rest_images\">+{$rest_images_no}<span> </a>
											</div>
											
										</div>";
									}

										

								}
									
											
							}	
					}
					
					
					echo "	
					</div>
					<!-- things related with the post -->
					<div class=\"related_contents\">
					";
						$query_foundation_likes_number="SELECT `id` FROM `likes_normal_post` WHERE `post_id` = '$post_id'  ";
						@$perform_query_foundation_likes_number=mysqli_query($connect,$query_foundation_likes_number);
						@$liked_f_number=mysqli_num_rows($perform_query_foundation_likes_number);
						if($perform_query_foundation_likes_number)
							{
								echo "	
									<div class=\"likes\">
										<span><b id=\"likes{$post_id}\" >{$liked_f_number}</b></span><span>&nbsp;&nbsp;<a href=\"#\" class=\"liked_pop_up\" >likes</a></span>
										<input type=\"hidden\" class=\"post_id_get_likes\" value=\"$post_id\" />
									</div>
									";

							}
						else{
								echo "	
									<div class=\"likes\">
										<span><b>0</b></span><span>&nbsp;&nbsp;likes</span>
									</div>
									";
						}

						if($number_of_image!=0)
						{
							echo 
							"
							<div class=\"caption\">
								<p>$caption</p>
							</div>";	
						}
						


						echo "
						<div class=\"comments commento\"  id=\"normal_comment{$post_id}\">
						";
						
						$query_comment_normal_post="SELECT `account_id`, `comment`, `post_id`, `date`, `account_type` FROM `comments_normal_post` LIMIT 3";
						$perfrom_query_comment_normal_post=mysqli_query($connect,$query_comment_normal_post);
						while($result_comments=mysqli_fetch_assoc($perfrom_query_comment_normal_post))
						{
							if($row['id']==$result_comments['post_id'])
							{
								$comment=$result_comments['comment'];	
								$date=$result_comments['date'];
								$date=time_elapsed_string($date, $full = false);
								if($result_comments['account_type']=="p")
								{
									$account_id=$result_comments['account_id'];
									$query_username="SELECT `first_name`, `last_name` , `gender` , `photo` FROM `users` WHERE `id`='$account_id' LIMIT 1";
									$perform_query_username=mysqli_query($connect,$query_username);
									$result_name=mysqli_fetch_assoc($perform_query_username);
									$Account_name=$result_name['first_name'].' '.$result_name['last_name'];
									$account_gender=$result_name['gender'];

									if($result_name['photo']==null)
									{
										if($result_name['gender']=='m')
										{	
											$image="images/profile_image/default-person.jpg";
										}else{
											$image="images/profile_image/user_profile_female.jpg";
										}

									}else{
										
										$image="users/".$account_id."/".$result_name['photo'];
									}

									echo "<p><img src='{$image}' /> &nbsp; <span><b> <a href='profile/profile.php?user_id={$account_id}&acc_type=p&gend={$account_gender} '> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";

								}else
								{
									//foundation
									$account_id=$result_comments['account_id'];
									$query_username="SELECT `name` , `photo` FROM `foundations` WHERE `id`='$account_id' LIMIT 1";
									$perform_query_username=mysqli_query($connect,$query_username);
									$result_name=mysqli_fetch_assoc($perform_query_username);
									$Account_name=$result_name['name'];

									if($result_name['photo']==null)
									{
										$image="images/profile_image/default-academy.jpg";
									}else
									{
										$image="foundations/".$account_id."/".$result_name['photo'];
									}

									echo "<p><img src='$image' /> <span><b> <a href='profile/profile.php?f_id={$account_id}&acc_type=f'> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";	
								}
								
								

									
							}
							
						}
							
					

						
					$foundation_id=$_COOKIE['foundation_id'];			 
					echo
						"
						</div>
						<div class=\"actions\">
												 
							 <div class=\"like_action_area\" id=\"like_action_area{$post_id}\" style=\"display:inline;\">
							 	<div id=\"message_f{$post_id}\" style=\"display:none;color:ff0000; border:1px dashed #ff0000; padding:10px;\">Something Going wrong plz try again ...</div>
								<input type=\"hidden\" class=\"like_post_id\" value=\"{$post_id}\" />
								<input type=\"hidden\" class=\"like_account_id\" value=\"{$foundation_id}\" />
								<input type=\"hidden\" class=\"like_account_type\" value=\"f\" />		
							";
								
								 

								$foundation_id=$_COOKIE['foundation_id'];
								$account_type="f";

								echo 
								"
									<input type=\"hidden\" class=\"like_post_id\" value=\"{$post_id}\" />
									<input type=\"hidden\" class=\"like_account_id\" value=\"{$foundation_id}\" />
									<input type=\"hidden\" class=\"like_account_type\" value=\"f\" />		
								";

								 $query_check_perspn_post_liked="SELECT `id` FROM `likes_normal_post` WHERE `account_id`='$foundation_id' AND `post_id`='$post_id' AND `account_type`='f' ";
								 $perform_check_perspn_post_liked=mysqli_query($connect,$query_check_perspn_post_liked);
								 if(mysqli_num_rows($perform_check_perspn_post_liked)==0)
								 {
								 	//liked button display
									echo
										"<div class=\"like_btn\" id=\"like_btn{$post_id}\" style=\"display:inline;\">
										 	<span><i class=\"fa fa-heart-o fa-2x\" aria-hidden=\"true\"></i></span>
										 </div>
										
										 ";	 
								 }else
								 {
								 	//disliked button display
									echo "	 
										 <div class=\"unlike_btn\" id=\"unlike_btn{$post_id}\" style=\"display:inline\">
										 	<span><i class=\"fa fa-heart fa-2x\" aria-hidden=\"true\"></i></span>
										 </div>
										 ";

								 }

							
							
							echo "	 
							 </div>
							 
							 <div class=\"comment\">
							 	<input type=\"text\" name=\"comment\" id=\"Comment_normal_post_value\" placeholder=\"Add Comment....\" />
							 	<button class=\"comment_btn Comment_normal_post\" id=\"Comment_normal_post\"><span><i class=\"fa fa-mail-reply fa-lg\" aria-hidden=\"true\"></i></span></button>
								<input type=\"hidden\" class=\"foundation_post_id\" value=\"$post_id\" />
								<input type=\"hidden\" class=\"account_id\" value=\"$foundation_id\" />
								<input type=\"hidden\" class=\"account_type\" value=\"f\" />									 
							 </div>
						</div>

					</div>
				</div>

			";
			//post id 
			echo "<input type=\"hidden\" id=\"foundation_post_id\" value=\"$post_id\" />";
			if($_COOKIE['Account_type']="foundation")
			{
				//account_id
				$account_id=$_COOKIE['foundation_id'];
				echo "<input type=\"hidden\" id=\"account_id\" value=\"$account_id\" />";	
				//account_type
				echo "<input type=\"hidden\" id=\"account_type\" value=\"f\" />";
				
			}else
			{
				//account_id
				$account_id=$_COOKIE['user_id'];
				echo "<input type=\"hidden\" id=\"account_id\" value=\"$account_id\" />";	
				//account_type
				echo "<input type=\"hidden\" id=\"account_type\" value=\"p\" />";
			}
		}
		}
		

		
?>
<script type="text/javascript">
	/*end display posts */
	$(".like_btn").click(function(){
		$(this).hide();
		//$(this).siblings(".unlike_btn").css("display","inline");
		var post_id=$(this).siblings(".like_post_id").val();
		var account_id=$(this).siblings(".like_account_id").val();
		var account_type=$(this).siblings(".like_account_type").val();
		action_like(post_id,account_id,account_type);		
	});

	function action_like(post_id,account_id,account_type){
			
			
			// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
			//get account_id,post_id,accout_type
			var like_post_id=post_id;
			var like_account_id=account_id;
			var like_account_type=account_type;
			var url = "posting_person/like_action.php";
	        var vars = "like_post_id="+like_post_id+"&like_account_id="+like_account_id+"&like_account_type="+like_account_type;
		
	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				var jArrayLikes=return_data;
				if(jArrayLikes!=null)
				{
					jArrayLikes=JSON.parse(jArrayLikes);	
					console.log(jArrayLikes);
					$.each( jArrayLikes, function( key, value ){
						
						if(value.liked_berfore==0)
						{
							//doen't liked before
							//check the liked process 
							if(value.like_stauts=='like_btn')
							{
								//add dislike button
								$("#unlike_btn"+value.post_id).remove();
								$("#like_action_area"+value.post_id).append("<div class=\"unlike_btn\" id=\"unlike_btn"+value.post_id+"\" style=\"display:inline\"><span><i class=\"fa fa-heart fa-2x\" aria-hidden=\"true\"></i></span></div>");				
								$likes=parseInt($("#likes"+value.post_id).html());
								$likes=$likes+1;
								$("#likes"+value.post_id).html($likes);
								//remove the like button
								$("#like_btn"+value.post_id).remove();
									$(".unlike_btn").click(function(){
										//$(this).hide();
										//$(this).siblings(".like_btn").css("display","inline");
										
										var post_id=$(this).siblings(".like_post_id").val();
										var account_id=$(this).siblings(".like_account_id").val();
										var account_type=$(this).siblings(".like_account_type").val();
										
										action_unlike(post_id,account_id,account_type);
									});
							}else if(value.like_stauts=='dislike_btn')
							{
								//add like button
								$("#like_btn"+value.post_id).remove();
								$("#like_action_area"+value.post_id).append(" <div class=\"like_btn\" id=\"like_btn"+value.post_id+"\" style=\"display:inline\"><span><i class=\"fa fa-heart-o fa-2x\" aria-hidden=\"true\"></i></span></div>");
								//remove the dislike button
								$("#unlike_btn"+value.post_id).remove();
								
								$(".like_btn").click(function(){
									$(this).hide();
									//$(this).siblings(".unlike_btn").css("display","inline");
									var post_id=$(this).siblings(".like_post_id").val();
									var account_id=$(this).siblings(".like_account_id").val();
									var account_type=$(this).siblings(".like_account_type").val();
									
									action_like(post_id,account_id,account_type);		
								});

							}else
							{
								//something going wrong 
								//add like button
								$("#like_btn"+value.post_id).remove();
								$("#like_action_area"+value.post_id).append(" <div class=\"like_btn\" id=\"like_btn"+value.post_id+"\" style=\"display:inline\"><span><i class=\"fa fa-heart-o fa-2x\" aria-hidden=\"true\"></i></span></div>");
								//remove the dislike button
								$("#unlike_btn"+value.post_id).remove();
								$("#message"+value.post_id).html(value.like_message);
								$("#message"+value.post_id).css('display','none');
								$(".like_btn").click(function(){
									$(this).hide();
									//$(this).siblings(".unlike_btn").css("display","inline");
									var post_id=$(this).siblings(".like_post_id").val();
									var account_id=$(this).siblings(".like_account_id").val();
									var account_type=$(this).siblings(".like_account_type").val();
									
									action_like(post_id,account_id,account_type);		
								});
							} 
						}else
						{
							//this post liked before 
							//add dislike button
							$("#unlike_btn"+value.post_id).remove();
							$("#like_action_area"+value.post_id).append("<div class=\"unlike_btn\" id=\"unlike_btn"+value.post_id+"\" style=\"display:inline\"><span><i class=\"fa fa-heart fa-2x\" aria-hidden=\"true\"></i></span></div>");				
							//remove the like button
							$("#like_btn"+value.post_id).remove();
							$("#message"+value.post_id).html(value.like_message);
							$("#message"+value.post_id).css('display','none');
								$(".unlike_btn").click(function(){
									//$(this).hide();
									//$(this).siblings(".like_btn").css("display","inline");
									
									var post_id=$(this).siblings(".like_post_id").val();
									var account_id=$(this).siblings(".like_account_id").val();
									var account_type=$(this).siblings(".like_account_type").val();
									
									action_unlike(post_id,account_id,account_type);
								});
						}

					});	
				}
				

		    }else{
	            //alert("i'm working");
	        }
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request
			
		}

	$(".unlike_btn").click(function(){
		//$(this).hide();
		//$(this).siblings(".like_btn").css("display","inline");
		
		var post_id=$(this).siblings(".like_post_id").val();
		var account_id=$(this).siblings(".like_account_id").val();
		var account_type=$(this).siblings(".like_account_type").val();
		
		action_unlike(post_id,account_id,account_type);
	});

	function action_unlike(post_id,account_id,account_type){
		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
		//get account_id,post_id,accout_type
		var like_post_id=post_id;
		var like_account_id=account_id;
		var like_account_type=account_type;
		
		

		var url = "posting_person/dislike_action.php";
        var vars = "like_post_id="+like_post_id+"&like_account_id="+like_account_id+"&like_account_type="+like_account_type;
	
        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		 hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				var jArrayDislikes=return_data;

				// console.log(jArrayDislikes);
				if(jArrayDislikes!=null)
				{
					jArrayDislikes=JSON.parse(jArrayDislikes);	
	
					$.each( jArrayDislikes, function( key, value ){

						//console.log(value.like_stauts);
						//check the liked process 
						if(value.like_stauts=='like_btn')
						{

							//add like button
							$("#like_btn"+value.post_id).remove();
							$("#like_action_area"+value.post_id).append(" <div class=\"like_btn\" id=\"like_btn"+value.post_id+"\" style=\"display:inline\"><span><i class=\"fa fa-heart-o fa-2x\" aria-hidden=\"true\"></i></span></div>");
							
							$likes=parseInt($("#likes"+value.post_id).html());
							$likes=$likes-1;
							$("#likes"+value.post_id).html($likes);
							
							//remove the dislike button
							$("#unlike_btn"+value.post_id).remove();
							
							$(".like_btn").click(function(){
								$(this).hide();
								//$(this).siblings(".unlike_btn").css("display","inline");
								var post_id=$(this).siblings(".like_post_id").val();
								var account_id=$(this).siblings(".like_account_id").val();
								var account_type=$(this).siblings(".like_account_type").val();
								
								action_like(post_id,account_id,account_type);		
							});
							
						}else if(value.like_stauts=='dislike_btn')
						{
							//add dislike button
							$("#unlike_btn"+value.post_id).remove();
							$("#like_action_area"+value.post_id).append("<div class=\"unlike_btn\" id=\"unlike_btn"+value.post_id+"\" style=\"display:inline\"><span><i class=\"fa fa-heart fa-2x\" aria-hidden=\"true\"></i></span></div>");				
							//remove the like button
							$("#like_btn"+value.post_id).remove();
							$(".unlike_btn").click(function(){
									//$(this).hide();
									//$(this).siblings(".like_btn").css("display","inline");
									
									var post_id=$(this).siblings(".like_post_id").val();
									var account_id=$(this).siblings(".like_account_id").val();
									var account_type=$(this).siblings(".like_account_type").val();
									
									action_unlike(post_id,account_id,account_type);
								});

						}else
						{
							// //something going wrong 
							// //add dislike button
							// $("#like_area"+value.post_id).append("<div class=\"unlike_btn\" id=\"unlike_btn"+value.post_id+"\" style=\"display:inline\"><span><i class=\"fa fa-heart fa-2x\" aria-hidden=\"true\"></i></span></div>");				
							// //remove the like button
							// $("#like_btn"+value.post_id).remove();
							// $("#message"+value.post_id).html(value.like_message);
							// $("#message"+value.post_id).css('display','none');
						}

					});
				}	
			
			}
		}
		// Send the data to PHP now... and wait for response to update the status div
	    hr.send(vars); // Actually execute the request
	}	

	
	

	// store comment for persons normal posts
	$(".Comment_normal_post").click(function(){
		var comment=$(this).prev().val();
		var post_id=$(this).next().val();
		var account_id=$(this).siblings(".account_id").val();
		var account_type=$(this).siblings(".account_type").val();
		store_normal_post_comment(comment,post_id,account_id,account_type);		
	});	
	
	function store_normal_post_comment(comment,post_id,account_id,account_type){
      
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var post_id=post_id;
        var Comment_normal_post=comment;
        var account_id=account_id;
        var account_type=account_type;
        var url = "posting_person/store_posts.php";
        var vars = "comment="+Comment_normal_post+"&post_id="+post_id+"&account_id="+account_id+"&account_type="+account_type;
        
        $(".comments").append("<span style='padding-left:20px;font-size:12px;color:#ccc;'>Processing...</span>");
        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
	    
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			//$(".comments").append(return_data);
	    }else{
            //alert("i'm working");
        }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        
    }

	
    setInterval(function(){
    	display_comment_normal_post();
    	
    },"2000");

   
	function display_comment_normal_post()
    {

     	// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var url = "posting_person/display_comment_normal_post.php";
        var vars = "";

        //$(".comments").html("<span style='padding-left:20px;font-size:12px;color:#ccc;'>Processing...</span>");
        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
	    
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			var jArrayComment=return_data;
			
			// console.log(jArrayComment);
			
			

			// alert("hell");
			if(jArrayComment!=null)
			{
				

				jArrayComment=JSON.parse(jArrayComment);
				
				$(".commento").html('');

				$.each( jArrayComment, function( key, value ) {
 						 
 					 if(value.account_type=='p')
 					 {

 					 	$("#normal_comment"+value.post_id).append("<p><img src='"+value.image+"' /> &nbsp; <span><b> <a href='profile/profile.php?user_id="+value.account_id+"&acc_type=p&gend="+value.gender+"'>"+ value.name + "</a> </b>:</span> <span> "+value.comment+" </span> &nbsp; <strong>"+value.date+"</strong></p>");
 					 }else if(value.account_type=='f')
 					 {
 					 	
 						$("#normal_comment"+value.post_id).append("<p><img src='"+value.image+"' /> &nbsp; <span><b> <a href='profile/profile.php?f_id="+value.account_id+"&acc_type=f'> "+value.name+" </a> </b>:</span> <span> "+value.comment+" </span> &nbsp; <strong>"+value.date+"</strong></p>");	 	
 					 }
				
				}); 
				
			 	
			}
			
	    
	    }else{
            // alert("i'm working");
        }

        };
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request

    }

		

</script>

	
	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="liked_normal_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	        <h4 class="text-center h4">people and foundation that likes this post</h4>
	        <div class="option_suggest">
	        	
	        	<ul class="list-unstyled list_liked_accounts">
	        		<!-- <li><img src="images/profile_image/Capture1.PNG" title="ahemd alesdkasd"/> <a href="#">Ahmed salewm</a> <span>F</sapn></li>
	        		<li><img src="images/profile_image/Capture1.PNG" title="ahemd alesdkasd"/> <a href="#">Ahmed salewm</a> <span>P</sapn></li> -->
	        	</ul>
	        	
	        </div>
	        
	      </div>

	      <div class="modal-body mod_body_setting_suggested cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>


	<!-- pop up of logout model -->
    <!-- Modal -->
	<!-- <div class="modal fade fading_opacity" id="liked_normal_post_f" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	        <h4 class="text-center h4">people and foundation that likes this post</h4>
	        <div class="option_suggest">
	        	
	        	<ul class="list-unstyled list_liked_accounts">
	 -->        		<!-- <li><img src="images/profile_image/Capture1.PNG" title="ahemd alesdkasd"/> <a href="#">Ahmed salewm</a> <span>F</sapn></li>
	        		<li><img src="images/profile_image/Capture1.PNG" title="ahemd alesdkasd"/> <a href="#">Ahmed salewm</a> <span>P</sapn></li> -->
	<!--         	</ul>
	        	
	        </div>
	        
	      </div>

	      <div class="modal-body mod_body_setting_suggested cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>
 -->
<!-- the end of pop up of logout model -->



<script type="text/javascript">
	$('.liked_pop_up').click(function(){
			var post_id=$(this).parent().siblings(".post_id_get_likes").val();
			get_number_of_likes(post_id);
			$('#liked_normal_post').modal('show');
	});
	
	// $('.liked_f_pop_up').click(function(){
			

	// 		var post_id=$(this).parent().siblings(".post_id_get_likes_f").val();
	// 		get_number_of_likes_f(post_id);
	// 		$('#liked_normal_post_f').modal('show');
	// });

	function get_number_of_likes(post_id)
	{
		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
		//get account_id,post_id,accout_type
		var like_post_id=post_id;
		
		

		var url = "posting_person/get_likes_normal_post.php";
        var vars = "get_like_post_id="+like_post_id;
	
        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		 hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				var jArraygetlikes=return_data;

				console.log(jArraygetlikes);
				$(".option_suggest .list_liked_accounts").html("There's no one like This post");
				if(jArraygetlikes!=null)
				{
					jArraygetlikes=JSON.parse(jArraygetlikes);	
					$(".option_suggest .list_liked_accounts").html("");
					
					$.each( jArraygetlikes, function( key, value ){
						
					
					if(value.account_type=='p')
					{
						//person
						$(".option_suggest .list_liked_accounts ").append("<li><img src=\""+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?user_id="+value.account_id+"&acc_type="+value.account_type+"&gend="+value.gender+"\">"+value.name+"</a> <span style=\"display:block text-align:center;\">"+value.date+"</sapn></li>");
					}else if(value.account_type=='f')
					{
						//foundation
						$(".option_suggest .list_liked_accounts ").append("<li><img src=\""+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?f_id="+value.account_id+"&acc_type="+value.account_type+"\">"+value.name+"</a> <span style=\"display:block text-align:center;\">"+value.date+"</sapn></li>");
					}

					});
				}	
			
			}
		}
		// Send the data to PHP now... and wait for response to update the status div
	    hr.send(vars); // Actually execute the request
		
	}

	// function get_number_of_likes_f(post_id)
	// {
	// 	// Create our XMLHttpRequest object
 //        var hr = new XMLHttpRequest();
 //        // Create some variables we need to send to our PHP file    
	// 	//get account_id,post_id,accout_type
	// 	var like_post_id=post_id;
		
		

	// 	var url = "posting_person/get_likes_f_normal_post.php";
 //        var vars = "get_like_post_id="+like_post_id;
	
 //        hr.open("POST", url, true);
    
 //        // Set content type header information for sending url encoded variables in the request
 //        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
	// 	 hr.onreadystatechange = function() {
		    
	// 	    if(hr.readyState == 4 && hr.status == 200) {
	// 		    var return_data = hr.responseText;
	// 			var jArraygetlikes=return_data;

	// 			console.log(jArraygetlikes);
	// 			$(".option_suggest .list_liked_accounts").html("There's no one like This post");
	// 			if(jArraygetlikes!=null)
	// 			{
	// 				jArraygetlikes=JSON.parse(jArraygetlikes);	
	// 				$(".option_suggest .list_liked_accounts").html('');
	// 				$.each( jArraygetlikes, function( key, value ){

	// 				if(value.account_type=='p')
	// 				{
	// 					//person
	// 					$(".option_suggest .list_liked_accounts ").append("<li><img src=\""+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?user_id="+value.account_id+"&acc_type="+value.account_type+"gend="+value.gender+"\">"+value.name+"</a> <span style=\"display:block text-align:center;\">"+value.date+"</sapn></li>");
	// 				}else
	// 				{
	// 					//foundation
	// 					$(".option_suggest .list_liked_accounts ").append("<li><img src=\""+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?f_id="+value.account_id+"&acc_type="+value.account_type+"\">"+value.name+"</a> <span style=\"display:block text-align:center;\">"+value.date+"</sapn></li>");
	// 				}

	// 				});
	// 			}	
			
	// 		}
	// 	}
	// 	// Send the data to PHP now... and wait for response to update the status div
	//     hr.send(vars); // Actually execute the request
		
	// }
</script>