<?php
class EventHandler{
	public function addEvent($eventName,$eventLocation,$eventDetails,$startDateTime,$endDateTime,$fileUpload,$idAccounts){
		$con = new Connect();
		$query = "INSERT INTO Events (eventName,eventLocation,eventDetails,startDateTime,endDateTime,fileUpload,idAccounts,status,datetime,markasdeleted) VALUES ('" .$eventName."','".$eventLocation."','".$eventDetails."','".$startDateTime."','".$endDateTime."','".$fileUpload."','".$idAccounts."','ON GOING','".date("m/d/Y-h:i A")."',0)";
		$lastId = $con->insertReturnLastId($query);
		return $lastId;
	}

	public function checkEventName($eventName){
		$con = new Connect();
		$query = "SELECT * FROM Events where markasdeleted=0 and eventName = '" .$eventName."'";
		$result = $con->select($query);
		return $result;
	}
	public function getEventTransacLogs($id){
		$con = new Connect();
		$query = "SELECT eventName as title,SUBSTRING_INDEX(datetime, '\n', 1) AS date, datetime as datetime,eventLocation as location FROM events UNION SELECT ifnull(service,other) as title,date_created as date, concat(date_created,'-',time_created) as datetime,venue as location FROM service_request JOIN service_list ON service_list.idservice = service_request.idservice where service_request.status ='APPROVED' ORDER BY datetime DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getEventTransacLogsByDate($mindate,$maxdate){
		$con = new Connect();
		$query = "SELECT eventName as title,eventLocation as location,datetime FROM events WHERE (SUBSTRING_INDEX(datetime, '\n', 1) BETWEEN '$mindate' AND '$maxdate') and events.status='DONE' UNION SELECT ifnull(service,other) as title,venue as location, concat(date_created,'-',time_created) as datetime FROM service_request JOIN service_list ON service_list.idservice = service_request.idservice where (date_created BETWEEN '$mindate' AND '$maxdate') and service_request.status='APPROVED' order by datetime";
		$result = $con->select($query);
		return $result;
	}
	public function getHistory($id){
		$con = new Connect();
		$query="SELECT history.status,history.datetime,location.idlocation,coalesce(eventName,service,other) as title,COALESCE (department,concat(first_name,' ', last_name)) as name FROM history JOIN location ON history.idlocation = location.idlocation LEFT OUTER JOIN service_request ON service_request.idservice_request = location.idservice_request LEFT OUTER JOIN events ON events.idEvents = location.idEvents JOIN accounts ON location.idAccounts = accounts.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info LEFT OUTER JOIN service_list on service_list.idservice = service_request.idservice WHERE service_request.idAccounts = $id or events.idAccounts = $id ORDER BY idhistory DESC";
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
		$Mailmessage = $mail->sendMail($email,$eventName,$eventLocation,$startDateTime,$endDateTime);
		return $Mailmessage;
	}

	public function getMobileNo($idAccounts){
		$con = new Connect();
		$query = "SELECT Contact_Number FROM respondent JOIN cooperative_profile as c ON c.idRespondent = respondent.idRespondent JOIN accounts ON accounts.idCooperative_Profile = c.idCooperative_Profile  WHERE accounts.idAccounts = ".$idAccounts;
		$result = $con->select($query);
		$row = $result->fetch_assoc();
		
		return $row['Contact_Number'];
	}

	public function getEmail($idAccounts){
		$con = new Connect();
		$query = "SELECT Email_Address FROM cooperative_profile c INNER JOIN accounts a on a.idCooperative_Profile = c.idCooperative_Profile WHERE a.idaccounts = ".$idAccounts;
		$result = $con->select($query);
		$row = $result->fetch_assoc();
		
		return $row['Email_Address'];
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
	public function getServiceList(){
		$query = "SELECT * FROM service_list";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}
}
?>