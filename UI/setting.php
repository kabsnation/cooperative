<?php
require("../Handlers/AccountHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
$handler = new AccountHandler();
$auditTrail = new AuditTrail();
$connect = new Connect();
if(isset($_POST['update'])){
	$time = $_POST['update'];
	$time = ($time*60);
	echo $time = $time.'000';
	$result = $handler->updateTime($time);
}
else{
	$result = $handler->getTime();
	if($row = $result->fetch_array()){
		if(isset($row[0])){
			echo $row[0];
		}
	}
}
?>