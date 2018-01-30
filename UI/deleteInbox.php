<?php
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
$conn = new Connect();
$con=$conn->connectDB();
$doc = new DocumentHandler();
if(isset($_POST['check'])){
	$idlocation = $_POST['id'];
	$del = $_POST['del'];
	$result = $doc->deleteInbox($idlocation,$del);
	if($result){
		echo $result;
	}
}
else{
	$counter = 0;
	$dataa = json_decode($_POST['id']);
	$del = $_POST['del'];
	foreach($dataa as $data){
		$result = $doc->checkDelete($data);
		if($result =='0'){
			$counter = 1;
			break;
		}
	}
	if($counter ==1)
		echo '1';
	else{
		foreach($dataa as $data){
			$result = $doc->deleteInbox($data,$del);
		}
		echo '0';
	}
}
	
?>