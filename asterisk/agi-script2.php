#!/usr/bin/php -q
<?php
require 'phpagi.php';



$agi = new AGI();
$resp = $agi->get_variable('CDR(billsec)');
$BillSec = $resp['data'];
if($BillSec<=10)
	exit(0);
$resp=$agi->get_variable('CDR(start)');
$start=$resp['data'];
$resp=$agi->get_variable('CDR(end)');
$end=$resp['data'];
$resp=$agi->get_variable('id_client');
$id_client=$resp['data'];
$resp=$agi->get_variable('id_voyant');
$id_voyant=$resp['data'];
$resp=$agi->get_variable('CDR(uniqueid)');
$id_unique=$resp['data'];
$resp=$agi->get_variable('CDR(answer)');
$date_debut=$resp['data'];
$resp=$agi->get_variable('CDR(disposition)');
$ring_time=$resp['data'];
$agi->verbose("exectedjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj");
$agi->verbose("start ".$start);
$agi->verbose("end ".$end);
$agi->verbose('id client '.$id_client);
$agi->verbose('id_voyant '.$id_voyant);
$agi->verbose('bill sec '.$BillSec);
$agi->verbose('unique id'.$id_unique);
$agi->verbose('date debut '.$date_debut);
$agi->verbose('ring_time '.$ring_time);
if($date_debut)
	$agi->verbose("var set");
else 
	$agi->verbose("var not set");
$agi->set_variable('client_id',123455554);

$db = 'c0voyance';
$dbuser = 'jeanremi';
$dbpass = 'scgxiZRJ3X#';
$dbhost = '127.0.0.1';

$conn=new mysqli($dbhost,$dbuser,$dbpass,$db);

if ($conn->connect_error) {
	    die('Impossible de se connecter à la base de données (' . $conn->connect_errno . ') '
		                . $conn->connect_error);
}
$sql = "INSERT INTO `wp_consultations`( `consultation_date`, `consultation_duree`, `voyant_id`, `client_id`, `consultation_type`,  `consultation_debut`, `consultation_fin`, `unique_id`) VALUES ('$start',$BillSec,$id_voyant,$id_client,'1','$start','$end','$id_unique')";
if ($conn->query($sql) === FALSE)
{

    die("Erreur: " . $sql . "<br>" . $conn->error);
}
$id_consultation=$conn->insert_id;
$date_creation=date('d-m-y h:i:s');
$sql="INSERT INTO `wp_forfait`(`client_id`, `nbre_minutes`, `date_creation`, `consultation_id`) VALUES ($id_client,-$BillSec,'$date_creation',$id_consultation)";
if($conn->query($sql)===FALSE)
	die("Erreur :".$sql."<br>".$conn->error);
echo "Mise  jour réussie";


$conn->close();

