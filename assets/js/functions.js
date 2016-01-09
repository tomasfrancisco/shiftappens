$(document).ready(function() {
	var isOnTop = true;
	var vh = $(window).innerHeight();

	$(window).scroll(function() {
	    if ($(".navbar-fixed-top").offset().top >= (vh-103)) {
	    	if(isOnTop == true) {
    			$('.navbar-fixed-top').animate({
					//opacity: 1,
					top: "0px"
				}, 0);
	    		isOnTop = false;
	    	}
	    } else if ($(".navbar-fixed-top").offset().top < (vh-102)){
			$('.navbar-fixed-top').animate({
				//opacity: 0,
				top: "-52px"
			}, 0);
			isOnTop = true;
	    }
	});

	$("#gold").hover(function(){
		$('.gold>p').animate({
			opacity: 1,
		}, 500);
		$('.gold>.row>.award').animate({
			opacity: 1,
		}, 500);
	},function(){
		$('.gold>p').animate({
			opacity: 0,
		}, 500);
		$('.gold>.row>.award').animate({
			opacity: 0.3,
		}, 500);
	});

	$("#silver").hover(function(){
		$('.silver>p').animate({
			opacity: 1,
		}, 500);
		$('.silver>.row>.award').animate({
			opacity: 1,
		}, 500);
	},function(){
		$('.silver>p').animate({
			opacity: 0,
		}, 500);
		$('.silver>.row>.award').animate({
			opacity: 0.3,
		}, 500);
	});

	$("#bronze").hover(function(){
		$('.bronze>p').animate({
			opacity: 1,
		}, 500);
		$('.bronze>.row>.award').animate({
			opacity: 1,
		}, 500);
	},function(){
		$('.bronze>p').animate({
			opacity: 0,
		}, 500);
		$('.bronze>.row>.award').animate({
			opacity: 0.3,
		}, 500);
	});

	$('body').scrollspy({target: "#navigation", offset: 52});

	$(function() {
	    $('a.page-scroll').bind('click', function(event) {
	        var $anchor = $(this);
	        $(this).addClass("active");
	        $('html, body').stop().animate({
	            scrollTop: $($anchor.attr('href')).offset().top - 50
	        }, 1500, 'easeInOutExpo');
	        event.preventDefault();
	    });
	});

	$('body').bind('mousewheel', function(event) {
		event.preventDefault();
		var scrollTop = this.scrollTop;
		this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
	});

	setTimeout(function() {
		$('#home .logo').animate({
			opacity: 1,
		}, 1000);
		$('#home .shift-date').animate({
			opacity: 1,
		}, 1000);
		$('#home .arrow').animate({
			opacity: 1,
		}, 1000);
		$('#clock').countdown('2016/02/19 12:00:00',function(event){
			var $this = $(this).html(event.strftime(''
				+ '<span>%D</span>d '
				+ '<span>%H</span>h '
				+ '<span>%M</span>m '
				+ '<span>%S</span>s'));
		});
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