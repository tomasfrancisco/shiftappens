$(document).ready(function() {
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