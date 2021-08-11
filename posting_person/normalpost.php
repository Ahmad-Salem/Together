<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	// echo $_POST['caption_normal'];
	if($_POST['caption_normal']!='' || $_FILES['image']['tmp_name'][0]!=null)
    {
    	if($_POST['caption_normal']!='')
    	{
    		$caption_normal=$_POST['caption_normal'];	
    	}else
    	{
    		$caption_normal='';
    	}
    	
    	
    		
    		if($_FILES['image']['tmp_name'][0]!=null)
    		{
    			// Number of uploaded files
        		$num_files = count($_FILES['image']['tmp_name']);	
    		
    		}else
    		{
    			$num_files=0;
    		}
    		
        
        
        

        $photo=false;

        if($_COOKIE['Account_type']=='person')
       	{

       		if($_POST['caption_normal']=='' && $_FILES['image']['tmp_name'][0]==null)
       		{
       			// failed uploading post
                $_SESSION['Success_Photo_check']="false";
                $message="ERROR: Please Write any caption or upload a photo.";
                $_SESSION['message_post']=$message;
                header("location: ../Main.php");
       		}else
       		{
       			//queries for person
				$user_id=$_COOKIE['user_id'];
				$caption_p=mysqli_real_escape_string($connect,$_POST['caption_normal']);
	       		$query_post_p="INSERT INTO `normal_posts`(`account_id`, `account_type`,`caption`) VALUES ('$user_id','p','$caption_p')";
				$perform_caption_query=mysqli_query($connect,$query_post_p);
				$post_id=mysqli_insert_id($connect);
				

				$user_id=$_COOKIE['user_id'];
	    		$folder_name=$user_id;

				if (!file_exists("../postingattachment/user/$folder_name")) {
						mkdir("../postingattachment/user/$folder_name", 0755);
						mkdir("../postingattachment/user/$folder_name/$post_id", 0755);
					}else
					{
						mkdir("../postingattachment/user/$folder_name/$post_id", 0755);
					
					}
       		}
       				
       		
			
       	}
       else
       {
       		

       		if($_POST['caption_normal']=='' && $_FILES['image']['tmp_name'][0]==null)
       			{
       				// failed uploading post
	                $_SESSION['Success_Photo_check']="false";
	                $message="ERROR: Please Write any caption or upload a photo.";
	                $_SESSION['message_post']=$message;
	                header("location: ../Main.php");
       			}else
	       		{

	       			//queries for foundation
					$foundation_id=$_COOKIE['foundation_id'];
					$caption_f=mysqli_real_escape_string($connect,$_POST['caption_normal']);
			       	$query_post_f="INSERT INTO `normal_posts`(`account_id`, `account_type`,`caption`) VALUES ('$foundation_id','f','$caption_f')";
					$perform_caption_query_f=mysqli_query($connect,$query_post_f);
					$post_id=mysqli_insert_id($connect);
					

					$foundation_id=$_COOKIE['foundation_id'];
		    		$folder_name=$foundation_id;
					if (!file_exists("../postingattachment/foundation/$folder_name")) {
							mkdir("../postingattachment/foundation/$folder_name", 0755);
							mkdir("../postingattachment/foundation/$folder_name/$post_id", 0755);
						}else
						{
							mkdir("../postingattachment/foundation/$folder_name/$post_id", 0755);
						}	
	       		}
       				
       		
			
       }

        
       	if($_FILES['image']['tmp_name'][0]!=null)
       	{
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
	                $_SESSION['Success_Photo_check']="false";
	                $message=" ERROR: Please browse for a file before clicking the upload button.";
	                $_SESSION['message_post']=$message;
	                header("location: ../Main.php");
	            }
	             else if($fileSize > 20242880) 
	             { 
	                // if file size is larger than 5 Megabytes
	                $_SESSION['Success_Photo_check']="false";
	                $message="ERROR: Your file was larger than 5 Megabytes in size.";
	                $_SESSION['message_post']=$message;
	                unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	                header("location: ../Main.php");

	            } 
	            else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) )
	             {
	                
	                // This condition is only if you wish to allow uploading of specific file types    
	                $_SESSION['Success_Photo_check']="false";
	                $message=" ERROR: Your image was not .gif, .jpg, or .png.";
	                $_SESSION['message_post']=$message;
	                unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	                header("location: ../Main.php");
	            } 
	            else if ($fileErrorMsg == 1)
	             { 
	                // if file upload error key is equal to 1
	                $_SESSION['Success_Photo_check']="false";
	                $message=" ERROR: An error occured while processing the file. Try again.";
	                $_SESSION['message_post']=$message;
	                header("location: ../Main.php");
	            }
	            

	            if($_COOKIE['Account_type']=='person')
	            {
	            	echo $_FILES['image']['tmp_name'][$i],"../postingattachment/user/$folder_name/$post_id/".$fileName;
	            	/*move the uploaded photos*/
		            $moveResult = @copy($_FILES['image']['tmp_name'][$i],"../postingattachment/user/$folder_name/$post_id/".$fileName);
		
	            }else
	            {
	            	/*move the uploaded photos*/
	            	$moveResult = @copy($_FILES['image']['tmp_name'][$i], "../postingattachment/foundation/$folder_name/$post_id/".$_FILES['image']['name'][$i]);

	            }
	            


				// Check to make sure the move result is true before continuing
				if ($moveResult != true) {
				    $_SESSION['Success_Photo_check']="false";
				    $message=" ERROR: File not uploaded. Try again.";
					$_SESSION['message_post']=$message;
				    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				    header("location: ../Main.php");
				}else{

					if($_COOKIE['Account_type']=='person')
						{
							$photo_name=$_FILES['image']['name'][$i];
													
							$query_photos_p="INSERT INTO `normal_post_images`(`account_id`, `account_type`, `images`, `post_id`) VALUES ('$user_id', 'p','$photo_name','$post_id')";
							$perform_photo_query=mysqli_query($connect,$query_photos_p);
							
							if($perform_photo_query)
							{
								$photo=true;
							}
						}
						else
						{
							//queries for foundation
							
							$foundation_id=$_COOKIE['foundation_id'];
							$photo_name=$_FILES['image']['name'][$i];
							$caption_f=mysqli_real_escape_string($connect, $_POST['caption_normal']);						
							$query_photos_f="INSERT INTO `normal_post_images`(`account_id`, `account_type`, `images`, `post_id`) VALUES ('$foundation_id', 'f','$photo_name','$post_id')";
							$perform_photo_query_f=mysqli_query($connect,$query_photos_f);
							
							//check if this caption is already exists
							
								
							if($perform_photo_query_f)
							{
								$photo=true;
							}	

						}
				}

			   
	        }

	       	if($_COOKIE['Account_type']=="person")
	       	{
	       		if($photo && $perform_caption_query)
				{
					$_SESSION['Success_Photo_check']="true";
			    	$message="Successful uploading Your Post";
					$_SESSION['message_post']=$message;
					unlink($fileTmpLoc); 
					header("location: ../Main.php");
				}
	       	}else
	       	{
	       		//foundation
	       		if($photo && $perform_caption_query_f)
				{
					$_SESSION['Success_Photo_check']="true";
			    	$message="Successful uploading Your Post";
					$_SESSION['message_post']=$message;
					unlink($fileTmpLoc); 
			    	header("location: ../Main.php");	
				}
	       		
	       	}
       	}else
       	{
       		if($_POST['caption_normal']!='' && $_FILES['image']['tmp_name'][0]==null)
       		{
       			//success to upload 
     			$_SESSION['Success_Photo_check']="true";
		    	$message="Successful uploading Your Post";
				$_SESSION['message_post']=$message;
				unlink($fileTmpLoc); 
		    	header("location: ../Main.php");
       		}else if($_POST['caption_normal']=='' && $_FILES['image']['tmp_name'][0]!=null)
       		{
       			//success to upload 
     			$_SESSION['Success_Photo_check']="true";
		    	$message="Successful uploading Your Post";
				$_SESSION['message_post']=$message;
				unlink($fileTmpLoc); 
		    	header("location: ../Main.php");
       			
       		}else if($_POST['caption_normal']!='' && $_FILES['image']['tmp_name'][0]!=null)
       		{
       			//success to upload 
     			$_SESSION['Success_Photo_check']="true";
		    	$message="Successful uploading Your Post";
				$_SESSION['message_post']=$message;
				unlink($fileTmpLoc); 
		    	header("location: ../Main.php");
       		}else
       		{
       			//failed to upload 
       			$_SESSION['Success_Photo_check']="false";
			    $message=" ERROR: File not uploaded. Try again.";
				$_SESSION['message_post']=$message;
			    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    header("location: ../Main.php");
       		}
       	}
       					
    }
    else
    {
    	$_SESSION['Success_Photo_check']="false";
	    $message="ERROR: Please Write any caption or upload a photo.";
		$_SESSION['message_post']=$message;
	    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	    header("location: ../Main.php");
    }

?>