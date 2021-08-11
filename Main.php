<?php
	include_once('functions/check_login.php');
	include_once("php_includes/connection_dp.php");
?>
<html>
<head>
	<title>Home</title>
	<!-- tab icon -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
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
	<link rel="stylesheet" type="text/css" href="css/post_wizard.css">
	<link rel="stylesheet" type="text/css" href="css/drag_drop_photo.css">
	<link rel="stylesheet" type="text/css" href="css/likes_people.css">
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
							<h4 class="text-center" style="color:#3897f0;">No Result For Your Search ...</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-8">
				<div class="options">
					<ul class="list-unstyled option">
						<li><a href="Main.php" class="active"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a></li>
						
						<div class="btn-group profile1">
							<li class="dropdown-toggle notification" data-toggle="dropdown"><a href="profile.php"><i class="fa fa-male fa-2x" aria-hidden="true"></i><span class="num_notification" id="profile1">0</span></a></li>
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
    
   
    
	<div class="container post_area" id="Main_container" >
		
        
		<!-- start posting section -->
		<div class="post">
          
            <div class="request_post_body">
                <ul class="list-unstyled list_request">
                  <li class="request_header">
                    <h4 class="text-center plus"> <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> New Post</h4>
                  </li>
                  <li class="request_body">
                    <div class="request_buttons row">
                      
                      <div class="col-xs-6 first_btn">
                        <button id="normal_post1"><i class="fa fa-edit fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Normal Post</button>  
                      </div>
                      
                      <div class="col-xs-6 second_btn">
                        <button id="Request_post"><i class="fa fa-bullhorn fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Announcement</button>  
                      </div>
                      
                    
                    </div>
                  </li>
                </ul>
            </div>

          
        </div>
		<!-- end Posting section -->  
		


         <!--loading before display posts-->
        <div class="loader" id="loader">Loading...</div>
        <!-- post section -->
		<div class="normal_post_container">
			<div class="normal_post_content" id="normal_post_content">
				





			</div>
		</div>

		<!-- post 2-->
		<!-- <div class="post"> -->
			<!-- post header --> 
			<!-- <div class="post_header"> -->
				<!-- <img class="img-responsive" src="images/logo/Capture.PNG" /> -->
				<!-- <h5> < user name > </h5> -->
				<!-- <span><b>5s</b></span> -->
				<!-- <div class="clear"></div> -->
			<!-- </div> -->
			<!-- image of the post -->
			<!-- <div class="post_image">
				<div class="main-photo">
					<img class="img-responsive" src="images/profile_image/1443263206253.jpg" />
				</div>
				<div class="rest_photos">
					<div class="R_photo">
						<img class="img-responsive" src="images/profile_image/1443263206253.jpg" />
						<span class="number_rest_images">+2<span>
					</div>
					
				</div>	 -->
				
			<!-- </div> -->
			<!-- things related with the post -->
			<!-- <div class="related_contents"> -->

				<!-- <div class="likes"> -->
					<!-- <span><b>24</b></span><span>&nbsp;&nbsp;likes</span> -->
				<!-- </div> -->
				<!-- <div class="caption"> -->
				<!-- 	<p>ahmed sa;dlas; dlnas;d lnas;dlnsa;ldnas;  dnsal;dansd;lansd;lasn
						sdnkasl dnkaslkd  aslkdnaslk dnasasd kalsndlaksn,s mdams d,sam </p>
				</div> -->
				<!-- <div class="comments">
					<p><img src='images/profile_image/default-academy.jpg' /> <span><b>< user name ></b></span> <span>mnwar ya abo elshab 3> </span> </p>
					<p><img src='images/profile_image/default-academy.jpg' /> <span><b>< user name ></b></span> <span>mnwar ya abo elshab 3> </span> </p>
					<p><img src='images/profile_image/default-academy.jpg' /> <span><b>< user name ></b></span> <span>mnwar ya abo elshab 3> </span> </p>
				</div>
				<div class="actions">
					 <div class="like_btn" id="like_btn">
					 	<span><i class="fa fa-heart-o fa-2x" aria-hidden="true"></i></span>
					 </div>
					 <div class="like_btn" id="unlike_btn" style="display:none;">
					 	<span><i class="fa fa-heart fa-2x" aria-hidden="true"></i></span>
					 </div>
					 <div class="comment">
					 	<input type="text" name="comment" placeholder="Add Comment...." />
					 	<button class="comment_btn"><span><i class="fa fa-mail-reply fa-lg" aria-hidden="true"></i></span></button>
					 </div>
				</div> -->

			<!-- </div>
		</div>
 -->





	
	</div>		

	<div class="footer_inc text-center">
                        Copyright &copy; 2017 <span>Together</span>.INC
    </div>


    <!--suggestion for person-->
    <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	       normal post status
	        
	      </div>

	      <div class="modal-body mod_body_setting_suggested cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->



	<!-- pop up of normal post check success model -->
    <!-- Modal -->
