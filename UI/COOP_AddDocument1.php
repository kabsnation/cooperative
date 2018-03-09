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
//check if coop account
$trackingNumber = $doc->getTrackingNumber();
$documentType = $doc->getDocumentType();
$id = $_SESSION['idAccount'];
$accnt = $account->checkIfCoop($id);
$arr = array();
if($row = $accnt->fetch_array()){
    if(isset($row[0])){
        $tochange= "change('CSRL-SDF-F01');";
        $arr[0] = 1;
        $arr[1] = 0;
        $arr[2] = 1;
        $arr[3] = 2;
        $arr[4] = 3;
        $arr[5] = 4;
        $arr[6] = 5;
        $vsbl = 'style="visibility: hidden;"';
    }
    else{
        // $tochange ='';
        // $arr[0] = 0;
        // $arr[1] = 1;
        // $arr[2] = 2;
        // $arr[3] = 3;
        // $arr[4] = 4;
        // $arr[5] = 5;
        // $arr[6] = 6;
        // $vsbl = 'style="visibility: visible;"';
         $tochange= "change('CSRL-SDF-F01');";
        $arr[0] = 1;
        $arr[1] = 0;
        $arr[2] = 1;
        $arr[3] = 2;
        $arr[4] = 3;
        $arr[5] = 4;
        $arr[6] = 5;
        $vsbl = 'style="visibility: hidden;"';
    }
}
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
                        <form action="documentFunction.php" id="form1" method="POST" enctype="multipart/form-data">
                        <div class="panel-heading">
                            <h6 class="panel-title">Send Document</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                      
                            <?php if($arr[0] == 0){?>
                            <fieldset class="step" id="validation-step1">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count"><?php echo $arr[1];?></span>
                                    Document Type
                                    <small class="display-block">First, select whether the document is either incoming or outgoing.</small>
                                </h6>

                                <div class="row">
                                    <br/>
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-3">
<<<<<<< HEAD
                                                    <button type="submit" id="validation-next" onclick="change(0)" class="btn btn-block btn-primary" style="font-size: 15px;"><i class=" icon-file-download"></i> Incoming</button>
                                                </div>

                                                <div class="col-md-3">
                                                    <button type="submit" id="validation-next" onclick="change(1)" class="btn btn-block btn-success" value="Outgoing" style="font-size: 15px;"><i class=" icon-file-upload"></i> Outgoing</button>
=======
                                                    <button type="submit" id="validation-next" class="btn btn-block btn-primary" style="font-size: 15px;" onclick="updateDocument();" value="Incoming"><i class=" icon-file-download"></i> Incoming</button>
                                                </div>

                                                <div class="col-md-3">
                                                    <button type="submit" id="validation-next1" class="btn btn-block btn-success" value="Outgoing" style="font-size: 15px;" onclick="updateDocument1();"><i class=" icon-file-upload"></i> Outgoing</button>
>>>>>>> a0f11f3dca3b154a1391d33dbbb18b7a3971969c
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>
                                    <br/><br/><br/><br/>
                                </div>
                            </fieldset>
                            <?php }?>
                            <fieldset class="step" id="validation-step2">
                                <h6 class="form-wizard-title text-semibold">
                                     <input type="text" id="tType" class="label" name="tType" disabled="true">
                                    <span class="form-wizard-count"><?php echo $arr[2];?></span>
                                    Choosing your Recipients
                                    <small class="display-block">Second, choose the person or department you want to send the documents.</small>
                                </h6>

                                <div class="col-md-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><span class="text-danger">* </span><strong>Choose Recipients:</strong></label>

                                            <table class="table datatable-html" id="table" style="font-size: 13px; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;"><input type="checkbox" class="styled" id="select-all"  name="select-all" onchange="addToHidden(this);" ></th>
                                                        <th style="width: 30%;">Recipients</th>
                                                        <th style="width: 20%;">Email</th>
                                                        <th style="width: 20%;">Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($cooperativeProfile){
                                                        foreach($cooperativeProfile as $coop){?>
                                                    <tr>
                                                        <td><input type="checkbox" id="checkbox[]" name="checkbox[]" onchange="addToHidden(this), addIDToTable(this);" value="<?php echo $coop['idAccounts'];?>"></td>
                                                         <td><?php echo $coop['Cooperative_Name'];?></td>
                                                         <td><?php echo $coop['Email_Address'];?></td>
                                                         <td>Cooperative</td>
                                                    </tr>
                                                    <?php }}?>
                                                    <?php if($departmentProfile){
                                                        foreach($departmentProfile as $dept){?>
                                                    <tr>
                                                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $dept['idAccounts'];?>" onchange="addToHidden(this), addIDToTable(this);"></td>
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
<<<<<<< HEAD
                                    <button class="btn btn-default" id="validation-back" type="reset" <?php echo $vsbl;?>> Back</button>
                                    <button class="btn btn-info" id="validation-next" type="submit">Next</button>
=======
                                    <button class="btn btn-default" id="validation-back" type="reset">Back</button>
                                    <button class="btn btn-info" id="validation-next" type="submit" onclick="passTableData();">Next</button>
>>>>>>> a0f11f3dca3b154a1391d33dbbb18b7a3971969c
                                </div>
                            </fieldset>

                            <fieldset class="step" id="validation-step3">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count"><?php echo $arr[3];?></span>
                                    Uploading the Document
                                    <small class="display-block">Third, upload the file or document you want to send.</small>
                                </h6>

                                <div class="row">
                                    <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <center>
                                                <div class="form-group">
                                                    <label class="display-block"><span class="text-danger">* </span> <strong>Upload File/s:</strong></label>
                                                    <input type="file" id="file" name="file" required="required" class="file-styled" onchange="ValidateSingleInput(this); ValidateSize(this);">
                                                </div>
                                            </center>
                                            <br/>
                                                <span>NOTE: <br/>Multiple file upload is not allowed. <br/><br/>
                                                Make sure to archive or compress the documents into a single file. (E.g. ".zip" , ".rar", etc.)
                                                </span><br/><br/>
                                                <span>For single file upload, the following file formats are allowed. (".jpg", ".jpeg", ".bmp", ".pdf", ".png", ".doc", ".docx", ".pdf")</span><br/><br/>
                                                
                                                <span>Maximum file size is only 25 Mb.</span>
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
                                    <span class="form-wizard-count"><?php echo $arr[4];?></span>
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
                                                    <input type="radio" id="reply" name="reply" value="1" class="styled" checked="checked">
                                                    Yes
                                                </label>

                                                <label class="radio-inline radio-right">
                                                    <input type="radio" id="reply" name="reply" value="0" class="styled">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-wizard-actions">
                                    <button class="btn btn-default" id="validation-back" type="reset">Back</button>
                                    <button class="btn btn-info" id="validation-next" type="submit" onclick="updateDocumentTitle()">Next</button>
                                </div>
                            </fieldset>

                            <fieldset class="step" id="validation-step5">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count"><?php echo $arr[5];?></span>
                                    Adding a Message with the Document
                                    <small class="display-block">Fifth, you can add some message or remarks along with the document.</small>
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
                                    <button class="btn btn-info" id="validation-next" type="submit" onclick="updateMessage();">Next</button>
                                </div>
                            </fieldset>

                            <fieldset class="step" id="validation-step6">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count"><?php echo $arr[6];?></span>
                                    Review your Transaction
                                    <small class="display-block">Lastly, in here you can review and edit back your transaction before sending it.</small>
                                </h6>

                                <div class="row">
                                    <div class="panel-body no-padding-bottom">
                                        <div class="row" style="font-size: 15px; margin-bottom: -20px; margin-top: -10px;">
                                            <div class="col-sm-6 content-group">
                                                <ul class="list-condensed list-unstyled">
                                                    <li><strong>Generated Tracking Number:</strong></li>
                                                    <li><label id="tNumber"></label></li>
                                                    <input type="hidden" name="trackingNumber" value="<?php echo $trackingNumber;?>">
                                                </ul>
                                            </div>

                                            <div class="col-sm-6 content-group">
                                                <div class="invoice-details">
                                                    <ul class="list-condensed list-unstyled">
                                                        <li><strong>Date Added:</strong></li>
                                                        <li><?php echo date("m/d/Y"); ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-md-6 col-lg-9 content-group">
                                                <span class="text-muted" style="font-size: 15px;">Transaction Details</span>
                                                <ul class="list-condensed list-unstyled">
                                                    <li><strong>Document Circulation:</strong></li>
                                                    <li><label id="document1"></label></li>
                                                    <li><strong>Document Title:</strong></li>
                                                    <li><label id="txtDocumentTitle"></label></li>
                                                    <li><strong>Document Type:</strong></li>
                                                    <li><label id="txtDocumentType"></label></li>
                                                    <li><strong>Needs a Reply?</strong></li>
                                                    <li><label id="txtReply"></label></li>
                                                </ul>
                                            </div>

                                            <div class="col-md-6 col-lg-3 content-group">
                                                <span class="text-muted" style="font-size: 15px;">Sender Details</span>
                                                <ul class="list-condensed list-unstyled invoice-payment-details">
                                                    <li><strong>Sender Name</strong></li>
                                                    <?php if($adminAccount){
                                                        foreach($adminAccount as $admin){?>
                                                        <li><?php echo $admin['name'];?></li>
                                                        <!-- echo yung session -->
                                                        <input type="hidden" name="accountId" value="<?php echo "$id";?>">
                                                    <?php }}?>
                                                </ul>

                                                <span class="text-muted" style="font-size: 15px;">File</span>
                                                <ul class="list-condensed list-unstyled invoice-payment-details">
                                                    <li><strong>Attached File:</strong></li>
                                                    <li><label id="txtFileName"></label></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="control-label" style="font-size: 15px;"><strong>Message:</strong></label>
                                                    <textarea type="text" class="summernote-airmode" id="message1" name="message1" readonly="true" disabled="true"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-bold" style="font-size: 15px;">Recipients:</span>
                                                <table class="table datatable-html" id="table1" name="table1" style="font-size: 13px;"">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;">No.</th>
                                                            <th style="width: 30%;">Recipient</th>
                                                            <th style="width: 35%;">Email Address</th>
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
    function change(value){
        var val = document.getElementById('tType');
        var tNumber = document.getElementById('tNumber');
        if(value === 0){
            tNumber.innerHTML ='CSRL-SRS-FO1 ' + '<?php echo $trackingNumber." ". date("m/d/Y");?>';
            val.value = 'CSRL-SRS-FO1';
        }
        else if(value ===1){
            tNumber.innerHTML ='CCDO-SDF-FO1 ' + '<?php echo $trackingNumber." ". date("m/d/Y");?>';
            val.value = 'CCDO-SDF-FO1';
        }
    }
    <?php echo $tochange;?>
    $('#txtDocumentName').on('keyup', function() {
        $('#txtDocumentName1').val($(this).val());
    });

    $('#documentType').on('change', function() {
        $('#txtDocuType').val($(this).val());
    });

    function updateDocumentTitle(){
        var x = document.getElementById('txtDocumentName').value;
        document.getElementById('txtDocumentTitle').innerHTML = x;

        var y = document.getElementById('documentType');
        var text= y.options[y.selectedIndex].text;
        document.getElementById('txtDocumentType').innerHTML = text;

        var selectedOption = $("input:radio[name=reply]:checked").val()
        if (selectedOption == 0) {
            document.getElementById('txtReply').innerHTML = "No";
        }

        if(selectedOption == 1){
            document.getElementById('txtReply').innerHTML = "Yes";
        }
    }

    function updateFile(){
        var upfile = document.getElementById('file');
        document.getElementById('txtFileName').innerHTML = upfile;
    }

    function updateMessage(){
        var cleanText = $('#message').summernote('code');
        $('#message1').summernote('code', cleanText);
    }

    function getTableData(){
        var table = $('#example').DataTable();
 
        $('#example tbody').on( 'click', 'tr', function () {
            console.log( table.row( this ).data() );
        } );
    }

    function updateDocument(){
        document.getElementById('document1').innerHTML = "Incoming";
    }

    function updateDocument1(){
        document.getElementById('document1').innerHTML = "Outgoing";
    }

    function addIDToTable(checkbox){
        if(checkbox.checked == true){
            var x = document.getElementById("table").rows[0].cells;
            alert(checkbox.value + x);
        }
    }

    function passTableData(){
        var TableData = new Array();
    
        $('#table tr').each(function(row, tr){
            TableData[row]={
                "No" : $(tr).find('td:eq(0)').text()
                , "Recipients" :$(tr).find('td:eq(1)').text()
                , "Email" : $(tr).find('td:eq(2)').text()
                , "Type" : $(tr).find('td:eq(3)').text()
            }
        }); 
        TableData.shift();  // first row is the table header - so remove

        var 
    }

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
                                var formData = new FormData($("#form1"));

                                $.ajax({
                                    url: "documentFunction.php",
                                    type: 'POST',
                                    data: formData,
                                    success: function (data) {
                                        console.log(data);
                                        //success();
                                    },
                                    error: function(data){
                                        console.log(data);
                                        //failed();
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

    function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 25) {
            alert('File size exceeds 25 MB');
            $(file).val(''); //for clearing with Jquery
        } else {
        }
    }

    var el = document.getElementById("file");
    el.addEventListener("onchange", ValidateSize());


    function ValidateSingleInput(oInput) {
        var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".pdf", ".png", ".doc", ".docx", ".pdf", ".rar", ".zip"]; 

        if (oInput.type == "file") {
            var sFileName = oInput.value;

            var fileName = sFileName.split(/(\\|\/)/g).pop();
            document.getElementById('txtFileName').innerHTML = fileName;

             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, please refer to the allowed extensions.");
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
    <?php

    if(isset($_POST['success'])){
        if($_POST['success']=='1'){?>
            success();
       <?php $_POST = array();}
    }
?>
</script>