<?php
session_start();
if(!isset($_SESSION['idEvent'])){
    echo "<script>window.location='index.php';</script>";
}
$id = $_SESSION['idEvent'];
require("../config/config.php");
require("../Handlers/AccountHandler.php");
require("../Handlers/EventHandler.php");
$handler = new EventHandler();
$eventLists = $handler->getEvents();
if (isset($_GET['Id'])){
    $eventViewDetails = $handler->getEventDetails($_GET['Id']);
    if($eventViewDetails){
        $getGoingEvent = $handler->getGoing($_GET['Id']);
        $getNotGoingEvent = $handler->getNotGoing($_GET['Id']);
        $getRecipient = $handler->getRecipient($_GET['Id']);
    }
    else{
        echo "<script>window.location='COOP_EventList.php'</script>";
    }
}
include('../UI/header/header_events.php');
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
                                                <h4><a href="<?php echo $loc;?>"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">Service Request Details</span></h4>
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
	                                                            <li><h5>Contact Person</h5></li>
	                                                            <li><h6>Organization / Cooperative</h6></li>
	                                                            <li>Address</li>
	                                                            <br/>
	                                                            <li class="text-muted">Contact Information:</li>
	                                                            <li><a href="#">Email Address</a></li>
	                                                            <li><a href="#">Contact Number</a></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="col-md-6 col-lg-5 content-group">
	                                                        <span class="text-muted">Service / Request Details:</span>
	                                                        <ul class="list-condensed list-unstyled invoice-payment-details">
	                                                            <li>Activity Date: <span class="text-semibold"></span></li>
	                                                            <li>Time: <span class="text-semibold"></span></li>
	                                                            <li>Venue: <span class="text-semibold"></span></li>
	                                                            <li>Expected Number of Participants: <span class="text-semibold"></span></li>
	                                                            <li>Requested Service: <span class="text-semibold"></span></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="col-md-12">
	                                                    	<span class="text-muted">Recipients:</span>
	                                                        <table class="table table-lg" id="tableRecipients" style="font-size: 13px; width: 100%;">
	                                                            <thead>
	                                                                <tr>
	                                                                    <th style="width: 60%;">Recipient</th>
	                                                                    <th style="width: 40%;">Response</th>
	                                                                </tr>
	                                                            </thead>
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