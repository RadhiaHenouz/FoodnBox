
<table id="myTable" class="display" style="width:100%">

<thead>
            <tr>
                <th>Nom fichier</th>
                <th>Date de création</th>
            </tr>
</thead>
<tbody>
<?php 
if($Files)
foreach($Files as $File)

{
    $cTime = new DateTime();
    $cTime->setTimestamp($File->getCTime());
    echo "<tr>
    <td class='NomFichier'><a target='_blank' href='".site_url()."Main/OpenFichier/".$File->getFileName()."/".$Type."'>".$File->getFileName()."</a></td>
    <td>".$cTime->format('d/m/Y h:i:s')."</td>
    </tr>";
}
?>
</tbody>
</table>