<?php 
include_once('../functions/check_login.php');
include_once("../php_includes/connection_dp.php");
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
			$message="<span style='color:#ff0000;'>Conflict Ocurrs</span>";
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
        if($_COOKIE['Account_type']=="foundation")
        {
            $foundation_id=$_COOKIE['foundation_id'];
            $query="SELECT  name FROM foundations WHERE id='$foundation_id' LIMIT 1 ";
            $perform_query=mysqli_query($connect,$query);
            $result=mysqli_fetch_assoc($perform_query);
        }else{
            $message="<div class=\"Error_login\"><span class=\"mainerror\">A Conflict Occurs</span></div>";
            $_SESSION['Message_login']=$message;
            header("location: ../index.php");
        }
    ?>

	<!-- /header section -->
	<!-- side bar menu and setting conatiner -->
	<div class="container setting" id="foundation_setting">
		<div class="col-xs-3 side">
			<div class="sidebar_menu">
				<ul class="list-unstyled option">
					<li><a href="setting_f.php">Edit  Profile</a></li>
					<li><a href="setting_f_change_password.php">Change Password</a></li>
					<li class="active"><a href="setting_f_update_photo.php">Update  photo</a></li>
					<li><a href="setting_f_update_address.php">Update  Address</a></li>
					<li><a href="setting_f_update_telephone.php">Update  Telephone</a></li>
					<li><a href="setting_f_update_fax.php">Update  Fax</a></li>
					<li><a href="setting_f_update_site_link.php">Update  Site</a></li>
					<li><a href="setting_f_report.php">Contact Us</a></li>
					<li><a href="setting_f_conditions.php">Conditions 	&amp; Terms</a></li>
				</ul>
			</div>
		</div>

		<div class="col-xs-9">
		
			<?php
				$foundation_id=$_COOKIE['foundation_id'];
				$query_getImage_f="SELECT `name`,`photo` FROM `foundations` WHERE id= '$foundation_id' ";
				$perfom_query_iamge_f=mysqli_query($connect,$query_getImage_f);
				$result_image_f=mysqli_fetch_assoc($perfom_query_iamge_f);
			?>	
			<div class="sidebar_content">
				
				<div class="sidebar_content_header">
					<img class="img-responsive" style="display:inline;" 

					<?php if($_COOKIE['Account_type']=="foundation"){?>

						<?php if($result_image_f['photo']!=null):?>
						src="../foundations/<?php echo $foundation_id.'/'.$result_image_f['photo'];?>"
						<?php else:?>
						src="../images/profile_image/default-academy.jpg" 
						<?php endif;?>
                        
                    
                    <?php 
                    }else {
                        $message="Conflict Occurs";
                        @$_SESSION['Message_login']=$message;
                        header("location: ../logout.php");
                        }
                    ?>
                     />
					
					&nbsp;&nbsp;&nbsp;&nbsp;
					<h4 class="text-center" style="display:inline;"> <b><?php echo $result['name'];?></b> </h4>
				</div>
			
				<div class="foundation_setting">
					
					<form action="setting_f_update_photo_query.php" method="POST" id="photo_foundation" enctype="multipart/form-data">
						<!--error message -->
			            <div class="error text-center" id="error_f_update_ph"><span>*Error testing</span></div>
						
						<div class="upload_photo_container_foundation">
							
							<div class="file-input wrapper photo_btn">

							<input id="update_photo_foundation" type="file" name="image_foundation"  class="file-input control" />
							
							<div class="file-input content">
								<div class="upload_image_box_p">
									<h4 class="text-center"> Upload Your Photo </h4>
								</div>
							</div>	
							
							</div>
							<button class="btn-block photo_btn_p">Update Photo</button>
						</div>	
					</form>
				</div>

			</div>
			
		</div>
	</div>







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
	        	<?php if(@$_SESSION['Success_Photo_check_f']=="true"):?>
	        		src="../images/icon/accept.png"
	        	<?php else:?>
	        		src="../images/icon/cancel.png"
	        	<?php endif;?>
	        	/><b 
	        	<?php if(@$_SESSION['Success_Photo_check_f']=="true"):?>
	        		style="color:#080"
	        	<?php else:?>
	        		style="color:#ff0000"
	        	<?php endif;?>
	        	
	        	><?php echo @$_SESSION['message_f_add_photo'];?></b> </h4>
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
    <script type="text/javascript" src="../javascript/validation_update_foundation.js"></script>
    <script type="text/javascript" src="../javascript/notifications_another.js"></script>
    
    <?php if(@$_SESSION['Success_Photo_check_f']):?>
	<script type="text/javascript">
    	$(document).ready(function(){
        	 $('#Message').modal('show');
		});
    </script>
	<?php endif;?>
	<?php @$_SESSION['Success_Photo_check_f']=null;?>



		<script type="text/javascript">
        $("#Main_search").on("keyup",function(){
            var search=$(this).val();
            
        
                if(search=='')
                {
                    $(".profile_header .search input[type=text]").css("width","80%");
                    $("#search_result_box").hide(800);
                    $("#search_option_box").show(800);
                    $( "#foundation_setting" ).animate({
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
                    $( "#foundation_setting" ).animate({
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