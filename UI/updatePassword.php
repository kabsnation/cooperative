<?php
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['password'])){
	$id= $_POST['id'];
	$password = mysqli_real_escape_string($con,stripcslashes(trim($_POST['password'])));
	$handler->changePassword($id,$password);
}
?>