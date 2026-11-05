<!DOCTYPE html>
<html lang="en">
<head>
<title>Emails à générer</title>
<meta charset="utf-8">
<meta name="EmailsAgenerer" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo site_url().'css/style1.css';?>">
 
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $(document).ready(function(){
 
  $('#Valider').click(function() {
    $("#Valider").text("Envoi En cours..");
    $("#Valider").css("background-color","#AAAAAA");
    var total = $('#table tbody tr').length;
  var isBusy=false;
  $('#table tbody tr').each(function(i, el) 
  {
     
        var IdAssure = $(el).children('.IdAssure').text(),
         MvtId= $(el).children('.MvtId').text(), 
         NoAssure=$(el).children(".NoAssure").text(),
         NomAssure=$(el).children(".NomAssure").text(),
          PrenomAssure=$(el).children(".PrenomAssure").text(),
            TitAssure= $(el).children(".TitAssure").text(),
              AdrAssure= $(el).children(".AdrAssure").text(),
              CpAssure= $(el).children(".CpAssure").text(),
              VilleAssure=$(el).children(".VilleAssure").text(),
               NatAssure=$(el).children(".NatAssure").text(),
                BatNom =  $(el).children(".BatNom").text(),
                 BatConstructeur  = $(el).children(".BatConstructeur").text(),
                  BatModele   =  $(el).children(".BatModele").text(),
                    MotPuissance = $(el).children(".MotPuissance").text(),
                       MotAnnee= $(el).children(".MotAnnee").text(),
                        MotMarque=  $(el).children(".MotMarque").text(),
                          EmailAssure= $(el).children(".EmailAssure").text(),
                          CieIdAssure= $(el).children(".CieIdAssure").text(),
                            CieNomAssure= $(el).children(".CieNomAssure").text(),
                             PolNoAssure= $(el).children(".PolNoAssure").text(),
                              //MvtId = $(el).children(".MvtId").text(ui.item.MVT_ID),
                                MvtEchDu= $(el).children(".MvtEchDu").text(),
             MvtEchAu= $(el).children(".MvtEchAu").text();
        
    
    
    $.ajax({ url: "<?php echo base_url()?>GenererAttestation",
	  data:{
        'Ajax':true,
        'IdAssure': IdAssure,
        'MvtId': MvtId,
         'NoAssure':NoAssure,
         'NomAssure':NomAssure,
          'PrenomAssure':PrenomAssure,
            'TitAssure': TitAssure,
              'AdrAssure': AdrAssure,
              'CpAssure': CpAssure,
              'VilleAssure':VilleAssure,
               'NatAssure':NatAssure,
                'BatNom' :  BatNom,
                 'BatConstructeur'  : BatConstructeur,
                  'BatModele'   :  BatModele,
                    'MotPuissance' : MotPuissance,
                       'MotAnnee': MotAnnee,
                        'MotMarque':  MotMarque,
                          'EmailAssure': EmailAssure,
                          'CieIdAssure': CieIdAssure,
                            'CieNomAssure': CieNomAssure,
                             'PolNoAssure': PolNoAssure,
                              //'MvtId' : MvtId").val(ui.item.MVT_ID),
                                'MvtEchDu': MvtEchDu,
                                 'MvtEchAu': MvtEchAu},
        
				type: "POST",
				dataType: "json",
                                beforeSend:function()
                                {
                                 isBusy=true;
                                },
				success: function(data)
				{
                                    isBusy=false;
                                    
                                    console.log("data:"+data+"...");  
                              
			
                                    if(data==="true")
                                    $(el).css('background-color','#d3f6db');
                                    else
                                    $(el).css('background-color','#fbaca8');
                                    if (i === total - 1) 
                                    {
                                    $("#Valider").text("Commencer l'envoi");
                                    $("#Valider").css("background-color","#4CAF50");
                                    }
                            },
                            /*error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                            }*/
         error: function (jqXHR, textStatus, errorThrown) {
                  if (jqXHR.status == 500) {
                      alert('Internal error: ' + jqXHR.responseText);
                  } else {
                      alert(errorThrown);
                  }
                  if (i === total - 1) 
                                    {
                                    $("#Valider").text("Commencer l'envoi");
                                    $("#Valider").css("background-color","#4CAF50");
                                    }
              }
                            
     });
                       
                   
                       
                           
                    
    });
    $("#Valider").prop('value', 'Valider');
    $("#btnAddProfile").prop("disabled",false);
    });
				
        //$.ajax (do your AJAX call here using values of query and text
  
    });
  </script>





 <?php  
 
