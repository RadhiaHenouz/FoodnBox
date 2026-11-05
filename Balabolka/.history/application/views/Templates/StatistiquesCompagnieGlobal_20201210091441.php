<?php 
function BasicTable($fpdf,$header, $data)
{
    $fpdf->SetFont('Arial','',8);
    // Header
    $i=0;
    $fpdf->setFillColor(230,230,230); 
    foreach($header as $col)
    {
    if($i==0)
        $fpdf->Cell(45,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
    else if($i==1)
        $fpdf->Cell(20,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
      else
        $fpdf->Cell(40,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
    $i++;
    }
    $fpdf->setFillColor(255,255,255); 
    $fpdf->Ln();
    // Data
    if($data)
    foreach($data as $row)
    {
        $i=0;
        foreach($row as $col)
        {
        if($i==0)
            $fpdf->Cell(45,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
        else if($i==1)
            $fpdf->Cell(20,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
        else
            $fpdf->Cell(40,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
    
            $i++;
        }
        $fpdf->Ln();
    }
    $fpdf->SetFont('Arial','',12);
}
$this->load->library('Fpdf'); 
$pdf = new FPDF();
// Column headings
$header = array( "Contrat","Année",	"Mt Primes Emises",	"Mt Primes Réglées","Mt Prévision Sinistre",	"Mt Sinistre Réglé",	"Nb Sinistres",	"Rapport S/P");

    // Data loading

$pdf->SetMargins(10,10,10);
$pdf->SetFont('Arial','',12);
$pdf->AddPage("L");
$pdf->Image(base_url().'images/LogoANP.png',0,0,60,50,'PNG');
$mid_x=143.5;
$txt="Statistiques Globale Compagnie $Nom au ".date("d/m/Y");
$pdf->Text($mid_x-$pdf->GetStringWidth($txt)/2,60,iconv('UTF-8', 'windows-1252',$txt));

$pdf->SetXY(10,70);
BasicTable($pdf,$header,$data);

//$pdf->Output('F',EXTRA_PATH.$NomFichier);
$pdf->Output();
?>