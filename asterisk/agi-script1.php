#!/usr/bin/php -q
<?php 
require 'phpagi.php';
$agi = new AGI();
$nbre_tentatives=0;
$code_client_valide=false;
$code_voyant_valide=false;
$id_client=0;
$id_voyant=0;
$extension=1000;
$answered=0;
$no=preg_replace("#[^0-9]#","",$agi->request[agi_callerid]);//remove any non numeric characters

/*
connect to "asterisk" database in mysql; in this case only 1 table "clients"
column telsearch contains concatenated mobile, home and work numbers
e.g. 0121777887207986238123
script will search for caller number within this field
*/
$db = 'c0voyance';
$dbuser = 'jeanremi';
$dbpass = 'scgxiZRJ3X#';
$dbhost = '127.0.0.1';

$conn=new mysqli($dbhost,$dbuser,$dbpass,$db);

if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
}
//tester la validité du code client 
//
//
//
//
//
$agi->exec("Background","/var/lib/asterisk/sounds/custom/bienvenu");
while($nbre_tentatives<5 && !$code_client_valide)
{
//or die("could not open database");gi->text_input('UPPERCASE');
$result=$agi->get_data('beep',6000,6);
$code_client=$result['result'];
$agi->verbose('number :'.$code_client);

$res = $conn->query("SELECT * FROM `wp_usermeta` WHERE `meta_key`='code_personnel' and `meta_value`=$code_client");
$num_rows=mysqli_num_rows($res);
if($num_rows==1)
{
	$code_client_valide=true;
	while($row = $res->fetch_assoc())
       	{
		   $id_client=$row["user_id"];
	           $agi->set_variable('id_client',$id_client);	   
	}
}

else 
{
	$agi->exec("Background","/var/lib/asterisk/sounds/custom/code_client_invalide");
}//
///////
//
//
//
//
//
//
//
//
//
//
//teste la validité du voyant 
//
//
//
//
$nbre_tentatives++;
}
if(!$code_client_valide)
{
	$agi->exec("Background","/var/lib/asterisk/sounds/custom/au_revoir");
	$agi->verbose("code client invalide");
	$agi->hangup();
	exit();
}

$agi->exec("Background","/var/lib/asterisk/sounds/custom/code_expert");
$nbre_tentatives=0;
while($nbre_tentatives<5 && !$code_voyant_valide)
{
//or die("could not open database");gi->text_input('UPPERCASE');
$result=$agi->get_data('beep',6000,4);
$code_voyant=$result['result'];
$agi->verbose('number :'.$code_voyant);
public function inserer_credit ($id_voyant,$date_creation,$id_consultation)
{
$this->open_connection();
$res = $this->conn->query("INSERT INTO `wp_credit`( `user_id`, `credit`, `date`, `description`, `gain`, `id_consultation`) VALUES 
($id_voyant,1,'$date_creation','Gain consultation téléphonique',$id_consultation)");
$result=FALSE;
if($res===TRUE)
$result= $this->conn->ınsert_id;
mysqli_free_result($res);
$this->close_connection();
return $result;
}
else 
{
	$agi->exec("Background","/var/lib/asterisk/sounds/custom/code_expert_invalide");
}
$nbre_tentatives++;
}

if(!$code_voyant_valide)
{ 
	$agi->exec("Background","/var/lib/asterisk/sounds/custom/au_revoir");
	$agi->verbose("code voyant invalide");
	$agi->hangup();
	exit();
}

$nbre_minutes=0;
$res = $conn->query("select sum(`nbre_minutes`)as 'nbre_minutes' from wp_forfait where `client_id`=$id_client");
while($row = $res->fetch_assoc()) {
	$nbre_minutes= $row["nbre_minutes"];
	$nbre_ms=$nbre_minutes*1000;

}
if($nbre_minutes<=0)
{
	$agi->exec("Background","/var/lib/asterisk/sounds/custom/forfait_insuffisant");
	$agi->exec("Background","/var/lib/asterisk/sounds/custom/forfait_insuffisant");
	$agi->hangup();
	exit();
}

///
//
//
//
// Trouver l'extension du voyanyt 
//
//


$res=$conn->query("SELECT * FROM `wp_usermeta` WHERE `user_id`=$id_voyant and `meta_key`='numero_de_tlphone'");
$num_rows=mysqli_num_rows($res);
if($num_rows==1)
{

			while($row = $res->fetch_assoc())
				       	{
						$extension=$row["meta_value"];
						
					 }
}

else 
{
 		$agi->exec("Background","/var/lib/asterisk/sounds/custom/expert_indispo");
		$agi->hangup();
		exit();
}

$agi->evaluate("ChanIsAvail","SIP/$extension");
$resp=$agi->get_variable('AVAILORIGCHAN');
$agi->verbose("stattttttttttttttttuuuuuuuuuussss".$resp['data']);
$resp=$agi->get_variable('AVAILSTATUS');
$agi->verbose("statutttttttttttttttttttttttttt".$resp['data']);
$agi->exec_absolutetimeout(5400); 

$agi->set_variable("LIMIT_WARNING_FILE","beep");
//$agi->set_variable("LIMIT_CONNECT_FILE",'/var/lib/asterisk/sounds/custom/mise_en_relation');
$agi->set_music(true,'custom');
$agi->set_variable('LIMIT_PLAYAUDIO_CALLER','/var/lib/asterisk/sounds/custom/mise_en_relation');

$agi->exec_dial("SIP",$extension, 60, "L($nbre_ms:20000:10000)m(custom)C",null);
$resp = $agi->get_variable('DIALSTATUS');
$DIALSTATUS = $resp['data'];
$resp=$agi->get_variable('RINGTIME');
$RINGTIME =$resp['data'];
$agi->verbose("dialstatus ".$DIALSTATUS);
$agi->set_variable("answered_time",date('Y-m-d H:i:s'));
$agi->set_variable('ring_time',$RINGTIME );
if($DIALSTATUS!='ANSWER')<qqqw
{hhjjjjnnnneaeeeezzzzee

	$agi->exec("Background","/var/lib/asterisk/sounds/custom/expert_indispo");


	$result=$agi->get_data('beep',6000,1);
	if(trim($result['result'])==1)
	
	{
		$agi->exec("Background","/var/lib/asterisk/sounds/custom/renouveler_appel");
		$result=$agi->get_data('beep',6000,1);
			if(trim($result['result'])==1)
			
			{
                             $agi->exec("Background","/var/lib/asterisk/sounds/custom/au_revoir");
			}
			

		$agi->hangup();
		exit();

	}
	else if(trim($result["result"])==2)
	{
	$agi->exec('Goto','1');	
	}

	exit();
		
}

//$agi->exec("Background","/var/lib/asterisk/sounds/custom/mise_en_relation");
$resp = $agi->get_variable('ANSWEREDTIME');
$ANSWEREDTIME = $resp['data'];
$agi->Verbose("jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj".$ANSWEREDTIME);
$answered=1;
$conn->close();
$agi->answer();
$agi->set_variable('answered',$answered);
$agi->hangup();
exit();
?>
