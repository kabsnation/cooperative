<?php
date_default_timezone_set('Asia/Manila');
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
$conn = new Connect();
$con=$conn->connectDB();
$doc = new DocumentHandler();
$id = $_POST['id'];
if(!empty($_POST['reply']) && isset($_POST['idTracking']) && isset($_POST['id']) || isset($_POST['idReply'])){

$idTracking =$_POST['idTracking'];
	if($_POST['response']=='1'){
		$response = $_POST['response'];
		$result = $doc->changeInboxStatus($id,$idTracking);
		if($result){
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
		$result = $doc->changeInboxStatus($id,$idTracking,'REPLIED');
		if(strpos($_POST['title'],'reply:')!== false)
			 $title = $_POST['title'];
		else
			 $title = "reply: ".$_POST['title'];
		$result = $doc->replyByIdTracking($id,$trackingNumber,$receiverId,$title,$message,$idTracking);
		if($result){
			if($_POST['type']=="reply"){
				echo "CCDO_ViewMessage.php?idReply=".$_POST['idReply']."";
			}
			else{
				echo "CCDO_ViewMessage.php?idTracking=".$_POST['idTracking']."";
			}
		}
	}
}
else if(!empty($_POST['response']) && isset($_POST['idTracking']) && isset($_POST['id'])){
	
$idTracking =$_POST['idTracking'];
	$response = $_POST['response'];
	$result = $doc->changeInboxStatus($id,$idTracking);
	if($result){
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
}
else{

$idTracking =$_POST['idTracking'];
	echo "<script>
		window.location='CCDO_ViewMessage.php?id=".$idTracking."';
		alert('Please add a message for a reply');
		</script>";
}
?>