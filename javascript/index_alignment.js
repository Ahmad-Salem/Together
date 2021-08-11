$(document).ready(function(){
    
});

$(window).resize(function(){
    var window_height=$(this).height();
    var height = window_height - ($(".navbar").height() + $(".FooterSection").height());
   $('.ContainerSection').height(height+70);
    
});

$(window).resize(); //on page load