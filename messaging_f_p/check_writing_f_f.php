<?php
include_once("../php_includes/connection_dp.php");
$fid=mysqli_real_escape_string($connect,$_POST['fid']);
$my_id=$_COOKIE['foundation_id'];
$query_check_writing="SELECT `status` FROM `writing_status_f_f` WHERE `foundation_from`='$fid' AND `foundation_to`='$my_id' LIMIT 1";
$perform_query=mysqli_query($connect,$query_check_writing);
if(mysqli_num_rows($perform_query)==1)
{
	// print the loading animation
	echo 
	"
		<div class=\"load-wrapp\">
	            <div class=\"load-3\">
	                <div class=\"line\"></div>
	                <div class=\"line\"></div>
	                <div class=\"line\"></div>
	            </div>
	       	</div>
		</div>
	";
	
	
}else{
	// nothing to do
	
}

?>
