<?php
$handler = new AccountHandler();
$admin = $handler->getAccountById($_SESSION['idSuperAdmin']);
$arrs = array();
$id = $_SESSION['idSuperAdmin'];
$_SESSION['counter']=0;
$title ="";
if(strpos($_SERVER['REQUEST_URI'],'SuperAdmin_Dashboard.php')){
    $arrs[0]="active";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Dashboard";
}

else if(strpos($_SERVER['REQUEST_URI'],'SuperAdmin_DocumentTracker.php')){
    $arrs[0]="";
    $arrs[1]="active";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Document Tracker";
}
else if(strpos($_SERVER['REQUEST_URI'],'ViewTracking.php')){
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Document Tracker";
}
else if (strpos($_SERVER['REQUEST_URI'],'SuperAdmin_EventList.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="active";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Event List";
}
else if (strpos($_SERVER['REQUEST_URI'],'SuperAdmin_AccountsList.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="active";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Account List";
}
else if (strpos($_SERVER['REQUEST_URI'],'CCDO_ViewAndUpdateCooperativeProfile.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="active";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Account List";
}
else if (strpos($_SERVER['REQUEST_URI'],'CCDO_ViewAndUpdateDepartmentProfile.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="active";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Account List";
}
else if (strpos($_SERVER['REQUEST_URI'],'EditAccount.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Edit Account";
}
else if (strpos($_SERVER['REQUEST_URI'],'SuperAdmin_TransactionLogs.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="active";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Transaction Logs";
}
else if (strpos($_SERVER['REQUEST_URI'],'CCDO_Inbox.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="active";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Inbox";
}
else if (strpos($_SERVER['REQUEST_URI'],'CCDO_ViewMessage.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="active";
    $arrs[6]="";
    $arrs[7]="";
    $title = "CCDO - Inbox";
}
else if (strpos($_SERVER['REQUEST_URI'],'CCDO_Trash.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="active";
    $arrs[7]="";
    $title = "CCDO - Trash";
}
else if (strpos($_SERVER['REQUEST_URI'],'CCDO_ServiceRequestList.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="active";
    $title = "CCDO - Service Request Tracker";
}
else if (strpos($_SERVER['REQUEST_URI'],'ViewServiceRequest.php')) {
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $arrs[5]="";
    $arrs[6]="";
    $arrs[7]="active";
    $title = "CCDO - Service Request Tracker";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?></title>

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
    <script type="text/javascript" src="assets/js/plugins/uploaders/fileinput.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/uploader_bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/plugins/editors/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_notifications_pnotify.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_validation.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_notifications_other.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/picker_date.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/touch.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_navs.js"></script>

    <!-- /theme JS files -->

</head>

<!-- Main navbar -->
    <div id="header" class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/CCDO Logo.png" alt=""/></a>

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
                         <?php if($admin){foreach($admin as $info){?>
                        <span><?php echo $info['First_Name'];?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="EditAccount.php"><i class="icon-cog5"></i> Account settings</a></li>
                        <li><a onclick="logOut()"><i class="icon-switch2"></i> Logout</a></li>
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
            <div class="sidebar sidebar-main sidebar-inverse">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="category-content">
                            <div class="media">
                                <div class="media-body">
                                    <span class="media-heading text-semibold"><?php echo $info['First_Name']." ".$info['Last_Name'];?></span>
                                    <div class="text-size-mini text-muted">
                                        Department Head - CCDO
                                    </div>
                                </div>

                                <div class="media-right media-middle">
                                    <ul class="icons-list">
                                        <li>
                                            <a  href="EditAccount.php"><i class="icon-cog3"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /user menu -->

                    <?php }}?>
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">

                                <!-- Main -->
                                <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                <li class="<?php echo $arrs[0];?>"><a href="SuperAdmin_Dashboard.php"><i class="icon-home2"></i> <span>Dashboard</span></a></li>

                                <li class="navigation-header"><span>Monitoring</span> <i class="icon-menu" title="Monitoring"></i></li>
                                <li class="<?php echo $arrs[1];?>"><a href="SuperAdmin_DocumentTracker.php"><i class="icon-file-eye2"></i> <span>Document Tracker</span></a></li>
                                <li class="<?php echo $arrs[2];?>"><a href="SuperAdmin_EventList.php"><i class="icon-calendar22"></i><span>Event Viewer</span></a></li>
                                <li class="<?php echo $arrs[7];?>"><a href="CCDO_ServiceRequestList.php"><i class="icon-cogs"></i><span>Service Request Tracker</span></a></li>

                                <li class="navigation-header"><span>Accounts</span> <i class="icon-menu" title="Accounts"></i></li>

                                <li class="<?php echo $arrs[3];?>"><a href="SuperAdmin_AccountsList.php"><i class="icon-users4"></i> <span>Accounts List</span></a></li>

                                <li class="navigation-header"><span>Messages</span> <i class="icon-menu" title="Monitoring"></i></li>
                                <li class="<?php echo $arrs[5]?>"><a href="CCDO_Inbox.php"><span>Inbox</span> <i class="icon-envelope"></i> <label id="badge" class="badge bg-blue-400"></label></a></li>
                                <li class="<?php echo $arrs[6]?>"><a href="CCDO_Trash.php"><span>Trash</span><i class=" icon-trash"></i></a></li>

                                <li class="navigation-header"><span>Logs</span> <i class="icon-menu" title="Logs"></i></li>

                                <li class="<?php echo $arrs[4];?>"><a href="SuperAdmin_TransactionLogs.php"><i class="icon-stack-text"></i> <span>Transaction Logs</span></a></li>

                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->
<script type="text/javascript">
     var time =  localStorage.getItem("time");
                console.log(time);
      if(time == null){
        //get time
        $.ajax({
            type: "POST",
            url: "setting.php",
            data:"",
            success:function(data){
                localStorage.setItem("time", data);
                time =  localStorage.getItem("time");
            }
        });
      }
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
         setInterval(realTime1,1000);
         setInterval(realTime2,time);
        function realTime2(){
             $.ajax({
                type: "POST",
                url: "checkerCounter1.php",
                data: "id=<?php echo $id;?>",
                success: function(data){
                     if(data!=0)
                        newMessageNotification1();
                },
                dataType: "json"
            });
        }
        function newMessageNotification1(){
            PNotify.desktop.permission();
            (new PNotify({
                title: 'Warning',
                type: 'error',
                text: 'You have a pending message that needs a reply.',
                hide: false,
                desktop: {
                    desktop: true,
                    addclass: 'bg-green',
                    icon: 'assets/images/pnotify/info.png'
                }
            })
            ).get().click(function(e) {
                if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
                window.location='CCDO_Inbox.php';
            });
        }
        function realTime1(){
             $.ajax({
                type: "POST",
                url: "checkerCounter.php",
                data: "id=<?php echo $id;?>",
                success: function(data){
                    console.log(data);
                     if(data == 1){
                        addToCounter();
                    }
                },
                dataType: "json"
            });
        } 
        function addToCounter(){
             $.ajax({
                type: "POST",
                url: "realtimeCounter.php",
                data: "",
                success: function(data){ 
                    var badge = document.getElementById('badge');
                    if(data !=0){
                        badge.innerHTML = data;
                        console.log('addto'+data);
                        toNotify();  
                    }
                    
                    else{

                        badge.innerHTML = null;
                    }
                    
                },
                dataType: "json",
                error:function(data){
                    alert(data);
                }
            });
        }
        function toNotify(){
            $.ajax({
                type: "POST",
                url: "notifyFunction.php",
                data: "id=<?php echo $id;?>",
                success: function(data){ 
                    if(data!=0){
                        
                        console.log('toNotify'+data);
                        for(var i =0; i<data.length;i++){
                            newMessageNotification(data[i].title,data[i].name);
                        }
                    }  
                },
                dataType: "json",
                error:function(data){
                    alert(data);
                }
            });
        }
        function newMessageNotification(title,sender){
            PNotify.desktop.permission();
            (new PNotify({
                title: 'New message from '+sender,
                type: 'success',
                text: title + ' (Click this to open the message)',
                hide: false,
                desktop: {
                    desktop: true,
                    addclass: 'bg-green',
                    icon: 'assets/images/pnotify/info.png'
                }
            })
            ).get().click(function(e) {
                if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
                window.location='CCDO_Inbox.php';
            });
        }

    </script>