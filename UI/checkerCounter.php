<?php
require('../Handlers/DocumentHandler.php');
require('../config/config.php');
session_start();
$id = $_POST['id'];
$counter = $_SESSION['counter'];
$handler = new DocumentHandler();
$count = $handler->getNewMessageCount($id);
 if($row = $count->fetch_array()){
 	if($row[0] != $counter){
		$_SESSION['defaultCounter'] = 1;
		$_SESSION['counter'] = $row[0];
 	}
 	else{
 		$_SESSION['defaultCounter'] = 0;

 	}
 }
 echo $_SESSION['defaultCounter'];
?>