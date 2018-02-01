<?php
require("../Handlers/EventHandler.php");
require("../config/config.php");
$handler = new EventHandler();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['idevent'])){
	
	$location = mysqli_real_escape_string($con,stripcslashes(trim($_POST['location'])));
	$datetime = explode(' - ', $_POST['date']);
	$idevent = $_POST['idevent'];
	echo $handler->updateEvent($idevent,$location,$datetime[0],$datetime[1]);
	
}
?>