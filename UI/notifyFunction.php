<?php
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
$id = $_POST['id'];	
$myArray = array();
$handler = new DocumentHandler();
$con = new Connect();
$result = $handler->getNotification($id);
$outp = array();
if($result){
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	foreach ($outp as $row) {
		$handler->updateNotification($row['idlocation']);
	}
	echo json_encode($outp);
}
else{
	echo 0;
}
?>