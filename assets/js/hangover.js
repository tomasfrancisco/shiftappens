$(document).ready(function() {
    var jsonContent;
    $.getJSON('assets/js/teams.json', function(data) {
        jsonContent = data['team'];
        for (var i = 0 ; i < jsonContent.length ; i++) {
            var id = jsonContent[i]['id'];
            $("#main").append(" \
            <div class=\"team\" id=\"" + id + "\"> \
                <div id=\"project-info-" + id + "\" class=\"project-info col-xs-12 col-sm-12 col-md-8 col-md-push-4 col-lg-8 col-lg-push-4\"> \
                    <h1 class=\"project-name\">" + jsonContent[i]['project-name'] + "</h1> \
                    <p class=\"project-content\">" + jsonContent[i]['project-content'] + "</p> \
                    <iframe src=\"" + jsonContent[i]['video1'] + "\"></iframe> \
                    <iframe src=\"" + jsonContent[i]['video2'] + "\"></iframe> \
                </div> \
                <div id=\"team-info-" + id + "\" class=\"team-info col-xs-12 col-sm-12 col-md-4 col-md-pull-8 col-lg-4 col-lg-pull-8\"> \
                    <h1 class=\"team-name\">" + jsonContent[i]['team-name'] + "</h1> \
                    <img src=\"../assets/img/team/" + id + ".jpg\" class=\"img-responsive img-rounded\" /> \
                </div> \
            </div>");
            for (var j = 0 ; j < jsonContent[i]['team-members'].length ; j++) {
                $("#team-info-"+id).append("<p class=\"member\">" + jsonContent[i]['team-members'][j] + "</p>");
            }
        }
    });
});