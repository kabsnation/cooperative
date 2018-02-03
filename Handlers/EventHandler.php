<?php
class EventHandler{
	public function addEvent($eventName,$eventLocation,$eventDetails,$startDateTime,$endDateTime,$fileUpload,$idAccounts){
		$con = new Connect();
		$query = "INSERT INTO Events (eventName,eventLocation,eventDetails,startDateTime,endDateTime,fileUpload,idAccounts,status,datetime) VALUES ('" .$eventName."','".$eventLocation."','".$eventDetails."','".$startDateTime."','".$endDateTime."','".$fileUpload."','".$idAccounts."','ON GOING','".date("m/d/Y-h:i A")."')";
		$lastId = $con->insertReturnLastId($query);
		return $lastId;
	}

	public function checkEventName($eventName){
		$con = new Connect();
		$query = "SELECT * FROM Events where markasdeleted=0 and eventName = '" .$eventName."'";
		$result = $con->select($query);

		return $result;
	}

	public function addRecipient($idEvents,$idAccounts,$eventName,$eventLocation,$startDateTime,$endDateTime){
		$con = new Connect();
		$SMS = new SMSHandler();
		$query = "INSERT INTO location(idEvents,idAccounts,status) VALUES('".$idEvents."','".$idAccounts."','WAITING FOR CONFIRMATION')";
		$result = $con->insert($query);
		$number = $this->getMobileNo($idAccounts,$eventName,$eventLocation,$startDateTime,$endDateTime);
		$message = $SMS->sendSMS($number,$eventName,$eventLocation,$startDateTime,$endDateTime); 
		return $result;
	}

	public function getMobileNo($idAccounts,$eventName,$eventLocation,$startDateTime,$endDateTime){
		$con = new Connect();
		$query = "SELECT Contact_Number FROM respondent JOIN cooperative_profile as c ON c.idRespondent = respondent.idRespondent JOIN accounts ON accounts.idCooperative_Profile = c.idCooperative_Profile  WHERE a.idaccounts = ".$idAccounts;
		$result = $con->select($query);
		$row = $result->fetch_assoc();
		
		return $row['Contact_Number'];
	}


	public function getEvents(){
		$query = "SELECT * FROM Events JOIN accounts ON accounts.idAccounts = events.idAccounts WHERE events.markasdeleted = 0 ";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}

	public function getEventDetails($idEvents){
		$query = "SELECT * FROM Events where markasdeleted = 0 and idEvents = '" .$idEvents."'";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}

	public function getGoing($idEvents){
		$query = "SELECT count( * ) as 'Going' FROM location WHERE idevents = '" .$idEvents. "' and status = 'GOING'";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}

	public function getNotGoing($idEvents){
		$query = "SELECT count( * ) as 'Not Going' FROM location WHERE idevents = '" .$idEvents. "' and status = 'NOT GOING'";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}

	public function getRecipient($idEvents){
		$query = "select cooperative_name, location.status from cooperative_profile inner join accounts
					on accounts.idcooperative_profile = cooperative_profile.idcooperative_profile
					inner join location on location.idaccounts = accounts.idaccounts 
					where location.idevents ='" .$idEvents."'";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}
	public function updateEvent($idEvents,$location,$startDateTime,$endDateTime){
		$query = "UPDATE events SET startDateTime='$startDateTime',endDateTime='$endDateTime', eventLocation='$location' WHERE idEvents=$idEvents";
		$con = new Connect();
		$result = $con->update($query);
		return $result;
	}
	public function deleteEvent($idEvents){
		$query="UPDATE events SET markasdeleted = 1 WHERE idEvents = $idEvents";
		$con = new Connect();
		$result = $con->update($query);
		return $result;
	}
}
?>