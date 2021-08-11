<?php 
session_start();
include_once("../php_includes/connection_dp.php");
include_once("../php_includes/rand.php");
if(isset($_POST['old_password']) && !empty($_POST['old_password']) )
{
	$pass_input=$_POST['old_password'];
	$foundation_id=$_COOKIE['foundation_id'];
	$query="SELECT `password` FROM `foundations` WHERE id = '$foundation_id' LIMIT 1";
	$perform_query=mysqli_query($connect,$query);
	$result=mysqli_fetch_assoc($perform_query);
	
	$hashed_password=cryptPass($result['password']);
	
	if(crypt($pass_input, $hashed_password) == $hashed_password )
	{
		// print updation fileds ..
		
		
		$update_form="
				<form action=\"setting_f_changepassword_query.php\" method=\"POST\" id=\"change_pass_foundation_sub\">
						

							<div class=\"input-group new_password_f\">
							  <span class=\"input-group-addon\"><i class=\"fa fa-key fa-fw\"></i></span>
	  						  <input class=\"form-control\" type=\"password\" placeholder=\"Enter Your New Password\" id=\"foundation_pass\"
                              name=\"update_pass_f_new\"/>
							</div>
							
							<!--error message -->
                            <div class=\"error\" id=\"error_f_pass\"><span>*Error testing</span></div>
							
							<div class=\"input-group re_new_password_f\">
							  <span class=\"input-group-addon\"><i class=\"fa fa-key fa-fw\"></i></span>
	  						  <input class=\"form-control\" type=\"password\" name=\"update_pass_f_re_new\" placeholder=\"Re Enter Your New Password\" id=\"foundation_repass\"/>
							</div>
							
							<!--error message -->
                            <div class=\"error\" id=\"error_f_repass\"><span>*Error testing</span></div>
							
							<button class=\"btn-block update_btn_f\" name=\"update_pass_f\" >Update Password</button>

											
					</form>
		";
		echo $update_form;
	}else{

		//error message

		echo "<span style=\"color:#ff0000; margin-left:10%;\">* Not Correct</span>"; 
	}
}


?>
<script type="text/javascript">
/* change password setting validation*/

    $("#error_f_pass").hide();
    $("#error_f_repass").hide();
    
    var error_f_pass=false;
    var error_f_repass=false;
    
     $("#foundation_pass").focusout(function(){
        check_foundation_update_password();
	});
    
    $("#foundation_repass").focusout(function(){
       check_foundation_update_repassword();
	});

    $("#change_pass_foundation_sub").submit(function(){
    	error_f_pass=false;
    	error_f_repass=false;
        
        check_foundation_update_password();
        check_foundation_update_repassword();
     
        
        if( error_f_pass==false && error_f_repass==false)
        {
            return true;
        }else{
            return false;
        }
            
     
 });

    /* function change password page */
    function check_foundation_update_password()
    {
        	var password_length=$("#foundation_pass").val().length;
            if(password_length<8)
                {
                    $("#error_f_pass span").html("* At least 8 characters");
                    $("#error_f_pass").show();
                    error_f_pass=true;
                }else{
                    $("#error_f_pass").hide();

                }

    }
    
    function check_foundation_update_repassword()
    {
        var password=$("#foundation_pass").val();
        var retype_password=$("#foundation_repass").val();

        if(password != retype_password)
            {
                $("#error_f_repass span").html("* Password don't match..");
                $("#error_f_repass").show();
                error_f_repass=true;
            }else{
                $("#error_f_repass").hide();			
            } 
    }

</script>