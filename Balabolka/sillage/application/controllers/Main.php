<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
$table=NULL;
class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function LogOut()
    {
        //logout and destroy the session
        $this->session->set_userdata('Username','LogedIn');
        redirect(base_url("Main/Login_Form"));
    }
    public function EnvoiEmailNotification($Email,$Civilite,$Nom,$Prenom,$NomFichier,$Motif,$Type)
    {
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        if(empty(trim($Email)))return false;
        $this->load->model("database");
        $this->email->from(SENDER, SENDER_NAME);
	    $this->email->to ($Email);
        $this->email->subject($Type);
        $this->email->cc(CC);
        $Data=array("Nom"=>$Nom,"Prenom"=>$Prenom);
        $message = "<html><head></head> <body>";
        $message .= "<h1>Ceci est un message provenant du module de génération</h1>";
        $message .= "<p>Bonjour,<br>une ".$Type." de : <b>". $Nom." ".$Prenom."</b> n'a pas été envoyée, l'adresse email ".$Motif.
        "<br>Veuillez trouver en pièce jointe le document généré.<br><br>
        L’équipe ANP Assurances Plaisance. <br></p>";
        $message .="Copyright © ANP Assurances Plaisance, <br>
        15 rue Beauvau<br>
        13001 Marseille <br>
        plaisance@harrel-courtes.fr<br>";	
        $message .= "</body></html>";
        $this->email->message($message);
        $this->email->attach($NomFichier);
        $resultat=($this->email->send()) ;
        $this->email->clear(true);
        return $resultat ;

        }
	public function TemplatePdf()
	{

        
             $data = array(
                 'IdContrat'=>'hghghghgh',
            'PolNoAssure'=>'50007921',
            'IdAssure' => '$IdAssure',
            'MvtId' => '$MvtId',
            'NoAssure' =>'$NoAssure',
            'NomAssure' => '$NomAssure',
            'PrenomAssure' => '$PrenomAssure',
            'TitAssure' => '$CiviliteAssure',
            'AdrAssure' => '$AdrAssure',
            'AdrAssure2' => '$AdrAssure2',
            'AdrAssure3' => '$AdrAssure3',
            'CpAssure' => '$CpAssure',
            'VilleAssure' => '$VilleAssure',
            'NatAssure' => '$NatAssure',
            'BatNom' => '$BatNom',
            'BatConstructeur' => '$BatConstructeur',
            'BatModele' => '$BatModele',
            'MotPuissance' => '$MotPuissance',
            'MotAnnee' => '$MotAnnee',
            'MotMarque' => '$MotMarque',
            'EmailAssure' => '$EmailAssure',
            'CieIdAssure' => '$CieIdAssure',
            'CieNomAssure' => '$CieNomAssure',
            'MvtEchDu' => '2012-12-10 00:00:00.000',
            'MvtEchAu' =>  '2013-06-09 00:00:00.000',
            'MvtMontant'=>'MvtMontant',
            'DateGeneration' =>  '2013-06-09 00:00:00.000',    
            'NomFichier'=>'$NomFichier'
            );
            
            //$this->load->view("AXA",$data);
            /*Situation Comptable
            $this -> load -> model('Database',true);
            $Data['results']=$this->database->SituationComptable(22521,2010);
            $Data["Nom"]="raaaaaa";
            $Data["Solde"]=1234.4;
            $output=$this->load->view("Templates/SituationComptable",$Data);
            */
            /*Statistiques assuré
            //$NoAssure=if(isset($_POST["NoAssure"]) $_POST[''];
            $Date=date("d/m/Y");
            $this -> load -> model('Database',true);
            $Data['data']=$this->database->StatistiquesAssure(60416,$Date);
            $Data['Date']=$Date;
            $Data["Nom"]="aaaaa";
            $output=$this->load->view("Templates/StatistiquesAssure",$Data);
         */
        /*statistiques detaillée compagnie
        //$EntIdCie=$_POST["EntIdCie"];
        //$Date=$_POST["Date"];
        //$Type=$_POST["Type"];
        $this -> load -> model('Database',true);
        $Data['data']=$this->database->StatistiquesCompagnie(2017,null,"D");
        $Data["Nom"]="gggg";
        $Data['Date']=date("d/m/Y");
         $output=$this->load->view("Templates/StatistiquesCompagnieDetails",$Data);
        */
         /*statistiques detaillée compagnie*/
        //$EntIdCie=$_POST["EntIdCie"];
        //$Date=$_POST["Date"];
        //$Type=$_POST["Type"];
        $this -> load -> model('Database',true);
        $Data['data']=$this->database->StatistiquesCompagnie(2017,null,"G");
        $Data["Nom"]="gggg";
        $Data['Date']=date("d/m/Y");
        $Data['NomFichier']="test.pdf";
        $output=$this->load->view("Templates/StatistiquesCompagnieGlobal",$Data);
     

            //$this->load->view("Templates/Relance",$data);
             
            }
    public function EnvoiEmails()
    {
        $this->load->library('email');
        $this->email->set_newline("<br>");
        $Email = $this -> input -> post('Email');
         
        if(empty(trim($Email)))
        {echo json_encode("false");
            return;}
        $Nom = $this -> input -> post('Nom');
        $Prenom = $this -> input -> post('Prenom');
        $this->load->model("database");
        $this->email->from(SENDER, SENDER_NAME);
        $this->email->to ($Email);
        $this->email->cc(CC);
        $this->email->subject('Attestation');
        $message = '<html><head></head> <body>';
        $message .= '<h4>Ceci est un message automatique, merci de ne pas y répondre.</h4>';
        $message .= "<img style='height: 100%; width: 100%;' src='https://qezttq.am.files.1drv.com/y4mE127ux50qo8EERDVSqHeCcP0G0oZ9JHe6fMHXrsTRYJ92lfiuT-z-O-OYwcsN_ItBXPZl8bxC5kM13Z6yD9cl1FhyNdHfvZUG4l5IWw-gPLBD7E-hDf-NdCBBEEJ3ilDY94QBOUqFe3mOQOOpVLhZTbzioJOxnJS8VuGGW66UG5kF7tCDfsVFe_C2ebwcX2vdiZalRr4p4-3GAe8uLL8Ew?width=800&height=220&cropmode=none' alt='photo1' />";
        $message .= '<p>Cher(e) assuré,<br> <br>
        Suite au règlement de votre prime d’assurance, veuillez trouver en pièce jointe votre attestation.<br><br>
        A très bientôt,<br><br> 
        L’équipe ANP Assurances Plaisance. <br>';
        $message .='Copyright © ANP Assurances Plaisance, <br>
        15 rue Beauvau<br>
        13001 Marseille <br>
        plaisance@harrel-courtes.fr<br></p>';	
        $message .= '</body></html>';
        $this->email->message($message);
       
        if (!$this->email->send()) 
        { echo json_encode('false'); }
        else 
        {
        echo json_encode('true');
        }
  
         
    } 
    public function EnvoiAttestationEmail()
    {
        $EmailAssure=$this->input->post("EmailAssure");
        $NomAssure=$this->input->post("NomAssure");
        $CiviliteAssure=$this->input->post("CiviliteAssure");
	    if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
            $CiviliteAssure="";
        $PrenomAssure=$this->input->post("PrenomAssure");
        $NomFichier=$this->input->post("NomFichier");
        if(!$this->EnvoiEmail($EmailAssure,$CiviliteAssure, $NomAssure, $PrenomAssure,$NomFichier,false))
            
		echo "impossible d'envoyer l'email";
             
        else 
        echo "Email envoyé!";
                    
            
    }
    
    public function EnvoiEmailDocument()
    {
        $EmailAssure=$this->input->post("EmailAssure");
        $NomAssure=$this->input->post("NomAssure");
        $IdAssure=$this->input->post("IdAssure");
        $MvtId=$this->input->post("MvtId");
        $CiviliteAssure=$this->input->post("CiviliteAssure");
	    if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
            $CiviliteAssure="";
        $PrenomAssure=$this->input->post("PrenomAssure");
        $NomFichier=$this->input->post("NomFichier");
        $Type=$this->input->post("Type");
        if($Type=="A")
       { 
           $NomFichier=$this->RenameFile(ATTEST_PATH,$NomFichier);
           
           $Genere=true;
            
           if(!$this->EnvoiEmail($EmailAssure,$CiviliteAssure, $NomAssure, $PrenomAssure,$NomFichier,false))

           {$Genere=false;}
            
           $this -> load -> model('Database');
           $result=$this->database->UpdateAttestation($IdAssure,$MvtId, $NomFichier,$Genere);
   
           if($Genere&&$result)
           {
               echo "Génération éffectuée avec succès!" ;  
       
           }
           else
           {
               echo "Attestation non générée!" ;  
       
           }

        
       }
       else 
       {

        if($Type=="R")$Type="Relance";
        else if($Type=="T") $Type="Quittance";
        $Genere=true;
        $NomFichier=$this->RenameFile(QUITTANCE_PATH,$NomFichier);
        if(!$this->EnvoiEmailActivite($EmailAssure,$CiviliteAssure,$NomAssure,$PrenomAssure,$NomFichier,$Type,false))
        {
            
            $Genere=false;
        }

    
        $this -> load -> model('Database');
        $result=$this->database->UpdateActivite($IdAssure,$MvtId, $NomFichier,$Genere,$Type);
        //$result=true;
        if($Genere&&$result)
        {
            
            
            echo "Génération éffectuée avec succès!" ;  
    
        }
        else
        {
        
            echo "Problème lors de la génération!" ;  
    
        }
        

       }
                    
            
    }
    
     public function EnvoiEmail($Email,$Civilite,$Nom,$Prenom,$NomFichier,$Ajax)
    {
         try
         {
            
        
         if(empty(trim($Email)))
         { 

		 $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom ,$Prenom, ATTEST_PATH.$NomFichier, "vide","Attestation");
               
                if(!$Ajax)
                    echo "Email vide ,";
		
                return false;
            }
            
            else if(!file_exists(ATTEST_PATH.$NomFichier))
            {

                 if(!$Ajax)
                   echo "Pièce jointe introuvable ,";
		
                return false;
            }

         
        $this->load->model("database");
        $this->email->from(SENDER, SENDER_NAME);
        $this->email->to ($Email);
        $this->email->cc(CC);
        $this->email->subject('Attestation');
        $msge=$this->load->view("Emails/Attestation",NULL,TRUE);
        $this->email->message($msge);
        $this->email->attach(ATTEST_PATH.$NomFichier);
        $resultat=$this->email->send(true) ;
	    $this->email->clear(true);
                if(!$resultat)
                {
                    
                $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, ATTEST_PATH.$NomFichier, "invalide","Attestation");
                 
                if(!$Ajax)
                    echo "impossible d'envoyer un email à cette adresse ,";
              
                }
	
                return $resultat;
            }
            
            catch (Exception $Ex)
            {
           
               $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, ATTEST_PATH.$NomFichier, $Ex,"Attestation");
               
				if(!$Ajax)
					echo $Ex;
				return false;			   
               
            }

    }
        
    public function EnvoiEmailActivite($Email,$Civilite,$Nom,$Prenom,$NomFichier,$Type,$Ajax)
    {
        
       
         try
         {
            
        
         if(empty(trim($Email)))
            { 

		 $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom ,$Prenom, QUITTANCE_PATH.$NomFichier, "vide",$Type);
               
                if(!$Ajax)
                    echo "Email vide";
		
                return false;
            }
            
            else if(!file_exists(QUITTANCE_PATH.$NomFichier))
            {

               
                 if(!$Ajax)
                   echo "Pièce jointe introuvable ,";
		
                return false;
            }

        
        $this->load->model("database");
        $this->email->from(SENDER, SENDER_NAME);
        $this->email->to ($Email);
        if($Type=="Quittance")
		$Sujet="Votre Avis d’Echéance d’Assurance Plaisance – ANP";
		else 
		$Sujet="Rappel de paiement ANP Assurances Plaisance"; 
        $this->email->subject($Sujet);
        $this->email->cc(CC);
        $msge=$this->load->view("Emails/".$Type,NULL,TRUE);
        $this->email->message($msge);
        $this->email->attach(QUITTANCE_PATH.$NomFichier);
        $resultat=$this->email->send(true) ;
	    $this->email->clear(true);
                if(!$resultat)
                {
                    
                $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, QUITTANCE_PATH.$NomFichier, "invalide",$Type);
                 
                if(!$Ajax)
                    echo "impossible d'envoyer un email à cette adresse ,";
              
                }
	
                return $resultat;
            }
            
            catch (Exception $Ex)
            {
           
               $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, QUITTANCE_PATH.$NomFichier, $Ex,$Type);
               
				if(!$Ajax)
					echo $Ex;
				return false;			   
               
            }

    }
    public function index()
    {
       
        //Create the folder for attestations
        try{
        if (!file_exists(ATTEST_PATH)) 
        mkdir(ATTEST_PATH, 0777);
        
        }catch(Exception $Ex)
        {echo $Ex;}
        $this->load->view('Login');
       
     }
     function NouvelAssure()
     {
    
               $IdAssure=$this -> input -> post('IdAssure');;
               $CiviliteAssure=$this -> input -> post('CiviliteAssure');
	           if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
               $CiviliteAssure="";
               $NomAssure=$this -> input -> post('NomAssure');
               $PrenomAssure=$this -> input -> post('PrenomAssure');
               $NoAssure=$this -> input -> post('NoAssure');
               $EmailAssure=$this -> input -> post('EmailAssure');
               $Token=$this->GenererToken();
               $resultat=$this->database->UpdateToken($IdAssure,$Token);
              
               if(!$resultat)
                
               {   echo json_encode("false");}
               
               try{
               if(empty(trim($EmailAssure)))
                    echo json_encode("false");
               else if(!$this->EnvoiEmailNouvelAssure($EmailAssure,$IdAssure,$CiviliteAssure, $NomAssure, $PrenomAssure,$Token))
               {
                   echo json_encode("false");
               }
               else
               { 
                   echo json_encode("true");
               }
               
               }catch(Exception $Ex)
               {
                   echo json_encode("false");
               }

    }
    function Quittances()
    {

           $this->load->model("Database");
           $Quittances=$this->database->Quittances();
           if(!$Quittances) {echo "Aucune quittance à générer!";return;}
		   
            foreach ($Quittances as $Quittance)
            {
			$IdAssure = $Quittance['ASS_Id'];
            $MvtId = $Quittance['MVT_ID'];
            $NoAssure = $Quittance['ASS_No'];
            $NomAssure = $Quittance['Ass_Nom'];
            $PrenomAssure = $Quittance['Ass_Prenom'];
            $CiviliteAssure = $Quittance['TIT_Nom'];
	        if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
            $CiviliteAssure="";
            $AdrAssure = $Quittance['Ass_Adr1'];
			 $AdrAssure2 = $Quittance['Ass_Adr2'];
			  $AdrAssure3 = $Quittance['Ass_Adr3'];
            $CpAssure = $Quittance['Ass_CP'];
            $VilleAssure = $Quittance['Ass_Ville'];
            $NatAssure = $Quittance['NAT_Nom'];
            $BatNom = $Quittance['Avb_Nom'];
            $EmailAssure = $Quittance['ASS_Email'];
            $MvtEchDu = $Quittance['Mvt_EchDu'];
            $MvtEchAu = $Quittance['MVT_EchAu'];
            $PolNoAssure= $Quittance['Pol_No'];
	        $MvtMontant = $Quittance['MVT_Mt'];
            $IdContrat=$Quittance['CAT_Nom'];
            $DevCode=$Quittance['DEV_Code'];
            
            $NomFichier="Quittance_".$NoAssure."_".date("d-m-Y").".pdf";
           
            $data = array(
			
            'PolNoAssure'=>$PolNoAssure,
            'IdAssure' => $IdAssure,
            'MvtId' => $MvtId,
            'NoAssure' =>$NoAssure,
            'NomAssure' => $NomAssure,
            'PrenomAssure' => $PrenomAssure,
            'TitAssure' => $CiviliteAssure,
            'AdrAssure' => $AdrAssure,
            'AdrAssure2' => $AdrAssure2,
            'AdrAssure3' => $AdrAssure3,
            'CpAssure' => $CpAssure,
            'VilleAssure' => $VilleAssure,
            'NatAssure' => $NatAssure,
            'BatNom' => $BatNom,
            'EmailAssure' => $EmailAssure,
            'MvtEchDu' =>str_replace("/", "-", $MvtEchDu),
            'MvtEchAu' =>str_replace("/", "-",$MvtEchAu),
            'MvtMontant'=>$MvtMontant,
            'NomFichier'=>$NomFichier,
	        'IdContrat'=>$IdContrat,
            'DevCode'=>$DevCode
            );
	        $Genere=true;
            $this->load->view("Templates/Quittance",$data);
             if(!$this->EnvoiEmailActivite($EmailAssure,$CiviliteAssure,$NomAssure,$PrenomAssure,$NomFichier,"Quittance",false))
            {
                
                $Genere=false;
            }


           
             $this -> load -> model('Database');
			 $result=$this->database->UpdateActivite($IdAssure,$MvtId, $NomFichier,$Genere,"Quittance");
       
             if($Genere&&$result)
             {
                
                  echo "Génération éffectuée avec succès!" ;  
           
             }
             else
             {
                
                    echo "Problème lors de la génération!" ;  
           
             }
            
             
            
            }       
    
    }
    function Relances()
    {
  
            $this->load->model("Database");
            $Relances=$this->database->Relances();
            if(!$Relances) {echo "Aucune relance à générer!";return;}
            foreach ($Relances as $Relance)
            {
            $IdAssure = $Relance['ASS_Id'];
            $MvtId = $Relance['MVT_ID'];
            $NoAssure = $Relance['ASS_No'];
            $NomAssure = $Relance['Ass_Nom'];
            $PrenomAssure = $Relance['Ass_Prenom'];
            $CiviliteAssure = $Relance['TIT_Nom'];
	        if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
            $CiviliteAssure="";
            $AdrAssure = $Relance['Ass_Adr1'];
			 $AdrAssure2 = $Relance['Ass_Adr2'];
			  $AdrAssure3 = $Relance['Ass_Adr3'];
            $CpAssure = $Relance['Ass_CP'];
            $VilleAssure = $Relance['Ass_Ville'];
            $NatAssure = $Relance['NAT_Nom'];
            $BatNom = $Relance['Avb_Nom'];
            $EmailAssure = $Relance['ASS_Email'];
            $MvtEchDu = $Relance['Mvt_EchDu'];
            $MvtEchAu = $Relance['MVT_EchAu'];
            $PolNoAssure= $Relance['Pol_No'];
			$MvtMontant = $Relance['MVT_Mt'];
            $IdContrat=$Relance['CAT_Nom'];
            $DevCode=$Relance['DEV_Code'];
            $NomFichier="Relance_".$NoAssure."_".date("d-m-Y").".pdf";
           
            $data = array(
            'PolNoAssure'=>$PolNoAssure,
            'IdAssure' => $IdAssure,
            'MvtId' => $MvtId,
            'NoAssure' =>$NoAssure,
            'NomAssure' => $NomAssure,
            'PrenomAssure' => $PrenomAssure,
            'TitAssure' => $CiviliteAssure,
            'AdrAssure' => $AdrAssure,
            'AdrAssure2' => $AdrAssure2,
            'AdrAssure3' => $AdrAssure3,
            'CpAssure' => $CpAssure,
            'VilleAssure' => $VilleAssure,
            'NatAssure' => $NatAssure,
            'BatNom' => $BatNom,
            'EmailAssure' => $EmailAssure,
            'MvtEchDu' =>str_replace("/", "-", $MvtEchDu),
            'MvtEchAu' =>str_replace("/", "-",$MvtEchAu),
            'MvtMontant'=>$MvtMontant,
            'NomFichier'=>$NomFichier,
			'IdContrat'=>$IdContrat,
            'DevCode'=>$DevCode
            );
	    $Genere=true;
            $this->load->view("Templates/Relance",$data);
             if(!$this->EnvoiEmailActivite($EmailAssure,$CiviliteAssure,$NomAssure,$PrenomAssure,$NomFichier,"Relance",false))
            {
                
                $Genere=false;
            }
           
             $this -> load -> model('Database');
             $result=$this->database->UpdateActivite($IdAssure,$MvtId, $NomFichier,$Genere,"Relance");
          
             if($Genere&&$result)
             {
                 
                  echo "Génération éffectuée avec succès!" ;  
           
             }
             else
             {
                 
                    echo "Problème lors de la génération!" ;  
           
             }
            
             
            
            }       
    
    }
    function NouveauxAssures()
    {
           $this->load->model("Database");
           $Assures=$this->database->NouveauxAssures();
           if(!$Assures) {echo "Aucun nouvel assuré!";return;}
           foreach($Assures as $Assure)
           
           {
               
               $IdAssure=$Assure["ASS_Id"];
               $CiviliteAssure=$Assure["TIT_Nom"];
	           if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
               $CiviliteAssure="";
               $NomAssure=$Assure["Ass_Nom"];
               $PrenomAssure=$Assure["Ass_Prenom"];
               $NoAssure=$Assure["ASS_No"];
               $EmailAssure=$Assure["ASS_Email"];
	           $Token=$this->GenererToken($IdAssure);
               $Entete = date("d-m-Y")." - ".$IdAssure." - ".$NomAssure."  ".$PrenomAssure;
               $resultat=$this->database->UpdateToken($IdAssure,$Token);
               
               if(!$resultat)
                
               {    printf( "%s<br />",$Entete." : ".json_encode($resultat)."\r\n"); continue;}
               
               try{
               if(empty(trim($EmailAssure)))
                    printf( "%s<br />",$Entete." : Email Vide\r\n");
               else if(!$this->EnvoiEmailNouvelAssure($EmailAssure,$IdAssure,$CiviliteAssure, $NomAssure, $PrenomAssure,$Token))
               {
                    printf( "%s<br />",$Entete." : impossible d'envoyer un email à cette adresse\r\n");
               
               }
               else
               { 
                   printf( "%s<br />",$Entete." : Email Envoyé avec succès!\r\n");
               }
               
               }catch(Exception $Ex)
               {
                  printf( "%s<br />",$Entete." : ".$Ex."\r\n");
               }

           }
           
	}
    function GenererPDF($CieId,$data)
    {
        $Envoye=true;

        if($CieId==1027||$CieId==1014||$CieId==3771||$CieId==3936)
        $this->load->view("Templates/AXA",$data);
        else if ($CieId==10||$CieId==1025)
        $this->load->view("Templates/MMA",$data);
        else if($CieId==1035||$CieId==3836||$CieId==15)
        $this->load->view("Templates/Generali",$data);
        else if($CieId==2166||$CieId==3907)
        $this->load->view("Templates/HELVETIA",$data);
        else
        {$Envoye=false;
        $this->load->view("Templates/Standard",$data);
        }
        return $Envoye;
        }
        function Login_Form()
        {
            $this->load->view("Login");
        }

            function GenererEmails()
            { 
            $this->load->model("database");
            $Attestations=$this->database->EmailsAGenerer();
            if(!$Attestations ){echo "Aucune attestation à générer";return;}
            foreach($Attestations as $Attestation)
            {
                $IdAssure = $Attestation['ASS_Id'];
                $MvtId = $Attestation['MVT_ID'];
                $NoAssure = $Attestation['ASS_No'];
                $NomAssure = $Attestation['Ass_Nom'];
                $PrenomAssure = $Attestation['Ass_Prenom'];
                $CiviliteAssure = $Attestation['TIT_Nom'];
                if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
                $CiviliteAssure="";
                $AdrAssure = $Attestation['Ass_Adr1'];
                $CpAssure = $Attestation['Ass_CP'];
                $VilleAssure = $Attestation['Ass_Ville'];
                $NatAssure = $Attestation['NAT_Nom'];
                $BatNom = $Attestation['Avb_Nom'];
                $BatConstructeur = $Attestation['BAT_Constructeur'];
                $BatModele = $Attestation['BAT_Modele'];
                $MotPuissance = $Attestation['MOT_Puissance'];
                $MotAnnee = $Attestation['MOT_Annee'];
                $MotMarque = $Attestation['MOT_Marque'];
                $EmailAssure = $Attestation['ASS_Email'];
                $CieIdAssure = $Attestation['Cie_Id'];
                $CieNomAssure = $Attestation['Cie_Nom'];
                $MvtEchDu = $Attestation['Mvt_EchDu'];
                $MvtEchAu = $Attestation['MVT_EchAu'];
                $PolNoAssure= $Attestation['Pol_No'];
                $NomFichier=$NoAssure."_".date("d-m-Y").".pdf";
                $data = array(
                'PolNoAssure'=>$PolNoAssure,
                'IdAssure' => $IdAssure,
                'MvtId' => $MvtId,
                'NoAssure' =>$NoAssure,
                'NomAssure' => $NomAssure,
                'PrenomAssure' => $PrenomAssure,
                'TitAssure' => $CiviliteAssure,
                'AdrAssure' => $AdrAssure,
                'CpAssure' => $CpAssure,
                'VilleAssure' => $VilleAssure,
                'NatAssure' => $NatAssure,
                'BatNom' => $BatNom,
                'BatConstructeur' => $BatConstructeur,
                'BatModele' => $BatModele,
                'MotPuissance' => $MotPuissance,
                'MotAnnee' => $MotAnnee,
                'MotMarque' => $MotMarque,
                'EmailAssure' => $EmailAssure,
                'CieIdAssure' => $CieIdAssure,
                'CieNomAssure' => $CieNomAssure,
                'MvtEchDu' => str_replace("/", "-",$MvtEchDu),
                'MvtEchAu' => str_replace("/", "-",$MvtEchAu),
                'NomFichier'=>$NomFichier
                );
                $Genere=true;
                $Entete = date("d-m-Y")." - ".$IdAssure." - ".$NomAssure."  ".$PrenomAssure;
                
                try
                {
                    
                $Envoye=$this->GenererPDF($CieIdAssure,$data);
                
                if($Envoye&&!$this->EnvoiEmail($EmailAssure, $CiviliteAssure,$NomAssure, $PrenomAssure,$NomFichier,false))
                {   
                
                    printf( "%s<br />", $Entete." : impossible d'envoyer un email à cette adresse\r\n");
                    $Genere=false;
                    
                }
                        
                
                }
                catch (Exception $Ex)
                {
                $Genere=false;
                printf( "%s<br />", $Entete." : ". $Ex); 
                }
                $this -> load -> model('Database');
                
                $result=$this->database->UpdateAttestation($IdAssure,$MvtId, $NomFichier,$Genere);
                
                if($result)
                {
                if($Genere)printf( "%s<br />",$Entete." : Génération effectuée avec succès!\r\n" );  
                }
                else 
                printf( "%s<br />", $Entete." : ".$result."\r\n");
            
                sleep(30);
            }
                
            }
            function EnvoiEmailNouvelAssure($EmailAssure,$IdAssure,$CiviliteAssure, $NomAssure, $PrenomAssure,$Token)
            {
            
            if(empty(trim($EmailAssure)))return false;
            $this->load->model("database");
            $this->email->from(SENDER, SENDER_NAME);
            $this->email->to ($EmailAssure);
            $this->email->cc(CC);
            $this->email->subject('Activation compte sillage');
            $Data=array("IdAssure"=>$IdAssure,"Token"=>$Token);
            $message =$this->load->view("Emails/NouvelAssure",$Data,true);
        
            $this->email->message($message);
            $resultat=($this->email->send()) ;
            $this->email->clear(true);
            return $resultat ;

            
                
            }
            function Login_s()
            {
            $User=$this -> input -> post('User');
            $Password=$this -> input -> post('Password');
            if($User=="Marseille"& $Password=="marseille")
                $this->load->view("FicheAssure");
            else
                echo "false";

            }
            function FicheAssure()
            {
                if(!$this->session->userdata("LoggedIn"))
                redirect(base_url("Main/Login_Form"));
                $this->load->view("FicheAssure");
            }
            function Login()
            {
            $CodeApplication="W";
        
            $User=$this -> input -> post('User');
            $Password=$this -> input -> post('Password');

            $this -> load -> model('database');
            $result=$this -> database ->Login($CodeApplication,$User);
        
            if(!$result)
            echo 'false';
            else 
            {
            $UTI_Nom=$result["UTI_Nom"];
            $UTI_MotPasse=$result["UTI_MotPasse"];
            if($UTI_MotPasse==$Password&&$UTI_Nom==$User)
            {
            $newdata = array( 
            'Username'  => $UTI_Nom, 
            'LoggedIn' => TRUE
            );  

                $this->session->set_userdata($newdata);
                $this->load->view("FicheAssure");
            }
            else
                echo "false";
            }
            }
        
            function GenererAttestation()
            {
                // si la session est expirée alors rediriger a la pae de login
            
                
                $Ajax=isset($_POST["Ajax"]);
                $IdAssure = $this -> input -> post('IdAssure');
                $MvtId = $this -> input -> post('MvtId');
                $NoAssure = $this -> input -> post('NoAssure');
                $NomAssure = $this -> input -> post('NomAssure');
                $PrenomAssure = $this -> input -> post('PrenomAssure');
                $CiviliteAssure = $this -> input -> post('TitAssure');
                if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
                $CiviliteAssure="";
                $AdrAssure = $this -> input -> post('AdrAssure');
                $CpAssure = $this -> input -> post('CpAssure');
                $VilleAssure = $this -> input -> post('VilleAssure');
                $NatAssure = $this -> input -> post('NatAssure');
                $BatNom = $this -> input -> post('BatNom');
                $BatConstructeur = $this -> input -> post('BatConstructeur');
                $BatModele = $this -> input -> post('BatModele');
                $MotPuissance = $this -> input -> post('MotPuissance');
                $MotAnnee = $this -> input -> post('MotAnnee');
                $MotMarque = $this -> input -> post('MotMarque');
                $EmailAssure = $this -> input -> post('EmailAssure');
                $CieIdAssure = $this -> input -> post('CieIdAssure');
                $CieNomAssure = $this -> input -> post('CieNomAssure');
                $MvtEchDu = $this -> input -> post('MvtEchDu');
                $MvtEchAu = $this -> input -> post('MvtEchAu');
                $PolNoAssure= $this -> input -> post('PolNoAssure');
                $NomFichier=$NoAssure."_".date("d-m-Y").".pdf";
            
                $data = array(
                'PolNoAssure'=>$PolNoAssure,
                'IdAssure' => $IdAssure,
                'MvtId' => $MvtId,
                'NoAssure' =>$NoAssure,
                'NomAssure' => $NomAssure,
                'PrenomAssure' => $PrenomAssure,
                'TitAssure' => $CiviliteAssure,
                'AdrAssure' => $AdrAssure,
                'CpAssure' => $CpAssure,
                'VilleAssure' => $VilleAssure,
                'NatAssure' => $NatAssure,
                'BatNom' => $BatNom,
                'BatConstructeur' => $BatConstructeur,
                'BatModele' => $BatModele,
                'MotPuissance' => $MotPuissance,
                'MotAnnee' => $MotAnnee,
                'MotMarque' => $MotMarque,
                'EmailAssure' => $EmailAssure,
                'CieIdAssure' => $CieIdAssure,
                'CieNomAssure' => $CieNomAssure,
                'MvtEchDu' =>str_replace("/", "-", $MvtEchDu),
                'MvtEchAu' =>str_replace("/", "-",$MvtEchAu),
                'NomFichier'=>$NomFichier
                );
            
                $Genere=true;
            
                $Envoye=$this->GenererPDF($CieIdAssure,$data);
            
                if($Envoye)
                {
            
                if(!$this->EnvoiEmail($EmailAssure,$CiviliteAssure, $NomAssure, $PrenomAssure,$NomFichier,$Ajax))

                {$Genere=false;}

                }
        
                $this -> load -> model('Database');
                $result=$this->database->UpdateAttestation($IdAssure,$MvtId, $NomFichier,$Genere);
        
                if($Genere&&$result)
                {
                    if($Ajax) 
                    echo json_encode("true");
                    else
                    echo "Génération éffectuée avec succès!" ;  
            
                }
                else
                {
                    if($Ajax)
                        echo json_encode("false");
                    else
                    echo "Attestation non générée!" ;  
            
                }
                
                
                
            
            }
            function GenererActivite()
            {
                
                $Ajax=isset($_POST["Ajax"]);
                $Type=$_POST["Type"];
                $IdContrat=$this -> input -> post('IdContrat');
                $IdAssure = $this -> input -> post('IdAssure');
                $MvtId = $this -> input -> post('MvtId');
                $NoAssure = $this -> input -> post('NoAssure');
                $NomAssure = $this -> input -> post('NomAssure');
                $PrenomAssure = $this -> input -> post('PrenomAssure');
                $CiviliteAssure = $this -> input -> post('TitAssure');
                if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
                $CiviliteAssure="";
                $AdrAssure = $this -> input -> post('AdrAssure');
                $AdrAssure2 = $this -> input -> post('AdrAssure2');
                $AdrAssure3 = $this -> input -> post('AdrAssure3');
                $CpAssure = $this -> input -> post('CpAssure');
                $VilleAssure = $this -> input -> post('VilleAssure');
                $NatAssure = $this -> input -> post('NatAssure');
                $BatNom = $this -> input -> post('BatNom');
                $EmailAssure = $this -> input -> post('EmailAssure');
                $MvtEchDu = $this -> input -> post('MvtEchDu');
                $MvtEchAu = $this -> input -> post('MvtEchAu');
                $MvtMontant = $this -> input -> post('MvtMontant');
                $test = explode(' ',$MvtMontant);
                $MvtMontant= $test[0]; 
                $DevCode= $test[1];
                $PolNoAssure= $this -> input -> post('PolNoAssure');
                
                $NomFichier=$Type."_".$NoAssure."_".date("d-m-Y").".pdf";
            
                $data = array(
                
                'PolNoAssure'=>$PolNoAssure,
                'IdContrat'=>$IdContrat,
                'IdAssure' => $IdAssure,
                'MvtId' => $MvtId,
                'NoAssure' =>$NoAssure,
                'NomAssure' => $NomAssure,
                'PrenomAssure' => $PrenomAssure,
                'TitAssure' => $CiviliteAssure,
                'AdrAssure' => $AdrAssure,
                'AdrAssure2' => $AdrAssure2,
                'AdrAssure3' => $AdrAssure3,
                'CpAssure' => $CpAssure,
                'VilleAssure' => $VilleAssure,
                'NatAssure' => $NatAssure,
                'BatNom' => $BatNom,
                'EmailAssure' => $EmailAssure,
                'MvtEchDu' =>str_replace("/", "-", $MvtEchDu),
                'MvtEchAu' =>str_replace("/", "-",$MvtEchAu),
                'MvtMontant'=>$MvtMontant,
                'NomFichier'=>$NomFichier,
                'DevCode'=>$DevCode
                );
                $Genere=true;
                $this->load->view("Templates/".$Type,$data);
                //if(!$this->EnvoiEmail($EmailAssure, null,$Type, QUITTANCE_PATH.$NomFichier,$Ajax))
                if(!$this->EnvoiEmailActivite($EmailAssure,$CiviliteAssure,$NomAssure,$PrenomAssure,$NomFichier,$Type,$Ajax))
                {
                    
                    $Genere=false;
                }

            
                $this -> load -> model('Database');
                $result=$this->database->UpdateActivite($IdAssure,$MvtId, $NomFichier,$Genere,$Type);
                //$result=true;
                if($Genere&&$result)
                {
                    
                    if($Ajax) 
                    echo json_encode("true");
                    else
                    echo "Génération éffectuée avec succès!" ;  
            
                }
                else
                {
                    if($Ajax)
                        echo json_encode("false");
                    else
                        echo "Problème lors de la génération!" ;  
            
                }
                
                
                
            }
            function RegenererAttestation()
            {
                $IdAssure=$this->input->post("IdAssure");
                $MvtId=$this->input->post("MvtId");
                $EmailAssure=$this->input->post("EmailAssure");
                $NomAssure=$this->input->post("NomAssure");
                $CiviliteAssure=$this->input->post("CiviliteAssure");
                if(!stripos($CiviliteAssure,"Madame")&&!stripos($CiviliteAssure,"Monsieur")&&!stripos($CiviliteAssure,"Mademoiselle"))
                $CiviliteAssure="";
                $PrenomAssure=$this->input->post("PrenomAssure");
                $NomFichier=$this->input->post("NomFichier");
                $Genere=true;
                $CieId=$this->input->post("CieId");

            if($CieId==1027||$CieId==1014||$CieId==3771||$CieId==3936 || $CieId==10||$CieId==1025||
            $CieId==1035||$CieId==3836||$CieId==15||$CieId==2166||$CieId==3907)
            {
            
                if(!$this->EnvoiEmail($EmailAssure,$CiviliteAssure, $NomAssure, $PrenomAssure,$NomFichier,false))
            { 
                    echo "impossible de regénerer l'attestation";
                    $Genere=false;
            }


                }
                $this -> load -> model('Database');
                $result=$this->database->RegenererAttestation($IdAssure,$MvtId, $NomFichier,$Genere);
                
                if($result)
                {
                if($Genere)echo "Génération éffectuée avec succès!" ;  
                }
                else 
                    echo "impossible de regénérer l'attestation";
        
                
            }
            function OpenPDF($FileName)
            
            {
                
                        if(!$this->session->userdata("LoggedIn"))
                        redirect(URL.'Login_Form');
                
                    $FileName = ATTEST_PATH.$FileName;
                    header("Content-type: application/pdf"); 
                    header("Content-Length: " . filesize($FileName)); 
                    readfile($FileName);
            }
            function OpenQuittancePDF($FileName)
            
            {
                
                        if(!$this->session->userdata("LoggedIn"))
                        redirect(URL.'Login_Form');
                
                    $FileName = QUITTANCE_PATH.$FileName;
                    header("Content-type: application/pdf"); 
                    header("Content-Length: " . filesize($FileName)); 
                    readfile($FileName);
            }
            

            function OpenFichier($FileName,$Type)
            {
                if($Type==1)
                {
                    $Folder=ATTEST_PATH;
                }
                else if($Type==2||$Type==3)
                {
                    $Folder=QUITTANCE_PATH;
                }
                else 
                {
                    $Folder=EXTRA_PATH;
                }
                $FileName=$Folder.$FileName;
                header("Content-type: application/pdf"); 
                header("Content-Length: " . filesize($FileName)); 
                readfile($FileName);

            }
            function ListeAttestations()
            {
                if(!$this->session->userdata("LoggedIn"))
                redirect(base_url("Main/Login_Form"));
                $this -> load -> model('database');
                $Assure = $this -> input -> post('Assure');
                $AssureNo=$this -> input -> post('AssureNo');
                $rows = $this->database->ListeAttestations($Assure,$AssureNo);
                echo json_encode($rows);
        
                
            }
            function ListeAttestations_Test()
            {
                
                $this -> load -> model('database');
                $Assure = $this -> input -> get('Assure');
                $AssureNo=$this -> input ->get('AssureNo');
                $rows = $this->database->ListeAttestations($Assure,$AssureNo);
                echo json_encode($rows);
        
                
            }
        
            function ListeAssures()
            {
                
                $this -> load -> model('Database');
                $term = $this -> input -> post('Assure');
        
            if (strlen($term) < 2)
                return;

            $rows = $this->database->ListeAssures($term);
        
                    $json_array=array();
                    foreach ($rows as $row){
                    if (stripos($row["Ass_Nom"], $term) !== false||stripos($row["Ass_Prenom"], $term) !== false ||stripos($row["ASS_No"], $term) !== false) {
                        array_push($json_array, $row);
                        
                    }
                    }
                echo (json_encode($json_array));
                    
            
            }
        
            function InfosAssure() {
                    if(!$this->session->userdata("LoggedIn"))
                    redirect(base_url("Main/Login_Form"));
                    $this -> load -> model('Database');
                    $term = $this -> input -> post('term');
                    $row= $this -> database -> InfosAssure($term);
                    echo json_encode($row);

            
        
        }
        function UpdateAttestation()
        {
                $IdAssure = $this -> input -> post('IdAssure');
                $MtvId= $this -> input -> post('MtvId');
                $this -> load -> model('Database');
                if($this -> database -> InfosAssure($term))
                echo "true";
                else 
                echo"false";
        
        
        }
        
        function generateRandomString($length = 32) 
        {
                $characters = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ0123456789!@$?_-";
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++)
                {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
            return $randomString;
        }
        function GenererToken()
        {
                $RandomString=$this->generateRandomString();
                $UtfString=utf8_encode ( SALT.$RandomString );
                return  date("Y-m-d",strtotime('+1 year'))."T".date("H:i:s")."+".$RandomString;  
        }
        function EmailsAGenerer()
        {
                if(!$this->session->userdata("LoggedIn"))
                    redirect(base_url("Main/Login_Form"));
                $this -> load -> model('Database',true);
            $Data['Array']=$this->database->EmailsAGenerer();
                $this->load->view("EmailsAGenerer",$Data);

        }
        function EmailsNouveauxAssures()
        {
                if(!$this->session->userdata("LoggedIn"))
                    redirect(base_url("Main/Login_Form"));
                $this -> load -> model('Database',true);
                $Data['Array']=$this->database->NouveauxAssures();
                $this->load->view("EmailsNouveauxAssures",$Data);
    
        }
            function EmailsRelances()
            {
        
                if(!$this->session->userdata("LoggedIn"))
                redirect(base_url("Main/Login_Form"));
                $this -> load -> model('Database',true);
                $Data['Array']=$this->database->Relances();
                
                $this->load->view("EmailsRelances",$Data);
    
        
            }
            function EmailsQuittances()
        {
                
                if(!$this->session->userdata("LoggedIn"))
                    redirect(base_url("Main/Login_Form"));
                $this -> load -> model('Database',true);
            $Data['Array']=$this->database->Quittances();
                $this->load->view("EmailsQuittances",$Data);
    
        }
        function DocumentsGeneres()
        {
            $IdAssure=$_POST["IdAssure"];
            $Type=$_POST["Type"];
            $DateDebut=$_POST["DateDebut"];
            $DateFin=$_POST["DateFin"];
            $this -> load -> model('Database',true);
            $Data['results']=$this->database->DocumentsGeneres($IdAssure,$Type,$DateDebut,$DateFin);
            $Data['Type']=$Type;
            $Data['DateDebut']=$DateDebut;
            $Data['DateFin']=$DateFin;
            $output=$this->load->view("DocumentsGeneres",$Data);
        

        }
        function SituationComptable()
        {
            $IdAssure=$_POST["IdAssure"];
            $Annee=$_POST["Annee"];
            $this -> load -> model('Database',true);
            $Data['results']=$this->database->SituationComptable($IdAssure,$Annee);
            $Data['Annee']=$Annee;
            //print_r($Data['results']);
            $output=$this->load->view("SituationComptable",$Data);
        

        }
        function StatistiquesAssure()
        {
            $NoAssure=$_POST["NoAssure"];
            $Date=$_POST["Date"];
            $this -> load -> model('Database',true);
            $Data['results']=$this->database->StatistiquesAssure($NoAssure,$Date);
            $Data['Date']=$Date;
            $output=$this->load->view("StatistiquesAssure",$Data);
        

        }
        function DossierCompagnie()
        {
            $this -> load -> model('Database',true);
            $Data['Results']=$this->database->ListeCompagnies();
            $this->load->view("DossierCompagnie",$Data);
        
        }
        function StatistiquesCompagnie()
        {
            $EntIdCie=$_POST["EntIdCie"];
            $Date=$_POST["Date"];
            $Type=$_POST["Type"];
            $this -> load -> model('Database',true);
            $Data['results']=$this->database->StatistiquesCompagnie($EntIdCie,$Date,$Type);
        
            $Data['Date']=$Date;
            if($Type=="D")
            $output=$this->load->view("StatistiquesCompagnieDetails",$Data);
            else if($Type=="G")
            $output=$this->load->view("StatistiquesCompagnieGlobal",$Data);
            

        

        }
        function EnvoiEmailSituationComptable()
        {
            
            $IdAssure=$_POST["IdAssure"];
            $Nom=$_POST["NomAssure"];
            $Prenom=$_POST["PrenomAssure"];
            $Civilite=$_POST["CiviliteAssure"];
            $Solde=$_POST["SoldeAssure"];
            $Email=$_POST["EmailAssure"];
            $NoAssure=$_POST["NoAssure"];
            if(!$IdAssure||!$Email)
            {echo "Erreur, email vide";return;}
            $Annee=$_POST["Annee"];
            $this -> load -> model('Database',true);
            $Data['results']=$this->database->SituationComptable($IdAssure,null);
            $Data["Nom"]=$Civilite." ".$Nom." ".$Prenom;
            $Data["Solde"]=$Solde;

            $NomFichier="SituationCompt".$NoAssure."_".date("d-m-Y").".pdf";
            $Data["NomFichier"]=$NomFichier; 
            $this->load->view("Templates/SituationComptable",$Data);
        
            try
            {
            
        
            if(empty(trim($Email)))
            { 

            $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom ,$Prenom, ATTEST_PATH.$NomFichier, "vide","Situation Comptable");
            echo "Email Vide"  ;     
            return ;
            }
            
            else if(!file_exists(EXTRA_PATH.$NomFichier))
            {

                echo "Pièce jointe introuvable"  ;     
                return ;
            }

            
        
        $this->email->from(SENDER, SENDER_NAME);
        $this->email->to ($Email);
        $this->email->cc(CC);
        $this->email->subject('Situation Comptable');
        $msge=$this->load->view("Emails/SituationComptable",NULL,TRUE);
        $this->email->message($msge);
        $this->email->attach(EXTRA_PATH.$NomFichier);
        $resultat=$this->email->send(true) ;
        $this->email->clear(true);
        if(!$resultat)
            {
                    
                $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, EXTRA.$NomFichier, "invalide","Situation Comptable");
                echo "Impossible d'envoyer un email à cet adresse"  ;
                return ;
            }
            else 
            {
                    echo "Email Envoyé"  ;
                
            }
            }
            
            catch (Exception $Ex)
            {
            
                $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, ATTEST_PATH.$NomFichier, $Ex,"Attestation");
                
                echo json_encode("Impossible d'envoyer un email à cet adresse")  ;
                return ;			   
                
            }

        
        }
        function EnvoiEmailStatistiquesAssure()
        {
            
            $IdAssure=$_POST["IdAssure"];
            $Nom=$_POST["NomAssure"];
            $Prenom=$_POST["PrenomAssure"];
            $Civilite=$_POST["CiviliteAssure"];
            $Email=$_POST["EmailAssure"];
            $NoAssure=$_POST["NoAssure"];
            if(!$IdAssure||!$Email)
            {echo "Erreur, email vide";return;}
            $Date=$_POST["Date"];
        
            $this -> load -> model('Database',true);
            $Data['data']=$this->database->StatistiquesAssure($NoAssure,$Date);
            $Data['Date']=$Date;
            $Data["Nom"]=$Civilite." ".$Nom." ".$Prenom;
            $NomFichier="StatAssureD".$NoAssure."_".date("d-m-Y").".pdf";
            $Data["NomFichier"]=$NomFichier; 
            $output=$this->load->view("Templates/StatistiquesAssure",$Data);
        
            try
            {
            
        
            if(empty(trim($Email)))
            { 

            $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom ,$Prenom, EXTRA_PATH.$NomFichier, "vide","Statistiques Assuré détaillées");
                echo "Email Vide"  ;     
            return ;
            }
            
            else if(!file_exists(EXTRA_PATH.$NomFichier))
            {
                echo "Pièce jointe introuvable" ;     
                return ;
            }

            
        
        $this->email->from(SENDER, SENDER_NAME);
        $this->email->to ($Email);
        $this->email->cc(CC);
        $this->email->subject('Statistiques Assuré Détaillées');
        $msge=$this->load->view("Emails/StatistiquesAssure",NULL,TRUE);
        $this->email->message($msge);
        $this->email->attach(EXTRA_PATH.$NomFichier);
        $resultat=$this->email->send(true) ;
        $this->email->clear(true);
        if(!$resultat)
            {
                    
                $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, EXTRA_PATH.$NomFichier, "invalide","Statistiques Assuré");
                echo "Impossible d'envoyer un email à cet adresse"  ;
                return ;
            }
            else 
            {
                    echo "Email Envoyé" ;
                
            }
            }
            
            catch (Exception $Ex)
            {
            
                $this->EnvoiEmailNotification(EMAIL_ADMIN, $Civilite, $Nom, $Prenom, EXTRA_PATH.$NomFichier, $Ex,"Statistiques Assuré");
                echo "Impossible d'envoyer un email à cet adresse"  ;
                return ;			   
                
            }

        
        }
        function EnvoiEmailStatistiquesCompagnie()
        {
        $EntIdCie =$_POST['EntIdCie'];
        $Type=$_POST['Type'] ;
        $Email=$_POST['Email'];
        $Date=$_POST['Date'];
        $Nom=$_POST["Nom"];
        if(!$EntIdCie||!$Email)
        {echo "Erreur, email vide";return;}
    
    
        $this -> load -> model('Database',true);
        $Data['Date']=$Date;
        
        $Data['data']=$this->database->StatistiquesCompagnie($EntIdCie,$Date,$Type);
        $Data['Date']=$Date;
        $Data["Nom"]=$Nom;
        $NomFichier="StatCompagnie".$Type.$EntIdCie."_".date("d-m-Y").".pdf";
        $Data["NomFichier"]=$NomFichier; 
        if($Type=="D")
        $output=$this->load->view("Templates/StatistiquesCompagnieDetails",$Data);
        else if($Type=="G")
        $output=$this->load->view("Templates/StatistiquesCompagnieGlobal",$Data);
        
        try
        {
        
    
        if(empty(trim($Email)))
        { 

        $this->EnvoiEmailNotification(EMAIL_ADMIN, "", $Nom ,"", EXTRA_PATH.$NomFichier, "vide","Statistiques Compagnie");
        echo "Email Vide"  ;     
        return ;
        }
        
        else if(!file_exists(EXTRA_PATH.$NomFichier))
        {

            echo "Pièce jointe introuvable"  ;     
            return ;
        }

        
    
    $this->email->from(SENDER, SENDER_NAME);
    $this->email->to ($Email);
    $this->email->cc(CC);
    if($Type=="D")
    $this->email->subject('Statistiques Compagnie Détaillées');
    else if($Type=="G")
    $this->email->subject('Statistiques Compagnie Globales');
    
    if($Type=="D")
    $msge=$this->load->view("Emails/StatistiquesCompagnieDetails",$Data,TRUE);
    else if($Type=="G")
    $msge=$this->load->view("Emails/StatistiquesCompagnieGlobal",$Data,TRUE);
        
    $this->email->message($msge);
    $this->email->attach(EXTRA_PATH.$NomFichier);
    $resultat=$this->email->send(true) ;
    $this->email->clear(true);
    if(!$resultat)
        {
                
            $this->EnvoiEmailNotification(EMAIL_ADMIN, "", $Nom, "", EXTRA.$NomFichier, "invalide","Statistiques Compagnie");
            echo "Impossible d'envoyer un email à cet adresse" ;
            return ;
        }
        else 
        {
                echo "Email Envoyé"  ;
            
        }
        }
        
        catch (Exception $Ex)
        {
        
            $this->EnvoiEmailNotification(EMAIL_ADMIN, "", $Nom, "", EXTRA_PATH.$NomFichier, $Ex,"Statistiques Compagnie");
            
            echo "Impossible d'envoyer un email à cet adresse"  ;
            return ;			   
            
        }
        }
    function AccesFichiers()
    {
        $this->load->view("AccesFichiers");
    }
    function DetailsFichier()
    {
        $ArrayFiles=array();
        $Type=$this->input->post("Type");
        $Filter=null;
        $Folder="";
        if($Type==1)
        {
            $Folder=ATTEST_PATH;
        }
        else if($Type==2)
        {
            $Filter="Quittance";
            $Folder=QUITTANCE_PATH;
        }
        else if($Type==3)
        {
            $Filter="Relance";
            $Folder=QUITTANCE_PATH;
        }
        else if($Type==4)
        {
            $Filter="SituationCompt";
            $Folder=EXTRA_PATH;
        }
        else if($Type==5)
        {
            $Filter="StatAssureD";
            $Folder=EXTRA_PATH;
        }
        else if($Type==6)
        {
            $Filter="StatCompagnieD";
            $Folder=EXTRA_PATH;
        }
        else if($Type==7)
        {
            $Filter="StatCompagnieG";
            $Folder=EXTRA_PATH;
        }

        $iterator = new FilesystemIterator($Folder);
        foreach($iterator as $fileInfo)
        {
        if($fileInfo->isFile())
        {
            if($Filter)
            {
                $pos = strpos($fileInfo->getFileName(), $Filter);

                if ($pos !== false) {
                array_push($ArrayFiles,$fileInfo);

                }
            }
            else
            array_push($ArrayFiles,$fileInfo);

        }

        
        
        
    }
        $Data["Files"]=$ArrayFiles;
        $Data["Type"]=$Type;
        $this->load->view("DetailsFichier",$Data);



    }
    function RenameFile($Folder,$File)
    {
        $Found=true;
        $i=1;
        $NewFile=$File;
        while ($Found)
        {
            $pos=strpos($File,".pdf");
            $NewFile = substr_replace($File, "_".$i, $pos, 0);
            $Found=file_exists($Folder.$NewFile);
            $i++;

        }
        if (!copy($Folder.$File, $Folder.$NewFile)) {
            return false ;
        }
        else return $NewFile;

    }
        
}
