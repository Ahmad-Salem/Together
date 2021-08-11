$(document).ready(function(){

	/* filtering results */
	$("#search_message").on("keyup",function(){
    		var search=$(this).val();

    		contact_filter(search);
    	});


	function contact_filter(search)
	{

		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var search=search;
        var url = "contact_filter.php";
        var vars = "search="+search;

        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
	    
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			
		    var jArraygetpersondetails_search=return_data;

		 	// console.log(jArraygetpersondetails_search);
		    if(jArraygetpersondetails_search!=null)
			{
				jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);	
				
				$("#statistic_tbl").html('');
				$("#statistic_tbl").html("<tr class=\"active\"><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i> Message Owner</td><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i> Message </td><td><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> Date </td><td><i class=\"fa fa-street-view\" aria-hidden=\"true\"></i> actions</td></tr>");

				$.each( jArraygetpersondetails_search, function( key, value ){
					
					$("#statistic_tbl").append("<tr><td>"+value.account_name+"</td><td>"+value.message+"</td><td>"+value.date+"</td><td><a href=\"#\" class=\"reply\">Reply</a></td><input type=\"hidden\" class=\"account_id\" value=\""+value.account_id+"\" \><input type=\"hidden\" class=\"account_type\" value=\""+value.account_type+"\" \><input type=\"hidden\" class=\"msg_id\" value=\""+value.message_id+"\" \></tr>");
					
						$('.reply').click(function(){
	    					$('#reply').modal('show');	
	    				});

						$(".reply").click(function(){
							var message_id=$(this).parent().siblings(".msg_id").val();
							var account_id=$(this).parent().siblings(".account_id").val();
							var account_type=$(this).parent().siblings(".account_type").val();
							
							$(".reply_btn").click(function(){
								var reply_body=$(".reply_body").val();
								
								if(reply_body=='')
								{
									alert("Message Can't Be Blank");
								}else
								{
									relpy_to_users(message_id,account_id,account_type,reply_body);	
								}
							});
							
						});


				});

					
				
			}else{
					$("#statistic_tbl").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
			}



	    }else{
            $("#statistic_tbl").html("<tr class=\"active\"><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i> Message Owner</td><td><i class=\"fa fa-edit\" aria-hidden=\"true\"></i> Message </td><td><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> Date </td><td><i class=\"fa fa-street-view\" aria-hidden=\"true\"></i> actions</td></tr>");
            $("#statistic_tbl").append("<tr><td colspan='5'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr>");
        }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request

	}    	

    	/* end filtering the results*/

	$(".reply").click(function(){
		var message_id=$(this).parent().siblings(".msg_id").val();
		var account_id=$(this).parent().siblings(".account_id").val();
		var account_type=$(this).parent().siblings(".account_type").val();
		
		$(".reply_btn").click(function(){
			var reply_body=$(".reply_body").val();
			if(reply_body=='')
			{
				alert("Message Can't Be Blank");
			}else
			{
				relpy_to_users(message_id,account_id,account_type,reply_body);	
			}
			
		});
		
	});

	


	function relpy_to_users(message_id,account_id,account_type,reply_body)
	{
		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var url = "reply_to_user.php";
        var vars = "message_id="+message_id+"&account_id="+account_id+"&account_type="+account_type+"&reply_body="+reply_body;

        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
	    
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			// alert("Sucessful Reply");
			alert(return_data);
	    }else
	    {
	    	// alert("don't work");
	    }
    
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request

	}
});