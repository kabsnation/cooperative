<?php 
session_start();
require("../config/config.php");
require("../Handlers/ServiceRequestHandler.php");
require("../Handlers/AuditTrail.php");
$audit = new AuditTrail();
$handler = new ServiceRequestHandler();
$connect = new Connect();
$con = $connect-> connectDB();


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
	$others = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtOthers'])));
	$datecreated = date("m/d/Y");
	$timecreated = date("h:i:sa");

	$RequestId=$handler->addRequest($contactperson,$contactnumber,$email,$address,$date,$time,$organization,$participants,$requestedservice,$others,$datecreated,$timecreated);


}
else
echo "asdasdasda";
?>