<?php
class AccountHandler{
	public function getAccount($userName,$password){
		$con = new Connect();
		$query = "SELECT * FROM Accounts WHERE userName='".$userName."' AND password ='" .$password."'";
		$result = $con->select($query);
		return $result;
	}
	public function getAccountById($id){
		$con = new Connect();
		$query = "select *,COALESCE (department,cooperative_name,concat(first_name,' ', last_name)) as name from accounts LEFT OUTER JOIN department ON department.idDepartment = accounts.idDepartment LEFT OUTER JOIN cooperative_profile ON cooperative_profile.idCooperative_Profile = accounts.idCooperative_Profile LEFT OUTER JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info where idAccounts = $id";
		$result = $con->select($query);
		return $result;
	}
	public function getAccountInfo($id){
		$con = new Connect();
		$query = "SELECT * FROM Accounts,Account_Info where Accounts.idAccount_Info = Account_Info.idAccount_Info and idAccounts =".$id;
		$result= $con->select($query);
		return $result;
	}
	public function getDepartmentAccountById($id){
		$query = "SELECT *,Department as name FROM Accounts JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info JOIN department on department.idDepartment = accounts.idDepartment where idAccounts =".$id;
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}
	public function getCoopAccountById($id){
		$query = "SELECT *, coop.Email_Address as cEmail,Cooperative_Name as name, coop_asset.Beginning as beginningasset, coop_asset.To_Date as todateasset, paid_up_capital.Beginning as beginningcapital, paid_up_capital.To_Date as todatecapital FROM Accounts LEFT JOIN cooperative_profile as coop ON accounts.idCooperative_Profile = coop.idCooperative_Profile LEFT JOIN respondent ON respondent.idRespondent = coop.idRespondent LEFT JOIN organizational_aspect as oa ON oa.idOrganizational_Aspect = coop.idOrganizational_Aspect LEFT JOIN business_operation as b ON b.idBusiness_Operation = coop.idBusiness_Operation LEFT JOIN type_of_cooperative as typec ON typec.idType = coop.idType JOIN commonbond_of_membership as com ON com.idCommonBond_of_Membership = coop.idCommonBond_of_Membership LEFT JOIN area_of_operation as area ON area.idarea_of_operation = coop.idarea_of_operation LEFT JOIN membership_composition as mem ON mem.idMembership_composition = coop.idMembership_Profile JOIN regulatory_requirements as reg ON reg.idRegulatory_Requirements = coop.idRegulatory_Requirements JOIN coop_asset ON coop_asset.idCoop_Asset = b.idCoop_Asset JOIN paid_up_capital ON paid_up_capital.idPaid_up_Capital = b.idPaid_up_Capital JOIN membership_profile ON membership_profile.idMembership_Profile = coop.idMembership_Profile where accounts.idCooperative_Profile =$id";
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}
	public function getDepartmentAccounts($id){
		$query = "SELECT * FROM Accounts JOIN account_info ON account_info.idAccount_Info = accounts.idAccount_Info JOIN department on department.idDepartment = accounts.idDepartment where idAccounts !=".$id;
		$con = new Connect();
		$result = $con->select($query);
		return $result;
	}
	public function getCoopAccounts($id){
		$con = new Connect();
		$query = "SELECT * FROM Accounts JOIN cooperative_profile as coop ON accounts.idCooperative_Profile = coop.idCooperative_Profile JOIN respondent ON respondent.idRespondent = coop.idRespondent JOIN organizational_aspect as oa ON oa.idOrganizational_Aspect = coop.idOrganizational_Aspect JOIN business_operation as b ON b.idBusiness_Operation = coop.idBusiness_Operation JOIN type_of_cooperative as typec ON typec.idType = coop.idType JOIN commonbond_of_membership as com ON com.idCommonBond_of_Membership = coop.idCommonBond_of_Membership JOIN area_of_operation as area ON area.idarea_of_operation = coop.idarea_of_operation JOIN membership_profile as mem ON mem.idMembership_Profile = coop.idMembership_Profile JOIN regulatory_requirements as reg ON reg.idRegulatory_Requirements = coop.idRegulatory_Requirements where idAccounts !=".$id;
		$result = $con->select($query);
		return $result;
	}
	public function addCoopAccount($username,$password,$cooperativeId){
		$con = new Connect();
		$query = "INSERT INTO accounts (Username, Password, idCooperative_Profile, idaccount_type) VALUES('".$username."','".$password."','".$cooperativeId."',3)";
		$result = $con->insert($query);
		return $result;
	}
	public function addCooperative($cooperativeName,$address,$telephoneNumber,$emailAddress,$CDA_Reg_No,$Date_of_Reg,$CIN,$orgAspectId,$respondentId,$businessOperationId,$commonBondOfMembershipId,$memberProfileId,$affiliation,$regulatoryId,$coopertaiveType,$areaId){
		$con = new Connect();
		$query = "INSERT INTO Cooperative_Profile(Cooperative_Name,Address,Telephone_Number,Email_Address,CDA_Reg_No,Date_of_Reg,CIN,idRespondent,idOrganizational_Aspect,idBusiness_Operation,idType,idCommonBond_of_Membership,idarea_of_operation,idMembership_Profile,Affilation,idRegulatory_Requirements) VALUES('".$cooperativeName."','".$address."','".$telephoneNumber."','".$emailAddress."','".$CDA_Reg_No."','".$Date_of_Reg."','".$CIN."','".$respondentId."','".$orgAspectId."','".$businessOperationId."','".$coopertaiveType."','".$commonBondOfMembershipId."','".$areaId."','".$memberProfileId."','".$affiliation."','".$regulatoryId."')";
		$cooperativeId = $con->insertReturnLastId($query);
		return $cooperativeId;
	}
	public function addMemberProfile($totalMember,$totalMale,$totalFemale,$numberOfRegular,$numberOfAssociate,$trainingAttendByMember,$trainingAttendByOfficers,$trainingAttendByMgtStaff,$membershipCompositionId){
		$con = new Connect();
		$query = "INSERT INTO Membership_Profile(Total_Number_of_Membership,Total_Male,Total_Female,Number_of_Regular,Number_of_Associate,Training_Attended_by_Member,Training_Attended_by_Officers,Training_Attended_by_Mgt_Staff,idMembership_composition) VALUES('".$totalMember."','".$totalMale."','".$totalFemale."','".$numberOfRegular."','".$numberOfAssociate."','".$trainingAttendByMember."','".$trainingAttendByOfficers."','".$trainingAttendByMgtStaff."','".$membershipCompositionId."')";
		$memberProfileId = $con->insertReturnLastId($query);
		return $memberProfileId;
	}
	public function addRegulatoryRequirements($birNumber,$tin,$businessPermitNumber,$cocNumber,$cocDateOfIssue,$certificateOfTaxExemptionNumber){
		$con = new Connect();
		$query = "INSERT INTO Regulatory_Requirements(BIR_Number,TIN,Business_Permit_Number,COC_Number,COC_Date_of_Issue,Certificate_of_Tax_Exemption_Number) VALUES('".$birNumber."','".$tin."','".$businessPermitNumber."','".$cocNumber."','".$cocDateOfIssue."','"
			.$certificateOfTaxExemptionNumber."')";
		$regulatoryId = $con -> insertReturnLastId($query);
		return $regulatoryId;

	}
	public function addOrganizationalAspect($noOfBoardOfDirectors,$noOfEmployees,$chairman,$viceChairman,$manager,$secretary,$audit,$treasurer,$electionCommitteeChair,$medAndConciliation,$otherCommittee,$dateOfRegularMeeting,$dateOfMonthlyMeeting,$dateOfCommitteeMeeting,$creditChairman){
		$con = new Connect();
		$query="INSERT INTO Organizational_Aspect(No_of_Board_of_Directors,No_of_Employees,BOD_Chairman,Manager,BOD_Vice_Chairman,Secretary,Audit,Treasurer,Election_Committee_Chair,Med_and_Conciliation,Other_Commitees,Date_of_Regular_Meeting,Date_of_Monthly_Meeting,Date_of_Commitee_Meeting,credit_comittee_chair) VALUES('".$noOfBoardOfDirectors."','".$noOfEmployees."','".$chairman."','".$manager."','".$viceChairman."','".$secretary."','".$audit."','".$treasurer."','".$electionCommitteeChair."','".$medAndConciliation."','".$otherCommittee."','".$dateOfRegularMeeting."','".$dateOfMonthlyMeeting."','".$dateOfCommitteeMeeting."','".$creditChairman."')";
		$orgAspectId = $con->insertReturnLastId($query);
		return $orgAspectId;
	}
	public function addRespondent($firstname,$lastname,$middlename,$respondentContactNumber,$position,$respondentEmailAddress){
		$con = new Connect();
		$query = "INSERT INTO Respondent(firstname,lastname,middlename,Contact_Number,Position,Email_Address) VALUES('".$firstname."','$lastname','$middlename','".$respondentContactNumber."','".$position."','".$respondentEmailAddress."')";
		$respondentId = $con->insertReturnLastId($query);
		return $respondentId;
	}
	public function addBusinessOperation($businessEngagedIn,$otherBusiness,$serviceOffered,$paidUpId,$coopAssetId,$assistingFinancialInstitution="",$totalVolumeOfSales=""){
		$con = new Connect();
		$query="INSERT INTO Business_Operation(Business_Engaged_In,Other_Business,Services_Offered_to_Members,idCoop_Asset,idPaid_up_Capital,Assisting_Financial_Institution,volumeofsales) VALUES('".$businessEngagedIn."','".$otherBusiness."','".$serviceOffered."','".$coopAssetId."','".$paidUpId."','".$assistingFinancialInstitution."','".$totalVolumeOfSales."')";
		$businessOperationId = $con->insertReturnLastId($query);
		return $businessOperationId;
	}
	public function addPaidUpCapital($totalPaidUp,$beginningPaidUp,$toDatePaidUp){
		$con = new Connect();
		$query = "INSERT INTO Paid_up_Capital(Total_Paid_up,Beginning,To_Date) VALUES('".$totalPaidUp."','".$beginningPaidUp."','".$toDatePaidUp."')";
		$paidUpId = $con->insertReturnLastId($query);
		return $paidUpId;
	}
	public function addCoopAsset($totalCoopAsset,$beginningAsset,$toDateAsset){
		$con = new Connect();
		$query = "INSERT INTO Coop_Asset(Total_Coop_Asset,Beginning,To_Date) VALUES('".$totalCoopAsset."','".$beginningAsset."','".$toDateAsset."')";
		$coopAssetId =$con->insertReturnLastId($query);
		return $coopAssetId;
	}
	public function getTypeOfCooperative(){
		$con= new Connect();
		$query="SELECT * FROM Type_of_Cooperative ORDER BY Cooperative_Type";
		$result=$con->select($query);
		return $result;
	}
	public function getMembership(){
		$con= new Connect();
		$query="SELECT * FROM CommonBond_of_Membership ORDER BY Membership";
		$result=$con->select($query);
		return $result;
	}
	public function getAreaOfOperation(){
		$con= new Connect();
		$query="SELECT * FROM area_of_operation ORDER BY area";
		$result=$con->select($query);
		return $result;
	}
	public function getMembershipComposition(){
		$con= new Connect();
		$query="SELECT * FROM Membership_composition";
		$result=$con->select($query);
		return $result;
	}

