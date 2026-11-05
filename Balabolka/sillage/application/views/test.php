

<html><head></head> <body>
       <h4>Ceci est un message automatique, merci de ne pas y répondre.</h4>
        <img src="<?php echo SITE_NAME."/css/header.jpg"?>" alt="Hotel"width="200" height="100" /><br/>
         <p><b>Bonjour CiviliteAssure: NomAssure PrenomAssure." </b>,<br> 
        Le bureau ANP assurances-plaisance est heureux de vous accueillir dans l'espace assurés sur son site internet <a href='http://assures.assurances-plaisance.com'>http://assures.assurances-plaisance.com.</a> <br>".
        "Cet espace, disponible sur PC et Smartphone, propose des services inédits destinés à vous faciliter plus encore la gestion de vos contrats d’assurance. Vous pouvez payer vos primes en ligne, télécharger vos attestations, déclarer vos sinistres, etc. <br>
        Ouvrez ce lien dans votre navigateur pour initialiser votre mot de passe: <br>
        <a href='http://assures.assurances-plaisance.com/login/reset?userId=$IdAssure&token=".base64_encode( $Token)."'> http://assures.assurances-plaisance.com/login/reset?userId=$IdAssure&token=".base64_encode($Token)."</a><br><br>
        A très bientôt, <br>
        L'équipe ANP Assurances Plaisance. <br>";

        $message .='Copyright © ANP Assurances Plaisance, <br>
        15 rue Beauvau<br>
        13001 Marseille <br>
        plaisance@harrel-courtes.fr<br></p>'	
        $message .= '</body></html>
       