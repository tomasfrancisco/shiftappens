$(document).ready(function() {
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