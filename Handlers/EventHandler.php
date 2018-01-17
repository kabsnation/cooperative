<?php
class EventHandler{
	public function addEvent($eventName,$eventLocation,$eventDetails,$startDateTime,$endDateTime,$fileUpload,$idAccounts){
		$con = new Connect();
		$query = "INSERT INTO Events (eventName,eventLocation,eventDetails,startDateTime,endDateTime,fileUpload,idAccounts,status) VALUES ('" .$eventName."','".$eventLocation."','".$eventDetails."','".$startDateTime."','".$endDateTime."','".$fileUpload."','".$idAccounts."','ON GOING')";
		$lastId = $con->insertReturnLastId($query);
		return $lastId;
	}

	public function checkEventName($eventName){
		$con = new Connect();
		$query = "SELECT * FROM Events where eventName = '" .$eventName."'";
		$result = $con->select($query);

		return $result;
	}

	public function addRecipient($idEvents,$idAccounts){
		$con = new Connect();
		$query = "INSERT INTO Recipients(idEvents,idAccounts,status) VALUES('".$idEvents."','".$idAccounts."','WAITING FOR CONFIRMATION')";
		$result = $con->insert($query);
		return $result;
	}

	public function getEvents(){
		$query = "SELECT * FROM Events";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}
}
?>