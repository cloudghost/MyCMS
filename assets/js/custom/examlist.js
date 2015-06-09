$(".details").children("td").hide();
$(".details").children("td").children().hide();


$(document).ready(function(){
    $(".works").click(function(){
        if($(window).width() <= 640) {
            $(this).next().children("td").slideToggle(500);
            $(this).next().children("td").children().slideToggle(500);
        }
    });
});
