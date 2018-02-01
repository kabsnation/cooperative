<?php
session_start();
require("../Handlers/DocumentHandler.php");
require("../config/config.php");
require("../Handlers/AccountHandler.php");
$doc = new DocumentHandler();
$connect = new Connect();
$con = $connect->connectDB();
$trackingId= mysqli_real_escape_string($con,stripcslashes(trim($_GET['trackingId'])));
$trackInfo = $doc->getTrackingInfo($trackingId);
$departmentProfile = $doc->getLocationDeptByTrackingNumber($trackingId);
$cooperativeProfile = $doc->getLocationCoopByTrackingNumber($trackingId);
if(empty($trackInfo))
    echo "<script>window.location='COOP_DocumentList.php'</script>";
if(isset($_SESSION['idSuperAdmin'])){
    include('../UI/header/header_sadmin.php');
    $loc = 'SuperAdmin_DocumentTracker.php';
    if(isset($_GET['dash']))
        $loc='SuperAdmin_Dashboard.php';
}
else{
    include('../UI/header/header_user.php');
    $loc = 'COOP_DocumentList.php';
}
?>
<form action="downloadFunction.php" method="POST">
<!--/ Main sidebar -->
                    <?php if($trackInfo){foreach($trackInfo as $info){?>
                    <!-- Main content -->
                    <div class="content-wrapper">

                        <!-- Content area -->
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">
                                    
                                    <div class="panel panel-flat border-top-lg border-top-info" id="panelEventDetails">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h2><a href="<?php echo $loc;?>"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">Document Details</span></h2>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <div class="row">

                                                <div class="col-sm-6 content-group">
                                                    <img src="assets/images/CCDO Logo Transaction.png" class="content-group mt-10" style="height: 65%; width: 80%;">
                                                </div>

                                                <div class="col-sm-6 content-group">
                                                    <div class="invoice-details">
                                                        <h5>Tracking Number: <span class="text-semibold">
                                                            <p class="text-uppercase text-semibold" ID="lblTrackingNumber"><?php echo $info['trackingNumber'];?></p></span></h5>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-5 col-lg-9 content-group">
                                                    <span class="text-muted">Sender's Information:</span>
                                                    <ul class="list-condensed list-unstyled">
                                                        <li>
                                                            <h5><span class="text-right text-semibold"></span></h5>
                                                        </li>
                                                        <li>From: <span class="text-right text-semibold"></span></li>
                                                        <li><span class=" text-semibold">
                                                            <p  ID="lblFullName" style="font-size: 20px;  text-transform: uppercase; "><?php echo $info['name'];?></p></span></li>
                                                        
                                                        <li><span class="">
                                                            <p  ID="lblSenderEmailAddress" style="font-size: 14px; color: darkgrey;"><?php echo $info['email'];?></p></span></li>
                                                    </ul>
                                                </div>

                                                <div class="col-md-7 col-lg-3 content-group">
                                                    <span class="text-muted">Transaction Details:</span>
                                                    <ul class="list-condensed list-unstyled invoice-payment-details">
                                                        <li>
                                                            <h5><span class="text-right text-semibold"></span></h5>
                                                        </li>
                                                        <li>Date Added: <span class="text-semibold">
                                                            <p  ID="lblDateAdded"><?php echo $info['DateTime']?></p></span></li>
                                                        <li>Document Type: <span class="text-semibold">
                                                            <p  ID="lblDocumentType"><?php echo $info['Document']?></p></span></li>
                                                        <li style="margin-top:20px;">Attached File: <span class="text-right text-semibold">
                                                            <input type="hidden" name="link" id="link" value="<?php echo $info['filePath']?>">
                                                            <input type="hidden" name="trackingId" value="<?php echo $_GET['trackingId']?>">
                                                            <input type="submit" value="Download Attached File" class="btn-link"></input></span></li>
                                                            
                                                    </ul>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="control-label col-sm-3">Recipients:</label>
                                                    <table class="table datatable-html" id="tableInvited" style="font-size: 13px; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 60%;">Recipient</th>
                                                                <th style="width: 40%;">Response</th>
                                                            </tr>
                                                        </thead>
                                                        <?php if($departmentProfile){foreach($departmentProfile as $dept){?>
                                                        <tbody>
                                                            <td><?php echo $dept['Department'];?></td>
                                                            <td><?php echo $dept['status'];?></td>
                                                        </tbody>
                                                        <?php }}?>
                                                        <?php if($cooperativeProfile){foreach($cooperativeProfile as $coop){?>
                                                        <tbody>
                                                            <td><?php echo $coop['Cooperative_Name'];?></td>
                                                            <td><?php echo $coop['status'];?></td>
                                                        </tbody>
                                                        <?php }}?>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /Content area -->
                    </div>
                    <?php }}?>
                    <!-- /Main content -->

                </div>
                <!-- /Page content -->

            </div>
            <!-- /Page container -->
        </div>

    </form>
</body>
<script>
    var table = $('#tableInvited').DataTable({ });
    table.columns.adjust().draw();
   
    
</script>
</html>