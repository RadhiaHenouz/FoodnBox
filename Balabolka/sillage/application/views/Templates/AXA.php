
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
$pageCount = $pdf->setSourceFile('pdfTemplates/AXA.pdf');
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
 
    $pdf->SetXY(88, 35);
    $pdf->Write(8, $PolNoAssure);
    $pdf->SetXY(78, 38.5);
    $MvtEchDu = date("d-m-Y", strtotime($MvtEchDu));
    $MvtEchAu = date("d-m-Y", strtotime($MvtEchAu));
    $pdf->Write(8, $MvtEchDu .' to '.$MvtEchAu);
    $pdf->SetXY(4, 45);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
    $pdf->SetXY(4, 48.5);
    $pdf->Write(8,  iconv('UTF-8', 'windows-1252',$AdrAssure));
    $pdf->SetXY(4, 51.5);
    $pdf->Write(8,  iconv('UTF-8', 'windows-1252',$CpAssure.' '.$VilleAssure));
      $pdf->SetXY(4, 63);
    $pdf->SetFont('Helvetica','',8);
    $pdf->WriteHTML(  iconv('UTF-8', 'windows-1252',"Name :<b> ".$BatNom."</b>  - Builder : <b>".$BatConstructeur." </b> - Model : <b>".$BatModele."</b>"));
     $pdf->SetFont('Helvetica','B',8);
      $pdf->SetXY(36, 147.5);
     $pdf->Write(8, iconv('UTF-8', 'windows-1252',$NomAssure.' '.$PrenomAssure));
      //$pdf->SetXY(36, 150.5); 
    //$pdf->Write(8, $PolNoAssure);
     $pdf->SetXY(4, 152.5); 
     $pdf->SetFont('Helvetica','',8);
     $pdf->SetLeftMargin(4);

     $pdf->MultiCell(200, 3,  $pdf->WriteHTML(iconv('UTF-8', 'windows-1252',"E’ in corso con polizza n° <b>".$PolNoAssure."</b> valida ed efficace assicurazione di Responsabilità Civile per i danni cagionati a terzi nella circolazione nelle acque territoriali soggette alla sovranità della Repubblica Italiana del natante contraddistinto come segue: ")));
     
    //$pdf->WriteHTML(iconv('UTF-8', 'windows-1252',"E’ in corso con polizza n° <b>".$PolNoAssure."</b> valida ed efficace assicurazione di Responsabilità Civile per i danni cagionati a terzi nella circolazione nelle acque territoriali soggette alla sovranità della Repubblica Italiana del natante contraddistinto come segue: "));
      $pdf->SetXY(37, 160.6);
      $pdf->SetFont('Helvetica','B',8);
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$MotPuissance));
    $pdf->SetXY(46, 164); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$MotAnnee));
    $pdf->SetXY(29, 166.7); 
    $pdf->Write(8, iconv('UTF-8', 'windows-1252',$BatNom));
    $pdf->SetXY(41, 170); 
   $pdf->Write(8, iconv('UTF-8', 'windows-1252',$MotMarque));
   
}
elseif ($pageNo==2)
{
   $pdf->SetXY(110, 204.5); 
   $pdf->Write(8, "Dated in MARSEILLE, ".date("d-m-Y"));
}

}
// Output the new PDF
//$pdf->Output();
$pdf->Output('F',ATTEST_PATH.$NomFichier);



 