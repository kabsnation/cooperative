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
	$arrs = array();
	if(isset($results)){
		foreach ($results as $result) {
			if($result['idaccount_type']==1){
				$_SESSION["idSuperAdmin"]= $result["idAccounts"];
				$arrs[1] ="SuperAdmin_Dashboard.php";
			}
			else if($result['idaccount_type']==2){
				$_SESSION["idAccountAdmin"]= $result["idAccounts"];
				$arrs[1] ="CCDO_AddCooperativeAccount.php";
			}
			else if($result['idaccount_type']==3){
				$_SESSION["idAccount"]= $result["idAccounts"];
				$arrs[1] ="COOP_AddDocument.php";
			}

			else if($result['idaccount_type']==4){
				$_SESSION["idEvent"]= $result["idAccounts"];
				$arrs[1] ="COOP_AddEvent.php";
			}

			$arrs[0]= 1;
			echo json_encode($arrs);

		}
	}
	else{
		$arrs[0]= 0;
		echo json_encode($arrs);
	}
	
}
?>