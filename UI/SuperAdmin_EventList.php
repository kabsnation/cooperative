<?php
session_start();
if(!isset($_SESSION['idSuperAdmin'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/DocumentHandler.php");
require("../Handlers/EventHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new EventHandler();
$eventLists = $handler->getEvents();
$arrow ='';
if(isset($_GET['Id'])){
    $eventViewDetails = $handler->getEventDetails($_GET['Id']);
    if($eventViewDetails){
        $getGoingEvent = $handler->getGoing($_GET['Id']);
        $getNotGoingEvent = $handler->getNotGoing($_GET['Id']);
        $getRecipient = $handler->getRecipient($_GET['Id']);
        if(isset($_GET['dash']))
            $arrow='<a href="SuperAdmin_Dashboard.php"><i class="icon-arrow-left52 position-left"></i></a>';
        else
            $arrow='<a href="SuperAdmin_EventList.php"><i class="icon-arrow-left52 position-left"></i></a>';
    }
    else
        echo "<script>window.location='SuperAdmin_EventList.php';</script>";
   
}
include('../UI/header/header_sadmin.php');
?>

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4> <?php echo $arrow?><span class="text-semibold">Administrator</span> - Event Viewer</h4>
                        </div>

                    </div>
                </div>
                <!-- /page header -->


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
                                            <table class="table datatable-html" id="tableCoopeartiveAccount" style="font-size: 13px; width: 100%;">
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
                                                                <td><?php echo $event['Username'];?></td>
                                                                <td><?php echo $event['startDateTime']?></td>
                                                               <td class="text-center">
                                                                    <ul class="icons-list">
                                                                        <li class="text-teal-600"><a href='SuperAdmin_EventList.php?Id=<?php echo $event['idEvents']?>' onclick="HideEventListPanel1(this)"><i class="icon-eye" style="margin-right: 10px;"></i>View</a></li>
                                                                         <li style="color: #FFC107"><a href='SuperAdmin_EventList.php?Id=<?php echo $event['idEvents']?>' onclick="HideEventListPanel1(this)"><i class="icon-pencil7" style="margin-right: 10px;"></i>Update</a></li>
                                                                          <li class="text-danger"><a  onclick="promptDelete(<?php echo $event['idEvents']?>)"><i class="icon-user-minus" style="margin-right: 10px;"></i>Delete</a></li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                           <?php }} ?>
                                                </tbody>
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

                                            <div class="heading-elements">
                                                <div id="editButton" style="display: block;">
                                                    <button class="btn btn-info" onclick="editDetails()">Edit</button>
                                                </div>
                                                
                                                <div id="saveButton" style="display: none;">
                                                    <button class="btn btn-primary" onclick="updateEvent()">Save</button>
                                                    <button class="btn btn-danger" onclick="cancel()">Cancel</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <form id="form1">
                                            <input type="hidden" id="idevent" value="<?php echo $_GET['Id'];?>">
                                        <div class="panel-body">
                                            <?php if($eventViewDetails){
                                                    foreach($eventViewDetails as $details){?>
                                            <div class="col-lg-6">
                                                <div class="col-lg-6">
                                                    <p  ID="lblEventName" Font-Size="X-Large" style="font-size: 20px"><?php echo $details['eventName'];?></p>
                                                </div>

                                                <div id="viewLocation" class="col-lg-12" style="display: block;">
                                                    <p  ID="lblLocation" Text=""  Style="color: darkgrey; font-size: 15px"><?php echo $details['eventLocation'];?></p>

                                                    <div class="col-lg-6">
                                                        <strong style="margin-right: 10px;">Start Time: </strong><p  ID="lblStartDateTime"><?php echo $details['startDateTime'];?></p>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <strong style="margin-right: 10px;">End Time: </strong><p  ID="lblStartDateTime"><?php echo $details['endDateTime'];?></p>
                                                    </div>

                                                </div>

                                                <div id="editLocation" class="col-lg-12" style="display: none;">
                                                    <label class="text-semibold">New Location:</label>
                                                    <textarea id="txtNewLocation" type="text" name="location" class="form-control"><?php echo $details['eventLocation'];?></textarea>
                                                

                                                    <br/>
                                                    <label class="text-semibold">New Start and End Time:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                        <input type="text" class="form-control daterange-time" id="date" name="date" value="01/01/2018 - 01/02/2018"> 
                                                    </div>

                                                    <br/>
                                                </div>

                                                <div class="col-lg-12">
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

                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; 2018. <a href="#">Document Tracking System</a> by <a> Polytechnic University of the Philippines - Santa Rosa Campus</a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
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

    function editDetails(){
        var a = document.getElementById("viewLocation");
        var b = document.getElementById("editLocation");
        var c = document.getElementById("editButton");
        var d = document.getElementById("saveButton");

        a.style.display = "none";
        b.style.display = "block";
        c.style.display = "none";
        d.style.display = "block";
    }

    function cancel(){
        var a = document.getElementById("viewLocation");
        var b = document.getElementById("editLocation");
        var c = document.getElementById("editButton");
        var d = document.getElementById("saveButton");

        a.style.display = "block";
        b.style.display = "none";
        c.style.display = "block";
        d.style.display = "none";
    }
    function updateEvent(){
         var form_data = $('#form1').serialize();
            var idevent = $('#idevent').val();
                $.ajax({
                    type: "POST",
                    url: "updateEventFunction.php",
                    data: form_data+"&idevent="+idevent,
                    dataType: "json",
                    success: function(data){
                        success();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
    }
  function promptDelete(val){
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this information!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#FF7043",
                        confirmButtonText: "Delete",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            deletee(val);
                        }
                });
            }

            function deletee(val){
                $.ajax({
                type: "POST",
                url: "deleteFunction.php",
                data: 'idEvents=' + val,
                    success: function(data){
                        success();
                    }
                });
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
                        text: "",
                        type: "warning"
                        },
                        function(isConfirm){});},500);
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
</body>
</html>