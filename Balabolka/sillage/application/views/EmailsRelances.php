<!DOCTYPE html>
<html lang="en">
<head>
<title>les relances à générer</title>
<meta charset="utf-8">
<meta name="EmailsRelances" content="width=device-width, initial-scale=1">
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo site_url().'css/style1.css';?>">  
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $(document).ready(function(){
 
  $('#Valider').click(function() {
    $("#Valider").text("Envoi En cours..");
    $("#Valider").css("background-color","#AAAAAA");
  var total = $('#table tbody tr').length;
  var isBusy=false;
  $('#table tbody tr').each(function(i, el) {
     
        var IdAssure = $(el).children('.IdAssure').text(),
         MvtId= $(el).children('.MvtId').text(), 
         IdContrat = $(el).children('.IdContrat').text(),
         NoAssure=$(el).children(".NoAssure").text(),
         NomAssure=$(el).children(".NomAssure").text(),
          PrenomAssure=$(el).children(".PrenomAssure").text(),
            TitAssure= $(el).children(".TitAssure").text(),
              AdrAssure= $(el).children(".AdrAssure").text(),
               AdrAssure2= $(el).children(".AdrAssure2").text(),
                AdrAssure3= $(el).children(".AdrAssure3").text(),
                 CpAssure= $(el).children(".CpAssure").text(),
                  VilleAssure=$(el).children(".VilleAssure").text(),
                   NatAssure=$(el).children(".NatAssure").text(),
                    BatNom =  $(el).children(".BatNom").text(),
                       EmailAssure= $(el).children(".EmailAssure").text(),
                          MvtMontant= $(el).children(".MvtMontant").text(),
                             PolNoAssure= $(el).children(".PolNoAssure").text(),
                                MvtEchDu= $(el).children(".MvtEchDu").text(),
                                 MvtEchAu= $(el).children(".MvtEchAu").text();
        
    
    
    $.ajax({ url: "<?php echo base_url()?>Main/GenererActivite",
	data:{
        'Ajax':true,
        'Type':'Relance',
        'IdAssure': IdAssure,
        'IdContrat':IdContrat,
        'MvtId': MvtId,
         'NoAssure':NoAssure,
         'NomAssure':NomAssure,
          'PrenomAssure':PrenomAssure,
            'TitAssure': TitAssure,
              'AdrAssure': AdrAssure,
                 'AdrAssure2': AdrAssure2,
                    'AdrAssure3': AdrAssure3,
                    'CpAssure': CpAssure,
                     'VilleAssure':VilleAssure,
                      'NatAssure':NatAssure,
                       'BatNom' :  BatNom,
                         'EmailAssure': EmailAssure,
                             'PolNoAssure': PolNoAssure,
                              'MvtMontant' : MvtMontant,
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
                      console.log('Internal error: ' + jqXHR.responseText+data);
                  } else {
                      alert(errorThrown);
                      console.log('Internal error: ' + errorThrown+data);
                  }
                  if (i === total - 1) 
                                    {
                                    $("#Valider").text("Commencer l'envoi");
                                    $("#Valider").css("background-color","#4CAF50");
                                    }
                 
              }
                            
                        });
                       
                   
                       
                           
                    
    });
    });
				
        //$.ajax (do your AJAX call here using values of query and text
  
    });
  </script>





 <?php  
 
header('Content-type: text/html; charset=utf-8');
 $this->load->view('Menu');
 ?>
  <h1 style="margin-left:22%">Emails des relances</h1>
<div class="UI_Container">
<table  id="table"  >
    <thead>
<tr>
        <th>ID quittance</th>
        <th>N° de police</th>
        <th>ID Contrat</th>
        <th>N° Assuré</th>
        <th>Nom Assuré</th>
        <th>Prénom Assuré</th>
        <th>Echu du </th>
        <th>Echu au </th>
        <th>Montant</th>
        <th>Nom du Bateau</th>
        <th>Adresse Assuré</th>
        <th>Code postal </th>
        <th>Ville</th>
        <th>Nationnalité</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
<?php
 foreach ($Array as $row): ?>
    <tr>
        
        <td class='IdAssure'name="IdAssure" style="display:none"><?php echo $row["ASS_Id"];?></td>
        <td class='MvtId' name='MvtId'><?php echo $row["MVT_ID"];?></td>
         <td class='PolNoAssure' name='PolNoAssure' ><?php echo $row["Pol_No"];?></td>
         <td class='IdContrat' name='IdContrat' ><?php echo $row["CAT_Nom"];?></td>
         <td class='NoAssure'name='NoAssure' ><?php echo $row["ASS_No"];?></td>
         <td class='NomAssure' name ='NomAssure'><?php echo $row["Ass_Nom"];?></td>
          <td class='PrenomAssure' name='PrenomAssure'><?php echo $row["Ass_Prenom"];?></td>
            <td class='TitAssure' name='TitAssure' style="display:none"><?php echo $row["TIT_Nom"];?></td>
             <td class='MvtEchDu' name='MvtEchDu' ><?php echo date("d-m-Y", strtotime($row["Mvt_EchDu"]));?></td>
               <td class='MvtEchAu' name='MvtEchAu' ><?php echo date("d-m-Y", strtotime($row["MVT_EchAu"]));?></td>
               <td class='MvtMontant' name='MvtMontant' ><?php echo $row["MVT_Mt"]." ".$row["DEV_Code"];?></td>
                <td class='BatNom' name='BatNom'><?php echo $row["Avb_Nom"];?></td>
                 <td class='AdrAssure' name="AdrAssure" ><?php echo $row["Ass_Adr1"];?></td>
               <td class='AdrAssure2' name="AdrAssure2" style="display:none" ><?php echo $row["Ass_Adr2"];?></td>
              <td class='AdrAssure3' name="AdrAssure3" style="display:none" ><?php echo $row["Ass_Adr3"];?></td>
              
                 <td class='CpAssure' name='CpAssure' ><?php echo $row["Ass_CP"];?></td>
              <td class='VilleAssure' name='VilleAssure' ><?php echo $row["Ass_Ville"];?></td>
               <td class='NatAssure' name='NatAssure'><?php echo $row["NAT_Nom"];?></td>
                   <td class='EmailAssure' name='EmailAssure'><?php echo $row["ASS_email"];?></td>
                                
         
    </tr>
<?php endforeach; ?>
 
    </tbody>
</table>
<div style="text-align:center;margin-left:25%">
          <button type="button" class='Valider' id='Valider' > Commencer l'envoi</button> 
</div>



