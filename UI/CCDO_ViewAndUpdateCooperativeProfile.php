<?php
session_start();
require("../Handlers/AccountHandler.php");
require("../config/config.php");
if(isset($_SESSION['idAccountAdmin'])){
    include('../UI/header/header_admin.php');
}
else if(isset($_SESSION['idSuperAdmin'])){
    include('../UI/header/header_sadmin.php');
}
else 
{ echo "<script>window.location='index.php';</script>";
}
$handler = new AccountHandler();
$typeCooperative = $handler->getTypeOfCooperative();
$membership = $handler->getMembership();
$area = $handler->getAreaOfOperation();
$composition = $handler->getMembershipComposition();
$idCoop = $_GET['id'];
$info = $handler->getCoopAccountById($idCoop);
?>
<form id="form1">
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main Content -->
                <div class="content-wrapper">
                    <div class="content">
                        <?php if($info){
                            foreach($info as $coop){?>
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <h3 class="panel-title"><?php echo $coop['name'];?></h3>
                                </div>
                            </div>               

                            <div class="panel-body">
                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class="icon-user" style="margin-right: 10px"></i>Respondent
                                        <button id="btnEditRespondent" type="button" class="btn btn-primary" style="float: right" onclick="editRespondent()">Edit</button>
                                        <input type="hidden" id="idres" value="1">
                                    </h5>
                                    </legend>
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Last name:</strong></label>
                                                    <input  ID="txtLastName" name='lastname' MaxLength="45" autofocus Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true" value="<?php echo $coop['lastname'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>First name:</strong></label>
                                                    <input  ID="txtFirstName" name='firstname' MaxLength="45" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true" value="<?php echo $coop['firstname'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Middle name:</strong></label>
                                                    <input  ID="txtMiddleName" name='middlename' MaxLength="45" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true" value="<?php echo $coop['middlename'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><span class="text-danger">* </span><strong>Position:</strong></label>
                                                    <input  ID="txtPosition" name='position' MaxLength="45" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true" value="<?php echo $coop['Position'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><span class="text-danger">* </span><strong>Phone Number:</strong></label>
                                                    <input ID="txtPhone" name='rNumber' required="required" class="form-control" readonly="true" value="<?php echo $coop['Contact_Number'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                    <input  ID="txtEmail" name='rEmail' required="required" class="form-control" type="Email" readonly="true" value="<?php echo $coop['Email_Address'];?>"></input>
                                                </div>
                                                
                                                    <?php }}?>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-12" id="optionRespondent" style="display: none;">
                                        <hr/>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-info" id="btnSaveRespondent" onclick="saveRespondent()">Save</button>
                                            <button type="button" class="btn btn-danger" id="btnCancelRespondent" onclick="cancelRespondent()">Cancel</button>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class="icon-file-text3" style="margin-right: 10px"></i>Cooperative Profile
                                        <button id="btnEditCooperativeProfile" type="button" class="btn btn-primary" style="float: right" onclick="editCooperativeProfile()">Edit</button>
                                    </h5></legend>
                                    <input type="hidden" id="idcoop" value="<?php echo $coop['idCooperative_Profile'];?>">
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Business/ Cooperative Name:</strong></label>
                                                    <input  ID="txtCoopName" MaxLength="100" name='coopname' Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true" value="<?php echo $coop['name'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Address:</strong></label>
                                                    <input  ID="txtAddress" MaxLength="100" name='cAddress' Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true" value="<?php echo $coop['Address'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Telephone/ Fax Number:</strong></label>
                                                    <input  ID="txtTelephone" type="Phone" name="cNumber" required="required" class="form-control" readonly="true" value="<?php echo $coop['Telephone_Number'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                    <input  ID="txtEmail1" type="Email" name='cEmail' class="form-control" required="required" readonly="true" value="<?php echo $coop['cEmail'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>CDA Registration Number:</strong></label>
                                                    <input  ID="txtCDA" required="required" name='cda' class="form-control" type="Number" readonly="true" value="<?php echo $coop['CDA_Reg_No'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Registration:</strong></label>
                                                    <input  ID="txtDateOfRegistration" class="form-control" name='dor' required="required" placeholder="mm/dd/yyyy" readonly="true" value="<?php echo $coop['Date_of_Reg'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>CIN:</strong></label>
                                                    <input  ID="txtCIN" class="form-control" name='cin' required="required" type="Number" readonly="true" value="<?php echo $coop['CIN'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Type of Cooperative:</strong></label>
                                                    <select  ID="ddlTypeOfCooperative" name="ddlTypeOfCooperative" required="required" class="form-control" disabled="true">
                                                                   <?php foreach($typeCooperative as $type){
                                                                    if($type['idType'] == $coop['idType']){?>
                                                                   <option value="<?php echo $type['idType'];?>" selected><?php echo $type['Cooperative_Type'];?></option>
                                                                   <?php }
                                                                   else {?>
                                                                   <option value="<?php echo $type['idType'];?>"><?php echo $type['Cooperative_Type'];?></option>
                                                                   <?php }}?>
                                                                </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Common Bond of Membership:</strong></label>
                                                     <select  ID="ddlCommonBondOfMembership" 
                                                                name="ddlCommonBondOfMembership" required="required" class="form-control" disabled="true">
                                                                    <?php foreach($membership as $member){
                                                                        if($member['idCommonBond_of_Membership'] == $coop['idCommonBond_of_Membership']){?>
                                                                   <option value="<?php echo $member['idCommonBond_of_Membership'];?>" selected><?php echo $member['Membership'];?></option>
                                                                   <?php }
                                                                   else{?>
                                                                    <option value="<?php echo $member['idCommonBond_of_Membership'];?>"><?php echo $member['Membership'];?></option>
                                                                    <?php }}?>
                                                                </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Affiliation:</strong></label>
                                                    <input  ID="txtAffiliation" name='affiliation' class="form-control" required="required" onkeyup="Validate(this)" readonly="true" value="<?php echo $coop['Affiliation'];?>"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Area of Operation:</strong></label>
                                                    <select  ID="ddlAreaOfOperation" name="ddlAreaOfOperation" required="required" class="form-control" disabled="true">
                                                                    <?php foreach($area as $operation){
                                                                        if($operation['idarea_of_operation'] == $coop['idarea_of_operation']){?>
                                                                   <option value="<?php echo $operation['idarea_of_operation'];?>" selected><?php echo $operation['area'];?></option>
                                                                   <?php }
                                                                   else{?>
                                                                   <option value="<?php echo $operation['idarea_of_operation'];?>" ><?php echo $operation['area'];?></option>
                                                                   <?php }}?>
                                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionCoopProfile" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveCoopProfile" onclick='saveCoop()'>Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelCoopProfile" onclick="cancelCoopProfile()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-tree6" style="margin-right: 10px"></i>Organizational Aspect (Current Officers)
                                        <button id="btnEditOrganizationalAspect" type="button" class="btn btn-primary" style="float: right" onclick="editOrganizationalAspect()">Edit</button>
                                    </h5></legend>
                                    <input type="hidden" id="idorg" value="<?php echo $coop['idOrganizational_Aspect'];?>">
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Board of Directors:</strong></label>
                                                    <input  ID="txtNumberOfBoardOfDirectors" name='boardnumber' required="required" class="form-control" type="Number" readonly="true" value="<?php echo $coop['No_of_Board_of_Directors'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Employees:</strong></label>
                                                    <input  ID="txtNumberOfEmployees" name='employeenumber' required="required" class="form-control" type="Number" readonly="true" value="<?php echo $coop['No_of_Employees'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>BOD Chairman:</strong></label>
                                                    <input  ID="txtBODChairman" name='chairman' required="required" class="form-control" readonly="true" value="<?php echo $coop['BOD_Chairman'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Manager:</strong></label>
                                                    <input  ID="txtManager" name='manager' required="required" class="form-control" readonly="true" value="<?php echo $coop['Manager'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Educ.Com/ BOD Vice Chair:</strong></label>
                                                    <input  ID="txtBODViceChair" name='vice' required="required" class="form-control" readonly="true" value="<?php echo $coop['BOD_Vice_Chairman'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Secretary:</strong></label>
                                                    <input  ID="txtSecretary" name='secretary' required="required" class="form-control" readonly="true" value="<?php echo $coop['Secretary'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Audit Committee Chairman:</strong></label>
                                                    <input  ID="txtAuditCommitteeChair" name='audit' required="required" class="form-control" readonly="true" value="<?php echo $coop['Audit'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Treasurer:</strong></label>
                                                    <input  ID="txtTreasurer" name='treasurer' required="required" class="form-control" readonly="true" value="<?php echo $coop['Treasurer'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Election Committee Chairman:</strong></label>
                                                    <input  ID="txtElectionCommitteeChairman" name='echairman' required="required" class="form-control" readonly="true"  value="<?php echo $coop['Election_Committee_Chair'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Credit Committee Chairman:</strong></label>
                                                    <input  ID="txtCreditCommitteeChairman" name='cchairman' required="required" class="form-control" readonly="true" value="<?php echo $coop['credit_committee_chair'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Med. & Concilliation:</strong></label>
                                                    <input  ID="txtMedAndConcilliation" name='med' required="required" class="form-control" readonly="true" value="<?php echo $coop['Med_and_Conciliation'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Other Committees:</strong></label>
                                                    <input  ID="txtOtherCommittees" name='ocommittee' required="required" class="form-control" readonly="true" value="<?php echo $coop['Other_Commitees'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Regular General Assembly Meeting:</strong></label>
                                                    <input  ID="txtDateofRegularGeneralAssemblyMeeting" name='dorgen' required="required" class="form-control" readonly="true" value="<?php echo $coop['Date_of_Regular_Meeting'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Monthly Board Meeting:</strong></label>
                                                    <input  ID="txtDateofMonthlyBoardMeeting" name='domboard' required="required" class="form-control" readonly="true" value="<?php echo $coop['Date_of_Monthly_Meeting'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Committee Meeting:</strong></label>
                                                    <input  ID="txtDateofCommitteeMeeting" name='doc' required="required" class="form-control" readonly="true" value="<?php echo $coop['Date_of_Commitee_Meeting'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionOrganizationalAspect" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveOrganizationalAspect" onclick='saveOrgAspect()'>Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelOrganizationalAspect" onclick="cancelOrganizationalAspect()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-stats-bars2" style="margin-right: 10px"></i>Business/ Financial Operation:
                                        <button id="btnEditBusinessOperation" type="button" class="btn btn-primary" style="float: right" onclick="editBusinessOperation()">Edit</button>
                                    </h5></legend>
                                    <input type="hidden" id="idbus" value="<?php echo $coop['idBusiness_Operation'];?>">
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Business Enagaged In:</strong></label>
                                                    <input  ID="txtBusinessEnagagedIn" name="engaged" required="required" class="form-control" readonly="true" value="<?php echo $coop['Business_Engaged_In'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Other Business:</strong></label>
                                                    <input  ID="txtOtherBusiness" name="otherbus" class="form-control" readonly="true" value="<?php echo $coop['Other_Business'];?>"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Services/Benefits Offered to Members:</strong></label>
                                                    <input  ID="txtServicesBenefitsOfferedtoMembers" name="benefits" required="required" class="form-control" readonly="true" value="<?php echo $coop['Services_Offered_to_Members'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Total Cooperative Asset:</strong></label>
                                                    <input  ID="txtTotalCooperativeAsset" name="totalasset" type="Number" required="required" class="form-control" readonly="true" value="<?php echo $coop['Total_Coop_Asset'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Total Paid-up Capital:</strong></label>
                                                    <input  ID="txtTotalPaidUpCapital" name="totalcapital" type="Number" required="required" class="form-control" readonly="true" value="<?php echo $coop['Total_Paid_up'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Beginning: </strong></label>
                                                    <input  ID="txtBeginning" required="required" name="beginningasset" class="form-control" readonly="true" value="<?php echo $coop['beginningasset'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Beginning:</strong></label>
                                                    <input  ID="txtBeginning1" required="required" name="beginningcapital" class="form-control" readonly="true" value="<?php echo $coop['beginningcapital'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>To Date: </strong></label>
                                                    <input  ID="txtToDate" required="required" name="toasset" class="form-control" readonly="true" value="<?php echo $coop['todateasset'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>To Date:</strong></label>
                                                    <input  ID="txtToDate1" required="required" name="tocapital" class="form-control" readonly="true" value="<?php echo $coop['todatecapital'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><strong>Assisting Financial Institution, if any:</strong></label>
                                                    <input  ID="txtAssistingFinancialInstitution" name="assisting" class="form-control" readonly="true" value="<?php echo $coop['Assisting_Financial_Institution'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><strong>Total Volume of Sales based in Latest Financial Statement (with Members/Non-Members):</strong></label>
                                                    <input  ID="txtTotalVolumeOfSales" name="sales" required="required" class="form-control" readonly="true" value="<?php echo $coop['volumeofsales'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionBusinessOperation" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveBusinessOperation" onclick="saveBusinessOperation()">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelBusinessOperation" onclick="cancelBusinessOperation()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-clipboard5" style="margin-right: 10px"></i>Regulatory Requirements
                                        <button id="btnEditRegulatoryRequirements" type="button" class="btn btn-primary" style="float: right" onclick="editRegulatoryRequirements()">Edit</button>
                                    </h5></legend>
                                    <input type="hidden" id="idreg" value="<?php echo $coop['idRegulatory_Requirements'];?>">
                                    <div class="col-lg-12">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Updated BIR Registration Number:</strong></label>
                                                    <input  ID="txtUpdatedBIRNumber" name='bir' required="required" class="form-control" readonly="true"  value="<?php echo $coop['BIR_Number'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Tax Identification Number (TIN):</strong></label>
                                                    <input  ID="txtTIN" required="required" name='tin' class="form-control" readonly="true" value="<?php echo $coop['TIN'];?>"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Business Permit Number:</strong></label>
                                                    <input  ID="txtBusinessPermitNumber" name='permit' required="required" class="form-control" readonly="true" value="<?php echo $coop['Business_Permit_Number'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>COC Number (CDA):</strong></label>
                                                    <input  ID="txtCOCNumber" required="required" name='coc' class="form-control" readonly="true" value="<?php echo $coop['COC_Number'];?>"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Certificate of Tax Exemption Number:</strong></label>
                                                    <input  ID="txtCertificateOfTaxExemptionNumber" name='certtax' required="required" class="form-control" readonly="true" value="<?php echo $coop['Certificate_of_Tax_Exemption_Number'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Issue (COC):</strong></label>
                                                    <input  ID="txtDateOfIssueCOC" required="required" name='doicoc' class="form-control" readonly="true"  value="<?php echo $coop['COC_Date_of_Issue'];?>"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-12" id="optionRegulatoryRequirements" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="optionRegulatoryRequirements" onclick="saveRegulatoryRequirements()">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelRegulatoryRequirements" onclick="cancelRegulatoryRequirements()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-stack-text" style="margin-right: 10px"></i>Membership Profile
                                        <button id="btnEditMembershipProfile" type="button" class="btn btn-primary" style="float: right" onclick="editMembershipProfile()">Edit</button>
                                    </h5></legend>
                                    <input type="hidden" id="idmember" value="<?php echo $coop['idMembership_Profile'];?>">
                                    <div class="col-lg-12">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Total Number of Membership:</strong></label>
                                                    <input  ID="txtTotalNumberOfMembership" name='membernumber' required="required" class="form-control" readonly="true" value="<?php echo $coop['Total_Number_of_Membership'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Male:</strong></label>
                                                    <input  ID="txtMale" required="required" name='male' class="form-control" readonly="true" value="<?php echo $coop['Total_Male'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Female:</strong></label>
                                                    <input  ID="txtFemale" required="required" name='female' class="form-control" readonly="true" value="<?php echo $coop['Total_Female'];?>"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Regular Members:</strong></label>
                                                    <input  ID="txtNumberOfRegularMembers" name='regularmember' required="required" class="form-control" readonly="true"  value="<?php echo $coop['Number_of_Regular'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Associate Members:</strong></label>
                                                    <input  ID="txtNumberOfAssociateMembers" name='associatemember' required="required" class="form-control" readonly="true" value="<?php echo $coop['Number_of_Associate'];?>"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Membership Composition:</strong></label>
                                                     <select  ID="ddlMembershipComposition" 
                                                                name="ddlMembershipComposition" required="required" class="form-control" disabled="true">
                                                                    <?php foreach($composition as $comp){?>
                                                                    <option value="<?php echo $comp['idMembership_composition'];?>"><?php echo $comp['Composition'];?></option>
                                                                    <?php }?>
                                                                </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Members:</strong></label>
                                                    <input  ID="txtBasicTrainingsAttendedByMembers" name='membertrainings' required="required" class="form-control" readonly="true" value="<?php echo $coop['Training_Attended_by_Member'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Officers:</strong></label>
                                                    <input  ID="txtBasicTrainingsAttendedByOfficers" name='officertrainings' required="required" class="form-control" readonly="true" value="<?php echo $coop['Training_Attended_by_Officers'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Management Staff:</strong></label>
                                                    <input  ID="txtBasicTrainingsAttendedByManagementStaff" name='stafftrainings' required="required" class="form-control" readonly="true" value="<?php echo $coop['Training_Attended_by_Mgt_Staff'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionMembershipProfile" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnEditMembershipProfile" onclick="saveMembershipProfile()">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnEditMembershipProfile" onclick="cancelMembershipProfile()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-user-lock" style="margin-right: 10px"></i>Account Profile
                                    </h5></legend>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Username:</strong></label>
                                                    <input  ID="txtUsername" required="required" class="form-control" MaxLength="40" readonly="true" value="<?php echo $coop['Username'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Password:</strong></label>
                                                    <input  ID="txtPassword" type="Password" required="required" class="form-control" MinLength="6" MaxLength="40" readonly="true"  value="<?php echo $coop['password'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Re-enter Password:</strong></label>
                                                    <input  ID="txtPassword1" type="Password" required="required" class="form-control" MinLength="6" MaxLength="40" equalsTo="txtPassword" readonly="true" value="<?php echo $coop['password'];?>"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <br />
                                        <br />

                                    </div>
                                </fieldset>

                            </div>

                        </div>

                    </div>
                </div>
                <!-- /Main Content -->

            </div>
            <!-- /Page content -->

        </div>
        <!-- /Page container -->

        <script type="text/javascript">
            function cancel(){
                window.location = window.location;
            }
            function editRespondent(){
                var x = document.getElementById("btnEditRespondent");
                var y = document.getElementById("optionRespondent");
                x.style.display = "none";
                y.style.display = "block";
                $('#txtLastName').prop('readonly', false);
                $('#txtFirstName').prop('readonly', false);
                $('#txtMiddleName').prop('readonly', false);
                $('#txtPosition').prop('readonly', false);
                $('#txtPhone').prop('readonly', false);
                $('#txtEmail').prop('readonly', false);
            }

            function cancelRespondent(){
                var x = document.getElementById("btnEditRespondent");
                var y = document.getElementById("optionRespondent");
                x.style.display = "block";
                y.style.display = "none";
                $('#txtLastName').prop('readonly', true);
                $('#txtFirstName').prop('readonly', true);
                $('#txtMiddleName').prop('readonly', true);
                $('#txtPosition').prop('readonly', true);
                $('#txtPhone').prop('readonly', true);
                $('#txtEmail').prop('readonly', true);
                cancel();
            }

            function editCooperativeProfile(){
                var x = document.getElementById("btnEditCooperativeProfile");
                var y = document.getElementById("optionCoopProfile");
                x.style.display = "none";
                y.style.display = "block";
                $('#txtCoopName').prop('readonly', false);
                $('#txtAddress').prop('readonly', false);
                $('#txtTelephone').prop('readonly', false);
                $('#txtEmail1').prop('readonly', false);
                $('#txtCDA').prop('readonly', false);
                $('#txtDateOfRegistration').prop('readonly', false);
                $('#txtCIN').prop('readonly', false);
                $('#ddlTypeOfCooperative').prop('disabled', false);
                $('#ddlCommonBondOfMembership').prop('disabled', false);
                $('#txtAffiliation').prop('readonly', false);
                $('#ddlAreaOfOperation').prop('disabled', false);
            }

            function cancelCoopProfile(){
                var x = document.getElementById("btnEditCooperativeProfile");
                var y = document.getElementById("optionCoopProfile");
                x.style.display = "block";
                y.style.display = "none";
                $('#txtCoopName').prop('readonly', true);
                $('#txtAddress').prop('readonly', true);
                $('#txtTelephone').prop('readonly', true);
                $('#txtEmail1').prop('readonly', true);
                $('#txtCDA').prop('readonly', true);
                $('#txtDateOfRegistration').prop('readonly', true);
                $('#txtCIN').prop('readonly', true);
                $('#ddlTypeOfCooperative').prop('disabled', true);
                $('#ddlCommonBondOfMembership').prop('disabled', true);
                $('#txtAffiliation').prop('readonly', true);
                $('#ddlAreaOfOperation').prop('disabled', true);
                cancel();
            }

            function editOrganizationalAspect(){
                var x = document.getElementById("btnEditOrganizationalAspect");
                var y = document.getElementById("optionOrganizationalAspect");
                x.style.display = "none";
                y.style.display = "block";
                $('#txtNumberOfBoardOfDirectors').prop('readonly', false);
                $('#txtNumberOfEmployees').prop('readonly', false);
                $('#txtBODChairman').prop('readonly', false);
                $('#txtManager').prop('readonly', false);
                $('#txtBODViceChair').prop('readonly', false);
                $('#txtSecretary').prop('readonly', false);
                $('#txtAuditCommitteeChair').prop('readonly', false);
                $('#txtTreasurer').prop('readonly', false);
                $('#txtElectionCommitteeChairman').prop('readonly', false);
                $('#txtCreditCommitteeChairman').prop('readonly', false);
                $('#txtMedAndConcilliation').prop('readonly', false);
                $('#txtOtherCommittees').prop('readonly', false);
                $('#txtDateofRegularGeneralAssemblyMeeting').prop('readonly', false);
                $('#txtDateofMonthlyBoardMeeting').prop('readonly', false);
                $('#txtDateofCommitteeMeeting').prop('readonly', false);
            }

            function cancelOrganizationalAspect(){
                var x = document.getElementById("btnEditOrganizationalAspect");
                var y = document.getElementById("optionOrganizationalAspect");
                x.style.display = "block";
                y.style.display = "none";
                $('#txtNumberOfBoardOfDirectors').prop('readonly', true);
                $('#txtNumberOfEmployees').prop('readonly', true);
                $('#txtBODChairman').prop('readonly', true);
                $('#txtManager').prop('readonly', true);
                $('#txtBODViceChair').prop('readonly', true);
                $('#txtSecretary').prop('readonly', true);
                $('#txtAuditCommitteeChair').prop('readonly', true);
                $('#txtTreasurer').prop('readonly', true);
                $('#txtElectionCommitteeChairman').prop('readonly', true);
                $('#txtCreditCommitteeChairman').prop('readonly', true);
                $('#txtMedAndConcilliation').prop('readonly', true);
                $('#txtOtherCommittees').prop('readonly', true);
                $('#txtDateofRegularGeneralAssemblyMeeting').prop('readonly', true);
                $('#txtDateofMonthlyBoardMeeting').prop('readonly', true);
                $('#txtDateofCommitteeMeeting').prop('readonly', true);
                cancel();
            }

            function editBusinessOperation(){
                var x = document.getElementById("btnEditBusinessOperation");
                var y = document.getElementById("optionBusinessOperation");
                x.style.display = "none";
                y.style.display = "block";
                $('#txtBusinessEnagagedIn').prop('readonly', false);
                $('#txtOtherBusiness').prop('readonly', false);
                $('#txtServicesBenefitsOfferedtoMembers').prop('readonly', false);
                $('#txtTotalCooperativeAsset').prop('readonly', false);
                $('#txtTotalPaidUpCapital').prop('readonly', false);
                $('#txtBeginning').prop('readonly', false);
                $('#txtBeginning1').prop('readonly', false);
                $('#txtToDate').prop('readonly', false);
                $('#txtToDate1').prop('readonly', false);
                $('#txtAssistingFinancialInstitution').prop('readonly', false);
                $('#txtTotalVolumeOfSales').prop('readonly', false);
            }

            function cancelBusinessOperation(){
                var x = document.getElementById("btnEditBusinessOperation");
                var y = document.getElementById("optionBusinessOperation");
                x.style.display = "block";
                y.style.display = "none";
                $('#txtBusinessEnagagedIn').prop('readonly', true);
                $('#txtOtherBusiness').prop('readonly', true);
                $('#txtServicesBenefitsOfferedtoMembers').prop('readonly', true);
                $('#txtTotalCooperativeAsset').prop('readonly', true);
                $('#txtTotalPaidUpCapital').prop('readonly', true);
                $('#txtBeginning').prop('readonly', true);
                $('#txtBeginning1').prop('readonly', true);
                $('#txtToDate').prop('readonly', true);
                $('#txtToDate1').prop('readonly', true);
                $('#txtAssistingFinancialInstitution').prop('readonly', true);
                $('#txtTotalVolumeOfSales').prop('readonly', true);
                cancel();
            }

            function editRegulatoryRequirements(){
                var x = document.getElementById("btnEditRegulatoryRequirements");
                var y = document.getElementById("optionRegulatoryRequirements");
                x.style.display = "none";
                y.style.display = "block";
                $('#txtUpdatedBIRNumber').prop('readonly', false);
                $('#txtTIN').prop('readonly', false);
                $('#txtBusinessPermitNumber').prop('readonly', false);
                $('#txtCOCNumber').prop('readonly', false);
                $('#txtCertificateOfTaxExemptionNumber').prop('readonly', false);
                $('#txtDateOfIssueCOC').prop('readonly', false);
            }

            function cancelRegulatoryRequirements(){
                var x = document.getElementById("btnEditRegulatoryRequirements");
                var y = document.getElementById("optionRegulatoryRequirements");
                x.style.display = "block";
                y.style.display = "none";
                $('#txtUpdatedBIRNumber').prop('readonly', true);
                $('#txtTIN').prop('readonly', true);
                $('#txtBusinessPermitNumber').prop('readonly', true);
                $('#txtCOCNumber').prop('readonly', true);
                $('#txtCertificateOfTaxExemptionNumber').prop('readonly', true);
                $('#txtDateOfIssueCOC').prop('readonly', true);
                cancel();
            }

            function editMembershipProfile(){
                var x = document.getElementById("btnEditMembershipProfile");
                var y = document.getElementById("optionMembershipProfile");
                x.style.display = "none";
                y.style.display = "block";
                $('#txtTotalNumberOfMembership').prop('readonly', false);
                $('#txtMale').prop('readonly', false);
                $('#txtFemale').prop('readonly', false);
                $('#txtNumberOfRegularMembers').prop('readonly', false);
                $('#txtNumberOfAssociateMembers').prop('readonly', false);
                $('#ddlMembershipComposition').prop('disabled', false);
                $('#txtBasicTrainingsAttendedByOfficers').prop('readonly', false);
                $('#txtBasicTrainingsAttendedByMembers').prop('readonly', false);
                $('#txtBasicTrainingsAttendedByManagementStaff').prop('readonly', false);
            }

            function cancelMembershipProfile(){
                var x = document.getElementById("btnEditMembershipProfile");
                var y = document.getElementById("optionMembershipProfile");
                x.style.display = "block";
                y.style.display = "none";
                $('#txtTotalNumberOfMembership').prop('readonly', true);
                $('#txtMale').prop('readonly', true);
                $('#txtFemale').prop('readonly', true);
                $('#txtNumberOfRegularMembers').prop('readonly', true);
                $('#txtNumberOfAssociateMembers').prop('readonly', true);
                $('#ddlMembershipComposition').prop('disabled', true);
                $('#txtBasicTrainingsAttendedByOfficers').prop('readonly', true);
                $('#txtBasicTrainingsAttendedByMembers').prop('readonly', true);
                $('#txtBasicTrainingsAttendedByManagementStaff').prop('readonly', true);
                cancel();
            }

            jQuery(function ($) {
                $("#txtPhone").mask("(+63) 999-999-9999");
            });

            jQuery(function ($) {
                $("#txtDateOfRegistration").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            });

            jQuery(function ($) {
                $("#txtBeginning").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            });

            jQuery(function ($) {
                $("#txtBeginning1").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            });

            jQuery(function ($) {
                $("#txtToDate").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            });

            jQuery(function ($) {
                $("#txtToDate1").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            });

            jQuery(function ($) {
                $("#txtDateofCommitteeMeeting").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            })

            jQuery(function ($) {
                $("#txtDateofRegularGeneralAssemblyMeeting").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            })

            jQuery(function ($) {
                $("#txtDateofMonthlyBoardMeeting").mask("99/99/9999", { placeholder: "mm/dd/yyyy" });
            })

            function Validate(txt) {
                txt.value = txt.value.replace(/[^A-Za-zñÑ ]+/, '');
            }
            function ValidateAddress(txt) {
                txt.value = txt.value.replace(/[^A-Za-z0-9,. ]+/, '');
            }
            function ValidateNumber(txt) {
                txt.value = txt.value.replace(/[^0-9 ]+/, '');
            }
            function ValidatePassword(txt) {
                txt.value = txt.value.replace(/[^A-Za-z0-9 ]+/, '');
            }
            function success(){
                setTimeout(function(){
                    swal({
                        title: "Success!",
                        text: "",
                        type: "success"
                        },
                        function(isConfirm){
                            window.location=window.location;
                        });},500); 
            }
            function failed(){
                setTimeout(function(){
                    swal({
                        title: "Failed!",
                        text: "",
                        type: "warning"
                        },
                        function(isConfirm){});},500);
            }
            function saveRespondent(){
                var form_data = $('#form1').serialize();
                var idres = $('#idres').val();
                $.ajax({
                    type: "POST",
                    url: "updateCoopFunction.php",
                    data: form_data+"&id=<?php echo $idCoop;?>&idres="+idres,
                    success: function(data){
                        success();
                    },
                    error: function(data){
                        failed();
                    }
                });
            }
            function saveCoop(){
                var form_data = $('#form1').serialize();
                var idcoop = $('#idcoop').val();
                $.ajax({
                    type: "POST",
                    url: "updateCoopFunction.php",
                    data: form_data+"&id=<?php echo $idCoop;?>&idcoop="+idcoop,
                    success: function(data){
                        success();
                    },
                    error: function(data){
                        failed();
                    }
                });
            }
            function saveOrgAspect(){
                var form_data = $('#form1').serialize();
                var idorg = $('#idorg').val();
                $.ajax({
                    type: "POST",
                    url: "updateCoopFunction.php",
                    data: form_data+"&id=<?php echo $idCoop;?>&idorg="+idorg,
                    success: function(data){
                        success();
                    },
                    error: function(data){
                        failed();
                    }
                }); 
            }
            function saveBusinessOperation(){
                var form_data = $('#form1').serialize();
                var idbus = $('#idbus').val();
                $.ajax({
                    type: "POST",
                    url: "updateCoopFunction.php",
                    data: form_data+"&id=<?php echo $idCoop;?>&idbus="+idbus,
                    success: function(data){
                       success();
                    },
                    error: function(data){
                        failed();
                    }
                }); 
            }
            function saveRegulatoryRequirements(){
                var form_data = $('#form1').serialize();
                var idreg = $('#idreg').val();
                $.ajax({
                    type: "POST",
                    url: "updateCoopFunction.php",
                    data: form_data+"&id=<?php echo $idCoop;?>&idreg="+idreg,
                    success: function(data){
                       success();
                    },
                    error: function(data){
                        failed();
                    }
                });
            }
            function saveMembershipProfile(){
                var form_data = $('#form1').serialize();
                var idmember = $('#idmember').val();
                $.ajax({
                    type: "POST",
                    url: "updateCoopFunction.php",
                    data: form_data+"&id=<?php echo $idCoop;?>&idmember="+idmember,
                    success: function(data){
                       success();
                    },
                    error: function(data){
                        failed();
                    }
                });
            }
        </script>

    </form>
</body>
</html>
