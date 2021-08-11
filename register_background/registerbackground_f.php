<?php
session_start();

include_once("../php_includes/connection_dp.php");



if(isset($_POST['foundation_submit']))
{
	$foundation_name=preg_replace('#[^a-z0-9]#i', '', $_POST['foundation_name']);
	$foundation_email=mysqli_real_escape_string($connect, $_POST['foundation_email']);
	$foundation_password=$_POST['foundation_password'];
	$foundation_repassword=$_POST['foundation_repassword'];
	
	//$foundation_photo=$_FILES['foundation_photo']['tmp_name'];
	//$image=addslashes(file_get_contents($_FILES['foundation_photo']['tmp_name']));
	//$image_name=addslashes($_FILES['foundation_photo']['name']);
	//$image_size=getimagesize($_FILES['foundation_photo']['tmp_name']);

	$foundation_country=preg_replace('#[^a-z ]#i', '', $_POST['foundation_country']);
	//$foundation_site=$_POST['foundation_site'];
	//$foundation_address=$_POST['foundation_address'];
	
	$foundation_description=htmlentities($_POST['foundation_description']);
	
	//$foundation_telephone1=preg_replace('/[^0-9]/', '', $_POST['foundation_telephone1']);
	//$foundation_telephone2=preg_replace('/[^0-9]/', '', $_POST['foundation_telephone2']);
	//$foundation_fax=preg_replace('/^[1-9][0-9]{0,15}$/', '', $_POST['foundation_fax']);
	
	$foundation_city=preg_replace('#[^a-z ]#i', '', $_POST['foundation_city']);
	$foundation_city = str_replace(" ", "+", $foundation_city);
    
    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$foundation_city&sensor=false&region=$foundation_country");
    $json = json_decode($json);
    $lat1 = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long1 = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

    //echo $foundation_name.'<br/>';
    //echo $foundation_email.'<br/>';
    //echo $foundation_password.'<br/>';
    //echo $foundation_repassword.'<br/>';
    //echo $foundation_photo.'<br/>';
    //echo $foundation_country.'<br/>';
    //echo $foundation_site.'<br/>';
    //echo $foundation_city.'<br/>';
    //echo $foundation_address.'<br/>';
    //echo $foundation_description.'<br/>';
    //echo $ip;
    //echo $foundation_telephone1.'<br/>';
    //echo $foundation_telephone2.'<br/>';
    //echo $foundation_fax.'<br/>';





//     $query = "SELECT id FROM foundations WHERE name='$foundation_name' LIMIT 1";
//     $result = mysqli_query($connect, $query); 
// 	$foundation_name_check = mysqli_num_rows($query);
// 	//--------------------------------------------


    // check if the email exist or not 

	$query = "SELECT id FROM foundations WHERE email='$foundation_email' LIMIT 1";
    $result_email = mysqli_query($connect, $query); 
	$result_email_check=mysqli_num_rows($query);
    
	 if($foundation_name==""||$foundation_email==""||$foundation_password==""
	 	||$foundation_repassword==""||$foundation_country==""||$foundation_city==""||
	 	$foundation_description=="")
 	{
 		$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'> The Registeration Form submission is missing values.</p>";
     	$_SESSION['message_error']=$message;
     	header("location: ../register.php");
 	}
 	else if($result_email_check>0)
    {
    	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'> The Email That You Entered is Alreay Taken.</p>";
     	$_SESSION['message_error']=$message;
     	header("location: ../register.php");
    }
     else if(is_numeric($foundation_name[0]))
     {
     	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>The Foundation  Name cannot begin with a Number.</p>";
     	$_SESSION['message_error']=$message;
     	header("location: ../register.php");
     
     }else if($foundation_password!=$foundation_password)
     {
     	$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>The Passwords  You Entered Dosenot Matched .</p>";
     	$_SESSION['message_error']=$message;
     	header("location: ../register.php");
     }else{
//     	// END FORM DATA ERROR HANDLING
// 	    // Begin Insertion of data into the database
// 		// Hash the password and apply your own mysterious unique salt
 		include_once ("../php_includes/rand.php");
 		//$p=crypt($password);
 		//$foundation_password= randStrGen(20)."$p".randStrGen(20);

 		//$foundation_password = better_crypt($foundation_password);

 		$query="INSERT INTO `foundations`(`name`, `email`, `password`, 
 		   `country`, `city`, `lat`, `log`, `description`,
 		  `signup_date`, `ip`, `last_login`, `note_check`) VALUES (\"$foundation_name\"
 		  ,\"$foundation_email\",\"$foundation_password\",'$foundation_country','$foundation_city','$lat1',
 		   '$long1',\"$foundation_description\",now(),'$ip',now(),now())";
 		$result_register=mysqli_query($connect,$query);

 		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
// 		if (!file_exists("foundations/$foundation_name")) {
// 			mkdir("foundations/$foundation_name", 0755);
// 		}


		if($result_register)
		{
			$message="<p style='color:#080; background-color:#fff; border-radius:10px; padding:20px;'>successful registeration ..</p>";
			// Email the user their activation link
			$to = "$foundation_email";							 
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
					<div style="padding:24px; font-size:17px;">Hello '.$foundation_name.',<br /><br />
						Click the link below to activate your account when ready:
						<br /><br />
					<a href="http://www.yoursitename.com/activation.php?">Click here to activate your account now</a>
					<br /><br />Login after successful activation using your:
					<br />* E-mail Address: <b>'.$foundation_email.'</b></div>
				</body>
			</html>

			';
			$headers = "From: $from\n";
	        $headers .= "MIME-Version: 1.0\n";
	        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
			if(mail($to, $subject, $message, $headers))
			{
				$message="<p style='color:#080; background-color:#fff; border-radius:10px; padding:20px;'>Successful Registeration .. check your Email to activate your account.<br/><a href='../root/index.php'>Click Here To Login </a></p>";
			}else{
				$message="<p style='color:#080; background-color:#fff; border-radius:10px; padding:20px;'>Successful Registeration .. <br/> but Your Activation Email has an Error.<a href='#'>Click here to Resend Your Activation Message.</a> <br/> <a href='../root/index.php'>Click Here To Login </a></p>";
			}

			$_SESSION['message_error']=$message;
			header("location: ../register.php");
		}else{
			$message="<p style='color:#080;'>registerration failed ...</p>";
			$_SESSION['message_error']=$message;
			header("location: ../register.php");
		}
     
	}
}
	else
	{
		$message="<p style='color:#ff0000; background-color:#fff; border-radius:10px; padding:20px;'>registerration failed ...</p>";
		$_SESSION['message_error']=$message;
		header("location: ../register.php");
	}

?>