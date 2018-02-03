<?php
require("../Handlers/EventHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
$audit = new AuditTrail();
$handler = new EventHandler();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['idevent'])){
	
	$location = mysqli_real_escape_string($con,stripcslashes(trim($_POST['location'])));
	$datetime = explode(' - ', $_POST['date']);
	$idevent = $_POST['idevent'];
	echo $handler->updateEvent($idevent,$location,$datetime[0],$datetime[1]);
	
	$audit->trail('UPDATE EVENT; ID: '. $idevent,'SUCCESSFUL','');
	
}
?>