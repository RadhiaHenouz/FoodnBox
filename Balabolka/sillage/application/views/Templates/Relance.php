


<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;*/

$this->load->library('fpdf'); 
if (!defined('FPDF_FONTPATH')) 
define('FPDF_FONTPATH',APPPATH."libraries/Font");
require_once(APPPATH."libraries/FPDI/src/autoload.php");


$pdf = new \setasign\Fpdi\Fpdi();
$pageCount = $pdf->setSourceFile('pdfTemplates/Relance.pdf');
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // import a page
    $templateId = $pdf->importPage($pageNo);
    // get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);

    // create a page (landscape or portrait depending on the imported page size)
    
        $pdf->AddPage();
        $pdf->useTemplate($templateId);
   
    $pdf->SetFont('Helvetica','B',8);

  if($pageNo==1)
  {
    // use the imported page
 
    
    $pdf->SetFont('Helvetica','',10);
    $pdf->SetXY(110, 52);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure." ".$PrenomAssure));
    $pdf->SetXY(110, 57);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$AdrAssure));
    $pdf->SetXY(110, 62);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$AdrAssure2));
    $pdf->SetXY(110, 67);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$AdrAssure3));
    $pdf->SetXY(110, 72);
    $pdf->Write(8,  iconv('UTF-8', 'windows-1252',$CpAssure.' '.$VilleAssure));
    $pdf->SetXY(110, 77);
    $pdf->Write(8,  iconv('UTF-8', 'windows-1252',$NatAssure));
    $pdf->SetXY(110, 90); 
    $pdf->Write(8, "Marseille le, ".date("d-m-Y"));
    $pdf->SetFont('Helvetica','B',10);
    $pdf->SetXY(24, 97); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"Contrat: ".$IdContrat));
    $pdf->SetXY(24, 102); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"N° Assuré: ".$NoAssure));
    $pdf->SetXY(24, 107); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"N° contrat: ".$PolNoAssure));
    $pdf->SetXY(24, 112); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"Nom bateau: ".$BatNom));
    $pdf->SetFont('Helvetica','',10);
    $pdf->SetXY(148, 132);
    $MvtEchDu = date("d-m-Y", strtotime($MvtEchDu));
    $MvtEchAu = date("d-m-Y", strtotime($MvtEchAu));
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$MvtEchDu .' Au '.$MvtEchAu));
    
    //$pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
    $pdf->SetXY(59, 136);
    $pdf->Write(8,  iconv('UTF-8', 'windows-1252',$MvtMontant." ".$DevCode));
    $pdf->SetFont('Helvetica','',8);
    
     //$pdf->SetXY(4, 63);
    //$pdf->SetFont('Helvetica','B',8);
        $pdf->SetXY(14, 217);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"N° Assuré"));
    $pdf->SetXY(35, 217);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',": ".$NoAssure));
    $pdf->SetXY(14, 221); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"Nom assuré"));
    $pdf->SetXY(35, 221); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',": ".$NomAssure." ".$PrenomAssure));
    $pdf->SetXY(14, 225); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"N° contrat"));
    $pdf->SetXY(35, 225); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',": ".$PolNoAssure));
    $pdf->SetXY(14, 229); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"Période"));
    $pdf->SetXY(35, 229); 
    $pdf->Write(8, ": ".$MvtEchDu .' Au '.$MvtEchAu);
    $pdf->SetXY(14, 233); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',"Date émission"));
    $pdf->SetXY(35, 233); 
    $pdf->Write(8, ": ".date("d-m-Y"));
    $pdf->SetFont('Helvetica','B',8);
    $pdf->SetXY(45, 238);
    $pdf->Write(8,  iconv('UTF-8', 'windows-1252',"Montant : ".$MvtMontant." ".$DevCode));
    
  

      

}


}
// Output the new PDF
//$pdf->Output();
$pdf->Output('F',QUITTANCE_PATH.$NomFichier);



 