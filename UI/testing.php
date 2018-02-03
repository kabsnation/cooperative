<?php
require_once('../UI/pdf.php');
$pdf = new pdfMaker();
$arrs = array();
$pdf->AddPage();
$pdf->FancyTable($arrs);
$pdf->Output();
?>