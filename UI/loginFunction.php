<?php
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$conn = new Connect();
$con=$conn->connectDB();
if(isset($_POST["username"])&&isset($_POST["password"])){
	$username= mysqli_real_escape_string($con,stripcslashes(trim($_POST["username"])));
	$password=mysqli_real_escape_string($con,stripcslashes(trim($_POST["password"])));
	$results=$handler->getAccount($username,$password);
	session_start();
	if(isset($results)){
		foreach ($results as $result) {
			if($result['idaccount_type']==1){
				$_SESSION["idSuperAdmin"]= $result["idAccounts"];
				echo "<script> window.location='';</script>";
			}
			else if($result['idaccount_type']==2){
				$_SESSION["idAccountAdmin"]= $result["idAccounts"];
				echo "<script> window.location='CCDO_AddCooperativeAccount.php'</script>";
			}
			else if($result['idaccount_type']==3){
				$_SESSION["idAccount"]= $result["idAccounts"];
				echo "<script> window.location='COOP_AddDocument.php'</script>";
			}
		}
	}
	else{
		echo '<script type="text/javascript">
		alert("Login Failed");window.location="index.php"</script> ';
	}
	
}
?>