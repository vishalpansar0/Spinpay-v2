// require('./bootstrap');
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        // document.getElementById("nav").style.top = "0";
        $("#nav").fadeIn(700);
    } else {
        // document.getElementById("nav").style.top = "-140px";
        $("#nav").fadeOut(700);
    }
    prevScrollpos = currentScrollPos;
}

function movetoNext(current, nextFieldID, vs) {
    if (current.value.length >= current.maxLength) {
        document.getElementById(nextFieldID).focus();
    } else if (current.value.length == 0) {
        if (vs == 2) {
            document.getElementById('first').focus();
        } else if (vs == 3) {
            document.getElementById('second').focus();
        } else if (vs == 4) {
            document.getElementById('third').focus();
        }
    }
}