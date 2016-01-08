$(document).ready(function() {
    var vh = $(window).innerHeight();
    $("#form").height(vh);

    $('#form').contents().find('p').css({
        'font-family': 'serif'
    });
});