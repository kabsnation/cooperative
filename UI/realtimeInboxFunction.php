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
	            if($row['idreply']!=null)
	            	$myArray[3][] = "idReply=".$row['idreply'];
	            else if($row['idTracking']!=null)
	            	$myArray[3][] = "idTracking=".$row['idTracking'];
	            else if($row['idEvents']!=null)
	            	$myArray[3][]="idEvents=".$row['idEvents'];
	            else
	            	$myArray[3][]="idservice_request=".$row['idservice_request'];
	            $myArray[4][] = $row['idlocation'];
	            $myArray[5][] = $row['isopen'];
	            $myArray[6][]= $row['canbedeleted'];
	    }
	    $_SESSION['defaultInbox'] = 0;
	    echo json_encode($myArray);
?>