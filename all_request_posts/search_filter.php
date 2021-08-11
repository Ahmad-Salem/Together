<?php
	include_once("../php_includes/connection_dp.php");
	include_once('../functions/check_login.php');

	if(isset($_POST['filter_name_search']))
	{
		$name_search=$_POST['filter_name_search'];
		
		$query_search_filter_result="SELECT `id`, `account_id`, `account_type`, `child_name`  FROM `request_post` WHERE  request_post.child_name LIKE '%$name_search%'  ";
		$perform_query_search_filter_result=mysqli_query($connect,$query_search_filter_result);		
		while($result_filter_search=mysqli_fetch_assoc($perform_query_search_filter_result))
		{
			$request_id=$result_filter_search['id'];
			$account_id=$result_filter_search['account_id'];
			$account_type=$result_filter_search['account_type'];
			$child_name=$result_filter_search['child_name'];
			
			$query_request_main_img="SELECT `image` FROM `request_post_images` WHERE request_id='$request_id' LIMIT 1";
			$perform_query_request_main_img=mysqli_query($connect,$query_request_main_img);
			$result_filter_img=mysqli_fetch_assoc($perform_query_request_main_img);
			$image=$result_filter_img['image'];
			

			$search_filter_results[]=array(
								"request_id"=>$request_id,
								"account_id"=>$account_id,
								"account_type"=>$account_type,
								"child_name"=>$child_name,
								"image"=>$image
								);

		}
		echo json_encode($search_filter_results, JSON_FORCE_OBJECT);
	}
	


?>