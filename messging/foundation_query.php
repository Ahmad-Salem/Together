<?php
	include_once("../php_includes/connection_dp.php");

	$search_input=mysqli_real_escape_string($connect,$_POST['search']);
	$query_foundation="SELECT `id`,`name`,`photo` FROM foundations WHERE `name` LIKE '".$search_input."%' ";
	$perform_query_foundation=mysqli_query($connect,$query_foundation);
	
	if(mysqli_num_rows($perform_query_foundation)!=0 && $search_input!=null)
	{
		echo "<ul class=\"list-unstyled foundation_list\" >";
	
		while($result_foundation=mysqli_fetch_assoc($perform_query_foundation))
		{
			if($result_foundation['photo']!=null)
			{
				$image="../foundations/".$result_foundation['id']."/".$result_foundation['photo'];
			}else{
				//default image 
				$image="../images/profile_image/default-academy.jpg";
			}
			echo "<li> <img src=\"$image\" /> <a>"
			.$result_foundation['name'].
			"</a> </li>";
		}
		
		echo "</ul>";	
	}else{

		echo "<h4>No Result Matched \" The Name You Entered \"</h4>";
	}
	
?>