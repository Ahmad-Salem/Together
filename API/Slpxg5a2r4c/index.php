<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	

	if($_POST['do_Action']=='setting')
	{
		
		if(isset($_POST['setting_type'])&&isset($_POST['account_id'])&&isset($_POST['account_type']))
		{
			
			/*edit profile */
			if(@$_POST['setting_type']=='Edit_Profile')
			{	
				
				if($_POST['account_type']=='p')
				{
					
					$user_id=$_POST['account_id'];
					
					if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email'])&&isset($_POST['gender'])&&isset($_POST['country'])&&isset($_POST['city'])&&isset($_POST['description']))
					{
						
						$first_name=preg_replace('#[^a-z0-9]#i', '', $_POST['first_name']);
						$last_name=preg_replace('#[^a-z0-9]#i', '', $_POST['last_name']);
						$email=mysqli_real_escape_string ($connect, $_POST['email']);
						$gender=preg_replace('#[^a-z ]#i', '', $_POST['gender']);
						$country=preg_replace('#[^a-z ]#i', '', $_POST['country']);
						$city=preg_replace('#[^a-z ]#i', '', $_POST['city']);
						$city=str_replace(" ", "+", $city);
						$description=mysqli_real_escape_string($connect,$_POST['description']);
						
						$query="UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',
						`email`='$email',`gender`='$gender',`country`='$country',`city`='$city',`description`='$description' WHERE id ='$user_id' LIMIT 1";
						
						$perform_query=mysqli_query($connect,$query);

						if($perform_query)
						{
							// sucessfull
							$update_action_info[]=array(
									"status"=>"Success",
									"message"=>"Successful Updation"
									);
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Failed Updation"
									);

						}	
					}else
					{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Failed Updation"
									);
							
					}
					

				}else if(@$_POST['account_type']=='f')
				{
					
					$foundation_id=$_POST['account_id'];
					//foundation
					if(isset($_POST['foundation_name'])&&isset($_POST['foundation_email'])&&isset($_POST['foundation_country'])&&isset($_POST['foundation_city'])&&isset($_POST['foundation_description']))						
					{
						$name=preg_replace('#[^a-z0-9]#i', '', $_POST['foundation_name']);
						$email=mysqli_real_escape_string($connect, $_POST['foundation_email']);
						$country=preg_replace('#[^a-z ]#i', '', $_POST['foundation_country']);
						$city=preg_replace('#[^a-z ]#i', '', $_POST['foundation_city']);
						$city=str_replace(" ", "+", $city);
						$description=mysqli_real_escape_string($connect , $_POST['foundation_description']);

						$query="UPDATE `foundations` SET `name`= '$name' ,`email`= '$email' ,`country`= '$country' ,`city`= '$city' ,
			 			`description`= '$description'  WHERE id= '$foundation_id' LIMIT 1";
						$perform_query=mysqli_query($connect,$query);
						if($perform_query)
						{
							// sucessfull
							$update_action_info[]=array(
									"status"=>"Success",
									"message"=>"Successful Updation"
									);
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Failed Updation"
									);
							
						}


					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Failed Updation"
								);	
						
					}	

					
				}
			}

			/* make sure form password whadan*/
			if(@$_POST['setting_type']=='Ensure_Password')
			{
				if(@$_POST['account_type']=='p')
				{
					if(isset($_POST['current_password']))
					{
						
						$current_password=$_POST['current_password'];
						$user_id=$_POST['account_id'];
						$query="SELECT `id` FROM `users` WHERE  `password`= '$current_password' AND id='$user_id' LIMIT 1";
						$perform_query=mysqli_query($connect,$query);
						
						if(mysqli_num_rows($perform_query)==1)
						{
							// succes
							$update_action_info[]=array(
									"status"=>"Success",
									"message"=>"Successful Current"
									);
						}else
						{
							
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Failed Current"
									);
						}
					}else
					{
						
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Failed Updation"
								);
					}
				}else if(@$_POST['account_type']=='f')
				{
					if(isset($_POST['current_password']))
					{
						
						$current_password=$_POST['current_password'];
						$foundation_id=$_POST['account_id'];
						$query="SELECT `id` FROM `foundations` WHERE  `password`= '$current_password' AND id='$foundation_id' LIMIT 1";
						$perform_query=mysqli_query($connect,$query);
						
						if(mysqli_num_rows($perform_query)==1)
						{
							// succes
							$update_action_info[]=array(
									"status"=>"Success",
									"message"=>"Successful Current"
									);
						}else
						{
							
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Failed Current"
									);
						}
					}else
					{
						
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Failed Updation"
								);
					}
				}
			}
			/* end make sure form password whadan*/
			/*person,foundation profile */
			if(@$_POST['setting_type']=='Change_Password')
			{
				if(@$_POST['account_type']=='p')
				{
					if(isset($_POST['password'])&&isset($_POST['re_password']))
					{

						$user_id=$_POST['account_id'];
						$password=$_POST['password'];
						$re_password=$_POST['re_password'];

						if(strlen($password)>=8)
						{
							if(strcmp($password,$re_password)==0)
							{
								$query="UPDATE `users` SET `password`= '$password' WHERE id='$user_id' LIMIT 1";
								$perform_query=mysqli_query($connect,$query);
								if($perform_query)
								{
									// sucessfull
									$update_action_info[]=array(
											"status"=>"Success",
											"message"=>"Successful Updation"
											);
								}else
								{
									// failed
									$update_action_info[]=array(
											"status"=>"failed",
											"message"=>"Failed Updation"
											);
								}	

							}else
							{	
								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Passwords Doesn't Match."
										);						
							}
									
						}else
						{

							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Password Must be At Least 8 Characters."
									);
						}
						
							
					}else
					{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Failed Updation"
									);		
					}
					

				}else if(@$_POST['account_type']=='f')
				{
					if(isset($_POST['password'])&&isset($_POST['re_password']))
					{

						$foundation_id=$_POST['account_id'];
						$password=$_POST['password'];
						$re_password=$_POST['re_password'];

						if(strlen($password)>=8)
						{
							if(strcmp($password,$re_password)==0)
							{
								$query="UPDATE `foundations` SET `password`= '$password' WHERE id='$foundation_id' LIMIT 1";
								$perform_query=mysqli_query($connect,$query);
								if($perform_query)
								{
									// sucessfull
									$update_action_info[]=array(
											"status"=>"Success",
											"message"=>"Successful Updation"
											);
									
									
								}else
								{
									// failed
									$update_action_info[]=array(
											"status"=>"failed",
											"message"=>"Failed Updation"
											);
								}	

							}else
							{	
								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Passwords Doesn't Match."
										);						
							}
									
						}else
						{

							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Password Must be At Least 8 Characters."
									);
						}
						
							
					}else
					{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Failed Updation"
									);		
					}
				}
				
			}


			/*person,foundation profile */
			if(@$_POST['setting_type']=='Update_photo')
			{
				if(@$_POST['account_type']=='p')
				{
					if(isset($_FILES["image_person"]))
					{
						$user_id=$_POST['account_id'];
						$fileName = $_FILES["image_person"]["name"]; // The file name
						$fileTmpLoc = $_FILES["image_person"]["tmp_name"]; // File in the PHP tmp folder
						$fileType = $_FILES["image_person"]["type"]; // The type of file it is
						$fileSize = $_FILES["image_person"]["size"]; // File size in bytes
						$fileErrorMsg = $_FILES["image_person"]["error"]; // 0 = false | 1 = true
						$folder_name=$user_id;
						if (!file_exists("../users/$folder_name")) {
								mkdir("../users/$folder_name", 0755);
							}


						$kaboom = explode(".", $fileName); // Split file name into an array using the dot
						$fileExt = end($kaboom); // Now target the last array element to get the file extension
					
						if (!$fileTmpLoc) 
						{ 
							// if file not chosen
						    // failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Photo Not chosen"
									);
						}
						 else if($fileSize > 5242880) 
						 { 
						 	// if file size is larger than 5 Megabytes
						    // failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Photo Size Is Larger Than 5 Megabytes"
									);
							
						} 
						else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) )
						 {
						    
						    // This condition is only if you wish to allow uploading of specific file types
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"ERROR: Your image was not .gif, .jpg, or .png."
									);
								
						} 
						else if ($fileErrorMsg == 1)
						 { 
						 	// if file upload error key is equal to 1
						 	// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"ERROR: An Error Occured While processing the Photo. Try again."
									);
						    
						}

						
						$moveResult = move_uploaded_file($fileTmpLoc, "../../users/$folder_name/$fileName");
						// Check to make sure the move result is true before continuing
						if ($moveResult != true) {
						    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						    // failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"ERROR: File not uploaded. Try again."
									);
							
						}else{

							$query_image="UPDATE `users` SET `photo`='$fileName',`photo_value`='$fileSize' WHERE id='$user_id' ";
							$perform_query_image=mysqli_query($connect,$query_image);
							if($perform_query_image)
							{

								unlink($fileTmpLoc); 
								// sucessfull
								$update_action_info[]=array(
										"status"=>"Success",
										"message"=>"Successful Updation"
										);
						    	

							}else{
								unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							    // failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Update Failed. Try again ): ."
										);	
								
							}




						}
					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Update Failed. Try again ): ."
								);
						
					}

				}else if(@$_POST['account_type']=='f')
				{
					if(isset($_FILES["image_person"]))
					{
						$foundation_id=$_POST['account_id'];
						$fileName = $_FILES["image_person"]["name"]; // The file name
						$fileTmpLoc = $_FILES["image_person"]["tmp_name"]; // File in the PHP tmp folder
						$fileType = $_FILES["image_person"]["type"]; // The type of file it is
						$fileSize = $_FILES["image_person"]["size"]; // File size in bytes
						$fileErrorMsg = $_FILES["image_person"]["error"]; // 0 = false | 1 = true
						$folder_name=$foundation_id;
						if (!file_exists("../foundations/$folder_name")) {
								mkdir("../foundations/$folder_name", 0755);
							}


						$kaboom = explode(".", $fileName); // Split file name into an array using the dot
						$fileExt = end($kaboom); // Now target the last array element to get the file extension
					
						if (!$fileTmpLoc) 
						{ 
							// if file not chosen
						    // failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Photo Not chosen"
									);
						}
						 else if($fileSize > 5242880) 
						 { 
						 	// if file size is larger than 5 Megabytes
						    // failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Photo Size Is Larger Than 5 Megabytes"
									);
							
						} 
						else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) )
						 {
						    
						    // This condition is only if you wish to allow uploading of specific file types
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"ERROR: Your image was not .gif, .jpg, or .png."
									);
								
						} 
						else if ($fileErrorMsg == 1)
						 { 
						 	// if file upload error key is equal to 1
						 	// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"ERROR: An Error Occured While processing the Photo. Try again."
									);
						    
						}

						
						$moveResult = move_uploaded_file($fileTmpLoc, "../../foundations/$folder_name/$fileName");
						// Check to make sure the move result is true before continuing
						if ($moveResult != true) {
						    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						    // failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"ERROR: File not uploaded. Try again."
									);
							
						}else{

							$query_image="UPDATE `foundations` SET `photo`='$fileName',`photo_value`='$fileSize' WHERE id='$foundation_id' ";
							$perform_query_image=mysqli_query($connect,$query_image);
							if($perform_query_image)
							{

								unlink($fileTmpLoc); 
								// sucessfull
								$update_action_info[]=array(
										"status"=>"Success",
										"message"=>"Successful Updation"
										);
						    	

							}else{
								unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							    // failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Update Failed. Try again ): ."
										);	
								
							}




						}
					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Update Failed. Try again ): ."
								);
						
					}	
				}
			}

			/*person,foundation profile */
			if(@$_POST['setting_type']=='Update_Address')
			{
				if(@$_POST['account_type']=='p')
				{
					if(isset($_POST['address_field']))
					{
						$user_id=$_POST['account_id'];
						$address=$_POST['address_field'];
						if($address!='')
						{
							$query="UPDATE `users` SET `adderss`= '$address' WHERE id ='$user_id' LIMIT 1";
							$perform_query=mysqli_query($connect,$query);
							if($perform_query)
							{
								// sucessfull
								$update_action_info[]=array(
										"status"=>"Success",
										"message"=>" Successfull Update :) .."
										);
								
							}else{

								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Update Failed. Try again ): ."
										);
							}	
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Update Failed. Try again ): ."
									);
						}
						

					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Update Failed. Try again ): ."
								);
					}

				}else if(@$_POST['account_type']=='f')
				{
					if(isset($_POST['address_field']))
					{
						$foundation_id=$_POST['account_id'];
						$address=$_POST['address_field'];
						if($address!='')
						{
							$query="UPDATE `foundations` SET `address`= '$address' WHERE id ='$foundation_id' LIMIT 1";
							$perform_query=mysqli_query($connect,$query);
							if($perform_query)
							{
								// sucessfull
								$update_action_info[]=array(
										"status"=>"Success",
										"message"=>" Successfull Update :) .."
										);
								
							}else{

								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Update Failed. Try again ): ."
										);
							}	
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Update Failed. Try again ): ."
									);
						}
						

					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Update Failed. Try again ): ."
								);
					}					
				}
			}

			/*person,foundation profile */
			if(@$_POST['setting_type']=='Update_Telephone')
			{
				if(@$_POST['account_type']=='p')
				{
					if(isset($_POST['update_tel']))
					{	
						$user_id=$_POST['account_id'];
						$tel_num=$_POST['update_tel'];
						if(strlen($tel_num)<=12 AND strlen($tel_num)>=10)
						{

							$query="UPDATE `users` SET `telephone_number1`= '$tel_num' WHERE id ='$user_id' LIMIT 1";
							$perform_query=mysqli_query($connect,$query);
							if($perform_query)
							{
								// sucessfull
								$update_action_info[]=array(
										"status"=>"Success",
										"message"=>" Successfull Update :) .."
										);
							}else{
								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Update Failed. Try again ): ."
										);
							}	
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Telephone number Should Be Bettween 10 and 12 digital number.): ."
									);
						}
						
					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Update Failed. Try again ): ."
								);
					}
				}else if(@$_POST['account_type']=='f')
				{
					if(isset($_POST['update_tel']))
					{	
						$foundation_id=$_POST['account_id'];
						$tel_num=$_POST['update_tel'];
						if(strlen($tel_num)<=12 AND strlen($tel_num)>=10)
						{

							$query="UPDATE `foundations` SET `telephone_number1`= '$tel_num' WHERE id ='$foundation_id' LIMIT 1";
							$perform_query=mysqli_query($connect,$query);
							if($perform_query)
							{
								// sucessfull
								$update_action_info[]=array(
										"status"=>"Success",
										"message"=>" Successfull Update :) .."
										);
							}else{
								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Update Failed. Try again ): ."
										);
							}	
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Telephone number Should Be Bettween 10 and 12 digital number.): ."
									);
						}
						
					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Update Failed. Try again ): ."
								);
					}	
				}
			}

			/*person,foundation profile */
			if(@$_POST['setting_type']=='Contact_US')
			{
				if(@$_POST['account_type']=='p')
				{

					if(isset($_POST['Contact_Msg']))
					{

						$user_id=$_POST['account_id'];
						$Contact_Msg1=$_POST['Contact_Msg'];
						$query="INSERT INTO `contact_us` (`message`, `account_id`, `account_type`) VALUES ('{$Contact_Msg1}','{$user_id}','p') ";
						$perform_query=mysqli_query($connect,$query);
						if($perform_query)
						{
							// sucessfull
							$update_action_info[]=array(
									"status"=>"Success",
									"message"=>" Successful send :) .."
									);
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Send Failed. Try again ): ."
									);
						}
					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Send Failed. Try again ): ."
								);
					}

				}else if(@$_POST['account_type']=='f')
				{
					if(isset($_POST['Contact_Msg']))
					{

						$foundation_id=$_POST['account_id'];
						$Contact_Msg1=$_POST['Contact_Msg'];
						$query="INSERT INTO `contact_us` (`message`, `account_id`, `account_type`) VALUES ('{$Contact_Msg1}','{$foundation_id}','f') ";
						$perform_query=mysqli_query($connect,$query);
						if($perform_query)
						{
							// sucessfull
							$update_action_info[]=array(
									"status"=>"Success",
									"message"=>" Successful send :) .."
									);
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Send Failed. Try again ): ."
									);
						}
					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Send Failed. Try again ): ."
								);
					}					
				}
			}

			/*only foundation profile */
			if(@$_POST['setting_type']=='Update_Fax')
			{
				if(@$_POST['account_type']='f')
				{
						if(isset($_POST['fax_value']))
						{

							$foundation_id=$_POST['account_id'];
							$fax_value=$_POST['fax_value'];
							if(strlen($fax_value)<=12 AND strlen($fax_value)>=10)
							{
								$query="UPDATE `foundations` SET `fax`='$fax_value' WHERE `id`='foundation_id' LIMIT 1";
								$perform_query=mysqli_query($connect,$query);
								if($perform_query)
								{
									// sucessfull
									$update_action_info[]=array(
											"status"=>"Success",
											"message"=>" Successful send :) .."
											);
								}else
								{
									// failed
									$update_action_info[]=array(
											"status"=>"failed",
											"message"=>"Send Failed. Try again ): ."
											);
								}	
							}else
							{
								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Fax number must be Bettween 10 and 12 digital Numbers."
										);
							}
							
						}else
						{
							// failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Send Failed. Try again ): ."
									);
						}					
					}
				}
			

			/*only foundation profile */
			if(@$_POST['setting_type']=='Update_Site')
			{
				if(@$_POST['account_type']='f')
				{
					$url = filter_var($url, FILTER_SANITIZE_URL);
					if(isset($_POST['site_value']))
					{

						$foundation_id=$_POST['account_id'];
						$site_value=$_POST['site_value'];
						$url = filter_var($site_value, FILTER_SANITIZE_URL);

						// Validate url
						if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
						    $query="UPDATE `foundations` SET `fax`='$url' WHERE `id`='foundation_id' LIMIT 1";
							$perform_query=mysqli_query($connect,$query);
							if($perform_query)
							{
								// sucessfull
								$update_action_info[]=array(
										"status"=>"Success",
										"message"=>" Successful send :) .."
										);
							}else
							{
								// failed
								$update_action_info[]=array(
										"status"=>"failed",
										"message"=>"Send Failed. Try again ): ."
										);
							}
						} else {
						    // failed
							$update_action_info[]=array(
									"status"=>"failed",
									"message"=>"Send Failed. Try again ): ."
									);
						}

							
					
						
					}else
					{
						// failed
						$update_action_info[]=array(
								"status"=>"failed",
								"message"=>"Send Failed. Try again ): ."
								);
					}	
				}
			}
		}

		echo json_encode($update_action_info, JSON_FORCE_OBJECT);	
	}
?>