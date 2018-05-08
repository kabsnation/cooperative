<?php
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['txtUsername'])){
	$userName= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtUsername'])));
	$checkUsername = $handler->checkUsername($userName);
	if($checkUsername==NULL)
		echo "0";
	else
		echo "1";
}
?>