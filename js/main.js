/*!
 * J-Day -- HTML prenium template
 *
 * Copyright (c) 2012 F²
 *
 * Main Javascript
 */
/********************************/
/*Timer -- Thank to Grafikart -> http://www.grafikart.fr/ -- (c) Grafikart
/********************************/
jQuery.noConflict()(function($){
	$(document).ready(function() {
    /**
    * Set your date here  (YEAR, MONTH (0 for January/11 for December), DAY, HOUR, MINUTE, SECOND)
    * according to the GMT+0 Timezone
    **/
    var launch = new Date(2012, 09, 25, 11, 00);
    /**
    * The script
    **/
    var message = $('#message');
    var days = $('#days');
    var hours = $('#hours');
    var minutes = $('#minutes');
    var seconds = $('#seconds');

    setDate();
    function setDate(){
        var now = new Date();
        if( launch < now ){
            days.html('<strong>0</strong><p>Day</p>');
            hours.html('<strong>0</strong><p>Hour</p>');
            minutes.html('<strong>0</strong><p>Minute</p>');
            seconds.html('<strong>0</strong><p>Second</p>');
            message.html('I am truly sorry for my delay, but my website is coming...');
        }
        else{
            var s = -now.getTimezoneOffset()*60 + (launch.getTime() - now.getTime())/1000;
            var d = Math.floor(s/86400);
            days.html('<strong>'+d+'</strong><p>Day'+(d>1?'s':''),'</p>');
            s -= d*86400;

            var h = Math.floor(s/3600);
            hours.html('<strong>'+h+'</strong><p>Hour'+(h>1?'s':''),'</p>');
            s -= h*3600;

            var m = Math.floor(s/60);
            minutes.html('<strong>'+m+'</strong><p>Minute'+(m>1?'s':''),'</p>');

            s = Math.floor(s-m*60);
            seconds.html('<strong>'+s+'</strong><p>Second'+(s>1?'s':''),'</p>');
            setTimeout(setDate, 1000);

            message.html("Welcome ! Unfortunately, I'm not ready now. But, the launch day is coming !");
        }
    }
	});
});
/********************************/
/*Progress bar
/********************************/
jQuery.noConflict()(function($){
	$(document).ready(function() {
		$(".show_progress_area").click(function(){
				$('#progress_area').slideToggle();
				$('#open_me_progress').hide();
				$('#button_open_progress').css("marginBottom", "24px");
		});
    });
});
/********************************/
/*Elastislide (slider container)
/********************************/
jQuery.noConflict()(function($){
	$(document).ready(function() {
		$('#container').elastislide({
			imageW: 330,
			margin: 24,
			border: 0,
			speed : 450
		});
	});
});
/********************************/
/*Scroll to top
/********************************/
jQuery.noConflict()(function($){
	$(document).ready(function() {
		$('.scroll_top_a').click(function() {
					$('body,html').animate({
						scrollTop:0
					},1200);
		});
	});
});
/********************************/
/*Tooltips
/********************************/
jQuery.noConflict()(function($){
	$(document).ready(function() {
		$("[rel=tooltip]").tooltip();
	});
});
/********************************/
/*Contact area
/********************************/
jQuery.noConflict()(function($){
	$(document).ready(function() {
    $(".show_contact_area").click(function(){
        $('#contact_area').slideToggle(function initialize() {
            /********************************/
            /*Map -- Thank to the Google map API -> https://developers.google.com/maps/
            /********************************/
            var infoMap = new google.maps.InfoWindow();
            var Mappos = new google.maps.LatLng(41.88691, -87.64315);
            var pictoMap = 'images/picto_map.png';
            var pictoMapShadow = 'images/picto_map_shadow.png';
            var contentMap = '<div class="infoBulle" ><h4>Custom Google map !</h4><p>Area for you address or a description</p></div>';
            var options = {
                    center: Mappos,
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                    },
                    navigationControl: true,
                    navigationControlOptions: {
                    style: google.maps.NavigationControlStyle.SMALL
                    }
            };
            var carte = new google.maps.Map(document.getElementById("GoogleMaps"), options);
            var iconMap = new google.maps.Marker({
                    position: Mappos,
                    map: carte,
                    icon : pictoMap,
                    shadow : pictoMapShadow});

            google.maps.event.addListener(iconMap, 'click', function() {
                    infoMap.setContent(contentMap);
                    infoMap.open(carte, this);
                    carte.panTo(Mappos);});
            google.maps.event.addListener(carte, 'click', function() {
            carte.panTo(Mappos);infoMap.setContent(contentMap);infoMap.open(carte, iconMap);
            });

       });
       $('#open_me_contact').hide();
       $('#additional').css("marginBottom", "0px");
       $('#button_open_contact').css("marginBottom", "12px");
    });
    // For the forms alerts
    $(".alert").alert('closed')
	});
});
