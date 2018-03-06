<?php 
session_start();
require("../config/config.php");
require("../Handlers/ServiceRequestHandler.php");
require("../Handlers/AuditTrail.php");
$audit = new AuditTrail();
$handler = new ServiceRequestHandler();
$connect = new Connect();
$con = $connect-> connectDB();
date_default_timezone_set('Asia/Manila');

if(isset($_POST['txtContactPerson'])){
	$contactperson= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtContactPerson'])));
	$contactnumber= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtContactNumber'])));
	$email= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEmail'])));
	$address= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtAddress'])));
	$date= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtActivityDate'])));
	$time= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTime'])));
	$organization= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtOrganization'])));
	$participants= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtExpected'])));
	$requestedservice= mysqli_real_escape_string($con,stripcslashes(trim($_POST['selectRequestedService'])));
	$venue = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtVenue'])));
	$datecreated = date("m/d/Y");
	$timecreated = date("h:i:sa");
	$serviceID= "NULL";
	$idAccounts = "NULL";
	$status="Waiting for confirmation";
	$others = " ";

	if(isset($_SESSION['idEvent'])){
		$idAccounts = $_SESSION['idEvent']; 
	}

	if(isset($_POST['txtOthers'])){
		$others = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtOthers'])));
	}

	if($requestedservice!=7){
		$serviceID=$handler->getServiceId($requestedservice);
	}

	$RequestId=$handler->addRequest($contactperson,$contactnumber,$email,$address,$date,$time,$organization,$participants,$others,$datecreated,$timecreated,$idAccounts,$venue,$serviceID);
	
	if($idAccounts=="NULL"){
		$inbox=$handler->addinbox($status,$RequestId);
	}


	if($RequestId!= ""){
			$audit->trail('ADD REQUEST; ID: '.$RequestId,'SUCCESSFUL',$idAccounts);
	}
	else{
		$audit->trail('ADD EVENT; ID: '.$RequestId,'FAILED',$idAccounts);
	}
}
else
echo "asdasdasda";
?>