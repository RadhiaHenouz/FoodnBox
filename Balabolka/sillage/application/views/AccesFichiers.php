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
 Accès documents
</h1>
Séléctionner la compagnie:
<select name="Type" id="Type" onchange="loadDocuments(this)" >
<option value='0'></option>
<option value='1'>Attestations</option>
<option value='2'>Quittances</option>  
<option value='3'>Relances</option>  
<option value='4'>Situations Comptables</option>
<option value='5'>Statistiques Détaillées Assuré</option>
<option value='6'>Statistiques Détaillées Compagnie</option>
<option value='7'>Statistiques Globales Compagnie</option>
</select>
<br><br>


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

function loadDocuments(e) 
{
  base_url = $("#base_url").val();
  console.log(e);
  var Type = $('#Type').val();
  $("#loader").show();
        $.ajax({
            url: base_url + "Main/DetailsFichier",
            data: 
            {
                
                'Type': Type,
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
                $('#myTable').DataTable();
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
$('input[name=Type]').on('change', function(e) {
            loadDocuments();
        });




})

</script>
