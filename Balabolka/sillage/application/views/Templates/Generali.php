
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
    $pageCount = $pdf->setSourceFile('pdfTemplates/Generali.pdf');
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
   $pdf->SetXY(87, 40); 
   $pdf->Write(8, $PolNoAssure);
   $pdf->SetXY(78, 46.2); 
   $MvtEchDu = date("d-m-Y", strtotime($MvtEchDu));
   $MvtEchAu = date("d-m-Y", strtotime($MvtEchAu));
   $pdf->Write(8,$MvtEchDu .' to '.$MvtEchAu );
   $pdf->SetXY(4 , 56.5); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
   $pdf->SetXY(4, 60.5); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$AdrAssure));
   $pdf->SetXY(4, 64.5); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$CpAssure.' '.$VilleAssure));
   $pdf->SetXY(4, 67); 
   $pdf->Write(8, '');
   $pdf->SetXY(4, 77); 
   $pdf->SetFont('Helvetica','',8);
   $pdf->WriteHTML( iconv('UTF-8', 'windows-1252',"Name : <b>".$BatNom."</b>  - Builder : <b>".$BatConstructeur."</b> - Model : <b>".$BatModele."</b>"));
   $pdf->SetFont('Helvetica','B',8);
   $pdf->SetXY(128, 103.4); 
   $pdf->Write(8, $PolNoAssure);

   $pdf->SetXY(4, 163.6);
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
   $pdf->SetXY(4, 172); 
   $pdf->SetFont('Helvetica','',9);
   $pdf->WriteHTML( iconv('UTF-8', 'windows-1252',"è in corso, con polizza n° <b>".$PolNoAssure."</b>  (Sede di Generali France) valida ed efficace assicurazione di Responsabilità Civile per i"));
   $pdf->SetXY(28, 181.6); 
   $pdf->SetFont('Helvetica','B',8);
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$BatNom." - ".$BatConstructeur));
   $pdf->SetXY(18, 194); 
//   $pdf->Write(8, 'A complete document imported with FPDI');
    
}
elseif ($pageNo==2)
{
   $pdf->SetFont('Helvetica','',9);
   $pdf->SetXY(128.5, 52.5); 
   $pdf->WriteHTML("<b>". $PolNoAssure ."</b> which includes Third Party Liabilities." );
   $pdf->SetFont('Helvetica','B',8);
   $pdf->SetXY(34, 58); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$BatNom));
   $pdf->SetXY(18, 61.5); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$BatConstructeur));
   $pdf->SetXY(15, 65.5); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$BatModele));
   $pdf->SetXY(4, 106); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
   $pdf->SetXY(50, 113.5); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$BatNom));
   $pdf->SetXY(20, 117); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$BatConstructeur));
   $pdf->SetXY(17, 120.5); 
   $pdf->Write(8,iconv('UTF-8', 'windows-1252',$BatModele));
   $pdf->SetXY(74.5, 125.7); 
   $pdf->SetFont('Helvetica','',9);
   $pdf->WriteHTML("<b>". $PolNoAssure."</b> para los riesgos siguientes :");
   $pdf->SetFont('Helvetica','B',8);
   $pdf->SetXY(141, 206); 
   $pdf->Write(8, date("d-m-Y"));









}

}
// Output the new PDF
//$pdf->Output();
$pdf->Output('F',ATTEST_PATH.$NomFichier);



