<?php
session_start();
if(!isset($_SESSION['idAccount'])){
    echo "<script>window.location='index.php';</script>";
}
require("../config/config.php");
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
date_default_timezone_set('Asia/Manila');
$account = new AccountHandler();
$doc = new DocumentHandler();
$trackingNumber = $doc->getTrackingNumber();
$documentType = $doc->getDocumentType();
$id = $_SESSION['idAccount'];
$adminAccount = $account->getAccountById($id);
$cooperativeProfile = $account->getCoopAccounts($id);
$departmentProfile = $account->getDepartmentAccounts($id);
include('../UI/header/header_user.php');
?>

            <!-- Content area -->
            <div class="content-wrapper">

                <div class="content">

                    <!-- Wizard with validation -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">Send Document</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <form class="form-validation" action="documentFunction.php" method="POST" enctype="multipart/form-data">

                            <fieldset class="step" id="validation-step1">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">1</span>
                                    Document Type
                                    <small class="display-block">First, select whether the document is either incoming or outgoing.</small>
                                </h6>

                                <div class="row">
                                    <br/>
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-3">
                                                    <button type="submit" id="validation-next" class="btn btn-block btn-primary" style="font-size: 15px;"><i class=" icon-file-download"></i> Incoming</button>
                                                </div>

                                                <div class="col-md-3">
                                                    <button type="submit" id="validation-next" class="btn btn-block btn-success" value="Outgoing" style="font-size: 15px;"><i class=" icon-file-upload"></i> Outgoing</button>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>

                                        </div>
                                    <br/><br/><br/><br/>
                                </div>
                            </fieldset>

                            <fieldset class="step" id="validation-step2">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">2</span>
                                    Choosing your Recipients
                                    <small class="display-block">Second, choose the person you want to send the documents.</small>
                                </h6>

                                <div class="col-md-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><span class="text-danger">* </span><strong>Choose Recipients:</strong></label>

                                            <table class="table datatable-html" id="table" style="font-size: 13px; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;"><input type="checkbox" class="styled" id="select-all"  name="select-all" onchange="addToHidden(this)" ></th>
                                                        <th style="width: 30%;">Recipients</th>
                                                        <th style="width: 20%;">Email</th>
                                                        <th style="width: 20%;">Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($cooperativeProfile){
                                                        foreach($cooperativeProfile as $coop){?>
                                                    <tr>
                                                        <td><input type="checkbox"  name="checkbox[]" onchange="addToHidden(this)" value="<?php echo $coop['idAccounts'];?>"></td>
                                                         <td><?php echo $coop['Cooperative_Name'];?></td>
                                                         <td><?php echo $coop['Email_Address'];?></td>
                                                         <td>Cooperative</td>
                                                    </tr>
                                                    <?php }}?>
                                                    <?php if($departmentProfile){
                                                        foreach($departmentProfile as $dept){?>
                                                    <tr>
                                                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $dept['idAccounts'];?>" onchange="addToHidden(this)"></td>
                                                         <td><?php echo $dept['Department'];?></td>
                                                         <td><?php echo $dept['Email_Address'];?></td>
                                                         <td>Department</td>
                                                    </tr>
                                                    <?php }}?>
                                                </tbody>
                                            </table>
                                            <input type="text" id="checker" class="label" disabled="true" required="required">
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-wizard-actions">
                                    <button class="btn btn-default" id="validation-back" type="reset">Back</button>
                                    <button class="btn btn-info" id="validation-next" type="submit">Next</button>
                                </div>
                            </fieldset>

                            <fieldset class="step" id="validation-step3">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">3</span>
                                    Uploading the Document
                                    <small class="display-block">Third, upload the file or document you want to send.</small>
                                </h6>

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <center>
                                            <div class="form-group">
                                                <label class="display-block"><span class="text-danger">* </span> Upload File/s:</label>
                                                <input type="file" id="file" name="file" required="required" class="file-styled">
                                                <span class="help-block">Multiple file upload is not allowed. Make sure to archive or compress the documents into a single file. (E.g. ".zip" , ".rar", etc.)</span>
                                            </div>
                                        </center>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>

                                <div class="form-wizard-actions">
                                    <button class="btn btn-default" id="validation-back" type="reset">Back</button>
                                    <button class="btn btn-info" id="validation-next" type="submit">Next</button>
                                </div>

                            </fieldset>

                            <fieldset class="step" id="validation-step4">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">4</span>
                                    Filling out Additional Document Details
                                    <small class="display-block">Fourth, fill out the following additional document information.</small>
                                </h6>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"> <span class="text-danger">* </span> <strong> Document Title:</strong></label>
                                                <textarea type="text" name="title" id="txtDocumentName" class="form-control" required="required" minlength="1" maxlength="100"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label"><span class="text-danger">* </span> <strong>Document Type: </strong></label>
                                                <select  class="form-control select" required="required" name="documentType" ID="documentType">
                                                    <option></option>
                                                    <?php if($documentType){
                                                        foreach($documentType as $type){?>
                                                        <option value="<?php echo $type['idDocument_Type'];?>"><?php echo $type['Document'];?></option>
                                                        <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="display-block text-semibold"><span class="text-danger">* </span> <strong> Does the Document needs a Reply?</strong></label>
                                                <label class="radio-inline radio-right">
                                                    <input type="radio" name="reply" value="1" class="styled" checked="checked">
                                                    Yes
                                                </label>

                                                <label class="radio-inline radio-right">
                                                    <input type="radio" name="reply" value="0" class="styled">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-wizard-actions">
                                    <button class="btn btn-default" id="validation-back" type="reset">Back</button>
                                    <button class="btn btn-info" id="validation-next" type="submit">Next</button>
                                </div>
                            </fieldset>

                            <fieldset class="step" id="validation-step5">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">5</span>
                                    Adding a Message with the Document
                                    <small class="display-block">Fifth, you can add or not some message or remarks along with the document.</small>
                                </h6>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label"><strong>Message:</strong></label>
                                            <textarea type="text" class="summernote" id="message" name="message"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-wizard-actions">
                                    <button class="btn btn-default" id="validation-back" type="reset">Back</button>
                                    <button class="btn btn-info" id="validation-next" type="submit">Next</button>
                                </div>
                            </fieldset>

                            <fieldset class="step" id="validation-step6">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">6</span>
                                    Review your Transaction
                                    <small class="display-block">Lastly, in here you can review and edit back your transaction before sending it.</small>
                                </h6>

                                <div class="row">
                                    <div class="panel-body no-padding-bottom">
                                        <div class="row" style="font-size: 15px; margin-bottom: -20px; margin-top: -10px;">
                                            <div class="col-sm-6 content-group">
                                                <ul class="list-condensed list-unstyled">
                                                    <li><strong>Generated Tracking Number:</strong></li>
                                                    <li>CSRL-SRS-FO1-MAR-06-01</li>
                                                </ul>
                                            </div>

                                            <div class="col-sm-6 content-group">
                                                <div class="invoice-details">
                                                    <ul class="list-condensed list-unstyled">
                                                        <li><strong>Date Added:</strong></li>
                                                        <li>March 6, 2018</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-md-6 col-lg-9 content-group">
                                                <span class="text-bold text-muted" style="font-size: 15px;">Transaction Details</span>
                                                <ul class="list-condensed list-unstyled">
                                                    <li><strong>Document Title:</strong></li>
                                                    <li>Sample Document</li>
                                                    <li><strong>Document Type:</strong></li>
                                                    <li>Attend</li>
                                                    <li><strong>Needs a Reply?</strong></li>
                                                    <li>No</li>
                                                </ul>
                                            </div>

                                            <div class="col-md-6 col-lg-3 content-group">
                                                <span class="text-muted" style="font-size: 15px;">Sender Details</span>
                                                <ul class="list-condensed list-unstyled invoice-payment-details">
                                                    <li><strong>Sender Name</strong></li>
                                                    <li>Mark Dherrick Ceuavs</li>
                                                </ul>

                                                <span class="text-muted" style="font-size: 15px;">File</span>
                                                <ul class="list-condensed list-unstyled invoice-payment-details">
                                                    <li><strong>Attached File:</strong></li>
                                                    <li><a href="#">Download Attached File</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Message:</strong></label>
                                                    <textarea type="text" class="summernote-airmode" id="message1" name="message1" readonly="true" disabled="true">Sample</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-bold" style="font-size: 15px;">Recipients:</span>
                                                <table class="table datatable-html" id="table" style="font-size: 13px;"">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;">Number</th>
                                                            <th style="width: 30%;">Department</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-wizard-actions">
                                        <button class="btn btn-default" id="validation-back" type="reset">Back</button>
                                        <input type="button" onclick="confirm()" ID="btnSend" text="Submit" class="btn bg-info" value="Submit" />
                                    </div>

                                </div>
                            </fieldset>

                        </form>
                    </div>
                    <!-- /wizard with validation -->

                </div>

            </div>
            <!-- Content area -->

        </div>
        <!-- Page content -->

    </div>
    <!-- Page container -->
</body>
</html>

<script type="text/javascript">
    $('#message').summernote({
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    });
    $('#message1').summernote({toolbar: []});
    $('#message1').summernote('disable');

    function addToHidden(checkbox){
        if(checkbox.checked == true){
            document.getElementById('checker').value='true';
        }
        else{
            document.getElementById('checker').value=null;
        }
    }
var table = $('#table').DataTable();
 function selectAll(){
    alert('asd');
 }
 
 $('#btnSend').submit(function(ev) {
    ev.preventDefault(); // to stop the form from submitting
    /* Validations go here */
    confirm(); // If all the validations succeeded
});
 var counter = 0;
 $('#select-all').click(function(event) {   
        if(counter ==0){
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
            counter = 1;
            }
        else{
            $(':checkbox').each(function() {
                    this.checked = false;                        
                });
            counter = 0;
            }
});
table.columns.adjust().draw();
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
                                    url: "documentFunction.php",
                                    type: 'POST',
                                    data: formData,
                                    success: function (data) {
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
                var checker = document.getElementById('checker');
                var selects  = document.getElementsByTagName('select');
                if(checker.value==''){
                    return 1;
                }
                for(var i = 0; i<inputs.length; ++i){
                    for(var o = 0; o<selects.length; ++o){
                        if(!selects[o].checkValidity()){
                            //console.log(selects[o].value);
                            return 1;
                            break;
                        }
                    }
                    if(!inputs[i].checkValidity()){
                        //console.log(inputs[o].value);
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
    <?php

    if(isset($_POST['success'])){
        if($_POST['success']=='1'){?>
            success();
       <?php $_POST = array();}
    }
?>
</script>