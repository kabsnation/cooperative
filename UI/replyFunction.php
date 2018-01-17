<?php
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
$conn = new Connect();
$con=$conn->connectDB();
$doc = new DocumentHandler();
$id = $_POST['id'];
$idTracking =$_POST['idTracking'];
if(!empty($_POST['reply']) && isset($_POST['idTracking']) && isset($_POST['id']) || isset($_POST['idReply'])){
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
		if(strpos($_POST['title'],'reply:')!== false)
			 $title = $_POST['title'];
		else
			 $title = "reply: ".$_POST['title'];
		$result = $doc->replyByIdTracking($id,$trackingNumber,$receiverId,$title,$message,$idTracking);
		if($result){
			if($_POST['type']=="reply"){
				echo "<script>
				window.location='CCDO_ViewMessage.php?idReply=".$_POST['idReply']."';
				alert('Success');
				</script>";
			}
			else{
				echo "<script>
				window.location='CCDO_ViewMessage.php?idTracking=".$_POST['idTracking']."';
				alert('Success');
				</script>";
			}
		}
	}
}
else if(!empty($_POST['response']) && isset($_POST['idTracking']) && isset($_POST['id'])){
	
	$response = $_POST['response'];
	$result = $doc->changeInboxStatus($id,$idTracking);
	if($result){
		// echo "<script>
		// window.location='CCDO_ViewMessage.php?id=".$idTracking."';
		// alert('Success');
		// </script>";
	}
}
else{
	echo "<script>
		window.location='CCDO_ViewMessage.php?id=".$idTracking."';
		alert('Please add a message for a reply');
		</script>";
}
?>