<script>

</script>
<div class="filtre">
<table border="0" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Date Début:</td>
                        <td>
                            <input type="date" id="DateDebut" class="FiltreDG" name="DateDebut" value='<?php if($DateDebut)echo $DateDebut;?>' >
                        </td>
                        <td>Date Fin:</td>
                        <td>
                            <input type="date" id="DateFin" class="FiltreDG" name="DateFin" value='<?php if($DateFin)echo $DateFin;?>'  >
                        </td>
                    </tr>
                </tbody>
 </table> 
</div>
<div>
<table id="myTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Email</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($results as $result)
        {
            echo "<tr>";
            if($Type=="A")
           echo "<td class='NomFichier'><a target='_blank' href='".site_url()."Main/OpenPDF/".$result['Nom']."'>".$result['Nom']."</a></td>";
           else
           echo "<td class='NomFichier'><a target='_blank' href='".site_url()."Main/OpenQuittancePDF/".$result['Nom']."'>".$result['Nom']."</a></td>";
          
            echo "<td>".date("d-m-Y", strtotime($result['Date']))."</td>
            <td><button class='EnvoyerEmail'>Envoyer</button></td>
            </tr>";
        }
        ?>
        </tbody>
        
    </table>
    </div>
    
    <script type="text/javascript">
  
       

    </script>