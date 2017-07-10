<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('testlogo.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(30);
    // Title
    $this->Cell(150,30,'BOARD OF TECHNICAL EDUCATION',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
// Better table
function Table($header, $data)
{
	$this->SetY(140);
    // Column widths
    $w = array(25, 80, 35, 30);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],10,$row[0],'LR');
        $this->Cell($w[1],10,$row[1],'LR');
        //$this->Cell($w[2],10,$row[2],'LR',0,'R');
        //$this->Cell($w[3],10,$row[3],'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

}

if(isset($_POST))
{
}
else 
    echo('Error');
    
// Instanciation of inherited class
$address_photo='http://localhost/ERMS-Engine/erms/applicant_pics/';
$address_signature='http://localhost/ERMS-Engine/erms/applicant_sigs/';
$pdf = new PDF();
$header = array('CODE','SUBJECT');
$data = json_decode($_POST['list'],true);
$signature=$address_signature.$_POST['signature'];
$photo=$address_photo.$_POST['photo'];
$name = $_POST['name'];
$roll = $_POST['rollno'];
$institute = $_POST['institute'];
$Semester = $_POST['semester'];
$status = 'Regular';
$branch = $_POST['course'];
$examcenter = $_POST['exam_centre'];



$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(200,10,'ADMIT CARD',0,1,'C');
$pdf->Cell(200,10,'For Session - Monsoon 17',0,1,'C');
$pdf->Cell(10,10,'',0,1);
$pdf->Cell(40,6,'Roll No','LTR',0,'C');
$pdf->Cell(80,6,$roll,'LTR',1,'L');
$pdf->Cell(40,6,'Name','LR',0,'C');
$pdf->Cell(80,6,$name,'LR',1,'L');
$pdf->Cell(40,6,'Institute','LR',0,'C');
$pdf->Cell(80,6,$institute,'LR',1,'L');
$pdf->Cell(40,6,'Semester','LR',0,'C');
$pdf->Cell(80,6,$Semester,'LR',1,'L');
$pdf->Cell(40,6,'Status','LR',0,'C');
$pdf->Cell(80,6,$status,'LR',1,'L');
$pdf->Cell(40,6,'Branch','LR',0,'C');
$pdf->Cell(80,6,$branch,'LR',1,'L');
$pdf->Cell(40,6,'Exam Center','LBR',0,'C');
$pdf->Cell(80,6,$examcenter,'LBR',1,'L');
$pdf->Image($photo,140,60,40,60);
$pdf->Cell(40,10,'',0,1);
$pdf->Cell(40,10,'',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(120,10,'Candidate Signtaure :',0,1,'R');
$pdf->Image($signature,140,120,40,20);
$pdf->Table($header, $data);
$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(10,10,'*BACKLOG PAPER',0,1);
$pdf->Cell(40,10,'',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(170,30,'SIGNATURE OF ISSUING AUTHORITY WITH SEAL :',0);
$pdf->Output();

?>