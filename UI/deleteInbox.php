<?php
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
$conn = new Connect();
$con=$conn->connectDB();
$doc = new DocumentHandler();
	$idlocation = $_POST['id'];
	$result = $doc->deleteInbox($idlocation);
	if($result){
		echo $result;
	}
	else{
		echo 'error';
	}

// else{
// 	if(isset($_POST['checkboxx'])){
// 		// for($i=0;$i<sizeof($_POST['check']);$i++){
// 		// 	// $result = $doc->deleteInbox($_POST['check'][$i]);
// 		// 	echo $_POST['check'][$i];
// 		// }
// 		echo $_POST['checkboxx'][3];
		
// 	}
// }

?>