<?php 
// session_start();
require("../config/config.php");
require("../Handlers/EventHandler.php");
require("../Handlers/SMSHandler.php");
require("../Mailer/PHPMailerAutoload.php");
require("../Handlers/MailHandler.php");
require("../Handlers/AuditTrail.php");
$audit = new AuditTrail();
$handler = new EventHandler();
$SMS = new SMSHandler();
$Mail = new MailHandler();
$connect = new Connect();
$con = $connect-> connectDB();
$target_dir = "files/";
$target_file = "";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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

	echo $contactperson;
	echo "\n";
	echo $contactnumber;
	echo "\n";
	echo $email;
	echo "\n";
	echo $address;
	echo "\n";
	echo $date;
	echo "\n";
	echo $time;
	echo "\n";
	echo $organization;
	echo "\n";
	echo $participants;
	echo "\n";
	echo $requestedservice;
}
else
echo "asdasdasda";
?>