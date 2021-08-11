<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");
?>
<html>
<head>
	<title>Normal Post</title>
	<!-- tab icon -->
	<link rel="apple-touch-icon" sizes="57x57" href="../images/logo/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../images/logo/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../images/logo/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../images/logo/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../images/logo/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../images/logo/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../images/logo/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../images/logo/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../images/logo/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="../images/logo/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../images/logo/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../images/logo/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../images/logo/favicon-16x16.png">
	<link rel="manifest" href="../images/logo/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- stylig links-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	

	<link rel="stylesheet" type="text/css" href="../css/profile.css">
	<link rel="stylesheet" type="text/css" href="../css/post.css">
	<link rel="stylesheet" type="text/css" href="../css/post_normal_display.css">
	<link rel="stylesheet" type="text/css" href="../css/post_profile.css">
	<link rel="stylesheet" type="text/css" href="../css/media.css">

</head>
<body>
<?php
		if($_COOKIE['Account_type']=="person" && $_COOKIE['Account_type']=="person")
		{
			check_login_person();
		}else if($_COOKIE['Account_type']=="foundation" && $_COOKIE['Account_type']=="foundation")
		{
			check_login_foundation();
		}else{
			$message="<span style='color:#ff0000;'>* Conflict Ocurrs</span>";
			$_SESSION['Message_login']=$message;
			header('location: logout.php');
		}
	?>
