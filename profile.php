<?php
	include_once("php_includes/connection_dp.php");
	include_once('functions/check_login.php');
?>
<html>
<head>
	<title>profile</title>
	<!-- tab icon -->
	<link rel="apple-touch-icon" sizes="57x57" href="images/logo/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/logo/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/logo/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/logo/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/logo/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/logo/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/logo/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/logo/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/logo/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="images/logo/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/logo/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/logo/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/logo/favicon-16x16.png">
	<link rel="manifest" href="images/logo/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- stylig links-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/post.css">
	<link rel="stylesheet" type="text/css" href="css/post_profile_custom.css">
	<link rel="stylesheet" type="text/css" href="css/popup_profile_original.css">
	<link rel="stylesheet" type="text/css" href="css/media.css">
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
				<img class="img-responsive" src="images/logo/Capture.PNG" />
			</div>
		</div>
		<div class="col-md-4 col-sm-4 hidden-xs">
			<div class="search">
					<input type="text" id="Main_search" name="search" placeholder="Search @Person or @Institution⁯ ..">
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
						<li><a href="Main.php" class=""><i class="fa fa-home fa-2x" aria-hidden="true"></i></a></li>
						
						<div class="btn-group profile1">
							<li class="dropdown-toggle notification"  data-toggle="dropdown"><a href="profile.php"><i class="fa fa-male fa-2x" style="color:#3897f0;" aria-hidden="true"></i><span class="num_notification" id="profile1">0</span></a></li>
								<ul class="dropdown-menu" id="profile1_dropdown">
								    <li><a href="profile.php">
								    	 
								    	<p class="time_normal_profile1"> &nbsp;&nbsp;View profile </p>
								    </a></li>
								    <li><h6 class="text-center">There's No Notification To Show..</h6></li>
							  	</ul>
						</div>

						<div class="btn-group normal">
							<li class="dropdown-toggle notification" data-toggle="dropdown"><a href="#"><i class="fa fa-bell fa-2x " aria-hidden="true"></i><span class="num_notification" id="normal_post">0</span></a></li>
								<ul class="dropdown-menu" id="normal_post_dropdown">
								    

							  	</ul>
						</div>
						<div class="btn-group message">  	
							<li class="dropdown-toggle notification" data-toggle="dropdown"><a href="messaging/messaging.php"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i><span class="num_notification" id="message">0</span></a></li>
								<ul class="dropdown-menu" id="messages_dropdown">
								    <li><a href="messaging/messaging.php">
								    	<h6 class="text-center">Open Messages</h6>
								    </a></li>
								    <li><h6 class="text-center">There's No Notification To Show..</h6></li>
							  	</ul>
						</div>
						<div class="btn-group request"> 	  	
							<li class="dropdown-toggle notification" data-toggle="dropdown"><a href="all_request_posts/request_post.php"><i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i><span class="num_notification" id="request_post">0</span></a></li>
							<ul class="dropdown-menu" id="request_post_dropdown">
								<li><a href="all_request_posts/request_post.php">
							    	<h6 class="text-center">Open Annoncements</h6>
							    </a></li>
							    <li><h6 class="text-center">There's No Notification To Show..</h6></li>						
						  	</ul>		
						</div> 	
					</ul>
				</div>
			</div>
	</div>
</div>

	<?php
		// query to getting the image ...
		if($_COOKIE['Account_type']=="person")
		{
			$user_id=$_COOKIE['user_id'];
			$query_getImage_p="SELECT `first_name`,`last_name`,`photo` FROM `users` WHERE id= '$user_id' ";
			$perfom_query_iamge_p=mysqli_query($connect,$query_getImage_p);
			$result_image_p=mysqli_fetch_assoc($perfom_query_iamge_p);

		}else{
			$foundation_id=$_COOKIE['foundation_id'];
			$query_getImage_f="SELECT `name`,`photo` FROM `foundations` WHERE id= '$foundation_id' ";
			$perfom_query_iamge_f=mysqli_query($connect,$query_getImage_f);
			$result_image_f=mysqli_fetch_assoc($perfom_query_iamge_f);			
		}
	?>
