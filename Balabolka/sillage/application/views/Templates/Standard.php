<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->load->library('fpdf'); 
if (!defined('FPDF_FONTPATH')) 
define('FPDF_FONTPATH',APPPATH."libraries/Font");
require_once(APPPATH."libraries/FPDI/src/autoload.php");


$pdf = new \setasign\Fpdi\Fpdi();
$pageCount = $pdf->setSourceFile('pdfTemplates/Standard.pdf');
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // import a page
    $templateId = $pdf->importPage($pageNo);
    // get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);

    // create a page (landscape or portrait depending on the imported page size)
    
        $pdf->AddPage();
        $pdf->useTemplate($templateId);
   
    $pdf->SetFont('Helvetica','B',10);

    if($pageNo==1)
  {
    // use the imported page
 
    $pdf->SetXY(110, 47);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$TitAssure." ". $NomAssure." ".$PrenomAssure));
    $pdf->SetXY(110, 56);
    $MvtEchDu = date("d-m-Y", strtotime($MvtEchDu));
    $MvtEchAu = date("d-m-Y", strtotime($MvtEchAu));
    $pdf->Write(8, $AdrAssure);
    $pdf->SetXY(110, 65);
    $pdf->Write(8, $CpAssure.' '.$VilleAssure);
    $pdf->SetXY(110, 70);
    $pdf->Write(8, $NatAssure);
    $pdf->SetXY(110, 87);
    $pdf->Write(8,"Marseille, le ". date("d-m-Y"));
    $pdf->SetFont('Helvetica','',11);
    $pdf->SetXY(30, 136);
    $pdf->Write(8,"-  ".$BatNom);
    $pdf->SetXY(30, 140.5);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252', "-  est couvert par la police N° ".$PolNoAssure));
    $pdf->SetXY(30, 145);
    $pdf->Write(8,"-  ".$CieNomAssure);
    $pdf->SetXY(56, 163);
    $pdf->Write(8,$MvtEchDu ." au ".$MvtEchAu);
    $pdf->SetXY(109, 190);
    $pdf->Write(8,"Marseille, le ".date("d-m-Y"));
    
    
   
    
  }
}

$pdf->Output('F',ATTEST_PATH.$NomFichier);