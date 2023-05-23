
$clique =true;
$(document).ready(function(){
    $('#menu2 ol li a').hover(
        function(){
            $(this).css({color: 'black'});
            $(this).parent().css({backgroundColor: 'white'});

        },
        function(){
            $(this).css({color: 'white'});
            $(this).parent().css({backgroundColor: 'black'});
        });
    $('#menu').click(function (){
        if($clique){
            $('header').css({position:'static'});
            $('#menu2').animate({left:'100%'});
            $('#petite-ligne-1').css({transform:'rotate(0deg)'});
            $('#petite-ligne-2').css({transform:'rotate(0deg) translate(0, 0)'});
            $clique =false;
        }
        else{
            $('header').css({position:'fixed'});
            $('#menu2').animate({left:'0'});
            $('#petite-ligne-1').css({transform:'rotate(45deg)'});
            $('#petite-ligne-2').css({transform:'rotate(-45deg) translate(5px, -5px)'});

            $clique =true;
        }
    });
    $('#image-carte-1').click(function (){
        if($(this).width() === 430){
            
        }
        else{
            $('#ligne2-3').css({backgroundColor :'#5f5f5f'});
            $('#ligne2-2').css({backgroundColor :'#5f5f5f'});
            $('#ligne2-1').css({backgroundColor :'white'});
            $('#carte').animate({left :'37%'});
            $('#image-carte-1').animate({height :'271px',width :'430px'});
            $('#image-carte-2').animate({height :'196px',width :'310px'});
            $('#image-carte-3').animate({height :'196px',width :'310px'});

            $('#ligne').animate({width :'100%'});
            $('#accueil').animate({top:'15px'});
            $('#omnesbox').animate({top:'15px'});
            $('#carte-cadeau').animate({top:'15px'});
            $('#logo').animate({height :'56px',width :'250px',top:'0', left:'0'});
            $('#menu').animate({left:'100px'});
           
            
        }
    });
    $('#image-carte-2').click(function(){
        if($(this).width() === 430){
            $('#image-carte-1').css('color','red');
        }
        else{
            $('#ligne2-3').css({backgroundColor :'#5f5f5f'});
            $('#ligne2-2').css({backgroundColor :'white'});
            $('#ligne2-1').css({backgroundColor :'#5f5f5f'});
            $('#carte').animate({left :'-11%'});
            $('#image-carte-1').animate({height :'196px',width :'310px'});
            $('#image-carte-2').animate({height :'271px',width :'430px'});
            $('#image-carte-3').animate({height :'196px',width :'310px'});

            $('#ligne').animate({width :'0'});
            $('#accueil').animate({top:'-100px'});
            $('#omnesbox').animate({top:'-100px'});
            $('#carte-cadeau').animate({top:'-100px'});
            $('#logo').animate({height :'112px',width :'500px',top:'120%', left:'30%'});
            $('#menu').animate({left:'0px'});

       }
    });
    $('#image-carte-3').click(function(){
        if($(this).width() === 430){

        }
        else{
            $('#ligne2-3').css({backgroundColor :'white'});
            $('#ligne2-2').css({backgroundColor :'#5f5f5f'});
            $('#ligne2-1').css({backgroundColor :'#5f5f5f'});
            $('#carte').animate({left :'-56.5%'});
            $('#image-carte-1').animate({height :'196px',width :'310px'});
            $('#image-carte-2').animate({height :'196px',width :'310px'});
            $('#image-carte-3').animate({height :'271px',width :'430px'});
       
        }
    });
});