<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");
	if(isset($_POST['user_id']))
	{
		$query_number_of_posts="SELECT * FROM `normal_posts`";
		$perform_query_number_of_posts=mysqli_query($connect,$query_number_of_posts);
		
		$number_of_normal_posts=mysqli_num_rows($perform_query_number_of_posts);
		
		echo "<input type=\"hidden\" value=\"$number_of_normal_posts\" id=\"number_of_normal_posts\"/>";

		//normal posts from persons
		$usero_id=$_POST['user_id'];
		$Acc_type='p';
		$query_normal_posts="SELECT `id`, `account_id`, `caption`, `date` FROM `normal_posts` WHERE `account_id`='$usero_id' AND `account_type`='$Acc_type' ORDER BY id DESC LIMIT 5";
		$perform_normal_query=mysqli_query($connect,$query_normal_posts);

		while($row=mysqli_fetch_assoc($perform_normal_query))
		{
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
					$image="users/$user_id/$user_photo";
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
						<img class=\"img-responsive\" src=\"../{$image}\" />
						<a href=\"../posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=p\"> <h5> $username &nbsp;(MY Profile)  </h5></a>
						<span><b>$date_ago</b></span>
						<div class=\"clear\"></div>
					</div>
					<!-- image of the post -->
					<div class=\"post_image\">
					";
					if($number_of_image==0)
					{
						echo 
						"
						<div class=\"caption\">
							<p><h4 style=\"text-indent:20px;background-color:#fff;padding:10px;\" >$caption</h4></p>
						</div>";

					}
					if($number_of_image==1)
					{
						$result_N_P_P=mysqli_fetch_assoc($perform_normal_posts_images);

						echo 
						"
						<div class=\"main-photo\">
							<img class=\"img-responsive\" src=\"../postingattachment/user/$user_id/$post_id/{$result_N_P_P['images']}\" />
						</div>
						";
						
				
					}
					else if($number_of_image==2)
					{
						//$photo_N_P_P_2=$result_N_P_P[1];
						while($result_N_P_P=mysqli_fetch_assoc($perform_normal_posts_images))
						{
							$count=0;
							if($count==0)
							{
								echo 
								"
									<div class=\"main-photo\">
										<img class=\"img-responsive\" src=\"../postingattachment/user/$user_id/$post_id/{$result_N_P_P['images']}\" />
									</div>
								";
							}else if($count==1)
							{
								echo 
								"
								<div class=\"rest_photos\">
									<div class=\"R_photo\">
										<img class=\"img-responsive\" src=\"../postingattachment/user/$user_id/$post_id/{$result_N_P_P['images']}\" />
										<a href=\"../posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=p\" > <span class=\"number_rest_images\">+2<span> </a>
									</div>
									
								</div>";	
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
									echo 
									"
										<div class=\"main-photo\">
											<img class=\"img-responsive\" src=\"../postingattachment/user/$user_id/$post_id/{$result_photo[0]}\" />
										</div>
									";
								}else
								{	$rest_images_no=$number_of_image-2;
									echo 
									"
									<div class=\"rest_photos\">
										<div class=\"R_photo\">
											<img class=\"img-responsive\" src=\"../postingattachment/user/$user_id/$post_id/{$result_photo[1]}\" />
											<a href=\"../posting_person/display_normal_post.php?post_no={$post_id}&&account_id={$user_id}&&account_type=p\" > <span class=\"number_rest_images\">+{$rest_images_no}<span> </a>
										</div>
										
									</div>";	

								}
									
											
							}	
					}
					if($number_of_image!=0)
					{
						echo 
						"
						<div class=\"caption\">
							<p><h4 style=\"text-indent:20px;background-color:#fff;padding:10px;\" >$caption</h4></p>
						</div>";	
					}


					
					echo "	
					</div>
					<!-- things related with the post -->
					<div class=\"related_contents\">
						";
					$query_person_likes_number="SELECT `id` FROM `likes_normal_post` WHERE `post_id` = '$post_id'  ";
					@$perform_query_person_likes_number=mysqli_query($connect,$query_person_likes_number);
					@$liked_p_number=mysqli_num_rows($perform_query_person_likes_number);
					$query_person_comments_number="SELECT `id` FROM `comments_normal_post` WHERE `post_id` = '$post_id'  ";
					@$perform_query_person_comments_number=mysqli_query($connect,$query_person_comments_number);
					@$comments_p_number=mysqli_num_rows($perform_query_person_comments_number);
					if($perform_query_person_likes_number&&$perform_query_person_comments_number)
						{
							echo "	
								<div class=\"likes\">
									<span><b id=\"likes{$post_id}\" >{$liked_p_number}</b></span><span>&nbsp;&nbsp;<a href=\"#\" class=\"liked_pop_up\" >likes</a></span>
									&nbsp;&nbsp;&nbsp;<span><b id=\"comments{$post_id}\">{$comments_p_number}</b></span><span>&nbsp;&nbsp;<a href=\"#\" class=\"comments_pop_up\">Comments</a></span>
									<input type=\"hidden\" class=\"post_id_get_likes\" value=\"$post_id\" />
								</div>
								";

						}
					else{
							echo "	
								<div class=\"likes\">
									<span><b>0</b></span><span>&nbsp;&nbsp;likes</span>
									&nbsp;&nbsp;&nbsp;<span><b>{$comments_p_number}</b></span><span>&nbsp;&nbsp;<a href=\"#\">Comments</a></span>
								</div>
								";
					}
											
					echo "</div>";
				
		}
	}
		
		

			

			
