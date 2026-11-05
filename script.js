jQuery(document).ready(function($) {

    var ConfirmBtn = document.getElementById('ConfirmBtn');
    var myBtn = document.getElementById('myBtn');


    ConfirmBtn.onclick = function() {
        $('#ConfirmBox').modal("show");
    }

    var AnnulerBtn = document.getElementById('CancelBtn');

    // When the user clicks on <span> (x), close the modal
    $(document).on('click', '#close', function() {

    });
    $('#Etape2').hide();
    $('#Etape3').hide();
    $('#prev').css('background-color', '#C1C1C1');

    $(document).on('click', '#next', function() {

        if (!ValidateByEtape($('.modal-content div:visible').prop('id'))) {
            return;
        }

    });

    $(document).on('click', '#prev', function() {
        //if(!ValidateByEtape($('.modal-content div:visible').prop('id')))
        //return;
        if ($('.modal-content div:visible').prop('id') == 'Etape1')
            return;
        if ($('.modal-content div:visible').prop('id') == 'Etape2') {
            $('#prev').css('background-color', '#C1C1C1');
            $('#Etape2').hide();
            $('#Etape1').show();
        }
        if ($('.modal-content div:visible').prop('id') == 'Etape3') {
            $('#Envoyer').hide();
            $('#next').css('background-color', '#EC7A5C');
            $('#Etape3').hide();
            $('#Etape2').show();
        }
        return false;
    });

    $(document).on('click', '#CmdeGroupe', function() {
        $('#Div-CmdeGroupe').show();
    });

    $(document).on('click', '.popupCloseButton', function() {
        $('#Div-CmdeGroupe').hide();
    });
});

function ListPartsValidate($this) {
    var tr = $this.closest('tr');
    var NomPart = tr.find('.NomPart').val();
    var EmailPart = tr.find('.EmailPart').val();
    var VerifEmailPart = tr.find('.VerifEmailPart').val();
    var TelPart = tr.find('.TelPart').val();
    var MtPart = tr.find('.MtPart').val();


    if (NomPart == '' || !ValidateEmail(EmailPart) || !ValidatePhone(TelPart) || EmailPart != VerifEmailPart) {


        tr.find('.Valid').css('visibility', 'collapse');

        tr.find('.inValid').css('visibility', 'visible');
    } else {
        tr.find('.inValid').css('visibility', 'collapse');

        tr.find('.Valid').css('visibility', 'visible');

    }


}
$('#ListParts').on('focusout', 'input', function() {
    var $this = $(this);
    return ListPartsValidate($this);
});
$('#ListParts').on('keyup', 'input', function() {
    var $this = $(this);
    return ListPartsValidate($this);
});

function ListPaysValidate($this) {
    var tr = $this.closest('tr');
    tr.each(function() {
        var NomPart = '',
            NbrePartParPay = 0;
        $(this).find('input').each(function() {

            if ($(this).attr('class') == 'NomPart')
                NomPart = $(this).val().trim();
            else if ($(this).attr('class') == 'NbrePartParPay')
                NbrePartParPay = $(this).val().trim();




        });
        if (NomPart == '' || !(Math.floor(NbrePartParPay) == NbrePartParPay && jQuery.isNumeric(NbrePartParPay) && NbrePartParPay > 0)) {


            tr.find('.Valid').css('visibility', 'collapse');

            tr.find('.inValid').css('visibility', 'visible');
        } else {
            tr.find('.inValid').css('visibility', 'collapse');

            tr.find('.Valid').css('visibility', 'visible');

        }


        var sum = 0;
        var NbrePart = parseInt($('#NbrePart').val()) || 0;

        var NbrePartsRest = parseInt($('#NbrePartsRest').val()) || 0;

        $('.NbrePartParPay').each(function() {
            sum += parseInt($(this).val()) || 0;

        });


        $('#NbrePartsRest').val(NbrePart - sum);







    });




}
$('#ListPays').on('focusout', 'input', function() {

    var $this = $(this);
    return ListPaysValidate($this);

});
$('#ListPays').on('keyup', 'input', function() {

    var $this = $(this);
    return ListPaysValidate($this);

});


$(document).on('click', '#Envoyer', function(e) {

    e.preventDefault();
    var formdata = $('#ValidCmdeGroupe');

    if (ValidateEtape3())
        $('#ConfirmBox').show();
});


$('#myModal').keypress(function(e) {

    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});
$(document).on('click', '.btn-coach', function(event) {
    event.preventDefault();
    return false;
});


