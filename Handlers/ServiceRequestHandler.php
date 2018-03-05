<?php 
class ServiceRequestHandler{
	public function addRequest($contactperson,$contactnumber,$email,$address,$date,$time,$organization,$participants,$others,$datecreated,$timecreated,$idAccounts,$venue){
		$con = new Connect();
		$query = "INSERT INTO service_request (contact_person,organization,contact_no,address,activity_date,activity_time,date_created,time_created,no_participants,venue,other,status,email,idAccounts) VALUES ('" .$contactperson."','".$organization."','".$contactnumber."','".$address."','".$date."','".$time."','".$datecreated."','".$timecreated."','".$participants."','".$venue."','".$others."','PENDING','".$email."','".$idAccounts."')";
		$lastId = $con->insertReturnLastId($query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error(), E_USER_ERROR);
		return $lastId;
	}

	public function addserviceID($serviceID,$RequestId){
		$con = new Connect();
		$query="update service_request SET idservice = '".$serviceID."' WHERE idservice_request = '".$RequestId."';";
		$result = $con->update($query);
	}

	public function getServiceId($requestedservice){
		$con = new Connect();
		$query="SELECT idservice from service_list where service = '".$requestedservice."'";
		$result = $con->select($query);
		$row = $result->fetch_assoc();
		
		return $row['idservice'];
	}
}
?>