<div class="modal fade fading_opacity" id="post_detail_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body mod_body">
	        <h4 class="text-center h4"><img 
	        	<?php if(@$_SESSION['Success_Photo_check']=="true"):?>
	        		src="images/icon/accept.png"
	        	<?php else:?>
	        		src="images/icon/cancel.png"
	        	<?php endif;?>

	        	/><b style=""><?php echo @$_SESSION['message_post'];?></b> </h4>
	      </div>

	      <div class="modal-body mod_body cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->

	<!-- pop up of normal post check success model -->
    <!-- Modal -->
<div class="modal fade fading_opacity" id="request_post_detail_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body mod_body">
	        <h4 class="text-center h4"><img 
	        	<?php if(@$_SESSION['Success_Photo_check_request']=="true"):?>
	        		src="images/icon/accept.png"
	        	<?php else:?>
	        		src="images/icon/cancel.png"
	        	<?php endif;?>

	        	/><b style=""><?php echo @$_SESSION['message_post_request'];?></b> </h4>
	      </div>

	      <div class="modal-body mod_body cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->

	<!--suggestion for person-->
	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="Setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	        <h4 class="text-center h4">Setting For Suggested Foundations..</h4>
	        <div class="option_suggest">
	        	<form method="POST">
		        	<label>Blue Mark</label>
		        	<input type="radio" name="Suggestion" value="blueMark"/>
		        	<br/><br/>
		        	<label>Information Completion</label>
		        	<input type="radio" name="Suggestion" value="InfoCompletion"/>
		        	<br/><br/>	
		        	<label>Country</label>
		        	<input type="radio" name="Suggestion" value="Country" CHECKED/>
	       		</form>
	        	
	        </div>
	        
	      </div>

	      <div class="modal-body mod_body_setting_suggested cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->


	<!--suggestion for foundation-->
	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="Setting_foundation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	        <h4 class="text-center h4">Setting For Suggested Foundations..</h4>
	        <div class="option_suggest">
	        	<form method="POST">
		        	<label>Blue Mark</label>
		        	<input type="radio" name="Suggestion" value="blueMark"/>
		        	<br/><br/>
		        	<label>Information Completion</label>
		        	<input type="radio" name="Suggestion" value="InfoCompletion"/>
		        	<br/><br/>	
		        	<label>Country</label>
		        	<input type="radio" name="Suggestion" value="Country" CHECKED/>
	       		</form>
	        	
	        </div>
	        
	      </div>

	      <div class="modal-body mod_body_setting_suggested cansel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->

	<!--request post -->
	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="Request_post1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dioreq" role="document">
	    
	    <div class="modal-content mod_conreq">
	    	  	
	      <div class="modal-body_set mod_body_request_post">
	        <h4 class="text-center">Create Your Custom Post</h4>
              <hr/>
		       
		        <div class="content">
                    <ul class="progressbar">
                        <li class="active photo op">
                            Request Type
                        </li>
                        <li class="photo">
                            Photos
                        </li>
                        <li class="caption">Caption</li>
                    </ul>
                </div>	
	        
	        	<div class="split">
                  <hr/>
                </div>
               <!--  request_post/request_post.php -->
                <form action="request_post/request_post.php" method="post" id="request_post_upload" enctype="multipart/form-data">
                  <fieldset id="fd1">
                    <!-- adding photos for the post -->
                        <div class="form_content">
                        
                          <hr/>
                         <div class="content_reuest">
                            
                            <h4 class="header4">Request type</h4>
                            
                             <input type="radio" name="request_type_value" checked value="fc"/>
                             &nbsp;&nbsp;&nbsp;&nbsp;
                             <label><h4>Found</h4></label>
                            
                            <br/>
                            
                             <input type="radio" name="request_type_value" value="lc"/>
                             &nbsp;&nbsp;&nbsp;&nbsp;
                             <label><h4>Lost</h4></label>
                           	 <!-- error testing -->
                            <div class="request_error" id ="error_request_type"><h5 class="text-center">Error testing....</h5></div>
  
                        </div> 
                         
                        <div class="button_action">
                          <input type="button" id="next1" name="next" class="next next1 action-button" value="Next"/>
                        </div> 
                      </div>
                  </fieldset>
                  <fieldset style="display:non;" id="fd2">
                    <!-- adding photos for the post -->
                        <div class="form_content">
                        
                          <hr/>
                         <div class="content_reuest">
                            
                            
                         	<!-- drag_error -->
                           	<div class="error_testing" id="photo_error2" style="display:block;">
                                <h6 class="error">Choose Your Picture</h6>
                            </div>
                             <div class="warning_testing" id="warnning2">
                                <h6 class="warning">Note: the maximum number of the images yoou can upload is 20 image</h6>
                            </div>
                            <center class="upload_photos">
								<h6>Note: you can upload multiple photos </h6>
								<div class="form-group">
									<input type="file" id="file_2" class="file" multiple  name="image[]">
								</div>
							</center>  
				            <div id="uploaded_file"></div> 
				             <!-- error testing -->
                            <div class="request_error" id ="error_child_images"><h5 class="text-center">Error testing....</h5></div>

                        </div> 
                        <div class="button_action2">  
                            <input type="button" class="previous" id="previous1" name="previous action-button" value="Previous"/>
                            <input type="button" class="post" id="next2" value="next"/>
                        </div>     

                      </div>
                  </fieldset>
                  <fieldset style="display:none;" id="fd3">
                    <div class="post_caption_text">
                        <div class="content_reuest">
                            <h4 class="text-center header4r">Enter Child Information...</h4>
                            
                            <div class="input-group margin-bottom-sm">
                              <span class="input-group-addon"><i class="fa fa-male fa-fw"></i></span>
                              <input class="form-control" id="child_name" type="text" name="child_name_value" placeholder="Name ...">
                            </div>
                            <!-- error testing -->
                            <div class="request_error" id ="error_child_name"><h5 class="text-center">Error testing....</h5></div>
                            
                            <div class="option_age">
                                <label>Age:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <select name="child_age_value" id="child_age">
                                    <option selected disabled value>Child age</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                </select>
                            
                            </div>

                            <!-- error testing -->
                            <div class="request_error" id ="error_child_age"><h5 class="text-center">Error testing....</h5></div>

                            <div class="oprtion_tall">
                                <label>Tall in (cm):&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="number"  max="200" min="50"  id="child_tall" name="child_tall_value" />
                            </div>
                            
                            <!-- error testing -->
                            <div class="request_error" id ="error_child_tall"><h5 class="text-center">Error testing....</h5></div>

                            <div class="option_skin">
                                <label>Ethnicity:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <select name="child_skin_value" id="child_skin">
                                    <option selected disabled value>Child Skin Color</option>
                                    <option value="Albanians">Albanians</option>
                                    <option value="Afrikaners">Afrikaners</option>
                                    <option value="Arabs">Arabs</option>
                                    <option value="Assyrians">Assyrians</option>
                                    <option value="British">British</option>
                                    <option value="Bulgarians">Bulgarians</option>
                                    <option value="Catalans">Catalans</option>
                                    <option value="English">English</option>
                                    <option value="French">French</option>
                                    <option value="Germans">Germans</option>
                                    <option value="Greeks">Greeks</option>
                                    <option value="Italians">Italians</option>
                                    <option value="Japanese">Japanese</option>
                                    <option value="Koreans">Koreans</option>
                                    <option value="Macedonians">Macedonians</option>
                                    <option value="Malays">Malays</option>
                                    <option value="Norwegians">Norwegians</option>
                                    <option value="Romanians">Romanians</option>
                                    <option value="Russians">Russians</option>
                                    <option value="Slovaks">Slovaks</option>
                                    <option value="Sundanese">Sundanese</option>
                                    <option value="Swedes">Swedes</option>
                                    <option value="Turks">Turks</option>
                                    <option value="Ukrainians">Ukrainians</option>
                                    <option value="Vietnamese">Vietnamese</option>
                                    <option value="Other">Other</option>

                                </select>
                            
                            </div>
                            

                            <!-- error testing -->
                            <div class="request_error" id ="error_child_skin"><h5 class="text-center">Error testing....</h5></div>

                            <div class="option_eye">
                                <label>Eyes Color:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <select name="child_eye_value" id="child_eye">
                                    <option selected disabled value>Child Eyes Color</option>
                                    <option value="black">black</option>
                                    <option value="brown">brown</option>
                                    <option value="blue">blue</option>
                                    <option value="green">green</option>

                                </select>
                            
                            </div>
							
                            <!-- error testing -->
                            <div class="request_error" id ="error_child_eye"><h5 class="text-center">Error testing....</h5></div>


                            <div class="option_hair">
                                <label>Hair Color:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <select name="child_hair_value" id="child_hair">
                                    <option selected disabled value>Child Hair Color</option>
                                    <option value="black">black</option>
                                    <option value="brown">brown</option>
                                    <option value="blond">blond</option>
                                    <option value="auburn">auburn</option>
                                    <option value="red">red</option>
                                </select>
                            
                            </div>

                            <!-- error testing -->
                            <div class="request_error" id ="error_child_hair"><h5 class="text-center">Error testing....</h5></div>

                            <div class="option_hair">
                                <label>Last Seen:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <select name="child_last_seen" id="child_lastSeen">
                                    <option selected disabled value>Child Last Seen</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2010">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                    <option value="2005">2005</option>
                                </select>
                            
                            </div>

                            <!-- error testing -->
                            <div class="request_error" id ="error_child_lastSeen"><h5 class="text-center">Error testing....</h5></div>


                            <div class="option_country">
                                <label>Country:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <select name="child_country_value" id="child_country">
                                    <option selected disabled value>Child Country</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Cape Verde">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos Islands">Cocos Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands">Falkland Islands</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel(State of the occupation) </option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia">Micronesia</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="North Korea">North Korea</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory">Palestinian Territory</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia">South Georgia</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="The Former Yugoslav Republic of Macedonia">The Former Yugoslav Republic of Macedonia</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican City">Vatican City</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                              </select>            
                            </div>
                            
                            <!-- error testing -->
                            <div class="request_error" id ="error_child_country"><h5 class="text-center">Error testing....</h5></div>



                            <div class="option_descrip_loosing_story">
                                <h5 class="text-center">Descripe child story</h5>
                                <textarea placeholder="Descripe child  story" id="child_story" name="child_story_value"></textarea>    
                            </div>
                            
                            <!-- error testing -->
                            <div class="request_error" id ="error_child_story"><h5 class="text-center">Error testing....</h5></div>



                            <div class="option_descrip_status">
                                <h5 class="text-center">Descripe child status</h5>
                                <textarea placeholder="Descripe child status" id="child_status" name="child_status_value"></textarea>    
                            </div>
                            

                            <!-- error testing -->
                            <div class="request_error" id ="error_child_status"><h5 class="text-center">Error testing....</h5></div>


                            <div class="option_descrip_contact">
                                <h5 class="text-center">Determine Contact ways</h5>
                                <textarea placeholder="Determine Contact ways" id="child_contact_ways" name="child_contact_ways_value"></textarea>    
                            </div>
                            
                            <!-- error testing -->
                            <div class="request_error" id ="error_child_contact"><h5 class="text-center">Error testing....</h5></div>


                            <div class="option_descrip_relation">
                                <h5 class="text-center">Descripe the Relation with the child</h5>
                                <textarea placeholder="Descripe the Relation with the child" id="child_relation" name="child_relation_ways_value"></textarea>    
                            </div>

                            <!-- error testing -->
                            <div class="request_error" id ="error_child_relation"><h5 class="text-center">Error testing....</h5></div>


                        </div> 
                    </div>
                    <div class="button_action2">  
                        <input type="button" class="previous" name="previous action-button" value="Previous" id="previous2"/>
                        <input type="submit" id="post_request" class="post" value="Post"/>
                    </div>  
                  </fieldset>
                  
              </form>

	      </div>

	     

	    </div>
	  </div>
	</div>

	<!-- the end of pop up of logout model -->

	<!-- pop up of logout model -->
    <!-- Modal --><!-- 
	<div class="modal fade fading_opacityw" id="normal_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_diow" role="document">
	    
	    <div class="modal-content mod_con_normal_post">
	    	  	
	     
	        <div class="wizard_body">
              <h4 class="text-center">Create Your Custom Post</h4>
              
              <hr/>
              
                <div class="content">
                    <ul class="progressbar">
                        <li class="active photo">
                            Photos
                        </li>
                        <li class="caption">Caption</li>
                    </ul>
                </div>
                <div class="split">
                  <hr/>
                </div>
              <form action="posting_person/normalpost.php" enctype="multipart/form-data" method="POST" id="normal_post">
                   -->
                    <!-- adding photos for the post -->
                        <!-- <fieldset class="form_content" id="fd1n"> -->
                        <!-- <div class="file-input wrapper photo_btn" id="picture_adding">

                          <input id="Custom_post" type="file" name="post_photo"  class="file-input control" />

                          <div class="file-input content" id="center_action_photo">
                            <div class="upload_image_style">

                                    <div class="photo_box">
                                        <img src="images/icon/default-avatar.jpg" title="Choose Your Picture">
                                    </div>
                            </div>
                            <div class="choose_photo">
                            	<h6>Choose Your Picture</h6>
                            </div>
                          </div>

                        </div> -->
                          
                         <!--  <div class="error_testing" id="photo_error" style="display:block;">
                                <h6 class="error">Choose Your Picture</h6>
                            </div>
                            <div class="warning_testing" id="warnning">
                                <h6 class="warning">Note: the maximum number of the images yoou can upload is 20 image</h6>
                            </div>
 -->
                        <!-- <div class="photobox photo_display" style="display:none;" id="adding_action">
                          <div class="photo_value">
                            <img src="images/icon/default-avatar.jpg" title="">
                            <button class="button_close">
                              <div></div>
                              <div></div>
                            </button>
                          </div> -->
                          
                          



                          
                        
							<!-- <div class="file-input2 wrapper2 photo_btn" id="picture_adding">

	                          <input id="Custom_post2" type="file" name="post_photo"  class="file-input control" />

	                          <div class="file-input2 content2" id="center_action_photo">
	                            <div class="upload_image_style2">

                                	<div class="photo_action" id="add_photo">
                            			<h6 class="text-center">+</h6>
                          			</div>  
	                            
	                            </div>
	                            
	                          </div>

                        </div>                        
 -->
                                
                        <!-- </div>   -->
                        <!-- <center>
								<h6>Note: you can upload multiple photos </h6>
								<div class="form-group">
									<input type="file" id="file_1" class="file" multiple  name="image[]">
								</div>
								
							
						</center>
                        <div class="button_action">
                          <input type="button" name="name" id="next_btn" class="next next1 action-button" value="Next"/>
                        </div> 
                      
                  </fieldset>
                  <fieldset style="display:none;" id="fd2n">
                    <div class="post_caption_text">
                        <div class="caption_textarea">
                            <textarea id="textarea_caption" name="caption_normal" placeholder="Write Your Caption...."></textarea>
                        </div>

                    </div>
                    <div class="error_testing" id="textarea_error" style="display:block;">
                                <h6 class="error">Error testing </h6>
                    </div>
                    <div class="button_action2">  
                        <input type="button" class="previous" id="previous_btn" name="previous action-button" value="Previous"/>
                        <input type="submit" class="post" value="Post"/>
                    </div>  
                  </fieldset>
                  
              </form>
              
              
          </div>
	       		
	      

	      
	    </div>
	  </div>
	</div> -->

	<!-- the end of pop up of logout model -->


	<!-- start modal for normal posting -->
        
       <!-- Modal -->
        <div class="modal fade mod" id="normal_post_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog mod_dio" role="document">
            <div class="modal-content con_dio">
              <div class="modal-header head_dio">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Normal post</h4>
              </div>
              <form action="posting_person/normalpost.php" enctype="multipart/form-data" method="POST" id="normal_post">
              <div class="modal-body mod_body">
                <textarea placeholder="What's happening?" name="caption_normal"></textarea>
              </div>
              
              <div class="modal-footer mod_footer">
                
              	<div class="file-input wrapper photo_btn"> 					               
                    <input id="update_photo" type="file"  multiple name="image[]" class="file-input control" />
                    <div class="file-input content">
                		<span class="Image"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></span>    	 
                   	</div>
	       		 </div>

	       		 <div class="alert_images">
	       		 	<h6><span id="images">0</span>Images Uploaded.</h6>
	       		 </div>
                
                



                <button type="button" class="btn btn-default clo" data-dismiss="modal">Close</button>
                <button type="submit" class="btn  post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;POST</button>
              </div>
              </form>

            </div>
          </div>
        </div>
        
        
        <!-- end modal for normal posting -->




	<script type="text/javascript" src="javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="javascript/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="javascript/index.js"></script>-->
	<script src="javascript/jquery-easing.js" type="text/javascript"></script>
	<!--  Plugin for the Wizard -->
    <script src="javascript/post_plus.js" type="text/javascript"></script>            
	<script src="javascript/posting.js" type="text/javascript"></script>
	<script type="text/javascript" src="javascript/fileinput.min.js"></script>
	<!-- plugin for normal post -->
	<script src="javascript/posting_normal.js" type="text/javascript"></script>
	<script src="javascript/posting_normal_validation.js" type="text/javascript"></script>
	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="javascript/jquery.validate.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="javascript/request_post.js"></script>
	<script type="text/javascript" src="javascript/notification.js"></script>
	<script type="text/javascript">

    	$(document).ready(function(){
    		$('#Setting_link').click(function(){
    			$('#Setting').modal('show');	
    		});
    		$("#post_details").click(function(){
					
			});
			
			

        	$('#Setting_link_foundation').click(function(){
    			$('#Setting_foundation').modal('show');	
    		});
    		$('#normal_post1').click(function(){
    			$('#normal_post_popup').modal('show');	
    		}); 
		});
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
    	$('#file-1').fileinput({
			uploadUrl:'#',
			allowedFileExtension:['jpg','png','gif','jpeg'],
			overwriteInitial:false,
			maxFileSize:1000,
			maxFileNum:5,
		});
    });
	</script>
	
	<!-- the log message (check success) for normal post-->
	<?php if(@$_SESSION['Success_Photo_check']):?>
	<script type="text/javascript">
    	$(document).ready(function(){
        	 $('#post_detail_status').modal('show');
		});
    </script>
	<?php endif;?>
	<?php @$_SESSION['Success_Photo_check']=null;?>
	<!-- end the log message (check success) for normal post-->
	<!-- the log message (check success) for request post-->
	<?php if(@$_SESSION['Success_Photo_check_request']):?>
		<script type="text/javascript">
	    	$(document).ready(function(){
	        	 $('#request_post_detail_status').modal('show');
			});
	    </script>
		<?php endif;?>
		<?php @$_SESSION['Success_Photo_check_request']=null;?>
	<!-- end the log message (check success) for request post-->	

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


	<script type="text/javascript">
		$('#Request_post').click(function(){
    			// alert("Ahmed salem");
    			$('#Request_post1').modal('show');	
    	});
	</script>

</body>
</html>