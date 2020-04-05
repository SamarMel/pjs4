$(document).ready(function(){
    $(".single-item").slick({
        dots: true
    });

    $("#par-ici").click(() => {
        openChat();
        setTimeout(() => {
            openConv(-10);
        }, 500);
    });
});