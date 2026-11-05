$(document).ready(function() {
	$(function() {
		 $('.raison_sociale').each(function(index) {
         var id = $(this).attr("id")
		$("#"+id ).autocomplete({
			
			source: function(request, response) {
				$.ajax({ url: "http://190.190.190.1/comptainvest1/index.php/home/suggestions",
				data: { term: $("#"+id).val()},
				dataType: "json",
				type: "POST",
				success: function(data){
			    response($.map(data, function(item) {
                return {
                  value: item.raison_sociale,
                  index:item.id_tiers,
                };
              }));
			 }
			});
		},
		
		minLength:2,
	    select: function(e, ui) {
		 	
		 var currentId = $(this).attr('id');
		 $('#N_tiers'+currentId).val(ui.item.index);
		$.ajax
		 ({ url: "http://190.190.190.1/comptainvest1/index.php/home/verif_rejet",
				data: { term:ui.item.index},
				dataType: "json",
				type: "POST",
				success: function(data)
				{
					$('#image'+currentId).css("display", 'block');
					if (data==false)
					{	
					     $('#image'+currentId).attr('src', 'http://190.190.190.1/comptainvest1/css/ok.jpg'); 
			     //$('#image'+currentId).attr('class ', "<?php echo base_url().'css/ok.jpg';?>"); 
					}
					else
					{
						$('#image'+currentId).attr('src', 'http://190.190.190.1/comptainvest1/css/non.jpg'); 
			        }
                }
           });
      }
		});
		});
		});
		$(function()
		 {
		 	
		 $('.lieu_paie').each(function(index) {
         var id = $(this).attr("id");
         var N = id.substring(9,10); 
        
		$("#lieu_paie"+N ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "http://190.190.190.1/comptainvest1/index.php/home/suggestion_villes",
				data: { term: $("#lieu_paie"+N).val()},
				
				dataType: "json",
				type: "POST",
				success: function(data){
			    response(data);
			    
			 }
			});
		}
	
		});
		});
		
	});
	$(function(){
	$('#valider').click(function(event){
	
   $('#table tr').each(function(){
 var isvalid =0;
   
    $('td input:text',this).each(function(){

        if($(this).val() != '')
           isvalid++;

    });

    if(isvalid!=4 && isvalid!=0)
    {
        alert('Attention ! il y a des champs vides ');
        
    }
    else
    {
    	$("form").submit();
					$("input[type=text]").val("");
    }
});
});

$(".montant").change( function() {
	
    var id = $(this).attr("id") ;
    var N = id.substring(7,8); 
    
    if($('#type_piece'+N).val()=='1')
    {
    
  	var dNow = new Date();
  	dNow.setDate(dNow.getDate() + 5);
	var date= dNow.getDate()+'-'+ (dNow.getMonth()+1) + '-' + dNow.getFullYear();
	$('#date_echeance'+N).val(date);
	
	
	}
	else
	$('#date_echeance'+N).mask("99-99-9999") ;
	

	});
  		
$(".type_piece").change( function() {
	
  var id = $(this).attr("id") ;
   var N = id.substring(10,11); 
 
  if ($(this).val() == '1') 
  {
  	
    $("#N_piece"+N).mask("9999999");
    
    
  }


});
$(function()
{
	$(".code_client").mask('C999999');
	$(".N_compte").mask('99999999999999999999');
	$(".N_piece").mask('9999999');
	
});
$(".image").click(function(){
var id= $(this).attr("id").substring(5,6),//recuperer l'id de la ligne concerné	
N_tiers=$("#N_tiers"+id).val(), //recuperer leN° du tiers de cette ligne
montant=$("#montant"+id).val();
$("#annuler").click(function(){
	$("table input").val('');
});

create_popup_window(id,N_tiers,montant); 

 
});

function create_popup_window(id,N_tiers,montant)
		{
			                    width = 750;
                                height = 250;
                                if(window.innerWidth)
                                {
                                        var left = (window.innerWidth-width)/2;
                                        var top = (window.innerHeight-height)/2+150;
                                }
                                else
                                {
                                        var left = (document.body.clientWidth-width)/2;
                                        var top = (document.body.clientHeight-height)/2+150;
                                }
                                var xhr = "http://190.190.190.1/comptainvest1/index.php/home/liste_rejets"+"/"+id+"/"+ N_tiers+"/"+montant;
                                window.open(xhr,'nom_de_ma_popup','menubar=yes, scrollbars=yes, top='+top+', left='+left+', width='+width+', height='+height+'');
                      
	    }

	});
	
});