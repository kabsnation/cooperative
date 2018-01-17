<?php
require('../Handlers/DocumentHandler.php');
require('../config/config.php');
session_start();
$tableCount = $_POST['count'];
$id = $_POST['id'];
$handler = new DocumentHandler();
$count = $handler->getTrackingCountById($id);
 if($row = $count->fetch_array()){
 	if($row[0] != $tableCount)
		$_SESSION['default'] = 1;
 	else
 		$_SESSION['default'] = 0;
 }
 echo $_SESSION['default'];
?>