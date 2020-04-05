$(document).ready(function(){
    $(".single-item").slick({
        dots: true
    });

    $("#par-ici").click(() => {
        openChat();
        openConv(-10);
    });
});