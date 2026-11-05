<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.c²ss">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
<style>
  

</style>
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
<script>
    $(document).ready(function() {
    var IdAssure,MvtEchDu,MvtEchAu,MvtId,CieId;
    
      $(function() {
      $('a').on('click', function() 
      {
      $('.Hidden').show();
      })  
      })
  })

</script>

<div id="MvtId" style="display:none"></div>
<div id="MvtEchDu" style="display:none"></div>
<div id="MvtEchAu" style="display:none"></div>
<div id="IdAssure" ></div>
    <div class="Details">
        </br>
        <div id="AttesPrec">
            <a id="link" href="" target="_blank"> <i class="fa fa-file"></i>  Afficher le fichier en pdf</a>
        </div></br>
        <table >
            <tbody>
                
                        <tr>
                            <td class="FieldLabel">
                              N° Assuré:
                            </td>
                            <td>
                                <input type="text" class="FieldPlaceholder" id="NoAssure" name="NoAssure" autocomplete="off" readonly/> 
                                  
                            </td>
                        </tr>
                        <tr>
                            <td class="FieldLabel">
                                Nom:
                            </td>
                            <td>
                                
                                 <input type="text" class="FieldPlaceholder" id="NomAssure" name="NomAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                         <tr>
                            <td class="FieldLabel">
                                Prénom:
                            </td>
                            <td>
                                  <input type="text" class="FieldPlaceholder" id="PrenomAssure" name="PrenomAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                         <tr>
                            <td class="FieldLabel">
                               Civilité:
                            </td>
                            <td>
                                  <input type="text" class="FieldPlaceholder" id="TitAssure" name="TitAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                        <tr>
                            <td class="FieldLabel">
                                Adresse:
                            </td>
                            <td>
                                 <input type="text" class="FieldPlaceholder" id="AdrAssure" name="AdrAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                        <tr>
                            <td class="FieldLabel">
                                Code postal:
                            </td>
                            <td>
                                 <input type="text" class="FieldPlaceholder" id="CpAssure" name="CpAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                        <tr>
                            <td class="FieldLabel">
                               Ville:
                            </td>
                            <td>
                                  <input type="text" class="FieldPlaceholder" id="VilleAssure" name="VilleAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                         <tr>
                            <td class="FieldLabel">
                              Nationnalité:
                            </td>
                            <td>
                                 <input type="text" class="FieldPlaceholder" id="NatAssure" name="NatAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                           <tr>
                            <td class="FieldLabel">
                             Email:
                            </td>
                            <td>
                                  <input type="text" class="FieldPlaceholder" id="EmailAssure" name="EmailAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                          <tr class="Hidden">
                            <td class="FieldLabel" >
                               Nom du bateau:
                            </td>
                            <td>
                                 <input type="text" class="FieldPlaceholder" id="BatNom" name="BatNom" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                        <tr class="Hidden">
                            <td class="FieldLabel" >
                               Constructeur du bateau:
                            </td>
                            <td>
                                 <input type="text" class="FieldPlaceholder" id="BatConstructeur" name="BatConstructeur" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                        <tr class="Hidden">
                            <td class="FieldLabel">
                                Modéle du bateau:
                            </td>
                            <td>
                                 <input type="text" class="FieldPlaceholder" id="BatModele" name="BatModele" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                        <tr class="Hidden">
                            <td class="FieldLabel">
                               Puissance du moteur:
                            </td>
                            <td>
                                  <input type="text" class="FieldPlaceholder" id="MotPuissance" name="MotPuissance" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                        <tr class="Hidden">
                            <td class="FieldLabel">
                               Année du moteur:
                            </td>
                            <td>
                                  <input type="text" class="FieldPlaceholder" id="MotAnnee" name="MotAnnee" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                      
                        <tr class="Hidden">
                            <td class="FieldLabel">
                                Compagnie d'assurance:
                            </td>
                            <td>
                                 <input type="text" class="FieldPlaceholder" id="CieNomAssure" name="CieNomAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                          <tr class="Hidden">
                            <td class="FieldLabel">
                               N° de police d'assurance:
                            </td>
                            <td>
                                <input type="text" class="FieldPlaceholder" id="PolNoAssure" name="PolNoAssure" autocomplete="off" readonly/> 
                              
                            </td>
                        </tr>
                         <tr>
                            <td >
                                <a href="#">Voir plus</a>
                            </td>
                            
                        </tr>
                   
                      
                        </tbody>
                        
                        
                    </table>
              
         
            
       
    </div>
<div class="ListeAttes">
  <table id="ListeAttes" >
    <tr>
    <th>Nom du fichier</th>
    <th>Date de génération</th>
    <th>Généré</th>
    <th>Actions</th>
    </tr>
    <tr >
    <td id="AttNom"></td>
    <td id="AttDateGen"></td>
    <td id="AttGen"></td>
    <td id="Actions"></td>
  </tr>
</table>
</div>
<div class="Generer" style="text-align:center;width: 100% auto ">
          <button type="button" id='Generer' > Génerer une attestation</button> 
          <button type="button" id='NouvelAssure' > Email nouvel assuré</button> 
</div>
<div id="dialog" style="display: none;">
    <div>
        <iframe id="frame"></iframe>
    </div>
</div>

</br>