	public function getTypeOfDepartment(){
		$con= new Connect();
		$query="SELECT * FROM Department";
		$result=$con->select($query);
		return $result;
	}

	public function addDepartmentAccountInfo($fisrtName,$lastName,$middleName,$nameSuffix,$cellnumber,$email){
		$con = new Connect();
		$query = "INSERT INTO Account_Info (First_Name, Last_Name, Middle_Name,Name_Suffix,Cellphone_number,Email_Address) VALUES ('" .$fisrtName."','".$lastName."','".$middleName."','".$nameSuffix."','".$cellnumber."','".$email."')";
		$lastId = $con->insertReturnLastId($query);
		return $lastId;
	}

	public function addDepartmentAccount($userName,$password,$accountId,$departmentId,$accountType){
		$con = new Connect();
		$query = "INSERT INTO accounts (Username, Password, idAccount_Info, idDepartment, idaccount_type) VALUES ('" .$userName. "','" .$password. "'," .$accountId. "," .$departmentId. "," .$accountType. ")";
		$result = $con->insert($query);
		return $result;
	}

	public function checkUsername($userName){
		$con = new Connect();
		$query = "SELECT * FROM accounts where Username = '" .$userName."'";
		$result = $con->select($query);
		return $result;
	}
	public function updateRespondent($firstname,$lastname,$middlename,$position,$rNumber,$rEmail,$idres){
		$con = new Connect();
		$query = "UPDATE respondent SET firstname='$firstname',lastname='$lastname',middlename='$middlename',Contact_Number='$rNumber', Position ='$position',Email_Address='$rEmail' WHERE idRespondent = $idres";
		$result = $con->update($query);
	}
	public function updateCoopProfile($coopname,$cAddress,$cNumber,$cEmail,$cda,$dor,$cin,$bond,$affiliation,$type,$area,$idcoop){
		$con = new Connect();
		$query = "UPDATE cooperative_profile SET Cooperative_Name='$coopname',Address='$cAddress',Telephone_Number='$cNumber',Email_Address='$cEmail',CDA_Reg_No='$cda',Date_of_Reg='$dor', CIN='$cin', idType='$type', idCommonBond_of_Membership='$bond',idarea_of_operation='$area',Affiliation ='$affiliation' WHERE idCooperative_Profile = $idcoop";
		$result= $con-> update($query);
		return $query;
	}
	public function updateOrgAspect($boardnumber,$employeenumber,$chairman,$manager,$vice,$secretary,$audit,$treasurer,$echairman,$cchairman,$med,$ocommittee,$dorgen,$domboard,$doc,$idorg){
		$con = new Connect();
		$query = "UPDATE organizational_aspect SET No_of_Board_of_Directors='$boardnumber', No_of_Employees='$employeenumber',
		BOD_Chairman='$chairman',Manager ='$manager', BOD_Vice_Chairman='$vice',Secretary='$secretary', Audit='$audit',Treasurer='$treasurer', Election_Committee_Chair='$echairman',credit_committee_chair='$cchairman', Med_and_Conciliation='$med', Other_Commitees='$ocommittee', Date_of_Regular_Meeting='$dorgen',Date_of_Monthly_Meeting='$domboard',Date_of_Commitee_Meeting='$doc' WHERE idOrganizational_Aspect=$idorg";
		$result = $con->update($query);
	}
	public function updateBusinessOperation($engaged,$otherbus,$benefits,$assisting,$sales,$totalasset,$beginningasset,$toasset,$totalcapital,$beginningcapital,$tocapital,$idbus){
		$con = new Connect();
		$query = "UPDATE business_operation JOIN coop_asset ON business_operation.idCoop_Asset = coop_asset.idCoop_Asset JOIN paid_up_capital ON business_operation.idPaid_up_Capital = paid_up_capital.idPaid_up_Capital SET Business_Engaged_In='$engaged',Other_Business='$otherbus', Services_Offered_to_Members='$benefits', Assisting_Financial_Institution='$assisting', volumeofsales='$sales', Total_Coop_Asset='$totalasset', coop_asset.Beginning='$beginningasset',coop_asset.To_Date='$toasset',Total_Paid_up='$totalcapital', paid_up_capital.Beginning='$beginningcapital', paid_up_capital.To_Date='$tocapital' WHERE idBusiness_Operation=$idbus";
		$result = $con->update($query);
	}
	public function updateRegulatoryRequirements($bir,$tin,$permit,$coc,$certtax,$doicoc,$idreg){
		$con = new Connect();
		$query ="UPDATE regulatory_requirements SET BIR_Number='$bir',TIN='$tin',Business_Permit_Number='$permit',COC_Number='$coc', COC_Date_of_Issue='$doicoc',Certificate_of_Tax_Exemption_Number='$certtax' WHERE idRegulatory_Requirements=$idreg";
		$result = $con->update($query);
	}
	public function updateMembershipProfile($membernumber,$male,$female,$regularmember,$associatemember,$membertrainings,$officertrainings,$stafftrainings,$composition,$idmember){
		$con = new Connect();
		$query = "UPDATE membership_profile SET Total_Number_of_Membership='$membertrainings', Total_Male='$male',Total_Female='$female', Number_of_Regular='$regularmember', Number_of_Associate='$associatemember', Training_Attended_by_Member='$membertrainings', Training_Attended_by_Officers ='$officertrainings', idMembership_composition='$composition' ,Training_Attended_by_Mgt_Staff='$stafftrainings' WHERE idMembership_Profile= $idmember";
		$result = $con->update($query);
	}
}
?>