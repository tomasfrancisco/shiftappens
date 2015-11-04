$(document).ready(function() {

	$('#scroll-down-to-about').click(function() {
	    $('#about').animatescroll();
	});

	$('#scroll-down-to-contact').click(function() {
	    $('#contact').animatescroll();
	});

	setTimeout(function() {
		$('#home .shift-date').animate({
			"margin-bottom" : "0%",
			"font-size" : "1.2rem"
		}, 1000, function() {
			$('#home .video').show(1000);
			$('#home .video').animate({
				opacity: 1,
			}, 1000);
		});	
		$('#home .logo').animate({
			"margin-left": "20%",
			"margin-right": "20%",
			"margin-bottom": "1%"
		}, 1000);	

		$('#home .scroll-btn').animate({
			"margin-top": "1%"
		}, 1000);		
	}, 1000);
});