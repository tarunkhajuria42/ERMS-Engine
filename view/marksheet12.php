<?php
require('fpdf.php');


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('testlogo.jpg',10,6,40);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(30);
    // Title
    $this->Cell(250,30,'BOARD OF TECHNICAL EDUCATION',0,0,'C');
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
	$this->SetY(97);
    // Column widths
    $w = array(15, 70, 15, 15, 20, 15, 15, 20, 15, 15, 20, 15, 15, 20);
    // Header
    
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LTR');
        $this->Cell($w[1],6,$row[1],'LTR');
        $this->Cell($w[2],6,$row[2],'LTR',0,'R');
        $this->Cell($w[3],6,$row[3],'LTR',0,'R');
        $this->Cell($w[4],6,$row[4],'LTR',0,'R');
        $this->Cell($w[5],6,$row[5],'LTR',0,'R');
        $this->Cell($w[6],6,$row[6],'LTR',0,'R');
        $this->Cell($w[7],6,$row[7],'LTR',0,'R');
        $this->Cell($w[8],6,$row[8],'LTR',0,'R');
        $this->Cell($w[9],6,$row[9],'LTR',0,'R');
        $this->Cell($w[10],6,$row[10],'LTR',0,'R');
        $this->Cell($w[11],6,$row[11],'LTR',0,'R');
        $this->Cell($w[12],6,$row[12],'LTR',0,'R');
        $this->Cell($w[13],6,$row[13],'LTR',0,'R');

        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T',1,'R');
}

}

if(!isset($_POST))
    echo('Error');

    
    
// Instanciation of inherited class
$pdf = new PDF('L');
$header = array('CODE','SUBJECT','MIDMAX','ENDMAX','TOTAL1','PRACMAX','TMAX','TOTAL2','MID','END','TOTAL3','PRAC','TEAM','TOTAL3');
$name = $_POST['name'];
$roll = $_POST['rollno'];
$institute = $_POST['institute'];
$Semester = $_POST['semester'];
$status = 'Regular';
$branch = $_POST['course'];
$gtot = $_POST['total'];
$pass = $_POST['pass'];
$mj_tot = '';
$divis = $_POST['division'];
$percent = $_POST['percent'];
$data=json_decode($_POST['list'],true);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Cell(300,10,'STATEMENT OF MARKS',0,1,'C');
$pdf->Cell(300,10,'EXAM HELD IN MAY 2017',0,1,'C');
$pdf->Cell(20,5,'',0,1);
$pdf->Cell(40,6,'Roll No',0,0,'L');
$pdf->Cell(150,6,$roll,0,0,'L');
$pdf->Cell(40,6,'Semester',0,0,'L');
$pdf->Cell(80,6,$Semester,0,1,'L');
$pdf->Cell(40,6,'Name',0,0,'L');
$pdf->Cell(150,6,$name,0,0,'L');
$pdf->Cell(40,6,'Status',0,0,'L');
$pdf->Cell(80,6,$status,0,1,'L');
$pdf->Cell(40,6,'Institute',0,0,'L');
$pdf->Cell(150,6,$institute,0,0,'L');
$pdf->Cell(40,6,'Branch',0,0,'L');
$pdf->Cell(80,6,$branch,0,1,'L');
$pdf->Cell(15,6,'','LTR');
$pdf->Cell(70,6,'','LTR');
$pdf->Cell(100,6,'MAXIMUM MARKS','LTR',0,'C');
$pdf->Cell(100,6,'OBTAINED MARKS','LTR',1,'C');
$pdf->Cell(15,6,'CODE','LR',0,'C');
$pdf->Cell(70,6,'SUBJECT','LR',0,'C');
$pdf->Cell(50,6,'PRACTICAL','LTR',0,'C');
$pdf->Cell(50,6,'THEORY','LTR',0,'C');
$pdf->Cell(50,6,'PRACTICAL','LTR',0,'C');
$pdf->Cell(50,6,'THEORY','LTR',1,'C');
$pdf->Cell(15,6,'','LR');
$pdf->Cell(70,6,'','LR');
$pdf->Cell(15,6,'PRAC','LTR',0,'C');
$pdf->Cell(15,6,'TERM','LTR',0,'C');
$pdf->Cell(20,6,'TOTAL','LTR',0,'C');
$pdf->Cell(15,6,'MID','LTR',0,'C');
$pdf->Cell(15,6,'END','LTR',0,'C');
$pdf->Cell(20,6,'TOTAL','LTR',0,'C');
$pdf->Cell(15,6,'PRAC','LTR',0,'C');
$pdf->Cell(15,6,'TERM','LTR',0,'C');
$pdf->Cell(20,6,'TOTAL','LTR',0,'C');
$pdf->Cell(15,6,'MID','LTR',0,'C');
$pdf->Cell(15,6,'END','LTR',0,'C');
$pdf->Cell(20,6,'TOTAL','LTR',1,'C');
$pdf->Cell(15,6,'','LBR');
$pdf->Cell(70,6,'','LBR');
$pdf->Cell(15,6,'','LBR',0,'C');
$pdf->Cell(15,6,'WORK','LBR',0,'C');
$pdf->Cell(20,6,'','LBR',0,'C');
$pdf->Cell(15,6,'SEM','LBR',0,'C');
$pdf->Cell(15,6,'SEM','LBR',0,'C');
$pdf->Cell(20,6,'','LBR',0,'C');
$pdf->Cell(15,6,'','LBR',0,'C');
$pdf->Cell(15,6,'WORK','LBR',0,'C');
$pdf->Cell(20,6,'','LBR',0,'C');
$pdf->Cell(15,6,'SEM','LBR',0,'C');
$pdf->Cell(15,6,'SEM','LBR',0,'C');
$pdf->Cell(20,6,'','LBR',1,'C');
$pdf->Table($header, $data);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(185,6,''. $mj_tot,'LBR',0,'L');
$pdf->Cell(100,6,'GRAND TOTAL:'. $gtot,'LBR',1,'R');
$pdf->Cell(185,7,'RESULT :'. $pass,'LT',0,'L');
$pdf->Cell(100,7,'Percent :'.$percent . '%','TR',1,'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(285,7,'PREPARED BY :','LR',1,'L');
$pdf->Cell(85,7,'ISSUE DATE: JUNE 2017','LB',0,'L');
$pdf->Cell(130,7,'SIGNATURE AND SEAL OF INSTITUTION','B',0,'L');
$pdf->Cell(70,7,'CONTROLLER OF EXAMS','BR',1,'L');
$pdf->Cell(20,7,'*This is a computer generated marksheet',0,1,'L');
$pdf->Output();

?>