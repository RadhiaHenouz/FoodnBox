$(document).on("click", ".ouvrir", function(e) {
    e.preventDefault();
    var id = $(this).closest('form').find('.id').val();
    var nom = $(this).closest('form').find('.nom').text();
    var message = $(this).closest('form').find('.message').text();
    var date = $(this).closest('form').find('.date').text();
    var url = $(this).closest('form').find('.url').text();
    var sujet = $(this).closest('form').find('.sujet').text();
    var user_id = $(this).closest('form').find('.user_id').val();
    $("#details").find('.id').text(id);
    $("#details").find('.nom').text(nom);
    $("#details").find('.message').text(message);
    $("#details").find('.date').text(date);
    $("#details").find('.url').text(url);
    $("#details").find('.sujet').text(sujet);
    $("#details").find('.user_id').text(user_id);


    var details = $('.details');
    details.show();
    details.css("display", "block");


});
$(document).on("click", ".reponse_plainte", function(e) {


    e.preventDefault();

    var id = $('.details').find('.id').text();
    var reponse = $('.details').find('.reponse').val();
    var user_id = $('.details').find('.user_id').text();

    if (!reponse) {
        alert("Impossible d'envoyer un email vide!");
        return false;
    }
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: 'html',
        data: {
            action: 'reponse_admin',
            id: id,
            reponse: reponse,
            user_id: user_id
        },
        success: function(resp) {
            console.log(resp);
            alert("Votre réponse a été envoyée");

        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            console.log(ajaxOptions);
            console.log(thrownError);
            console.log('Request failed: ' + thrownError);
        },

    });


});
$(document).on("click", ".nav-item", function(e) {
    e.preventDefault();
    var id = $(this).attr("id");

    $(".tab").hide(); // hiding open tab
    $("#messagerie_" + id).show(); // show tab
    console.log($("#messagerie_archive"));
    $("#messagerie_archive").css("display", "block");
    /*if(id=="link-email")
    {
        
        $(".messagerie_email").css("display","block");
        $(".messagerie_archive").css("display","none");
        $(".messagerie_prive").css("display","none");
        $(".nav-link").removeClass("active");
        $("#link-email a").addClass("active");
    }
    else if(id=="link-archive")
    {
    
    
        $(".messagerie_email").css("display","none");
        $(".messagerie_archive").css("display","block");
        $(".messagerie_prive").css("display","none");
        $(".nav-link").removeClass("active");
        $("#link-archive a").addClass("active");
    }
    else if(id=="link-prive")
    {
    
        $(".messagerie_email").css("display","none");
        $(".messagerie_archive").css("display","none");
        $(".messagerie_prive").css("display","block");
        $(".nav-link").removeClass("active");
        $("#link-prive a").addClass("active");
    }*/

});