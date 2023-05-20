

$(document).ready(function(){
    $( ".contenaire-titre" ).on( "click",
        function() {
        if( $(this).width() >= 300){
            $(this).css({width:"max-content"})
            $(this).siblings(".contenu").css({display: 'none'});
            $(this).children("p").css({rotate: '0deg'});
        }else {
            $(this).css({width:"100%"})
            $(this).siblings(".contenu").css({display: 'block'});
            $(this).children("p").css({rotate: '180deg'});
        }

    } );


});
