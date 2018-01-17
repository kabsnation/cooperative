<?php
require("../config/config.php");
require("../Handlers/EventHandler.php");
$handler = new EventHandler();
$eventLists = $handler->getEvents();
?>

<html>
<head >    
    <title>CCDO - Event List</title>

    <link rel="icon" href="../assets/images/CCDO Logo.png" />

    <!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"/>
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/core.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/components.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css"/>
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/notifications/noty.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/pages/datatables_data_sources.js"></script>
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/components_notifications_other.js"></script>
	<!-- /theme JS files -->

    <script src="pnotify.custom.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="pnotify.custom.min.css" />
</head>
<body>
    <form id="form1" >
        <div>
        <!-- Main navbar -->
        <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/CCDO Logo.png" alt=""style="background-color:#ffffff"  /></a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img alt="">
                        <i class="icon-cog5"></i>
                        <span>Username</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                        <li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->

            <!-- Page container -->
            <div class="page-container">

                <!-- Page content -->
                <div class="page-content">

                    <!-- Main sidebar -->
                    <div class="sidebar sidebar-main">
                        <div class="sidebar-content">

                            <!-- User menu -->
                            <div class="sidebar-user">
                                <div class="category-content">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="assets/images/CCDO Logo.png" class="img-circle img-sm" alt="" style="background-color: White" />
                                        </div>
                                        <div class="media-body">
                                            <span class="media-heading text-semibold">
                                                <label  ID="txtUser" Text="Username"></label></span>
                                            <div class="text-size-mini text-muted">
                                                <i class="icon-pin text-size-small"></i>&nbsp;Santa Rosa, Laguna
								
                                       
                                            </div>
                                        </div>

                                        <div class="media-right media-middle">
                                            <ul class="icons-list">
                                                <li>
                                                    <a href="#"><i class="icon-cog3"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /user menu -->

                            <!-- Main Navigation -->
                            <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <ul class="navigation navigation-main navigation-accordion">

                                    <li class="active">
                                        <a href="#"><i class="icon-calendar"></i><span> Events</span></a>
                                        <ul>
                                            <li><a href="COOP_AddEvent.php">Add Events</a></li>
                                            <li class="active"><a href="COOP_EventList.php">Events List</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- /Main Navigation -->

                        </div>
                    </div>
                    <!--/ Main sidebar -->

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
                                                                        <li class="text-teal-600"><a href="#" onclick="HideEventListPanel1(this)"><i class="icon-eye" style="margin-right: 10px;"></i>View</a></li>
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


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                    <asp:UpdatePanel  Visible="true">
                                                        <ContentTemplate>
                                                            <input type="submit" ID="btnGoing" Text="Going" class="btn btn-info" Style="margin-right: 10px;" value="Going" />
                                                            <input type="submit" ID="btnNotGoing" Text="Not Going" class="btn btn-danger" value="Not Going"/>
                                                        </ContentTemplate>
                                                    </asp:UpdatePanel>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <p  ID="lblEventName" Font-Size="X-Large" style="font-size: 20px">Cooperative Awarding Ceremony</p>
                                                </div>

                                                <div class="row">
                                                    <p  ID="lblLocation" Text=""  Style="color: darkgrey; font-size: 15px">4th Floor, Function Hall, City Government Office, Barangay Tagapo, City of Santa Rosa, Laguna</p>
                                                </div>

                                                </hr>

                                                <div class="row">
                                                    <strong style="margin-right: 10px;">Date and Time:</strong><p  ID="lblStartDateTime">December 1, 2017 1:00 PM</p>
                                                </div>

                                                <div class="row">
                                                    <strong style="margin-right: 10px;">Other Event Details:</strong><p  ID="lblEventDetails" Text="">Other Event Details</p>
                                                </div>

                                                <div class="row">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="text-right">
                                                        <p  ID="lblNumberOfGoing" Text=""  Style="color: darkgrey">Total Number of Going: 7</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="text-right">
                                                        <p  ID="lblNumberOfInterested" Text=""  Style="color: darkgrey">Total Number of Interested: 2</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="text-right">
                                                        <p  ID="lblNumberOfNotGoing" Text=""  Style="color: darkgrey">Total Number of Not Going: 3</p>
                                                    </div>
                                                </div>

                                                <br />

                                            </div>

                                            <div class="col-lg-12" style="padding: 10px">
                                                <div class="row">
                                                    <table class="table datatable-html" id="tableInvited" style="font-size: 13px; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 80%;">Cooperative Name</th>
                                                                <th style="width: 20%;">Response</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            
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
</script>
</html>
