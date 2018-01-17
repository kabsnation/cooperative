<?php
require("../config/config.php");
require("../Handlers/AccountHandler.php");
$handler = new AccountHandler();
$connect = new Connect();
$con = $connect-> connectDB();

if(isset($_POST['txtUsername'])){

	$userName= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtUsername'])));

	$checkUsername = $handler->checkUsername($userName);

	if($checkUsername==NULL){
		$lastName = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtLastname'])));
		$firstName = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtFirstName'])));
		$middleName = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtMiddleName'])));
		$nameSuffix = mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlNameSuffix'])));
		$cellnumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtCellphoneNumber'])));
		$email = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEmail'])));
		$accountType= 3;
		$departmentId = mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlDepartment'])));
		$password= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtPassword'])));

		$accountId=$handler->addDepartmentAccountInfo($firstName,$lastName,$middleName,$nameSuffix,$cellnumber,$email);
		if($accountId!=""){
			$result=$handler->addDepartmentAccount($userName,$password,$accountId,$departmentId,$accountType);
			echo "<script>window.location='CCDO_AddDepartmentAccount.php';alert('Success!');</script>";
		}

	}
	else
		echo "<script>window.location='CCDO_AddDepartmentAccount.php';alert('Username Already Exist!');</script>";
}
?>