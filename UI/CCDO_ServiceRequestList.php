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
                                    <div class="panel panel-white" id="panelEventList">

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h1 class="panel-title">Service Request List</h1>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <table class="table datatable-html" id="table" style="font-size: 13px; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Contact Person</th>
                                                                <th>Organization</th>
                                                                <th>Request Date</th>
                                                                <th>Status</th>
                                                                <th class="text-center">Actions</th>
                                                            </tr>
                                                        </thead>

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