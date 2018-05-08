<?php
session_start();
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../Handlers/EventHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
require_once('../UI/pdf.php');
$doc = new DocumentHandler();
$acc = new AccountHandler();
$audit = new AuditTrail();
$event = new EventHandler();
$name ='';
$type = 1;
$column = 5;
if(isset($_SESSION['idSuperAdmin'])){
	$id = $_SESSION['idSuperAdmin'];
}
else if(isset($_SESSION['idAccount'])){
	$id = $_SESSION['idAccount'];
}
else if(isset($_SESSION['idEvent'])){
	$id = $_SESSION['idEvent'];
	$type = 0;
	$column = 3;
}
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
if($type == 1){
	$transac = $doc->getTransactionLogsAdminByDate($mindate,$maxdate);
}else{
	$transac = $event->getEventTransacLogsByDate($mindate,$maxdate);
}
if($transac){
	while($row = mysqli_fetch_array($transac,MYSQLI_NUM)){
		for($i=0;$i<$column;$i++){
			$arrs[$counter] =$row[$i];
			$counter++;				
		}
	}
}
$audit->trail('DOWNLOAD PDF;','SUCCESSFUL',$id);
$pdf = new pdfMaker();
$pdf->AddPage();
$pdf->FancyTable($arrs,$mindate,$maxdate,$name,$type);
$pdf->Output();
?>