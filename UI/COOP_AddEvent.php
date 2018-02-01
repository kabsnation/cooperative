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

                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h3 class="panel-title"><strong>Add Event</strong></h3>
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
                                                        <textarea  ID="txtEventName" name="txtEventName" rows="4" cols="5" class="form-control" type="MultiLine" required="required" maxlength="45"></textarea>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger"></span><strong>Other Event Details:</strong></label>
                                                        <textarea rows="5" cols="5" ID="txtEventDetails" name="txtEventDetails" class="form-control" type="MultiLine" required="required"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>Start Date and Time:</strong></label>
                                                        <input  ID="txtStartDateTime" name="txtStartDateTime" class="form-control" type="DateTimeLocal" required="required"></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><span class="text-danger">* </span><strong>End Date and Time:</strong></label>
                                                        <input  ID="txtEndDateTime" name="txtEndDateTime" class="form-control" type="DateTimeLocal" required="required"></input>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label><strong>Upload File:</strong></label>
                                                        <input  class="file-input-extensions" AllowMultiple="true" multiple="multiple" type="file" id="fileUploaded" name="fileUploaded" required="required" />
                                                    </div>
                                                </div>
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
                                                        <table class="table datatable-html" id="table" style="font-size: 13px; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%;"><a></a><i class="icon-check"></i></th>
                                                                    <th style="width: 50%;">Recipients</th>
                                                                    <th style="width: 45%;">Email</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if($cooperativeProfile){
                                                                    foreach($cooperativeProfile as $coop){?>
                                                                <tr>
                                                                    <td><input type="checkbox" name="checkbox[]" value="<?php echo $coop['idAccounts'];?>"></td>
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
                                            <input type="submit" ID="btnSend" text="Submit" class="btn bg-info" />
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
</script>