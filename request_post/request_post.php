<?php
	include_once("../php_includes/connection_dp.php");
	include_once('../functions/check_login.php');

		
		// &&isset($_FILES['image']['tmp_name'])

	
if(isset($_POST['request_type_value'])&&isset($_POST['child_name_value'])
	&&isset($_POST['child_age_value'])&&isset($_POST['child_tall_value'])
	&&isset($_POST['child_skin_value'])&&isset($_POST['child_eye_value'])
	&&isset($_POST['child_hair_value'])&&isset($_POST['child_country_value'])
	&&isset($_POST['child_story_value'])&&isset($_POST['child_status_value'])
	&&isset($_POST['child_contact_ways_value'])&&isset($_POST['child_relation_ways_value'])
	&&isset($_FILES['image']['tmp_name']))
	{
		
		// Number of uploaded files
        $num_files = count($_FILES['image']['tmp_name']);	
		$request_type_value=mysqli_real_escape_string($connect,$_POST['request_type_value']);
		$child_name_value=mysqli_real_escape_string($connect,$_POST['child_name_value']);
		$child_age_value=mysqli_real_escape_string($connect,$_POST['child_age_value']);
		$child_tall_value=mysqli_real_escape_string($connect,$_POST['child_tall_value']);
		$child_skin_value=mysqli_real_escape_string($connect,$_POST['child_skin_value']);
		$child_eye_value=mysqli_real_escape_string($connect,$_POST['child_eye_value']);
		$child_hair_value=mysqli_real_escape_string($connect,$_POST['child_hair_value']);
		$child_lastSeen_value=mysqli_real_escape_string($connect,$_POST['child_last_seen']);
		$child_country_value=mysqli_real_escape_string($connect,$_POST['child_country_value']);
		$child_story_value=mysqli_real_escape_string($connect,$_POST['child_story_value']);
		$child_status_value=mysqli_real_escape_string($connect,$_POST['child_status_value']);
		$child_contact_ways_value=mysqli_real_escape_string($connect,$_POST['child_contact_ways_value']);
		$child_relation_ways_value=mysqli_real_escape_string($connect,$_POST['child_relation_ways_value']);
		$photo=true;
		
		if($_COOKIE['Account_type']=="person")
		{
			$account_id=$_COOKIE['user_id'];
			$account_type="p";

			$query_request_post="INSERT INTO `request_post`(`account_id`, `account_type`, `child_name`, `age`, `tall`, `skin_color`, `country`, `hair_color` , `lastSeen` , `description_lost_found`, `eye_color`, `description_contact`, `description_relation_with_child`, `description_child_status`, `request_type`) 
			VALUES ('$account_id','$account_type','$child_name_value','$child_age_value','$child_tall_value','$child_skin_value','$child_country_value','$child_hair_value', '$child_lastSeen_value' ,'$child_story_value','$child_eye_value','$child_contact_ways_value','$child_relation_ways_value','$child_status_value','$request_type_value')";
			$perfrom_request_post=mysqli_query($connect,$query_request_post);
			$post_id=mysqli_insert_id($connect);

			$folder_name=$account_id;
			if (!file_exists("../request_post_attachment/user/$folder_name")) {
					mkdir("../request_post_attachment/user/$folder_name", 0755);
					mkdir("../request_post_attachment/user/$folder_name/$post_id", 0755);
				}else
				{
					mkdir("../request_post_attachment/user/$folder_name/$post_id", 0755);
				
				}

		}else
		{
			//foundation request post configuration
			$account_id=$_COOKIE['foundation_id'];
			$account_type="f";
			
			$query_request_post="INSERT INTO `request_post`(`account_id`, `account_type`, `child_name`, `age`, `tall`, `skin_color`, `country`, `hair_color`, `lastSeen` , `description_lost_found`, `eye_color`, `description_contact`, `description_relation_with_child`, `description_child_status`, `request_type`) 
			VALUES ('$account_id','$account_type','$child_name_value','$child_age_value','$child_tall_value','$child_skin_value','$child_country_value','$child_hair_value', '$child_lastSeen_value' ,'$child_story_value','$child_eye_value','$child_contact_ways_value','$child_relation_ways_value','$child_status_value','$request_type_value')";
			$perfrom_request_post=mysqli_query($connect,$query_request_post);
			$post_id=mysqli_insert_id($connect);

			$folder_name=$account_id;
			if (!file_exists("../request_post_attachment/foundation/$folder_name")) {
					mkdir("../request_post_attachment/foundation/$folder_name", 0755);
					mkdir("../request_post_attachment/foundation/$folder_name/$post_id", 0755);
				}else
				{
					mkdir("../request_post_attachment/foundation/$folder_name/$post_id", 0755);
				
				}

		}

		/** loop through the array of files ***/
        for($i=0; $i < $num_files;$i++)
        {
        	$fileName = $_FILES["image"]["name"][$i]; // The file name
            $fileTmpLoc = $_FILES["image"]["tmp_name"][$i]; // File in the PHP tmp folder
            $fileType = $_FILES["image"]["type"][$i]; // The type of file it is
            $fileSize = $_FILES["image"]["size"][$i]; // File size in bytes
            $fileErrorMsg = $_FILES["image"]["error"][$i]; // 0 = false | 1 = true
            
            $kaboom = explode(".", $fileName); // Split file name into an array using the dot
            $fileExt = end($kaboom); // Now target the last array element to get the file extension

            // START PHP Image Upload Error Handling --------------------------------------------------
            if (!$fileTmpLoc) 
            { 
                // if file not chosen
                $_SESSION['Success_Photo_check_request']="false";
                $message=" ERROR: Please browse for a file before clicking the upload button.";
                $_SESSION['message_post_request']=$message;
                header("location: ../Main.php");
            }
             else if($fileSize > 20242880) 
             { 
                // if file size is larger than 5 Megabytes
                $_SESSION['Success_Photo_check_request']="false";
                $message="ERROR: Your file was larger than 5 Megabytes in size.";
                $_SESSION['message_post_request']=$message;
                unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
                header("location: ../Main.php");

            } 
            else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) )
             {
                
                // This condition is only if you wish to allow uploading of specific file types    
                $_SESSION['Success_Photo_check_request']="false";
                $message=" ERROR: Your image was not .gif, .jpg, or .png.";
                $_SESSION['message_post_request']=$message;
                unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
                header("location: ../Main.php");
            } 
            else if ($fileErrorMsg == 1)
             { 
                // if file upload error key is equal to 1
                $_SESSION['Success_Photo_check_request']="false";
                $message=" ERROR: An error occured while processing the file. Try again.";
                $_SESSION['message_post_request']=$message;
                header("location: ../Main.php");
            }


            if($_COOKIE['Account_type']=='person')
            {
            	/*move the uploaded photos*/
	            $moveResult = @copy($_FILES['image']['tmp_name'][$i],"../request_post_attachment/user/$folder_name/$post_id/".$_FILES['image']['name'][$i]);
	
            }else
            {
            	/*move the uploaded photos*/
            	$moveResult = @copy($_FILES['image']['tmp_name'][$i], "../request_post_attachment/foundation/$folder_name/$post_id/".$_FILES['image']['name'][$i]);

            }

            // Check to make sure the move result is true before continuing
			if ($moveResult != true) {
			    $_SESSION['Success_Photo_check_request']="false";
			    $message=" ERROR: File not uploaded. Try again.";
				$_SESSION['message_post_request']=$message;
			    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    header("location: ../Main.php");
			}else{
				//sucess uploaded file
				$photo_name=$_FILES['image']['name'][$i];
												
				$query_photos="INSERT INTO `request_post_images`(`request_id`, `image`) VALUES ('$post_id','$photo_name')";
				$perform_photo_query=mysqli_query($connect,$query_photos);
				
				if($perform_photo_query)
				{
					$photo=true;
				}
			}

         //end of for loop   
        }



		
        if($photo && $perfrom_request_post)
			{
				$_SESSION['Success_Photo_check_request']="true";
		    	$message="Successful uploading Your Post";
				$_SESSION['message_post_request']=$message;
				unlink($fileTmpLoc); 
				header("location: ../Main.php");
			}


		

		


		
		

	}else{
		//error in setting values...
		$_SESSION['Success_Photo_check_request']="false";
	    $message=" ERROR: File not uploaded. Try again.";
		$_SESSION['message_post_request']=$message;
	    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	    header("location: ../Main.php");
	}

echo $message;
?>