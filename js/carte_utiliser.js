$(document).ready(function () {

    $('.formule-carte').click(function () {
        $('input').css({visibility: 'hidden'});
        $(this).children("form").children().css({visibility: 'visible'});
 
    });

});