<?php 
class ServiceRequestHandler{
	public function addRequest($contactperson,$contactnumber,$email,$address,$date,$time,$organization,$participants,$requestedservice,$others,$datecreated,$timecreated){
		$con = new Connect();
		$query = "INSERT INTO service_request (contact_person,organization,contact_no,address,activity_date,activity_time,date_created,time_created,no_participants,other,status,idservice,email,idAccounts) VALUES ('" .$contactperson."','".$organization."','".$contactnumber."','".$address."','".$date."','".$time."','".$datecreated."','".$timecreated."','".$participants."','".$others."','PENDING','".$$$$."','".$email."','")";
		$lastId = $con->insertReturnLastId($query);
		return $lastId;
	}
}
?>