<!-- header section -->
	<div class="profile_header">

		<div class="container">
			<div class="col-md-4 col-sm-4 col-xs-4">
				<div class="logo">
					<img class="img-responsive" src="../images/logo/Capture.PNG" />
				</div>
			</div>
			<div class="col-md-4 col-sm-4 hidden-xs">
				<div class="search">
					<input type="text" id="Main_search" name="search" placeholder="Search @person or @Institution..">
					<div class="search_option" id="search_option_box">
						
					</div>
					<div class="search_result" style="display:none;" id="search_result_box">
						<div class="element">
							<img src="images/profile_image/Capture1.PNG"/>
							<h4 class="text-center" style="color:#3897f0;">No Result For Your Search ...</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-8">
				<div class="options">
					<ul class="list-unstyled option">
						<li><a href="../Main.php"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a></li>
						<?php if($_COOKIE['Account_type']=="person"): ?>
						<li><a href="../profile.php?user_id=<?php echo $_COOKIE['user_id'];?>"><i class="fa fa-male fa-2x" aria-hidden="true"></i></a></li>
						<?php else: ?>
						<li><a href="../profile.php?f_id=<?php echo $_COOKIE['foundation_id'];?>"><i class="fa fa-male fa-2x" aria-hidden="true"></i></a></li>
						<?php endif;?>
						<li><a href="#"><i class="fa fa-bell fa-2x" aria-hidden="true"></i></a></li>
						<li><a href="../messaging/messaging.php"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- start updating normal post notification -->
	<?php
		if(isset($_GET['post_no'])&&isset($_GET['account_id'])&&isset($_GET['account_type'])&&isset($_GET['noti']))
		{
			if(@$_GET['noti']=='noti_normal')
			{
				$account_id_normal=@$_GET['account_id'];
				$account_type_normal=@$_GET['account_type'];
				$normal_num=@$_GET['post_no'];
				$query_update_normal_noti="INSERT INTO `normal_post_noti_seen` (`normal_post_id`, `account_id`, `account_type`) VALUES ('$normal_num','$account_id_normal','$account_type_normal')";
				$perform_query_update_normal_noti=mysqli_query($connect,$query_update_normal_noti);
			}
		}												
	?>
	<!-- end updating normal post notification -->

	<div class="container post_area">
		<div class="post">

		<div class="normal_post_container">
			<div class="normal_post_content" id="normal_post_content">
				


				<?php

						if($_GET['account_type']=='p')
						{
							$post_no=$_GET['post_no'];
							$user_no=$_GET['account_id'];

							//normal posts from foundations
							$query_normal_posts="SELECT `id`, `account_id`, `caption`, `date` FROM `normal_posts` WHERE `id`= '$post_no' AND `account_id` = '$user_no' LIMIT 1";

							$perform_normal_query=mysqli_query($connect,$query_normal_posts);

							$row=mysqli_fetch_assoc($perform_normal_query);
							
								$post_id=$row['id'];
								$user_id=$row['account_id'];
								$caption=$row['caption'];
								$date=$row['date'];
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
										$image="../images/profile_image/default-person.jpg";
									}else
									{
										//female
										$image="../images/profile_image/user_profile_female.jpg";
									}
									
								}else
								{
										//default..
										$image="../users/$user_id/$user_photo";
								}
							
								//Select the images ....  
								$query_normal_posts_images="SELECT  `images`  FROM normal_posts INNER JOIN normal_post_images ON normal_posts.id = normal_post_images.post_id WHERE normal_posts.account_id = '$user_id' AND normal_post_images.post_id = '$post_id' ";
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
											<h5> $username </h5>
											<span><b>$date_ago</b></span>
											<div class=\"clear\"></div>
										</div>
										<!-- image of the post -->
										<div class=\"post_image\">
										";
										while($result_N_P_P=mysqli_fetch_assoc($perform_normal_posts_images))
										{
											$photo_dis_N=$result_N_P_P["images"];
											echo 
											"
											<div class=\"main-photo\">
												<img class=\"img-responsive\" src=\"../postingattachment/user/$user_id/$post_no/$photo_dis_N\" />
											</div>
											";

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



											echo 
											"
											<div class=\"caption\">
												<p>$caption</p>
											</div>
											<div class=\"comments\" id=\"comment\">
											";
											$query_comment_normal_post="SELECT `account_id`, `comment`, `post_id`, `date`, `account_type` FROM `comments_normal_post` WHERE `post_id`='$post_id' ";
											$perfrom_query_comment_normal_post=mysqli_query($connect,$query_comment_normal_post);
											while($result_comments=mysqli_fetch_assoc($perfrom_query_comment_normal_post))
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
																$image="../images/profile_image/default-person.jpg";
															}else{
																$image="../images/profile_image/user_profile_female.jpg";
															}

														}else{
															
															$image="../users/".$account_id."/".$result_name['photo'];
														}

														echo "<p><img src='{$image}' /> &nbsp; <span><b> <a href='profile/profile.php?user_id={$account_id}&acc_type=p&gend={$account_gender} '> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";

													}else if($result_comments['account_type']=='f')
													{
														//foundation
														$account_id=$result_comments['account_id'];
														$query_username="SELECT `name` , `photo` FROM `foundations` WHERE `id`='$account_id' LIMIT 1";
														$perform_query_username=mysqli_query($connect,$query_username);
														$result_name=mysqli_fetch_assoc($perform_query_username);
														$Account_name=$result_name['name'];

														if($result_name['photo']==null)
														{
															$image="../images/profile_image/default-academy.jpg";
														}else
														{
															$image="../foundations/".$account_id."/".$result_name['photo'];
														}

														echo "<p><img src='$image' /> <span><b> <a href='profile/profile.php?f_id={$account_id}&acc_type=f'> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";	
													}	
												
											}
											echo 
											"												
											</div>
											<div class=\"actions\">
											 <div class=\"like_action_area\" id=\"like_action_area{$post_id}\">
												<div id=\"message{$post_id}\" style=\"display:none;color:ff0000; border:1px dashed #ff0000; padding:10px;\">Something Going wrong plz try again ...</div>
												 
												 ";
												 
												 if($_COOKIE['Account_type']=='person')
												 {
												 	$user_id=$_COOKIE['user_id'];
												 	$AAc_type='p';	
												 }else if($_COOKIE['Account_type']=="foudnation")
												 {
												 	$user_id=$_COOKIE['foundation_id'];
												 	$AAc_type='f';
												 }
											 	
												 echo 
												 "
												 
												 <input type=\"hidden\" class=\"like_post_id\" value=\"{$post_id}\" />
												 <input type=\"hidden\" class=\"like_account_id\" value=\"{$user_id}\" />
												 <input type=\"hidden\" class=\"like_account_type\" value=\"{$AAc_type}\" />

												 ";
												 if($_COOKIE['Account_type']=='person')
												 {
												 	$Acc_id=$_COOKIE['user_id'];
												 	$Acc_type='p';

												 }else if($_COOKIE['Account_type']=='foundation')
												 {
												 	$Acc_id=$_COOKIE['foundation_id'];
												 	$Acc_type='f';
												 }

												 $query_check_perspn_post_liked="SELECT `id` FROM `likes_normal_post` WHERE `account_id`='$Acc_id' AND `post_id`='$post_id' AND `account_type`='$Acc_type' ";
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
												 	<input type=\"text\" name=\"comment\" id=\"comment_input\" placeholder=\"Add Comment....\" />
												 	
												 	<button class=\"comment_btn\" id=\"comment_btn\"><span><i class=\"fa fa-mail-reply fa-lg\" aria-hidden=\"true\"></i></span></button>
												 	<input type=\"hidden\" class=\"post_id\" value=\"$post_id\"/>
												 	<input type=\"hidden\" class=\"account_id\" value=\"$Acc_id\"/>";
												 	
												 	if($_COOKIE['Account_type']=='person')
											 		{
											 			echo
													 	"
													 	<input type=\"hidden\" class=\"account_type\" value=\"p\"/>
													 	";	
											 		}
												 	else if($_COOKIE['Account_type']=='foundation')
												 	{
												 		echo
													 	"
													 	<input type=\"hidden\" class=\"account_type\" value=\"f\"/>
													 	";
												 	}
												 	

												 echo "
												 </div>
											</div>

										</div>
									</div>

								";

							
							



							}else if($_GET['account_type']=='f')
							{

							//foundation	
							//normal posts from users 
							$post_no=$_GET['post_no'];
							$user_no=$_GET['account_id'];
							
							//normal posts from foundations
							$query_normal_posts="SELECT `id`, `account_id`, `caption`, `date` FROM `normal_posts` WHERE `id`= '$post_no' AND `account_id` = '$user_no' LIMIT 1";

							$perform_normal_query=mysqli_query($connect,$query_normal_posts);

							$row=mysqli_fetch_assoc($perform_normal_query);
							
								$post_id=$row['id'];
								$foundation_id=$row['account_id'];
								$caption=$row['caption'];
								$date=$row['date'];
								$query_foundation_info="SELECT `name` , `photo`  FROM `foundations` WHERE `id` = '$foundation_id' LIMIT 1";
								
								$perform_normal_info=mysqli_query($connect,$query_foundation_info);
								$result=mysqli_fetch_assoc($perform_normal_info);
								
								$foundation_name=$result['name'];
								$foundation_photo=$result['photo'];
								
								if($foundation_photo==null)
								{
									$image="../images/profile_image/default-academy.jpg";
									
								}else
								{
									//default..
									$image="../foundations/$foundation_id/$foundation_photo";
								}
							
								//Select the images ....  
								$query_normal_posts_images="SELECT  `images`  FROM normal_posts INNER JOIN normal_post_images ON normal_posts.id = normal_post_images.post_id WHERE normal_posts.account_id = '$foundation_id' AND normal_post_images.post_id = '$post_id' ";
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
											<h5> $foundation_name </h5>
											<span><b>$date_ago</b></span>
											<div class=\"clear\"></div>
										</div>
										<!-- image of the post -->
										<div class=\"post_image\">
										";
										while($result_N_P_P=mysqli_fetch_assoc($perform_normal_posts_images))
										{
											$photo_dis_N=$result_N_P_P["images"];
											echo 
											"
											<div class=\"main-photo\">
												<img class=\"img-responsive\" src=\"../postingattachment/foundation/$foundation_id/$post_id/$photo_dis_N\" />
											</div>
											";

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

										echo 
										"
											<div class=\"caption\">
												<p>$caption</p>
											</div>
											<div class=\"comments\" id=\"comment\">";

											$query_comment_normal_post="SELECT `account_id`, `comment`, `post_id`, `date`, `account_type` FROM `comments_normal_post` WHERE `post_id`='$post_id'   ";
											$perfrom_query_comment_normal_post=mysqli_query($connect,$query_comment_normal_post);
											while($result_comments=mysqli_fetch_assoc($perfrom_query_comment_normal_post))
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
																$image="../images/profile_image/default-person.jpg";
															}else{
																$image="../images/profile_image/user_profile_female.jpg";
															}

														}else{
															
															$image="../users/".$account_id."/".$result_name['photo'];
														}

														echo "<p><img src='{$image}' /> &nbsp; <span><b> <a href='profile/profile.php?user_id={$account_id}&acc_type=p&gend={$account_gender} '> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";

													}else if($result_comments['account_type']=='f')
													{
														//foundation
														$account_id=$result_comments['account_id'];
														$query_username="SELECT `name` , `photo` FROM `foundations` WHERE `id`='$account_id' LIMIT 1";
														$perform_query_username=mysqli_query($connect,$query_username);
														$result_name=mysqli_fetch_assoc($perform_query_username);
														$Account_name=$result_name['name'];

														if($result_name['photo']==null)
														{
															$image="../images/profile_image/default-academy.jpg";
														}else
														{
															$image="../foundations/".$account_id."/".$result_name['photo'];
														}

														echo "<p><img src='$image' /> <span><b> <a href='profile/profile.php?f_id={$account_id}&acc_type=f'> $Account_name </a> </b>:</span> <span> $comment </span> &nbsp; <strong>{$date}</strong></p>";	
													}
													
													

														
												}
												 
												if($_COOKIE['Account_type']=='person')
												 {
												 	$Acc_id=$_COOKIE['user_id'];
												 	$Acc_type='p';

												 }else if($_COOKIE['Account_type']=='foundation')
												 {
												 	$Acc_id=$_COOKIE['foundation_id'];
												 	$Acc_type='f';
												 }
										echo
										"
										</div>
										<div class=\"actions\">
											 
											 <div class=\"like_action_area\" id=\"like_action_area{$post_id}\" style=\"display:inline;\">
											 	<div id=\"message{$post_id}\" style=\"display:none;color:ff0000; border:1px dashed #ff0000; padding:10px;\">Something Going wrong plz try again ...</div>
												<input type=\"hidden\" class=\"like_post_id\" value=\"{$post_id}\" />
												<input type=\"hidden\" class=\"like_account_id\" value=\"{$Acc_id}\" />
												<input type=\"hidden\" class=\"like_account_type\" value=\"{$Acc_type}\" />		
											";
												
												 

												if($_COOKIE['Account_type']=='person')
												 {
												 	$Acc_id=$_COOKIE['user_id'];
												 	$Acc_type='p';

												 }else if($_COOKIE['Account_type']=='foundation')
												 {
												 	$Acc_id=$_COOKIE['foudation_id'];
												 	$Acc_type='f';
												 }

												 $query_check_perspn_post_liked="SELECT `id` FROM `likes_normal_post` WHERE `account_id`='$Acc_id' AND `post_id`='$post_id' AND `account_type`='$Acc_type' ";
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
		



											if($_COOKIE['Account_type']=='person')
												 {
												 	$Acc_id=$_COOKIE['user_id'];
												 	$Acc_type='p';

												 }else if($_COOKIE['Account_type']=='foundation')
												 {
												 	$Acc_id=$_COOKIE['foudation_id'];
												 	$Acc_type='f';
												 }	 
											echo 
												"
												</div>
												 <div class=\"comment\">
												 	<input type=\"text\" name=\"comment\" id=\"comment_input\" placeholder=\"Add Comment....\" />
												 	<button class=\"comment_btn\" id=\"comment_btn\" ><span><i class=\"fa fa-mail-reply fa-lg\" aria-hidden=\"true\"></i></span></button>
												 	<input type=\"hidden\" class=\"post_id\" value=\"$post_id\"/>
												 	<input type=\"hidden\" class=\"account_id\" value=\"$Acc_id\"/>
												 	";

												 	if($_COOKIE['Account_type']=="person")
												 	{
												 		echo "
														 	<input type=\"hidden\" class=\"account_type\" value=\"p\"/>
														 ";
												 	}else if($_COOKIE['Account_type']=="foundation")
												 	{
												 		echo "
														 	<input type=\"hidden\" class=\"account_type\" value=\"f\"/>
														 ";

												 	}
											 	

												 echo "</div>
											</div>

										</div>
									</div>

								";

							
						
							}
							

							
					?>


			</div>
		</div>


		</div>

	</div>



	<div class="footer_inc text-center">
                        Copyright &copy; 2017 <span>Together</span>.INC
    </div>


    <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="likes_normal_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	        <h4 class="text-center h4">people and foundation that likes this post</h4>
	        <div class="option_suggest" style="width:80%;">
	        	
	        	<ul class="list-unstyled list_liked_accounts">
	        			
	        	</ul>
	        	
	        </div>
	        
	      </div>

	      <div class="modal-body mod_body_setting_suggested cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<script type="text/javascript" src="../javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
	<script type="text/javascript" src="../javascript/display_normal_post.js"></script>
	<script type="text/javascript">
		$(".liked_pop_up").click(function(){
			var post_id=$(this).parent().siblings(".post_id_get_likes").val();
			 // alert(post_id);
			get_number_of_likes_profile(post_id);
			$('#likes_normal_post').modal('show');
		});

		function get_number_of_likes_profile(post_id)
		{
			// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
			//get account_id,post_id,accout_type
			var like_post_id=post_id;
			

			var url = "../posting_person/get_likes_normal_post_profile_original.php";
	        var vars = "get_like_post_id="+like_post_id;
		
	        hr.open("POST", url, true);
	    
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
			 hr.onreadystatechange = function() {
			    
			    if(hr.readyState == 4 && hr.status == 200) {
				    var return_data = hr.responseText;
					var jArraygetcomment=return_data;

					// console.log(jArraygetcomment);
					$(".option_suggest .list_liked_accounts ").html("<h4 class='text-center' style=\"color:#333;\">There's no one Likes on this post.</h4>");
					if(jArraygetcomment!=null)
					{
						jArraygetcomment=JSON.parse(jArraygetcomment);	
						//console.log(jArraygetcomment);
						$(".option_suggest .list_liked_accounts ").html('');
						$.each( jArraygetcomment, function( key, value ){

						if(value.account_type=='p')
						{
							//person
							$(".option_suggest .list_liked_accounts ").append("<li><img src=\"../"+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?user_id="+value.account_id+"&acc_type="+value.account_type+"&gend="+value.gender+"\">"+value.name+"</a> <span style=\"display:block text-align:center;\">"+value.date+"</sapn></li>");
						}else if(value.account_type=='f')
						{
							//foundation
							$(".option_suggest .list_liked_accounts ").append("<li><img src=\"../"+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?f_id="+value.account_id+"&acc_type="+value.account_type+"\">"+value.name+"</a> <span style=\"display:block text-align:center;\">"+value.date+"</sapn></li>");
						}

						});
					}	
				
				}
			}
			// Send the data to PHP now... and wait for response to update the status div
		    hr.send(vars); // Actually execute the request
			
		}

	

	

	//store comment for person 
	$("#comment_btn").click(function(){
		
		var comment=$("#comment_input").val();
		var post_id=$(this).siblings(".post_id").val();
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
        var url = "../posting_person/store_posts.php";
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
    	var post_id=$(".post_id").val();

    	display_comment_normal_post(post_id);
    },"1000");
    //display comment for persons
	function display_comment_normal_post(post_id)
    {

     	// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var url = "../posting_person/display_comment_normal_post_profile.php";
        var post_id=post_id;
        var vars = "post_id="+post_id;

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
			
			


			if(jArrayComment!=null)
			{
				

				jArrayComment=JSON.parse(jArrayComment);
				$("#comment").html('');
				$.each( jArrayComment, function( key, value ) {
 					 
 					 if(value.account_type=='p')
 					 {
 					 	$("#comment").append("<p><img src='../"+value.image+"' /> &nbsp; <span><b> <a href='profile/profile.php?user_id="+value.account_id+"&acc_type=p&gend="+value.gender+"'>"+ value.name + "</a> </b>:</span> <span> "+value.comment+" </span> &nbsp; <strong>"+value.date+"</strong></p>");
 					 }else if(value.account_type=='f')
 					 {
 						$("#comment").append("<p><img src='../"+value.image+"' /> &nbsp; <span><b> <a href='profile/profile.php?f_id="+value.account_id+"&acc_type=f'> "+value.name+" </a> </b>:</span> <span> "+value.comment+" </span> &nbsp; <strong>"+value.date+"</strong></p>");	 	
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


    

	$(".like_btn").click(function(){
		$(this).hide();
		//$(this).siblings(".unlike_btn").css("display","inline");
		var post_id=$(this).siblings(".like_post_id").val();
		var account_id=$(this).siblings(".like_account_id").val();
		var account_type=$(this).siblings(".like_account_type").val();
		// alert(post_id);
		// alert(account_id);
		// alert(account_type);
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
			var url = "like_action.php";
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
					// console.log(jArrayLikes);
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
		
		

		var url = "dislike_action.php";
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

	$("#Main_search").on("keyup",function(){
    		var search=$(this).val();
    		
		
				if(search=='')
	    		{
	    			$(".profile_header .search input[type=text]").css("width","80%");
	    			$("#search_result_box").hide(800);
	    			$("#search_option_box").show(800);
	    			$( "#Main_container" ).animate({
					    marginTop: '0px'
					  }, 1000, function() {
					    // Animation complete.
				  	});
	    		}else
	    		{
	    			Normal_search(search);
	    			$(".profile_header .search input[type=text]").css("width","100%");
					$("#search_result_box").show(800);	
	    			$("#search_option_box").hide(800);
	    			$( "#Main_container" ).animate({
					    marginTop: '100px'
					  }, 1000, function() {
					    // Animation complete.
				  	});
	    		}
				

			
			
    	});


		function Normal_search(search)
		{
			// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        var search=search;
	        var url = "../normal_search/Normal_search.php";
	        var vars = "search="+search;

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArrayget_normal_search=return_data;

			 	// console.log(jArrayget_normal_search);
			    if(jArrayget_normal_search!=null)
				{
					jArrayget_normal_search=JSON.parse(jArrayget_normal_search);	
					//console.log();	
					$("#search_result_box").html('');
					
					$.each( jArrayget_normal_search, function( key, value ){

					//print search result into search box
					if(value.account_type=='p')
					{
						//for person 
						$("#search_result_box").append("<div class=\"element\"><img src=\"../"+value.image+"\"/><h6><a href=\"../profile/profile.php?user_id="+value.id+"&acc_type=p&gend="+value.gender+"\">"+value.name+"</a></h6></div>");		
					}else
					{
						//for foundation
						$("#search_result_box").append("<div class=\"element\"><img src=\"../"+value.image+"\"/><h6><a href=\"../profile/profile.php?f_id="+value.id+"&acc_type=f\">"+value.name+"</a></h6></div>");	
	
					}
					
					});


				}else{
					//some thing going wrong
					$("#search_result_box").html("<div class=\"element\" style=\"color:#ff0000\"><h4 class=\"text-center\">Something Going Wrong...</h4></div>");
				}



		    }else{
		    	//no result for your search....
	            $("#search_result_box").html("<div class=\"element\" style=\"color:#3897f0\"><h4 class=\"text-center\">No Result For Your Search ...</h4></div>");
	    	    }
	    
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request

    	}




	</script>
</body>
</html>		