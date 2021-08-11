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
		if($_COOKIE['Account_type']=="person")
		{
			$user_id=$_COOKIE['user_id'];
			$query="SELECT 	first_name , last_name FROM users WHERE id='$user_id' LIMIT 1 ";
			$perform_query=mysqli_query($connect,$query);
			$result=mysqli_fetch_assoc($perform_query);
		}else{
			$message="<span style='color:#ff0000;'>* Conflict Occurs</span>";
 			@$_SESSION['Message_login']=$message;
 			header("location: ../index.php");
		}

	?>
	<!-- /header section -->
	<!-- side bar menu and setting conatiner -->
	<div class="container setting" id="person_setting">
		<div class="col-xs-3 side">
			<div class="sidebar_menu">
				<ul class="list-unstyled option">
					<li class="active"><a href="setting_p.php">Edit Profile</a></li>
					<li><a href="setting_p_changepassword.php">Change Password</a></li>
					<li><a href="setting_p_add_photo.php">Update Your photo</a></li>
					<li><a href="setting_p_add_address.php">Update Your Address</a></li>
					<li><a href="setting_p_add_tel.php">Update Your Telephone</a></li>
					<li><a href="setting_p_report.php">Contact US</a></li>
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
						@$_SESSION['Message_login']=$message;
						header("location: ../logout.php");
						}
					?>
					/>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<h4 class="text-center" style="display:inline;"> <b><?php echo $result['first_name'].' '.$result['last_name'];?></b> </h4>
				</div>
			
				<div class="person_setting">

					<?php
					$user_id=$_COOKIE['user_id'];
					$query="SELECT first_name , last_name , email , gender , country , city , description ,telephone_number1 FROM users
						WHERE id= '$user_id' LIMIT 1";
					$perform_query=mysqli_query($connect,$query);
					$result=mysqli_fetch_assoc($perform_query);

					?>


					<div class="person-data">
                            <h4 class="text-center hidden">Message Box</h4>
	                        <form  method="POST" action="setting_p_background.php" id="p_submit" enctype="multipart/form-data">   
	                           <!-- person First Name-->    
	                           <div class="input-group margin-bottom-sm first">
	                                <span class="input-group-addon">
	                                    <i class="fa fa-pencil fa-fw"></i></span>
	                                <input class="form-control" id="person_firstname" type="text" placeholder="FirstName"  value="<?php echo $result['first_name']; ?>" name="first_name">
	                           </div>
	                           <!--error message -->
	                            <div class="error" id="error_p_firstname"><span>*Error testing</span></div>
	                           <!-- person Last Name-->
	                           <div class="input-group last">
	                               <span class="input-group-addon">
	                                   <i class="fa fa-pencil fa-fw"></i></span>
	                               <input class="form-control" type="text" id="person_lastname"  placeholder="Last Name" name="last_name" value="<?php echo $result['last_name']; ?>">
	                           </div>
	                           <!--error message -->
	                           <div class="error" id="error_p_lastname"><span>*Error testing</span></div>
	                           <!-- person Email-->    
	                           <div class="input-group Email">
	                               <span class="input-group-addon">
	                                   <i class="fa fa-envelope-o fa-fw"></i></span>
	                               <input class="form-control" type="text" id="person_email" placeholder="Your Email" name="email_p" value="<?php echo $result['email']; ?>">
	                           </div>  
	                           <!--error message -->
	                           <div class="error" id="error_p_email"><span>*Error testing</span></div>
	                           <!-- person Gender-->
	                          <div class="kind">
	                              <select id="person_gender" name="gender_p" >
	                                  <option selected disabled value>Gender</option>
	                                  <option value="m" 
	                                  <?php if($result['gender']=="m"):?>
	                                   selected
	                              	  <?php endif;?>
	                                  >Male</option>
	                                  <option value="f"

	                                  <?php if($result['gender']=="f"):?>
	                                   selected
	                              	  <?php endif;?>
	                                  
	                                  >Felmale</option>
	                              </select>             
	                           </div>
	                           <!--error message -->
	                           <div class="error" id="error_p_gender"><span>*Error testing</span></div>
	                         <!-- person Country-->
	                          <div class="kind">
	                              <select name="country_p" id="person_country">
	                                    <option selected disabled value>Your Country</option>
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
	                                    <option 
	                                    <?php if($result['country']=="Egypt"):?>
	                                   	selected
	                              	  	<?php endif;?>
	                                    value="Egypt"
	                                    >Egypt</option>
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
	                           <!--error message -->
	                           <div class="error" id="error_p_country"><span>*Error testing</span></div>
	                           <!-- person city-->
	                           <div class="input-group Address">
	                               <span class="input-group-addon">
	                                   <i class="fa fa-home fa-fw"></i></span>
	                               <input class="form-control" type="text" id="person_city" placeholder="Your Main City" name="city_p" value="<?php echo $result['city'];?>">
	                           </div>
	                           <!--error message -->
	                           <div class="error" id="error_p_city"><span>*Error testing</span></div>
	                           <!-- person Description-->
	                           <div class="input-group Description">
	                               <textarea placeholder=" Your Bio...."  name="description_p" id="person_description"><?php echo $result['description'];?></textarea>
	                           </div>
	                           <!--error message -->
	                           <div class="error" id="error_p_description"><span>*Error testing</span></div>
	                           
	                           
	                           <!-- Map Demo -->
	                           <div id="map">
	                               
	                           </div>
	                           <script>
	                             /* Google map Demo */
	                            function initMap() {
	                                var uluru = {lat: 31.132093, lng: 33.8032762};
	                                var map = new google.maps.Map(document.getElementById('map'), {
	                                  zoom: 4,
	                                  center: uluru
	                                });
	                                var marker = new google.maps.Marker({
	                                  position: uluru,
	                                  map: map
	                                });
	                              }
	                           </script>
	                           <script async defer
	                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYA7Vios1JWwxhYGS_Vmnv-H6dNcHzf1w&callback=initMap">
	                            </script>
	                           <!-- person Submit Button-->
	                       		<button name="submit_p" class="Submit-btn">Update</button>		
	                       </form>
	                       
                     </div>


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
	        	<?php if(@$_SESSION['Success_check']=="true"):?>
	        		src="../images/icon/accept.png"
	        	<?php else:?>
	        		src="../images/icon/cancel.png"
	        	<?php endif;?>
	        	/><b style="color:#080"><?php echo @$_SESSION['message_p_edit_profile'];?></b> </h4>
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
	<?php if(@$_SESSION['Success_check']):?>
	<script type="text/javascript">
    	$(document).ready(function(){
        	 $('#Message').modal('show');
		});
    </script>
	<?php endif;?>
	<?php @$_SESSION['Success_check']=null;?>

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