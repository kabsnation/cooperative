<?php
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
$id = $_POST['id'];	
	$myArray = array();
	$handler = new DocumentHandler();
	$con = new Connect();
	$trackings = $handler->inboxCoopById($id);

	    while($row = $trackings->fetch_array()) {
	            $myArray[0][] = $row['title'];
	            $myArray[1][] = $row['name'];
	            $myArray[2][] = $row ['DateTime'];
	            $myArray[3][]="idlocation=".$row['idlocation'];
	            $myArray[4][] = $row['idlocation'];
	            $myArray[5][] = $row['isopen'];
	            $myArray[6][]= $row['canbedeleted'];
	    }
	    $_SESSION['defaultInbox'] = 0;
	    echo json_encode($myArray);
?>