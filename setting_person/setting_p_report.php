<?php 
include_once("../php_includes/connection_dp.php");
include_once('../functions/check_login.php');
?>
<html>
<head>
	<title>setting</title>
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
	<link rel="stylesheet" type="text/css" href="../css/setting.css">
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
	<?php
		if($_COOKIE['Account_type']=="person")
		{
			$user_id=$_COOKIE['user_id'];
			$query="SELECT 	first_name , last_name FROM users WHERE id='$user_id' LIMIT 1 ";
			$perform_query=mysqli_query($connect,$query);
			$result=mysqli_fetch_assoc($perform_query);
		}else{
			$message="<span style='color:#ff0000;'>* Conflict Occurs</span>";
 			$_SESSION['Message_login']=$message;
 			header("location: ../index.php");
		}
	?>
	<!-- /header section -->
	<!-- side bar menu and setting conatiner -->
	<div class="container setting" id="person_setting">
		<div class="col-xs-3 side">
			<div class="sidebar_menu">
				<ul class="list-unstyled option">
					<li><a href="setting_p.php">Edit Profile</a></li>
					<li><a href="setting_p_changepassword.php">Change Password</a></li>
					<li><a href="setting_p_add_photo.php">Update Your photo</a></li>
					<li><a href="setting_p_add_address.php">Update Your Address</a></li>
					<li><a href="setting_p_add_tel.php">Update Your Telephone</a></li>
					<li class="active"><a href="setting_p_report.php">Contact US</a></li>
					<li><a href="setting_p_conditions.php">Conditions 	&amp; Terms</a></li>
				</ul>
			</div>
		</div>
		<div class="col-xs-9">
			<?php
				// query to getting the image ...
				if($_COOKIE['Account_type']=="person")
				{
					$user_id=$_COOKIE['user_id'];
					$query_getImage_p="SELECT `first_name`,`last_name`,`photo` FROM `users` WHERE id= '$user_id' ";
					$perfom_query_iamge_p=mysqli_query($connect,$query_getImage_p);
					$result_image_p=mysqli_fetch_assoc($perfom_query_iamge_p);

				}
			?>
			<div class="sidebar_content">
				<div class="sidebar_content_header">
					<img class="img-responsive" style="display:inline;" 
					<?php if($_COOKIE['Account_type']=="person"){?>
						<?php if($_COOKIE['user_gender']=="m"):?>	
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
					<?php 
					}else {
						$message="Conflict Occurs";
						$_SESSION['Message_login']=$message;
						header("location: ../logout.php");
						}
					?>
					/>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<h4 class="text-center" style="display:inline;"> <b><?php echo $result['first_name'].' '.$result['last_name'];?></b> </h4>
				</div>
			
				<div class="person_setting">
					<h5 class="text-center hint">You Can Tag Persons or Foundations <a id="documentaion_fire"><span>learn more..</span></a></h5>
						<div class="contact_us">
							<form action="setting_p_report_query.php" method="POST" id="contact_us_setting">

							<textarea name="report" class="send_message" id="send_message_report" placeholder="Send Message To Admins  . . ." id="setting_contact_us" ></textarea>
							<div id="Tag_list" style="display:none;">
								<ul class="list-unstyled tag">
									<li><h4 class="text-center">TAG Persons You Want:</h4></li>
									<li>
										<img src="../images/profile_image/Capture1.PNG" title="Ahmed salem" />
										<span>Ahmed salem<span>
									</li>
									<li>
										<img src="../images/profile_image/Capture1.PNG" title="Ahmed salem" />
										<span>Ahmed salem<span>
									</li>
									<li>
										<img src="../images/profile_image/Capture1.PNG" title="Ahmed salem" />
										<span>Ahmed salem<span>
									</li>	
								<ul>
							</div>
						</div>
							<!--error message -->
		                 	<div class="error text-center" id="error_p_contactus"><span>*Error testing</span></div>
							<button class="btn-block message" name="send_report">Send Message</button>
								
					</form>
				</div>

			</div>
			
		</div>
	</div>





		<!-- pop up of logout model -->
	    <!-- Modal -->
		<div class="modal fade fading_opacity" id="documentation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <div class="modal-dialog mod_dio" role="document">
		    
		    <div class="modal-content mod_con">
		    	  	
		      
        	<div class="documentation_body">
        		<h4 class="text-center">TAG INSTUCTIONS</h4>
        		<p>
		        	TAG Persons or TAG Foundations Means that you can notify the Admins about these Accounts inside your report 
		        	<h6 class="header6">How TAG process can be done ...?</h6>
		        	<ol>
		        		<li>To TAG person write before his name @ sign </li>
		        		<li>To TAG foundation write before its name # sign </li>
		        	<ol/> 
		        </p>
        	</div>
      

		      <div class="modal-body mod_body cansel">
		        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
		        
		      </div>

		    </div>
		  </div>
		</div>

		<!-- the end of pop up of logout model -->



	<div class="footer_inc text-center">
                        Copyright &copy; 2017 <span>Together</span>.INC
    </div>

        <!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="Message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body mod_body">
	        <h4 class="text-center h4"><img 
	        	<?php if(@$_SESSION['Success_Report_check']=="true"):?>
	        		src="../images/icon/accept.png"
	        	<?php else:?>
	        		src="../images/icon/cancel.png"
	        	<?php endif;?>
	        	/><b style="color:#080"><?php echo @$_SESSION['message_p_send_report_profile'];?></b> </h4>
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
	<script type="text/javascript" src="../javascript/validation_update.js"></script>
	<script type="text/javascript" src="../javascript/notifications_another.js"></script>

	<?php if(@$_SESSION['Success_Report_check']):?>
	<script type="text/javascript">
    	$(document).ready(function(){
        	 $('#Message').modal('show');
		});
    </script>
	<?php endif;?>
	<?php @$_SESSION['Success_Report_check']=null;?>




	<script type="text/javascript">
		$(document).ready(function(){
			//alert("hello world");
			$("#documentaion_fire").click(function(){
				$('#documentation').modal('show');	
			});

			$("#send_message_report").on("keyup",function(){
				var msg=$("#send_message_report").val();
				
				var tagged_account;
				if(msg.indexOf(" @")!=-1)
				{
					var index=msg.indexOf(" @");
					var search_tag=msg.slice(index+2);
					//global array

					if(search_tag!='')
					{
						//get the username and the id from persons
						
						get_person_details_search_tag(search_tag);
						$("#Tag_list").css("display","block");
						
					}else
					{
						$("#Tag_list").css("display","none");
					}
					
				
				}else if(msg.indexOf(" #")!=-1)
				{
					var index=msg.indexOf(" #");
					var search_tag=msg.slice(index+2);
					//global array

					if(search_tag!='')
					{
						//get the username and the id from persons
						
						get_foundation_details_search_tag(search_tag);
						$("#Tag_list").css("display","block");
						
					}else
					{
						$("#Tag_list").css("display","none");
					}
				}


			});	
		});

		function get_person_details_search_tag(search)
		{
			// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        var search=search;
	        var url = "../tag_search/person_tag_search.php";
	        var vars = "search="+search;

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArraytag_search=return_data;

			 	console.log(jArraytag_search);

			    if(jArraytag_search!=null)
				{
					jArraytag_search=JSON.parse(jArraytag_search);	
					//console.log();	
					$("#Tag_list .tag").html('<li><h4 class=\"text-center\">TAG Persons You Want:</h4></li>');
					
					$.each( jArraytag_search, function( key, value ){

					//print search result into search box
					$("#Tag_list .tag").append("<li class=\"element_tag\"><img src=\"../"+value.image+"\" title=\""+value.name+"\" /><span>"+value.name+"</span><input type=\"hidden\" class=\"tagged_person_no\" value=\""+value.id+"\"/><input type=\"hidden\" class=\"tagged_person_name\" value=\""+value.name+"\"/></li>");	

					
					
					});

					$("#Tag_list .tag .element_tag").click(function(){
							//var tagged_person_no={account_id:""}
							
							var account_id =$(this).children(".tagged_person_no").val();
							var account_name =$(this).children(".tagged_person_name").val();
							

							var msg=$("#send_message_report").val();
							var index=msg.indexOf(" @");
							var search_tag=msg.slice(index+1);
							msg=msg.replace(search_tag," ! .."+account_id+".. "+account_name+'!');
							$("#send_message_report").val(msg);	
							$("#Tag_list").hide();
							$("#send_message_report").focus();		
					});


				}else{
					//some thing going wrong
					$("#Tag_list .tag").html("<li><h4 class=\"text-center\" style=\"color:#ff0000\">Something Going Wrong.</h4></li>");
				}



		    }else{
		    	// // no result for your search....
	            $("#Tag_list .tag").html("<li><h4 class=\"text-center\">TAG Persons You Want:</h4></li><li><h4 class=\"text-center\" style=\"color:#ff0000;\">No Result for your TAG</h4></li>");
	    	    }
	    
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request
	
		}

		function get_foundation_details_search_tag(search)
		{
			// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        var search=search;
	        var url = "../tag_search/foundation_tag_search.php";
	        var vars = "search="+search;

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArraytag_search=return_data;

			 	console.log(jArraytag_search);

			    if(jArraytag_search!=null)
				{
					jArraytag_search=JSON.parse(jArraytag_search);	
					//console.log();	
					$("#Tag_list .tag").html('<li><h4 class=\"text-center\">TAG Foundations You Want:</h4></li>');
					
					$.each( jArraytag_search, function( key, value ){

					//print search result into search box
					$("#Tag_list .tag").append("<li class=\"element_tag\"><img src=\"../"+value.image+"\" title=\""+value.name+"\" /><span>"+value.name+"</span><input type=\"hidden\" class=\"tagged_foundation_no\" value=\""+value.id+"\"/><input type=\"hidden\" class=\"tagged_foundation_name\" value=\""+value.name+"\"/></li>");	

					
					
					});

					$("#Tag_list .tag .element_tag").click(function(){
							//var tagged_person_no={account_id:""}
							
							var account_id =$(this).children(".tagged_foundation_no").val();
							var account_name =$(this).children(".tagged_foundation_name").val();
							var account_type="f";

							var msg=$("#send_message_report").val();
							var index=msg.indexOf(" #");
							var search_tag=msg.slice(index+1);
							msg=msg.replace(search_tag," ! ..."+account_id+"... "+account_name+"!");

							$("#send_message_report").val(msg);
							$("#send_message_report").focus();		
							$("#Tag_list").hide();
							//alert(msg.match(/a/g).length);
					});


				}else{
					//some thing going wrong
					$("#Tag_list .tag").html("<li><h4 class=\"text-center\" style=\"color:#ff0000\">Something Going Wrong.</h4></li>");
				}



		    }else{
		    	// // no result for your search....
	            $("#Tag_list .tag").html("<li><h4 class=\"text-center\">TAG Persons You Want:</h4></li><li><h4 class=\"text-center\" style=\"color:#ff0000;\">No Result for your TAG</h4></li>");
	    	    }
	    
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request
	
		}

	</script>	
	<script type="text/javascript">
		$("#Main_search").on("keyup",function(){
    		var search=$(this).val();
    		
		
				if(search=='')
	    		{
	    			$(".profile_header .search input[type=text]").css("width","80%");
	    			$("#search_result_box").hide(800);
	    			$("#search_option_box").show(800);
	    			$( "#person_setting" ).animate({
					    marginTop: '50px'
					  }, 1000, function() {
					    // Animation complete.
				  	});
	    		}else
	    		{
	    			Normal_search(search);
	    			$(".profile_header .search input[type=text]").css("width","100%");
					$("#search_result_box").show(800);	
	    			$("#search_option_box").hide(800);
	    			$( "#person_setting" ).animate({
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