$(document).ready(function() {
    var askFaculty = function() {
        $("#faculty").collapse('show');
        $("#facultyInput").prop('required',true);
        $("#workplace").collapse('hide');
        $("#workplaceInput").prop('required',false);
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