<?php
$handler = new AccountHandler();
$admin = $handler->getAccountById($_SESSION['idAccount']);
$arrs = array();
$title ="";
$_SESSION['counter']=0;
$id = $_SESSION['idAccount'];
if(strpos($_SERVER['REQUEST_URI'],'COOP_AddDocument.php')){
    $arrs[0]="active";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $title = "CCDO - Add Document";
}
else if(strpos($_SERVER['REQUEST_URI'],'COOP_DocumentList.php')){
    $arrs[0]="";
    $arrs[1]="active";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $title = "CCDO - Document List";
}
else if(strpos($_SERVER['REQUEST_URI'],'CCDO_Inbox.php')){
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="active";
    $arrs[3]="";
    $arrs[4]="";
    $title = "CCDO - Inbox";
}
else if(strpos($_SERVER['REQUEST_URI'],'CCDO_ViewMessage.php')){
	$arrs[0]="";
    $arrs[1]="";
    $arrs[2]="active";
    $arrs[3]="";
    $arrs[4]="";
    $title = "CCDO - Inbox";
}
else if(strpos($_SERVER['REQUEST_URI'],'ViewTracking.php')){
    $arrs[0]="";
    $arrs[1]="active";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="";
    $title = "CCDO - Document List";
}
else if(strpos($_SERVER['REQUEST_URI'],'CCDO_Trash.php')){
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="active";
    $arrs[4]="";
    $title = "CCDO - Trash";
}
else if(strpos($_SERVER['REQUEST_URI'],'COOP_TransactionLogs.php')){
    $arrs[0]="";
    $arrs[1]="";
    $arrs[2]="";
    $arrs[3]="";
    $arrs[4]="active";
    $title = "CCDO - Logs";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title><?php echo $title;?></title>
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
    <script type="text/javascript" src="assets/js/plugins/uploaders/fileinput.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/uploader_bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/plugins/editors/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_notifications_pnotify.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
    <script src="assets/jquery.maskedinput.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min"></script>
    <script type="text/javascript" src="assets/js/pages/form_validation.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script type="text/javascript" src="assets/js/pages/picker_date.js"></script>
    <!-- /theme JS files -->
    

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
                        <?php if($admin){foreach($admin as $info){?>
                        <span><?php echo $info['name'];?></span>
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
                                                <label  ID="txtUser" Text="Username"><?php echo $info['name']?></label></span>
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
                            <?php }}?>
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
                                                <li class="<?php echo $arrs[2]?>"><a href="CCDO_Inbox.php">Inbox <label id="badge" class="badge bg-blue-400"></label></a></li>
                                                <li class="<?php echo $arrs[3]?>"><a href="CCDO_Trash.php">Trash</a></li>
                                            </ul>
                                        </li>
                                        <li class="<?php echo $arrs[4]?>"><a href="COOP_TransactionLogs.php"><i class="icon-stack-text"></i><span> Logs</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Main Navigation -->

                        </div>
                    </div>
                    <!--/ Main sidebar -->

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
        setInterval(realTime1,1000);
        function realTime1(){
             $.ajax({
                type: "POST",
                url: "checkerCounter.php",
                data: "id=<?php echo $id;?>",
                success: function(data){
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
                title: 'You have new message from '+sender,
                type: 'success',
                text: title,
                desktop: {
                    desktop: true,
                    icon: 'assets/images/pnotify/info.png'
                }
            })
            ).get().click(function(e) {
                if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
                window.location='CCDO_Inbox.php';
            });
        }
    </script>