header('Content-type: text/html; charset=utf-8');
 $this->load->view('Menu');
 ?>
  <h1 style="margin-left:22%">Emails à générer</h1> 
<div class="UI_Container" style="text-align:center">
<table  id="table"  >
    <thead>
<tr>
        <th>ID quittance</th>
        <th>N° Assuré</th>
        <th>Nom Assuré</th>
        <th>Prénom Assuré</th>
        <th>Adresse Assuré</th>
        <th>Nom Bateau</th>
        <th>Constructeur Bateau</th>
        <th>Modèle Bateau</th>
        <th>Email</th>
        <th>Nom d'assurance</th>
    </tr>
    </thead>
    <tbody>
<?php
 foreach ($Array as $row): ?>
    <tr>
        
        <td class='IdAssure'style="display:none"><?php echo $row["ASS_Id"];?></td>
        <td class='MvtId' name='MvtId'><?php echo $row["MVT_ID"];?></td>
         <td class='NoAssure'name='NoAssure' ><?php echo $row["ASS_No"];?></td>
         <td class='NomAssure' name ='NomAssure'><?php echo $row["Ass_Nom"];?></td>
          <td class='PrenomAssure' name='PrenomAssure'><?php echo $row["Ass_Prenom"];?></td>
            <td class='TitAssure' name='TitAssure' style="display:none"><?php echo $row["TIT_Nom"];?></td>
              <td class='AdrAssure' name="AdrAssure" ><?php echo $row["Ass_Adr1"];?></td>
              <td class='CpAssure' name='CpAssure' style="display:none"><?php echo $row["Ass_CP"];?></td>
              <td class='VilleAssure' name='VilleAssure' style="display:none"><?php echo $row["Ass_Ville"];?></td>
               <td class='NatAssure' style="display:none" name='NatAssure'><?php echo $row["NAT_Nom"];?></td>
                <td class='BatNom' name='BatNom'><?php echo $row["Avb_Nom"];?></td>
                 <td class='BatConstructeur' name='BatConstructeur'  ><?php echo $row["BAT_Constructeur"];?></td>
                  <td class='BatModele' name='BatModele'  ><?php echo $row["BAT_Modele"];?></td>
                    <td class='MotPuissance' name='MotPuissance' style="display:none" ><?php echo $row["MOT_Puissance"];?></td>
                       <td class='MotAnnee' name='MotAnnee' style="display:none"><?php echo $row["MOT_Annee"];?></td>
                        <td class='MotMarque' name='MotMarque' style="display:none"><?php echo $row["MOT_Marque"];?></td>
                          <td class='EmailAssure' name='EmailAssure'><?php echo $row["ASS_email"];?></td>
                          <td class='CieIdAssure' name='CieIdAssure' style="display:none"><?php echo $row["Cie_Id"];?></td>
                            <td class='CieNomAssure' name='CieNomAssure' ><?php echo $row["Cie_Nom"];?></td>
                             <td class='PolNoAssure' name='PolNoAssure' style="display:none"><?php echo $row["Pol_No"];?></td>
                                <td class='MvtEchDu' name='MvtEchDu' style="display:none"><?php echo date("d-m-Y", strtotime($row["Mvt_EchDu"]));?></td>
                                 <td class='MvtEchAu' name='MvtEchAu' style="display:none"><?php echo date("d-m-Y", strtotime($row["MVT_EchAu"]));?></td>
        
         
    </tr>
<?php endforeach; ?>
 
    </tbody>
</table>
<div style="text-align:center;margin-left:25%">
          <button type="button" class='Valider' id='Valider' > Commencer l'envoi</button> 
</div>

