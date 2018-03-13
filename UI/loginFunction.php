<?php
require("../Handlers/AccountHandler.php");
require("../Handlers/AuditTrail.php");
require("../config/config.php");
$handler = new AccountHandler();
$audit = new AuditTrail();
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
				if($username =='sadmin' && $password='sadmin'){
					$_SESSION["idsetup"]= $result["idAccounts"];
					$arrs[1] ="Account_Setup.php";
				}
				else{
					$_SESSION["idSuperAdmin"]= $result["idAccounts"];
					$arrs[1] ="SuperAdmin_Dashboard.php";	
				}
			}
			else if($result['idaccount_type']==2){
				if($username =='admin' && $password='admin'){
					$_SESSION["idsetup"]= $result["idAccounts"];
					$arrs[1] ="Account_Setup.php";
				}
				else{
					$_SESSION["idAccountAdmin"]= $result["idAccounts"];
					$arrs[1] ="CCDO_AddCooperativeAccount.php";
				}
			}
			else if($result['idaccount_type']==3){
				$_SESSION["idAccount"]= $result["idAccounts"];
				$arrs[1] ="COOP_AddDocument.php";
				
			}
			else if($result['idaccount_type']==4){
				if($username =='event' && $password='event'){
					$_SESSION["idsetup"]= $result["idAccounts"];
					$arrs[1] ="Account_Setup.php";
				}
				else{
					$_SESSION["idEvent"]= $result["idAccounts"];
					$arrs[1] ="COOP_AddEvent.php";
				}
			}
			$arrs[0]= 1;
			$audit->trail('LOGIN ACCCOUNT; ID: '. $result["idAccounts"],'SUCCESSFUL',$username);
			echo json_encode($arrs);
		}
	}
	else{
		$arrs[0]= 0;
		$audit->trail('LOGIN ACCCOUNT;','FAILED',$username);
		echo json_encode($arrs);
	}
	
}
?>