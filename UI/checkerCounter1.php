<?php
require('../Handlers/DocumentHandler.php');
require('../config/config.php');
session_start();
$id = $_POST['id'];
$countt = 0;
$handler = new DocumentHandler();
$count = $handler->getMessageCount($id);
 if($row = $count->fetch_array()){
 	if($row[0] !=0)
 		$countt = $row[0];
 }
 echo $countt;
?>