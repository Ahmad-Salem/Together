$(document).ready(function(){
    
    
// nice scroll 
//$("html").niceScroll();  
    
/* when sign as person button clicked*/
$(".card-main .Login-card .Login-Form .Query .Person-btn").click(function(){
    /* the div that have Query will be hidden after 500 mili second*/
    $(".card-main .Login-card .Login-Form .Query").fadeOut(500,function(){
        //alert("hello after the fade out event");
        //the registeration form will appear (person)
        $(".card-main .Login-card .Login-Form .person-data").fadeIn(500);
        $(".card-main .Login-card .Login-Form .person-data").removeClass("hidden");
    });
});
 /* back button for peson data*/   
$(".card-main .Login-card .Login-Form .person-data #back_p").click(function(){
    $(".card-main .Login-card .Login-Form .Query").fadeIn(500,function(){
        //the registeration form will appear (person)
        $(".card-main .Login-card .Login-Form .person-data").fadeOut(500);
        $(".card-main .Login-card .Login-Form .person-data").addClass("hidden");
    });
});    
    
    
/* when sign as Foundation button clicked*/
$(".card-main .Login-card .Login-Form .Query .Foundation-btn").click(function(){
    /* the div that have Query will be hidden after 500 mili second*/
    $(".card-main .Login-card .Login-Form .Query").fadeOut(500,function(){
        //alert("hello after the fade out event");
        //the registeration form will appear (person)
        $(".card-main .Login-card .Login-Form .Foundation-data").fadeIn(500);
        $(".card-main .Login-card .Login-Form .Foundation-data").removeClass("hidden");
    });
    
});

 /* back button for peson data*/   
$(".card-main .Login-card .Login-Form .Foundation-data #back_f").click(function(){
    $(".card-main .Login-card .Login-Form .Query").fadeIn(500,function(){
        //the registeration form will appear (person)
        $(".card-main .Login-card .Login-Form .Foundation-data").fadeOut(500);
        $(".card-main .Login-card .Login-Form .Foundation-data").addClass("hidden");
    });
});
    
// loading screen
//$(window).load(function () {
//    "use strict";
//    $(".loading-overlay .sk-cube-grid").fadeOut(1000, function () {
//        // show the scroll
//        $("html,body").css("overflow", "auto");
//        $(this).parent().fadeOut(1000, function () {
//            $(this).remove();
//        });
//    });    
//    
  
// $('').addClass('hidden');
// $('').removeClass('hidden');    
    
    
    
var inp = document.getElementsByTagName('input');
for (var i=0;i<inp.length;i++) {
    if (inp[i].type != 'file') continue;
    inp[i].relatedElement = inp[i].parentNode.getElementsByTagName('label')[0];
    inp[i].onchange /*= inp[i].onmouseout*/ = function () {
        this.relatedElement.innerHTML = this.value;
    };
};
    
    /*image uploading*/
    
    
    /* Google map Demo */
    function initMap() {
        var uluru = {lat: 31.132093, lng: 33.8032762};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }




    /* js of pop up of log out */

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });


    // set the height of the page
    var height=$("body").height();
    var custom_H=height-40;
    $(".Main-Intro .Main-Intro-Content").css("height",custom_H);
    //$("#").css("","");

   
});

