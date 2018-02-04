<?php
session_start();
if(!isset($_SESSION['idEvent'])){
    echo "<script>window.location='index.php';</script>";
}
$id = $_SESSION['idEvent'];
require("../config/config.php");
require("../Handlers/AccountHandler.php");
$handler = new AccountHandler();
$cooperativeProfile = $handler->getCoopAccounts($id);
$departmentProfile = $handler-> getDepartmentAccounts($id);
include('../UI/header/header_events.php');
?>
                 <form id="form1" action="addEventsFunction.php" method="POST" class="form-validate-jquery" enctype="multipart/form-data">

                    <!-- Main Content -->
                    <div class="content-wrapper">
                        <div class="content">

                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h3 class="panel-title">Add Event</h3>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>Event Name:</strong></label>
                                                        <textarea  ID="txtEventName" name="txtEventName" rows="4" cols="5" class="form-control" type="MultiLine" required="required"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>Event Location:</strong></label>
                                                        <textarea  ID="txtEventLocation" name="txtEventLocation" rows="4" cols="5" class="form-control" type="MultiLine" required="required" maxlength="1000"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><span class="text-danger"></span><strong>Other Event Details:</strong></label>
                                                        <textarea rows="5" cols="5" ID="txtEventDetails" name="txtEventDetails" class="form-control" type="MultiLine" required="required"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>Start and End Date Time:</strong></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                            <input type="text" class="form-control daterange-time" name="datetime" required="required"> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Upload File:</strong></label>
                                                        <input  AllowMultiple="true" multiple="multiple" type="file" id="fileUploaded" name="fileUploaded" />
                                                        <div class="col-xs-12" style="margin-top: 10px;">
                                                            <label class="text-muted">Multiple file upload is not allowed. Make sure to archive or compress the documents into a single file. (E.g. ".zip" , ".rar", etc.)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>Start Date and Time:</strong></label>
                                                        <input  ID="txtStartDateTime" name="txtStartDateTime" class="form-control" type="DateTimeLocal" required="required"></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>End Date and Time:</strong></label>
                                                        <input  ID="txtEndDateTime" name="txtEndDateTime" class="form-control" type="DateTimeLocal" required="required"></input>
                                                    </div>
                                                </div> -->
                                                
                                            </div>

                                            <hr/>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>Choose Recipients:</strong></label>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" id="checker" class="label" disabled="true" required="required" >
                                                        <table class="table datatable-html" id="table" style="font-size: 13px; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%;"><input type="checkbox" class="styled" id="select-all"  name="select-all" onchange="addToHidden(this)" ></th>
                                                                    <th style="width: 50%;">Recipients</th>
                                                                    <th style="width: 45%;">Email</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if($cooperativeProfile){
                                                                    foreach($cooperativeProfile as $coop){?>
                                                                <tr>
                                                                    <td><input type="checkbox" name="checkbox[]" value="<?php echo $coop['idAccounts'];?>" onchange="addToHidden(this)"></td>
                                                                     <td><?php echo $coop['Cooperative_Name'];?></td>
                                                                     <td><?php echo $coop['Email_Address'];?></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                        </div>
                                    </fieldset>

                                </div>

                                <div class="panel-footer">
                                    <div class="heading-elements">
                                        <div class="text-right">
                                            <button type="reset" class="btn btn-link">Reset</button>
                                            <input type="button" onclick="confirm()" ID="btnSend" value="Submit" class="btn bg-info" />
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
     $('#table').dataTable( {
              "columnDefs": [ {
                "targets": 0,
                "orderable": true
                } ]
            } );
     function addToHidden(checkbox){
        if(checkbox.checked == true){
            document.getElementById('checker').value='true';
        }
        else{
            document.getElementById('checker').value=null;
        }
    }
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
                                    url: "addEventsFunction.php",
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
                var checker = document.getElementById('checker');
                if(checker.value==''){
                    return 1;
                }
                for(var i = 0; i<inputs.length; ++i){
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
</script>