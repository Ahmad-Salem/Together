<?php
	include_once('../functions/check_login.php');
	include_once("../php_includes/connection_dp.php");
	include_once("../functions/date_time.php");

	$query_active_foundation="SELECT `id` FROM `foundations` WHERE `activated`='1' ";
	$perform_query_active_foundation=mysqli_query($connect,$query_active_foundation);
	echo mysqli_num_rows($perform_query_active_foundation);


?>