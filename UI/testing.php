<?php
require_once('../UI/pdf.php');
$pdf = new pdfMaker();
$arrs = array();
$arrs[0] ='wqeqwe';
$arrs[1] ='qweqwe';
$arrs[2] ='qweqwe';
$arrs[3] ='qweasd';
$arrs[5] ='qwewq';
$pdf->AddPage();
$pdf->FancyTable($arrs);
$pdf->Output();
?>