<!-- profile container -->
	<div class="container profile">
		<div class="col-md-4 col-xs-4">
			<div class="profile_photo">
				<img class="img-responsive" 
				<?php if($_COOKIE['Account_type']=="person"):?>
					<?php if($_COOKIE['user_gender']=="m"):?>	
								<?php if($result_image_p['photo']!=null):?>	
									src="users/<?php echo $user_id.'/'.$result_image_p['photo'];?>"
									<?php else:?>
									src="images/profile_image/default-person.jpg" 
									<?php endif;?>

							<?php else:?>
								<?php if($result_image_p['photo']!=null):?>	
									src="users/<?php echo $user_id.'/'.$result_image_p['photo'];?>"
									<?php else:?>
									src="images/profile_image/user_profile_female.jpg" 
									<?php endif;?>	
							<?php endif;?>	 	
				<?php else:?>
					 <?php if($result_image_f['photo']!=null):?>
						src="foundations/<?php echo $foundation_id.'/'.$result_image_f['photo'];?>"
						<?php else:?>
						src="images/profile_image/default-academy.jpg" 
						<?php endif;?>
				<?php endif;?>
				/>
			</div>
			<div class="Together_msg"><button class="btn btn-danger" id="together_mseeages">Together Messages 
				<?php
					if($_COOKIE['Account_type']=="person")
					{
						$account_id=$_COOKIE['user_id'];
						$account_type='p';
						$query_messages="SELECT `id` FROM `reply_contactus` WHERE `account_id`='$account_id' AND `account_type`='$account_type' ";
						$perform_query_messages=mysqli_query($connect,$query_messages);
						if($perform_query_messages)
						{
							echo "<span>&nbsp;".mysqli_num_rows($perform_query_messages)."&nbsp;<span>";
						}else
						{
							echo "<span>&nbsp;0&nbsp;<span>";
						}
					}else if($_COOKIE['Account_type']=="foundation")
					{
						$account_id=$_COOKIE['foundation_id'];
						$account_type='f';
						$query_messages="SELECT `id` FROM `reply_contactus` WHERE `account_id`='$account_id' AND `account_type`='$account_type' ";
						$perform_query_messages=mysqli_query($connect,$query_messages);
						if($perform_query_messages)
						{
							echo "<span>&nbsp;".mysqli_num_rows($perform_query_messages)."&nbsp;<span>";
						}else
						{
							echo "<span>&nbsp;0&nbsp;<span>";
						}

					}else
					{
						echo "<span>&nbsp;0&nbsp;<span>";
					}
					
				?>
				

				</button></div> 
		</div>
		<div class="col-md-8 col-xs-8">
			<div class="profile_text">
				
				<?php 
				if($_COOKIE['Account_type']=="person")
				{
					// to get the user name 
					$user_id=$_COOKIE['user_id'];
					$query="SELECT 	first_name , last_name FROM users WHERE id='$user_id' LIMIT 1 ";
					$perform_query=mysqli_query($connect,$query);
					$result=mysqli_fetch_assoc($perform_query);

				}else
				{
					// to get the user name 
					$foundation_id=$_COOKIE['foundation_id'];
					$query="SELECT 	name FROM foundations WHERE id='$foundation_id' LIMIT 1 ";
					$perform_query=mysqli_query($connect,$query);
					$result=mysqli_fetch_assoc($perform_query);					
				}
					
				?>


				<h4><b><?php 
				if($_COOKIE['Account_type']=="person")
				{
					echo $result['first_name'].' '.$result['last_name'];	
				}else
				{
					echo $result['name'];
				}
				

				?></b></h4>&nbsp;&nbsp;
				
				<?php if($_COOKIE['Account_type']=="person"):?>
				<a href="setting_person/setting_p.php?user_id=<?php echo $_COOKIE['user_id'];?>" class="setting_btn"><i class="fa fa-cog" aria-hidden="true"></i> Edit Profile..</a>
				<?php else:?>
				<a href="setting_foundation/setting_f.php?f_id=<?php echo $_COOKIE['foundation_id'];?>" class="setting_btn"><i class="fa fa-cog" aria-hidden="true"></i> Edit Profile..</a>
				<?php endif;?>

				<button class="extra_setting" data-toggle="modal" data-target="#logout"> <span>.</span> <span>.</span> <span>.</span></button>
				<p class="lead">
					<b>
						<?php
							if($_COOKIE['Account_type']=="person")
								{
									echo $result['first_name'].' '.$result['last_name'];	
								}else
								{
									echo $result['name'];
								}
						?>
					</b> 
						<?php 

						if($_COOKIE['Account_type']=="person")
							{
								// to get the user name 
								$user_id=$_COOKIE['user_id'];
								$query_des="SELECT 	description FROM users WHERE id='$user_id' LIMIT 1 ";
								$perform_query_des=mysqli_query($connect,$query_des);
								$result_des=mysqli_fetch_assoc($perform_query_des);

							}else
							{
								// to get the user name 
								$foundation_id=$_COOKIE['foundation_id'];
								$query_des="SELECT 	description FROM foundations WHERE id='$foundation_id' LIMIT 1 ";
								$perform_query_des=mysqli_query($connect,$query_des);
								$result_des=mysqli_fetch_assoc($perform_query_des);					
							}

							if($_COOKIE['Account_type']=="person")
								{
									echo $result_des['description'];	
								}else
								{
									echo $result_des['description'];
								}	
						?>



                </p>
				<div class="counters">
					<?php 
						if($_COOKIE['Account_type']=='person')
						{
							$account_id=$_COOKIE['user_id'];
							$account_type='p';
							// Query to person get number of posts
							$query_number_person_post="SELECT `id` FROM `normal_posts` WHERE `account_id`='$account_id' AND `account_type`='$account_type' ";
							$perform_query_number_person_posts=mysqli_query($connect,$query_number_person_post);
							$number_of_posts=mysqli_num_rows($perform_query_number_person_posts);
							echo "<span class=\"bold\">{$number_of_posts}</span>";
								
						}else if($_COOKIE['Account_type']=='foundation')
						{
							$account_id=$_COOKIE['foundation_id'];
							$account_type='f';

							// Query to foundation get number of posts
							$query_number_foundation_post="SELECT `id` FROM `normal_posts` WHERE `account_id`='$account_id' AND `account_type`='$account_type' ";
							$perform_query_number_foundation_posts=mysqli_query($connect,$query_number_foundation_post);
							$number_of_posts=mysqli_num_rows($perform_query_number_foundation_posts);
							echo "<span class=\"bold\">{$number_of_posts}</span>";
						}else
						{
							echo "<span class=\"bold\">199</span>";		
						}

					?>
					
					<span>Posts</span>
					&nbsp;&nbsp;
					<span class="bold">

						<?php
						if($_COOKIE['Account_type']=="person")
						{
							$user_id=$_COOKIE['user_id'];
							$query_p_p_s="SELECT `id` FROM `following` WHERE `account_following_id`='$user_id' AND `account_following_type`='p' ";
							$perform_query_p_p_s=mysqli_query($connect,$query_p_p_s);

							echo mysqli_num_rows($perform_query_p_p_s);

						}
						else if($_COOKIE['Account_type']=="foundation")
						{
							//foundation
							$foundation_id=$_COOKIE['foundation_id'];
							
							$query_f_f_s="SELECT `id` FROM `following` WHERE `account_following_id`='$foundation_id' AND `account_following_type`='f' ";
							$perform_query_f_f_s=mysqli_query($connect,$query_f_f_s);
							
							
							echo mysqli_num_rows($perform_query_f_f_s);
						}	
					?>	


					</span>
					<span><button class="extra_settings_trust" data-toggle="modal" data-target="#trusted_accounts">Trusted</button></span>
					&nbsp;&nbsp;
					<span class="bold">

						<?php
						if($_COOKIE['Account_type']=="person")
						{
							$user_id=$_COOKIE['user_id'];
							$query_p_p_s="SELECT `id` FROM `following` WHERE `account_followed_id`='$user_id' AND `account_followed_type`='p' ";
							$perform_query_p_p_s=mysqli_query($connect,$query_p_p_s);

							echo mysqli_num_rows($perform_query_p_p_s);

						}
						else if($_COOKIE['Account_type']=="foundation")
						{
							//foundation
							$foundation_id=$_COOKIE['foundation_id'];
							
							$query_f_f_s="SELECT `id` FROM `following` WHERE `account_followed_id`='$foundation_id' AND `account_followed_type`='f' ";
							$perform_query_f_f_s=mysqli_query($connect,$query_f_f_s);
							
							echo mysqli_num_rows($perform_query_f_f_s);
						}	
					?>

					</span>
					<span><button class="extra_settings_trust" data-toggle="modal" data-target="#trusting_accounts">Trusting</button></span>
				</div>
				<?php

				if($_COOKIE['Account_type']=="person"){
					$user_id=$_COOKIE['user_id'];
					$counter=8;
					$total=11;
					$query_p="SELECT `telephone_number1`, `photo` ,`adderss` FROM `users` WHERE id='$user_id' LIMIT 1";
					$perform_query_p=mysqli_query($connect,$query_p);
					$result_p=mysqli_fetch_assoc($perform_query_p);

					
					
					
					if($result_p['photo']!=null)
						{
							 ++$counter;	
						}

						if($result_p['adderss']!=null)
						{
							 ++$counter;
						}

						if($result_p['telephone_number1']!=null){
							 ++$counter;
						}
						
						$percetage=ceil(($counter/$total)*100);

						$query_p_percentage="UPDATE `users` SET `info_completion`='$percetage' WHERE id = '$user_id' LIMIT 1";
						$perform_query_p_percentage=mysqli_query($connect,$query_p_percentage);
						//handle perform_query_p_percentage
						// if()
						// 	{}else{}
						

				}else{
						$foundation_id=$_COOKIE['foundation_id'];
						$counter_f=6;
						$total_f=11;
						
						$query_f="SELECT  `telephone_number1`, `photo`,`address`, `fax`, `site_link` FROM `foundations` WHERE id= '$foundation_id' LIMIT 1";
						$perform_query_f=mysqli_query($connect,$query_f);
						$result_f=mysqli_fetch_assoc($perform_query_f);

						if($result_f['telephone_number1']!=null)
						{
							 ++$counter_f;	
						}

						if($result_f['photo']!=null)
						{
							 ++$counter_f;
						}

						if($result_f['address']!=null){
							 ++$counter_f;
						}

						if($result_f['fax']!=null){
							 ++$counter_f;
						}
						
						if($result_f['site_link']!=null){
							 ++$counter_f;
						}

						$percetage_f=ceil(($counter_f/$total_f)*100);
						$query_f_percentage="UPDATE `foundations` SET `info_completion` = '$percetage_f' WHERE id = '$foundation_id' LIMIT 1";
						$perform_query_f_percentage=mysqli_query($connect,$query_f_percentage);
						//handle perform_query_p_percentage
						// if()
						// 	{}else{}


				}
				
				?>
				<div class="progress">
                     <div class="progress-bar progress-bar-info wow rubberBand"   role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" <?php 
                     	if($_COOKIE['Account_type']=="person")
                     		{
                     			echo 'style="width:'.$percetage.'%"';
                     		}else{
                     			echo 'style="width:'.$percetage_f.'%"';
                     		} ?> >
                        <h4 class="info">Information Completion <?php 
                        if($_COOKIE['Account_type']=="person"){
                        	echo $percetage.'%';
                        }else{
                        	echo $percetage_f.'%';
                        }
                        ?></h4>
                     </div>
                </div>


			</div>
		</div>
	</div>
	<hr/>
    <div class="suggestions_intro"><h4 class="text-center"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Suggestions To Trust.</h4></div>
    <!-- suggestions  person -->
		<div class="container suggestions" id="sugestions_person">
			<ul class="list-unstyled people_suggestions">
				<li class="suggestion_header">
					<b>Suggestions For You (Perons)</b>
					<span><a href="suggestion_trust/suggestion_see_all.php?acc_type=p"><b>See All&nbsp; > </b></a></span>
					<!-- <span id="Setting_link"><b>Setting &nbsp;</b></span> -->
				</li>
		
				<!-- selection for suggested people -->
				<?php
					$query_s_p="SELECT `id`,`first_name`,`last_name`,`photo`,`gender` FROM `users`  LIMIT 5";
					$perform_query_s_p=mysqli_query($connect,$query_s_p);
				?>
		
				<?php

				while($row=mysqli_fetch_assoc($perform_query_s_p))
				{
					if($row['photo']==null)
						{
							if($row['gender']=='m')
							{	
								$image="images/profile_image/default-person.jpg";
							}else{
								$image="images/profile_image/user_profile_female.jpg";
							}

						}else{
							$user_id=$row['id'];
							$image="users/".$user_id."/".$row['photo'];
						}

						$person_name_link=$row['first_name']." ".$row['last_name'];
					
						
						if(@$_COOKIE['user_id']==$row['id'])
							{


							}else{
								echo "
									<li class=\"suggestion_element\">
										<img class=\"img-responsive\" src=\"$image\" />
										<h5><a href='profile/profile.php?user_id=".$row['id']."&acc_type=p&gend=".$row['gender']." '>".$person_name_link."</a></h5>
										<a href=\"profile/profile.php?user_id=".$row['id']."&acc_type=p&gend=".$row['gender']." \" class=\"see_profile\">SEE PROFILE</a>
									</li>
								";			
							}	


					
				}

				?>
				

			</ul>
		</div>

		<?php
			$query_s_f="SELECT  `id`,`name`, `photo` FROM `foundations` LIMIT 5";
			$perform_query_s_f=mysqli_query($connect,$query_s_f);
		?>
		<!-- suggestions foundation-->
		<div class="container suggestionsf" id="sugestions_foundation">
			<ul class="list-unstyled people_suggestionsf">
				<li class="suggestion_headerf">
					<b>Suggestions For You (Foundations)</b>
					<span><a href="suggestion_trust/suggestion_see_all.php?acc_type=f"><b>See All&nbsp; > </b></a></span>
					<!-- <span id="Setting_link_foundation"><b>Setting &nbsp;</b></span> -->
				</li>
				
				<?php

				while($row=mysqli_fetch_assoc($perform_query_s_f))
				{
					if($row['photo']==null)
						{
							$image_f="images/profile_image/default-academy.jpg";

						}else{
							$foundation_id=$row['id'];
							$image_f="foundations/".$foundation_id."/".$row['photo'];
						}

						$foundation_name_link=$row['name'];

						//<a href='profile/profile.php?user_id=".$row['id']."&acc_type=p&gend=".$row['gender']." '>".$person_name_link."</a>
					
						if(@$_COOKIE['foundation_id']==$row['id'])
							{


							}else{
								echo "
									<li class=\"suggestion_elementf\">
										<img class=\"img-responsive\" src=\"$image_f\" />
										<h5><a href='profile/profile.php?f_id=".$row['id']."&acc_type=f'>".$foundation_name_link."</a></h5>
										<a href=\"profile/profile.php?f_id=".$row['id']."&acc_type=f\" class=\"see_profile\">SEE PROFILE</a>
									</li>
								";			
							}
					
				}

				?>
				


			</ul>
		</div>

    <!--loading before display posts-->
    <div class="loader" id="loader">Loading...</div>
    <!-- posts container -->
	<div class="container post_area">
		<div class="normal_post_container">
			<div class="normal_post_content" id="normal_post_content">
			





			</div>
		</div>
	    
	</div>
	<div class="footer_inc text-center">
                        Copyright &copy; 2016 <span>Elbayady</span>.INC
    </div>





    
    <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="trusting_accounts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    	
	    <div class="modal-content mod_con">
	    		  	
	      	<div class="trusting_body">
	      		<h4 class="text-center">Trusting Accounts:</h4>
	      		<ul class="list-unstyled trusting_account_body">
					<li class="trusting_account_header">
						<b><?php if($_COOKIE['Account_type']=="person"){echo "Persons ";}else{echo "Foundations ";}?>That Trust You :</b>
					</li>
					<?php
						if($_COOKIE['Account_type']=="person")
						{
							//person that follows persons
							$user_id=$_COOKIE['user_id'];
							$query_p_p_s_name="SELECT `account_following_id` as `id_p`,`photo`,`gender`,`first_name`,`last_name` FROM `following` INNER JOIN `users` on users.id = following.account_following_id WHERE `account_followed_id`='$user_id' AND `account_followed_type`='p' ";
							$perform_query_p_p_s_name=mysqli_query($connect,$query_p_p_s_name);
							if(mysqli_num_rows($perform_query_p_p_s_name)!=0)
							{
								while($result_p_p_s_name=mysqli_fetch_assoc($perform_query_p_p_s_name))
								{
									if($result_p_p_s_name['gender']=='m')
										{
											if($result_p_p_s_name['photo']!=null)
												{													
													$image="users/".$result_p_p_s_name['id_p']."/".$result_p_p_s_name['photo'];
												}else{
													//default
													$image="images/profile_image/default-person.jpg";
												}
											
										}else{
											//female

											if($result_p_p_s_name['photo']!=null)
												{													
													$image="users/".$result_p_p_s_name['id_p']."/".$result_p_p_s_name['photo'];
												}else{
													//default
													$image="images/profile_image/user_profile_female.jpg";
												}

										}
									$id=$result_p_p_s_name['id_p'];
									$gender=$result_p_p_s_name['gender'];	
									echo 
									"
										<li class=\"trusting_account_element\" style=\"border-bottom:1px solid #efefef;\">
											<img class=\"img-responsive\" src=\"$image\" />
											<h5><a href=\"#\"> ".$result_p_p_s_name['first_name']." ".$result_p_p_s_name['last_name']." </a></h5>
											<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?user_id={$id}&acc_type=p&gend={$gender}\" ><button class=\"trust\">See Profile</button></form>
										</li>
									";				
								}	

							}else{

								echo "<li class=\"trusting_account_header\" style=\"\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Foundations Trust You</b><h5> </li>";
								
							}
							
							echo "
								<li class=\"trusting_account_header\" >
								<b> Foundations That Trust You :</b>
								</li>
							";

							//foundation that follows the person 
							$query_f_p_s_name="SELECT `photo`,`account_following_id`,`name` FROM `following` INNER JOIN `foundations` on foundations.id = following.account_following_id WHERE `account_followed_id`='$user_id' AND `account_followed_type`='p' ";
							$perform_query_f_p_s_name=mysqli_query($connect,$query_f_p_s_name);
							
							if(mysqli_num_rows($perform_query_f_p_s_name)!=0)
							{
								while($resul_f_p_s_name=mysqli_fetch_assoc($perform_query_f_p_s_name))
								{
									$foundation_id=$resul_f_p_s_name['account_following_id'];
									if($resul_f_p_s_name['photo']!=null)
									{	
										$image="foundations/".$resul_f_p_s_name['account_following_id']."/".$resul_f_p_s_name['photo'];
									}else{
										$image="images/profile_image/default-academy.jpg";
									}

									echo 
									"
										<li class=\"trusting_account_element\" style=\"border-top:1px solid #efefef; border-bottom:1px solid #efefef;
    									padding: 16px;\">
											<img class=\"img-responsive\" src=\"$image\" />
											<h5><a href=\"#\"> ".$resul_f_p_s_name['name']." </a></h5>
											<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?f_id={$foundation_id}&acc_type=f\" ><button class=\"trust\">See Profile</button></form>
										</li>
									";				
								}

							}else{

								echo "<li class=\"trusting_account_header\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Foundations Trust You</b><h5> </li>";
								
							}
							//the end of person setting 
						}
						else
						{
							//foundation that follows foundations

							$foundation_id=$_COOKIE['foundation_id'];
							$query_f_f_s_name="SELECT `photo`,`account_following_id`,`name` FROM `following` INNER JOIN `foundations` on foundations.id = following.account_following_id WHERE `account_followed_id`='$foundation_id' AND `account_followed_type`='f' "; 
							$perform_query_f_f_s_name=mysqli_query($connect,$query_f_f_s_name);
							if(mysqli_num_rows($perform_query_f_f_s_name)!=0)
							{
								while($resul_f_f_s_name=mysqli_fetch_assoc($perform_query_f_f_s_name))
								{
									$foundation_id=$resul_f_f_s_name['account_following_id'];
									
									if($resul_f_f_s_name['photo']!=null)
									{	
										$image="foundations/".$resul_f_f_s_name['account_following_id']."/".$resul_f_f_s_name['photo'];
									}else{
										$image="images/profile_image/default-academy.jpg";
									}
									echo 
									"
										<li class=\"trusting_account_element\" style=\"border-top:1px solid #efefef; border-bottom:1px solid #efefef;
    									padding: 16px;\">
											<img class=\"img-responsive\" src=\"$image\" />
											<h5><a href=\"#\"> ".$resul_f_f_s_name['name']." </a></h5>
											<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?f_id={$foundation_id}&acc_type=f\" ><button class=\"trust\">See Profile</button></form>
										</li>
									";				
								}

							}else{
								echo "<li class=\"trusting_account_header\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Foundations Trusting You</b><h5> </li>";
							}

							echo "
								<li class=\"trusting_account_header\" >
								<b> Persons That Trusting You :</b>
								</li>
							";

							$foundation_id=$_COOKIE['foundation_id'];
							$query_p_f_s_name="SELECT `account_following` as `id_p`,`photo`,`gender`,`first_name`,`last_name` FROM `following` INNER JOIN `users` on users.id = following.account_following_id WHERE `account_followed_id`='$foundation_id' AND `account_followed_type`='f' ";
							$perform_query_p_f_s_name=mysqli_query($connect,$query_p_f_s_name);

							if(mysqli_num_rows($perform_query_p_f_s_name)!=0)
							{

								while($result_p_f_s_name=mysqli_fetch_assoc($perform_query_p_f_s_name))
								{
									if($result_p_f_s_name['gender']=='m')
										{
											if($result_p_f_s_name['photo']!=null)
												{													
													$image="users/".$result_p_f_s_name['id_p']."/".$result_p_f_s_name['photo'];
												}else{
													//default
													$image="images/profile_image/default-person.jpg";
												}
											
										}else{
											//female

											if($result_p_f_s_name['photo']!=null)
												{													
													$image="users/".$result_p_f_s_name['id_p']."/".$result_p_f_s_name['photo'];
												}else{
													//default
													$image="images/profile_image/user_profile_female.jpg";
												}

										}
									$id=$result_p_f_s_name['id_p'];
									$gender=$result_p_f_s_name['gender'];	
									echo 
									"
										<li class=\"trusting_account_element\" style=\"border-bottom:1px solid #efefef;\">
											<img class=\"img-responsive\" src=\"$image\" />
											<h5><a href=\"#\"> ".$result_p_f_s_name['first_name']." ".$result_p_f_s_name['last_name']." </a></h5>
											<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?user_id={$id}&acc_type=p&gend={$gender}\" ><button class=\"trust\">See Profile</button></form>
										</li>
									";				
								}

							}else{
								echo "<li class=\"trusting_account_header\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Persons Trusting You</b><h5> </li>";
							}

							
						}	
					?>
					

				</ul>
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->


    <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="trusted_accounts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	
	    	<div class="trusted_body">
	      		<h4 class="text-center"><b>Trusted Accounts:</b></h4>
	      		<ul class="list-unstyled trusted_account_body">
					<li class="trusted_account_header">
						<b><?php if($_COOKIE['Account_type']=="person"){echo "Persons ";}else{echo "Foundations ";}?>That Trust You :</b>
					</li>
					<?php
						if($_COOKIE['Account_type']=="person")
						{
							//person that foolws persons
							$user_id=$_COOKIE['user_id'];
							$query_p_p_s_name="SELECT `account_followed_id` as `id_p`,`photo`,`gender`,`first_name`,`last_name` FROM `following` INNER JOIN `users` on users.id = following.account_followed_id WHERE `account_following_id`='$user_id' AND `account_following_type`='p' ";
							$perform_query_p_p_s_name=mysqli_query($connect,$query_p_p_s_name);
							if(mysqli_num_rows($perform_query_p_p_s_name)!=0)
							{
								while($result_p_p_s_name=mysqli_fetch_assoc($perform_query_p_p_s_name))
								{
									if($result_p_p_s_name['gender']=='m')
										{
											if($result_p_p_s_name['photo']!=null)
												{													
													$image="users/".$result_p_p_s_name['id_p']."/".$result_p_p_s_name['photo'];
												}else{
													//default
													$image="images/profile_image/default-person.jpg";
												}
											
										}else{
											//female

											if($result_p_p_s_name['photo']!=null)
												{													
													$image="users/".$result_p_p_s_name['id_p']."/".$result_p_p_s_name['photo'];
												}else{
													//default
													$image="images/profile_image/user_profile_female.jpg";
												}

										}
									
									$id=$result_p_p_s_name['id_p'];
									$gender=$result_p_p_s_name['gender'];
									
									echo 
									"
										<li class=\"trusted_account_element\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\">
											<img class=\"img-responsive\" src=\"$image\" />
											<h5><a href=\"#\"> ".$result_p_p_s_name['first_name']." ".$result_p_p_s_name['last_name']." </a></h5>
											<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?user_id={$id}&acc_type=p&gend={$gender}\" ><button class=\"trust\">See Profile</button></form>
										</li>
									";				
								}	

							}else{

								echo "<li class=\"trusting_account_header\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Persons Trust You</b><h5> </li>";
								
							}
							
							echo "
								<li class=\"trusted_account_header\">
								<b> Foundations That Trust You :</b>
								</li>
							";

							//foundation that follows the person 
							$query_f_p_s_name="SELECT `photo`,`account_followed_id`,`name` FROM `following` INNER JOIN `foundations` on foundations.id = following.account_followed_id WHERE `account_following_id`='$user_id' AND `account_following_type`='p' ";
							$perform_query_f_p_s_name=mysqli_query($connect,$query_f_p_s_name);
							
							if(mysqli_num_rows($perform_query_f_p_s_name)!=0)
							{

								while($resul_f_p_s_name=mysqli_fetch_assoc($perform_query_f_p_s_name))
								{
									$foundation_id=$resul_f_p_s_name['account_followed_id'];
									if($resul_f_p_s_name['photo']!=null)
									{	
										$image="foundations/".$resul_f_p_s_name['account_followed_id']."/".$resul_f_p_s_name['photo'];
									}else{
										$image="images/profile_image/default-academy.jpg";
									}
									echo 
									"
										<li class=\"trusted_account_element\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\">
											<img class=\"img-responsive\" src=\"$image\" />
											<h5><a href=\"#\"> ".$resul_f_p_s_name['name']." </a></h5>
											<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?f_id={$foundation_id}&acc_type=f\" ><button class=\"trust\">See Profile</button></form>
										</li>
									";				
								}

							}else{

								echo "<li class=\"trusting_account_header\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Foundations Trust You</b><h5> </li>";
								
							}
							//the end of person setting 
						}
						else
						{
							//foundation
							$foundation_id=$_COOKIE['foundation_id'];
							
							$query_f_f_s_name="SELECT `photo`,`account_followed_id`,`name` FROM `following` INNER JOIN `foundations` on foundations.id = following.account_followed_id WHERE `account_following_id`='$foundation_id' AND `account_following_type`='f' ";
							$perform_query_f_f_s_name=mysqli_query($connect,$query_f_f_s_name);



							if(mysqli_num_rows($perform_query_f_f_s_name)!=0)
								{
									
									while($resul_f_f_s_name=mysqli_fetch_assoc($perform_query_f_f_s_name))
									{
										$foundation_id=$resul_f_f_s_name['account_followed_id'];
										if($resul_f_f_s_name['photo']!=null)
										{	
											$image="foundations/".$resul_f_f_s_name['account_followed_id']."/".$resul_f_f_s_name['photo'];
										}else{
											$image="images/profile_image/default-academy.jpg";
										}
										echo 
										"
											<li class=\"trusted_account_element\" style=\"border-top:1px solid #efefef;
	    									padding: 16px;\">
												<img class=\"img-responsive\" src=\"$image\" />
												<h5><a href=\"#\"> ".$resul_f_f_s_name['name']." </a></h5>
												<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?f_id={$foundation_id}&acc_type=f\" ><button class=\"trust\">See Profile</button></form>
											</li>
										";				
									}	

								}else{

									echo "<li class=\"trusting_account_header\" style=\"border-top:1px solid #efefef;
    									padding: 16px;\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Foundations Trust You</b><h5> </li>";
								}

								
								echo "
								<li class=\"trusted_account_header\">
								<b> Persons That Trust You :</b>
								</li>
								";

								$foundation_id=$_COOKIE['foundation_id'];
								$query_p_f_s_name="SELECT `account_followed_id` as `id_p`,`photo`,`gender`,`first_name`,`last_name`  FROM `following` INNER JOIN `users` on users.id = following.account_followed_id WHERE `account_following_id`='$foundation_id' AND `account_following_type`='f' ";
								$perform_query_p_f_s_name=mysqli_query($connect,$query_p_f_s_name);
							 
								if(mysqli_num_rows($perform_query_p_f_s_name)!=0)
									{

										while($result_p_f_s_name_f=mysqli_fetch_assoc($perform_query_p_f_s_name))
										{
											if($result_p_f_s_name_f['gender']=='m')
												{
													if($result_p_f_s_name_f['photo']!=null)
														{													
															$image="users/".$result_p_f_s_name_f['id_p']."/".$result_p_f_s_name_f['photo'];
														}else{
															//default
															$image="images/profile_image/default-person.jpg";
														}
													
												}else{
													//female

													if($result_p_f_s_name_f['photo']!=null)
														{													
															$image="users/".$result_p_f_s_name_f['id_p']."/".$result_p_f_s_name_f['photo'];
														}else{
															//default
															$image="images/profile_image/user_profile_female.jpg";
														}

												}

											$id=$result_p_f_s_name_f['id_p'];
											$gender=$result_p_f_s_name_f['gender'];
											echo 
											"
												<li class=\"trusted_account_element\" style=\"border-top:1px solid #efefef;
		    									padding: 16px;\">
													<img class=\"img-responsive\" src=\"$image\" />
													<h5><a href=\"#\"> ".$result_p_f_s_name_f['first_name']." ".$result_p_f_s_name_f['last_name']." </a></h5>
													<form method=\"POST\" style=\"display:inline;\" action=\"profile/profile.php?user_id={$id}&acc_type=p&gend={$gender}\" ><button class=\"trust\">See Profile</button></form>
												</li>
											";				
										}

									}else{
										echo "<li class=\"trusting_account_header\" style=\"border-top:1px solid #efefef;
	    									padding: 16px;\"> <h5 class=\"text-center\" style=\"color:#3897f0\"><b>There Is No Foundations Trust You</b><h5> </li>";
									}							
						}	
					?>
					
					
				</ul>
	      	</div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->


    <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body mod_body">
	        <h4 class="text-center h5"><a href="logout.php">Log Out</a></h4>
	      </div>

	      <div class="modal-body mod_body cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->

	<!-- pop up of Together Messages model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity_together_msg" id="Together_msg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio_together_msg" role="document">
	    
	    <div class="modal-content mod_con_together_msg">
	    	  	
	      <div class="modal-body mod_body_together_msg">
	        <ul class="list-unstyled">
	        	<?php
	        		if($_COOKIE['Account_type']=="person")
					{
						$account_id=$_COOKIE['user_id'];
						$account_type='p';
						$query_messages="SELECT `id`, `reply_body` FROM `reply_contactus` WHERE `account_id`='$account_id' AND `account_type`='$account_type' ";
						$perform_query_messages=mysqli_query($connect,$query_messages);
						if($perform_query_messages)
						{
							while($result_reply=mysqli_fetch_assoc($perform_query_messages))
							{
								$re_body=$result_reply['reply_body'];
								$re_no=$result_reply['id'];
								echo "
									<li>
					        			<img src=\"images/logo/1.png\" title=\"Togther.INC\" />
							       	 	<span>Together.INC</span>
							        	<p>".$re_body."</p>
					        			<p><a href=\"delete_reply/delete_reply_msg.php?re_no={$re_no}\" class=\"delete_link\" >Delete Message</a></p>
					        		</li>
								";
							}
							
						}else
						{
							echo "<li><p>There's No Messages </p></li>";
						}
					}else if($_COOKIE['Account_type']=="foundation")
					{
						$account_id=$_COOKIE['foundation_id'];
						$account_type='f';
						$query_messages="SELECT `id`,`reply_body` FROM `reply_contactus` WHERE `account_id`='$account_id' AND `account_type`='$account_type' ";
						$perform_query_messages=mysqli_query($connect,$query_messages);
						if($perform_query_messages)
						{
							while($result_reply=mysqli_fetch_assoc($perform_query_messages))
							{
								$re_body=$result_reply['reply_body'];
								$re_no=$result_reply['id'];
								echo "
									<li>
					        			<img src=\"images/logo/1.png\" title=\"Togther.INC\" />
							       	 	<span>Together.INC</span>
							        	<p>".$re_body."</p>
							        	<p><a href=\"delete_reply/delete_reply_msg.php?re_no={$re_no}\" class=\"delete_link\" >Delete Message</a></p>
					        		</li>
								";	
							}
							
							
						}else
						{
							echo "<li><p>There's No Messages </p></li>";
						}
					}else
					{
						echo "<li><p>There's No Messages </p></li>";
					}	
	        	?>
	        	
	        	

	        	<!-- 
	        	<li>
	        		<img src="images/logo/1.png" title="Togther.INC" />
			        <span>Together.INC</span>
			        <p>s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;s;daj;asdnasd;nlasdlas;</p>
	        	</li> -->
	        </ul>
	        
	      </div>

	      <div class="modal-body mod_body cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of Together Messages model -->

	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="Message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body mod_body">
	        <h4 class="text-center h4"><img 
	        	<?php if(@$_SESSION['Success_reply_check']=="true"):?>
	        		src="images/icon/accept.png"
	        	<?php else:?>
	        		src="images/icon/cancel.png"
	        	<?php endif;?>
	        	/><b style="color:#080"><?php echo @$_SESSION['message_reply_profile'];?></b> </h4>
	      </div>

	      <div class="modal-body mod_body cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->

	<script type="text/javascript" src="javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="javascript/bootstrap.min.js"></script>
	<script type="text/javascript" src="javascript/index.js"></script>
	<script type="text/javascript" src="javascript/profile.js"></script>
	<script type="text/javascript" src="javascript/together_msg_pro.js"></script>
	<script type="text/javascript" src="javascript/notification.js"></script>
	
	<?php if(@$_SESSION['Success_reply_check']):?>
	<script type="text/javascript">
    	$(document).ready(function(){
        	 $('#Message').modal('show');
		});
    </script>
	<?php endif;?>
	<?php @$_SESSION['Success_reply_check']=null;?>

	<script type="text/javascript">
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
	        var url = "normal_search/Normal_search.php";
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
						$("#search_result_box").append("<div class=\"element\"><img src=\""+value.image+"\"/><h6><a href=\"profile/profile.php?user_id="+value.id+"&acc_type=p&gend="+value.gender+"\">"+value.name+"</a></h6></div>");		
					}else
					{
						//for foundation
						$("#search_result_box").append("<div class=\"element\"><img src=\""+value.image+"\"/><h6><a href=\"profile/profile.php?f_id="+value.id+"&acc_type=f\">"+value.name+"</a></h6></div>");	
	
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


	</script>
</body>
</html>