$(document).ready(function() {
    $('body').bind('mousewheel', function(event) {
        event.preventDefault();
        var scrollTop = this.scrollTop;
        this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
        //console.log(event.deltaY, event.deltaFactor, event.originalEvent.deltaMode, event.originalEvent.wheelDelta);
    });

    var askFaculty = function() {
        $("#workplace").collapse('hide');
        $("#workplaceInput").prop('required',false);
        $("#faculty").collapse('show');
        $("#facultyInput").prop('required',true);
    };

    var askWorkPlace = function() {
        $("#faculty").collapse('hide');
        $("#facultyInput").prop('required',false);
        $("#workplace").collapse('show');
        $("#workplaceInput").prop('required',true);
    };

    $("#student").on("click", askFaculty);
    $("#worker").on("click", askWorkPlace);
});