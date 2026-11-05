<div div class="filtre">

<table border="0" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Séléctionner la Date :</td>
                        <td>
                            <input type="date" id="Date" class="FiltreSDA" name="Date" value='<?php if($Date)echo $Date;?>' >
                        </td>
                        
                    </tr>
                </tbody>
            </table> 
</div>
<div style="width:100%;overflow:auto;padding-bottom:5%;">
<table id="myTableSDA" class="display">
        <thead>
            <tr>
                <th>Nom assuré</th>
                <th>N° assuré</th>
                <th>N° police</th>
                <th>Contrat</th>
                <th>Valeur assurée</th>
                <th>Nom du bateau(x)</th>
                <th>Année</th>
                <th>Mt primes émises</th>
                <th>Mt primes réglés</th>
                <th>Mt prévision sinistre</th>
                <th>Mt sinistre réglé</th>
                <th>Nombre sinistres</th>
                <th>Rapport S/P</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($results as $result)
        {
            $result=array_values($result);
            echo "<tr>
            <td>".$result[0]."</a></td>
            <td>".$result[1]."</td>
            <td>".$result[2]."</td>
            <td>".$result[3]."</td>
            <td>".$result[4]."</td>
            <td>".$result[5]."</td>
            <td>".$result[6]."</td>
            <td>".number_format($result[7],2,',',' ')." €"."</td>
            <td>".number_format($result[8],2,',',' ')." €"."</td>
            <td>".number_format($result[9],2,',',' ')." €"."</td>
            <td>".number_format($result[10],2,',',' ')." €"."</td>
            <td>".$result[11]."</td>
            <td>".number_format($result[12],2,',',' ')." €"."</td>
            </tr>";
        }
        ?>
        </tbody>
        
    </table>
    </div>
    <br><br>
    <div class="Generer" style="text-align:center; margin-left:10%;width:80%;">  
    <button id="EnvoyerSA">Envoyer</button>  
    </div>
    <script type="text/javascript">

$(document).on("click","#EnvoyerSA",function(){
    $("#loader").show();
    $.ajax({
                url: "<?php echo base_url().'Main/EnvoiEmailStatistiquesAssure';?>",
                type: 'POST',
                datatype: "text",
                data: {
                    'IdAssure':$("#IdAssure").val(),
                    'NoAssure' : $("#NoAssure").val(),
                    'NomAssure': $("#NomAssure").val(),
                    'PrenomAssure': $("#PrenomAssure").val(),
                    'CiviliteAssure': $("#TitAssure").val(),
                    'EmailAssure': $("#EmailAssure").val(),
                    'SoldeAssure':$("#SoldeAssure").val(),
                    'Date':$("#Date").val()
                },
                success: function(response) {
                    $("#loader").hide();
                    console.log(response);
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

                }, 
                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    console.log(jqXHR);
                    console.log(exception);
                }
            })

});
</script>
    
    