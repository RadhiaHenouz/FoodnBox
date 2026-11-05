
<head>
<title>Dossier Compagnie</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


 
</head>
<body>
 <div class="UI_Container" >


    <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->view('Menu');
?>
<div id="loader" style="display: none"></div> 
<div id="Entete">
<br>
<h1>
    Statistiques compagnie
</h1>
Séléctionner la compagnie:
<select name="Compagnies" id="Compagnies" onchange="loadStatistiques(this)" >
<option value='' data-email='' data-nom=''></option>
    

<?php 

    foreach($Results as $Result)
    echo "<option value='".$Result["Id"]."' data-email='".$Result['Mail']."' data-nom='".$Result['Raison sociale']."'>".$Result["Raison sociale"]."</option>";
    //echo "<option value= '".$Result["Raison sociale"]."'>";
    ?>

</select>
<br><br>
<div class="TypeStat">
  <label>
    <input type="radio" name="TypeStat" value="D" checked /> Statistiques Détaillées
  </label>
  <label>
    <input type="radio" name="TypeStat" value="G" /> Statistiques globales
  </label>
</div>

<div id="div_table" style="overflow:auto">

</div>

</div>
<div id="dialog" style="display: none;">
    <div>
        <iframe id="frame"></iframe>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="<?php echo site_url("java/jquery.dataTables.js")?>"></script>
<script type="text/javascript">

function loadStatistiques(e) 
{
  base_url = $("#base_url").val();
  console.log(e);
  EntIdCie=$("#Compagnies").val();
  var selected = $("#Compagnies").find('option:selected');
  var Email = selected.data('email'); 
    
  var date = null;
  if ($("#Date").val())
  date= $("#Date").val();
  var Type = $('input[name=TypeStat]:checked').val();
  $("#loader").show();
        $.ajax({
            url: base_url + "Main/StatistiquesCompagnie",
            data: {
                'EntIdCie': EntIdCie,
                'Type': Type,
                'Date': date
            },

            type: "POST",
            dataType: "html",
            beforeSend: function() {
                isBusy = true;
            },
            success: function(data) {
                isBusy = false;
                $("#loader").hide();
                 
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

$(document).ready(function(){
$('input[name=TypeStat]').on('change', function(e) {
            loadStatistiques();
        });
$(document).off('change').on('change', '.FiltreSC', function() {
            loadStatistiques();
});


$(document).on("click",".EnvoyerSC",function(){
var EntIdCie=$("#Compagnies").val();

var selected = $("#Compagnies").find('option:selected');
var EmailCie = selected.data('email');
var Nom=selected.data("nom");
var date = null;
if ($("#Date").val())
date= $("#Date").val();
var Type = $('input[name=TypeStat]:checked').val();
$("#loader").show();

      $.ajax({
          url: "<?php echo base_url(). "Main/EnvoiEmailStatistiquesCompagnie";?>",
          data: {
              'EntIdCie': EntIdCie,
              'Type': Type,
              'Email':EmailCie,
              'Date': date,
              'Nom':Nom
          },

          type: "POST",
          dataType: "text",
          beforeSend: function() {
              isBusy = true;
          },
          success: function(response) {
                    console.log(response);
                    $("#loader").hide();
                    alert(response);
                    //$("#dialog").text(response);
                    /*$("#dialog").dialog({
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        buttons: {

                            "OK": function() {
                                $(this).dialog("close");
                            }
                        }
                    });*/
          },
          /*error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
          }*/
          error: function(jqXHR, textStatus, errorThrown) {
            $("#loader").hide();
              console.log(jqXHR);
              if (jqXHR.status == 500) {
                  alert('Internal error: ' + jqXHR.responseText);
              } else {
                  alert(errorThrown);
              }
          }

      });
});

})

</script>
