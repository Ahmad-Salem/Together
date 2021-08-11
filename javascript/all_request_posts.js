$(document).ready(function(){

	$("#filter_btn").click(function(){
		// alert("i will try to filter the results..");
		filter_search_result();
	});


	function filter_search_result()
	{
		var country_search=$("#filter_country_search").val();
		var lastSeen_search=$("#filter_lastSeen_search").val();
		var child_hair=$("#child_hair").val();
		var child_eye=$("#child_eye").val();
		var child_age=$("#child_age").val();
		var child_skin=$("#child_skin").val();
		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        
        var url = "filter_result.php";
        var vars = "filter_country_search="+country_search+"&filter_lastSeen_search="+lastSeen_search+"&child_hair="+child_hair+"&child_eye="+child_eye+"&child_age="+child_age+"&child_skin="+child_skin;

        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
	    
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			
		    var jArraygetfilteredResults=return_data;

		 	// console.log(jArraygetfilteredResults);

		    if(jArraygetfilteredResults!=null)
			{
				jArraygetfilteredResults=JSON.parse(jArraygetfilteredResults);	
				//console.log(jArraygetfilteredResults);
				$("#filter_result_container").html('');
				$.each( jArraygetfilteredResults, function( key, value ){

					if(value.account_type=='p')
					{
						//filtered result
						$("#filter_result_container").append("<div class=\"result_item\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\"><img  src=\"../request_post_attachment/user/"+value.account_id+"/"+value.request_id+"/"+value.image+"\" title=\""+value.child_name+"\"/></a><h5 class=\"text-center\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\">"+value.child_name+"</a></h5></div>");
						
					}else if(value.account_type=='f')
					{
						//filtered result
						//filtered result
						$("#filter_result_container").append("<div class=\"result_item\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\"><img  src=\"../request_post_attachment/foundation/"+value.account_id+"/"+value.request_id+"/"+value.image+"\" title=\""+value.child_name+"\"/></a><h5 class=\"text-center\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\">"+value.child_name+"</a></h5></div>");
						
					}
					

				});

			}else{
				$("#filter_result_container").html('<h4  class=\"text-center\" style=\'color:#ff0000;\'>Something Going Wrong ....</h4>');
			}



	    }else{
            $("#filter_result_container").html('<h4 class=\"text-center\" style=\'color:#3879f0;\'>There\'s no result ..</h4>');
        }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request

	}



	$("#chlid_btn").click(function(){
		
		$("#child_div").fadeIn(800);
		$("#filter_child").fadeOut(500);
	});
	
	$("#chlid_btn_filter").click(function(){
		
		$("#filter_child").fadeIn(800);
		$("#child_div").fadeOut(500);
	});


	$("#filter_name_search").on("keyup",function(){
    		filter_search_name_result();
    });

	function filter_search_name_result()
	{
		var name_search=$("#filter_name_search").val();
		

		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        
        var url = "search_filter.php";
        var vars = "filter_name_search="+name_search;

        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
	    
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			
		    var jArraygetfilteredResults=return_data;

		 	console.log(jArraygetfilteredResults);

		    if(jArraygetfilteredResults!=null)
			{
				jArraygetfilteredResults=JSON.parse(jArraygetfilteredResults);	
				//console.log(jArraygetfilteredResults);
				$("#filter_result_container").html('');
				$.each( jArraygetfilteredResults, function( key, value ){

					if(value.account_type=='p')
					{
						//filtered result
						$("#filter_result_container").append("<div class=\"result_item\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\"><img  src=\"../request_post_attachment/user/"+value.account_id+"/"+value.request_id+"/"+value.image+"\" title=\""+value.child_name+"\"/></a><h5 class=\"text-center\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\">"+value.child_name+"</a></h5></div>");
						
					}else if(value.account_type=='f')
					{
						//filtered result
						//filtered result
						$("#filter_result_container").append("<div class=\"result_item\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\"><img  src=\"../request_post_attachment/foundation/"+value.account_id+"/"+value.request_id+"/"+value.image+"\" title=\""+value.child_name+"\"/></a><h5 class=\"text-center\"><a href=\"display_request_post.php?requets_num="+value.request_id+"\">"+value.child_name+"</a></h5></div>");
						
					}
					

				});

			}else{
				$("#filter_result_container").html('<h4  class=\"text-center\" style=\'color:#ff0000;\'>Something Going Wrong ....</h4>');
			}



	    }else{
            $("#filter_result_container").html('<h4 class=\"text-center\" style=\'color:#3879f0;\'>There\'s no result ..</h4>');
        }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request

	}
});