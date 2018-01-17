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
	            if($row['idTracking']==null)
	            	$myArray[3][] = "idReply=".$row['idreply'];
	            else
	            	$myArray[3][] = "idTracking=".$row['idTracking'];
	            $myArray[4][] = $row['idlocation'];
	            $myArray[5][] = $row['isopen'];
	    }
	    $_SESSION['defaultInbox'] = 0;
	    echo json_encode($myArray);
?>