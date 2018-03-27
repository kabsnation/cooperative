<?php
session_start();
$id = $_SESSION['idsetup'];
require("../Handlers/AccountHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
$handler = new AccountHandler();
$audit = new AuditTrail();
$conn = new Connect();
$con=$conn->connectDB();
if(isset($_SESSION['idsetup'])){
	$username= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtUsername'])));
	$checkUsername = $handler->checkUsername($username);
	if($checkUsername==NULL){
		$lastname = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtLastName'])));
		$firstname = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtFirstName'])));
		$middlename = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtMiddleName'])));
		$email =  mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEmail'])));
		$cellphonenumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtPhone'])));
		$password = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtPassword'])));

		$result = $handler-> updateAdmin($id,$firstname,$lastname,$middlename,$cellphonenumber,$email,$username,$password);
		if($result)
			echo '<script>window.location = "index.php";alert("Success!");</script>';
	}
}
?>