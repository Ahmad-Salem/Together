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
				<li><a class="selected" href="manage_foundations.php"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;&nbsp;Manage Institution</a></li>
				<li><a href="normal_post.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Manage Posts</a></li>
				<li><a href="announcement.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Manage Announcement</a></li>
				<li><a href="contact_us.php"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Manage Contact Us</a></li>
			</ul>
		</div>
		<div class="content">
			<h1>Together Dashbord</h1>
			<p>Together Control Panel.</p>
			
			<div class="box">
				<div class="box-top">
					<h4 class="text-center">MANAGE FOUNDATIONS</h4>
				</div>
				<div class="filter">
					<input type="text" id="search_foundation" name="search" placeholder="Search..">
				</div>	
			</div>

			<table class="table table-bordered statistic_tbl" id="statistic_tbl_foundation">
			  <tr class="active">
			  	<td><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Name</td>
			  	<td><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;&nbsp;Email</td>
			  	<td><i class="fa fa-university" aria-hidden="true"></i>&nbsp;&nbsp;Country</td>
			  	<td><i class="fa fa-info" aria-hidden="true"></i>&nbsp;&nbsp;Info_Completion</td>
			  	<td><i class="fa fa-info" aria-hidden="true"></i>&nbsp;&nbsp;Others</td>
			  </tr>
			<!-- Query to display all persons -->
			<?php
				$query_foundation="SELECT `id`, `name`, `email`, `country`, `info_completion` FROM `foundations` LIMIT 8";
				$perform_query_foundation=mysqli_query($connect,$query_foundation);
				while($result_f=mysqli_fetch_assoc($perform_query_foundation))
				{
					echo "<tr>";
					// <!-- name -->
					echo "<td>".$result_f['name']."</td>";
					// <!-- Email -->
					echo "<td>".$result_f['email']."</td>";
					// <!-- Country -->
					echo "<td>".$result_f['country']."</td>";
					// <!-- info_completion -->
					echo "<td>".$result_f['info_completion']."&nbsp;%</td>";
					// <!-- More Details -->
					echo "
					<td><a href='#' class='details'>More Details </a>
					<input type='hidden' class='foundation_id' value='".$result_f['id']."'/>
					</td>
					";
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

		<!-- pop up of logout model -->
    <!-- Modal -->
	<div class="modal fade fading_opacity_panel" id="display_individual_foundation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <div class="modal-dialog mod_dio_panel" role="document">
	    
	    <div class="modal-content mod_con_panel">
	    	  	
	      <div class="modal-body mod_body_persons_panel">
	        <div class="person_detials">
	        	<img src="../images/profile_image/Capture1.PNG">
	        	&nbsp;&nbsp;
	        	<h4>Ahmed salem</h4>
	        	
	        	<div class="element">
	        		<span class="title">Email:</span>
	        		<span>sdasdasd</span>
	        	</div>
	        	<div class="element">
	        		<span class="title">Address:</span>
	        		<span>sdasdasd</span>
	        	</div>
	        	<div class="element">
	        		<span class="title">Country:</span>
	        		<span>sdasdasd</span>
	        	</div>
	        	<div class="element">
	        		<span class="title">City:</span>
	        		<span>sdasdasd</span>
	        	</div>
	        	<div class="element">
	        		<span class="title">Description:</span>
	        		<p>salkndlaskndkasdkasndklnaslkdnsalkdnksaldnksandklasndlksadksallkldfbdsjfbjsdkbfksjdfjdsbkfjbsdfdskfjsdjfbksdjbfksdjbfkjsdbfjsdbfkjsdbfkjdbfkjsdbfkjdsbfkjsdbfksdjbfkjsdbfkjsdbfksdjbfjsdkbfsdkjbfjsdkbksdbfsdkjfbsdkjbfjdksbfsdkjbfsdkjbfsdkjbfsdkfbsdkjfsdbfksdj</p>
	        	</div>
	        	<div class="element">
	        		<span class="title">Trusted:</span>
	        		<span>sdasdasd</span>
	        	</div>
	        	<div class="element">
	        		<span class="title">Telephone 1:</span>
	        		<span>sdasdasd</span>
	        	</div>
	        	<div class="element">
	        		<span class="title">Telephone 2:</span>
	        		<span>sdasdasd</span>
	        	</div>

	        </div>
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

		$('.details').click(function(){
    			var foundation_id=$(this).siblings(".foundation_id").val();
    			//alert(foundation_id);
    			get_foundation_details(foundation_id);
    			$('#display_individual_foundation').modal('show');	
    	});

		function get_foundation_details(foundation_id)
    	{
    		// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        var foundation_id=foundation_id;
	        var url = "get_foundation_more_details.php";
	        var vars = "foundation_id="+foundation_id;

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArraygetfoundationdetails=return_data;

			 	//console.log(jArraygetfoundationdetails);
			    if(jArraygetfoundationdetails!=null)
				{
					jArraygetfoundationdetails=JSON.parse(jArraygetfoundationdetails);	
					//console.log(jArraygetfoundationdetails);
					$(".fading_opacity_panel .mod_dio_panel .mod_con_panel .mod_body_persons_panel .person_detials").html('');
					$.each( jArraygetfoundationdetails, function( key, value ){

						if(value.user_level=='d' || value.user_level=='c')
						{
							var trusted="Yes";
						}else
						{
							var trusted="No";
						}

						if(value.telephone_number1=='')
						{
							var tele1="Null";
						}else
						{
							var tele1=value.telephone_number1;
						}

						if(value.telephone_number2=='')
						{
							var tele2="Null";
						}else
						{
							var tele2=value.telephone_number2;
						}

						if(value.site_link=='')
						{
							var site="Null";
						}else
						{
							var site="<a href=\""+value.site_link+"\">"+value.site_link+"</a>";
						}

						if(value.fax=='')
						{
							var fax="Null";
						}else
						{
							var fax=value.fax;
						}

						//foundation
						$(".fading_opacity_panel .mod_dio_panel .mod_con_panel .mod_body_persons_panel .person_detials").append("<img src=\"../"+value.photo+"\">&nbsp;&nbsp;<h4>"+value.name+"</h4><div class=\"element\"><span class=\"title\">Email:</span><span>"+value.email+"</span></div><div class=\"element\"><span class=\"title\">Address:</span><span>"+value.adderss+"</span></div><div class=\"element\"><span class=\"title\">Country:</span><span>"+value.country+"</span></div><div class=\"element\"><span class=\"title\">City:</span><span>"+value.city+"</span></div><div class=\"element\"><span class=\"title\">Description:</span><p>"+value.description+"</p></div><div class=\"element\"><span class=\"title\">Site Link:</span><p>"+site+"</p></div><div class=\"element\"><span class=\"title\">Fax Number:</span><span>"+fax+"</span></div><div class=\"element\"><span class=\"title\">Trusted:</span><span>"+trusted+"</span></div><div class=\"element\"><span class=\"title\">Telephone 1:</span><span>"+tele1+"</span></div><div class=\"element\"><span class=\"title\">Telephone 2:</span><span>"+tele2+"</span></div>");
					

					});

				}else{
					$(".fading_opacity_panel .mod_dio_panel .mod_con_panel .mod_body_persons_panel .person_detials").html('<h3 style=\'color:#ff0000;\'>Something Going Wrong ....</h3>');
				}



		    }else{
	            //alert("i'm working");
	        }
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request

    	}

    	$("#search_foundation").on("keyup",function(){
    		var search=$(this).val();
    		//alert(search);	
    		get_foundation_search(search);
    	});

    	function get_foundation_search(search)
    	{
    		// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        var search=search;
	        var url = "get_foundation_more_details_search.php";
	        var vars = "search="+search;

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArraygetfoundationdetails_search=return_data;

			 	//console.log(jArraygetfoundationdetails_search);
			    if(jArraygetfoundationdetails_search!=null)
				{
					jArraygetfoundationdetails_search=JSON.parse(jArraygetfoundationdetails_search);	
					//console.log();	
					$("#statistic_tbl_foundation").html('');
					$("#statistic_tbl_foundation").html("<tr class=\"active\"><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Name</td><td><i class=\"fa fa-envelope-o\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Email</td><td><i class=\"fa fa-university\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Country</td><td><i class=\"fa fa-info\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Info_Completion</td><td><i class=\"fa fa-info\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Others</td></tr>");

					$.each( jArraygetfoundationdetails_search, function( key, value ){

						
						
						//person
						$("#statistic_tbl_foundation").append("<tr><td>"+value.name+"</td><td>"+value.email+"</td><td>"+value.country+"</td><td>"+value.info_completion+"&nbsp;%</td><td><a href='#' class='details'>More Details </a><input type='hidden' class='foundation_id' value='"+value.id+"'/></td></tr>");
					

					});

					$('.details').click(function(){
    					var foundation_id=$(this).siblings(".foundation_id").val();
		    			//alert(foundation_id);
		    			get_foundation_details(foundation_id);
		    			$('#display_individual_foundation').modal('show');	
    				});

				}else{
					
					$("#statistic_tbl_foundation").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
				}



		    }else{
	            $("#statistic_tbl_foundation").html("<tr class=\"active\"><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Name</td><td><i class=\"fa fa-envelope-o\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Email</td><td><i class=\"fa fa-university\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Country</td><td><i class=\"fa fa-info\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Info_Completion</td><td><i class=\"fa fa-info\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Others</td></tr>");
	            $("#statistic_tbl_foundation").append("<tr><td colspan='5'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr>");
	        }
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request

    	}

	</script>
</body>
</html>
