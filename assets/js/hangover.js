$(document).ready(function() {
    var jsonContent;
    $.getJSON('assets/js/teams.json', function(data) {
        jsonContent = data['team'];
        for (var i = 0 ; i < jsonContent.length ; i++) {
            var id = jsonContent[i]['id'];
            $("#main").append("<div class=\"team\" id=\"" + id + "\"></div>")
            $("#"+id).append("<div id=\"project-info-" + id + "\" class=\"project-info col-xs-12 col-sm-12 col-md-8 col-md-push-4 col-lg-8 col-lg-push-4\">")
            $("#project-info-"+id).append("<h1 class=\"project-name\">" + jsonContent[i]['project-name'] + "</h1>")
            $("#project-info-"+id).append("<p class=\"project-content\">" + jsonContent[i]['project-content'] + "</p>");
            $("#project-info-"+id).append("<iframe src=\"" + jsonContent[i]['video1'] + "\"></iframe>");
            $("#project-info-"+id).append("<iframe src=\"" + jsonContent[i]['video2'] + "\"></iframe>");
            $("#"+id).append("<div id=\"team-info-" + id + "\" class=\"team-info col-xs-12 col-sm-12 col-md-4 col-md-pull-8 col-lg-4 col-lg-pull-8\">");
            $("#team-info-"+id).append("<h1 class=\"team-name\">" + jsonContent[i]['team-name'] + "</h1>");
            $("#team-info-"+id).append("<img src=\"../assets/img/team/" + id + ".jpg\" class=\"img-responsive img-rounded\" />");
            for (var j = 0 ; j < jsonContent[i]['team-members'].length ; j++) {
                $("#team-info-"+id).append("<p class=\"member\">" + jsonContent[i]['team-members'][j] + "</p>");
            }
        }
    });
});