<?php 
class ServiceRequestHandler{
	public function addRequest($contactperson,$contactnumber,$email,$address,$date,$time,$organization,$participants,$others,$datecreated,$timecreated,$idAccounts,$venue,$serviceID,$ispublic = 0){
		$con = new Connect();
		$query = "INSERT INTO service_request (contact_person,organization,contact_no,address,activity_date,activity_time,date_created,time_created,no_participants,venue,other,status,idservice,email,idAccounts,ispublic) VALUES ('" .$contactperson."','".$organization."','".$contactnumber."','".$address."','".$date."','".$time."','".$datecreated."','".$timecreated."','".$participants."','".$venue."','".$others."','PENDING',".$serviceID.",'".$email."',".$idAccounts.",$ispublic)";
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
	public function replyServiceLocation($idservice_request,$id,$reply){
		$con = new Connect();
		$query = "UPDATE location SET status = '$reply' WHERE idservice_request = $idservice_request and location.idAccounts = $id";
		$result = $con->update($query);
		return $result;
	}
	public function sendToDept($idservice_request){
		$con = new Connect();
		//search idAccounts of 4 departments
		$query = "SELECT idAccounts FROM accounts JOIN department ON department.idDepartment = accounts.idDepartment WHERE accounts.iddepartment in (1,2,3,4)";
		$result = $con->select($query);
		if($result){
			while($row=$result->fetch_assoc()){
				$idAccounts = $row['idAccounts'];
				$query = "INSERT INTO location(idservice_request,status,idAccounts) VALUES($idservice_request,'WAITING FOR CONFIRMATION',$idAccounts)";
				$res = $con->insert($query);
			}
		}
		return $result;
	}
	public function disapprove($idservice_request,$message=''){
		$con = new Connect();
		$SMS = new SMSHandler();
		$mail = new MailHandler();
		$query = "UPDATE service_request SET status='DISAPPROVED' WHERE idservice_request=$idservice_request";
		$result = $con->update($query);
		if($result){
			$query = "SELECT contact_no,email FROM service_request WHERE idservice_request = $idservice_request";
			$ress = $con->select($query);
			if($message!=''){
				$query="INSERT INTO remarks(remarks,idservice_request) VALUES('$message',$idservice_request)";
				$res = $con->insert($query);
				// get number and email
				if($row = $ress->fetch_assoc()){
					//send sms and email
					$SMSmessage = $SMS->sendSMS2($row['contact_no'],'Your service request has been disapproved. Check your e-mail for the remarks - CCDO'); 
					$Mailmessage = $mail->sendMail2($row['email'],'Your request has been disapproved. Remarks :'.$message);
				}
			}
			else{
				// get number and email
				if($row = $ress->fetch_assoc()){
					//send sms and e-mail
					$SMSmessage = $SMS->sendSMS2($row['contact_no'],'Your service request has been disapproved. - CCDO'); 
					$Mailmessage = $mail->sendMail2($row['email'],'Your request has been disapproved. -CCDO');
				}
			}
		}
	}
	public function approve($idservice_request,$id,$idlocation,$message=''){
		$con = new Connect();
		$SMS = new SMSHandler();
		$mail = new MailHandler();
		$query = "UPDATE location SET status ='APPROVED' WHERE idservice_request=$idservice_request and idAccounts=$id and location.idlocation = $idlocation";
		$result = $con->update($query);
		if($result){
			//insert remarks
			if($message!=''){
				$query="INSERT INTO remarks(remarks,idservice_request) VALUES('$message',$idservice_request)";
				$res = $con->insert($query);
			}
			if($id==1){
				//update service request
				$query = "UPDATE service_request SET status ='APPROVED' WHERE idservice_request = $idservice_request";
				$result = $con->update($query);
				$query = "SELECT contact_no,email FROM service_request WHERE idservice_request = $idservice_request";
				$ress = $con->select($query);
				if($message!=''){
					if($row = $ress->fetch_assoc()){
						//send sms and email
						$SMSmessage = $SMS->sendSMS2($row['contact_no'],'Your service request has been approved. Check your e-mail for the remarks - CCDO'); 
						$Mailmessage = $mail->sendMail2($row['email'],'Your request has been approved. Remarks :'.$message.' -CCDO');
					}
				}
				else{
					if($row = $ress->fetch_assoc()){
						//send sms and email
						$SMSmessage = $SMS->sendSMS2($row['contact_no'],'Your service request has been approved. - CCDO'); 
						$Mailmessage = $mail->sendMail2($row['email'],'Your request has been approved. -CCDO');
					}
				}
					
			}
			else if($id!=3){
				//check if all is approve
				$query ="SELECT count(*) as count FROM location WHERE idservice_request=$idservice_request and status in ('DISAPPROVED','WAITING FOR CONFIRMATION')";
				$result = $con->select($query);
				if($row = $result->fetch_assoc()){
					if($row['count']==0){
						// send to superadmin
						$query = "INSERT INTO location(idservice_request,status,idAccounts) VALUES($idservice_request,'WAITING FOR CONFIRMATION',1)";
						$result = $con->insert($query);
					}
				}
			}
			
		}
		return $query;
	}
	
}
?>