<?php
	include_once("../php_includes/connection_dp.php");
	include_once('../functions/check_login.php');
?>
<html>
<head>
	<title>Request Post</title>
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
	<link rel="stylesheet" type="text/css" href="../css/request_post.css">
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
					<input type="text" id="Main_search" name="search" placeholder="Search @person or @Inistitution..">
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
	
	<!-- start updating the seen request for notification -->
	<?php 
		if($_COOKIE['Account_type']=='person')
		{
			$account_id_request=$_COOKIE['user_id'];
			$account_type_request='p';
		}else if ($_COOKIE['Account_type']=='foundation')
		{
			$account_id_request=$_COOKIE['foundation_id'];
			$account_type_request='f';
		}

		if(isset($_GET['noti']))
		{
			if(@$_GET['noti']=='noti_request')
			{
				
				$requets_num=@$_GET['requets_num'];
				$query_update_request_noti="INSERT INTO `request_post_noti_seen` (`request_id`, `account_id`, `account_type`) VALUES ('$requets_num','$account_id_request','$account_type_request')";
				$perform_query_update_request_noti=mysqli_query($connect,$query_update_request_noti);
			}
		}
	?>
	<!-- end updating the seen request for notification -->
	
	<!-- profile container -->
	<div class="container request_post">
		
		
		<div class="result_container">
			<?php
					$request_id=$_GET['requets_num'];
					//query to get the image for the request
					$query_request_post_img="SELECT  `child_name`,`account_id`,`account_type`, request_post.id as id ,`image` FROM `request_post_images` INNER JOIN `request_post` ON request_post.id=request_post_images.request_id  WHERE request_id='$request_id' LIMIT 1";
					$perform_query_request_post_img=mysqli_query($connect,$query_request_post_img);
					
					while($result_image=mysqli_fetch_assoc($perform_query_request_post_img))
					{
						$child_name=$result_image['child_name'];
						$request_image=$result_image['image'];
						$request_post_id=$result_image['id'];
						$account_id=$result_image['account_id'];
						$account_type=$result_image['account_type'];

						if($account_type=='p')
						{
							//for person
							echo 
							"
							<div class=\"result_images\">
								<div class=\"result_item\">
									<img  src=\"../request_post_attachment/user/{$account_id}/{$request_post_id}/{$request_image}\" title=\"{$child_name}\"/>
								</div>		
							</div>	
							";	
						}
						else if($account_type=='f')
						{

							//for foundatin 
							echo 
							"
							<div class=\"result_images\">
								<div class=\"result_item\">
									<img  src=\"../request_post_attachment/foundation/{$account_id}/{$request_post_id}/{$request_image}\" title=\"{$child_name}\"/>
								</div>	
							</div>		
							";
						}
					
					}
					

				?>

			

			<!-- <div class="result_images">
				<div class="result_item">
					<img  src="../images/profile_image/1443263206253.jpg" title="Ahmed salem"/>
				</div>
			</div> -->

		</div>

		<div class="clear"></div>
		<hr/>
		<h4 class="text-center">Child Information</h4>
		

		<table class="table table-bordered table-striped">
			<colgroup>
				<col class="col-xs-1">
				<col class="col-xs-7">
			</colgroup>
			<tbody>
			<?php
				$request_id=$_GET['requets_num'];
				$query_request_post="SELECT `id`, `account_id`, `account_type`, `child_name`, `age`, `tall`, `skin_color`, `country`, `hair_color`, `lastSeen`, `description_lost_found`, `eye_color`, `description_contact`, `description_relation_with_child`, `description_child_status`, `request_type`, `date` FROM `request_post` WHERE `id`='$request_id' LIMIT 1";
				$perform_query_request_post=mysqli_query($connect,$query_request_post);
				$result=mysqli_fetch_assoc($perform_query_request_post);
				
				echo
				"
					<tr>
						<td>Name</td>
						<td>".$result['child_name']."</td>
					</tr>
				";
				echo
				"
					<tr>
						<td>Age</td>
						<td>".$result['age']."</td>
					</tr>
				";
				echo
				"
					<tr>
						<td>Tall</td>
						<td>".$result['tall']."</td>
					</tr>
				";
				echo
				"
					<tr>
						<td>Skin Color</td>
						<td>".$result['skin_color']."</td>
					</tr>
				";

				echo
				"
					<tr>
						<td>Country</td>
						<td>".$result['country']."</td>
					</tr>
				";
				echo
				"
					<tr>
						<td>Hair Color</td>
						<td>".$result['hair_color']."</td>
					</tr>
				";

				echo
				"
					<tr>
						<td>Last Seen</td>
						<td>".$result['lastSeen']."</td>
					</tr>
				";

				echo
				"
					<tr>
						<td>Eye Color</td>
						<td>".$result['eye_color']."</td>
					</tr>
				";

				echo
				"
					<tr>
						<td>Child Story</td>
						<td>".$result['description_lost_found']."</td>
					</tr>
				";

				echo
				"
					<tr>
						<td>Contact Way</td>
						<td>".$result['description_contact']."</td>
					</tr>
				";
				if($result['account_type']=='p')
				{
					$account_id=$result['account_id'];
					$query_get_account_info="SELECT `id`, `first_name`, `last_name`, `gender` FROM `users` WHERE id='$account_id' LIMIT 1";
					$perform_query_get_account_info=mysqli_query($connect,$query_get_account_info);
					$result_get_account_info=mysqli_fetch_assoc($perform_query_get_account_info);


					
					echo
					"
						<tr>
							<td>Request Owner</td>
							<td><a href=\"../profile/profile.php?user_id=".$result_get_account_info['id']."&acc_type=p&gend=".$result_get_account_info['gender']." \">".$result_get_account_info['first_name'].' '.$result_get_account_info['last_name']."</a></td>
						</tr>
					";

				}else if($result['account_type']=='f')
				{

					$account_id=$result['account_id'];
					$query_get_account_info="SELECT `id`, `name`  FROM `foundations` WHERE id='$account_id' LIMIT 1";
					$perform_query_get_account_info=mysqli_query($connect,$query_get_account_info);
					$result_get_account_info=mysqli_fetch_assoc($perform_query_get_account_info);


					
					echo
					"
						<tr>
							<td>Request Owner</td>
							<td><a href=\"../profile/profile.php?f_id=".$result_get_account_info['id']."&acc_type=f \">".$result_get_account_info['name']."</a></td>
						</tr>
					";

				}
				
				echo
				"
					<tr>
						<td>relation</td>
						<td>".$result['description_relation_with_child']."</td>
					</tr>
				";
				echo
				"
					<tr>
						<td>Status</td>
						<td>".$result['description_child_status']."</td>
					</tr>
				";
				echo
				"
					<tr>
						<td>Request Post Date</td>
						<td>".$result['date']."</td>
					</tr>
				";

			?>

				

			</tbody>
		</table>

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
	<!-- request post and filter -->
	<script type="text/javascript" src="../javascript/all_request_posts.js"></script>
	<script type="text/javascript" src="../javascript/notifications_another.js"></script>
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
	    			$( ".request_post" ).animate({
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
	    			$( ".request_post" ).animate({
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