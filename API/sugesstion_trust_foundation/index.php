<?php
	include_once("../../php_includes/connection_dp.php");
	include_once("../../php_includes/rand.php");
	include_once("../../functions/date_time.php");

	if($_POST['do_action']=='suggestion_foundation')
	{
		if($_POST['suggestion_type']=='display')
		{
			if(isset($_POST['account_id'])&&isset($_POST['account_type']))
			{
				$foundation_info['data']=array();
				$temp=array();
				$query_sugestion="SELECT `id`, `name`, `photo` FROM `foundations` LIMIT 5";
				$perform_query_sugestion=mysqli_query($connect,$query_sugestion);
				while($result_sug=mysqli_fetch_assoc($perform_query_sugestion))
				{
					$foundation_id=$result_sug['id'];
					$foundation_name=$result_sug['name'];
					$foundation_photo=$result_sug['photo'];
					

					
					if($foundation_photo==null)
					{
						$image="http://together.gsg-xpro.com/root/images/profile_image/default-academy.jpg";
						
					}else
					{
							//default..
							$image="http://together.gsg-xpro.com/root/foundations/$user_id/$foundation_photo";
					}


					$temp=array(
						"account_id"=>$foundation_id,
						"account_type"=>"f",
						"photo"=>$image
						);

					array_push($foundation_info['data'],array('result'=>$temp));
				}


				echo json_encode($foundation_info);

			}
		}
	}
?>