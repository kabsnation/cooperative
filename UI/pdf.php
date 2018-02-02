<?php
require("../fpdf181/fpdf.php");
require_once('../config/config.php');
class pdfMaker extends FPDF{

function FancyTable($data)
{
    // Colors, line width and bold font
    $this->SetFillColor(1,10,100);
    $this->SetDrawColor(2,15,141);
    $this->SetLineWidth(.3);
    $this->SetFont('arial','','10');
    // Header
    //add header
    // date to and from
    $this->Image("../UI/Letterhead.jpg", 15,5,180); 
    $this->SetFont('arial','B',10);
	$this->SetY(9.5);
	$this->Cell(0,80, 'Transaction Logs FROM 01/01/2018 TO 01/01/2018',0,0,'C');
	$header = array('Tracking No.', 'Title', 'Type', 'Date Added','Date Completed');
    $wt = array(190);
    $counter = 1;
    $this->SetY(65);
    $this->SetTextColor(255);
    $w = array(30, 40, 35, 42.5,42.5);
    $this->SetFont('arial','','8');
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    $counter = 1;
    if($data){
    	foreach($data as $row)
	    {
	        $this->Cell($w[$counter-1],6,$row,'LR',0,'L',$fill);
	        if($counter ==5){
		        $this->Ln();
		        $fill = !$fill;
		        $counter =0;
	        }
	        $counter++;
	    }
    }
    
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

}
?>