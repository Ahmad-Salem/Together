<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	/* Start api for login */ 
	if(@$_POST['do_action']=='login')
	{
		if(isset($_POST['Email'])&&isset($_POST['Password'])&&isset($_POST['account_type']))
		{
			$Email=$_POST['Email'];
			$Password=$_POST['Password'];
			$Account_type=$_POST['account_type'];
			

			if($Account_type=="p")
			{
				// if the account type is person
				$query="SELECT id, first_name , last_name , password , gender FROM users WHERE email='$Email'  LIMIT 1";
				$perform_check=mysqli_query($connect,$query);
				$row = mysqli_fetch_assoc($perform_check);
				$check_email=mysqli_num_rows($perform_check);
				
				//start check person email
				if($check_email>0)
				{
					//setting values 
					$user_id=$row['id'];
					$user_first_name=$row['first_name'];
					$user_last_name=$row['last_name'];
					$user_password=$row['password'];
					
					
			 		
			 		$hashed_password=cryptPass($user_password);
			 		
			 		if(crypt($Password, $hashed_password) == $hashed_password )
			 		{
			 			
			 			

			 			// GET USER IP ADDRESS
		    			$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
			 			//update login time for last login
			 			$query="UPDATE users SET ip='$ip', `activated`='1' ,  last_login=now() WHERE id='$user_id' LIMIT 1";
			 			$perform_update_time=mysqli_query($connect,$query);
			 			$query_account_info="SELECT  `telephone_number1`, `gender`, `photo`, `adderss`, `country`, `city`, `description`, `blue_mark` FROM `users` WHERE `id`='$user_id' LIMIT 1";
			 			$perform_query_account_info=mysqli_query($connect,$query_account_info);
			 			$result_info=mysqli_fetch_assoc($perform_query_account_info);

			 			$telephone_number=$result_info['telephone_number1'];
			 			$address=$result_info['adderss'];
			 			$country=$result_info['country'];
			 			$city=$result_info['city'];
			 			$description=$result_info['description'];
			 			$blue_mark=$result_info['blue_mark'];

			 			if($result_info['photo']==null)
						{
							if($result_info['gender']=='m')
							{	
								$image="together.gsg-xpro.com/root/images/profile_image/default-person.jpg";
							}else{
								$image="together.gsg-xpro.com/root/images/profile_image/user_profile_female.jpg";
							}

						}else{
							
							$image="together.gsg-xpro.com/root/users/".$user_id."/".$result_info['photo'];
						}






			 			if($perform_update_time==true)
			 				{

			 					$query_trusting="SELECT `id` FROM `following` WHERE `account_following_id`='$user_id' AND `account_following_type`='p' ";
			 					$perform_query_trusting=mysqli_query($connect,$query_trusting);
			 					$trusting_accounts=mysqli_num_rows($perform_query_trusting);
			 					$query_trusted="SELECT `id` FROM `following` WHERE `account_followed_id`='$user_id' AND `account_followed_type`='p' ";
			 					$perform_query_trusted=mysqli_query($connect,$query_trusted);
			 					$trusted_accounts=mysqli_num_rows($perform_query_trusted);
			 					$query_posting="SELECT `id` FROM `normal_posts`";
			 					$perform_query_posting=mysqli_query($connect,$query_posting);
			 					$posting_counts=mysqli_num_rows($perform_query_posting);

			 					//oki login success
			 					$account_info[]=array(
									"account_id"=>$user_id,
									"account_type"=>'p',
									"name"=>$user_first_name.' '.$user_last_name,
									"first_name"=>$user_first_name,
									"last_name"=>$user_last_name,
									"email"=>$Email,
									"password"=>$user_password,
									"image"=>$image,
									"telephone_number"=>$telephone_number,
									"address"=>$address,
									"country"=>$country,
									"city"=>$city,
									"description"=>$description,
									"blue_mark"=>$blue_mark,
									"trusted_counts"=>$trusted_accounts,
									"trusting_counts"=>$trusting_accounts,
									"posting_counts"=>$posting_counts,
									"status"=>"Success",
									"message"=>"Successful login"
									);

			 				}else{
			 					//not oki login failed 
			 					$account_info[]=array(
									"account_id"=>null,
									"account_type"=>null,
									"name"=>null,
									"email"=>null,
									"password"=>null,
									"status"=>"failed",
									"message"=>"Login Failed "
									);
			 				}
			 				

			 		}else{

			 		//not oki password is worng	
			 		$account_info[]=array(
									"account_id"=>null,
									"account_type"=>null,
									"name"=>null,
									"email"=>null,
									"password"=>null,
									"status"=>"failed",
									"message"=>"Wrong Password"
									);	
			 		}

		 		}else{
		 			//not oki email is failed 
		 			$account_info[]=array(
									"account_id"=>null,
									"account_type"=>null,
									"name"=>null,
									"email"=>null,
									"password"=>null,
									"status"=>"failed",
									"message"=>"Wrong Email"
									);	
		 		}
		 	
		 		//end check person email

				
			}
			//type foundation 
			else if($Account_type=="f"){

				// if the account type is foundation
				$query="SELECT id, name, password FROM foundations WHERE email='$Email'  LIMIT 1";
				$perform_check=mysqli_query($connect,$query);
				$row = mysqli_fetch_assoc($perform_check);
				$check_email=mysqli_num_rows($perform_check);
				//strating checking foundation email
				if($check_email>0)
					{
						//setting values 
						$foundation_id=$row['id'];
						$foundation_name=$row['name'];
						$foundation_password=$row['password'];
						
						$hashed_password=cryptPass($foundation_password);


			 		if(crypt($Password, $hashed_password) == $hashed_password)
			 		{
			 			
						
			 			//setting cookie for foundation

			 			
						// GET USER IP ADDRESS
		    			$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
			 			//update login time for last login
			 			$query="UPDATE foundations SET ip='$ip',`activated`='1' , last_login=now() WHERE id='$foundation_id' LIMIT 1";
			 			$perform_update_time=mysqli_query($connect,$query);
			 			
			 			$query_account_info="SELECT  `telephone_number1`, `photo`, `address`, `country`, `city`, `description`, `fax`, `site_link`, `blue_mark` FROM `foundations` WHERE `id`='$foundation_id' LIMIT 1";
			 			$perform_query_account_info=mysqli_query($connect,$query_account_info);
			 			$result_info=mysqli_fetch_assoc($perform_query_account_info);

			 			$telephone_number=$result_info['telephone_number1'];
			 			$address=$result_info['address'];
			 			$country=$result_info['country'];
			 			$city=$result_info['city'];
			 			$description=$result_info['description'];
			 			$fax=$result_info['fax'];
			 			$site_link=$result_info['site_link'];
			 			$blue_mark=$result_info['blue_mark'];

			 			if($result_info['photo']==null)
						{
							$image="together.gsg-xpro.com/root/images/profile_image/default-academy.jpg";
						}else
						{
							$image="together.gsg-xpro.com/root/foundations/".$foundation_id."/".$result_info['photo'];
						}

			 			if($perform_update_time==true)
			 				{
			 					$query_trusting="SELECT `id` FROM `following` WHERE `account_following_id`='$foundation_id' AND `account_following_type`='p' ";
			 					$perform_query_trusting=mysqli_query($connect,$query_trusting);
			 					$trusting_accounts=mysqli_num_rows($perform_query_trusting);
			 					$query_trusted="SELECT `id` FROM `following` WHERE `account_followed_id`='$foundation_id' AND `account_followed_type`='p' ";
			 					$perform_query_trusted=mysqli_query($connect,$query_trusted);
			 					$trusted_accounts=mysqli_num_rows($perform_query_trusted);
			 					$query_posting="SELECT `id` FROM `normal_posts`";
			 					$perform_query_posting=mysqli_query($connect,$query_posting);
			 					$posting_counts=mysqli_num_rows($perform_query_posting);

			 					$account_info[]=array(
									"account_id"=>$foundation_id,
									"account_type"=>'f',
									"name"=>$foundation_name,
									"email"=>$Email,
									"password"=>$foundation_password,
									"telephone_number"=>$telephone_number,
									"address"=>$address,
									"country"=>$country,
									"city"=>$city,
									"description"=>$description,
									"fax"=>$fax,
									"site_link"=>$site_link,
									"blue_mark"=>$blue_mark,
									"trusted_counts"=>$trusted_accounts,
									"trusting_counts"=>$trusting_accounts,
									"posting_counts"=>$posting_counts,
									"image"=>$image,
									"status"=>"Success",
									"message"=>"Successful login"
									);

			 				}else{
			 					//not oki login failed 
			 					$account_info[]=array(
									"account_id"=>null,
									"account_type"=>null,
									"name"=>null,
									"email"=>null,
									"password"=>null,
									"status"=>"failed",
									"message"=>"Login Faield"
									);
			 				}

			 			

			 		}else{

			 		//not oli password is wrong 	
			 		$account_info[]=array(
									"account_id"=>null,
									"account_type"=>null,
									"name"=>null,
									"email"=>null,
									"password"=>null,
									"status"=>"failed",
									"message"=>"Wrong Password"
									);	
			 		}


					}
				else{

					//not oki invalid email
					$account_info[]=array(
									"account_id"=>null,
									"account_type"=>null,
									"name"=>null,
									"email"=>null,
									"password"=>null,
									"status"=>"failed",
									"message"=>"Wrong Email"
									);	
				}
				//ending checking foundation email

			}
			else{
					//not oki login failed 
					$account_info[]=array(
									"account_id"=>null,
									"account_type"=>null,
									"name"=>null,
									"email"=>null,
									"password"=>null,
									"status"=>"failed",
									"message"=>"Login Failed"
									);
			}

		}else
		{
			//not oki login failed 
			$account_info[]=array(
							"account_id"=>null,
							"account_type"=>null,
							"name"=>null,
							"email"=>null,
							"password"=>null,
							"status"=>"failed",
							"message"=>"Login Failed"
							);
		}
		echo json_encode($account_info, JSON_FORCE_OBJECT);
	}
	/* End api for login */
?>