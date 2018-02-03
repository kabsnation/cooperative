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
<form id="downloadform" action="downloadFunction.php" method="POST">
<!--/ Main sidebar -->
                    <?php if($trackInfo){foreach($trackInfo as $info){?>
                    <!-- Main content -->
                    <div class="content-wrapper">

                        <!-- Content area -->
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">

                                    <!-- Details -->
                                    <div class="panel panel-white border-top-lg border-top-info">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h4><a href="<?php echo $loc;?>"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold"><?php echo $info['title'];?></span></h4>
                                            </div>
                                        </div>

                                        <div id="invoice-editable">
                                            <div class="panel-body">
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-7 content-group">
                                                        <span class="text-muted">Sender's Details:</span>
                                                        <ul class="list-condensed list-unstyled">
                                                            <li><h5><?php echo $info['name'];?></h5></li>
                                                            <li><a href="#"><?php echo $info['email'];?></a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-md-6 col-lg-5 content-group">
                                                        <span class="text-muted">Document Details:</span>
                                                        <ul class="list-condensed list-unstyled invoice-payment-details">
                                                            <li>Tracking Number: <span class="text-semibold"><?php echo $info['trackingNumber'];?></span></li>
                                                            <li>Date Added: <span class="text-semibold"><?php echo $info['DateTime']?></span></li>
                                                            <li>Document Type: <span class="text-semibold"><?php echo $info['Document']?></span></li>
                                                            <li>Attached File: <span class="text-semibold"><a onclick="document.getElementById('downloadform').submit()">Download Attached File</a></span></li>
                                                        </ul>
                                                        <input type="hidden" name="link" id="link" value="<?php echo $info['filePath']?>">
                                                        <input type="hidden" name="trackingId" value="<?php echo $_GET['trackingId']?>">
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <span class="text-muted">Recipients:</span>
                                                        <table class="table table-lg" id="tableInvited" style="font-size: 13px; width: 100%;">
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
                                    <!-- /Details -->

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