<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");

	if(@$_POST['do_Action']=='Sign_up')
	{
		if(@$_POST['Sign']=='p')
		{
			if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email_p'])&&
				isset($_POST['password_p'])&&isset($_POST['repassword_p'])&&isset($_POST['gender_p'])&&
				isset($_POST['country_p'])&&isset($_POST['city_p'])&&isset($_POST['description_p']))
			{
				$firstname=preg_replace('#[^a-z0-9]#i', '', $_POST['first_name']);
				$lastname=preg_replace('#[^a-z0-9]#i', '', $_POST['last_name']);
				$email=mysqli_real_escape_string($connect, $_POST['email_p']);
				$password=$_POST['password_p'];
				$repassword=$_POST['repassword_p'];
				$gender=preg_replace('#[^a-z]#', '', $_POST['gender_p']);
				$country=preg_replace('#[^a-z ]#i', '', $_POST['country_p']);
				$city=preg_replace('#[^a-z ]#i', '', $_POST['city_p']);
				$description=$_POST['description_p'];
				$city = str_replace(" ", "+", $city);
				$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$foundation_city&sensor=false&region=$foundation_country");
    			$json = json_decode($json);
				$lat1 = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
			    $long1 = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
			    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

			    $query_check_email="SELECT `id` From `users` WHERE `email`= '$email' LIMIT 1";
			    $perform_query_check_email=mysqli_query($connect,$query_check_email);
			    $email_check=mysqli_num_rows($perform_query_check_email);


			     if($firstname==""||$lastname==""||$email==""||$password==""
		 		||$repassword==""||$gender==""||$country==""||$city==""||$description=="")
			     {
			     	$message="The Registeration Form Submission Is Missing Values";
			     			     
			     }else if(is_numeric($firstname[0]))
			     {
			     	$message="The First Name Cannot Begin With A Number.";
			     	// failed
					$update_action_info[]=array(
							"status"=>"failed",
							"message"=>$message
							);
			     }
			    else if(is_numeric($lastname[0]))
			    {
			    	$message="The Last Name Cannot Begin With A Number";
			    	// failed
					$update_action_info[]=array(
							"status"=>"failed",
							"message"=>$message
							);
			    }
			    else if($email_check>0)
			    {
			    	$message="The Email That You Entered is Alreay Taken.";
		    		// failed
					$update_action_info[]=array(
							"status"=>"failed",
							"message"=>$message
							);
			    }
			    else if($password!=$repassword)
			    {
			    	$message="The Passwords  You Entered Dosenot Matched .";
			    	// failed
					$update_action_info[]=array(
							"status"=>"failed",
							"message"=>$message
							);
			    }else
			    {
			    	// sucessfull
					$update_action_info[]=array(
							"status"=>"Success",
							"message"=>"Successfull Sign Up"
							);
			    }
	
			}else
			{
				// failed
				$update_action_info[]=array(
						"status"=>"failed",
						"message"=>"Faield Sign Up Process"
						);
			}
			



		}else if(@$_POST['Sign']=='f')
		{
			if(isset($_POST['foundation_name'])&&isset($_POST['foundation_email'])&&isset($_POST['foundation_password'])&&
				isset($_POST['foundation_repassword'])&&isset($_POST['foundation_country'])&&isset($_POST['foundation_description'])&&
				isset($_POST['foundation_city']))
			{
				//foundation
				$foundation_name=preg_replace('#[^a-z0-9]#i', '', $_POST['foundation_name']);
				$foundation_email=mysqli_real_escape_string($connect, $_POST['foundation_email']);
				$foundation_password=$_POST['foundation_password'];
				$foundation_repassword=$_POST['foundation_repassword'];
				$foundation_country=preg_replace('#[^a-z ]#i', '', $_POST['foundation_country']);
				$foundation_description=htmlentities($_POST['foundation_description']);
				$foundation_city=preg_replace('#[^a-z ]#i', '', $_POST['foundation_city']);
				$foundation_city = str_replace(" ", "+", $foundation_city);
	    		
	    		$query = "SELECT id FROM foundations WHERE email='$foundation_email' LIMIT 1";
		   		$result_email = mysqli_query($connect, $query); 
				$result_email_check=mysqli_num_rows($query);
				
				 if($foundation_name==""||$foundation_email==""||$foundation_password==""
		 		||$foundation_repassword==""||$foundation_country==""||$foundation_city==""||
		 		$foundation_description=="")
			 	{
			 		$message="The Registeration Form submission is missing values.";
			 	}
			 	else if($result_email_check>0)
			    {
			    	$message="The Email That You Entered is Alreay Taken.";
			     	// failed
					$update_action_info[]=array(
							"status"=>"failed",
							"message"=>$message
							);
			    }
			     else if(is_numeric($foundation_name[0]))
			     {
			     	$message="The Foundation  Name cannot begin with a Number.";
			     	// failed
					$update_action_info[]=array(
							"status"=>"failed",
							"message"=>$message
							);			     
			     }else if($foundation_password!=$foundation_password)
			     {
			     	$message="The Passwords  You Entered Dosenot Matched .";
			     	// failed
					$update_action_info[]=array(
							"status"=>"failed",
							"message"=>$message
							);
			     }else
			     {
			     	// sucessfull
					$update_action_info[]=array(
							"status"=>"Success",
							"message"=>"Successfull Sign Up"
							);
			     }	
			}else
			{
				// failed
				$update_action_info[]=array(
						"status"=>"failed",
						"message"=>"Faield Sign Up Process"
						);
			}

			

		}



		echo json_encode($update_action_info, JSON_FORCE_OBJECT);
	}
?>	