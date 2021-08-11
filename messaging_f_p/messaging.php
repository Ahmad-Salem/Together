<?php
include_once('../functions/check_login.php');
include_once("../php_includes/connection_dp.php");
include_once("../functions/fun_rand_msg.php");
?>
<html>
<head>
	<title>Messaging Page</title>
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
	<link rel="stylesheet" type="text/css" href="../css/messaging.css">
	<link rel="stylesheet" type="text/css" href="../css/media.css">
	<noscript><meta http-equiv="refresh" content="0; url=whatyouwant.html" /></noscript>
</head>
<body>
	<?php
		//check logged in
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
					<input type="text" name="search" placeholder="Search..">
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-8">
				<div class="options">
					<ul class="list-unstyled option">
						<li><a href="../Main.php"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a></li>
						<?php if($_COOKIE['Account_type']=="person"): ?>
						<li><a href="profile.php?user_id=<?php echo $_COOKIE['user_id'];?>"><i class="fa fa-male fa-2x" aria-hidden="true"></i></a></li>
						<?php else: ?>
						<li><a href="../profile.php?f_id=<?php echo $_COOKIE['foundation_id'];?>"><i class="fa fa-male fa-2x" aria-hidden="true"></i></a></li>
						<?php endif;?>	
						<li><a href="#"><i class="fa fa-bell fa-2x" aria-hidden="true"></i></a></li>
						<li><a href="messaging_f_f/messaging.php"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- messaging container -->
	<div class="container message">
		<div class="col-lg-4 messaging-list">
			
			<div class="list-messages ">
				<h4 class="text-center">Opened Conversation list</h4>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="account-container">
							<div class="user_image"><img src="../images/profile_image/Capture1.PNG" title="Ahmad Salem" /></div>
							<div class="user_name">< user name ></div>
							<div class="status"><i class="fa fa-check-circle-o fa-2x true" aria-hidden="true"></i></div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="account-container">
							<div class="user_image"><img src="../images/profile_image/Capture1.PNG" title="Ahmad Salem" /></div>
							<div class="user_name">< user name ></div>
							<div class="status"><i class="fa fa-times-circle-o fa-2x false" aria-hidden="true"></i></div>
						</div>
					</li>
					
				</ul>
			</div>
		</div>
		<div class="col-lg-8 messaging-side">
			
		<div class="chatbox">
			<div class="new_conversation">
					<h4 class="text-center"><button data-toggle="modal" data-target="#start_new_conversation">Start New Conversation</button></h4>
			</div>
			
			<!-- start conversation section -->
			<?php if((!isset($_GET['fid']) && empty($_GET['fid'])  && !isset($_GET['acc_type']) && empty($_GET['acc_type'])) OR (!isset($_GET['uid']) && empty($_GET['uid'])  && !isset($_GET['acc_type']) && empty($_GET['acc_type']) && !isset($_GET['gender']) && empty($_GET['gender']) )):?>
			<div class="default-banner_logo">
				<div class="logo_title">
					<img src="../images/logo/1.png" class="img-responsive" title="Together" alt="Together"/>
				</div>
				<div class="logo_text">
					<h4 class="text-center">We will do what we have to do</h4>
					<h5 class="text-center">We Are Care About Making Communication More Easy so Be In</h5>
					<h5 class="text-center">We Need to help just to make people Happy.</h5>
				</div>
			</div>
			<?php else:?>

			<!-- accout type-->
			<!-- gender type-->

			<?php 
				if($_GET['acc_type']=='f')
				{
					$fid=$_GET['fid'];
					$query_msg_f="SELECT `name`,`photo` FROM `foundations` WHERE id='$fid' LIMIT 1";
					$perform_query_msg_f=mysqli_query($connect,$query_msg_f);
					$result_msg_f=mysqli_fetch_assoc($perform_query_msg_f);
				}else{
					$uid=$_GET['uid'];
					$query_msg_p="SELECT CONCAT(`first_name`,'    ',`last_name`) `fullname`,`photo`,`gender` FROM `users` WHERE id='$uid' LIMIT 1";
					$perform_query_msg_p=mysqli_query($connect,$query_msg_p);
					$result_msg_p=mysqli_fetch_assoc($perform_query_msg_p);
				}
			?>
		<div class="chat_process_container">
			<div class="chatlogs " id="chatlogs_body">	
			<?php if($_GET['acc_type']=='f'):?>
			
				<?php
					if($_COOKIE['Account_type']==$_GET['acc_type']."oundation")
					{
						header("location: ../messaging_f_f/messaging.php");
					}
				?>	
				<div class="header">
					<?php 
						if($result_msg_f['photo']!=null)
						{
							$image="../foundations/".$fid."/".$result_msg_f['photo'];
						}else{
							//default foundation photo 
							$image="../images/profile_image/default-academy.jpg";
						}	

					?>
					<div class="user-photo"><img src="<?php echo $image;?>"  title="<?php echo $result_msg_f['name']; ?>" /></div>
					<p class="chat-message"><?php echo $result_msg_f['name'];?></p>
				</div>
				<?php $fid=$_GET['fid'];?>
				<input type="hidden" id="foundation_id" name="" value="<?php echo $fid; ?>" />
							
			<?php elseif($_GET['acc_type']=='p'):?>

				<div class="header">
					<?php
						if($_COOKIE['Account_type']=="person")
						{
							header("location: ../messging/messaging.php");
						}
					?>
					<?php 
						if($result_msg_p['gender']=='m')
						{
							if($result_msg_p['photo']!=null)
							{
								$image="../users/".$uid."/".$result_msg_p['photo'];
							}else{
								//default image
								$image="../images/profile_image/default-person.jpg"; 
							}


						}else{
							//female
							if($result_msg_p['photo']!=null)
							{
								$image="../users/".$uid."/".$result_msg_p['photo'];
							}else{
								//default image 
								$image="../images/profile_image/user_profile_female.jpg";
							}
						}
					?>
					<div class="user-photo"><img src="<?php echo $image;?>"  title="<?php echo $result_msg_p['fullname']; ?>" /></div>
					<p class="chat-message"><?php echo $result_msg_p['fullname'];?></p>
				</div>
				<?php $uid=$_GET['uid'];?>
				<input type="hidden" id="person_id" name="" value="<?php echo $uid; ?>" />


			<?php else:?>
					<h4 class="text-center"> Somethings Going Wrong Try Again.</h4>
				<?php endif; ?>
			<?php endif;?>


			<div id="chat_content"></div>

				<div id="loading">
					<div class="load-wrapp">
			            <div class="load-3">
			                <div class="line"></div>
			                <div class="line"></div>
			                <div class="line"></div>
			            </div>
			       	</div>
				</div>
		
			</div>

			<div class="messge_chat">	
				 
					<textarea  placeholder="Type A Message...." id="message_body" ></textarea>
					<button class="messge_chat_btn" id="message_box_f_f" ><span><i class="fa fa-reply fa-lg" aria-hidden="true"></i></span></button>
				
			</div>
		

			</div>
			<!-- the end of  conversation section -->
			

			</div>
		
		
	</div>

		</div>
	</div>	

	<div class="footer_inc text-center">
                        Copyright &copy; 2016 <span>Elbayady</span>.INC
    </div>




    <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="start_new_conversation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_new_conversation">
	    	  	
	      <div class="modal-body new_conversation_body">
	      	<div class="btn_search">
	      		<div class="person_btn">
	      			<button class="btn_search_person" id="btn_person">Search About persons </button>
	      		</div>
	      		<div class="foundation_btn">
	      			<button class="btn_search_foundation" id="btn_foundation">Search About Foundations</button>
	      		</div>
	      	</div>
	        <div class="message_search" id="field_foundation">
	        	<button id="foundation_back"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></button>
	        	<input type="text" id="search_input_foundation" name="search" placeholder="Search About Foundations ...">
	        </div>
	        <div class="message_search" id="field_person">
	        	<button id="person_back"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></button>
	        	<input type="text" id="search_input_person" name="search" placeholder="Search About Persons ...">
	        </div>
	        <div class="messaging_search_result" id="field_result">
	        	<h4>No Result Matched " The Name You Entered "</h4>
	        	<ul class="list-unstyled foundation_list">
	        		

	        	</ul>
	        </div>
	        <div class="messaging_search_intro" id="into_msg">
	        	<div class="img_logo">
	        	<img src="../images/logo/1.png" title="Together" alt="Together"/>
	       		</div>
	       		<h4 class="text-center">We will do what we have to do</h4>
	       		<h5 class="text-center">We Are Care About Making Communication More Easy </h5>
	       		<h5 class="text-center">We Need to help just to make people Happy.</h5>
	        </div>
	      </div>

	      

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->




    
	<script type="text/javascript" src="../javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
	<script type="text/javascript" src="../javascript/index.js"></script>
	<script type="text/javascript" src="../javascript/messaging_f_p.js"></script>
	<script type="text/javascript">
		$(function () {
 		 $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
</body>
</html>