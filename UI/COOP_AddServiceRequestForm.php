<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head >    
    <title>CCDO - Service / Request Form</title>

    <link rel="icon" href="../assets/images/CCDO Logo.png" />

    <!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"/>
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/core.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/components.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css"/>
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/datatables_data_sources.js"></script>
    <script type="text/javascript" src="assets/js/plugins/uploaders/fileinput.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/uploader_bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/plugins/editors/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_notifications_pnotify.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
    <script src="assets/jquery.maskedinput.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min"></script>
    <script type="text/javascript" src="assets/js/pages/form_validation.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script type="text/javascript" src="assets/js/pages/picker_date.js"></script>
    <!-- /theme JS files -->

    <script src="pnotify.custom.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="pnotify.custom.min.css" />
</head>

<body>
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main Content -->
                    <div class="content-wrapper">
                        <div class="content">

                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h3 class="panel-title">Service / Request Form</h3>
                                    </div>

                                    <div class="heading-elements">
                                        <div class="heading-btn-group">
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form class="form-validate-jquery">
                                        <fieldset class="content-group">
                                            <div class="col-lg-12">

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">* </span><strong>Contact Person:</strong></label>
                                                            <input class="form-control" type="text" id="txtContactPerson" name="txtContactPerson" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">* </span><strong>Organization / Cooperative:</strong></label>
                                                            <textarea  ID="txtOrganization" name="txtOrganization" class="form-control" type="MultiLine" required="required" maxlength="1000"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">* </span><strong>Address:</strong></label>
                                                            <textarea  ID="txtAddress" name="txtAddress" class="form-control" type="MultiLine" required="required" maxlength="1000"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Activity Date:</strong></label>
                                                            <input id="txtActivityDate" name="txtActivityDate" type="text" class="form-control daterange-single" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Time:</strong></label>
                                                            <input id="txtTime" name="txtTime" type="text" class="form-control pickatime-limits">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Expected Number of Participants:</strong></label>
                                                            <input id="txtExpected" name="txtExpected" type="number" class="form-control" required="required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Requested Service:</strong></label>
                                                            <select class="form-control" id="selectRequestedService" name="selectRequestedService" onchange="checkForOthers()" value="">
                                                                <optgroup label="Cooperative:">
                                                                    <option>Pre-Membership Education Seminar (PMES)</option>
                                                                    <option>CDA Mandatory Training</option>
                                                                    <option>Capability Training Seminar</option>
                                                                </optgroup>
                                                                <optgroup label="Livelihood:">
                                                                    <option>Livelihood Skills Training</option>
                                                                    <option>Community Capability Development Seminar</option>
                                                                    <option>Project Proposal Development / Business Plan</option>
                                                                </optgroup>
                                                                <optgroup label="Others:">
                                                                    <option value="7">Other/s</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div id="Others" class="col-md-4" style="display: none">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Others:</strong></label>
                                                            <input type="text" id="txtOthers" name="txtOthers" class="form-control" required="required">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </form>

                                </div>

                                <div class="panel-footer">
                                    <div class="heading-elements">
                                        <div class="text-right">
                                            <input type="button" ID="btnSend" value="Submit" class="btn bg-info" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Main Content -->

        </div>
        <!-- /Page content -->

    </div>
    <!-- Page container -->
</body>

<script type="text/javascript">

    function checkForOthers() {
        var x = document.getElementById("selectRequestedService");
        if(x.value == 7) {
            var y = document.getElementById("Others");
            y.style.display = "block";
        }
        else{
            var y = document.getElementById("Others");
            y.style.display = "none";
        }
    }
</script>

</html>