?>

	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity" id="comment_normal_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio" role="document">
	    
	    <div class="modal-content mod_con">
	    	  	
	      <div class="modal-body_setting mod_body_setting_suggested">
	        <h4 class="text-center h4">people and foundation that Comments this post</h4>
	        <div class="option_suggest" style="width:100%;">
	        	
	        	<ul class="list-unstyled list_comments_accounts">
	        	
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


	<!-- pop up of logout model -->
    

<script type="text/javascript">
//get likes person's post
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
		

		var url = "../posting_person/get_likes_profile_original.php";
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
					}else
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


//get comment person's post
$(".comments_pop_up").click(function(){
	var post_id=$(this).parent().siblings(".post_id_get_likes").val();
	// alert(post_id);
	get_number_of_comments_profile(post_id);
	$('#comment_normal_post').modal('show');	
});

function get_number_of_comments_profile(post_id)
	{
		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
		//get account_id,post_id,accout_type
		var like_post_id=post_id;
		

		var url = "../posting_person/get_comments_normal_post_profile_original.php";
        var vars = "get_like_post_id="+like_post_id;
	
        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		 hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				var jArraygetcomment=return_data;

				console.log(jArraygetcomment);
				$(".option_suggest .list_comments_accounts ").html("<h4 class='text-center' style=\"color:#333;\">There's no one Comment on this post.</h4>");
				if(jArraygetcomment!=null)
				{
					jArraygetcomment=JSON.parse(jArraygetcomment);	
					//console.log(jArraygetcomment);
					$(".option_suggest .list_comments_accounts ").html('');
					$.each( jArraygetcomment, function( key, value ){

					if(value.account_type=='p')
					{
						//person
						$(".option_suggest .list_comments_accounts ").append("<li><img src=\"../"+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?user_id="+value.account_id+"&acc_type=p&gend="+value.gender+"\">"+value.name+"</a>&nbsp;&nbsp;<span>"+value.date+"</sapn><br/><br/><p>"+value.comment+"</p></li>");
					}else
					{
						//foundation
						$(".option_suggest .list_comments_accounts ").append("<li><img src=\"../"+value.image+"\" title=\""+value.name+"\"/> <a href=\"profile/profile.php?f_id="+value.account_id+"&acc_type=f\">"+value.name+"</a>&nbsp;&nbsp;<span>"+value.date+"</sapn><br/><br/><p>"+value.comment+"</p></li>");
					}

					});
				}	
			
			}
		}
		// Send the data to PHP now... and wait for response to update the status div
	    hr.send(vars); // Actually execute the request
		
	}


</script>