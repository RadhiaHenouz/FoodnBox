<?php
 add_action( 'wp_ajax_sendEmail', 'sendEmail' );
 add_action( 'wp_ajax_nopriv_sendEmail', 'sendEmail' );
 
function SendEmail()
{
    
		
		$Date=date("d/m/Y");
		$Nom=$_POST['Nom'];
		$Prenom=$_POST['Prenom'];
		$Email=$_POST['Email'];
		$Tel=$_POST['Tel'];
		$Montant=$_POST['Montant'];
		$NomPart=$_POST['NomPart'];
		$MtPart=$_POST['MtPart'];
		$EmailPart=$_POST['EmailPart'];
		$TelPart=$_POST['TelPart'];
         //echo $NomPart;
        
		$Parts=array();
		$NomPart=str_replace("NomPart%5B%5D=","",$NomPart);
		$NomPart=str_replace("%2C",",",$NomPart);
		$NomPart=str_replace("+"," ",$NomPart);
		$NomPart=str_replace("%C3%A9","é",$NomPart);
		$NomPart=str_replace("%C3%A0","à",$NomPart);
		$NomPart=str_replace("%C3%A7","ç",$NomPart);
		$NomPart=str_replace("%C3%A8","è",$NomPart);
		$Parts=explode("&",$NomPart);

		$Mts=array();
		$MtPart=str_replace("MtPart%5B%5D=","",$MtPart);
		$MtPart=str_replace("%2C",",",$MtPart);
		$Mts=explode("&",$MtPart);

        $Emails=array();
		$EmailPart=str_replace("EmailPart%5B%5D=","",$EmailPart);
		$EmailPart=str_replace("%40","@",$EmailPart);
		$Emails=explode("&",$EmailPart);
		$Tels=array();
		$TelPart=str_replace("TelPart%5B%5D=","",$TelPart);
		$TelPart=str_replace("%2C",",",$TelPart);
		$Tels=explode("&",$TelPart);
		$body   = "<p>Bonjour voici le récapitulatif de votre commande groupé. Merci </p>
		Date :".$Date."<br>
		Nom : ".$Nom."<br>
		Prénom : ".$Prenom."<br>
		Email : ".$Email."<br>
		Tél : ".$Tel."<br>
		Montant de la facture d’origine  : ".$Montant."<br>";
		$body.="<br><table border='1'><tr><th>Nom du participant</th><th>Téléphone</th><th>Email</th><th>Montant</th></tr>";
		
		for($i=0;$i<count($Parts);$i++)
			
		{$body.="<tr><td>".$Parts[$i]."</td> <td>".$Tels[$i]." </td><td>".$Emails[$i]."</td><td>".$Mts[$i]."</td></tr>";
			
		
		
        }
        $body.="</table>";
        
        $recipient=array($Email,"contact@foodnbox.com");
       
        $headers[] = 'From: ' . get_option( 'blogname' ) ;
        add_filter(
            'wp_mail_content_type',
            'my_custom_email_content_type'
        );
        $subject='Commande groupée';

        $wp_mail_return = wp_mail(
            $recipient,
            $subject,
            $body,
            $headers
        );
        if( $wp_mail_return ) 
        {
	
            echo json_encode ("true");
            //wp_redirect( $woocommerce->cart->get_checkout_url(), 302 );
        } else 
        {
			echo json_encode("false");
        }
        remove_filter(
            'wp_mail_content_type',
            'my_custom_email_content_type'
        );
        die(0);
    



			
			



}
function my_custom_email_content_type( $content_type ) 
{
    return 'text/html';
}