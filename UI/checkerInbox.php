<?php
require('../Handlers/DocumentHandler.php');
require('../config/config.php');
session_start();
$tableCount = $_POST['count'];
$id = $_POST['id'];
$handler = new DocumentHandler();
$count = $handler->getInboxCountById($id);
 if($row = $count->fetch_array()){
 	if($row[0] != $tableCount)
		$_SESSION['defaultInbox'] = 1;
 	else
 		$_SESSION['defaultInbox'] = 0;
 }
 echo $_SESSION['defaultInbox'];
?>