$(document).on('click', '#ConfirmBtn', function(event) {
    event.preventDefault();
    var url = $(this).attr('url');
    var Nom = $('#Nom').val(),
        Prenom = $('#Prenom').val(),
        Email = $('#Email').val(),
        Tel = $('#Tel').val(),
        Montant = $('#MontantTotal').val();
    var NomPart = $('input[name^=\"NomPart\"]').serialize();
    var MtPart = $('input[name^=\"MtPart\"]').serialize();
    var TelPart = $('input[name^=\"TelPart\"]').serialize();
    var EmailPart = $('input[name^=\"EmailPart\"]').serialize();
    var href = document.getElementById("checkout_btn").href;



    jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        async: false,
        datatype: 'json',
        data: { action: 'sendEmail', Nom: Nom, Prenom: Prenom, Email: Email, Tel: Tel, Montant: Montant, NomPart: NomPart, MtPart: MtPart, TelPart: TelPart, EmailPart: EmailPart },
        success: function(resp) {
            console.log(resp)

            alert('votre email a été envoyé');
            $('#ConfirmBox').hide();
            window.location.href = href;
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            console.log('Request failed: ' + thrownError);
        },
    });
    //location.reload();

});
$(document).on('click', '#CancelBtn', function(event) {
    $('#ConfirmBox').hide();
    /*$('#NbrePart').val('');
    var Montant=$('#MontantTotal').val();
    $('#MontantRest').val(Montant);
    $('#ListParts tbody tr').remove();
    $('#CheckConds').prop('checked', false);
    */
});


$('#ListParts').on('focusout', '.MtPart', function() {

    if (isNaN(parseFloat($(this).val().replace(',', '.')))) { alert('erreur'); }
    var sum = 0;

    var Montant = parseFloat($('#MontantTotal').val().replace(',', '.'));
    var MontantRest = parseFloat($('#MontantRest').val().replace(',', '.'));
    $('.MtPart').each(function() {
        sum += parseFloat($(this).val().replace(',', '.'));

    });


    $('#MontantRest').val((Montant - sum).toFixed(2).replace(',', '.'));



});

function ValidateEtape1() {

    var NbrePart = document.getElementById('NbrePart').value;

    var NbrePays = document.getElementById('NbrePays').value;

    if (!(Math.floor(NbrePart) == NbrePart && jQuery.isNumeric(NbrePart) && NbrePart > 0))

    { alert('Format du nombre des participants (ou parts) est incorrect !'); return false; }
    if (!(Math.floor(NbrePays) == NbrePays && $.isNumeric(NbrePays) && NbrePays > 0)) { alert('Format du nombre des payeurs est incorrect !'); return false; }
    if (NbrePart < NbrePays) { alert('Le nombre de parts doit être superieur au nombre de payeurs'); return false; }
    $('#ListPays tbody tr').remove();
    $('#ListPays').append('<tr><td data-label=\"Payeur N°\">PAYEUR 1 COACH</td><td data-label=\"Nom participant\" ><input type=\"text\" autocomplete=\"nope\" style=\"margin-left:0px;\"	class=\"NomPart\" placeholder=\"Nom du participant\" value=\"' + $('#Nom').val() + ' ' + $('#Prenom').val() + '\" readonly /></td><td style=\"display:none;\" ><input type=\"text\" autocomplete=\"nope\"  style=\"width:auto;margin-left:0px;\" class=\"EmailPart\" placeholder=\"Nombre de parts\" value=\"' + $('#Email').val() + '\" /></td><td style=\"display:none;\" ><input type=\"text\" autocomplete=\"nope\"   style=\"width:150px;\" class=\"TelPart\" value=\"' + $('#Tel').val() + '\" /></td><td data-label=\"Nombre de parts\"><input type=\"text\" autocomplete=\"nope\" name=\"NbrePartParPay[]\" style=\"\" class=\"NbrePartParPay\" placeholder=\"Nombre de parts\" /></td><td  data-label=\" \" class=\"Valid\" style=\"text-align: center;vertical-align: middle;visibility: collapse;\" ><img style=\"vertical-align: top;\" src=\"/wp-content/uploads/2021/02/check.png\" alt=\"\" /></td><td data-label=\" \" class=\"inValid\" style=\"text-align: center;vertical-align: middle;visibility: collapse;\"><img style=\"vertical-align: top;\" src=\"/wp-content/uploads/2021/02/close.png\" alt=\"\" /></td></tr>');

    for (i = 1; i < NbrePays; i++) {
        var payeur = 'PAYEUR ' + (i + 1)
        $('#ListPays').append('<tr><td data-label=\"Payeur N°\">' + payeur + '</td><td data-label=\"Nom participant\"><input type=\"text\" autocomplete=\"nope\" style=\"margin-left:0px;\"	class=\"NomPart\" placeholder=\"Nom du participant\"  /></td><td style=\"display:none;\"><input type=\"text\" autocomplete=\"nope\" style=\"margin-left:0px;\" class=\"EmailPart\" placeholder=\"Nombre de parts\" /></td><td style=\"display:none;\" ><input type=\"text\" autocomplete=\"nope\" style=\"width:100%;\" class=\"TelPart\" placeholder=\"Nombre de parts\"  /></td><td data-label=\"Nombre de parts\"><input type=\"text\" autocomplete=\"nope\" name=\"NbrePartParPay[]\" style=\"\" class=\"NbrePartParPay\" placeholder=\"Nombre de parts\" /></td><td data-label=\" \" class=\"Valid\" style=\"text-align: center;vertical-align: middle;visibility: collapse;\"><img src=\"/wp-content/uploads/2021/02/check.png\" alt=\"\" /></td><td data-label=\"  \" class=\"inValid\"style=\"text-align: center;vertical-align: middle;visibility: collapse;\" ><img style=\"vertical-align: top;\" src=\"/wp-content/uploads/2021/02/close.png\" alt=\"\" /></td></tr>');
    }
    //alert($('#ListPays tbody').find('tr').eq(1).find('.NomPart').val());
    $('#prev').css('background-color', '#EC7A5C');
    $('#NbrePartsRest').val($('#NbrePart').val());
    $('#Etape1').hide();
    $('#Etape2').show();
    return true;


}

