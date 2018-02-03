<?php
class EventHandler{
	public function addEvent($eventName,$eventLocation,$eventDetails,$startDateTime,$endDateTime,$fileUpload,$idAccounts){
		$con = new Connect();
		$query = "INSERT INTO Events (eventName,eventLocation,eventDetails,startDateTime,endDateTime,fileUpload,idAccounts,status,datetime) VALUES ('" .$eventName."','".$eventLocation."','".$eventDetails."','".$startDateTime."','".$endDateTime."','".$fileUpload."','".$idAccounts."','ON GOING','".date("m/d/Y-h:i:sa")."')";
		$lastId = $con->insertReturnLastId($query);
		return $lastId;
	}

	public function checkEventName($eventName){
		$con = new Connect();
		$query = "SELECT * FROM Events where eventName = '" .$eventName."'";
		$result = $con->select($query);

		return $result;
	}

	public function addRecipient($idEvents,$idAccounts,$eventName,$eventLocation,$startDateTime,$endDateTime){
		$con = new Connect();
		$SMS = new SMSHandler();
		$mail = new MailHandler();
		$query = "INSERT INTO location(idEvents,idAccounts,status) VALUES('".$idEvents."','".$idAccounts."','WAITING FOR CONFIRMATION')";
		$result = $con->insert($query);
		$number = $this->getMobileNo($idAccounts);
		$email = $this->getEmail($idAccounts);
		$SMSmessage = $SMS->sendSMS($number,$eventName,$eventLocation,$startDateTime,$endDateTime); 
		return $email;
	}

	public function getMobileNo($idAccounts){
		$con = new Connect();
		$query = "SELECT Telephone_Number FROM cooperative_profile c INNER JOIN accounts a on a.idCooperative_Profile = c.idCooperative_Profile WHERE a.idaccounts = ".$idAccounts;
		$result = $con->select($query);
		$row = $result->fetch_assoc();
		
		return $row['Telephone_Number'];
	}

	public function getEmail($idAccounts){
		$con = new Connect();
		$query = "SELECT Email_Address FROM cooperative_profile c INNER JOIN accounts a on a.idCooperative_Profile = c.idCooperative_Profile WHERE a.idaccounts = ".$idAccounts;
		$result = $con->select($query);
		$row = $result->fetch_assoc();
		
		return $row['Email_Address'];
	}

	public function getEvents(){
		$query = "SELECT * FROM Events";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}

	public function getEventDetails($idEvents){
		$query = "SELECT * FROM Events where idEvents = '" .$idEvents."'";
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
}
?>