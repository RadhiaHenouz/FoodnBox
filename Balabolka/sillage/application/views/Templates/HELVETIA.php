
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
    $pageCount = $pdf->setSourceFile('pdfTemplates/HELVETIA.pdf');
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
   $pdf->SetXY(88, 38.4); 
   $pdf->Write(8, $PolNoAssure);
   $pdf->SetXY(78, 44.7); 
   $MvtEchDu = date("d-m-Y", strtotime($MvtEchDu));
   $MvtEchAu = date("d-m-Y", strtotime($MvtEchAu));
   $pdf->Write(8,$MvtEchDu .'  to  '.$MvtEchAu );
   $pdf->SetXY(4 , 55); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
   $pdf->SetXY(4, 58); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$AdrAssure));
   $pdf->SetXY(4, 61); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$CpAssure.' '.$VilleAssure));
   $pdf->SetXY(4, 64); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$VilleAssure));
   $pdf->SetFont('Helvetica','',8);
   $pdf->SetXY(4, 76); 
   
   $pdf->WriteHTML( iconv('UTF-8', 'windows-1252',"Name : <b>".$BatNom."</b>  - Builder : <b>".$BatConstructeur."</b>- Model : <b>".$BatModele."</b>"));
   
   $pdf->SetFont('Helvetica','B',8);
  
//   $pdf->Write(8, 'A complete document imported with FPDI');










    
}
elseif ($pageNo==2)
{
   
   $pdf->SetXY(141, 106.7); 
   $pdf->Write(8, date("d-m-Y"));









}

}
// Output the new PDF
//$pdf->Output();
$pdf->Output('F',ATTEST_PATH.$NomFichier);




