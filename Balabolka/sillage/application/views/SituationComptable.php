<div class="filtre">

<table border="0" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Séléctionner l'année:</td>
                        <td>
                          <select name="Annee" id="Annee" >  
                        <?php  
                         echo '<option value="" selected></option>';
                      
                        for( $year=date('Y');$year>=1970; $year--)
                        {
                            if($Annee && $Annee==$year)$selected="selected";else $selected= "";
                            echo '<option value="'.$year.'" '. $selected.'>'.$year.'</option>';
                        }?>
                        </select>
                        </td>
                        
                    </tr>
                </tbody>
            </table> 
</div>
<div>

<table id="myTableSC" class="display" style="width:100%">

        <thead>
            <tr>
                <th>Quittance</th>
                <th>N° de police </th>
                <th>Bateau(x) </th>
                <th>Montant Du </th>
                <th>Montant Réglé </th>
                <th>Solde </th>

            </tr>
        </thead>
        <tbody>
        <?php foreach($results as $result)
        {
            $Libele="";
           $MVT_Echdu= date("d/m/Y", strtotime($result['MVT_Echdu']));  
           $MVT_EchAu= date("d/m/Y", strtotime($result['MVT_EchAu']));  
           
            switch ($result['MVT_TypeQuittance']) {
                case 'R':
                    $Libele="Remboursement du ".$MVT_Echdu." au ". $MVT_EchAu;
                    break;
                case 'T':
                    $Libele="Quittance Terme du ".$MVT_Echdu." au ". $MVT_EchAu;
                    break;
                case 'C':
                    $Libele="Quittance Comptant du ".$MVT_Echdu." au ". $MVT_EchAu;
                    break;
                case 'S':
                    $Libele="Suppression Quittance du ".$MVT_Echdu." au ". $MVT_EchAu;
                    break;  
                case 'C':
                    $Libele="Retour Quittance Comptant du ".$MVT_Echdu." au ". $MVT_EchAu ;
                    break;
                case 'A':
                    $Libele="Accompte du ".$MVT_Echdu." au ". $MVT_EchAu ;
                break;
            }
            
            echo "<tr>
            <td>".$Libele."</td>
            <td>".$result['POL_No']."</td>
            <td>".$result['AVB_Nom']."</td>
            <td>".number_format( $result['MVT_Du'], 2, ',', ' ' ). " €"."</td>
            <td>".number_format( $result['MVT_Regle'], 2, ',', ' ' ). " €"."</td>
            <td>".number_format( $result['Solde'], 2, ',', ' ' ). " €"."</td>

            </tr>";
        }
        ?>
        </tbody>
        
    </table>
  
    </div>
    <br><br>
    <div class="Generer" style="text-align:center; margin-left:10%;width:80%;">  
    <button id="EnvoyerSC">Envoyer</button>
    </div>
    <script type="text/javascript">

$(document).on("click","#EnvoyerSC",function(){
    $("#loader").show();
    $.ajax({
                url: "<?php echo base_url().'Main/EnvoiEmailSituationComptable';?>",
                type: 'POST',
                datatype: "json",
                data: {
                    'IdAssure':$("#IdAssure").val(),
                    'NoAssure' : $("#NoAssure").val(),
                    'NomAssure': $("#NomAssure").val(),
                    'PrenomAssure': $("#PrenomAssure").val(),
                    'CiviliteAssure': $("#TitAssure").val(),
                    'EmailAssure': $("#EmailAssure").val(),
                    'SoldeAssure':$("#SoldeAssure").val(),
                    'Annee':$("#Annee").val()
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