function ValidateByEtape(Etape) {
    if (Etape == 'Etape1')
        return ValidateEtape1();

    else if (Etape == 'Etape2')
        return ValidateEtape2();
    else if (Etape == 'Etap3')
        return;
}

function ValidateEtape3() {

    var ChampsInvalides = false;
    $('#ListParts tbody tr').each(function() {
        var tr = $(this);
        var NomPart = tr.find('.NomPart').val();
        var EmailPart = tr.find('.EmailPart').val();
        var VerifEmailPart = tr.find('.VerifEmailPart').val();
        var TelPart = tr.find('.TelPart').val();
        var MtPart = tr.find('.MtPart').val();

        if (NomPart == '' || !ValidateEmail(EmailPart) || !ValidatePhone(TelPart) || EmailPart != VerifEmailPart) {
            ChampsInvalides = true;
            return false;
        }







    })

    if (ChampsInvalides == true) {
        alert('Il y a des champs invalides!');
        return false;
    }
    if (parseFloat($('#MontantRest').val().replace(',', '.')) !== 0) { alert('impossible de valider , montant restant différent de 0'); return false }
    if ($('#CheckConds').prop('checked') == false) { alert('Veuillez accepter les conditions avant de valider'); return false; }
    return true;







}

function ValidateEtape2() {
    var NbrePart = $('#NbrePart').val();
    var SommePart = 0;
    var ChampsInvalides = false;
    $('#ListPays tbody tr').each(function() {
        var tr = $(this);

        tr.each(function() {
            var NomPart = '',
                NbrePartParPay = 0;
            $(this).find('input').each(function() {

                if ($(this).attr('class') == 'NomPart')
                    NomPart = $(this).val().trim();
                else if ($(this).attr('class') == 'NbrePartParPay') {
                    NbrePartParPay = $(this).val().trim();
                    SommePart += parseInt(NbrePartParPay);
                }




            });
            if (NomPart == '' || !(Math.floor(NbrePartParPay) == NbrePartParPay && jQuery.isNumeric(NbrePartParPay) && NbrePartParPay > 0)) {
                ChampsInvalides = true;
                return false;
            }


        });



    })

    if (ChampsInvalides == true) {
        alert('Il y a des champs invalides!');
        return false;
    }
    if (NbrePart != SommePart) {
        alert('La somme des parts n\'est pas valide!');
        return false;
    }
    var NbrePart = $('#NbrePart').val();
    var NbrePays = $('#NbrePays').val();
    var Montant = parseFloat($('#MontantTotal').val().replace(',', '.'));
    var MontantRest = parseFloat($('#MontantRest').val().replace(',', '.'));
    var MontantPart = (Montant / NbrePart).toFixed(2);
    $('#ListParts tbody tr').remove();
    $('#MontantPart').val('');
    $('#MontantRest').val('0,00');
    var MontantFin = (Montant - (NbrePart - 1) * MontantPart).toFixed(2);

    var Somme = 0;


    //$('#ListParts').append('<tr><td ><input type=\"text\" name=\"NomPart[]\" style=\"width:200px;\"	class=\"NomPart\" placeholder=\"Nom du participant\" value=\"'+$('#Nom').val()+' '+$('#Prenom').val()+'\"  /></td><td><input type=\"text\" name=\"EmailPart[]\" style=\"width:150px;\" class=\"EmailPart\" placeholder=\"Email du participant\" value=\"'+$('#Email').val()+'\" /></td><td><input type=\"text\" name=\"TelPart[]\" style=\"width:150px;\" class=\"TelPart\" placeholder=\"Tél du participant\" value=\"'+$('#Tel').val()+'\" /></td><td><input type=\"text\" name=\"MtPart[]\" style=\"width:150px;\" class=\"MtPart\" placeholder=\"Montant du participant\" value=\"'+MontantPart.replace('.',',')+'\" /></td><td class=\"Valid\" style=\"display:none;padding:8px;\"><img src=\"images/virtuemart/typeless/check.png\" alt=\"\" /></td></tr>');

    for (i = 0; i < NbrePays; i++) {
        var NomPart = $('#ListPays tbody').find('tr').eq(i).find('.NomPart').val();
        var EmailPart = $('#ListPays tbody').find('tr').eq(i).find('.EmailPart').val();
        var TelPart = $('#ListPays tbody').find('tr').eq(i).find('.TelPart').val();

        var NbrePartParPay = $('#ListPays tbody').find('tr').eq(i).find('.NbrePartParPay').val();
        MtPartPay = parseInt(NbrePartParPay) * MontantPart;
        var readonly = '';
        if (i == 0)
            readonly = 'readonly';
        if (i == NbrePays - 1)
            MtPartPay = (Montant - Somme).toFixed(2);
        else
            Somme += MtPartPay;
        //alert(('#ListPays').find('tr').eq(0).('td:eq(1) input[type=\"text\"]').val());
        $('#ListParts').append('<tr><td data-label=\" Nom participant\"><input type=\"text\" autocomplete=\"nope\" readonly name=\"NomPart[]\"	class=\"NomPart\" placeholder=\"Nom du participant\"  value=\"' + NomPart + '\"/></td><td data-label=\"Email\"><input type=\"text\" autocomplete=\"nope\" name=\"EmailPart[]\" class=\"EmailPart\" placeholder=\"Email du participant\"  value=\"' + EmailPart + '\"  ' + readonly + ' /></td><td data-label=\"Vérif Email\"><input type=\"text\" autocomplete=\"nope\" name=\"VerifEmailPart[]\" class=\"VerifEmailPart\" placeholder=\"Email du participant\" value=\"' + EmailPart + '\"  ' + readonly + ' /></td><td data-label=\"Téléphone \"><input type=\"text\" autocomplete=\"nope\" name=\"TelPart[]\" class=\"TelPart\" placeholder=\"Tél du participant\" value=\"' + TelPart + '\"  ' + readonly + '  /></td><td data-label=\"Montant\"><input type=\"text\" autocomplete=\"nope\" name=\"MtPart[]\" style=\"width:70px\" class=\"MtPart\" placeholder=\"Montant du participant\" value=\"' + MtPartPay + '\" /></td><td data-label=\" \" class=\"Valid\" style=\"display:none;padding:0;\"><img src=\"/wp-content/uploads/2021/02/check.png\" alt=\"\" /></td><td data-label=\" \" class=\"inValid\" style=\"display:none;padding:0;\"><img src=\"/wp-content/uploads/2021/02/close.png\" alt=\"\" /></td></tr>');
    }
    //$('#ListParts').append('<tr><td ><input type=\"text\" name=\"NomPart[]\" style=\"width:200px;\"	class=\"NomPart\" placeholder=\"Nom du participant\"  /></td><td><input type=\"text\" name=\"EmailPart[]\" style=\"width:150px;\" class=\"EmailPart\" placeholder=\"Email du participant\"  /></td><td><input type=\"text\" name=\"TelPart[]\" style=\"width:150px;\" class=\"TelPart\" placeholder=\"Tél du participant\"  /></td><td><input type=\"text\" name=\"MtPart[]\" style=\"width:150px;\" class=\"MtPart\" placeholder=\"Montant du participant\" value=\"'+Mt.replace('.',',')+'\" /></td><td class=\"Valid\" style=\"display:none;padding:8px;border-bottom: none;\"><img src=\"images/virtuemart/typeless/check.png\" alt=\"\" /></td></tr>');


    //$('#ListParts').append('<tr><td>'+Nom+'</td><td>'+Montant+'</td></tr>');
    $('#Envoyer').show();
    $('#next').css('background-color', '#C1C1C1');
    $('#Etape2').hide();
    $('#Etape3').show();
    $('#ListParts tbody').find('tr').eq(0).find('.MtPart').focus();


    return true;
}



function checkIfEmpty() {
    var empty = false;
    $('.NomPart').each(function() {
        if ($(this).val().trim() == '') {
            empty = true;

        }
    });
    return empty;
}


function ValidatePhone(phone) {
    if (phone.match(/^\d{10}/)) {
        return (phone.length === 10);
    }
    return false;
}

function ValidateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function ValidateAmount(Mt) {
    const re = /^\d+(\.\d{1,2})?$/;
    return re.test(Mt);

}