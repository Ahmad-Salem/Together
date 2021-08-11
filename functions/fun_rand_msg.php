<?php
	include_once("../php_includes/connection_dp.php");

	
	function generate_rand_p_p()
	{
		global $connect;
		$query_p_p="SELECT `id`,`rand_no` FROM `rand_p_p` ORDER BY id DESC LIMIT 1";
		$perform_query=mysqli_query($connect,$query_p_p);
		
		$result_p_p=mysqli_fetch_assoc($perform_query);

		$hash=$result_p_p['rand_no']+1;
		
		$query_p_p_insert="INSERT INTO `rand_p_p`(`rand_no`) VALUES ('$hash') ";

		$perform_query=mysqli_query($connect,$query_p_p_insert);

		return $result_p_p['rand_no'];
	}

	function generate_rand_f_f()
	{
		global $connect;
		$query_f_f="SELECT `id`,`rand_no` FROM `rand_p_p` ORDER BY id DESC LIMIT 1";
		$perform_query=mysqli_query($connect,$query_f_f);
		
		$result_f_f=mysqli_fetch_assoc($perform_query);

		$hash=$result_f_f['rand_no']+1;
		
		$query_f_f_insert="INSERT INTO `rand_f_f`(`rand_no`) VALUES ('$hash') ";

		$perform_query=mysqli_query($connect,$query_f_f_insert);

		return $result_f_f['rand_no'];
	}

	function format($date)
	{	return date('g:i a' , strtotime($date)); } 

?>