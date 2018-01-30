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
    $getGoingEvent = $handler->getGoing($_GET['Id']);
    $getNotGoingEvent = $handler->getNotGoing($_GET['Id']);
    $getRecipient = $handler->getRecipient($_GET['Id']);
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
                                                <h1 class="panel-title">Events</h1>
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
                                                                <th>Event Title</th>
                                                                <th>Sent By</th>
                                                                <th>Date</th>
                                                                <th class="text-center">Actions</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php if($eventLists){
                                                                foreach($eventLists as $event){?>
                                                            <tr>
                                                                <td><?php echo $event['eventName'];?></td>
                                                                <td><?php echo $event['idAccounts'];?></td>
                                                                <td><?php echo $event['startDateTime']?></td>
                                                                <td class="text-center">
                                                                    <ul class="icons-list">
                                                                        <li class="text-teal-600"><a href='COOP_EventList.php?Id=<?php echo $event['idEvents']?>' onclick="HideEventListPanel1(this)"><i class="icon-eye" style="margin-right: 10px;"></i>View</a></li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                           <?php }} ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="panel panel-flat border-top-lg border-top-info" id="panelEventDetails" hidden="true">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h2><a onclick="HideEventListPanel(this)"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">Event Details</span></h2>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <?php if($eventViewDetails){
                                                    foreach($eventViewDetails as $details){?>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <p  ID="lblEventName" Font-Size="X-Large" style="font-size: 20px"><?php echo $details['eventName'];?></p>
                                                </div>

                                                <div class="row">
                                                    <p  ID="lblLocation" Text=""  Style="color: darkgrey; font-size: 15px"><?php echo $details['eventLocation'];?></p>
                                                </div>

                                                </hr>

                                                <div class="row">
                                                    <strong style="margin-right: 10px;">Start Time: </strong><p  ID="lblStartDateTime"><?php echo $details['startDateTime'];?></p>
                                                </div>

                                                <div class="row">
                                                    <strong style="margin-right: 10px;">End Time: </strong><p  ID="lblStartDateTime"><?php echo $details['endDateTime'];?></p>
                                                </div>

                                                <div class="row">
                                                    <strong style="margin-right: 10px;">Other Event Details:</strong><p  ID="lblEventDetails" Text=""><?php echo $details['eventDetails'];?></p>
                                                </div>

                                                <div class="row">
                                                </div>
                                                <?php }} ?>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="text-right">
                                                        <?php if($getGoingEvent){
                                                    foreach($getGoingEvent as $going){?>
                                                        <p  ID="lblNumberOfGoing" Text=""  Style="color: darkgrey">Total Number of Going: <?php echo $going['Going'];}}?></p>
                                                    </div>
                                                </div>

                                               <div class="row">
                                                    <div class="text-right">
                                                        <?php if($getNotGoingEvent){
                                                    foreach($getNotGoingEvent as $notGoing){?>
                                                        <p  ID="lblNumberOfNotGoing" Text=""  Style="color: darkgrey">Total Number of Not Going: <?php echo $notGoing['Not Going'];}}?></p>
                                                    </div>
                                                </div>

                                                <br />

                                            </div>

                                            <div class="col-lg-12" style="padding: 10px">
                                                <div class="row">
                                                    <table class="table datatable-html" id="tableInvited" style="font-size: 13px; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%;">Cooperative Name</th>
                                                                <th style="width: 50%;">Response</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php if($getRecipient){
                                                                    foreach($getRecipient as $recipient){?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $recipient['cooperative_name'];?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $recipient['status'];?>
                                                                </td>
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
    function HideEventListPanel() {
        var x = document.getElementById("panelEventList");
        var y = document.getElementById("panelEventDetails");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
        } else {
            x.style.display = "none";
            y.style.display = "block";
        }
    }
    $('#table').dataTable( {
              "columnDefs": [ {
                "targets": 0,
                "orderable": true
                } ],
                "columnDefs": [ {
                "targets": 3,
                "orderable": false
                } ]
            } );   
    <?php
    if (isset($_GET['Id'])){?>
        HideEventListPanel();

    <?php    
    }
    ?>
</script>
</html>