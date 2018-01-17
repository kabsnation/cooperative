<?php
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
$id = $_POST['id'];	
	$myArray = array();
	$handler = new DocumentHandler();
	$con = new Connect();
	$trackings = $handler->getTrackingById($id);

	    while($row = $trackings->fetch_array()) {
	            $myArray[0][] = $row['trackingNumber'];
	            $myArray[1][] = $row['DateTime'];
	            $myArray[2][] = $row ['Document'];
	    }
	    $_SESSION['default'] = 0;
	    echo json_encode($myArray);
?>