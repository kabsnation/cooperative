<?php 
session_start();
if(!isset($_SESSION['idAccountAdmin'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$typeCooperative = $handler->getTypeOfCooperative();
$membership = $handler->getMembership();
$area = $handler->getAreaOfOperation();
$composition = $handler->getMembershipComposition();

include('../UI/header/header_admin.php');
?>

<form id="form1" method="POST" action="addCoopFunction.php"  class="form-validate-jquery" >
                        <!-- Page header -->
                        <div class="page-header page-header-default">
                            <div class="page-header-content">
                                <div class="page-title">
                                    <h4><span class="text-semibold">Manage Accounts</span> - Add Cooperative Accounts</h4>
                                </div>
                            </div>
                        </div>
                        <!-- /page header -->

                        <!-- Content area -->
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="panel panel-white">

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h1 class="panel-title">Add Cooperative Account</h1>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <fieldset class="content-group">
                                                <legend><h5 class="text-bold"><i class="icon-user" style="margin-right: 10px"></i>Respondent</h5></legend>
                                                <div class="col-lg-12">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Last name:</strong></label>
                                                                <input  ID="txtLastName" name="txtLastName" MaxLength="45" autofocus Style="text-transform: uppercase" required="required" maxlength="45" class="form-control" onkeyup="Validate(this)"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>First name:</strong></label>
                                                                <input  ID="txtFirstName" name="txtFirstName" MaxLength="45" Style="text-transform: uppercase" required="required" maxlength="45"  class="form-control"  onkeyup="Validate(this)"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Middle name:</strong></label>
                                                                <input  ID="txtMiddleName" name="txtMiddleName" MaxLength="45" Style="text-transform: uppercase" required="required" maxlength="45" class="form-control" onkeyup="Validate(this)"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label><span class="text-danger">* </span><strong>Position:</strong></label>
                                                                <input  ID="txtPosition" name="txtPosition" MaxLength="45" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label><span class="text-danger">* </span><strong>Phone Number:</strong></label>
                                                                <input ID="txtPhone" type="text" data-mask="(+63)99-999-9999" name="txtPhone" required="required" placeholder="(+63) 999-999-9999" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                                <input  ID="txtEmail" name="txtEmail" required="required" maxlength="45" class="form-control" type="email"></input>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </fieldset>

                                            <fieldset class="content-group">
                                                <legend><h5 class="text-bold"><i class="icon-file-text3" style="margin-right: 10px"></i>Cooperative Profile</h5></legend>
                                                <div class="col-lg-12">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Business/ Cooperative Name:</strong></label>
                                                                <input  ID="txtCoopName" name="txtCoopName" MaxLength="100" Style="text-transform: uppercase" required="required" maxlength="45" class="form-control" onkeyup="Validate(this)" onkeypress="changeCoopLbl(this.value)"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Address:</strong></label>
                                                                <textarea ID="txtAddress" name="txtAddress" Style="text-transform: uppercase" required="required" maxlength="300" class="form-control" onkeyup="ValidateAddress(this)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Telephone/ Fax Number:</strong></label>
                                                                <input  ID="txtTelephone" name="txtTelephone" type="number" maxlength="20" required="required" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                                <input  ID="txtEmail1" name="txtEmail1" type="email" maxlength="45" class="form-control" required="required"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>CDA Registration Number:</strong></label>
                                                                <input  ID="txtCDA" name="txtCDA" required="required" maxlength="45" class="form-control" type="number"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Date of Registration:</strong></label>
                                                                <input  ID="txtDateOfRegistration" name="txtDateOfRegistration" class="form-control" required="required" placeholder="MM/DD/YYYY"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>CIN:</strong></label>
                                                                <input  ID="txtCIN" name="txtCIN" maxlength="45" class="form-control" required="required" type="number"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Type of Cooperative:</strong></label>
                                                                <select  ID="ddlTypeOfCooperative" name="ddlTypeOfCooperative" required="required" class="form-control">
                                                                   <?php foreach($typeCooperative as $type){?>
                                                                   <option value="<?php echo $type['idType'];?>"><?php echo $type['Cooperative_Type'];?></option>
                                                                   <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Common Bond of Membership:</strong></label>
                                                                <select  ID="ddlCommonBondOfMembership" 
                                                                name="ddlCommonBondOfMembership" required="required" class="form-control">
                                                                    <?php foreach($membership as $member){?>
                                                                   <option value="<?php echo $member['idCommonBond_of_Membership'];?>"><?php echo $member['Membership'];?></option>
                                                                   <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Affiliation:</strong></label>
                                                                <input  ID="txtAffiliation" name="txtAffiliation" class="form-control" required="required" type="text" maxlength="45" onkeyup="Validate(this)"></input>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Area of Operation:</strong></label>
                                                                <select  ID="ddlAreaOfOperation" name="ddlAreaOfOperation" required="required" class="form-control">
                                                                	<?php foreach($area as $operation){?>
                                                                   <option value="<?php echo $operation['idarea_of_operation'];?>"><?php echo $operation['area'];?></option>
                                                                   <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset class="content-group">
                                                <legend><h5 class="text-bold"><i class=" icon-tree6" style="margin-right: 10px"></i>Organizational Aspect (Current Officers)</h5></legend>
                                                <div class="col-lg-12">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Number of Board of Directors:</strong></label>
                                                                <input  ID="txtNumberOfBoardOfDirectors" 
                                                                name="txtNumberOfBoardOfDirectors" min="1" max="99" required="required" class="form-control" type="number"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Number of Employees:</strong></label>
                                                                <input  ID="txtNumberOfEmployees" name="txtNumberOfEmployees" min="1" max="99" required="required" class="form-control" type="number"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>BOD Chairman:</strong></label>
                                                                <input  ID="txtBODChairman" name="txtBODChairman" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Manager:</strong></label>
                                                                <input  ID="txtManager" name="txtManager" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Educ.Com/ BOD Vice Chair:</strong></label>
                                                                <input  ID="txtBODViceChair" name="txtBODViceChair" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Secretary:</strong></label>
                                                                <input  ID="txtSecretary" name="txtSecretary" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Audit Committee Chairman:</strong></label>
                                                                <input  ID="txtAuditCommitteeChair" 
                                                                name="txtAuditCommitteeChair" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Treasurer:</strong></label>
                                                                <input  ID="txtTreasurer" name="txtTreasurer" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Election Committee Chairman:</strong></label>
                                                                <input  ID="txtElectionCommitteeChairman" name="txtElectionCommitteeChairman" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Credit Committee Chairman:</strong></label>
                                                                <input  ID="txtCreditCommitteeChairman" 
                                                                name="txtCreditCommitteeChairman" required="required" maxlength="45" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Med. & Concilliation:</strong></label>
                                                                <input  ID="txtMedAndConcilliation" 
                                                                name="txtMedAndConcilliation" required="required"  maxlength="200" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Other Committees:</strong></label>
                                                                <input  ID="txtOtherCommittees" name="txtOtherCommittees" required="required" maxlength="450" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Date of Regular General Assembly Meeting:</strong></label>
                                                                <input  ID="txtDateofRegularGeneralAssemblyMeeting" 
                                                                name="txtDateofRegularGeneralAssemblyMeeting" required="required" placeholder="MM/DD/YYYY" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Date of Monthly Board Meeting:</strong></label>
                                                                <input  ID="txtDateofMonthlyBoardMeeting"
                                                                 name="txtDateofMonthlyBoardMeeting" required="required" placeholder="MM/DD/YYYY" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Date of Committee Meeting:</strong></label>
                                                                <input  ID="txtDateofCommitteeMeeting" 
                                                                name="txtDateofCommitteeMeeting" required="required" placeholder="MM/DD/YYYY" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>

                                            <fieldset class="content-group">
                                                <legend><h5 class="text-bold"><i class=" icon-stats-bars2" style="margin-right: 10px"></i>Business/ Financial Operation:</h5></legend>
                                                <div class="col-lg-12">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Business Enagaged In:</strong></label>
                                                                <textarea  ID="txtBusinessEnagagedIn" 
                                                                name="txtBusinessEnagagedIn" required="required" class="form-control"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Other Business:</strong></label>
                                                                <textarea  ID="txtOtherBusiness" name="txtOtherBusiness" class="form-control"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Services/Benefits Offered to Members:</strong></label>
                                                                <input  ID="txtServicesBenefitsOfferedtoMembers" 
                                                                name="txtServicesBenefitsOfferedtoMembers" required="required" class="form-control" maxlength="100"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Total Cooperative Asset:</strong></label>
                                                                <input  ID="txtTotalCooperativeAsset" 
                                                                name="txtTotalCooperativeAsset" type="number" required="required" class="form-control" min="1" max="9999999999"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Total Paid-up Capital:</strong></label>
                                                                <input  ID="txtTotalPaidUpCapital" 
                                                                name="txtTotalPaidUpCapital" type="number" required="required" min="1" max="9999999999" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Beginning: </strong></label>
                                                                <input  ID="txtBeginning" name="txtBeginning" required="required" placeholder="MM/DD/YYYY" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Beginning:</strong></label>
                                                                <input  ID="txtBeginning1" name="txtBeginning1" required="required" placeholder="MM/DD/YYYY" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>To Date: </strong></label>
                                                                <input  ID="txtToDate" name="txtToDate" required="required" placeholder="MM/DD/YYYY" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>To Date:</strong></label>
                                                                <input  ID="txtToDate1" name="txtToDate1" required="required" placeholder="MM/DD/YYYY" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><strong>Assisting Financial Institution, if any:</strong></label>
                                                                <textarea ID="txtAssistingFinancialInstitution" 
                                                                name="txtAssistingFinancialInstitution" class="form-control"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><strong>Total Volume of Sales based in Latest Financial Statement (with Members/Non-Members):</strong></label>
                                                                <input  ID="txtTotalVolumeOfSales" 
                                                                name="txtTotalVolumeOfSales" required="required" type="number" min="1" max="9999999999" class="form-control"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>

                                            <fieldset class="content-group">
                                                <legend><h5 class="text-bold"><i class=" icon-clipboard5" style="margin-right: 10px"></i>Regulatory Requirements</h5></legend>
                                                <div class="col-lg-12">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Updated BIR Registration Number:</strong></label>
                                                                <input  ID="txtUpdatedBIRNumber" name="txtUpdatedBIRNumber" required="required" maxlength="50" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Tax Identification Number (TIN):</strong></label>
                                                                <input  ID="txtTIN" name="txtTIN" required="required" class="form-control" placeholder="999-999-999-9999"></input>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Business Permit Number:</strong></label>
                                                                <input  ID="txtBusinessPermitNumber" 
                                                                name="txtBusinessPermitNumber" required="required" maxlength="50" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>COC Number (CDA):</strong></label>
                                                                <input  ID="txtCOCNumber" name="txtCOCNumber" required="required" maxlength="50" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Certificate of Tax Exemption Number:</strong></label>
                                                                <input  ID="txtCertificateOfTaxExemptionNumber" 
                                                                name="txtCertificateOfTaxExemptionNumber" required="required" maxlength="50" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Date of Issue (COC):</strong></label>
                                                                <input  ID="txtDateOfIssueCOC" name="txtDateOfIssueCOC" required="required" class="form-control" placeholder="MM/DD/YYYY"></input>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset class="content-group">
                                                <legend><h5 class="text-bold"><i class=" icon-stack-text" style="margin-right: 10px"></i>Membership Profile</h5></legend>
                                                <div class="col-lg-12">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Total Number of Membership:</strong></label>
                                                                <input  ID="txtTotalNumberOfMembership" 
                                                                name="txtTotalNumberOfMembership" required="required" min="1" max="100" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Male:</strong></label>
                                                                <input  ID="txtMale" name="txtMale" required="required" min="1" max="100" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Female:</strong></label>
                                                                <input  ID="txtFemale" name="txtFemale" required="required" min="1" max="100" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Number of Regular Members:</strong></label>
                                                                <input  ID="txtNumberOfRegularMembers" 
                                                                name="txtNumberOfRegularMembers" required="required" min="1" max="100" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Number of Associate Members:</strong></label>
                                                                <input  ID="txtNumberOfAssociateMembers" 
                                                                name="txtNumberOfAssociateMembers" required="required" min="1" max="100" class="form-control"></input>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Membership Composition:</strong></label>
                                                                <select  ID="ddlMembershipComposition" 
                                                                name="ddlMembershipComposition" required="required" class="form-control" >
                                                                    <?php foreach($composition as $comp){?>
                                                                    <option value="<?php echo $comp['idMembership_composition'];?>"><?php echo $comp['Composition'];?></option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Members:</strong></label>
                                                                <textarea  ID="txtBasicTrainingsAttendedByMembers" 
                                                                name="txtBasicTrainingsAttendedByMembers" required="required" class="form-control"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Officers:</strong></label>
                                                                <textarea  ID="txtBasicTrainingsAttendedByOfficers" 
                                                                name="txtBasicTrainingsAttendedByOfficers" required="required" class="form-control"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Management Staff:</strong></label>
                                                                <textarea  ID="txtBasicTrainingsAttendedByManagementStaff" 
                                                                name= "txtBasicTrainingsAttendedByManagementStaff" required="required" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset class="content-group">
                                                <legend><h5 class="text-bold"><i class=" icon-user-lock" style="margin-right: 10px"></i>Account Profile</h5></legend>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Username:</strong></label>
                                                                <input  ID="txtUsername" name="txtUsername" required="required" class="form-control" MinLength="6" MaxLength="20" ></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Password:</strong></label>
                                                                <input  ID="txtPassword" name="txtPassword" type="password" required="required" class="form-control" MinLength="6" MaxLength="20"></input>
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
                                                                <input  ID="txtPassword1" type="password" required="required" class="form-control" MinLength="6" MaxLength="20" equalsTo="txtPassword"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br />
                                                    <br />

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="text-center">
                                                                <p style="font-size: small">
                                                                    In behalf of
                                                                    <asp:Label  class="label-default bg-info" ID="lblCoopName" Text="Coop Name" name="lblCoopName" Style="text-transform: uppercase" ></asp:Label>
                                                                    Cooperative, I hereby certify that the above information are correct and true with the best of my knowledge and belief.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>

                                            <div class="text-right">
                                                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                <input type='submit'  ID="btnSubmit" class="btn btn-primary" value="Submit" />
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            
                            <!-- Footer -->
                                <?php include '../UI/copyright_footer.php' ?>
                            <!-- /footer -->

                        </div>
                        <!-- /Content area -->

    </form>
                    </div>
                    <!-- /Main content -->

                </div>
                <!-- /Page content -->

            </div>
            <!-- /Page container -->
        </div>
</body>

        <script type="text/javascript">
            jQuery(function ($) {
                $("#txtPhone").mask("(+63) 999-999-9999");
            });

            jQuery(function ($) {
                $("#txtDateOfRegistration").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            });

            jQuery(function ($) {
                $("#txtBeginning").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            });

            jQuery(function ($) {
                $("#txtBeginning1").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            });

            jQuery(function ($) {
                $("#txtToDate").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            });

            jQuery(function ($) {
                $("#txtToDate1").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            });

            jQuery(function ($) {
                $("#txtDateofCommitteeMeeting").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            })

            jQuery(function ($) {
                $("#txtDateofRegularGeneralAssemblyMeeting").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            })

            jQuery(function ($) {
                $("#txtDateofMonthlyBoardMeeting").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
            })

            jQuery(function ($) {
                $("#txtTIN").mask("999-999-999-9999", { placeholder: "999-999-999-9999" });
            })

            jQuery(function ($) {
                $("#txtDateOfIssueCOC").mask("99/99/9999", { placeholder: "MM/DD/YYYY" });
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
            function changeCoopLbl(txt){
                $('#lblCoopName').html(txt);
            }
             function confirm(){
                swal({
                            title: "Are you sure?",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#FF7043",
                            confirmButtonText: "Submit",
                            closeOnConfirm: true,
                            closeOnCancel: true
                    },
                function(isConfirm){
                    if(isConfirm){
                        var status = validateForm();
                            if(status==1){
                                validate();
                            }
                            else{
                                 var form_data = $('#form1').serialize();
                                    $.ajax({
                                        type: "POST",
                                        url: "addCoopFunction.php",
                                        data: form_data,
                                        success: function(data){
                                           success();
                                        }
                                    });
                            }
                       
                    }
                });
            }
            function success(){
                setTimeout(function(){
                    swal({
                        title: "Success!",
                        text: "",
                        type: "success"
                        },
                        function(isConfirm){
                            window.location='CCDO_AddCooperativeAccount.php';
                        });},500); 
            }
            function failed(){
                setTimeout(function(){
                    swal({
                        title: "Failed!",
                        text: "Some items has not yet been responded",
                        type: "warning"
                        },
                        function(isConfirm){});},500);
            }
            function checkUsername(){
                var username = $('#txtUsername').val();
                if(username !=''){
                   $.ajax({
                            type: "POST",
                            url: "checkUsername.php",
                            data: "txtUsername="+username,
                            success: function(data){
                               if(data =='1'){
                                alert("Username already exist");
                               }
                               else{
                                    confirm();
                            }
                        }
                    });  
               }          
            }
            function validateForm(){
                var inputs = document.getElementsByTagName('input');
                var selects  = document.getElementsByTagName('select');
                var textareas  = document.getElementsByTagName('textarea');
                for(var i = 0; i<inputs.length; ++i){
                    for(var o = 0; o<selects.length; ++o){
                        if(!selects[o].checkValidity()){
                            return 1;
                            break;
                        }
                    }
                    for(var p = 0; p<textareas.length; ++p){
                        if(!textareas[p].checkValidity()){
                            return 1;
                            break;
                        }
                    }
                    if(!inputs[i].checkValidity()){
                        return 1;
                        break;
                    }
                }
            }
             function validate(){
                setTimeout(function(){
                    swal({
                        title: "Failed!",
                        text: "Fill out all the required fields.",
                        confirmButtonColor: "#EF5350",
                        type: "error"
                    });},500);
            }
        </script>
        
</html>