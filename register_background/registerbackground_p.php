<?php
session_start();
include_once("../php_includes/connection_dp.php");

if(isset($_POST['submit_p']) && !empty($_POST['submit_p']))
{
	$firstname=preg_replace('#[^a-z0-9]#i', '', $_POST['first_name']);
	$lastname=preg_replace('#[^a-z0-9]#i', '', $_POST['last_name']);
	$email=mysqli_real_escape_string($connect, $_POST['email_p']);
	$password=$_POST['password_p'];
	$repassword=$_POST['repassword_p'];
	$gender=preg_replace('#[^a-z]#', '', $_POST['gender_p']);
	$country=preg_replace('#[^a-z ]#i', '', $_POST['country_p']);
	$city=preg_replace('#[^a-z ]#i', '', $_POST['city_p']);
//	$address=$_POST['address_p'];
	
//	$dataFile=$_FILES['dataFile_p']['tmp_name'];
//	$image=addslashes(file_get_contents($_FILES['dataFile_p']['tmp_name']));
//	$image_name=addslashes($_FILES['dataFile_p']['name']);
//	$image_size=getimagesize($_FILES['dataFile_p']['tmp_name']);


	$description=$_POST['description_p'];
//	$telephone1=preg_replace('/[^0-9]/', '', $_POST['telephone1_p']);
//	$telephone2=preg_replace('/[^0-9]/', '', $_POST['telephone2_p']);
    $city = str_replace(" ", "+", $city);
  
    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$city&sensor=false&region=$country");
    $json = json_decode($json);

    $lat1 = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long1 = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));


 //    $query = "SELECT id FROM users WHERE first_name='$firstname' LIMIT 1";
 //    $result = mysqli_query($connect, $query); 
	// $first_name_check = mysqli_num_rows($result);
	// //--------------------------------------------
	// $query = "SELECT id FROM users WHERE last_name='$lastname' LIMIT 1";
 //    $result = mysqli_query($connect, $query); 
	// $last_name_check = mysqli_num_rows($result);
	// -------------------------------------------
	$query = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($connect, $query); 
	$email_check = mysqli_num_rows($result);
	

	//echo $firstname.'<br>';
	//echo $lastname.'<br>';
	//echo $email.'<br>';
	//echo $password.'<br>';
	//echo $repassword.'<br>';
	//echo $gender.'<br>';
	//echo $country.'<br>';
	//echo $city.'<br>';
	//echo $address.'<br>';
	//echo $dataFile.'<br>';
	//echo $description.'<br>';
	//echo $telephone1.'<br>a';
	//echo $telephone2.'<br>';


	 if($firstname==""||$lastname==""||$email==""||$password==""
	 	||$repassword==""||$gender==""||$country==""||$city==""||$description=="")
     {
     	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>
     	The Registeration Form Submission Is Missing Values.</p>";
     	$_SESSION['message_error']=$message;
     	header("location: ../register.php");
     
     }else if(is_numeric($firstname[0]))
     {
     	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>The First Name Cannot Begin With A Number.</p>";
     	$_SESSION['message_error']=$message;
     	header("location: ../register.php");
     }
    else if(is_numeric($lastname[0]))
    {
    	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>The Last Name Cannot Begin With A Number</p>";
    	$_SESSION['message_error']=$message;
    	header("location: ../register.php");
    }
    else if($email_check>0)
    {
    	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'> The Email That You Entered is Alreay Taken.</p>";
    	$_SESSION['message_error']=$message;
    	header("location: ../register.php");
    }
    else if($password!=$repassword)
    {
    	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>The Passwords  You Entered Dosenot Matched .</p>";
    	$_SESSION['message_error']=$message;
    	header("location: ../register.php");
    }	
 	else{


			
//     	// END FORM DATA ERROR HANDLING
// 	    // Begin Insertion of data into the database
// 		// Hash the password and apply your own mysterious unique salt
 		include_once ("../php_includes/rand.php");
 		// $p=crypt($password);
 		// $password = randStrGen(20)."$p".randStrGen(20);

 		

 		$query="INSERT INTO `users`(`first_name`, `last_name`, `email`
 			, `password`, `gender` , `country`, `city`, `lat`, `log`, `description`
 			, `signup_date`, `ip`, `last_login`, `note_check`) 
 			VALUES (\"$firstname\",\"$lastname\",\"$email\",\"$password\"
 				,'$gender','$country',\"$city\",'$lat1','$long1',\"$description\"
 				,now(),'$ip',now(),now())";
		
 		$result_register=mysqli_query($connect,$query);


 		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)

		if($result_register)
		{
			$message="<p style='color:#080; background-color:#fff; border-radius:10px; padding:20px;'>successful registeration .. <a href='index.php' style='text-decoration:none; color:#080;'> Login Now!</a></p>";
			// Email the user their activation link
			$to = "$email";							 
			$from = "together@together.com";
			$subject = 'Together Account Activation';
			$message = '
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="UTF-8">
					<title>yoursitename Message</title>
				</head>
				<body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
					<div style="padding:10px; background:#333; font-size:24px; color:#CCC;">
						<span style="padding-left:24px;">Together <i style="font-size:15px;">Account Activation</i></span>
					</div>
					<div style="padding:24px; font-size:17px;">Hello '.$firstname.',<br /><br />
						Click the link below to activate your account when ready:
						<br /><br />
					<a href="http://www.yoursitename.com/activation.php?">Click here to activate your account now</a>
					<br /><br />Login after successful activation using your:
					<br />* E-mail Address: <b>'.$email.'</b></div>
				</body>
			</html>

			';
			$headers = "From: $from\n";
	        $headers .= "MIME-Version: 1.0\n";
	        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
			if(mail($to, $subject, $message, $headers))
			{
				$message="<p style='color:#080; background-color:#fff; border-radius:10px; padding:20px;'>Successfull Registeration .. check Your Email To Activate Your Account.
				<br/><a href='../root/index.php' style='text-decoration:none; '> Login Now!</a></p>";
			}else{
				$message="<p style='color:#080; background-color:#fff; border-radius:10px; padding:20px;'>Successfull Registeration .. <br/> But Your Activation Email has An Error.<a href='#'>Click here to resend your Activation message.</a>
				<br/><a href='../root/index.php' style='text-decoration:none;'> Login Now!</a></p>";
			}

			$_SESSION['message_error']=$message;
			header("location: ../register.php");
		}else{
			$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>Registeration Failed ...</p>";
			$_SESSION['message_error']=$message;
			header("location: ../register.php");
		}
    }


}else{
	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>registerration failed ...</p>";
	$_SESSION['message_error']=$message;
	header("location: register.php");
}

?>



      
