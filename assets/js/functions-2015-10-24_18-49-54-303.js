$('#scroll-down-to-about').click(function() {
    $('#about').animatescroll();
});
$('#scroll-down-to-contact').click(function() {
    $('#contact').animatescroll();
});

$(document).ready(function() {

	$(".about-container article").waypoint(function() {
	    	$('.about-container article').addClass('fadeInLeft');
  	}, { offset: '80%'});

	$(".contact-container article").waypoint(function() {
	    	$('.contact-container article').addClass('fadeInLeft');
  }, { offset: '80%'});
});


