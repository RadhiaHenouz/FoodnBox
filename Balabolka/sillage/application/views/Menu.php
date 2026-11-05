<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).on('click', '#LjjogOut', function(){
      alert("ok");
      $.ajax({
      url: '<?php echo base_url("Main/LogOut")?>',
      
      
      success: function(response){
       
     }
     })
     });
</script>

<link rel="stylesheet" href='<?php echo site_url()."css/style.css";?>'>
    
<style type="text/css">
    /* Add some padding on document's body to prevent the content
    to go underneath the header and footer */
</style>

</head>
<body>
    <div class="fixed-header">
        <?php echo form_open(base_url("Main/LogOut"))?>
            <nav>
                <a href="#">SILLAGE</a>
                <button id="LogOut" type="submit" style="width:40px;height:40px;float: right;margin-right: 30px;background:url(<?php echo SITE_NAME.'/css/logout.png'?>);  background-repeat: no-repeat;"></button>
             
            </nav>
        <?php form_close()?>
        <div class="container">
            <!--
 -->
            </div>
            </div><div class="container" id ="menu"><!--
 -->
    <ul>
 
  <li><a href="<?php echo base_url("Main/FicheAssure") ?>">Dossier assuré</a></li>
  <li><a href="<?php echo base_url("Main/DossierCompagnie") ?>">Dossier Compagnie</a></li>
  <li><a href="<?php echo base_url("Main/EmailsAGenerer") ?>">Générer les emails</a></li>
  <li><a href="<?php echo base_url("Main/EmailsNouveauxAssures") ?>">Nouveaux assurés</a></li>
  <li><a href="<?php echo base_url("Main/EmailsRelances") ?>">Relances</a></li>
  <li><a href="<?php echo base_url("Main/EmailsQuittances") ?>">Quittances</a></li>
  <li><a href="<?php echo base_url("Main/AccesFichiers") ?>">Accès Documents</a></li>
    </ul><!--
 --></div><!--
 --><div class="fixed-footer" style="display: none">
    <input type='hidden' id="site_url" value='<?php echo site_url();?>'>
    <input type='hidden' id="base_url" value='<?php echo base_url();?>'>
    
     </div>

</body>
</html>                            