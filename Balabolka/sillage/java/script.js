jQuery(function() {


    var site_url = $('#site_url').val(),
        base_url = $("#base_url").val();

    $('#NouvelAssure').on("click", function() {


        var isBusy = false;

        var IdAssure = $("#IdAssure").val(),
            NoAssure = $("#NoAssure").val(),
            NomAssure = $("#NomAssure").val(),
            PrenomAssure = $("#PrenomAssure").val(),
            TitAssure = $("#TitAssure").val(),
            EmailAssure = $("#EmailAssure").val();

        if (IdAssure == null || IdAssure.length == 0) { alert("Aucun client n'a été choisi !"); return; }


        $("#loader").show();
        $.ajax({
            url: base_url() + "Main/NouvelAssure",
            data: {

                'IdAssure': IdAssure,
                'NoAssure': NoAssure,
                'NomAssure': NomAssure,
                'PrenomAssure': PrenomAssure,
                'TitAssure': TitAssure,
                'EmailAssure': EmailAssure
            },

            type: "POST",
            dataType: "json",
            beforeSend: function() {
                isBusy = true;
            },
            success: function(data) {
                isBusy = false;

                //alert(data);  
                $("#loader").hide();
                if (data === "true")
                    alert("L'email a été envoyé correctement");
                else
                    alert("L'email n'a pas été envoyé,\n");
            },
            /*error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }*/
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loader").hide();
                if (jqXHR.status == 500) {
                    alert('Internal error: ' + jqXHR.responseText);
                } else {
                    alert(errorThrown);
                }
            }

        });





    });



    var IdAssure, MvtEchDu, MvtEchAu, MvtId, CieId, AssureNo;

    $(function() {
        $(document).on('keydown', '.Assure', function(e) {
            if ($(this).attr('id') == "Assure")
                $("#AssureNo").val("");
            else if ($(this).attr('id') == "AssureNo")
                $("#Assure").val("");
            if (e.keyCode == 46 || e.keyCode == 8) {
                $("#AssureNo").val("");
                $("#Assure").val("");
                $("#link").attr("href", "");
                $('#AttesPrec').css("display", "none");
                IdAssure = null;
                MvtEchDu = null, MvtEchAu = null, MvtId = null, CieId = null;
                AssureNo = null;
                $(".FieldPlaceholder").val("");
                $("#AttNom").empty();
                $("#AttDateGen").empty();
                $("#AttGen").empty();
                $("#Actions").empty();
            }
        });
        $(document).on('click', '#Email', function() {
            $.ajax({
                url: base_url + "Main/EnvoiAttestationEmail",
                type: 'POST',
                datatype: "text",
                data: {
                    'CieId': CieId,
                    'NomAssure': $("#NomAssure").val(),
                    'PrenomAssure': $("#PrenomAssure").val(),
                    'CiviliteAssure': $("#TitAssure").val(),
                    'EmailAssure': $("#EmailAssure").val(),
                    'NomFichier': $("#AttNom").text()
                },
                success: function(response) {

                    $("#dialog").text(response);
                    $("#dialog").dialog({
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        buttons: {

                            "OK": function() {
                                $(this).dialog("close");
                            }
                        }
                    });

                }
            })
        });
        $(document).on('click', '#Regenerer', function() {
            $.ajax({
                url: base_url + "Main/RegenererAttestation",
                type: 'POST',
                datatype: "text",
                data: {
                    'IdAssure': IdAssure,
                    'MvtId': MvtId,
                    'CieId': CieId,
                    'NomAssure': $("#NomAssure").val(),
                    'PrenomAssure': $("#PrenomAssure").val(),
                    'EmailAssure': $("#EmailAssure").val(),
                    'CiviliteAssure': $("#TitAssure").val(),
                    'NomFichier': $("#AttNom").text()

                },
                success: function(response) {

                    $("#dialog").text(response);
                    $("#dialog").dialog({
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        buttons: {

                            "OK": function() {
                                $(this).dialog("close");
                            }
                        }
                    });

                }
            })
        });
        $(document).on('click', '#Generer', function() {
            if (IdAssure == null) { alert("Aucun client n'a été choisi !"); return; }
            $("#loader").show();



            $.ajax({
                url: base_url + "Main/GenererAttestation",
                type: 'POST',
                datatype: "html",
                data: {
                    'IdAssure': IdAssure,
                    'MvtId': MvtId,
                    'NoAssure': $("#NoAssure").val(),
                    'NomAssure': $("#NomAssure").val(),
                    'PrenomAssure': $("#PrenomAssure").val(),
                    'TitAssure': $("#TitAssure").val(),
                    'AdrAssure': $("#AdrAssure").val(),
                    'CpAssure': $("#CpAssure").val(),
                    'VilleAssure': $("#VilleAssure").val(),
                    'NatAssure': $("#NatAssure").val(),
                    'BatNom': $("#BatNom").val(),
                    'BatConstructeur': $("#BatConstructeur").val(),
                    'BatModele': $("#BatModele").val(),
                    'MotPuissance': $("#MotPuissance").val(),
                    'MotAnnee': $("#MotAnnee").val(),
                    'MotMarque': $("#MotMarque").val(),
                    'EmailAssure': $("#EmailAssure").val(),
                    'CieIdAssure': CieId,
                    'CieNomAssure': $("#CieNomAssure").val(),
                    'PolNoAssure': $("#PolNoAssure").val(),
                    //'MvtId' : $("#MvtId").val(ui.item.MVT_ID),
                    'MvtEchDu': $("#MvtEchDu").val(),
                    'MvtEchAu': $("#MvtEchAu").val()


                },
                success: function(response) {
                    var date = getDate();
                    $("#loader").hide();
                    $("#link").attr("href", base_url + "Main/OpenPDF/" + $("#NoAssure").val() + "_" + currentDate + ".pdf");

                    $('#AttesPrec').css("display", "block");
                    $("#dialog").text(response);

                    $("#dialog").dialog({
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        buttons: {

                            "OK": function() {
                                $(this).dialog("close");
                            }
                        }
                    });

                }
            });
        });
        $(".Assure").autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: base_url + "Main/ListeAttestations",
                    data: { Assure: $("#Assure").val(), AssureNo: $("#AssureNo").val() },
                    dataType: "json",
                    cors: true,
                    type: "POST",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Access-Control-Allow-Methods": "*",
                        "Access-Control-Allow-Headers": "*"
                    },


                    crossDomain: true,
                    success: function(data) {

                        response($.map(data, function(item) {
                            console.log(data);
                            console.log(item);

                            return {

                                //value: item.Ass_Nom + item.Ass_Prenom ,

                                label: ((item.Ass_Nom === null) ? "" : item.Ass_Nom) + " " + ((item.Ass_Prenom === null) ? "" : item.Ass_Prenom) + ", " + item.ASS_No + ", " + item.Cie_Nom + ", " + item.Pol_No,
                                ASS_No: item.ASS_No,
                                ASS_Id: item.ASS_Id,
                                ASS_Nom: item.Ass_Nom,
                                ASS_Prenom: item.Ass_Prenom,
                                TIT_Nom: item.TIT_Nom,
                                Ass_Adr1: item.Ass_Adr1,
                                Ass_CP: item.Ass_CP,
                                Ass_Ville: item.Ass_Ville,
                                NAT_Nom: item.NAT_Nom,
                                BAT_Nom: item.Avb_Nom,
                                BAT_Constructeur: item.BAT_Constructeur,
                                BAT_Modele: item.BAT_Modele,
                                MOT_Puissance: item.MOT_Puissance,
                                MOT_Annee: item.MOT_Annee,
                                ASS_Email: item.ASS_Email,
                                Cie_Id: item.Cie_Id,
                                Cie_Nom: item.Cie_Nom,
                                Pol_No: item.Pol_No,
                                MVT_ID: item.MVT_ID,
                                Mvt_EchDu: item.Mvt_EchDu,
                                MVT_EchAu: item.MVT_EchAu,
                                AttNom: item.AttNom,
                                AttGen: item.AttGen,
                                AttDateGen: item.AttDateGen,
                                MVT_Solde: item.MVT_Solde,
                                MVT_MtSolde: item.MVT_MtSolde


                            }

                        }));

                    }
                });
            },

            minLength: 2,
            select: function(e, ui) {
                $("#link").attr("href", "");
                console.log(ui.item.MVT_MtSolde);
                if (ui.item.MVT_Solde <= 0)

                {
                    $("#Generer").css("background-color", "#AAAAAA");
                    $("#Generer").attr("disabled", true);
                } else {
                    $("#Generer").css("background-color", "#861B2E");
                    $("#Generer").attr("disabled", false);
                }
                if (ui.item.MVT_MtSolde == 0)
                    $("#SoldeAssure").css("color", "black");
                else if (ui.item.MVT_MtSolde < 0)
                    $("#SoldeAssure").css("color", "red");
                else
                    $("#SoldeAssure").css("color", "green");
                var s = ui.item.MVT_MtSolde.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                $("#SoldeAssure").val(s + " €");
                $('#AttesPrec').css("display", "none");
                //$("#AttesPrec").show();
                $("#Assure").val(ui.item.ASS_Nom + " " + ui.item.ASS_Prenom);
                //$("#AssureNo").val(ui.item.ASS_No);
                $("#IdAssure").val(ui.item.ASS_Id);
                $("#NoAssure").val(ui.item.ASS_No);
                $("#Paye").val(ui.item.MVT_Solde);
                $("#NomAssure").val(ui.item.ASS_Nom);
                $("#PrenomAssure").val(ui.item.ASS_Prenom);
                $("#TitAssure").val(ui.item.TIT_Nom);
                $("#AdrAssure").val(ui.item.Ass_Adr1);
                $("#CpAssure").val(ui.item.Ass_CP);
                $("#VilleAssure").val(ui.item.Ass_Ville);
                $("#NatAssure").val(ui.item.NAT_Nom);
                $("#BatNom").val(ui.item.BAT_Nom);
                $("#BatConstructeur").val(ui.item.BAT_Constructeur);
                $("#BatModele").val(ui.item.BAT_Modele);
                $("#MotPuissance").val(ui.item.MOT_Puissance);
                $("#MotAnnee").val(ui.item.MOT_Annee);
                $("#MotMarque").val(ui.item.MOT_Marque);
                $("#EmailAssure").val(ui.item.ASS_Email);
                $("#CieNomAssure").val(ui.item.Cie_Nom);
                $("#PolNoAssure").val(ui.item.Pol_No);
                $("#MvtId").val(ui.item.MVT_ID);
                $("#MvtEchDu").val(ui.item.Mvt_EchDu);
                $("#MvtEchAu").val(ui.item.MVT_EchAu);
                $("#MvtEchAu").val(ui.item.MVT_EchAu);
                if (ui.item.AttNom !== null) {
                    $("#AttNom").html('<a href="' + base_url + "Main/OpenPDF/" + '"' + ui.item.AttNom + '">' + ui.item.AttNom + '</a>');
                    $("#AttDateGen").text(ui.item.AttDateGen);
                    $("#Actions").html('<button id="Email" >Email</button><button id="Regenerer">Re/Générer</button>')

                } else {
                    $("#AttNom").html('-');
                    $("#AttDateGen").text('-');
                }
                if (ui.item.AttGen === 0 || ui.item.AttGen === null)
                    $("#AttGen").text("Non");
                else
                    $("#AttGen").text("Oui");
                MvtId = ui.item.MVT_ID;
                MvtEchDu = ui.item.Mvt_EchDu;
                MvtEchAu = ui.item.MVT_EchAu;
                IdAssure = ui.item.ASS_Id;
                CieId = ui.item.Cie_Id;
                AssureNo = ui.item.ASS_No;
                $("#tabs").tabs({ active: 0 });
                //loadDocumentsGeneres();
                //loadSituationComptable();
                //loadStatistiquesAssure();

                /* $.ajax(
	 {
		 type: "POST",
		 url: "ListeAttestations",
		 data: {'AssureNo':AssureNo},
		 contentType: "application/json;charset=utf-8",
		 dataType: "json",
		 cache: false,
		 success: function (data) {
			
 
		 var trHTML = '';
 
		 $.each(data, function (i, item) {
 
			 trHTML += '<tr><td>' + item.AttNom+ '</td><td>'+item.AttDateGen+ '</td><td>'+ item.AttGen+ '</td><td>' + data.AttGen+ '</td></tr><button>Re/Générer</button><button>Re/Générer</button></td><td>';
		 });
		 $('#ListeAttes').append(trHTML);
 
		 },
 
		 error: function (msg) {
 
  console.log("num"+$("#AssureNo").val());
   console.log("num1"+AssureNo);
			 alert(msg.responseText);
		 }
	 });*/


            }



        });
        $("#Display").on("click", function() {

            $(".Hidden").show();
        });
        $('#btnShow').on("click", function() {
            window.open('C:\Users\Radhia\Documents\Sillage_Attestations\TEST.pdf');
        });
        $('#voirPlus').on('click', function() {
            $('.Hidden').show();
        });
        $('input[name=categorie]').on('change', function(e) {
            loadDocumentsGeneres();
        })
        $(document).off('change').on('change', '.FiltreDG', function() {
            loadDocumentsGeneres();
        });
        $(document).on('change', '#Annee', function() {

            loadSituationComptable();
        });
        $(document).on('change', '.FiltreSDA', function() {

            loadStatistiquesAssure();
        });
        $(document).on('click', '#DG', function() {

            loadDocumentsGeneres();

        });
        $(document).on('click', '#SC', function() {

            loadSituationComptable();

        });
        $(document).on('click', '#SD', function() {

            loadStatistiquesAssure();

        });
        $(document).on('click', '.EnvoyerEmail', function() {

            var Type = $('input[name=categorie]:checked').val();
            var NomFichier = $(this).closest('tr').children('.NomFichier').text();
            $("#loader").show();
            $.ajax({
                url: base_url + "Main/EnvoiEmailDocument",
                data: {
                    'IdAssure': $("#IdAssure").val(),
                    'Type': Type,
                    'NomAssure': $("#NomAssure").val(),
                    'PrenomAssure': $("#PrenomAssure").val(),
                    'EmailAssure': $("#EmailAssure").val(),
                    'CiviliteAssure': $("#TitAssure").val(),
                    'NomFichier': NomFichier,
                    'MvtId': $("#MvtId").val()

                },
                type: "POST",
                dataType: "html",
                beforeSend: function() {
                    isBusy = true;
                },
                success: function(data) {
                    isBusy = false;
                    $("#loader").hide();
                    alert(data);

                },
                /*error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }*/
                error: function(jqXHR, textStatus, errorThrown) {
                    $("#loader").hide();
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert(errorThrown);
                    }
                }



            });



        });


    })

    function loadDocumentsGeneres() {
        var IdAssure = $("#IdAssure").val();
        var DateDebut = null,
            DateFin = null;
        if ($("#DateDebut").val())
            DateDebut = $("#DateDebut").val();
        if ($("#DateFin").val())
            DateFin = $("#DateFin").val();
        if ((IdAssure.trim()).length == 0) return;
        var Type = $('input[name=categorie]:checked').val();
        $("#loader").show();
        $.ajax({
            url: base_url + "Main/DocumentsGeneres",
            data: {
                'IdAssure': IdAssure,
                'Type': Type,
                'DateDebut': DateDebut,
                'DateFin': DateFin
            },

            type: "POST",
            dataType: "html",
            beforeSend: function() {
                isBusy = true;
            },
            success: function(data) {
                isBusy = false;
                $("#loader").hide();
                //alert(data); 
                $("#div_table").empty();
                $("#div_table").append(data);
                $('#myTable').DataTable({
                    "dom": '<"top">rt<"bottom"flpi><"clear">'
                });
                $("#SearchField");
            },
            /*error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }*/
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loader").hide();
                if (jqXHR.status == 500) {
                    alert('Internal error: ' + jqXHR.responseText);
                } else {
                    alert(errorThrown);
                }
            }

        });
    }

    function loadSituationComptable() {
        var IdAssure = $("#IdAssure").val();
        var Annee = null;
        if ($("#Annee").val())
            Annee = $("#Annee").val();
        console.log(IdAssure + "hhhhh" + Annee);
        if ((IdAssure.trim()).length == 0) return;
        $("#loader").show();
        $.ajax({
            url: base_url + "Main/SituationComptable",
            data: {
                'IdAssure': IdAssure,
                'Annee': Annee
            },

            type: "POST",
            dataType: "html",
            success: function(data) {
                console.log(data);
                $("#div_table_SC").empty();
                $("#div_table_SC").append(data);
                $('#myTableSC').DataTable({
                    "dom": '<"top">rt<"bottom"flpi><"clear">'
                });
                $("#loader").hide();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loader").hide();
                if (jqXHR.status == 500) {
                    alert('Internal error: ' + jqXHR.responseText);
                } else {
                    alert(errorThrown);
                }
            }

        });

    }

    function loadStatistiquesAssure() {
        var NoAssure = $("#NoAssure").val();
        var Date = null;
        if ($("#Date").val())
            Date = $("#Date").val();
        if ((NoAssure.trim()).length == 0) return;
        $("#loader").show();
        $.ajax({
            url: base_url + "Main/StatistiquesAssure",
            data: {
                'NoAssure': NoAssure,
                'Date': Date
            },

            type: "POST",
            dataType: "html",
            success: function(data) {
                $("#div_table_SDA").empty();
                $("#div_table_SDA").append(data);
                $('#myTableSDA').DataTable({
                    "dom": '<"top">rt<"bottom"flpi><"clear">'
                });
                $("#loader").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loader").hide();
                if (jqXHR.status == 500) {
                    alert('Internal error: ' + jqXHR.responseText);
                } else {
                    alert(errorThrown);
                }
            }

        });

    }

    function OpenLoadingDialog() {

    };

    function getDate(date) {
        var today = new Date(date);
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!

        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        var today = dd + '-' + mm + '-' + yyyy;
        return today;
    }


    function currentDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;
        return today;
    }
})