<?php
require('../Handlers/DocumentHandler.php');
require('../config/config.php');
session_start();
$id = $_POST['id'];
$handler = new DocumentHandler();
$count = $handler->getTrackingCountById($id);
 if($row = $count->fetch_array()){
 	if($row[0] != $tableCount)
		$_SESSION['defaultCounter'] = 1;
 	else
 		$_SESSION['defaultCounter'] = 0;
 }
 echo $_SESSION['defaultCounter'];
?>