<div class="filtre">
<table border="0" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Séléctionner la date:</td>
                        <td>
                          <input type='date' name ="Date" id="Date" class="FiltreSC" value='<?php if($Date)echo $Date;?>'>
                        </td>
                        
                    </tr>
                </tbody>
            </table> 
</div>
<div>

<table id="myTable" class="display" style="width:100%">

        <thead>
            <tr>
                <th>Contrat</th>
                <th>Année </th>
                <th>Mt primes émises</th>
                <th>Mt primes réglés</th>
                <th>Mt prévision sinistre</th>
                <th>Mt sinistre réglé</th>
                <th>Nombre sinistres</th>
                <th>Rapport S/P</th>
                

            </tr>
        </thead>
        <tbody>
        <?php 
        if($results)
        foreach($results as $result)
        {
            $result=array_values($result);
             
            echo "<tr>
            <td>".$result[0]."</td>
            <td>".$result[1]."</td>
            <td>".number_format($result[2],2,',',' ')." €"."</td>
            <td>".number_format($result[3],2,',',' ')." €"."</td>
            <td>".number_format($result[4],2,',',' ')." €"."</td>
            <td>".number_format($result[5],2,',',' ')." €"."</td>
            <td>".$result[6]."</td>
            <td>".number_format($result[7],2,',',' ')." €"."</td>
       

            </tr>";
        }
        ?>
        </tbody>
        
    </table>
     
    </div>
    <br>
    <div class="Generer" style="text-align:center; margin-left:10%;width:80%;">  
    <button class="EnvoyerSC">Envoyer</button> 
    </div>