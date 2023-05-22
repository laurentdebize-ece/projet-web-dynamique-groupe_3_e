
function calcul_prix_total() {
    let prix_total =0;
    $(".sous-totale").each(function(){
        prix_total += parseInt($(this).html());
    });
    $('#prix-total2').text("" + prix_total + "€");
}
function calcul_nb_articles() {
    let nb_articles =0;
    $(".nombre").each(function(i){
        nb_articles  += parseInt($(this).text());
    });
    $('#nb-articles').text("" + nb_articles + " articles");
}

$(document).ready(function () {
    calcul_prix_total();
    calcul_nb_articles();
    /*$('.nombre').change(function () {
        let prix = parseInt($(this).parent().parent().children(".prix").text()) * parseInt($(this).val());
        $(this).parent().parent().children(".sous-totale").text(prix);
        calcul_prix_total();
        calcul_nb_articles();
    });*/
    $('.boutton-nombre').click(function () {
        let prix = parseInt($(this).parent().children(".nombre").text());
        if($(this).val() === "+"){
            prix ++;
        }
        else{
            prix --;
            if(prix<0){
                prix =0;
            }
        }
        $(this).parent().children(".nombre").text(prix);
        let totale = parseInt($(this).parent().parent().parent().children(".prix").text()) * prix;
        $(this).parent().parent().parent().children(".sous-totale").text(""+ totale+" €");
        calcul_prix_total();
        calcul_nb_articles();
    });

});