<?php
	include_once("../php_includes/connection_dp.php");

	$search_input=mysqli_real_escape_string($connect,$_POST['search']);
	$query_person="SELECT `id`,`first_name`,`last_name`,`photo`,`gender` FROM users WHERE `first_name`  LIKE '%".$search_input."%' OR `last_name`  LIKE '%".$search_input."%' ";
	$perform_query_person=mysqli_query($connect,$query_person);
	
	if(mysqli_num_rows($perform_query_person)!=0 && $search_input!=null)
	{
		echo "<ul class=\"list-unstyled foundation_list\" >";
	
		while($result_person=mysqli_fetch_assoc($perform_query_person))
		{
			if($result_person['gender']=='m')
			{
				if($result_person['photo']!=null)
				{
					$image="../users/".$result_person['id']."/".$result_person['photo'];
				}else{
					//default image
					$image="../images/profile_image/default-person.jpg"; 
				}


			}else{
				//female
				if($result_person['photo']!=null)
				{
					$image="../users/".$result_person['id']."/".$result_person['photo'];
				}else{
					//default image 
					$image="../images/profile_image/user_profile_female.jpg";
				}
			}
			$uid=$result_person['id'];
			$gender=$result_person['gender'];
			$acc_type='p';
			echo "<input type=\"hidden\" value=\"$uid\" id=\"u_id\"/>";
			echo "<li class=\"say_hello\" > <img src=\"$image\" /> <a href=\"messaging.php?uid={$uid}&gender={$gender}&acc_type={$acc_type}\" >"
			.$result_person['first_name']." ".$result_person['last_name'].
			"</a> </li>";
			echo "<button id=\"tooltip_msg_id\" style=\"margin-bottom:10px; margin-top:10px;\" type=\"button\" class=\"btn btn-default btn-block tooltip_msg\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Tooltip on bottom\">Say Hello To ".$result_person['first_name']." ".$result_person['last_name']."</button>";
		}
		
		echo "</ul>";	
	}else{

		echo "<h4>No Result Matched \" The Name You Entered \"</h4>";
	}
	
?>
<script type="text/javascript">
	
	$(".tooltip_msg").hide();
	
	$(".say_hello").mouseleave(function(){
		$(this).siblings(".tooltip_msg").hide();
	});
	$(".say_hello").mouseenter(function(){
		$(this).siblings(".tooltip_msg").show(500);
	});
</script>