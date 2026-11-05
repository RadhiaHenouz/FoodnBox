<?php 
function BasicTable($fpdf,$header, $data)
{
    $fpdf->SetFont('Arial','',9);
    // Header
    $i=0;
    $fpdf->setFillColor(230,230,230); 
    foreach($header as $col)
    {
    if($i==0)
        $fpdf->Cell(80,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
    else
        $fpdf->Cell(27,7,iconv('UTF-8', 'windows-1252',$col),1,0,'L',1);
    $i++;
    }
    $fpdf->setFillColor(255,255,255); 
    $fpdf->Ln();
    // Data
    foreach($data as $row)
    {
        $i=0;
        foreach($row as $col)
        {
            if($i==0)
                $fpdf->Cell(80,7,iconv('UTF-8', 'windows-1252',$col),1);
            else
                $fpdf->Cell(27,7,iconv('UTF-8', 'windows-1252',$col),1);
            $i++;
        }
        $fpdf->Ln();
    }
    $fpdf->SetFont('Arial','',12);
}
$this->load->library('Fpdf'); 
$pdf = new FPDF();
// Column headings
$header = array(  "Quittance","Echéance Du","Echéance Au","N° de police ","Bateau(x) ","Montant Du ","Montant Réglé ","Solde ");

    // Data loading
$Data=array();
$SubData=array();
foreach($results as $result)
{
   $Libele="";
   $MVT_Echdu= date("d/m/Y", strtotime($result['MVT_Echdu']));  
   $MVT_EchAu= date("d/m/Y", strtotime($result['MVT_EchAu']));  
   
    switch ($result['MVT_TypeQuittance']) {
        case 'R':
            $Libele="Remboursement du ".$MVT_Echdu." au ". $MVT_EchAu;
            break;
        case 'T':
            $Libele="Quittance Terme du ".$MVT_Echdu." au ". $MVT_EchAu;
            break;
        case 'C':
            $Libele="Quittance Comptant du ".$MVT_Echdu." au ". $MVT_EchAu;
            break;
        case 'S':
            $Libele="Suppression Quittance du ".$MVT_Echdu." au ". $MVT_EchAu;
            break;  
        case 'C':
            $Libele="Retour Quittance Comptant du ".$MVT_Echdu." au ". $MVT_EchAu ;
            break;
    }
    array_push($SubData,$Libele);
    array_push($SubData,$MVT_Echdu);
    array_push($SubData,$MVT_EchAu);
    array_push($SubData,$result['POL_No']);
    array_push($SubData,$result['AVB_Nom']);
    array_push($SubData,number_format($result['MVT_Du'],2,',',' ')." €");
    array_push($SubData,number_format($result['MVT_Regle'],2,',',' ')." €");
    array_push($SubData,number_format($result['Solde'],2,',',' ')." €");
    array_push($Data,$SubData);
    $SubData=array();

}
$pdf->SetMargins(10,10,10);
$pdf->SetFont('Arial','',12);
$pdf->AddPage("L");
$pdf->Image(base_url().'images/LogoANP.png',0,0,60,50,'PNG');
$mid_x=143.5;
$txt="Situation Comptable $Nom au ".date("d/m/Y");
$pdf->Text($mid_x-$pdf->GetStringWidth($txt)/2,60,$txt);

$pdf->SetXY(10,70);
BasicTable($pdf,$header,$Data);
$pdf->Text(240,60,"Solde: ".iconv('UTF-8', 'windows-1252',$Solde));
$pdf->Output('F',EXTRA_PATH.$NomFichier);
?>