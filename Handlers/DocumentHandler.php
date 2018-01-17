<?php
class DocumentHandler{
	
	public function getTrackingNumber(){
		$con = new Connect();
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
	public function addDocument($title,$trackingNumber,$documentType,$senderId,$reply,$file = "",$message = ""){
		$con = new Connect();
		$query= "INSERT INTO inbox_info(title,message) VALUES('".$title."','".$message."')";
		$result = $con->insertReturnLastId($query);
		$query = "INSERT INTO tracking(trackingNumber,DateTime,idDocument_Type,idAccounts,Status,filePath,needReply,idinbox_info) VALUES('".$trackingNumber."','".date("Y/m/d-h:i:sa")."','".$documentType."','".$senderId."','ONGOING','".$file."',".$reply.",$result)";
		$result = $con->insertReturnLastId($query);
		
		return $result;
	}
	public function addDocumentLocation($recipient,$trackingId){
		$con = new Connect();
		$query = "INSERT INTO location(status,idAccounts,idTracking) VALUES('WAITING FOR CONFIRMATION','".$recipient."','".$trackingId."')";
		$result = $con->insert($query);
		return $result;
	}
	public function getTrackingById($id){
		$con = new Connect();
		$query = "SELECT trackingNumber,DateTime,Document,Status FROM tracking,document_type WHERE Status='ONGOING' and tracking.idDocument_Type= document_type.idDocument_Type and idAccounts='".$id."' ORDER BY idTracking DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getTracking(){
		$con = new Connect();
		$query = "SELECT trackingNumber,DateTime,Document,Status FROM tracking,document_type WHERE Status='ONGOING' and tracking.idDocument_Type= document_type.idDocument_Type ORDER BY idTracking DESC";
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
		$query ="SELECT trackingNumber,DateTime,Document,tracking.Status,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = tracking.idAccounts),cooperative_profile.Email_Address) as email,filePath,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name FROM tracking JOIN document_type ON document_type.idDocument_Type = tracking.idDocument_Type  LEFT OUTER JOIN accounts ON accounts.idAccounts = tracking.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts where trackingNumber = '$trackingNumber'";
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
		$query = "SELECT count(*) FROM location LEFT OUTER JOIN reply ON reply.idreply = location.idreply JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info or reply.idinbox_info = inbox_info.idinbox_info WHERE  location.idAccounts = $id and markasdeleted = 0 ";
		$result = $con->select($query);
		return $result;
	}
	public function inboxCoopById($id,$deleted = 0){
		$con = new Connect();
		$query ="SELECT canbedeleted, isopen,location.idlocation, tracking.idTracking,reply.idreply,ifnull(tracking.DateTime,reply.DateTime) as DateTime,ifnull(tracking.trackingNumber,reply.trackingNumber) as trackingNumber,reply.idAccounts as reply_sender,location.idAccounts as receiver,username,title,message,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name FROM location LEFT OUTER JOIN reply ON reply.idreply = location.idreply LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking JOIN accounts ON tracking.idAccounts = accounts.idAccounts OR reply.idAccounts = accounts.idAccounts LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info or reply.idinbox_info = inbox_info.idinbox_info LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info WHERE location.idAccounts = $id and markasdeleted =$deleted ORDER BY location.idlocation DESC";
		$result = $con->select($query);
		return $result;
	}
	public function getInboxInfo($idTracking,$id){
		$con = new Connect();
		$query ="SELECT Document,tracking.idAccounts as receiverId,needReply,filePath,tracking.idTracking,DateTime,tracking.trackingNumber as trackingNumber,location.idAccounts as receiver,username,title,message,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = tracking .idAccounts),cooperative_profile.Email_Address) as email FROM location LEFT OUTER JOIN tracking ON tracking.idTracking = location.idTracking JOIN accounts ON tracking.idAccounts = accounts.idAccounts LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info JOIN document_type ON tracking.idDocument_Type = document_type.idDocument_Type WHERE location.idAccounts =$id and tracking.idTracking = $idTracking;";
		$result = $con->select($query);
		return $result;
	}
	public function getReplyInfo($idReply,$id){
		$con = new Connect();
		$query ="SELECT reply.idAccounts as receiverId,reply.idreply,DateTime,reply.trackingNumber as trackingNumber,location.idAccounts as receiver,username,title,message,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM reply JOIN inbox_info ON reply.idinbox_info = inbox_info.idinbox_info JOIN location ON location.idreply = reply.idreply LEFT OUTER JOIN accounts ON accounts.idAccounts = reply.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts  where location.idAccounts =$id and location.idReply = $idReply";
		$result = $con->select($query);
		return $result;
	}
	public function getReplyLocationById($idReply,$id){
		$con = new Connect();
		$query = "SELECT location.idlocation,location.idAccounts,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM reply LEFT OUTER JOIN location ON location.idreply = reply.idreply LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts WHERE reply.idreply =$idReply and location.idAccounts = $id";
		$result = $con->select($query);
		return $result;
	}
	public function getTrackingLocation($idTracking){
		$con = new Connect();
		$query ="SELECT location.idlocation,location.idAccounts,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM tracking  LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info LEFT OUTER JOIN location ON location.idTracking = tracking.idTracking LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts WHERE  tracking.idTracking = $idTracking";
		$result = $con->select($query);
		return $result;
	}
	public function getTrackingLocationById($idTracking,$id){
		$con = new Connect();
		$query ="SELECT location.idlocation,location.idAccounts,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name,ifnull((SELECT email_address FROM account_info JOIN accounts ON accounts.idAccount_info = account_info.idAccount_Info where accounts.idaccounts = location.idAccounts),cooperative_profile.Email_Address) as email FROM tracking LEFT OUTER JOIN inbox_info ON inbox_info.idinbox_info = tracking.idinbox_info LEFT OUTER JOIN location ON location.idTracking = tracking.idTracking LEFT OUTER JOIN accounts ON accounts.idAccounts = location.idAccounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccounts WHERE tracking.idTracking = $idTracking and location.idAccounts = $id";
		$result = $con->select($query);
		return $result;
	}
	public function changeInboxStatus($id,$idTracking){
		$con = new Connect();
		$setDelete = "UPDATE location SET canbedeleted = 1 WHERE idTracking = $idTracking and idAccounts = $id";
		$resultSet = $con->update($setDelete);
		$query = "UPDATE location  SET status ='RECEIVED' WHERE idAccounts = $id and idTracking = $idTracking";
		$result = $con->update($query);
		if($result){
	 		//checking 
	 		$check = "SELECT count(*) as counter FROM location JOIN tracking ON tracking.idTracking = location.idTracking WHERE tracking.idTracking = $idTracking and location.Status != 'RECEIVED';";
	 		$checkResult = $con->select($check);
	 		if($checkResult){
	 			$row = $checkResult->fetch_assoc();
	 			if($row['counter']==0){
	 				$doneQuery = "UPDATE tracking SET Status='DONE' WHERE idTracking = $idTracking";
	 				$resultDone = $con->update($doneQuery);
	 			}
	 		}
	 		return $result;
	 	}
	 	else
	 		return null;
		return $result;
	}
	 public function replyByIdTracking($id,$trackingNumber,$receiverId,$title,$message,$idTracking){
	 	$con = new Connect();
	 	$query = "INSERT INTO inbox_info(title,message) VALUES('$title','$message')";
	 	$result = $con->insertReturnLastId($query);
	 	$query = "INSERT INTO reply(idAccounts,idinbox_info,trackingNumber) VALUES($id,$result,'$trackingNumber')";
	 	$result = $con->insertReturnLastId($query);
	 	$query = "INSERT INTO location(idreply,idAccounts,canbedeleted) VALUES($result,$receiverId,1)";
	 	$result = $con->insert($query);
		return $result;
	}
	public function deleteInbox($idlocation,$del){
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
	public function checkIfRead($idTracking,$id){
		$con = new Connect();
		$query = "SELECT isopen FROM location JOIN tracking ON tracking.idTracking = location.idTracking WHERE tracking.idTracking = $idTracking and location.idAccounts = $id";
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
			$resultDelete = $con->update($queryDelete);
				if($resultUpdate){
		 		//checking 
			 		$check = "SELECT count(*) as counter FROM location JOIN tracking ON tracking.idTracking = location.idTracking WHERE tracking.idTracking = $idTracking and location.Status != 'RECEIVED';";
			 		$checkResult = $con->select($check);
			 		if($checkResult){
			 			$row = $checkResult->fetch_assoc();
			 			if($row['counter']==0){
			 				$doneQuery = "UPDATE tracking SET Status='DONE' WHERE idTracking = $idTracking";
			 				$resultDone = $con->update($doneQuery);
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

}
?>