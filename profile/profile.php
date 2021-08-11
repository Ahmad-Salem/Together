<?php
	include_once("../php_includes/connection_dp.php");
	include_once('../functions/check_login.php');
?>
<html>
<head>
	<title>profile</title>
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
	<link rel="stylesheet" type="text/css" href="../css/popup_profile_original.css">
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
			header('location: ../logout.php');
		}
	?>

	<!-- start  update notification seen -->
	<?php
		if($_COOKIE['Account_type']=='person')
		{
			$account_id=$_COOKIE['user_id'];
			$account_type='p';

		}else if($_COOKIE['Account_type']=='foundation')
		{
			$account_id=$_COOKIE['foundation_id'];
			$account_type='f';
		}
		
		if(@$_GET['acc_type']=='p')
		{
			$other_account_id=@$_GET['user_id'];
			$other_account_type='p';
		}else if(@$_GET['acc_type']=='f')
		{
			$other_account_id=@$_GET['foundation_id'];
			$other_account_type='f';
		}

		if(@$_GET['noti']=='noti_pro')
		{
			$query_truseted_update="UPDATE `following` SET `following_status`='1' WHERE `account_following_id`='$account_id' AND `account_following_type`='$account_type' AND `account_followed_id`='$other_account_id' AND `account_followed_type`='$other_account_type' LIMIT 1 ";
			$perform_query_truseted_update=mysqli_query($connect,$query_truseted_update);		
		}

		

	?>	
	<!-- end  update notification seen -->

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
					<input type="text" id="Main_search" name="search" placeholder="Search @Person or @Institution⁯ ..">
					<div class="search_option" id="search_option_box">
						
					</div>
					<div class="search_result" style="display:none;" id="search_result_box">
						<div class="element">
							<img src="../images/profile_image/Capture1.PNG"/>
							<h4 class="text-center" style="color:#3897f0;">No Result For Your Search ...</h4>
						</div>
					</div>
				</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-8">
				<div class="options">
					<ul class="list-unstyled option">
						<li><a href="../Main.php" class=""><i class="fa fa-home fa-2x" aria-hidden="true"></i></a></li>
						
						<div class="btn-group profile1">
							<li class="dropdown-toggle notification" data-toggle="dropdown"><a href="profile.php"><i class="fa fa-male fa-2x" aria-hidden="true"></i><span class="num_notification" id="profile1">0</span></a></li>
								<ul class="dropdown-menu" id="profile1_dropdown">
								    <li><a href="../profile.php">
								    	 
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
								    <li><a href="../messaging/messaging.php">
								    	<h6 class="text-center">Open Messages</h6>
								    </a></li>
								    <li><h6 class="text-center">There's No Notification To Show..</h6></li>
							  	</ul>
						</div>
						<div class="btn-group request"> 	  	
							<li class="dropdown-toggle notification" data-toggle="dropdown"><a href="all_request_posts/request_post.php"><i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i><span class="num_notification" id="request_post">0</span></a></li>
							<ul class="dropdown-menu" id="request_post_dropdown">
								<li><a href="../all_request_posts/request_post.php">
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
		if($_GET['acc_type']=="p")
		{
			$user_id=$_GET['user_id'];
			$query_getImage_p="SELECT `first_name`,`last_name`,`photo` FROM `users` WHERE id= '$user_id' ";
			$perfom_query_iamge_p=mysqli_query($connect,$query_getImage_p);
			$result_image_p=mysqli_fetch_assoc($perfom_query_iamge_p);

		}else{
			$foundation_id=$_GET['f_id'];
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
				<?php if($_GET['acc_type']=="p"):?>
					<?php if($_GET['gend']=="m"):?>
						
						<?php if($result_image_p['photo']!=null):?>
							src="../users/<?php echo $user_id.'/'.$result_image_p['photo'];?>"
							<?php else:?>
							src="../images/profile_image/default-person.jpg" 
							<?php endif;?>

							<?php else:?>
							
							<?php if($result_image_p['photo']!=null):?>
							src="../users/<?php echo $user_id.'/'.$result_image_p['photo'];?>"
							<?php else:?>
							src="../images/profile_image/user_profile_female.jpg" 
							<?php endif;?>

							<?php endif;?>		 	
				<?php else:?>
					<?php if($result_image_f['photo']!=null):?>
						src="../foundations/<?php echo $foundation_id.'/'.$result_image_f['photo'];?>"
						<?php else:?>
						src="../images/profile_image/default-academy.jpg" 
						<?php endif;?>
				<?php endif;?>
				/>
			</div> 
		</div>
		<div class="col-md-8 col-xs-8">
			<div class="profile_text">
			
				<?php 
				if($_GET['acc_type']=="p")
				{
					// to get the user name 
					$user_id=$_GET['user_id'];
					$query="SELECT 	first_name , last_name FROM users WHERE id='$user_id' LIMIT 1 ";
					$perform_query=mysqli_query($connect,$query);
					$result=mysqli_fetch_assoc($perform_query);

				}else
				{
					// to get the user name 
					$foundation_id=$_GET['f_id'];
					$query="SELECT 	name FROM foundations WHERE id='$foundation_id' LIMIT 1 ";
					$perform_query=mysqli_query($connect,$query);
					$result=mysqli_fetch_assoc($perform_query);					
				}
					
				?>


				<h4 style="display:inline;"><b><?php 
				if($_GET['acc_type']=="p")
				{
					echo $result['first_name'].' '.$result['last_name'];	
				}else
				{
					echo $result['name'];
				}
				

				?></b></h4>&nbsp;&nbsp;

				<?php 
					if(@$_GET['acc_type']=='p')
					{
						$account_id=$_GET['user_id'];	
					}else{
						$account_id=$_GET['f_id'];
					}
				?>
				<input type="hidden" value="<?php echo $account_id;?> " id="account_id"/>
				<div id="follow_button" style="display:inline;">

					<?php 

					// checking for following 
					if($_COOKIE['Account_type']=="person" && $_GET['acc_type']=="p")
					{
						$my_account_id=$_COOKIE['user_id'];
						$person_id=$_GET['user_id'];
						$query_P_P="SELECT `id` FROM `following` WHERE `account_followed_id`='$my_account_id' AND `account_followed_type`='p' AND `account_following_id`='$person_id' AND `account_following_type`='p' LIMIT 1";
						$perform_query_p_p=mysqli_query($connect,$query_P_P);
						if(mysqli_num_rows($perform_query_p_p)==1)
						{
							echo "<button id=\"p_p_action_untrust\" class=\"trust_btn\">Un Trust</button>";
						 }else{
							echo "<button id=\"p_p_action_trust\" class=\"trust_btn\"> Trust</button>";
						}
					}else if($_COOKIE['Account_type']=="person" && $_GET['acc_type']=="f")
					{
						$my_account_id=$_COOKIE['user_id'];
						$foundation_id=$_GET['f_id'];
						$query_P_f="SELECT `id` FROM `following` WHERE `account_followed_id`='$my_account_id' AND `account_followed_type`='p' AND `account_following_id`='$foundation_id' AND `account_following_type`='f' LIMIT 1";
						$perform_query_p_f=mysqli_query($connect,$query_P_f);
						
						if(mysqli_num_rows($perform_query_p_f)==1)
						{
							echo "<button id=\"p_f_action_untrust\" class=\"trust_btn\">Un Trust</button>";
						}else{
							echo "<button id=\"p_f_action_trust\"  class=\"trust_btn\"> Trust</button>";
						}

					}else if($_COOKIE['Account_type']=="foundation" && $_GET['acc_type']=="p")
					{

						$my_account_id=$_COOKIE['foundation_id'];
						$person_id=$_GET['user_id'];
						$query_f_P="SELECT `id` FROM `following` WHERE `account_followed_id`='$my_account_id' AND `account_followed_type`='f' AND `account_following_id`='$person_id' AND `account_following_type`='p' LIMIT 1";
						$perform_query_f_p=mysqli_query($connect,$query_f_P);
						if(mysqli_num_rows($perform_query_f_p)==1)
						{
							echo "<button id=\"f_p_action_untrust\" class=\"trust_btn\">Un Trust</button>";
						}else{
							echo "<button  id=\"f_p_action_trust\" class=\"trust_btn\"> Trust</button>";
						}

					}else if($_COOKIE['Account_type']=="foundation" && $_GET['acc_type']=="f")
					{

						$my_account_id=$_COOKIE['foundation_id'];
						$foundation_id=$_GET['f_id'];
						$query_f_f="SELECT `id` FROM `following` WHERE `account_followed_id`='$my_account_id' AND `account_followed_type`='f' AND `account_following_id`='$foundation_id' AND `account_following_type`='f' LIMIT 1";
						$perform_query_f_f=mysqli_query($connect,$query_f_f);
						if(mysqli_num_rows($perform_query_f_f)==1)
						{
							echo "<button id=\"f_f_action_untrust\" class=\"trust_btn\">Un Trust</button>";
						}else{
							echo "<button id=\"f_f_action_trust\" class=\"trust_btn\"> Trust</button>";
						}

					}
					//echo "<form id=\"f_p_action_untrust\" style=\"display:inline;\" method=\"POST\" ><button class=\"trust_btn\">Un Trust</button></form>";
					?>
				

				</div>
				
				

				<p class="lead">
					<b>
						<?php
							if($_GET['acc_type']=="p")
							{
								echo $result['first_name'].' '.$result['last_name'];	
							}else
							{
								echo $result['name'];
							}
						?>
					</b> 
						<?php 

						if($_GET['acc_type']=="p")
							{
								// to get the user name 
								$user_id=$_GET['user_id'];
								$query_des="SELECT 	description FROM users WHERE id='$user_id' LIMIT 1 ";
								$perform_query_des=mysqli_query($connect,$query_des);
								$result_des=mysqli_fetch_assoc($perform_query_des);

							}else
							{
								// to get the user name 
								$foundation_id=$_GET['f_id'];
								$query_des="SELECT 	description FROM foundations WHERE id='$foundation_id' LIMIT 1 ";
								$perform_query_des=mysqli_query($connect,$query_des);
								$result_des=mysqli_fetch_assoc($perform_query_des);					
							}

							if($_GET['acc_type']=="p")
								{
									echo $result_des['description'];	
								}else
								{
									echo $result_des['description'];
								}	
						?>



				</P>
				<div class="counters">
					
					<?php 
						if(@$_GET['acc_type']=='p')
						{
							$account_id=$_GET['user_id'];
							$account_type='p';
							// Query to person get number of posts
							$query_number_person_post="SELECT `id` FROM `normal_posts` WHERE `account_id`='$account_id' AND `account_type`='$account_type' ";
							$perform_query_number_person_posts=mysqli_query($connect,$query_number_person_post);
							$number_of_posts=mysqli_num_rows($perform_query_number_person_posts);
							echo "<span class=\"bold\">{$number_of_posts}</span>";
								
						}else if(@$_GET['acc_type']=='f')
						{
							$account_id=$_GET['f_id'];
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

					<span class="bold" id="trusted_accounts" >
					<?php
						if($_COOKIE['Account_type']=="person" && $_GET['acc_type']=="p")
						{
							$user_id=$_GET['user_id'];
							$query_p_p_s="SELECT `id` FROM `following` WHERE `account_following_id`='$user_id' AND  `account_following_type`='p' ";
							$perform_query_p_p_s=mysqli_query($connect,$query_p_p_s);

							
							echo mysqli_num_rows($perform_query_p_p_s);

						}else if($_COOKIE['Account_type']=="person" && $_GET['acc_type']=="f")
						{
							$foundation_id=$_GET['f_id'];
							$query_p_f_s="SELECT `id` FROM `following` WHERE `account_following_id`='$foundation_id' AND `account_following_type`='f' ";
							$perform_query_p_f_s=mysqli_query($connect,$query_p_f_s);
							

							echo mysqli_num_rows($perform_query_p_f_s);

						}else if($_COOKIE['Account_type']=="foundation" && $_GET['acc_type']=="p")
						{
							$user_id=$_GET['user_id'];
							
							$query_f_p_s="SELECT `id` FROM `following` WHERE `account_following_id`='$user_id' AND `account_following_type`='p' ";
							$perform_query_f_p_s=mysqli_query($connect,$query_f_p_s);

							


							echo mysqli_num_rows($perform_query_f_p_s);

						}elseif ($_COOKIE['Account_type']=="foundation" && $_GET['acc_type']=="f")
						{
							$foundation_id=$_GET['f_id'];
							
							$query_f_f_s="SELECT `id` FROM `following` WHERE `account_following_id`='$foundation_id' AND `account_following_type`='f' ";
							$perform_query_f_f_s=mysqli_query($connect,$query_f_f_s);
							

							echo mysqli_num_rows($perform_query_f_f_s);
						}else
						{
							echo '0';
						}	
					?>	

					</span>
					<span>Trusted</span>
					&nbsp;&nbsp;
					<span class="bold" id="trusting_accounts" >

						<?php
						if($_COOKIE['Account_type']=="person" && $_GET['acc_type']=="p")
						{
							$user_id=$_GET['user_id'];
							
							$query_p_p_s="SELECT `id` FROM `following` WHERE `account_followed_id`='$user_id' AND `account_followed_type`='p' ";
							$perform_query_p_p_s=mysqli_query($connect,$query_p_p_s);
							
							

							echo mysqli_num_rows($perform_query_p_p_s);

						}else if($_COOKIE['Account_type']=="person" && $_GET['acc_type']=="f")
						{
							$foundation_id=$_GET['f_id'];
							
							$query_p_f_s="SELECT `id` FROM `following` WHERE `account_followed_id`='$foundation_id' AND `account_followed_type`='f' ";
							$perform_query_p_f_s=mysqli_query($connect,$query_p_f_s);
							
							

							echo mysqli_num_rows($perform_query_p_f_s);

						}else if($_COOKIE['Account_type']=="foundation" && $_GET['acc_type']=="p")
						{
							$user_id=$_GET['user_id'];
							
							$query_f_p_s="SELECT `id` FROM `following` WHERE `account_followed_id`='$user_id' AND `account_followed_type`='p' ";
							$perform_query_f_p_s=mysqli_query($connect,$query_f_p_s);
							
						

							echo mysqli_num_rows($perform_query_f_p_s);

						}elseif ($_COOKIE['Account_type']=="foundation" && $_GET['acc_type']=="f")
						{
							$foundation_id=$_GET['f_id'];
							
							$query_f_f_s="SELECT `id` FROM `following` WHERE `account_followed_id`='$foundation_id' AND `account_followed_type`='f' ";
							$perform_query_f_f_s=mysqli_query($connect,$query_f_f_s);
							
							

							echo mysqli_num_rows($perform_query_f_f_s);
						}else
						{
							echo '0';
						}	
					?>

					</span>
					<span>Trusting</span>
				</div>
				<?php

				if($_GET['acc_type']=="p"){
					$user_id=$_GET['user_id'];
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
						$foundation_id=$_GET['f_id'];
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
                     	if($_GET['acc_type']=="p")
                     		{
                     			echo 'style="width:'.$percetage.'%"';
                     		}else{
                     			echo 'style="width:'.$percetage_f.'%"';
                     		} ?> >
                        <h4 class="info">Information Completion <?php 
                        if($_GET['acc_type']=="p"){
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
	<input type="hidden" value="<?php echo @$_GET['user_id'];?>" id="user_id">
	<input type="hidden" value="<?php echo @$_GET['f_id'];?>" id="f_id">
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
                        Copyright &copy; 2017 <span>Together</span>.INC
    </div>









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
	<script type="text/javascript" src="../javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
	<script type="text/javascript" src="../javascript/index.js"></script>	
	<script type="text/javascript" src="../javascript/follow.js"></script>
	<script type="text/javascript" src="../javascript/notifications_another.js"></script>
	<?php if(@$_GET['acc_type']=='p'):?>
		<script type="text/javascript" src="../javascript/profile_2.js"></script>
	<?php elseif(@$_GET['acc_type']=='f'):?>
		<script type="text/javascript" src="../javascript/profile_3.js"></script>
	<?php endif;?>
		
	<script type="text/javascript">
		<?php if($_COOKIE['Account_type']=='person' && @$_GET['acc_type']=='p'):?>
		setInterval(function(){display_person_person_trusted_ajax();},"1000");
		    function display_person_person_trusted_ajax(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var account_id=$("#account_id").val();
        var url = "../following/trusted.php";
        var vars = "account_id="+account_id;

        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         
         // Access the onreadystatechange event for the XMLHttpRequest object
         hr.onreadystatechange = function() {
        
         if(hr.readyState == 4 && hr.status == 200) {
        
             var return_data = hr.responseText;
                
             $("#trusted_accounts").html(return_data);
                      
         }else{
            
         }
   
         }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        
    }
		
		//alert("pp");
		<?php elseif($_COOKIE['Account_type']=='person' && @$_GET['acc_type']=='f'):?>
		setInterval(function(){display_person_foundation_trusted_ajax();},"1000");
		function display_person_foundation_trusted_ajax(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var account_id=$("#account_id").val();
        var url = "../following/trusted_p_f.php";
        var vars = "account_id="+account_id;

        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         
         // Access the onreadystatechange event for the XMLHttpRequest object
         hr.onreadystatechange = function() {
        
         if(hr.readyState == 4 && hr.status == 200) {
        
             var return_data = hr.responseText;
              
             $("#trusted_accounts").html(return_data);
                 
         }else{
            
         }
   
         }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        
    }
		//alert("pf");
		<?php elseif($_COOKIE['Account_type']=='foundation' && @$_GET['acc_type']=='f'):?>
		setInterval(function(){display_foundation_foundation_trusted_ajax();},"1000");
		function display_foundation_foundation_trusted_ajax(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var account_id=$("#account_id").val();
        var url = "../following/trusted_f_f.php";
        var vars = "account_id="+account_id;

        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         
         // Access the onreadystatechange event for the XMLHttpRequest object
         hr.onreadystatechange = function() {
        
         if(hr.readyState == 4 && hr.status == 200) {
        
             var return_data = hr.responseText;
                
             $("#trusted_accounts").html(return_data);
                      
         }else{
            
         }
   
         }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        
    }

		//alert("ff");
		<?php elseif($_COOKIE['Account_type']=='foundation' && @$_GET['acc_type']=='p'):?>
		setInterval(function(){display_foundation_person_trusted_ajax();},"1000");
		function display_foundation_person_trusted_ajax(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var account_id=$("#account_id").val();
        var url = "../following/trusted_f_p.php";
        var vars = "account_id="+account_id;

        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         
         // Access the onreadystatechange event for the XMLHttpRequest object
         hr.onreadystatechange = function() {
        
         if(hr.readyState == 4 && hr.status == 200) {
        
             var return_data = hr.responseText;
                
             $("#trusted_accounts").html(return_data);
                      
         }else{
            
         }
   
         }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        
    }

		//alert("fp");
		<?php endif;?>
		



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
	<script type="text/javascript">
		$(document).ready(function(){
			var trusted=$('#trusted_accounts').val();
			if(trusted=='')
			{
				setTimeout(function(){$('#trusted_accounts').html('0');},3000);
			}
		});
	</script>
	
</body>
</html>