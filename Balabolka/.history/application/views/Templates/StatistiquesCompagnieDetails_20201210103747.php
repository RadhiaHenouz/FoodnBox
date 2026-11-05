<?php 
function BasicTable($fpdf,$header, $data)
{
    $fpdf->SetFont('Arial','B',6);
    // Header
    $i=0;
    $fpdf->setFillColor(230,230,230); 
    foreach($header as $col)
    {
    if($i==0)
        $fpdf->Cell(40,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else if($i==1||$i==2)
        $fpdf->Cell(15,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else if($i==3)
        $fpdf->Cell(27,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else if($i==4)
        $fpdf->Cell(17,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else if($i==5)
        $fpdf->Cell(30,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else if($i==6)
        $fpdf->Cell(10,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else if($i==7||$i==8||$i==9)
        $fpdf->Cell(22,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else if($i==10)
        $fpdf->Cell(20,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
    else    
    $fpdf->Cell(18,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
$i++;
    }
    $fpdf->setFillColor(255,255,255); 
    $fpdf->Ln();
    $fpdf->SetFont('Arial','',6);
    // Data
    if($data)
    foreach($data as $row)
    {
        $i=0;
        foreach($row as $col)
        {
            if($i==0)
            $fpdf->Cell(40,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
        else if($i==1||$i==2)
            $fpdf->Cell(15,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
        else if($i==3)
            $fpdf->Cell(27,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
        else if($i==4)
            $fpdf->Cell(17,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
        else if($i==5)
            $fpdf->Cell(30,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
        else if($i==6)
            $fpdf->Cell(10,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);
        else if($i==7||$i==8||$i==9)
        {
            $val=number_format($col,2,',',' ')." €";
       
            $fpdf->Cell(22,7,iconv('UTF-8', 'windows-1252',$val),1,0,'C',1);
        }
            
         else if($i==10)
        {
            $val=number_format($col,2,',',' ')." €";
            $fpdf->Cell(20,7,iconv('UTF-8', 'windows-1252',$val),1,0,'C',1);

        }
            
 else    $fpdf->Cell(18,7,iconv('UTF-8', 'windows-1252',$col),1,0,'C',1);


            $i++;
        }
        $fpdf->Ln();
    }
    $fpdf->SetFont('Arial','',12);
}
$this->load->library('Fpdf'); 
$pdf = new FPDF();
// Column headings
$header = array( "Nom assuré",	"N° assuré",	"N° Police",	"Contrat",	"Valeur assuré",	"Nom bateau",	"Année",	"Mt Primes Emises",	"Mt Primes Réglées","Mt Prévision Sinistre",	"Mt Sinistre Réglé",	"Nb Sinistres",	"Rapport S/P");

    // Data loading

$pdf->SetMargins(10,10,10);
$pdf->SetFont('Arial','',12);
$pdf->AddPage("L");
$pdf->Image(base_url().'images/LogoANP.png',0,0,60,50,'PNG');
$mid_x=143.5;
$txt="Statistiques Détaillées Compagnie $Nom au ".date("d/m/Y");
$pdf->Text($mid_x-$pdf->GetStringWidth($txt)/2,60,iconv('UTF-8', 'windows-1252',$txt));

$pdf->SetXY(10,70);
BasicTable($pdf,$header,$data);

$pdf->Output('F',EXTRA_PATH.$NomFichier);
?>