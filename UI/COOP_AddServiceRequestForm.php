<?php
session_start();

require("../config/config.php");
require("../Handlers/AccountHandler.php");
require("../Handlers/EventHandler.php");
if(!isset($_SESSION['idEvent'])){
?>
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

    <?php 
    
    $eventhandler = new EventHandler();
    $servicelist = $eventhandler->getServiceList();
}
else {
    $id = $_SESSION['idEvent'];
    $handler = new AccountHandler();
    $cooperativeProfile = $handler->getCoopAccounts($id);
    $departmentProfile = $handler-> getDepartmentAccounts($id);
    $eventhandler = new EventHandler();
    include('../UI/header/header_events.php');
    $servicelist = $eventhandler->getServiceList();
}
?>

            <!-- Main Content -->
                    <div class="content-wrapper">
                        <div class="content">
<form id="form1" action="addServiceRequestFunction.php" method="POST" class="form-validate-jquery" >
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
                                                            <label><span class="text-danger">* </span><strong>Contact Number:</strong></label>
                                                            <input class="form-control" type="text" id="txtContactNumber" name="txtContactNumber" required="required" data-mask="(+63)99-999-9999" placeholder="(+63) 999-999-9999">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">* </span><strong>Email Address: </strong></label>
                                                            <input class="form-control" type="text" id="txtEmail" name="txtEmail" required="required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr/>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">* </span><strong>Organization / Cooperative:</strong></label>
                                                            <textarea  ID="txtOrganization" name="txtOrganization" class="form-control" type="MultiLine" required="required" maxlength="1000"></textarea>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">* </span><strong>Address:</strong></label>
                                                            <textarea  ID="txtAddress" name="txtAddress" class="form-control" type="MultiLine" required="required" maxlength="1000"></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <hr/>

                                                <div class="row">

                                                     <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Activity Date:</strong></label>
                                                            <input id="txtActivityDate" name="txtActivityDate" type="text" class="form-control daterange-single" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Time:</strong></label>
                                                            <input id="txtTime" name="txtTime" type="text" class="form-control pickatime-limits" required="required">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Expected Number of Participants:</strong></label>
                                                            <input id="txtExpected" name="txtExpected" type="number" class="form-control" required="required" min="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">* </span><strong>Venue:</strong></label>
                                                            <textarea  ID="txtVenue" name="txtVenue" class="form-control" type="MultiLine" required="required" maxlength="1000"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                                <hr/>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Requested Service:</strong></label>
                                                            <select class="form-control" id="selectRequestedService" name="selectRequestedService" onchange="checkForOthers()" value="">
                                                                <?php if($servicelist){
                                                                    $count = 1;
                                                                    foreach($servicelist as $list){
                                                                        if($count==1){?>
                                                                <optgroup label="Cooperative:">
                                                                <?php }else if($count==4){?>
                                                                <optgroup label="Livelihood:">
                                                                <?php }else if($count==7){?>
                                                                <optgroup label="Others:">
                                                                <?php }?>
                                                                    <option id="<?php echo $list['idservice'];?>"><?php echo $list['service'];?></option>
                                                                <?php $count++;}}?>
                                                                <option value="7">Please Specify...</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div id="Others" class="col-md-6" style="display: none">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span><strong> Others:</strong></label>
                                                            <input type="text" id="txtOthers" name="txtOthers" class="form-control">
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
                                            <input type="button" onclick="confirm()" ID="btnSend"  value="Submit" class="btn bg-info" />
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
</form>
<script type="text/javascript">

    jQuery(function ($) {
        $("#txtContactNumber").mask("(+63) 999-999-9999");
    });

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
                            $("#form1").submit(function(e) {
                                e.preventDefault();    
                                var formData = new FormData(this);

                                $.ajax({
                                    url: "addServiceRequestFunction.php",
                                    type: 'POST',
                                    data: formData,
                                    success: function (data) {
                                        console.log(data);
                                        success();
                                    },
                                    error: function(data){
                                        failed();
                                    },
                                    cache: false,
                                    contentType: false,
                                    processData: false
                                });
                            });
                            $('#form1').submit();
                        }
           }
        });
    }
    function validateForm(){
                var inputs = document.getElementsByTagName('input');
                var textarea = document.getElementsByTagName('textarea');
                for(var i = 0; i<inputs.length; ++i){
                    if(!inputs[i].checkValidity()){
                        console.log(inputs[i].value);
                        return 1;
                        break;
                    }
                    console.log(inputs[i].value);
                }
                for(var j =0; j<textarea.length; j++){
                    if(!textarea[j].checkValidity()){
                        return 1;
                        break;
                    }
                    console.log(textarea[j]);
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
                text: "Some items has not yet been responded",
                type: "warning"
                },
                function(isConfirm){});},500);
    }
</script>

</html>
