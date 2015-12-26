$(document).ready(function() {

	$('#scroll-down-to-about').click(function() {
	    $('#about').animatescroll();
	});

	$('#scroll-down-to-where').click(function() {
	    $('#where').animatescroll();
	});

	$('#scroll-down-to-awards').click(function() {
	    $('#awards').animatescroll();
	});

	$('#scroll-down-to-schedule').click(function() {
	    $('#schedule').animatescroll();
	});

	$('#scroll-down-to-panel').click(function() {
	    $('#panel').animatescroll();
	});

	$('#scroll-down-to-sign-in').click(function() {
	    $('#sign-in').animatescroll();
	});

	$('#scroll-down-to-partners').click(function() {
	    $('#partners').animatescroll();
	});

	$('#scroll-down-to-faq').click(function() {
	    $('#faq').animatescroll();
	});

	$('#scroll-back-to-top').click(function() {
	    $('#home').animatescroll();
	});



	setTimeout(function() {
		$('#home .shift-date').animate({
			"margin-bottom" : "0%",
			"font-size" : "1.0rem"
		}, 1000, function() {
			$('#home .video').show(1000);
			$('#home .video').animate({
				opacity: 1,
			}, 1000);
		});	
		$('#home .logo').animate({
			"margin-left": "21%",
			"margin-right": "21%",
			"margin-bottom": "1%"
		}, 1000);	

		$('#home .scroll-btn').animate({
			"margin-top": "1%"
		}, 1000);		
	}, 1000);

	$('#schedule-prev').click(function() {
		var prev = $('#schedule-prev');
		var next = $('#schedule-next');

		var friday = $('#schedule-friday');
		var saturday = $('#schedule-saturday');
		var sunday = $('#schedule-sunday');

		if(!$(saturday).is(':visible')) {
			$(sunday).hide();
			$(saturday).css('display', 'inline-block');
		} else if(!$(sunday).is(':visible') && !$(friday).is(':visible')) {
			$(saturday).hide();
			$(friday).css('display', 'inline-block');
			$(prev).attr('disabled', true);
			$(prev).css('opacity', '0.1');
		} else if(!$(friday).is(':visible') && !$(saturday).is(':visible')) {
			$(saturday).hide()
			$(friday).css('display', 'inline-block');
			$(prev).attr('disabled', true);
			$(prev).css('opacity', '0.1');
		} else if($(sunday).is(':visible') && $(saturday).is(':visible') ) {
			$(sunday).hide()
			$(friday).css('display', 'inline-block');
			$(prev).attr('disabled', true);
			$(prev).css('opacity', '0.1');
		}

		$(next).attr('disabled', false);
		$(next).css('opacity', '1');
	});

	$('#schedule-next').click(function() {
		var prev = $('#schedule-prev');
		var next = $('#schedule-next');

		var friday = $('#schedule-friday');
		var saturday = $('#schedule-saturday');
		var sunday = $('#schedule-sunday');

		if(!$(saturday).is(':visible') && !$(sunday).is(':visible')) {
			$(friday).hide();
			$(saturday).css('display', 'inline-block');
		} else if(!$(friday).is(':visible') && !$(sunday).is(':visible')) {
			$(saturday).hide();
			$(sunday).css('display', 'inline-block');
			$(next).attr('disabled', true);
			$(next).css('opacity', '0.1');
		} else if(!$(sunday).is(':visible') && !$(saturday).is(':visible')) {
			$(saturday).hide()
			$(sunday).css('display', 'inline-block');
			$(next).attr('disabled', true);
			$(next).css('opacity', '0.1');
		} else if($(friday).is(':visible') && $(saturday).is(':visible')) {
			$(friday).hide()
			$(sunday).css('display', 'inline-block');
			$(next).attr('disabled', true);
			$(next).css('opacity', '0.1');
		}

		$(prev).attr('disabled', false);
		$(prev).css('opacity', '1');
	});
});