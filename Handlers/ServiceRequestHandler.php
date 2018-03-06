<?php 
class ServiceRequestHandler{
	public function addRequest($contactperson,$contactnumber,$email,$address,$date,$time,$organization,$participants,$others,$datecreated,$timecreated,$idAccounts,$venue,$serviceID){
		$con = new Connect();
		$query = "INSERT INTO service_request (contact_person,organization,contact_no,address,activity_date,activity_time,date_created,time_created,no_participants,venue,other,status,idservice,email,idAccounts) VALUES ('" .$contactperson."','".$organization."','".$contactnumber."','".$address."','".$date."','".$time."','".$datecreated."','".$timecreated."','".$participants."','".$venue."','".$others."','PENDING',".$serviceID.",'".$email."',".$idAccounts.")";
		$lastId = $con->insertReturnLastId($query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error(), E_USER_ERROR);
		return $lastId;
	}

	public function getServiceId($requestedservice){
		$con = new Connect();
		$query="SELECT idservice from service_list where service = '".$requestedservice."'";
		$result = $con->select($query);
		$row = $result->fetch_assoc();
		
		return $row['idservice'];
	}

	public function addinbox($status,$RequestId){
		$con = new Connect();
		$query = "insert into location (status,markasdeleted,idaccounts,isopen,canbedeleted,idservice_request) values('".$status."','0','3','0','0','".$RequestId."')";
		$lastId = $con->insertReturnLastId($query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error(), E_USER_ERROR);
		return $lastId;
	}
}
?>