<?php
require("../Handlers/AccountHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
$handler = new AccountHandler();
$audit = new AuditTrail();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['password'])){
	$id= $_POST['id'];
	$password = mysqli_real_escape_string($con,stripcslashes(trim($_POST['password'])));
	$handler->changePassword($id,$password);
	$audit->trail('UPDATE PASSWORD; ID: '. $id,'SUCCESSFUL',$id);
}
?>