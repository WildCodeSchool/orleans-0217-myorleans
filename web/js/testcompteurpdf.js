/**
 * Created by wilder8 on 26/06/17.
 */
/*! jQuery v@1.8.0 jquery.com | jquery.org/license */

/*! jQuery v@1.8.0 jquery.com | jquery.org/license */

var timer;
var timerFinish;
var timerSeconds;

function drawTimer(c, a) {
    $("#note_" + c).html('<div class="percent"></div><div id="slice"' + (a > 5 ? ' class="gt50"' : "") + '><div class="pie"></div>' + (a > 5 ? '<div class="pie fill"></div>' : "") + "</div>");
    var b = 360 / 10 * a;
    $("#note_" + c + " #slice .pie").css({
        "-moz-transform": "rotate(" + b + "deg)",
        "-webkit-transform": "rotate(" + b + "deg)",
        "-o-transform": "rotate(" + b + "deg)",
        transform: "rotate(" + b + "deg)"
    });
    a = Math.floor(a * 100) / 100;
    arr = a.toString().split(".");
    intPart = arr[0];
    dec = arr[1];
    if (!dec > 0) {
        dec = 0
    }
    $("#note_" + c + " .percent").html('<span class="int">' + intPart + '</span><span class="dec">.' + dec + "</span>")
}
function stopNote(d, b) {
    var c = (timerFinish - (new Date().getTime())) / 1000;
    var a = 10 - ((c / timerSeconds) * 10);
    a = Math.floor(a * 100) / 100;
    if (a <= b) {
        drawTimer(d, a)
    } else {
        b = $("#note_" + d).data("note");
        arr = b.toString().split(".");
        $("#note_" + d + " .percent .int").html(arr[0]);
        $("#note_" + d + " .percent .dec").html("." + arr[1])
    }
}
$(document).ready(function () {
    timerSeconds = 0.1;
    timerFinish = new Date().getTime() + (timerSeconds * 1000);
    $(".notesite").each(function (a) {
        note = $("#note_" + a).data("note");
        timer = setInterval("stopNote(" + a + ", " + note + ")", 0)
    })
});



/* timer fixe */

