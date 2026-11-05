<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Database extends CI_Model
{
    public function UpdateToken($IdAssure,$Token)
    {
        $this->db= $this->load->database('default', TRUE);
        $result = $this->db->query("Exec WTAB_ASSURE_Update_JetonResetMdp '".$IdAssure."','".$Token."'"); 
       
        return $result;
       
    }
    public function UpdateAttestation($IdAssure,$MvtId,$FileName,$Genere)
    {
        $this->db= $this->load->database('default', TRUE);
        $this->db->trans_start();
        if($Genere)
{
            
            $sp="DECLARE @AttId numeric(9);\n
            DECLARE @Date as date\n
            SET @Date =CURRENT_TIMESTAMP\n
            EXEC   TAB_Assure_Attestation_Modify    1,@AttId OUTPUT,".$IdAssure.",".$MvtId.",1,@Date,'".$FileName."'\n
            select @AttId as out_param;";
}
else
{
	    $sp="DECLARE @AttId numeric(9);\n
            EXEC   TAB_Assure_Attestation_Modify    1,@AttId OUTPUT,".$IdAssure.",".$MvtId.",0,null,null\n
            select @AttId as out_param;";

}

            $result = $this->db->query($sp); 
            $this->db->trans_complete();
      
            
            if ($result !== NULL)
               return $result;
               
           
         return true;
       
    }
       public function UpdateActivite($IdAssure,$MvtId,$FileName,$Genere,$Type)
    {
        $this->db= $this->load->database('default', TRUE);
        $this->db->trans_start();
        if($Type=="Relance")
            $Proc="TAB_Assure_Relance_Modify" ;
                
        else
            $Proc="TAB_Assure_Terme_Modify";
        if($Genere)
        {
            
            $sp="DECLARE @RelId numeric(9);\n
            DECLARE @Date as date\n
            SET @Date =CURRENT_TIMESTAMP\n
            EXEC   $Proc    1,@RelId  OUTPUT,".$IdAssure.",".$MvtId.",1,@Date,'".$FileName."'\n
            select @RelId as out_param;";
        }
        else
        {
	    $sp="DECLARE @RelId numeric(9);\n
            EXEC  $Proc    1,@RelId  OUTPUT,".$IdAssure.",".$MvtId.",0,null,null\n
            select @RelId as out_param;";

        }

            $result = $this->db->query($sp); 
            $this->db->trans_complete();
      
            
            if ($result !== NULL)
               return $result;
               
           
         return true;
       
    }
 
    public function RegenererAttestation($IdAssure,$MvtId,$FileName,$Genere)
    {
             if($Genere)
{
            
            $sp="DECLARE @AttId numeric(9);\n
            DECLARE @Date as date\n
            SET @Date =CURRENT_TIMESTAMP\n
            EXEC   TAB_Assure_Attestation_Modify    0,@AttId OUTPUT,".$IdAssure.",".$MvtId.",1,@Date,'".$FileName."'\n
            select @AttId as out_param;";
}
else
{
	    $sp="DECLARE @AttId numeric(9);\n
            EXEC   TAB_Assure_Attestation_Modify    0,@AttId OUTPUT,".$IdAssure.",".$MvtId.",0,null,null\n
            select @AttId as out_param;";

}

            $result = $this->db->query($sp); 
            $this->db->trans_complete();
      
            echo json_encode($result);  
            if ($result !== NULL)
               return $result;
               
           
         return true;
         
    }
    
    public function Login($ApplicationCode,$Utilisateur)
    {   $this->db= $this->load->database('default', TRUE);
        $result = $this->db->query("Exec TAB_Utilisateur_Login @sApplicationCode='".$ApplicationCode."',@sUtiNom='".$Utilisateur."'"); 
        if($result->num_rows()!=1)
            return false;
        else
            return $result->row_array();
    }

    public function EmailsAGenerer()
    {try 
            
{
        $this->db= $this->load->database('default', TRUE);
        $sp = "TAB_Mouvement_Select_Attestation_A_Generer ";

        $var1=date("Y-m-d");
       
        $var2= date('Y-m-d', strtotime($var1. ' - ' .NBRE_JOURS.' days'));
        
        
        $result = $this->db->query("exec ".$sp." '".$var2."', '".$var1."'");
       return $result->result_array();
    }
    catch(Exeception $e)
    {print_r($e);
    }
    
    }
    public function NouveauxAssures()
    {
    try 
            
    {
        $this->db= $this->load->database('default', TRUE);
        $sp = " TAB_Assure_Select_NewContract";
        $var1=date("Y-m-d");
        $var2= date('Y-m-d', strtotime($var1. ' - ' .NBRE_JOURS.' days'));
        $result = $this->db->query("exec ".$sp);
        return $result->result_array();
       
    }
    catch(Exeception $e)
    {print_r($e);
    }
    }
    public function Relances()
    {
    try 
            
    {
        $this->db= $this->load->database('default', TRUE);
        $sp = "TAB_Mouvement_Select_Relance_A_Generer";

        $var1=date("Y-m-d");
       
        $var2= date('Y-m-d', strtotime($var1. ' - ' .NBRE_JOURS.' days'));
        
        
        $result = $this->db->query("exec ".$sp." '".$var2."', '".$var1."'");
        
        return $result->result_array();
       
    }
    catch(Exeception $e)
    {print_r($e);
    }
    }
    public function Quittances()
    {
    try 
            
    {
        $this->db= $this->load->database('default', TRUE);
        $sp = "TAB_Mouvement_Select_Terme_A_Generer";

        $var1=date("Y-m-d");
       
        $var2= date('Y-m-d', strtotime($var1. ' - ' .NBRE_JOURS.' days'));
        
        
        $result = $this->db->query("exec ".$sp." '".$var2."', '".$var1."'");
        //print_r($result->result_array());
        return $result->result_array();
       
    }
    catch(Exeception $e)
    {print_r($e);
    }
    }
    
    public function ListeAttestations($Assure,$AssureNo)
    {
    
        $this->db= $this->load->database('default', TRUE);
        $sp = "TAB_Assure_Select_Attestation";
        $var1=date("Y-m-d");
        $var2= date('Y-m-d', strtotime($var1. ' - 12 months'));
        if(!Empty($Assure))
        $result = $this->db->query("EXEC TAB_Assure_Select_Attestation @StartDate='".$var2."',@EndDate='".$var1."',@AssNom=".$Assure);
        return $result->result_array();
    }
    public function DocumentsGeneres($AssureId,$Type,$DateDebut,$DateFin)
    {
        $this->db= $this->load->database('default', TRUE);
        $sp = "TAB_Assure_Select_Documents";
        if(Empty($AssureId))return null;
        if($DateDebut&&$DateFin)
        {
            $DateDebut=date("d/m/Y",strtotime($DateDebut));
       
            $DateFin=date("d/m/Y",strtotime($DateFin));
       
            $result = $this->db->query("EXEC ".$sp." @DateDu='".$DateDebut."',@DateAu='".$DateFin."',@AssId=".$AssureId.",@Type='".$Type."'" );
        } 
        else 
             $result = $this->db->query("EXEC ".$sp." @AssId=".$AssureId.",@Type='".$Type."'" );
        return $result->result_array();
  
            
    
    }
    public function SituationComptable($AssureId,$Annee)
    {
        $this->db= $this->load->database('default', TRUE);
        $sp = "TAB_Assure_Select_Compta";
    
        if(!Empty($AssureId))
        {
            if($Annee)
            $result = $this->db->query("EXEC ".$sp." @Annee='".$Annee."' , @AssId=".$AssureId );
            else 
            $result = $this->db->query("EXEC ".$sp."  @AssId=".$AssureId );
           
            return $result->result_array();
        }
        else 
            return null;
    
    }
    public function StatistiquesAssure($NoAssure,$Date)
    {
        $this->db= $this->load->database('default', TRUE);
        $sp = "EXP_PortefeuilleGlobal_Assure";
        if(!Empty($NoAssure))
        {
            if($Date)
            {
            $Date=date("d/m/Y",strtotime($Date));
       
            $result = $this->db->query("EXEC ".$sp." @DateRef='".$Date."' , @AssNo=".$NoAssure );
            }
            else 
            $result = $this->db->query("EXEC ".$sp." @AssNo=".$NoAssure );
         
            return $result->result_array();
        }
        else 
            return null;
    
    }
    public function ListeCompagnies()
    {
        $this->db= $this->load->database('default', TRUE);
        $sp = "TAB_Entite_Select_CieMail";
        $result = $this->db->query("EXEC ".$sp );
        return $result->result_array();
        
    
    }   
    public function StatistiquesCompagnie($EntIdCie,$Date,$Type)
    {
        $this->db= $this->load->database('default', TRUE);
        if($Type=="D")
        $sp = "EXP_PortefeuilleDetaille_Cie";
        else if($Type=="G")
        $sp = "EXP_PortefeuilleGlobal_Cie";
        
        if(!Empty($EntIdCie))
        {
            if($Date)
            {
            $Date=date("d/m/Y",strtotime($Date));
       
            $result = $this->db->query("EXEC ".$sp." @DateRef='".$Date."' , @EntIdCie=".$EntIdCie );
            }
            else
            $result = $this->db->query("EXEC ".$sp."  @EntIdCie=".$EntIdCie );
           
            return $result->result_array();
        }
        else 
            return null;
    
    }

    



}

