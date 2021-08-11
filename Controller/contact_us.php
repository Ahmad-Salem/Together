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
				<li><a href="normal_post.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Manage Posts</a></li>
				<li><a href="announcement.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Manage Announcement</a></li>
				<li><a class="selected" href="contact_us.php"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Manage Contact Us</a></li>
			</ul>
		</div>
		<div class="content">
			<h1>Together Dashbord</h1>
			<p>Together Control Panel.</p>
			<div class="box">
				<div class="box-top">
					<h4 class="text-center">MANAGE CONTACTUS &nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></h4>
				</div>
				<div class="filter">
					<input type="text" name="search" id="search_message" placeholder="Search By Message Owner ...">
				</div>	
			</div>

			<table class="table table-bordered statistic_tbl" id="statistic_tbl">
			  <tr class="active">
			  	<td><i class="fa fa-edit" aria-hidden="true"></i> Message Owner</td>
			  	<td><i class="fa fa-edit" aria-hidden="true"></i> Message </td>
			  	<td><i class="fa fa-clock-o" aria-hidden="true"></i> Date </td>
			  	<td><i class="fa fa-street-view" aria-hidden="true"></i> actions</td>
			  </tr>

			  <?php
			  	$query_contact_us="SELECT `id`, `message`, `date`, `account_id` , `account_type`  FROM `contact_us`  LIMIT 8";
			  	$perform_query_contact_us=mysqli_query($connect,$query_contact_us);
			  	
			  	while($result_contactus=mysqli_fetch_assoc($perform_query_contact_us))
			  	{
			  		$account_id=$result_contactus['account_id'];
			  		$account_type=$result_contactus['account_type'];
			  		$message_id=$result_contactus['id'];
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
			  		echo "<td>".$account_name."</td>";
			  		echo "<td>".$result_contactus['message']."</td>";
			  		echo "<td>".$result_contactus['date']."</td>";
			  		echo "<td><a href=\"#\" class=\"reply\">Reply</a></td>";
			  		echo "<input type=\"hidden\" class=\"account_id\" value=\"{$account_id}\" \>";
			  		echo "<input type=\"hidden\" class=\"account_type\" value=\"{$account_type}\" \>";
			  		echo "<input type=\"hidden\" class=\"msg_id\" value=\"{$message_id}\" \>";
			  		echo "</tr>";
			  	}

			  ?>

			  <tr>
			  	
			  </tr>	
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

	<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity_panel" id="reply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio_panel" role="document">
	    
	    <div class="modal-content mod_con_panel">
	    	  	
	      <div class="modal-body mod_body_panel">
	        
	        <textarea class="reply_body"  placeholder="Write Your Reply"></textarea>
	        <button class="btn btn-primary btn-block reply_btn">Reply</button>

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
	<script type="text/javascript" src="javascript/reply_contact_us.js"></script>
	<script type="text/javascript">
		$('#logout_btn').click(function(){
    			$('#logout').modal('show');	
    	});

    	$('.reply').click(function(){
    			$('#reply').modal('show');	
    	});
	</script>
</body>
</html>
