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

                  <div class="content-wrapper">
                    <form id="form1" action="documentFunction.php" method="POST" class="form-validate-jquery" enctype="multipart/form-data">

                    <div class="content-wrapper">
                        <div class="content">

                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h3 class="panel-title">Send Document</h3>
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
                                                
                                                <div class="col-lg-6">
                                                    <label class="control-label text-bold">Tracking Number:</label>
                                                    <br/>
                                                    <label id="trackingNumber" class="label" style="color: #000; font-size: 15px;">  <?php echo $trackingNumber;?></label>
                                                        <input type="hidden" name="trackingNumber" value="<?php echo $trackingNumber;?>">
                                                    </label>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>From:</strong> </label>
                                                        <?php if($adminAccount){
                                                            foreach($adminAccount as $admin){?>
                                                            <br>
                                                        <label class="label" style="color: #000; font-size: 15px;" ><?php echo $admin['name'];?>
                                                            <!-- echo yung session -->
                                                            <input type="hidden" name="accountId" value="<?php echo "$id";?>">
                                                        </label>
                                                        <?php }}?>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label"> <span class="text-danger">* </span> <strong> Document Title:</strong></label>
                                                        <textarea type="text" name="title" id="txtDocumentName" class="form-control" required="required" minlength="1" maxlength="100"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Date Added:</label>
                                                        <input type="text"  class="form-control" ID="dateTime" type="DateTime" readonly="true" value="<?php echo date("m/d/Y") ?>"></input>
                                                        <input type="hidden" name="datetime" value="date('m/d/Y - h:m:s')">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Message:</strong></label>
                                                        <textarea type="text" class="summernote" id="message" name="message"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="row">
                                            

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

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="display-block text-semibold">Needs a Reply?</label>
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

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><span class="text-danger">* </span><strong>Upload File:</strong></label>
                                                    <input type="file" id="file" name="file" required="required" /><br/>
                                                    <label class="text-muted">Multiple file upload is not allowed. Make sure to archive or compress the documents into a single file. (E.g. ".zip" , ".rar", etc.)</label>
                                                </div>
                                            </div>

                                        <div class="col-lg-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><span class="text-danger">* </span><strong>Choose Recipients:</strong></label>
                                                  <table class="table datatable-html" id="table" style="font-size: 13px; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%;"><input type="checkbox" class="styled" id="select-all"  name="select-all" ></th>
                                                                    <th style="width: 30%;">Recipients</th>
                                                                    <th style="width: 20%;">Email</th>
                                                                    <th style="width: 20%;">Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if($cooperativeProfile){
                                                                    foreach($cooperativeProfile as $coop){?>
                                                                <tr>
                                                                    <td><input type="checkbox"  name="checkbox[]" value="<?php echo $coop['idAccounts'];?>"></td>
                                                                     <td><?php echo $coop['Cooperative_Name'];?></td>
                                                                     <td><?php echo $coop['Email_Address'];?></td>
                                                                     <td>Cooperative</td>
                                                                </tr>
                                                                <?php }}?>
                                                                <?php if($departmentProfile){
                                                                    foreach($departmentProfile as $dept){?>
                                                                <tr>
                                                                    <td><input type="checkbox" name="checkbox[]" value="<?php echo $dept['idAccounts'];?>"></td>
                                                                     <td><?php echo $dept['Department'];?></td>
                                                                     <td><?php echo $dept['Email_Address'];?></td>
                                                                     <td>Department</td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </fieldset>

                                </div>

                                <div class="panel-footer">
                                    <div class="heading-elements">
                                        <div class="text-right">
                                            <input type="submit" ID="btnSend" text="Submit" class="btn bg-info" value="Submit" />
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
            <!-- /Page container -->
        </div>
    </form>
</body>
</html>
<script type="text/javascript">
var table = $('#table').DataTable();
 function selectAll(){
    alert('asd');
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
                   document.getElementById('form1').submit();
           }
        });
    }
    function success(){
        setTimeout(function(){
            swal({
                title: "Success!",
                text: "",
                type: "success"
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

    function validateForm(){
        var fields = $(".panel-body")
            .find("select, textarea, input").serializeArray();
      
    $.each(fields, function(i, field) {
            swal({
                title: "Failed!",
                text: "Fill out all the required fields.",
                confirmButtonColor: "#EF5350",
                type: "error"
            });
       }); 
    }
    <?php

    if(isset($_POST['success'])){
        if($_POST['success']=='1'){?>
            success();
       <?php $_POST = array();}
    }
?>
</script>