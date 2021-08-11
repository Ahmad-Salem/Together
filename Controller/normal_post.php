<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
?>
<html>
<head>
	<title>Admin panel</title>
	
	<!-- tab icon -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
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

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0 , user-scalable=0"/>


</head>
<body>
	<!-- start header-->
	<div class="header">
		<div class="logo">
			<a href="#"> Together <span>Panel</span></a>
		</div>
		<div class="options">
			<ul class="list-unstyled">
				<li><a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i></a></li>
				<li><a href="#" id="logout_btn"><span class="logout">...</span></a></li>
			</ul>
		</div>
	</div>
	<!-- end header-->
	<!-- start container -->
	<a class="mobile" href="#">
		<i class="fa fa-list" aria-hidden="true"></i>
	</a>

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

	<div class="containers">
		<div class="sidebar">
			<div class="admin_picture">
				<?php if($_COOKIE['Account_type']=="person"):?>
					<?php if($_COOKIE['user_gender']='m'):?>
						
						<?php if($result_image_p['photo']!=null):?>
							<img src="../users/<?php echo $user_id.'/'.$result_image_p['photo'];?>" title="<?php echo $result_image_p['first_name'].' '.$result_image_p['last_name']; ?>"/>
							<p><?php echo $result_image_p['first_name'].' '.$result_image_p['last_name']; ?></p>
						<?php else:?>	
							<img src="../images/profile_image/default-person.jpg" title="<?php echo $result_image_p['first_name'].' '.$result_image_p['last_name']; ?>"/>
							<p><?php echo $result_image_p['first_name'].' '.$result_image_p['last_name']; ?></p>
						<?php endif;?>
						<?php endif;?>	
				<?php else:?>
					
					<?php if($result_image_f['photo']!=null):?>
						<img src="../foundations/<?php echo $foundation_id.'/'.$result_image_f['photo'];?>" title="<?php echo $result_image_f['name']; ?>"/>
						<p><?php echo $result_image_f['name']; ?></p>
					<?php else:?>
						<img src="../images/profile_image/default-academy.jpg" title="<?php echo $result_image_f['name']; ?>"/>
						<p><?php echo $result_image_f['name']; ?></p>
					<?php endif;?>

				<?php endif;?>	
				<h4 class="text-center"><i class="fa fa-check-square-o" aria-hidden="true"></i></h4>
			</div>
			<ul class="navbar">
				<li><a href="index.php"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;&nbsp; Together DashBord</a></li>
				<li><a href="manage_persons.php"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Manage Persons</a></li>
				<li><a href="manage_foundations.php"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;&nbsp;Manage Institution</a></li>
				<li><a class="selected" href="normal_post.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Manage Posts</a></li>
				<li><a href="announcement.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Manage Announcement</a></li>
				<li><a href="contact_us.php"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Manage Contact Us</a></li>
			</ul>
		</div>
		<div class="content">
			<h1>Together Dashbord</h1>
			<p>Together Control Panel.</p>
			
			<div class="box">
				<div class="box-top">
					<h4 class="text-center">MANAGE NORMAL POSTS &nbsp;&nbsp;(<i class="fa fa-male" aria-hidden="true"></i>)</h4>
				</div>
				<div class="filter">
					<input type="text" name="search" id="search_normal_post_person" placeholder="Search By Post Owner ...">
				</div>	
			</div>

			<table class="table table-bordered statistic_tbl" id="statistic_tbl_post_owner_person">
			  <tr class="active">
			  	<td><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Caption</td>
			  	<td><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Post Owner</td>
			  	<td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;Date</td>
			  	<td><i class="fa fa-street-view" aria-hidden="true"></i>&nbsp;&nbsp;Action</td>
			  	<td><i class="fa fa-info" aria-hidden="true"></i>&nbsp;&nbsp;Others</td>
			  </tr>
			  
			  	<?php
			  		$query_normal_post="SELECT `id`, `account_id`, `account_type`, `caption`, `date` FROM `normal_posts` LIMIT 8";
			  		$perform_query_normal_post=mysqli_query($connect,$query_normal_post);
			  		while($result_normal_post=mysqli_fetch_assoc($perform_query_normal_post))
			  		{

			  			$account_id=$result_normal_post['account_id'];
			  			$account_type=$result_normal_post['account_type'];
			  			if($account_type=='p')
			  			{
			  				$query_name="SELECT  `first_name`, `last_name` FROM `users` WHERE `id`='$account_id' LIMIT 1";
				  			$perform_query_name=mysqli_query($connect,$query_name);
				  			$result_name=mysqli_fetch_assoc($perform_query_name);	
				  			$account_name=$result_name['first_name'].' '.$result_name['last_name'];
			  			}else if($account_type=='f')
			  			{
			  				$query_name="SELECT  `name` FROM `foundations` WHERE `id`='$account_id' LIMIT 1";
				  			$perform_query_name=mysqli_query($connect,$query_name);
				  			$result_name=mysqli_fetch_assoc($perform_query_name);	
			  				$account_name=$result_name['name'];
			  			}
			  			
			  			echo "<tr>";
			  			//<!-- caption -->
					  	echo "<td>";if($result_normal_post['caption']!=''){echo $result_normal_post['caption'];}else{echo "No Caption";} echo "</td>";
					  	//<!-- Post Owner -->
					  	echo "<td>".$account_name."(".$account_type.")</td>";
					  	//<!-- date -->
					  	echo "<td>".$result_normal_post['date']."</td>";
					  	//<!-- More Details -->
					  	echo "<td>
					  			<button type=\"button\" class=\"btn btn-danger btn-block delete_person\">DELETE POST</button>
					  			<input type=\"hidden\" class=\"post_id\" value=\"".$result_normal_post['id']."\"/>
					  			<input type=\"hidden\" class=\"account_id\" value=\"".$result_normal_post['account_id']."\"/>
					  			<input type=\"hidden\" class=\"account_type\" value=\"".$result_normal_post['account_type']."\"/>
					  		</td>";
					  	//<!-- More Details -->
					  	echo "<td><a href=\"../posting_person/display_all_priv_normal_post.php?post_no=".$result_normal_post['id']."&&account_id=".$result_normal_post['account_id']."&&account_type=".$account_type."\">More Details</a></td>";
					  		
					  	echo "</tr>";
			  		}
			  	?>
			  	
			</table>
			
		</div>
	</div>
	<!-- end container -->


	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity_panel" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio_panel" role="document">
	    
	    <div class="modal-content mod_con_panel">
	    	  	
	      <div class="modal-body mod_body_panel">
	        <h4 class="text-center h5"><a href="../logout_panel.php" class="logout_panel">Log Out</a></h4>
	      </div>

	      <div class="modal-body mod_body_panel cansel_panel">
	        <h4 class="text-center h5" data-dismiss="modal">Cancel</h4>
	        
	      </div>

	    </div>
	  </div>
	</div>


	<script type="text/javascript" src="../javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
	<script type="text/javascript" src="javascript/index.js"></script>
	<script type="text/javascript">
		$('#logout_btn').click(function(){
    			$('#logout').modal('show');	
    	});
    	
    	$('.delete_person').click(function(){
    		$(this).parent().parent().hide();
    		var post_id = $(this).siblings('.post_id').val();
    		var account_id = $(this).siblings('.account_id').val();
    		var account_type = $(this).siblings('.account_type').val();
    		
    		delete_person_normal_post(post_id,account_id,account_type);
    	});

    	function delete_person_normal_post(post_id,account_id,account_type)
    	{
    		// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        var post_id=post_id;
	        var account_id=account_id;
	        var account_type=account_type;
	        var url = "delete_normal_post.php";
	        var vars = "post_id="+post_id+"&account_id="+account_id+"&account_type="+account_type;

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			 	
	        }else
	        {
	        	// alert("i'm not work");
	        }
	   		 };
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request

    	
    	}

    	
    	$("#search_normal_post_person").on("keyup",function(){
    		var search=$(this).val();
    		// alert(search);	
    		get_post_owner_search(search);
    	});

    	function get_post_owner_search(search)
    	{
    		// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        var search=search;
	        var url = "get_post_owner_search.php";
	        var vars = "search="+search;

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArraygetpersonpostowner_search=return_data;

			 	// console.log(jArraygetpersonpostowner_search);
			    if(jArraygetpersonpostowner_search!=null)
				{
					jArraygetpersonpostowner_search=JSON.parse(jArraygetpersonpostowner_search);	
					//console.log(jArraygetpersonpostowner_search);	
					$("#statistic_tbl_post_owner_person").html('');
					$("#statistic_tbl_post_owner_person").html("<tr class=\"active\"><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Caption</td><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Post Owner</td><td><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Date</td><td><i class=\"fa fa-street-view\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Action</td><td><i class=\"fa fa-info\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Others</td></tr>");
					var caption='';
					$.each( jArraygetpersonpostowner_search, function( key, value ){

						
						
						//person&&foundation
						
						$("#statistic_tbl_post_owner_person").append("<tr><td>"+value.post_caption+"</td><td>"+value.account_name+" ("+value.post_account_type+")</td><td>"+value.post_date+"</td><td><button type=\"button\" class=\"btn btn-danger btn-block delete_person\">DELETE POST</button><input type=\"hidden\" class=\"post_id\" value=\""+value.post_id+"\"/><input type=\"hidden\" class=\"account_id\" value=\""+value.post_account_id+"\"/><input type=\"hidden\" class=\"account_type\" value=\""+value.post_account_type+"\"/></td><td><a href=\"../posting_person/display_all_priv_normal_post.php?post_no="+value.post_id+"&&account_id="+value.post_account_id+"&&account_type="+value.post_account_type+"\">More Details</a></td></tr>");					

					});


					$('.delete_person').click(function(){
			    		$(this).parent().parent().hide();
			    		var post_id = $(this).siblings('.post_id').val();
			    		var account_id = $(this).siblings('.account_id').val();
			    		var account_type = $(this).siblings('.account_type').val();
			    		
			    		delete_person_normal_post(post_id,account_id,account_type);
			    	});


				}else{
					
					$("#statistic_tbl_post_owner_person").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
				}



		    }else{
	            $("#statistic_tbl_post_owner_person").html("<tr class=\"active\"><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Caption</td><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Post Owner</td><td><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Date</td><td><i class=\"fa fa-street-view\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Action</td><td><i class=\"fa fa-info\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Others</td></tr>");
	            $("#statistic_tbl_post_owner_person").append("<tr><td colspan='5'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr>");
	         }

	        };
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request

    	}

	</script>
</body>
</html>
