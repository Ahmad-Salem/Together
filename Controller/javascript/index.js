$(document).ready(function(){
	
	$(".mobile").click(function(){
		$(".containers .sidebar").slideToggle('fast');
	});
	window.onresize = function(event)
	{
		if($(window).width()>320)
		{
			$(".containers .sidebar").show();
		}
	};
});