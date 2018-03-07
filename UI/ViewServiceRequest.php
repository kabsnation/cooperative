<?php
session_start();
require("../config/config.php");
require("../Handlers/AccountHandler.php");
require("../Handlers/ServiceRequestHandler.php");
if(isset($_SESSION['idSuperAdmin'])){
    include('../UI/header/header_sadmin.php');
    $id = $_SESSION['idSuperAdmin'];
}
else if(isset($_SESSION['idEvent'])){
    include('../UI/header/header_events.php');
    $id = $_SESSION['idEvent'];
}
else{
    echo "<script>window.location='index.php';</script>";
}
$handler = new ServiceRequestHandler();
if(isset($_GET['id'])){
    $conn = new Connect();
    $con = $conn->connectDB();
    $id = mysqli_real_escape_string($con,stripcslashes(trim($_GET["id"])));
    $serviceInfo = $handler->getServiceRequestInfo($id);
    $serviceRecipient =$handler->getServiceRecipient($id);
}
?>
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
                                                <h4><a href='CCDO_ServiceRequestList.php'><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">Service Request Details</span></h4>
                                            </div>
                                        </div>

                                        <div id="invoice-editable">
                                            <div class="panel-body">
                                                <br/>
                                                <div class="col-lg-12">
                                                	<div class="row">

	                                                	<div class="col-md-6 col-lg-7 content-group">
	                                                        <span class="text-muted">Inquirer's Details:</span>
	                                                        <ul class="list-condensed list-unstyled">
                                                                <?php if($serviceInfo){
                                                                    foreach($serviceInfo as $info){?>
	                                                            <li><h5>Contact Person: </h5> <?php echo $info['contact_person'];?></li>
	                                                            <li><h6>Organization / Cooperative: </h6><?php echo $info['organization'];?></li>
	                                                            <li>Address: <?php echo $info['contact_person'];?></li>
	                                                            <br/>
	                                                            <li class="text-muted">Contact Information:</li>
	                                                            <li><a href="#">Email Address: </a><?php echo $info['email'];?></li>
	                                                            <li><a href="#">Contact Number: </a><?php echo $info['contact_no'];?></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="col-md-6 col-lg-5 content-group">
	                                                        <span class="text-muted">Service / Request Details:</span>
	                                                        <ul class="list-condensed list-unstyled invoice-payment-details">
	                                                            <li>Activity Date: <span class="text-semibold"> <?php echo $info['activity_date'];?></span></li>
	                                                            <li>Time: <span class="text-semibold"><?php echo $info['activity_time'];?></span></li>
	                                                            <li>Venue: <span class="text-semibold"><?php echo $info['venue'];?></span></li>
	                                                            <li>Expected Number of Participants: <span class="text-semibold"><?php echo $info['no_participants'];?></span></li>
	                                                            <li>Requested Service: <span class="text-semibold"><?php echo $info['service'];?></span></li>
	                                                        </ul>
	                                                    </div>
                                                        <?php }}?>
	                                                    <div class="col-md-12">
	                                                    	<span class="text-muted">Recipients:</span>
	                                                        <table class="table table-lg" id="tableRecipients" style="font-size: 13px; width: 100%;">
	                                                            <thead>
	                                                                <tr>
	                                                                    <th style="width: 60%;">Recipient</th>
	                                                                    <th style="width: 40%;">Response</th>
	                                                                </tr>
	                                                            </thead>
                                                                <tbody>
                                                                    <?php if($serviceRecipient){foreach($serviceRecipient as $recp){?>
                                                                    <tr>
                                                                        <td><?php echo $recp['name'];?></td>
                                                                        <td><?php echo $recp['status'];?></td>
                                                                    </tr>
                                                                    <?php }}?>
                                                                </tbody>
	                                                        </table>
	                                                    </div>

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

                    <!-- /Main content -->

                </div>
                <!-- /Page content -->

            </div>
            <!-- /Page container -->
        </div>

    </form>
</body>
<script>


    
</script>
</html>