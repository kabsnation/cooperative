<?php
require("../Handlers/AccountHandler.php");
require ("../Handler/AuditTrail.php");
require("../config/config.php");
$handler = new AccountHandler();
$audit = new AuditTrail();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['id'])){
	//update respondent
	$id = $_POST['id'];
	if(isset($_POST['idres'])){
		$idres = $_POST['idres'];
		$lastname = mysqli_real_escape_string($con,stripcslashes(trim($_POST['lastname'])));
		$firstname = mysqli_real_escape_string($con,stripcslashes(trim($_POST['firstname'])));
		$middlename = mysqli_real_escape_string($con,stripcslashes(trim($_POST['middlename'])));
		$rNumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['rNumber'])));
		$number = explode("(+63) ", $rNumber);
		$number = explode("-", $number[1]);
		$number = "0".$number[0].$number[1].$number[2];
		$position = mysqli_real_escape_string($con,stripcslashes(trim($_POST['position'])));
		$rEmail = mysqli_real_escape_string($con,stripcslashes(trim($_POST['rEmail'])));
		$handler->updateRespondent($firstname,$lastname,$middlename,$position,$number,$rEmail,$idres);
		$audit->trail('UPDATE RESPONDENT; ID: '. $idres,'SUCCESSFUL',$id);
	}
	if(isset($_POST['idcoop'])){
		$idcoop = $_POST['idcoop'];
		$coopname = mysqli_real_escape_string($con,stripcslashes(trim($_POST['coopname'])));
		$cAddress = mysqli_real_escape_string($con,stripcslashes(trim($_POST['cAddress'])));
		$cNumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['cNumber'])));
		$cEmail = mysqli_real_escape_string($con,stripcslashes(trim($_POST['cEmail'])));
		$cda = mysqli_real_escape_string($con,stripcslashes(trim($_POST['cda'])));
		$dor = mysqli_real_escape_string($con,stripcslashes(trim($_POST['dor'])));
		$cin = mysqli_real_escape_string($con,stripcslashes(trim($_POST['cin'])));
		$type = mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlTypeOfCooperative'])));
		$bond = mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlCommonBondOfMembership'])));
		$area = mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlAreaOfOperation'])));
		$affiliation = mysqli_real_escape_string($con,stripcslashes(trim($_POST['coopname'])));
		$handler->updateCoopProfile($coopname,$cAddress,$cNumber,$cEmail,$cda,$dor,$cin,$bond,$affiliation,$type,$area,$idcoop);
		$audit->trail('UPDATE COOPERATIVE PROFILE; ID: '. $idcoop,'SUCCESSFUL',$id);
	}
	if(isset($_POST['idorg'])){
		$idorg=$_POST['idorg'];
		$boardnumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['boardnumber'])));
		$employeenumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['employeenumber'])));
		$chairman = mysqli_real_escape_string($con,stripcslashes(trim($_POST['chairman'])));
		$manager = mysqli_real_escape_string($con,stripcslashes(trim($_POST['manager'])));
		$vice = mysqli_real_escape_string($con,stripcslashes(trim($_POST['vice'])));
		$secretary = mysqli_real_escape_string($con,stripcslashes(trim($_POST['secretary'])));
		$audit = mysqli_real_escape_string($con,stripcslashes(trim($_POST['audit'])));
		$treasurer = mysqli_real_escape_string($con,stripcslashes(trim($_POST['treasurer'])));
		$echairman = mysqli_real_escape_string($con,stripcslashes(trim($_POST['echairman'])));
		$cchairman = mysqli_real_escape_string($con,stripcslashes(trim($_POST['cchairman'])));
		$med = mysqli_real_escape_string($con,stripcslashes(trim($_POST['med'])));
		$ocommittee = mysqli_real_escape_string($con,stripcslashes(trim($_POST['ocommittee'])));
		$dorgen = mysqli_real_escape_string($con,stripcslashes(trim($_POST['dorgen'])));
		$domboard = mysqli_real_escape_string($con,stripcslashes(trim($_POST['domboard'])));
		$doc = mysqli_real_escape_string($con,stripcslashes(trim($_POST['domboard'])));
		$handler->updateOrgAspect($boardnumber,$employeenumber,$chairman,$manager,$vice,$secretary,$audit,$treasurer,$echairman,$cchairman,$med,$ocommittee,$dorgen,$domboard,$doc,$idorg);
		$audit->trail('UPDATE ORGANIZATIONAL ASPECT; ID: '. $idorg,'SUCCESSFUL',$id);
	}
	if(isset($_POST['idbus'])){
		$idbus=$_POST['idbus'];
		$engaged = mysqli_real_escape_string($con,stripcslashes(trim($_POST['engaged'])));
		$otherbus = mysqli_real_escape_string($con,stripcslashes(trim($_POST['otherbus'])));
		$benefits = mysqli_real_escape_string($con,stripcslashes(trim($_POST['benefits'])));
		$assisting = mysqli_real_escape_string($con,stripcslashes(trim($_POST['assisting'])));
		$sales = mysqli_real_escape_string($con,stripcslashes(trim($_POST['sales'])));
		$totalasset = mysqli_real_escape_string($con,stripcslashes(trim($_POST['totalasset'])));
		$beginningasset = mysqli_real_escape_string($con,stripcslashes(trim($_POST['beginningasset'])));
		$toasset = mysqli_real_escape_string($con,stripcslashes(trim($_POST['toasset'])));
		$totalcapital = mysqli_real_escape_string($con,stripcslashes(trim($_POST['totalcapital'])));
		$beginningcapital = mysqli_real_escape_string($con,stripcslashes(trim($_POST['beginningcapital'])));
		$tocapital = mysqli_real_escape_string($con,stripcslashes(trim($_POST['tocapital'])));
		$handler->updateBusinessOperation($engaged,$otherbus,$benefits,$assisting,$sales,$totalasset,$beginningasset,$toasset,$totalcapital,$beginningcapital,$tocapital,$idbus);
		$audit->trail('UPDATE BUSINESS OPERATION; ID: '. $idbus,'SUCCESSFUL',$id);
	}
	if(isset($_POST['idreg'])){
		$idreg = $_POST['idreg'];
		$bir = mysqli_real_escape_string($con,stripcslashes(trim($_POST['bir'])));
		$tin = mysqli_real_escape_string($con,stripcslashes(trim($_POST['tin'])));
		$permit = mysqli_real_escape_string($con,stripcslashes(trim($_POST['permit'])));
		$coc = mysqli_real_escape_string($con,stripcslashes(trim($_POST['coc'])));
		$certtax = mysqli_real_escape_string($con,stripcslashes(trim($_POST['certtax'])));
		$doicoc = mysqli_real_escape_string($con,stripcslashes(trim($_POST['doicoc'])));
		$handler->updateRegulatoryRequirements($bir,$tin,$permit,$coc,$certtax,$doicoc,$idreg);
		$audit->trail('UPDATE REGULATORY REQUIREMENTS; ID: '. $idreg,'SUCCESSFUL',$id);
	}
	if(isset($_POST['idmember'])){
		$idmember = $_POST['idmember'];
		$membernumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['membernumber'])));
		$male = mysqli_real_escape_string($con,stripcslashes(trim($_POST['male'])));
		$female = mysqli_real_escape_string($con,stripcslashes(trim($_POST['female'])));
		$regularmember = mysqli_real_escape_string($con,stripcslashes(trim($_POST['regularmember'])));
		$associatemember = mysqli_real_escape_string($con,stripcslashes(trim($_POST['associatemember'])));
		$membertrainings = mysqli_real_escape_string($con,stripcslashes(trim($_POST['membertrainings'])));
		$officertrainings = mysqli_real_escape_string($con,stripcslashes(trim($_POST['officertrainings'])));
		$stafftrainings = mysqli_real_escape_string($con,stripcslashes(trim($_POST['stafftrainings'])));
		$composition = $_POST['ddlMembershipComposition'];
		$handler->updateMembershipProfile($membernumber,$male,$female,$regularmember,$associatemember,$membertrainings,$officertrainings,$stafftrainings,$composition,$idmember);

		$audit->trail('UPDATE MEMBERSHIP PROFILE; ID: '. $idmember,'SUCCESSFUL',$id);
	}
}
?>