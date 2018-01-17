<?php
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_POST['txtUsername'])){
	//respondents
	$lastName = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtLastName'])));
	$firstName = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtFirstName'])));
	$middleName = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtMiddleName'])));
	$position = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtPosition'])));
	$contactNumber = mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtPhone'])));
	$respondentEmailAddress= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEmail'])));
	$respondentName = $lastName.", ".$firstName." ".$middleName;
	//cooperative profile

	$coopName= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtCoopName'])));
	$address= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtAddress'])));
	$telephoneNumber= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTelephone'])));
	$emailAddress= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtEmail1'])));
	$cda= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtCDA'])));
	$dateOfRegistration= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtDateOfRegistration'])));
	$cin= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtCIN'])));
	$cooperativeType= mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlTypeOfCooperative'])));
	$membership= mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlCommonBondOfMembership'])));
	$affiliation= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtAffiliation'])));
	$areaOfOperation= mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlAreaOfOperation'])));

	//organizational aspect
	$numberOfBoardOfDirectors= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtNumberOfBoardOfDirectors'])));
	$numberOfEmployees= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtNumberOfEmployees'])));
	$chairman= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBODChairman'])));
	$manager= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtManager'])));
	$viceChairman= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBODViceChair'])));
	$secretary= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtSecretary'])));
	$audit= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtAuditCommitteeChair'])));
	$treasurer= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTreasurer'])));
	$electionChairman= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtElectionCommitteeChairman'])));
	$creditChairman= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtCreditCommitteeChairman'])));
	$med= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtMedAndConcilliation'])));
	$otherCommittees= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtOtherCommittees'])));
$dateOfgeneralMeeting= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtDateofRegularGeneralAssemblyMeeting'])));
	$dateOfMonthlyMeeting= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtDateofMonthlyBoardMeeting'])));
	$dateOfCommitteeMeeting= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtDateofCommitteeMeeting'])));

	//business/financial operation
	$businessEngaged= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBusinessEnagagedIn'])));
	$otherBusiness= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtOtherBusiness'])));
	$serviceBenefits= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtServicesBenefitsOfferedtoMembers'])));
	$totalCoopAsset= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTotalCooperativeAsset'])));
	$totalPaidUp= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTotalPaidUpCapital'])));
	$beginningCoop= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBeginning'])));
	$beginningPaidUp= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBeginning1'])));
	$toDateCoop= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtToDate'])));
	$toDatePaidUp= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtToDate1'])));
	$assistingFinancial= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtAssistingFinancialInstitution'])));
	$totalVolumeOfSales= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTotalVolumeOfSales'])));

	//regulatory requirements
	$bir= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtUpdatedBIRNumber'])));
	$tin= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTIN'])));
	$businessPermit= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBusinessPermitNumber'])));
	$coc= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtCOCNumber'])));
	$certificate= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtCertificateOfTaxExemptionNumber'])));
	$dateIssueOfCoc= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtDateOfIssueCOC'])));

	//membership profile
	$numberOfMembership= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtTotalNumberOfMembership'])));
	$totalMale= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtMale'])));
	$totalFemale= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtFemale'])));
	$numberOfRegularMembers= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtNumberOfRegularMembers'])));
	$numberOfAssociate= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtNumberOfAssociateMembers'])));
	$membershipComposition= mysqli_real_escape_string($con,stripcslashes(trim($_POST['ddlMembershipComposition'])));
	$basicTrainingsOfMembers= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBasicTrainingsAttendedByMembers'])));
$basicTrainingsOfOfficers= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBasicTrainingsAttendedByOfficers'])));
$basicTraningsOfMgt= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtBasicTrainingsAttendedByManagementStaff'])));

	//account profile
	$username= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtUsername'])));
	$password= mysqli_real_escape_string($con,stripcslashes(trim($_POST['txtPassword'])));

	//insert respondent and return id
	$respondentId = $handler->addRespondent($respondentName,$contactNumber,$position,$respondentEmailAddress);
	if($respondentId!=""){
		//insert org aspect
		$orgAspectId = $handler->addOrganizationalAspect($numberOfBoardOfDirectors,$numberOfEmployees,$chairman,$viceChairman,$manager,$secretary,$audit,$treasurer,$electionChairman,$med,$otherCommittees,$dateOfgeneralMeeting,$dateOfMonthlyMeeting,$dateOfCommitteeMeeting);

		if($orgAspectId!=""){
			//regulatory requirements
			$regulatoryId = $handler-> addRegulatoryRequirements($bir,$tin,$businessPermit,$coc,$dateIssueOfCoc,$certificate);

			if($regulatoryId !=""){
				//membership profile
				$membershipId = $handler ->addMemberProfile($numberOfMembership,$totalMale,$totalFemale,$numberOfRegularMembers,$numberOfAssociate,$basicTrainingsOfMembers,$basicTrainingsOfOfficers,$basicTraningsOfMgt,
					$membershipComposition);
				if($membershipId!=""){
					//business financial
					$paidUpId = $handler -> addPaidUpCapital($totalPaidUp,$beginningPaidUp,$toDatePaidUp);
					if($paidUpId!=""){
						$coopAssetId = $handler ->addCoopAsset($totalCoopAsset,$beginningCoop,$toDateCoop);
						if($coopAssetId!=""){
							$businessOperationId = $handler->addBusinessOperation($businessEngaged,$otherBusiness,$serviceBenefits,$paidUpId,$coopAssetId,$assistingFinancial);
							if($businessOperationId!=""){
								$cooperativeId = $handler->addCooperative($coopName,$address,$telephoneNumber,$emailAddress,$cda,$dateOfRegistration,$cin,$orgAspectId,$respondentId,$businessOperationId,$membership,$membershipId,$affiliation,$regulatoryId,$cooperativeType,$areaOfOperation);
								if($cooperativeId!=""){
									$result = $handler->addCoopAccount($username,$password,$cooperativeId);
									if($result){
										echo "<script>
											window.location = 'CCDO_AddCooperativeAccount.php';
											alert('Success');
											</script>";
									}
									else{
										"<script>alert('error coopaccount');</script>";
									}
								}
								else
									echo "<script>alert('error addCoop');</script>";
							}
							else
								echo "<script>alert('error businessOperationId');</script>";
						}
						else
							echo "<script>alert('error coopAssetId');</script>";
					}
					else
						echo "<script>alert('error paidUpId');</script>";
				}
				else
					echo "<script>alert('error membershipId');</script>";
			 }
			else
				echo "<script>alert('error regulatoryId');</script>";
		}
		else
			echo "<script>alert('error orgAspectId');</script> ";
	}
	else
		echo "<script>alert('error respondent');</script> ";
}
?>