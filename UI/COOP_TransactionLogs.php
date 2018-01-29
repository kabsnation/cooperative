<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>CCDO - Logs</title>
 <link rel="icon" href="../assets/images/CCDO Logo.png" />

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/datatables_data_sources.js"></script>
    
    <script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/picker_date.js"></script>

</head>
<body>
    
        <div id="header">

                    <!-- Main navbar -->
        <div id="header" class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/CCDO Logo.png"/></a>

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
                        <span></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                        <li><a onclick="newMessageNotification()"><i class="icon-switch2"></i> Sample</a></li>
                        <li><a onclick="logOut()"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        function logOut(){
            $.ajax({
            type: "POST",
            url: "/coop/UI/logout.php",
            data: "type='admin'",
            success: function(data){
                 window.location ='index.php';
            }
        });
        }
        function realTime(){
            setTimeout(realTime,10000);
             $.ajax({
                type: "POST",
                url: "checkerInbox.php",
                data: "count="+info.recordsTotal+"&id="+<?php echo $id;?>,
                success: function(data){
                     if(data == 1){
                        addRow();
                    }
                },
                dataType: "json"
            });
        }  
        function newMessageNotification(){
            PNotify.desktop.permission();
            (new PNotify({
                title: 'New Message',
                type: 'success',
                text: 'Subject: From: ',
                desktop: {
                    desktop: true,
                    icon: 'assets/images/pnotify/info.png'
                }
            })
            ).get().click(function(e) {
                if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
                alert('Redirect to view messge');
            });
        }
    </script>
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

                                       <li>
                                            <a href="#"><i class="icon-file-text2"></i><span> Document</span></a>
                                            <ul>
                                                <li class="<?php echo $arrs[0]?>"><a href="COOP_AddDocument.php">Add Document</a></li>
                                                <li class="<?php echo $arrs[1]?>"><a href="COOP_DocumentList.php">Documents List</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#"><i class="icon-mail5"></i><span>Messages</span></a>
                                            <ul>
                                                <li class="<?php echo $arrs[2]?>"><a href="CCDO_Inbox.php">Inbox <span class="badge bg-blue-400"><?php echo '1' ?></span></a></li>
                                                <li class="<?php echo $arrs[3]?>"><a href="CCDO_Trash.php">Trash</a></li>
                                            </ul>
                                        </li>

                                        <li class="active"><a href="COOP_TransactionLogs.php"><i class="icon-stack-text"></i><span> Logs</span></a></li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /Main Navigation -->

                        </div>
                    </div>
                    <!--/ Main sidebar -->

<!-- Main content -->
                    <div class="content-wrapper">
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="panel panel-white" id="panelEventList">

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h1 class="panel-title">Logs</h1>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tabbable">
                                                <ul class="nav nav-tabs nav-tabs-bottom">
                                                    <li class="active"><a href="#coopAccounts" data-toggle="tab">Transaction Logs</a></li>
                                                    <li><a href="#deptAccounts" data-toggle="tab">History</a></li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane animated fadeIn active" id="coopAccounts">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <div class="col-lg-12">
                                                                    <div class="text-right">
                                                                        <div class="form-group">Select Date Range:
                                                                            <button type="button" class="btn btn-info daterange-ranges">
                                                                                <i class="icon-calendar22 position-left"></i> <span></span> <b class="caret"></b>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <table class="table datatable-html" id="tableCoopeartiveAccount" style="font-size: 13px; width: 100%;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tracking No.</th>
                                                                                <th>Type</th>
                                                                                <th>Date Added</th>
                                                                                <th class="text-center">Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="tab-pane animated fadeIn" id="deptAccounts">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <div class="col-lg-12">
                                                                    <table class="table datatable-html" id="tableCoopeartiveAccount" style="font-size: 13px; width: 100%;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tracking No.</th>
                                                                                <th>Type</th>
                                                                                <th>Date Added</th>
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
</html>