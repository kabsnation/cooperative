<?php
require("../config/config.php");
require("../Handlers/EventHandler.php");
$handler = new EventHandler();
$connect = new Connect();
$con = $connect-> connectDB();
$target_dir = "files/";
$target_file = "";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
date_default_timezone_set('Asia/Manila');

if(isset($_POST['txtEventName'])){
	$eventName= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEventName'])));

	$checkEventName = $handler->checkEventName($eventName);

	if($checkEventName==NULL){
		$eventLocation = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEventLocation'])));
		$eventDetails = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEventDetails'])));
		$startDateTime = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtStartDateTime'])));
		$endDateTime = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEndDateTime'])));
		$idAccounts = 1; //SESSION

		$uploadOk=0;
		$doneUpload=0;
		if($_FILES['fileUploaded']['size']!=0){
			$temp = explode(".", $_FILES["fileUploaded"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$target_file = $target_dir . $newfilename;
		 	$check = getimagesize($_FILES["fileUploaded"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        $uploadOk = 0;
		    }
		    if ($_FILES["fileUploaded"]["size"] > 500000) {
		    	$uploadOk = 0;
			}
			if (move_uploaded_file($_FILES["fileUploaded"]["tmp_name"], $target_file)) {
		   		$doneUpload=1;
		    } 
		    else {
		       	$doneUpload=0;
		    }
		}

		$EventId=$handler->addEvent($eventName,$eventLocation,$eventDetails,$startDateTime,$endDateTime,$target_file,$idAccounts);
		
		if($EventId != ""){
			foreach($_POST['checkbox'] as $idAccounts){
				$result = $handler->addRecipient($EventId,$idAccounts);
			} 
		}
		if($result){
			echo "<script>window.location='COOP_AddEvent.php';alert('Success!');</script>";
		}
	}

	else
		echo "<script> window.location = 'COOP_AddEvent.php';alert('Event Already Exist!');</script>";
}
?>