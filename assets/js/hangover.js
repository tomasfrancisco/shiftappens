$(document).ready(function() {
    var jsonContent;
    $.getJSON('assets/js/teams.json', function(data) {
        jsonContent = data;
        
    });
});