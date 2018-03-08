<?php
date_default_timezone_set('Asia/Manila');
class DocumentHandler{
	public function getTrackingNumber(){
		$con = new Connect();
		//check the current date and the last date in the database
		$query = "SELECT dateadded FROM tracking ORDER BY idTracking DESC LIMIT 1";
		$date = $con->select($query);
		if($date){
				if($row = $date->fetch_assoc()){
				if($row['dateadded'] != date("m/d/Y")){
					$number = 'CCDO-00001';
				}
				else{
					$query = "SELECT trackingNumber FROM Tracking ORDER BY idTracking DESC LIMIT 1";
					$trackingNumber = $con->select($query);
					if($trackingNumber){
						while($row=$trackingNumber->fetch_assoc()){
							if($row['trackingNumber']!= NULL){
								$number = explode("-", $row['trackingNumber']);
								$tempo = $this->incrementNumber($number[1]);
								$number = $number[0]."-".$tempo;
							}
							else{
								$number = 'CCDO-00001';
							}
						}
						return $number;	
					}
				}
			}
		}
		
		
		return 'CCDO-00001';
	}
	public function incrementNumber($trackingNumber){
		$trackingNumber = str_pad($trackingNumber + 1, 5, 0, STR_PAD_LEFT);
		return $trackingNumber;
	}
	public function getDocumentType(){
		$con = new Connect();
		$query = "SELECT * FROM Document_type ORDER BY Document";
		$documentType = $con->select($query);
		return $documentType;
	}
	public function addDocument($controlNumber,$title,$trackingNumber,$documentType,$senderId,$reply,$file = "",$message = ""){
		$con = new Connect();
		$query= "INSERT INTO inbox_info(title,message) VALUES('".$title."','".$message."')";
		$result = $con->insertReturnLastId($query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error(), E_USER_ERROR);
		if($result){
			$query = "INSERT INTO tracking(control_number,trackingNumber,dateadded,timeadded,idDocument_Type,idAccounts,Status,filePath,needReply,idinbox_info) VALUES('$controlNumber','".$trackingNumber."','".date("m/d/Y")."','".date("h:i:s a")."','".$documentType."','".$senderId."','ONGOING','".$file."',".$reply.",$result)";
			$result = $con->insertReturnLastId($query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error(), E_USER_ERROR);
		}
		return $result;
	}
	public function addDocumentLocation($recipient,$trackingId){
		$con = new Connect();
		$query = "INSERT INTO location(status,idAccounts,idTracking) VALUES('WAITING FOR CONFIRMATION','".$recipient."','".$trackingId."')";
		$result = $con->insert($query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error(), E_USER_ERROR);
		return $result;
	}
	public function getTrackingById($id){
		$con = new Connect();
		$query = "SELECT trackingNumber,title,CONCAT(dateadded,'-',timeadded) as DateTime,Document,Status FROM tracking,document_type,inbox_info WHERE Status='ONGOING' and inbox_info.idinbox_info = tracking.idinbox_info and tracking.idDocument_Type= document_type.idDocument_Type and idAccounts=$id ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getTracking(){
		$con = new Connect();
		$query = "SELECT trackingNumber,CONCAT(dateadded,'-',timeadded) as DateTime,Document,Status FROM tracking,document_type WHERE Status='ONGOING' and tracking.idDocument_Type= document_type.idDocument_Type ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getLocationDeptByTrackingNumber($trackingNumber){
		$con = new Connect();
		$query="SELECT location.status,department.Department FROM tracking JOIN inbox_info ON tracking.idinbox_info = inbox_info.idinbox_info JOIN location ON tracking.idtracking = location.idTracking JOIN accounts ON accounts.idAccounts = location.idAccounts JOIN department ON department.idDepartment = accounts.idDepartment WHERE tracking.Status='ONGOING' and trackingNumber ='".$trackingNumber."'";
		$result = $con->select($query);
		return $result;
	}
	public function getLocationCoopByTrackingNumber($trackingNumber){
		$con = new Connect();
		$query = "SELECT location.status ,cooperative_profile.Cooperative_Name FROM tracking,location,inbox_info,accounts,cooperative_profile WHERE tracking.Status='ONGOING' and tracking.idinbox_info= inbox_info.idinbox_info and location.idAccounts= accounts.idAccounts and tracking.idTracking = location.idTracking and accounts.idCooperative_Profile = cooperative_profile.idCooperative_Profile and trackingNumber ='".$trackingNumber."'";
		$result = $con-> select($query);
		return $result;
	}
	public function getTrackingInfo($trackingNumber){
		$con = new Connect();
		$query ="SELECT title,trackingNumber,CONCAT(dateadded,'-',timeadded) as DateTime,Document,tracking.Status,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = tracking.idAccounts),cooperative_profile.Email_Address) as email,filePath,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name FROM tracking JOIN document_type ON document_type.idDocument_Type = tracking.idDocument_Type  LEFT OUTER JOIN accounts ON accounts.idAccounts = tracking.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info where trackingNumber = '$trackingNumber'";
		$result = $con->select($query);
		return $result;
	}
	public function getTrackingCountById($id){
		$con = new Connect();
		$query = "SELECT count(*) FROM tracking,document_type WHERE Status='ONGOING' and tracking.idDocument_Type= document_type.idDocument_Type and idAccounts= ".$id." ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getInboxCountById($id){
		//check this.
		$con = new Connect();
		$query = "SELECT count(*) FROM location LEFT OUTER JOIN reply ON reply.idreply = location.idreply JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info or reply.idinbox_info = inbox_info.idinbox_info LEFT OUTER JOIN events ON location.idEvents = events.idEvents WHERE  location.idAccounts = $id and location.markasdeleted = 0 ";
		$result = $con->select($query);
		return $result;
	}
	public function inboxCoopById($id,$deleted = 0){
		$con = new Connect();
		$query ="SELECT canbedeleted, isopen,location.idlocation, tracking.idTracking,reply.idreply,events.idEvents,service_request.idservice_request,coalesce(CONCAT(dateadded,'-',timeadded),reply.DateTime,CONCAT(service_request.date_created,'-',service_request.time_created),events.datetime) as DateTime,ifnull(tracking.trackingNumber,reply.trackingNumber) as trackingNumber,reply.idAccounts as reply_sender,location.idAccounts as receiver,username,coalesce(title,events.eventName,'SERVICE REQUEST') as title,message,if(ispublic=0,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)),contact_person) as name,service_request.status as status FROM location LEFT OUTER JOIN events ON events.idEvents = location.idEvents LEFT OUTER JOIN service_request ON service_request.idservice_request = location.idservice_request LEFT OUTER JOIN reply ON reply.idreply = location.idreply LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking JOIN accounts ON tracking.idAccounts = accounts.idAccounts OR reply.idAccounts = accounts.idAccounts or service_request.idAccounts = accounts.idAccounts or events.idAccounts = accounts.idAccounts LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info or reply.idinbox_info = inbox_info.idinbox_info LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info  WHERE location.idAccounts = $id and location.markasdeleted =$deleted and location.status !='DISAPPROVED' ORDER BY location.idlocation DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getInboxInfo($idTracking,$id,$idlocation){
		$con = new Connect();
		$query ="SELECT Document,tracking.idAccounts as receiverId,needReply,filePath,tracking.idTracking,CONCAT(dateadded,'-',timeadded) as DateTime,tracking.trackingNumber as trackingNumber,location.idAccounts as receiver,username,title,message,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = tracking .idAccounts),cooperative_profile.Email_Address) as email FROM location LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking JOIN accounts ON tracking.idAccounts = accounts.idAccounts LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info JOIN document_type ON tracking.idDocument_Type = document_type.idDocument_Type WHERE location.idAccounts =$id and tracking.idTracking = $idTracking and location.idlocation=$idlocation;";
		$result = $con->select($query);
		return $result;
	}
	public function getNewMessageCount($id){
		$con = new Connect();
		$query = "SELECT count(*) FROM location where idaccounts =$id and isopen = 0 and markasdeleted = 0 and location.status !='DISAPPROVED'";
		$result = $con->select($query);
		return $result;
	}
	public function getMessageCount($id){
		$con = new Connect();
		$query = "SELECT count(*) FROM location where idaccounts =$id and isopen = 0 and markasdeleted = 0 and canbedeleted = 0 and location.status !='DISAPPROVED'";
		$result = $con->select($query);
		return $result;
	}
	public function getReplyInfo($idReply,$id){
		$con = new Connect();
		$query ="SELECT reply.idAccounts as receiverId,reply.idreply,DateTime,reply.trackingNumber as trackingNumber,location.idAccounts as receiver,username,title,message,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM reply JOIN inbox_info ON reply.idinbox_info = inbox_info.idinbox_info JOIN location ON location.idreply = reply.idreply LEFT OUTER JOIN accounts ON accounts.idAccounts = reply.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts  where location.idAccounts =$id and location.idReply = $idReply";
		$result = $con->select($query);
		return $result;
	}
	public function getEventInfo($idEvents,$id){
		$con = new Connect();
		$query ="SELECT eventName as title,eventDetails as message,startDateTime,endDateTime,eventLocation,fileUpload as filePath, events.idEvents as receiverId,datetime as DateTime,location.idAccounts as receiver,concat(first_name,' ', last_name) as name,email_address as email FROM events JOIN location ON location.idEvents = events.idEvents JOIN accounts ON accounts.idAccounts = events.idAccounts JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info WHERE location.idAccounts = $id and location.idEvents = $idEvents ";
		$result = $con->select($query);
		return $result;
	}
	public function getServiceRequestInfo($idservice_request,$id,$idlocation){
		$con = new Connect();
		$query ="SELECT 'SERVICE REQUEST' as title,contact_person as contact,address,contact_no,organization ,activity_date,activity_time,venue,no_participants,email,service_request.idservice_request as receiverId,service_request.idservice_request,concat(date_created,'-',time_created) as DateTime,location.idAccounts as receiver,if(ispublic=0,concat(first_name,' ', last_name),contact_person) as name, if(other='',service_list.service,other) as service_req FROM service_request JOIN location ON location.idservice_request = service_request.idservice_request JOIN accounts ON accounts.idAccounts = service_request.idAccounts JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info JOIN service_list ON service_request.idservice= service_list.idservice WHERE location.idAccounts = $id and location.idservice_request = $idservice_request and location.idlocation = $idlocation";
		$result = $con->select($query);
		return $result;
	}
	public function getReplyLocationById($idReply,$id){
		$con = new Connect();
		$query = "SELECT location.idlocation,location.idAccounts,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM reply LEFT OUTER JOIN location ON location.idreply = reply.idreply LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts WHERE reply.idreply =$idReply and location.idAccounts = $id";
		$result = $con->select($query);
		return $result;
	}
	public function getEventLocationById($idEvents,$id){
		$con = new Connect();
		$query = "SELECT location.idlocation,location.idAccounts,cooperative_name as name,cooperative_profile.Email_Address as email FROM events LEFT OUTER JOIN location ON location.idEvents = events.idEvents LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile  WHERE events.idEvents =$idEvents";
		$result = $con->select($query);
		return $result;
	}
	public function getServiceReqLocationById($idservice_request,$id,$idlocation){
		$con = new Connect();
		$query = "SELECT location.idlocation,location.idAccounts,ifnull(department,'Event Manager') as name,Email_Address as email FROM location JOIN service_request ON service_request.idservice_request = location.idservice_request JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT JOIN department ON department.idDepartment = accounts.idDepartment JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info WHERE service_request.idservice_request = $idservice_request and location.idAccounts = $id and location.idlocation = $idlocation";
		$result = $con->select($query);
		return $result;
	}
	public function getServiceReqLocation($idservice_request){
		$con = new Connect();
		$query = "SELECT location.idlocation,location.idAccounts,ifnull(department,'Event Manager') as name,Email_Address as email FROM location JOIN service_request ON service_request.idservice_request = location.idservice_request JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT JOIN department ON department.idDepartment = accounts.idDepartment JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info WHERE service_request.idservice_request = $idservice_request";
		$result = $con->select($query);
		return $result;
	}
	public function getEventLocation($idEvents){
		$con = new Connect();
		$query = "SELECT location.idlocation,location.idAccounts,cooperative_name as name,cooperative_profile.Email_Address as email FROM events LEFT OUTER JOIN location ON location.idEvents = events.idEvents LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile  WHERE events.idEvents =$idEvents";
		$result = $con->select($query);
		return $result;
	}
	public function getTrackingLocation($idTracking){
		$con = new Connect();
		$query ="SELECT location.idlocation,location.idAccounts,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM tracking  LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info LEFT OUTER JOIN location ON location.idTracking = tracking.idTracking LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts WHERE  tracking.idTracking = $idTracking";
		$result = $con->select($query);
		return $result;
	}
	public function getTrackingLocationById($idTracking,$id,$idlocation){
		$con = new Connect();
		$query ="SELECT location.idlocation,location.idAccounts,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM tracking LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info LEFT OUTER JOIN location ON location.idTracking = tracking.idTracking LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts WHERE tracking.idTracking = $idTracking and location.idAccounts = $id and location.idlocation = $idlocation";
		$result = $con->select($query);
		return $result;
	}
	public function changeInboxStatus($id,$idTracking,$type='RECEIVED'){
		$con = new Connect();
		$setDelete = "UPDATE location SET canbedeleted = 1 WHERE idTracking = $idTracking and idAccounts = $id";
		$resultSet = $con->update($setDelete);
		$selectQuery = "SELECT status FROM location  WHERE idAccounts = $id and idTracking = $idTracking";
		$status= $con->select($selectQuery);
		$queryHistory = "INSERT INTO history(idlocation,status,datetime) VALUES ((SELECT idlocation FROM location where idAccounts = $id and idTracking = $idTracking),'$type','".date("m/d/Y-h:i:sa")."')";
		$con->insert($queryHistory);
		if($row=$status->fetch_assoc()){
			if($row['status']=='WAITING FOR CONFIRMATION' ){
				$query = "UPDATE location  SET status ='RECEIVED' WHERE idAccounts = $id and idTracking = $idTracking";
				$result = $con->update($query);
				if($result){
			 		//checking 
			 		$check = "SELECT count(*) as counter FROM location JOIN tracking ON tracking.idTracking = location.idTracking WHERE tracking.idTracking = $idTracking and location.Status != 'RECEIVED';";
			 		$checkResult = $con->select($check);
			 		if($checkResult){
			 			$row = $checkResult->fetch_assoc();
			 			if($row['counter']==0){
			 				$doneQuery = "UPDATE tracking SET Status='DONE', datecompleted='".date("m/d/Y")."',timecompleted='".date("h:i:sa")."' WHERE idTracking = $idTracking";
			 				$resultDone = $con->update($doneQuery);
			 				$queryHistory = "INSERT INTO history(idlocation,status,datetime) VALUES ((SELECT idlocation FROM location where idAccounts = $id and idTracking = $idTracking),'DONE','".date("m/d/Y-h:i:sa")."')";
							$con->insert($queryHistory);
			 			}
			 		}
			 		return $result;
			 	}
			 	else
			 		return null;
				return $result;
			}
		}
		
	}
	 public function replyByIdTracking($id,$trackingNumber,$receiverId,$title,$message,$idTracking=''){
	 	$con = new Connect();
	 	$query = "INSERT INTO inbox_info(title,message) VALUES('$title','$message')";
	 	$result = $con->insertReturnLastId($query);
	 	$query = "INSERT INTO reply(idAccounts,idinbox_info,trackingNumber) VALUES($id,$result,'$trackingNumber')";
	 	$result = $con->insertReturnLastId($query);
	 	$query = "INSERT INTO location(idreply,idAccounts,canbedeleted) VALUES($result,$receiverId,1)";
	 	$result = $con->insert($query);
		return $result;
	}
	public function  deleteInbox($idlocation,$del){
		$con = new Connect();
		$query = "UPDATE location SET markasdeleted = $del WHERE idlocation = $idlocation";
		$result = $con->update($query);
		return $result;		
		
	}
	public function checkDelete($idlocation){
		$con = new Connect();
		$query = "SELECT canbedeleted FROM location WHERE idlocation = $idlocation";
		$result = $con->select($query);
		$row=$result->fetch_assoc();
		return $row['canbedeleted'];
	}
	public function checkIfRead($idTracking,$id,$idlocation){
		$con = new Connect();
		$query = "SELECT isopen FROM location JOIN tracking ON tracking.idTracking = location.idTracking WHERE tracking.idTracking = $idTracking and location.idAccounts = $id and location.idlocation = $idlocation";
		$result = $con->select($query);
		if($row=$result->fetch_assoc()){
			if($row['isopen']==0){
				//update to open
			$queryUpdate = "UPDATE location SET isopen= 1 WHERE idTracking =$idTracking and idAccounts = $id";
			$resultUpdate = $con->update($queryUpdate);
			
			}
		}
	}
	public function checkReply($idTracking,$id){
		$con = new Connect();
		$query = "SELECT needReply FROM tracking WHERE idTracking = $idTracking";
		$result = $con->select($query);
		if($row=$result->fetch_assoc()){
			if($row['needReply']==0){
				//update to open
			$queryUpdate = "UPDATE location SET status ='RECEIVED' WHERE idTracking =$idTracking and idAccounts = $id";
			$resultUpdate = $con->update($queryUpdate);
			$queryDelete = "UPDATE location SET canbedeleted = 1 WHERE idTracking = $idTracking and idAccounts = $id";
			$queryHistory = "INSERT INTO history(idlocation,status,datetime) VALUES ((SELECT idlocation FROM location where idAccounts = $id and idTracking = $idTracking),'RECEIVED','".date("m/d/Y-h:i:sa")."')";
			$con->insert($queryHistory);
			$resultDelete = $con->update($queryDelete);
				if($resultUpdate){
		 		//checking 
			 		$check = "SELECT count(*) as counter FROM location JOIN tracking ON tracking.idTracking = location.idTracking WHERE tracking.idTracking = $idTracking and location.Status != 'RECEIVED';";
			 		$checkResult = $con->select($check);
			 		if($checkResult){
			 			$row = $checkResult->fetch_assoc();
			 			if($row['counter']==0){
			 				$doneQuery = "UPDATE tracking SET Status='DONE', datecompleted='".date("m/d/Y")."',timecompleted='".date("h:i:sa")."' WHERE idTracking = $idTracking";
			 				$resultDone = $con->update($doneQuery);
			 				$queryHistory = "INSERT INTO history(idlocation,status,datetime) VALUES ((SELECT idlocation FROM location where idAccounts = $id and idTracking = $idTracking),'DONE','".date("m/d/Y-h:i:sa")."')";
							$con->insert($queryHistory);
				 		}
					}
				}
			}
		}
	}
	public function checkIfReadReply($idReply,$id){
		$con = new Connect();
		$query = "SELECT isopen FROM location JOIN reply ON reply.idReply = location.idReply WHERE reply.idReply = $idReply and location.idAccounts = $id";
		$result = $con->select($query);
		if($row=$result->fetch_assoc()){
			if($row['isopen']==0){
				//update to open
			$queryUpdate = "UPDATE location SET isopen= 1 WHERE idReply =$idReply and idAccounts = $id";
			$resultUpdate = $con->update($queryUpdate);
			return $resultUpdate;
			}
			else
				return $result;
		}
	}
	public function checkIfReadEvent($idEvents,$id){
		$con = new Connect();
		$query = "SELECT isopen FROM location JOIN events ON events.idEvents = location.idEvents WHERE events.idEvents = $idEvents and location.idAccounts = $id";
		$result = $con->select($query);
		if($row=$result->fetch_assoc()){
			if($row['isopen']==0){
				//update to open
			$queryUpdate = "UPDATE location SET isopen= 1 WHERE idEvents =$idEvents and idAccounts = $id";
			$resultUpdate = $con->update($queryUpdate);
			return $resultUpdate;
			}
			else
				return $result;
		}
	}
	public function checkIfReadRequest($idservice_request,$id,$idlocation){
		$con = new Connect();
		$query = "SELECT isopen FROM location JOIN service_request ON service_request.idservice_request = location.idservice_request WHERE service_request.idservice_request = $idservice_request and location.idAccounts = $id and location.idlocation = $idlocation";
		$result = $con->select($query);
		if($row=$result->fetch_assoc()){
			if($row['isopen']==0){
				//update to open
			$queryUpdate = "UPDATE location SET isopen= 1 WHERE idservice_request =$idservice_request and idAccounts = $id";
			$resultUpdate = $con->update($queryUpdate);
			return $resultUpdate;
			}
			else
				return $result;
		}
	}
	function getNotification($id){
		$con = new Connect();
		$query = "SELECT isnotified,location.idlocation,coalesce(title,eventName,'SERVICE REQUEST') as title,ifnull(message,'') as message,if(ispublic=0,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)),contact_person) as name FROM location LEFT OUTER JOIN reply ON reply.idreply = location.idreply LEFT OUTER JOIN events ON events.idEvents = location.idEvents LEFT OUTER JOIN service_request on service_request.idservice_request = location.idservice_request LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking JOIN accounts ON tracking.idAccounts = accounts.idAccounts OR reply.idAccounts = accounts.idAccounts or events.idAccounts = accounts.idAccounts or service_request.idAccounts = accounts.idAccounts LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info or reply.idinbox_info = inbox_info.idinbox_info LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info WHERE location.idAccounts = $id and location.markasdeleted =0 and isnotified = 0 and location.status !='DISAPPROVED'";
		$result = $con->select($query);
		return $result;
	}
	function updateNotification($idlocation){
		$con = new Connect();
		$query = "UPDATE location SET isnotified = 1 WHERE idlocation =$idlocation";
		$result = $con->update($query);
	}
	public function getTransactionLogsAdmin(){
		$con = new Connect();
		$query = "SELECT trackingNumber,dateadded,datecompleted,Document,Status,title FROM tracking,document_type,inbox_info WHERE Status='DONE' and tracking.idDocument_Type= document_type.idDocument_Type and inbox_info.idinbox_info = tracking.idinbox_info ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getTransactionLogsAdminByDate($mindate,$maxdate){
		$con = new Connect();
		$query = "SELECT trackingNumber,title,Document,dateadded,datecompleted FROM tracking,document_type,inbox_info WHERE (dateadded BETWEEN '$mindate' AND '$maxdate') and Status='DONE' and tracking.idDocument_Type= document_type.idDocument_Type and inbox_info.idinbox_info = tracking.idinbox_info ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getTransactionLogs($id){
		$con = new Connect();
		$query = "SELECT trackingNumber,dateadded,datecompleted,Document,Status,title FROM tracking,document_type,inbox_info WHERE Status='DONE' and tracking.idDocument_Type= document_type.idDocument_Type and inbox_info.idinbox_info = tracking.idinbox_info and idAccounts=$id ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	
	public function getHistory($id){
		$con = new Connect();
		$query="SELECT ifnull(tracking.trackingNumber,reply.trackingNumber) as trackingNumber, history.status,history.datetime,location.idlocation,title,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name FROM history JOIN location ON history.idlocation = location.idlocation LEFT OUTER JOIN reply ON reply.idreply = location.idreply LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking JOIN accounts ON location.idAccounts = accounts.idAccounts LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info or reply.idinbox_info = inbox_info.idinbox_info LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info WHERE tracking.idAccounts = $id ORDER BY idhistory DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getCountPendingDoc($date){
		$con = new Connect();
		$query="SELECT count(*) as count FROM tracking WHERE dateadded ='$date' and tracking.Status='ONGOING'";
		$result = $con->select($query);
		$count=0;
		if($result){
			if($row=$result->fetch_assoc())
				$count = $row['count'];
		}
		return $count;
	}
	public function getCountPendingDocDate($date){
		$con = new Connect();
		$query="SELECT count(*) as count FROM tracking WHERE dateadded='$date' and tracking.Status='ONGOING'";
		$result = $con->select($query);
		$count='';
		if($row=$result->fetch_assoc())
			$count = $row['count'];
		return $count;
	}
	public function getCountDoneDocDate($date){
		$con = new Connect();
		$query="SELECT count(*) as count FROM tracking WHERE dateadded='$date' and tracking.Status='DONE' ";
		$result = $con->select($query);
		$count='';
		if($row=$result->fetch_assoc())
			$count = $row['count'];
		return $count;
	}
	public function getCountDoneDoc($date){
		$con = new Connect();
		$query="SELECT count(*) as count FROM tracking WHERE dateadded ='$date' and tracking.Status='DONE' ";
		$result = $con->select($query);
		$count=0;
		if($result){
			if($row=$result->fetch_assoc())
				$count = $row['count'];
		}
		return $count;
	}
	public function getTotalDoc($date){
		$con = new Connect();
		$query="SELECT count(*) as count FROM tracking WHERE dateadded ='$date'";
		$result = $con->select($query);
		$count='';
		if($row=$result->fetch_assoc())
			$count = $row['count'];
		return $count;
	}
	public function getCountAccounts(){
		$con = new Connect();
		$query="SELECT count(*) as count FROM accounts WHERE idaccount_type = 3 and markasdeleted = 0 ";
		$result = $con->select($query);
		$count='';
		if($row=$result->fetch_assoc())
			$count = $row['count'];
		return $count;
	}
	public function getUpcomingEvent(){
		$con = new Connect();
		$query = "SELECT idEvents,eventName FROM events WHERE markasdeleted=0 and status='ON GOING' ORDER BY idEvents DESC LIMIT 1";
		$result = $con->select($query);
		$event = array();
		if ($result) {
			if($row=$result->fetch_assoc()){
			$event[0] = $row['eventName'];
			$event[1] = $row['idEvents'];
		}
		return $event;
		}
		else{
			return 0;
		}
		
	}
	public function replyEvent($idEvents,$id,$reply){
		$con = new Connect();
		$query = "UPDATE location SET status = '$reply' WHERE idEvents = $idEvents and location.idAccounts = $id";
		$result = $con->update($query);
		return $result;
	}
	public function getOngoingTracking($date){
		$con = new Connect();
		$query = "SELECT idTracking,dateadded,timeadded, trackingNumber,title,CONCAT(dateadded,'-',timeadded) as DateTime,Document,Status,username FROM tracking,document_type,inbox_info,accounts WHERE Status='ONGOING' and dateadded='$date' and tracking.idDocument_Type= document_type.idDocument_Type and inbox_info.idinbox_info = tracking.idinbox_info and accounts.idaccounts = tracking.idaccounts ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getFinishedTracking($date){
		$con = new Connect();
		$query = "SELECT idTracking,dateadded,timeadded, trackingNumber,title,CONCAT(dateadded,'-',timeadded) as DateTime,Document,Status,username FROM tracking,document_type,inbox_info,accounts WHERE Status='DONE' and dateadded='$date' and tracking.idDocument_Type= document_type.idDocument_Type and inbox_info.idinbox_info = tracking.idinbox_info and accounts.idaccounts = tracking.idaccounts ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getEventDetails(){
		$con = new Connect();
		$query = "SELECT *,concat(first_name,' ', last_name) as name FROM events JOIN accounts ON accounts.idAccounts = events.idAccounts JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info  WHERE status='ON GOING' and events.markasdeleted =0 ORDER BY idEvents DESC LIMIT 1 ";
		$result = $con->select($query);
		return $result;
	}
	public function getAllTracking(){
		$con = new Connect();
		$query = "SELECT idTracking,timeadded, trackingNumber,title,CONCAT(dateadded,'-',timeadded) as DateTime,Document,Status,username FROM tracking,document_type,inbox_info,accounts WHERE tracking.idDocument_Type= document_type.idDocument_Type and inbox_info.idinbox_info = tracking.idinbox_info and accounts.idaccounts = tracking.idaccounts ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function checkInbox($idlocation){
		$con = new Connect();
		$query ="SELECT idTracking,idservice_request,idEvents,idReply FROM location where idlocation=$idlocation and markasdeleted = 0;";
		$result = $con->select($query);
		return $result;
	}
}
?>