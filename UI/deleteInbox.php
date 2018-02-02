<?php
session_start();
$id = $_SESSION['idAccount'];
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
require("../Handlers/AuditTrail.php");
$conn = new Connect();
$con=$conn->connectDB();
$doc = new DocumentHandler();
$audit = new AuditTrail();
if(isset($_POST['check'])){
	$idlocation = $_POST['id'];
	$del = $_POST['del'];
	$result = $doc->deleteInbox($idlocation,$del);
	if($result){
		$audit->trail('DELETE INBOX; ID: '. $idlocation,'SUCCESSFUL',$id);
		echo $result;
	}
	else
		$audit->trail('DELETE INBOX; ID: '. $idlocation,'FAILED',$id);
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
			if($result){
				$audit->trail('DELETE INBOX; ID: '. $data,'SUCCESSFUL',$id);
				echo $result;
			}
			else
				$audit->trail('DELETE INBOX; ID: '. $data,'FAILED',$id);

		}
		echo '0';
	}
}
	
?>