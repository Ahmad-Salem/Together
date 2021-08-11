<?php
//start session
session_start();
include_once("../php_includes/connection_dp.php");
include_once("../php_includes/rand.php");
if( isset($_POST['login_submit']) )
{

	$Email=mysqli_real_escape_string($connect, $_POST['login_email']);
	//$Email=preg_replace('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+.[A-Za-z]{2,4}$/', '', $Email);
	
	$password=$_POST['login_password'];

	if($_POST['account_type']=="person")
	{
		// if the account type is person
		$query="SELECT id, first_name , last_name , password , gender FROM users WHERE email='$Email' AND `user_level`='d' LIMIT 1 ";
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
			$user_gender=$row['gender'];
			//setting password
	 		// $p=crypt($password);
	 		// $password= randStrGen(20)."$p".randStrGen(20);

	 		// checking for password
	 		// echo $password.'<br/>';
	 		// echo $user_password;
	 		
	 		$hashed_password=cryptPass($user_password);
	 		
	 		if(crypt($password, $hashed_password) == $hashed_password )
	 		{
	 			$_SESSION['user_id']=$user_id;
	 			$_SESSION['user_first_name']=$user_first_name;
	 			$_SESSION['user_last_name']=$user_last_name;
	 			$_SESSION['user_password']=$user_password;
	 			$_SESSION['user_gender']=$user_gender;
	 			$_SESSION['Message_login']="welcome";
	 			$_SESSION['Account_type']=$_POST['account_type'];
	 			//setting cookie for person

	 			setcookie("user_id", $user_id, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("user_first_name", $user_first_name, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("user_last_name", $user_last_name, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("user_password", $user_password, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("user_gender", $user_gender, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("Message_login", "welcome", strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("Account_type", $_POST['account_type'], strtotime( '+30 days' ), "/", "", "", TRUE);

	 			// GET USER IP ADDRESS
    			$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	 			//update login time for last login
	 			$query="UPDATE users SET ip='$ip', last_login=now() WHERE id='$user_id' LIMIT 1";
	 			$perform_update_time=mysqli_query($connect,$query);
	 			

	 			if($perform_update_time==true)
	 				{
	 					header("location: ../Controller/index.php");	
	 				}else{
	 					$message="<div class=\"Error_login\"><span class=\"mainerror\">Login Failed..</span></div>";
 						$_SESSION['Message_login']=$message;
 						header("location: ../login_panel.php");
	 				}
	 				

	 		}else{

	 		$message="<div class=\"Error_login\"><span class=\"mainerror\">Wrong Password</span></div>";
 			$_SESSION['Message_login']=$message;
 			header("location: ../panel_check.php");		
	 		}

 		}else{
 			$message="<div class=\"Error_login\"><span class=\"mainerror\">Invalid  Email </span></div>";
 			$_SESSION['Message_login']=$message;
 			header("location: ../panel_check.php");
 		}
 	
 		//end check person email

		
	}
	//type foundation 
	else if($_POST['account_type']=="foundation"){

		// if the account type is foundation
		$query="SELECT id, name, password FROM foundations WHERE email='$Email' AND `user_level`='d'  LIMIT 1";
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
				//setting password
	 			// $p=crypt($password);
	 			// $password= randStrGen(20)."$p".randStrGen(20);
	 			
	 			// checking for password
	 			// echo $password.'<br/>';
	 			// echo $foundation_password;
				$hashed_password=cryptPass($foundation_password);


	 		if(crypt($password, $hashed_password) == $hashed_password)
	 		{
	 			$_SESSION['foundation_id']=$foundation_id;
	 			$_SESSION['foundation_name']=$foundation_name;
	 			$_SESSION['foundation_password']=$foundation_password;
	 			$_SESSION['Message_login']="welcome";
	 			$_SESSION['Account_type']=$_POST['account_type'];
				
	 			//setting cookie for foundation

	 			setcookie("foundation_id", $foundation_id, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("foundation_name", $foundation_name, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("foundation_password", $foundation_password, strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("Message_login", "welcome", strtotime( '+30 days' ), "/", "", "", TRUE);
	 			setcookie("Account_type", $_POST['account_type'], strtotime( '+30 days' ), "/", "", "", TRUE);
				// GET USER IP ADDRESS
    			$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	 			//update login time for last login
	 			$query="UPDATE foundations SET ip='$ip', last_login=now() WHERE id='$foundation_id' LIMIT 1";
	 			$perform_update_time=mysqli_query($connect,$query);
	 			
	 			if($perform_update_time==true)
	 				{
	 					header("location: ../Controller/index.php");	
	 				}else{
	 					$message="<div class=\"Error_login\"><span class=\"mainerror\">Login Failed..</span></div>";
 						$_SESSION['Message_login']=$message;
 						header("location: ../login_panel.php");
	 				}

	 			

	 		}else{

	 		$message="<div class=\"Error_login\"><span class=\"mainerror\">Wrong Password</span></div>";
 			$_SESSION['Message_login']=$message;
 			header("location: ../panel_check.php");		
	 		}


			}
		else{

			$message="<div class=\"Error_login\"><span class=\"mainerror\">Invalid  Email </span></div>";
 			$_SESSION['Message_login']=$message;
 			header("location: ../panel_check.php");	
		}
		//ending checking foundation email
	}
	else{
			$message="<div class=\"Error_login\"><span class=\"mainerror\">Login Failed</span></div>";
 			$_SESSION['Message_login']=$message;
 			header("location: ../panel_check.php");
	}

}else{
	echo 'not oki';
}

?>