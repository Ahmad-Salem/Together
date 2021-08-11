<?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["email"]))
{
	include_once("../php_includes/connection_dp.php");
	$Email = mysqli_real_escape_string($connect, $_POST['email']);
	
	
    $sqlemail = "SELECT id FROM foundations WHERE email='$Email' LIMIT 1";
    
    
    $queryemail = mysqli_query($connect, $sqlemail); 
     
    
    $email_check = mysqli_num_rows($queryemail);
    
    
    
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<span>*Invalid email format</span>";
        exit();
    }
	     
        
    if ($email_check < 1) {
	    echo '<span>' . $Email . ' is OK</span>';
	    exit();
    } else {
	    echo '<span>' . $Email . ' is taken</span>';
	    exit();
    }
        
}
?>