<?php 
session_start();
include_once("../php_includes/connection_dp.php");
include_once("../php_includes/rand.php");
if(isset($_POST['old_password']) && !empty($_POST['old_password']) )
{
	$pass_input=$_POST['old_password'];
	$user_id=$_COOKIE['user_id'];
	$query="SELECT `password` FROM `users` WHERE id = '$user_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	$result=mysqli_fetch_assoc($perform_query);
	
	$hashed_password=cryptPass($result['password']);
	
	if(crypt($pass_input, $hashed_password) == $hashed_password )
	{
		// print updation fileds ..
		
		
		$update_form="	<form action=\"setting_p_changepassword_query.php\" id=\"update_changepassword_submit\" method=\"POST\" > 	
							<!-- update password field -->
							<div class=\"input-group new_password\">
							  <span class=\"input-group-addon\"><i class=\"fa fa-key fa-fw\"></i></span>
	  						  <input class=\"form-control\" type=\"password\" placeholder=\"Enter Your New Password\" 
	  						  id=\"update_password\" name=\"update_password\">
							</div>
							<!--error message -->
	                        <div class=\"error\" id=\"error_p_update_password\"><span>*Error testing</span></div>
							<!-- update repassword field -->
							<div class=\"input-group re_new_password\">
							  <span class=\"input-group-addon\"><i class=\"fa fa-key fa-fw\"></i></span>
	  						  <input class=\"form-control\" type=\"password\" placeholder=\"Re Enter Your New Password\"
	  						  id=\"update_repassword\" name=\"update_repassword\">
							</div>
							<!--error message -->
	                        <div class=\"error\" id=\"error_p_update_repassword\"><span>*Error testing</span></div>

							<button class=\"btn-block update_btn\" id=\"update_changepassword_button\" name=\"update_pass\">Update Password</button>
						</form>	";
		echo $update_form;
	}else{

		//error message

		echo "<span style=\"color:#ff0000;\">* Not Correct</span>"; 
	}
}


?>

<script type="text/javascript">

	/* change password setting validation*/
    
    $("#error_p_update_password").hide();
    $("#error_p_update_repassword").hide();

    var error_p_update_password=false;
    var error_p_update_repassword=false;
    

     $("#update_password").focusout(function(){
        check_person_update_password();
    });
    
    $("#update_repassword").focusout(function(){
       check_person_update_repassword();
    });

    $("#update_changepassword_submit").submit(function(){
        error_p_update_password=false;
        error_p_update_repassword=false;
        
        check_person_update_password();
        check_person_update_repassword();
        
        if( error_p_update_password==false && error_p_update_repassword==false)
        {
            return true;
        }else{
            return false;
        }
            
     
     });

    /* function change password page */
    function check_person_update_password()
    {
            var password_length = $("#update_password").val().length;   
            if(password_length<8)
                {
                    $("#error_p_update_password span").html("* At least 8 characters");
                    $("#error_p_update_password").show();
                    error_p_update_password=true;
                }else{
                    $("#error_p_update_password").hide();
                }

    }

    function check_person_update_repassword()
    {
        var password=$("#update_password").val();
        var retype_password=$("#update_repassword").val();

        if(password != retype_password)
            {
                $("#error_p_update_repassword span").html("* Password don't match..");
                $("#error_p_update_repassword").show();
                error_p_update_repassword=true;
            }else{
                $("#error_p_update_repassword").hide();         
            } 
    }   


</script>