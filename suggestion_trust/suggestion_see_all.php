<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
?>
<html>
<head>
	<title>Sugestion</title>
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
					<img class="img-responsive" src="../images/logo/Capture.PNG" />
				</div>
			</div>
			<div class="col-md-4 col-sm-4 hidden-xs">
				<div class="search">
					<input type="text" id="Main_search" name="search" placeholder="Search @person or @Institution⁯..">
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
							<li class="dropdown-toggle notification" data-toggle="dropdown"><a href="messaging/messaging.php"><i class="fa fa-envelope-o fa-2x"  aria-hidden="true"></i><span class="num_notification" id="message">0</span></a></li>
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
	<!-- post section -->
	<div class="container post_area" id="suggestion_container">
		


		<!-- suggestions  person -->
		<div class="container suggestions_seeAll">
			<ul class="list-unstyled people_suggestions_seeAll">
				<li class="suggestion_header_seeAll">
					<b>Suggestions For You 
						<?php if(@$_GET['acc_type']=='p'):?>
						(Perons)
					<?php elseif(@$_GET['acc_type']=='f'):?>
						(Foundation)
					<?php endif;?>
					</b>
					<!-- <span><a href="#"><b>See All&nbsp; > </b></a></span>
					<span id="Setting_link_seeAll"><b>Setting &nbsp;</b></span> -->
				</li>

				<?php
					if(@$_GET['acc_type']=='p')
					{
						$query_get_person="SELECT `id`, `first_name`, `last_name`, `photo`, `gender` FROM `users` LIMIT 20";
						$perform_query_get_person=mysqli_query($connect,$query_get_person);
						while($result_person=mysqli_fetch_assoc($perform_query_get_person))
						{
							

							$person_name=$result_person['first_name'].' '.$result_person['last_name'];

							if($result_person['photo']==null)
							{
								if($result_person['gender']=='m')
								{	
									$image="../images/profile_image/default-person.jpg";
								}else{
									$image="../images/profile_image/user_profile_female.jpg";
								}

							}else{
								$user_id=$result_person['id'];
								$image="../users/".$user_id."/".$result_person['photo'];
							}


							echo 
								"
								<li class=\"suggestion_element_seeAll\">
									<img class=\"img-responsive\" src=\"$image\" />
									<h5>$person_name</h5>
									<a href=\"../profile/profile.php?user_id=".$result_person['id']."&acc_type=p&gend=".$result_person['gender']."\" class=\"see_profile\">SEE PROFILE</a>
								</li>
								";

						}
					}elseif(@$_GET['acc_type']=='f')
					{
						$query_get_foundation="SELECT `id`, `name`, `photo` FROM `foundations` LIMIT 20";
						$perform_query_get_foundation=mysqli_query($connect,$query_get_foundation);
						while($result_foundation=mysqli_fetch_assoc($perform_query_get_foundation))
						{
							

							$foundation_name=$result_foundation['name'];

							if($result_foundation['photo']==null)
							{
								$image_f="../images/profile_image/default-academy.jpg";

							}else{
								$foundation_id=$result_foundation['id'];
								$image_f="../foundations/".$foundation_id."/".$result_foundation['photo'];
							}

							echo 
								"
								<li class=\"suggestion_element_seeAll\">
									<img class=\"img-responsive\" src=\"$image_f\" />
									<h5>$foundation_name</h5>
									<a href=\"../profile/profile.php?f_id=".$result_foundation['id']."&acc_type=f\" class=\"see_profile\">SEE PROFILE</a>
								</li>
								";

						}
					}else
					{
						echo "<h4 class=\"text-center\">Nothing To Show....</h4>";
					}
					
				?><!-- 
				<li class="suggestion_element_seeAll">
					<img class="img-responsive" src="../images/profile_image/1443263206253.jpg" />
					<h5>< user name ></h5>
					<button class="">Trust</button>
				</li> -->

				<li class="suggestion_element_seeAll">
					<h4 class="text-center"><a href="#"><b>TOGETHER INC</b></a></h4>
				</li>

			</ul>
		</div>

		</div>	
	<div class="footer_inc text-center">
                        Copyright &copy; 2016 <span>Elbayady</span>.INC
   	</div>

    <!--suggestion for see all-->
    <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="Setting_seeAll" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	        <h4 class="text-center h4">Setting For Suggestion..</h4>
	        <div class="option_suggest">
	        	<form method="POST">
		        	<label>Blue Mark</label>
		        	<input type="radio" name="Suggestion" value="blueMark"/>
		        	<br/><br/>
		        	<label>Information Completion</label>
		        	<input type="radio" name="Suggestion" value="InfoCompletion"/>
		        	<br/><br/>	
		        	<label>Country</label>
		        	<input type="radio" name="Suggestion" value="Country" />
		        	<br/><br/>	
		        	<label>All</label>
		        	<input type="radio" name="Suggestion" value="All" CHECKED/>
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

	<script type="text/javascript" src="../javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
	<script type="text/javascript" src="../javascript/index.js"></script>
	<script type="text/javascript" src="../javascript/notifications_another.js"></script>
	<script type="text/javascript">
    	$(document).ready(function(){
    		$('#Setting_link_seeAll').click(function(){
    			$('#Setting_seeAll').modal('show');	
    		});
		});
    </script>

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