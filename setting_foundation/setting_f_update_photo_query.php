<?php
session_start();
include_once("../php_includes/connection_dp.php");	

	$foundation_id=$_COOKIE['foundation_id'];
	$query="SELECT `name` FROM `foundations` WHERE id='$foundation_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	$result=mysqli_fetch_assoc($perform_query);
	if($perform_query)
	{
		//success geting the person name

		$fileName = $_FILES["image_foundation"]["name"]; // The file name
		$fileTmpLoc = $_FILES["image_foundation"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["image_foundation"]["type"]; // The type of file it is
		$fileSize = $_FILES["image_foundation"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["image_foundation"]["error"]; // 0 = false | 1 = true
		
		$folder_name=$foundation_id;
		if (!file_exists("../foundations/$folder_name")) {
				mkdir("../foundations/$folder_name", 0755);
			}


		$kaboom = explode(".", $fileName); // Split file name into an array using the dot
		$fileExt = end($kaboom); // Now target the last array element to get the file extension
		// START PHP Image Upload Error Handling --------------------------------------------------
		if (!$fileTmpLoc) 
		{ 
			// if file not chosen
		    $_SESSION['Success_Photo_check_f']="false";
		    $message=" ERROR: Please browse for a file before clicking the upload button.";
			$_SESSION['message_f_add_photo']=$message;
			header("location: setting_f_update_photo.php");
		}
		 else if($fileSize > 5242880) 
		 { 
		 	// if file size is larger than 5 Megabytes
		    $_SESSION['Success_Photo_check_f']="false";
		    $message="ERROR: Your file was larger than 5 Megabytes in size.";
			$_SESSION['message_f_add_photo']=$message;
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			header("location: setting_f_update_photo.php");

		} 
		else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) )
		 {
		    
		    // This condition is only if you wish to allow uploading of specific file types    
		    $_SESSION['Success_Photo_check_f']="false";
		    $message=" ERROR: Your image was not .gif, .jpg, or .png.";
			$_SESSION['message_f_add_photo']=$message;
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			header("location: setting_f_update_photo.php");
		} 
		else if ($fileErrorMsg == 1)
		 { 
		 	// if file upload error key is equal to 1
		    $_SESSION['Success_Photo_check_f']="false";
		    $message=" ERROR: An error occured while processing the file. Try again.";
			$_SESSION['message_f_add_photo']=$message;
		    header("location: setting_f_update_photo.php");
		}
		

		// END PHP Image Upload Error Handling ----------------------------------------------------
		// Place it into your "uploads" folder mow using the move_uploaded_file() function
		
		$moveResult = move_uploaded_file($fileTmpLoc, "../foundations/$folder_name/$fileName");
		// Check to make sure the move result is true before continuing
		if ($moveResult != true) {
		    $_SESSION['Success_Photo_check_f']="false";
		    $message=" ERROR: File not uploaded. Try again.";
			$_SESSION['message_f_add_photo']=$message;
		    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    header("location: setting_f_update_photo.php");
		}else{

			$query_image="UPDATE `foundations` SET `photo`='$fileName',`photo_value`='$fileSize' WHERE id='$foundation_id' ";
			$perform_query_image=mysqli_query($connect,$query_image);
			if($perform_query_image)
			{

				$_SESSION['Success_Photo_check_f']="true";
		    	$message="Successful uploading Your Image";
				$_SESSION['message_f_add_photo']=$message;
				unlink($fileTmpLoc); 
		    	header("location: setting_f_update_photo.php");

			}else{
				$_SESSION['Success_Photo_check_f']="false";
		    	$message=" Update Failed :( ..";
				$_SESSION['message_f_add_photo']=$message;
				unlink($fileTmpLoc); 
		    	header("location: setting_f_update_photo.php");	
			}

			
		}

		unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		

		// Display things to the page so you can see what is happening for testing purposes
		echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
		echo "It is <strong>$fileSize</strong> bytes in size.<br /><br />";
		echo "It is an <strong>$fileType</strong> type of file.<br /><br />";
		echo "The file extension is <strong>$fileExt</strong><br /><br />";
		echo "The Error Message output for this upload is: $fileErrorMsg";	


	}else{
		//error occured
		$_SESSION['Success_Photo_check_f']="false";
		$message=" Update Failed :( ..";
		$_SESSION['message_f_add_photo']=$message;
		header('location: setting_f_update_photo.php');
	}

	
?>