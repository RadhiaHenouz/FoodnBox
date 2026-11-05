
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dossier Assuré</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>

</style>
<header></header>
<body>
 <div class="UI_Container">


    <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->view('Menu');
?>
<div class ="myContainer">
<?php
$this->load->view('RechercheParAssure');
$this->load->view('DetailsAssure');
$this->load->view('ListeAttestationsParAssure');  
  
?>
</div>  
   
</div>



</body>
</html>


