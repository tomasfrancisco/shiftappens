$(document).ready(function() {
	var isOnTop = true;
	var vh = $(window).innerHeight();

	if($(".shift-bar").offset().top >= (vh-103)) {
		$("#navigation").css('top', '0px');
		$("#shift-me-up").tooltip("show");
	}

	$(window).scroll(function() {
	    if ($(".shift-bar").offset().top >= (vh-103)) {
	    	if(isOnTop == true) {
    			$('.shift-bar').animate({
					//opacity: 1,
					top: "0px"
				}, 0);
	    		isOnTop = false;
	    	}
	    	$("#shift-me-up").tooltip("show");
	    } else if ($(".shift-bar").offset().top < (vh-102)){
			$('.shift-bar').animate({
				//opacity: 0,
				top: "-52px"
			}, 0);
			$("#shift-me-up").tooltip("hide");
			isOnTop = true;
	    }
	});

	var shift_colors = ["#262261", "#FF259C", "#262261", "#FF259C", "#262261", "#FF259C", "#00A79D", "#00A79D"]
	var color = shift_colors[Math.floor(Math.random()*shift_colors.length)];
	$(".navbar-brand").css("color", color);
	$("#signin-button").css("color", color);

	$("#security").hover(function(){
		$(".security>.row>center>.challenge").animate({
			opacity: 1,
		}, 200);
	}, function(){
		$('.security>.row>center>.challenge').animate({
			opacity: 0.3,
		}, 200);
	});

	$("#quizz").hover(function(){
		$(".quizz>.row>center>.challenge").animate({
			opacity: 1,
		}, 200);
	}, function(){
		$('.quizz>.row>center>.challenge').animate({
			opacity: 0.3,
		}, 200);
	});

	$("#health").hover(function(){
		$(".health>.row>center>.challenge").animate({
			opacity: 1,
		}, 200);
	}, function(){
		$('.health>.row>center>.challenge').animate({
			opacity: 0.3,
		}, 200);
	});

	$("#pokemon").hover(function(){
		$(".pokemon>.row>center>.challenge").animate({
			opacity: 1,
		}, 200);
	}, function(){
		$('.pokemon>.row>center>.challenge').animate({
			opacity: 0.3,
		}, 200);
	});

	$(window).scroll(function(event) {
		$("#modal_dognaedis").modal("hide");
		$("#modal_whitesmith").modal("hide");
		$("#modal_subvisual").modal("hide");
		$("#modal_pokemon").modal("hide");
	});

	$("#security").click(function(event) {
		$('#modal_dognaedis').modal('show');
	});

	$("#quizz").click(function(event) {
		$('#modal_whitesmith').modal('show');
	});

	$("#health").click(function(event) {
		$('#modal_subvisual').modal('show');
	});

	$("#pokemon").click(function(event) {
		$('#modal_pokemon').modal('show');
	});

	$('body').scrollspy({target: ".shift-bar", offset: 52});

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
		$('#clock').countdown('2016/02/19 15:00:00',function(event){
			var $this = $(this).html(event.strftime(''
				+ '<span>%D</span>d '
				+ '<span>%H</span>h '
				+ '<span>%M</span>m '
				+ '<span>%S</span>s'));
		});
		var feed = new Instafeed({
			limit: 1,
			get: 'user',
			userId: '759309076',
	        clientId: '83b980446cfc450eade4beec44388ee5',
	        accessToken: '759309076.1677ed0.ae99b8d0ea124ac1952bfaa3069ec2e4',
	        resolution: 'standard_resolution',
	        target: 'home',
	        template: '<style>#home{background-image:url({{image}});background-repeat:no-repeat; background-position: center; background-size: auto 100%;}</style>'
	    });
	    feed.run();
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
