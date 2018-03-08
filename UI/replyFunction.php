<?php
date_default_timezone_set('Asia/Manila');
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
require("../Handlers/SMSHandler.php");
require("../Mailer/PHPMailerAutoload.php");
require("../Handlers/MailHandler.php");
require("../Handlers/EventHandler.php");
require("../Handlers/ServiceRequestHandler.php");
require("../Handlers/AuditTrail.php");
$audit = new AuditTrail();
$servicereq = new ServiceRequestHandler();
$conn = new Connect();
$con=$conn->connectDB();
$doc = new DocumentHandler();
$id = $_POST['id'];
date_default_timezone_set('Asia/Manila');
$date = date('m/d/Y h:i:s a', time());
if(!empty($_POST['reply']) && isset($_POST['idTracking']) && isset($_POST['id']) || isset($_POST['idReply'])){

$idTracking =$_POST['idTracking'];
	if($_POST['response']=='1'){
		$response = $_POST['response'];
		$result = $doc->changeInboxStatus($id,$idTracking);
		// check if last receiver
		$last = $doc->checkIfLast($idTracking);
		if($last){
			if($row = $last->fetch_array()){
				if($row[0]==0){// if 0 means all is done, now it will be sent to the super admin
					$doc->addDocumentLocation(1,$idTracking);
				}
			}
		}
		if($result){
			$audit->trail('DOCUMENT RECEIVE; ID: '. $idTracking,'SUCCESSFUL',$id);
			echo "<script>
			window.location='CCDO_ViewMessage.php?idTracking=".$idTracking."';
			alert('Success');
			</script>";
		}
	}
	else{
		$message = mysqli_real_escape_string($con,stripcslashes(trim($_POST['reply'])));
		$id = $_POST['id'];
		$trackingNumber = $_POST['trackingNumber'];
		$receiverId = $_POST['receiverId']; 
		if(strpos($_POST['title'],'reply:')!== false)
			 $title = $_POST['title'];
		else
			 $title = "reply: ".$_POST['title'];
			
		$result = $doc->replyByIdTracking($id,$trackingNumber,$receiverId,$title,$message);
		if($result){
			if($_POST['idTracking']!='null'){
				$result = $doc->changeInboxStatus($id,$idTracking,'REPLIED');
				// check if last receiver
				$last = $doc->checkIfLast($idTracking);
				if($last){
					if($row = $last->fetch_array()){
						if($row[0]==0){// if 0 means all is done, now it will be sent to the super admin
							$doc->addDocumentLocation(1,$idTracking);
						}
						echo $row[0];
					}
				}
				echo "CCDO_ViewMessage.php?idTracking=".$_POST['idTracking']."";
				$audit->trail('DOCUMENT REPLY; ID: '. $_POST['idTracking'],'SUCCESSFUL',$id);
			 }
			 else{
			 	$audit->trail('DOCUMENT REPLY; ID: '. $_POST['idReply'],'FAILED',$id);
				echo "CCDO_ViewMessage.php?idReply=".$_POST['idReply']."";
			 }
		}
	}
	// else if(empty($_POST['idTracking'])){
	// 	$message = mysqli_real_escape_string($con,stripcslashes(trim($_POST['reply'])));
	// 	$id = $_POST['id'];
	// 	$trackingNumber = $_POST['trackingNumber'];
	// 	$receiverId = $_POST['receiverId'];
	// 	if(strpos($_POST['title'],'reply:')!== false)
	// 		 $title = $_POST['title'];
	// 	else
	// 		 $title = "reply: ".$_POST['title'];
	// 	$result = $doc->replyByIdTracking($id,$trackingNumber,$receiverId,$title,$message);
	// 	if($result){
	// 			$audit->trail('DOCUMENT REPLY; ID: '. $_POST['idReply'],'SUCCESSFUL',$id);
	// 			echo "CCDO_ViewMessage.php?idReply=".$_POST['idReply']."";
	// 	}
	// }
}
else if(!empty($_POST['response']) && isset($_POST['idTracking']) && isset($_POST['id'])){
	
$idTracking =$_POST['idTracking'];
	$response = $_POST['response'];
	$result = $doc->changeInboxStatus($id,$idTracking);
	if($result){

		$audit->trail('DOCUMENT RECEIVE; ID: '. $idTracking,'SUCCESSFUL',$id);
		// echo "<script>
		// window.location='CCDO_ViewMessage.php?id=".$idTracking."';
		// alert('Success');
		// </script>";
	}
}
else if($_POST['type']=='events'){
	$reply = $_POST['replyEvent'];
	$idEvents = $_POST['idEvents'];
	$result = $doc->replyEvent($idEvents,$id,$reply);
	$audit->trail('EVENT REPLY; ID: '. $idEvents,'SUCCESSFUL',$id);
}
else if($_POST['type']=='service request'){
	$reply = $_POST['replyEvent'];
	$idservice_request = $_POST['idservice_request'];
	$idlocation = $_POST['idlocation'];
	$message = mysqli_real_escape_string($con,stripcslashes(trim($_POST['reply'])));
	if($id==3 && $reply =='APPROVE'){
		//send to 4 departments
		$servicereq->approve($idservice_request,$id,$idlocation,$message);
		$servicereq->sendToDept($idservice_request);
		$servicereq->addHistory($idlocation,'APPROVE',$date);
	}
	else if($id != 3 && $reply == 'APPROVE'){
		if($message !='' && $message !=' ')
			$servicereq->approve($idservice_request,$id,$idlocation,$message);
		else
			$servicereq->approve($idservice_request,$id,$idlocation);
		$servicereq->addHistory($idlocation,'APPROVE',$date);
	}
	else if($reply=='DISAPPROVE'){
		// send sms and email and get contact number in service request
		if($message !='' && $message != ' '){
			$ye = $servicereq->disapprove($idservice_request,$message);
		}
		else{
			$servicereq->disapprove($idservice_request);
		}
		$servicereq->addHistory($idlocation,'DISAPPROVE',$date);
	}
	$audit->trail('SERVICE REQUEST; ID: '. $idservice_request,$reply,$id);
}
else{

$idTracking =$_POST['idTracking'];
	echo "<script>
		window.location='CCDO_ViewMessage.php?id=".$idTracking."';
		alert('Please add a message for a reply');
		</script>";
}
?>