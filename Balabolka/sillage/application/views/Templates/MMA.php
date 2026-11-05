
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
    $pageCount = $pdf->setSourceFile('pdfTemplates/MMA.pdf');
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
   $pdf->SetXY(87, 37.3); 
   $pdf->Write(8, $PolNoAssure);
   $pdf->SetXY(79, 43.9); 
   $MvtEchDu = date("d-m-Y", strtotime($MvtEchDu));
   $MvtEchAu = date("d-m-Y", strtotime($MvtEchAu));
   $pdf->Write(8,$MvtEchDu .' to '.$MvtEchAu );
   $pdf->SetXY(4 , 53); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
   $pdf->SetXY(4, 56.5); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$AdrAssure));
   $pdf->SetXY(4, 60); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$CpAssure.' '.$VilleAssure));
   
   $pdf->SetXY(4, 75); 
   $pdf->SetFont('Helvetica','',9);
   $pdf->WriteHTML( iconv('UTF-8', 'windows-1252',"Name : <b>".$BatNom."</b>  - Builder : <b>".$BatConstructeur."</b>  - Model : <b>".$BatModele."</b>"));
   $pdf->SetFont('Helvetica','B',8);
  
   $pdf->SetXY(125, 107); 
   $pdf->Write(8, $PolNoAssure);
   //$pdf->SetXY(60, 159.5); 
   //$pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
   //$pdf->SetXY(141, 159.5); 
   //$pdf->Write(8, $PolNoAssure);
      $pdf->SetFont('Helvetica','',9);
   $pdf->SetXY(4, 161.5); 
   $pdf->WriteHTML(iconv('UTF-8', 'windows-1252',"<b>MMA ASSURANCES</b> attesta che <b>". $NomAssure." ".$PrenomAssure."</b> é assicurato con contratto n° ".$PolNoAssure." per il periodo sopra"));
   $pdf->SetXY(4, 166 ); 
$pdf->SetLeftMargin(4);

     $pdf->MultiCell(200, 3,$pdf->WriteHTML( iconv('UTF-8', 'windows-1252',"-per la responsabilità civile chez egli incorre a ragione della sua imbarcazione <b>".$BatNom."</b> per un ammontare di 6 000 000 euro, di cui :") ));
   $pdf->SetFont('Helvetica','B',8);
//   $pdf->SetXY(18, 194); 
//   $pdf->Write(8, 'A complete document imported with FPDI');










    
}
elseif ($pageNo==2)
{
   $pdf->SetXY(107, 46); 
   $pdf->SetFont('Helvetica','',9);
   $pdf->WriteHTML("<b>".$PolNoAssure."</b> for the period above");
   $pdf->SetFont('Helvetica','B',8);
   $pdf->SetXY(4, 131);
   $pdf->WriteHTML(iconv('UTF-8', 'windows-1252',"MMA ASSURANCES RD certifica que <b>".$NomAssure." ".$PrenomAssure."</b> està asegurado por el contrato N° <b>".$PolNoAssure."</b> para el periodo por encima"));
   //$pdf->SetXY(74.5, 129.5); 
   //$pdf->Write(8, $NomAssure." ".$PrenomAssure);
   //$pdf->SetXY(164, 129.5); 
   //$pdf->Write(8, $PolNoAssure);
   $pdf->SetXY(112, 217); 
   $pdf->Write(8,"Dated in MARSEILLE, ".date("d-m-Y"));









}

}
// Output the new PDF

$pdf->Output('F',ATTEST_PATH.$NomFichier);