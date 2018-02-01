<?php
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['idevent'])){
	if(isset($_POST['idinfo'])){
		$lastname = mysqli_real_escape_string($con,stripcslashes(trim($_POST['lastname'])));
		$firstname = mysqli_real_escape_string($con,stripcslashes(trim($_POST['firstname'])));
		$middlename = mysqli_real_escape_string($con,stripcslashes(trim($_POST['middlename'])));
		$number = mysqli_real_escape_string($con,stripcslashes(trim($_POST['number'])));
		$email = mysqli_real_escape_string($con,stripcslashes(trim($_POST['email'])));
		$idinfo = $_POST['idinfo'];
		echo $handler->updateInfo($idinfo,$firstname,$lastname,$middlename,$number,$email);
	}
	else{
		$password = mysqli_real_escape_string($con,stripcslashes(trim($_POST['password'])));
		$dept = $_POST['ddlDepartment'];
		$id=$_POST['id'];
		echo $handler->updateAccount($id,$password,$dept);
	}
}
?>