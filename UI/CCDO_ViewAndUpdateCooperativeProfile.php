<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>CCDO - Update Cooperative Profile</title>

    <link rel="icon" href="/assets/images/CCDO Logo.png" />

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="assets/css/sweetalert.css" />

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css" />
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="assets/jquery.maskedinput.js" type="text/javascript"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_validation.js"></script>
    <script src="assets/jquery.maskedinput.js" type="text/javascript"></script>
    <!-- /theme JS files -->
</head>
<body>
    <form id="form1"  class="form-validate-jquery">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/CCDO Logo.png" alt=""style="background-color:#ffffff"  /></a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img alt="">
                        <i class="icon-cog5"></i>
                        <span>Username</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                        <li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->

        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main Content -->
                <div class="content-wrapper">
                    <div class="content">

                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <h3 class="panel-title">Cooperative Name</h3>
                                </div>
                            </div>               

                            <div class="panel-body">
                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class="icon-user" style="margin-right: 10px"></i>Respondent
                                        <button id="btnEditRespondent" type="button" class="btn btn-primary" style="float: right" onclick="editRespondent()">Edit</button>
                                    </h5>
                                    </legend>
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Last name:</strong></label>
                                                    <input  ID="txtLastName" MaxLength="45" autofocus Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>First name:</strong></label>
                                                    <input  ID="txtFirstName" MaxLength="45" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Middle name:</strong></label>
                                                    <input  ID="txtMiddleName" MaxLength="45" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><span class="text-danger">* </span><strong>Position:</strong></label>
                                                    <input  ID="txtPosition" MaxLength="45" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><span class="text-danger">* </span><strong>Phone Number:</strong></label>
                                                    <input ID="txtPhone"  required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                    <input  ID="txtEmail" required="required" class="form-control" type="Email" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-12" id="optionRespondent" style="display: none;">
                                        <hr/>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-info" id="btnSaveRespondent">Save</button>
                                            <button type="button" class="btn btn-danger" id="btnCancelRespondent" onclick="cancelRespondent()">Cancel</button>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class="icon-file-text3" style="margin-right: 10px"></i>Cooperative Profile
                                        <button id="btnEditCooperativeProfile" type="button" class="btn btn-primary" style="float: right" onclick="editCooperativeProfile()">Edit</button>
                                    </h5></legend>
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Business/ Cooperative Name:</strong></label>
                                                    <input  ID="txtCoopName" MaxLength="100" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Address:</strong></label>
                                                    <input  ID="txtAddress" MaxLength="100" Style="text-transform: uppercase" required="required" class="form-control" onkeyup="Validate(this)" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Telephone/ Fax Number:</strong></label>
                                                    <input  ID="txtTelephone" type="Phone" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                    <input  ID="txtEmail1" type="Email" class="form-control" required="required" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>CDA Registration Number:</strong></label>
                                                    <input  ID="txtCDA" required="required" class="form-control" type="Number" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Registration:</strong></label>
                                                    <input  ID="txtDateOfRegistration" class="form-control" required="required" placeholder="mm/dd/yyyy" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>CIN:</strong></label>
                                                    <input  ID="txtCIN" class="form-control" required="required" type="Number" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Type of Cooperative:</strong></label>
                                                    <select disabled="true"  ID="ddlTypeOfCooperative" required="required" class="form-control">
                                                        <option Value="" Text=""></option>
                                                        <option Value="1" Text="Bank"></option>
                                                        <option Value="2" Text="Credit"></option>
                                                        <option Value="3" Text="Consumers"></option>
                                                        <option Value="4" Text="Federation"></option>
                                                        <option Value="5" Text="Laboratory"></option>
                                                        <option Value="6" Text="Marketing"></option>
                                                        <option Value="7" Text="Multi-Purpose (Agri)"></option>
                                                        <option Value="8" Text="Multi-Purpose (Non-Agri)"></option>
                                                        <option Value="9" Text="Producers"></option>
                                                        <option Value="10" Text="Service"></option>
                                                        <option Value="11" Text="Union"></option>
                                                        <option Value="12" Text="Others"></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Common Bond of Membership:</strong></label>
                                                    <select disabled="true"  ID="ddlCommonBondOfMembership" required="required" class="form-control">
                                                        <option Value="" Text=""></option>
                                                        <option Value="1" Text="Associational"></option>
                                                        <option Value="2" Text="Institutional"></option>
                                                        <option Value="3" Text="Occupational"></option>
                                                        <option Value="4" Text="Residential"></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Affiliation:</strong></label>
                                                    <input  ID="txtAffiliation" class="form-control" required="required" onkeyup="Validate(this)" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Area of Operation:</strong></label>
                                                    <select disabled="true"  ID="ddlAreaOfOperation" required="required" class="form-control">
                                                        <option Value="" Text=""></option>
                                                        <option Value="1" Text="Barangay"></option>
                                                        <option Value="2" Text="City"></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionCoopProfile" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveCoopProfile">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelCoopProfile" onclick="cancelCoopProfile()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-tree6" style="margin-right: 10px"></i>Organizational Aspect (Current Officers)
                                        <button id="btnEditOrganizationalAspect" type="button" class="btn btn-primary" style="float: right" onclick="editOrganizationalAspect()">Edit</button>
                                    </h5></legend>
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Board of Directors:</strong></label>
                                                    <input  ID="txtNumberOfBoardOfDirectors" required="required" class="form-control" type="Number" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Employees:</strong></label>
                                                    <input  ID="txtNumberOfEmployees" required="required" class="form-control" type="Number" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>BOD Chairman:</strong></label>
                                                    <input  ID="txtBODChairman" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Manager:</strong></label>
                                                    <input  ID="txtManager" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Educ.Com/ BOD Vice Chair:</strong></label>
                                                    <input  ID="txtBODViceChair" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Secretary:</strong></label>
                                                    <input  ID="txtSecretary" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Audit Committee Chairman:</strong></label>
                                                    <input  ID="txtAuditCommitteeChair" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Treasurer:</strong></label>
                                                    <input  ID="txtTreasurer" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Election Committee Chairman:</strong></label>
                                                    <input  ID="txtElectionCommitteeChairman" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Credit Committee Chairman:</strong></label>
                                                    <input  ID="txtCreditCommitteeChairman" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Med. & Concilliation:</strong></label>
                                                    <input  ID="txtMedAndConcilliation" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Other Committees:</strong></label>
                                                    <input  ID="txtOtherCommittees" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Regular General Assembly Meeting:</strong></label>
                                                    <input  ID="txtDateofRegularGeneralAssemblyMeeting" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Monthly Board Meeting:</strong></label>
                                                    <input  ID="txtDateofMonthlyBoardMeeting" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Committee Meeting:</strong></label>
                                                    <input  ID="txtDateofCommitteeMeeting" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionOrganizationalAspect" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveOrganizationalAspect">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelOrganizationalAspect" onclick="cancelOrganizationalAspect()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-stats-bars2" style="margin-right: 10px"></i>Business/ Financial Operation:
                                        <button id="btnEditBusinessOperation" type="button" class="btn btn-primary" style="float: right" onclick="editBusinessOperation()">Edit</button>
                                    </h5></legend>
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Business Enagaged In:</strong></label>
                                                    <input  ID="txtBusinessEnagagedIn" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Other Business:</strong></label>
                                                    <input  ID="txtOtherBusiness" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Services/Benefits Offered to Members:</strong></label>
                                                    <input  ID="txtServicesBenefitsOfferedtoMembers" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Total Cooperative Asset:</strong></label>
                                                    <input  ID="txtTotalCooperativeAsset" type="Number" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Total Paid-up Capital:</strong></label>
                                                    <input  ID="txtTotalPaidUpCapital" type="Number" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Beginning: </strong></label>
                                                    <input  ID="txtBeginning" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Beginning:</strong></label>
                                                    <input  ID="txtBeginning1" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>To Date: </strong></label>
                                                    <input  ID="txtToDate" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>To Date:</strong></label>
                                                    <input  ID="txtToDate1" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><strong>Assisting Financial Institution, if any:</strong></label>
                                                    <input  ID="txtAssistingFinancialInstitution" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><strong>Total Volume of Sales based in Latest Financial Statement (with Members/Non-Members):</strong></label>
                                                    <input  ID="txtTotalVolumeOfSales" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionBusinessOperation" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveBusinessOperation">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelBusinessOperation" onclick="cancelBusinessOperation()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-clipboard5" style="margin-right: 10px"></i>Regulatory Requirements
                                        <button id="btnEditRegulatoryRequirements" type="button" class="btn btn-primary" style="float: right" onclick="editRegulatoryRequirements()">Edit</button>
                                    </h5></legend>
                                    <div class="col-lg-12">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Updated BIR Registration Number:</strong></label>
                                                    <input  ID="txtUpdatedBIRNumber" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Tax Identification Number (TIN):</strong></label>
                                                    <input  ID="txtTIN" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Business Permit Number:</strong></label>
                                                    <input  ID="txtBusinessPermitNumber" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>COC Number (CDA):</strong></label>
                                                    <input  ID="txtCOCNumber" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Certificate of Tax Exemption Number:</strong></label>
                                                    <input  ID="txtCertificateOfTaxExemptionNumber" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Date of Issue (COC):</strong></label>
                                                    <input  ID="txtDateOfIssueCOC" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-12" id="optionRegulatoryRequirements" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveBusinessOperation">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelBusinessOperation" onclick="cancelRegulatoryRequirements()">Cancel</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend><h5 class="text-bold"><i class=" icon-stack-text" style="margin-right: 10px"></i>Membership Profile
                                        <button id="btnEditMembershipProfile" type="button" class="btn btn-primary" style="float: right" onclick="editMembershipProfile()">Edit</button>
                                    </h5></legend>
                                    <div class="col-lg-12">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Total Number of Membership:</strong></label>
                                                    <input  ID="txtTotalNumberOfMembership" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Male:</strong></label>
                                                    <input  ID="txtMale" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Female:</strong></label>
                                                    <input  ID="txtFemale" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Regular Members:</strong></label>
                                                    <input  ID="txtNumberOfRegularMembers" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Number of Associate Members:</strong></label>
                                                    <input  ID="txtNumberOfAssociateMembers" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Membership Composition:</strong></label>
                                                    <select disabled="true"  ID="ddlMembershipComposition" required="required" class="form-control">
                                                        <option Value="" Text=""></option>
                                                        <option Value="1" Text="Drivers/ Operators"></option>
                                                        <option Value="2" Text="Farmers"></option>
                                                        <option Value="3" Text="Fisherfolks"></option>
                                                        <option Value="4" Text="Government Employees"></option>
                                                        <option Value="5" Text="Indigenous Community"></option>
                                                        <option Value="6" Text="Persons with Disability"></option>
                                                        <option Value="7" Text="Private Employees"></option>
                                                        <option Value="8" Text="Women"></option>
                                                        <option Value="9" Text="Youth"></option>
                                                        <option Value="10" Text="Others (Specify)"></option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Members:</strong></label>
                                                    <input  ID="txtBasicTrainingsAttendedByMembers" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Officers:</strong></label>
                                                    <input  ID="txtBasicTrainingsAttendedByOfficers" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Basic Trainings Attended by Management Staff:</strong></label>
                                                    <input  ID="txtBasicTrainingsAttendedByManagementStaff" required="required" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionMembershipProfile" style="display: none;">
                                            <hr/>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-info" id="btnSaveBusinessOperation">Save</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelBusinessOperation" onclick="cancelMembershipProfile()">Cancel</button>
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
                                                    <input  ID="txtUsername" required="required" class="form-control" MaxLength="40" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Password:</strong></label>
                                                    <input  ID="txtPassword" type="Password" required="required" class="form-control" MinLength="6" MaxLength="40" readonly="true"></input>
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
                                                    <input  ID="txtPassword1" type="Password" required="required" class="form-control" MinLength="6" MaxLength="40" equalsTo="txtPassword" readonly="true"></input>
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
        </script>

    </form>
</body>
</html>
