<!DOCTYPE html>
<html lang="en">
<head>
<title>Emails des nouveaux assurés</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  $('#table tbody tr').each(function(i, el) {
     
        var IdAssure = $(el).children('.IdAssure').text(),
         NoAssure=$(el).children(".NoAssure").text(),
         NomAssure=$(el).children(".NomAssure").text(),
         PrenomAssure=$(el).children(".PrenomAssure").text(),
         TitAssure= $(el).children(".TitAssure").text(),
         EmailAssure= $(el).children(".EmailAssure").text();
                        
    
    
    $.ajax({ url: "<?php echo base_url()?>Main/NouvelAssure",
	data:{
       
        'IdAssure': IdAssure,
        'NoAssure':NoAssure,
        'NomAssure':NomAssure,
        'PrenomAssure':PrenomAssure,
        'TitAssure': TitAssure,
        'EmailAssure': EmailAssure},
        
				type: "POST",
				dataType: "json",
				success: function(data)
				{
                                  
                                    
                                    console.log(data);  
                              
			
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
                            
         })
                    
                       
                   
                       
                           
                    
    });
  
   
    });
				
        //$.ajax (do your AJAX call here using values of query and text
  
    });
  </script>





 <?php  
 $this->load->view('Menu'); 
 ?>  
  <h1>Emails pour les nouveaux assurés</h1>
 <div class="UI_Container" style="text-align: center">
    
<table class="w3-table w3-striped w3-border" id="table">
    <thead>
<tr>
       
       
        
        <th>N° Assuré</th> 
        <th>Civilité</th>
        <th>Nom Assuré</th>
        <th>Prénom Assuré</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
<?php
 foreach ($Array as $row): ?>
    <tr>
        
        <td style="display: none" class='IdAssure'><?php echo $row["ASS_Id"];?></td>
         <td class='NoAssure'name='NoAssure' ><?php echo $row["ASS_No"];?></td>
         <td class='TitAssure' name='TitAssure'><?php echo $row["TIT_Nom"];?></td>
         <td class='NomAssure' name ='NomAssure'><?php echo $row["Ass_Nom"];?></td>
         <td class='PrenomAssure' name='PrenomAssure'><?php echo $row["Ass_Prenom"];?></td>
         <td class='EmailAssure' name='EmailAssure'><?php echo $row["ASS_Email"];?></td>
                          
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<div style="text-align:center;margin-left:25%">
          <button type="button" class='Valider' id='Valider' > Commencer l'envoi</button> 
</div>

