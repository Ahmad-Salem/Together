<?php
session_start();
include_once("../php_includes/connection_dp.php");
$my_account_id=$_COOKIE['foundation_id'];
$account_id=$_POST['account_id'];
$action=$_POST['action'];

if($action=='trust')
{
	$query_trust="INSERT INTO `following`(`account_followed_id`, `account_followed_type`,`account_following_id`, `account_following_type`) VALUES ('$my_account_id','f','$account_id','p')";
	$perfrom_query_trust=mysqli_query($connect,$query_trust);
	
	if($perfrom_query_trust)
	{
		echo "<button id=\"f_p_action_untrust\" class=\"trust_btn\">Un Trust</button>";
		
	}else
	{
		// pop up should appear to notify user that the trusting action not actually happened
	}
	
}

if($action=='untrust')
{
	$query_untrust="DELETE FROM `following` WHERE `account_followed_id`='$my_account_id' AND `account_followed_type`='f' AND `account_following_id`='$account_id' AND `account_following_type`='p' LIMIT 1 ";
	$perfrom_query_untrust=mysqli_query($connect,$query_untrust);
	if($perfrom_query_untrust)
	{
		echo "<button id=\"f_p_action_trust\" class=\"trust_btn\"> Trust</button>";	
	}else
	{
		// pop up should appear to notify user that the Untrusting action not actually happened	
	}
	
}

?>
<script type="text/javascript">
    /* foundation - person following */
    $("#f_p_action_trust").click(function(){
    
        
         check_foundation_person_following_ajax();
    });

    $("#f_p_action_untrust").click(function(){

        
         check_foundation_person_unfollowing_ajax();
        
       
    });    

function check_foundation_person_following_ajax(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var account_id=$("#account_id").val();
        var url = "../following/action_f_p.php";
        var vars = "account_id="+account_id+"&action=trust";
        
        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         
         // Access the onreadystatechange event for the XMLHttpRequest object
         hr.onreadystatechange = function() {
        
         if(hr.readyState == 4 && hr.status == 200) {
        
             var return_data = hr.responseText;
             $("#follow_button").html(return_data);
                      
         }else{

         }
   
         }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        
    }

    function check_foundation_person_unfollowing_ajax(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var account_id=$("#account_id").val();
        var url = "../following/action_f_p.php";
        var vars = "account_id="+account_id+"&action=untrust";

        
        hr.open("POST", url, true);
        
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         
         // Access the onreadystatechange event for the XMLHttpRequest object
         hr.onreadystatechange = function() {
        
         if(hr.readyState == 4 && hr.status == 200) {
        
             var return_data = hr.responseText;
                
             $("#follow_button").html(return_data);
                      
         }else{
            
         }
   
         }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        
    }

</script>