<?php
session_start();
require("../config/config.php");
require("../Handlers/EventHandler.php");
require("../Handlers/SMSHandler.php");
require("../Mailer/PHPMailerAutoload.php");
<<<<<<< HEAD

require("../AuditTrail.php");
=======
require("../Handlers/AuditTrail.php");
>>>>>>> 3948658be4b891cbf59b30141d9706b378bddd83
$audit = new AuditTrail();
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
		$datetime = explode(' - ', $_POST['datetime']);
		
		$idAccounts = $_SESSION['idEvent']; //SESSION

		$uploadOk=0;
		$doneUpload=0;

		
		if($_FILES['fileUploaded']['size']!=0 && $_FILES['fileUploaded']['size'] < 20000000000000000000){
			$temp = explode(".", $_FILES["fileUploaded"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$target_file = $target_dir . $newfilename;
		 	$check = getimagesize($_FILES["fileUploaded"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        $uploadOk = 0;
		    }
		    if ($_FILES["fileUploaded"]["size"] > 2000000000000000000) {
		    	$uploadOk = 0;
			}
			if (move_uploaded_file($_FILES["fileUploaded"]["tmp_name"], $target_file)) {
		   		$doneUpload=1;
		    } 
		    else {
		       	$doneUpload=0;
		    }


		    $EventId=$handler->addEvent($eventName,$eventLocation,$eventDetails,$datetime[0],$datetime[1],$target_file,$idAccounts);
			if($EventId != ""){
				foreach($_POST['checkbox'] as $idAccounts){
					$result = $handler->addRecipient($EventId,$idAccounts,$eventName,$eventLocation,$datetime[0],$datetime[1]);
					echo $result;
				} 

				$audit->trail('ADD EVENT; ID: '.$EventId,'SUCCESSFUL',$idAccounts);
			}
			else{
				$audit->trail('ADD EVENT; ID: '.$EventId,'FAILED',$idAccounts);
			}

		}

		else{
			echo "asd";
		}
	}

	else{
		echo "<script> window.location = 'COOP_AddEvent.php';alert('Event Already Exist!');</script>";
	}	
}
?>