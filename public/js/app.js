$(document).ready( function() {

    $('.header__navbar-toggle').click(function(e) {
        e.preventDefault();
        $('.header__navbar').toggleClass('is-open');
    });

    $('.footer__navbar-toggle').click(function(f) {
        f.preventDefault();
        $('.footer__navbar').toggleClass('is-open');
    });

    $nbr_item = 4;
    $nbr_item_sup = 3;


    // document.getElementById("ajouter")
    //         .addEventListener("click", function(){
    //             document.getElementById("item"+$nbr_item).hidden = false;
    //             $nbr_item = $nbr_item + 1;
    //             $nbr_item_sup = $nbr_item_sup + 1;
    //         });
            
    // document.getElementById("supprimer")
    // .addEventListener("click", function(){
    //     document.getElementById("item"+$nbr_item_sup).hidden = true;
    //     $nbr_item = $nbr_item - 1;
    //     $nbr_item_sup = $nbr_item_sup -1;
    // });

    var $sougr = $('#repas_groupe');
    $sougr.change(function(){        
        var $form = $(this).closest('form');
        var data = {};
        data[$sougr.attr('name')] = $sougr.val();
        console.log(data)
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            success: function(html) {
                console.log('hetml   ',html)
                $('#repas_sousGroupes').replaceWith(
                    $(html).find('#sous_groupe_libal')
                );
            }
        });
    });

});