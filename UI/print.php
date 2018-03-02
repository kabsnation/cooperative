<?php
session_start();
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
require_once('../UI/pdf.php');
$doc = new DocumentHandler();
$acc = new AccountHandler();
$audit = new AuditTrail();
$name ='';
if(isset($_SESSION['idSuperAdmin']))
	$id = $_SESSION['idSuperAdmin'];
else if(isset($_SESSION['idAccount']))
	$id = $_SESSION['idAccount'];
else
	echo 'error';
$result = $acc->getAccountById($id);
	foreach ($result as $res) {
		$name = $res['name'];
	}
$mindate = $_POST['mindate'];
$maxdate = $_POST['maxdate'];
$arrs = array();
$counter = 0;
$trackings = $doc->getTransactionLogsAdminByDate($mindate,$maxdate);
if($trackings){
	while($row = mysqli_fetch_array($trackings,MYSQLI_NUM)){
		for($i=0;$i<5;$i++){
			$arrs[$counter] =$row[$i];
			$counter++;				
		}
	}
}
$audit->trail('DOWNLOAD PDF;','SUCCESSFUL',$id);
$pdf = new pdfMaker();
$pdf->AddPage();
$pdf->FancyTable($arrs,$mindate,$maxdate,$name);
$pdf->Output();
?>