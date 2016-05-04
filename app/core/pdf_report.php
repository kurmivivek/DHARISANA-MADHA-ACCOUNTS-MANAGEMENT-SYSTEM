<?php
define('FPDF_FONTPATH', 'font/');
require('fpdf.php');

//Connect to your database
class PDF extends FPDF
{
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
}
//Create new pdf file
$pdf=new PDF();

if(isset($_POST['month']))
{
	if($_POST['month']<9)
	$_POST['month']=sprintf("%02d", $_POST['month']);
	$noOfDays=date("t",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
	$monthName=date("F",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
	$month=date("m",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
	$year=date("Y",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
	$category=$_POST['category'];
}
else
{
	$noOfDays=date("t");
	$monthName=date("F");
	$month=date("m");
	$year=date("Y");
	$category="church";
}

//Database part
$db = new SQLite3('../db/core.db') or die('Unable to open database');
$result = $db->query("SELECT *,strftime('%d-%m-%Y',date) as date FROM record WHERE category='".$category."' and strftime('%Y-%m',date)='".$year."-".$month."' ORDER BY id") or die("Query failed");
//Open file
$pdf->setTitle($monthName."'s ".ucwords($category)." Report");
$pdf->Open();
$pdf->AliasNbPages();
//Disable automatic page break
$pdf->SetAutoPageBreak(true,12);

//Add first page
$pdf->AddPage();

//print column titles for the actual page
$pdf->SetFillColor(232, 232, 232);

//set initial y axis position per page
$y_axis_initial = 10;

//print column titles for the actual page
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,5,'DHARISANA MADHA WELFARE ASSOCIATION',0,0,'C');
$pdf->ln();
$pdf->SetFont('Arial','BI',12);
$pdf->Cell(0,10,$monthName."'s ".ucwords($category)." Report",0,0,'C');
$pdf->Cell(0,10,'Date:'.date("d-m-Y"),0,0,'R');
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(30);
$pdf->SetX(2);
$pdf->Cell(25, 6, 'Date', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'NAME', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Receipt #', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Income', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Expenditure', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Bill No', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Page No of ledger', 1, 0, 'C', 1);
$row_height = 6;
$y_axis = 30;
$y_axis = $y_axis + $row_height;

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 41;

//Set Row Height

$CurrentMonth=-1;
$CurrentYear=-1;
$breakRow=1;
while($row = $result->fetchArray())
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        //print column titles for the current page
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(2);
        $pdf->Cell(25, 6, 'Date', 1, 0, 'C', 1);
		$pdf->Cell(40, 6, 'NAME', 1, 0, 'C', 1);
		$pdf->Cell(25, 6, 'Receipt #', 1, 0, 'C', 1);
		$pdf->Cell(25, 6, 'Income', 1, 0, 'C', 1);
		$pdf->Cell(25, 6, 'Expenditure', 1, 0, 'C', 1);
		$pdf->Cell(25, 6, 'Bill No', 1, 0, 'C', 1);
		$pdf->Cell(40, 6, 'Page No of ledger', 1, 0, 'C', 1);
        
        //Go to next row
        $y_axis = 10;
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
        if($max==41)
        {
			$max=44;
		}
    }
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetFont('Arial', '', 12);
    $pdf->SetY($y_axis);
    $pdf->SetX(2);
    if($row['type']=="income"){
    $pdf->Cell(25, 6, $row['date'], 1, 0, 'C', 1);
	$pdf->Cell(40, 6, $row['name'], 1, 0, 'C', 1);
	$pdf->Cell(25, 6, $row['receipt_no'], 1, 0, 'C', 1);
	$pdf->Cell(25, 6, $row['amount'], 1, 0, 'C', 1);
	$pdf->Cell(25, 6, '', 1, 0, 'C', 1);
	$pdf->Cell(25, 6, '', 1, 0, 'C', 1);
	$pdf->Cell(40, 6, $row['ledger_page_no'], 1, 0, 'C', 1);
	}
	else{
    $pdf->Cell(25, 6, $row['date'], 1, 0, 'C', 1);
	$pdf->Cell(40, 6, $row['name'], 1, 0, 'C', 1);
	$pdf->Cell(25, 6, $row['receipt_no'], 1, 0, 'C', 1);
	$pdf->Cell(25, 6, '', 1, 0, 'C', 1);
	$pdf->Cell(25, 6, $row['amount'], 1, 0, 'C', 1);
	$pdf->Cell(25, 6, $row['bill_no'], 1, 0, 'C', 1);
	$pdf->Cell(40, 6, $row['ledger_page_no'], 1, 0, 'C', 1);
	}

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}
$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='".$category."' and type='income' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($income=0);
$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='".$category."' and type='expenditure' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($expenditure=0);
$balance=$income-$expenditure;
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->ln();
$pdf->SetX(2);
$pdf->Cell(90, 6, 'Total : ', 1, 0, 'R', 1);
$pdf->Cell(25, 6, number_format((float)$income, 2, '.', ''), 1, 0, 'C', 1);
$pdf->Cell(25, 6, number_format((float)$expenditure, 2, '.', ''), 1, 0, 'C', 1);
$pdf->Cell(65, 6, 'Bank balance:'.number_format((float)$balance, 2, '.', ''), 1, 0, 'C', 1);
$pdf->Output();
?>
