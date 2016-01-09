$(document).ready(function() {
    $('body').bind('mousewheel', function(event) {
        event.preventDefault();
        var scrollTop = this.scrollTop;
        this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
        //console.log(event.deltaY, event.deltaFactor, event.originalEvent.deltaMode, event.originalEvent.wheelDelta);
    });

    var askFaculty = function() {
        $("#workplace").collapse('hide');
        $("#faculty").collapse('show');
    };

    var askWorkPlace = function() {
        $("#faculty").collapse('hide');
        $("#workplace").collapse('show');
    };

    $("#student").on("click", askFaculty);
    $("#worker").on("click", askWorkPlace);
});