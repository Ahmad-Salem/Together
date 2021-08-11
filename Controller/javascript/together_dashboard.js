$(document).ready(function(){


	//function to get the active people 
	setInterval(function(){
		get_num_active_people();
	},1000);

	function get_num_active_people()
		{
			// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        
	        var url = "get_active_person.php";
	        var vars = "";

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArrayget_active_people=return_data;

			 		
			    $("#active_people").html("<b style=\"color:#333;\">"+jArrayget_active_people+"</b>&nbsp;&nbsp;Person");

		    }else{
		    	//no result for your request....
				$("#active_people").html("<b style=\"color:red;\">0</b> Person");
	    	    }
	    
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request

    	}

    //function to get the active people 
	setInterval(function(){
		get_num_active_foundation();
	},1000);

	function get_num_active_foundation()
		{
			// Create our XMLHttpRequest object
	        var hr = new XMLHttpRequest();
	        // Create some variables we need to send to our PHP file    
	        
	        var url = "get_active_foundation.php";
	        var vars = "";

	        hr.open("POST", url, true);
        
	        // Set content type header information for sending url encoded variables in the request
	        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        
	        // Access the onreadystatechange event for the XMLHttpRequest object
	        hr.onreadystatechange = function() {
		    
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				
			    var jArrayget_active_foundation=return_data;

			 		
			    $("#active_foundation").html("<b style=\"color:#333;\">"+jArrayget_active_foundation+"</b>&nbsp;&nbsp;Foundation");

		    }else{
		    	//no result for your request....
				$("#active_foundation").html("<b style=\"color:red;\">0</b>&nbsp;&nbsp;Foundation");
	    	    }
	    
	        }
	        // Send the data to PHP now... and wait for response to update the status div
	        hr.send(vars); // Actually execute the request

    	}	

});