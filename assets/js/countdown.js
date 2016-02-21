$(document).ready(function() {
    var main;
    var max_time = 120;
    var time = max_time;
    $("#time").text(time);
    $("#stop_timer").css("opacity", "0.5");
    $("#stop_timer").attr("disabled", true);

    function startTimer() {
        time = max_time;
        main = setInterval(function(){
            time = time - 1;
            if(time!=0) {
                console.log(time);
                $("#time").text(time);
            } else {
                time = 0;
                $("#time").text(time);
                clearInterval(main);
            }
        },1000);
        $("#start_timer").css("opacity", "0.5");
        $("#start_timer").attr("disabled", true);
        $("#stop_timer").css("opacity", "1.0");
        $("#stop_timer").attr("disabled", false);
    }

    function stopTimer() {
        time = max_time;
        $("#time").text(time);
        clearInterval(main);
        $("#stop_timer").css("opacity", "0.5");
        $("#stop_timer").attr("disabled", true);
        $("#start_timer").css("opacity", "1.0");
        $("#start_timer").attr("disabled", false);
    }

    $("#start_timer").click(startTimer);
    $("#stop_timer").click(stopTimer);
});
