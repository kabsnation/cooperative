<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>CCDO -  Edit Account</title>

    <link rel="icon" href="../assets/images/CCDO Logo.png" />

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="assets/css/sweetalert.css" />

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css" />
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="assets/jquery.maskedinput.js" type="text/javascript"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_validation.js"></script>
    <script src="assets/jquery.maskedinput.js" type="text/javascript"></script>
    <!-- /theme JS files -->
</head>
<body>

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

            <!-- Main Content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header">

                    <!-- Header content -->
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><span class="text-semibold">Account Settings</span></h4>
                        </div>
                    </div>
                    <!-- /header content -->


                    <!-- Toolbar -->
                    <div class="navbar navbar-default navbar-component navbar-xs">
                        <ul class="nav navbar-nav visible-xs-block">
                            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                        </ul>

                        <div class="navbar-collapse collapse" id="navbar-filter">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#activity" data-toggle="tab"><i class="icon-cogs position-left"></i> General Account Settings</a></li>
                                <li><a href="#settings" data-toggle="tab"><i class="icon-lock2 position-left"></i> Security and Login</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /toolbar -->

                </div>
                <!-- /page header -->

                <div class="content">

                    <!-- User profile -->
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="tabbable">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="activity">

                                        <div class="row">
                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Name</h6>
                                                        Juan Dela Cruz
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Username</h6>
                                                        juandelacruz01
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Email Address</h6>
                                                        juandelacruz01@gmail.com
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Phone Number</h6>
                                                        (+63)99-999-9999
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane" id="settings">

                                        <div class="row" id="changePass" style="display: block;">
                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Change Password <a onclick="editPassword()" class="text-muted"><i class="icon-pencil4 pull-right"></i></a></h6>
                                                        It's a good idea to use a strong password that you're not using elsewhere
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="updatePass" style="display: none;">
                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Update Password <a onclick="updatePassword()" class="text-muted"><i class="icon-cross3 pull-right" title="Cancel"></i></a></h6>

                                                        <div class="form-group">
                                                            <label>Old Password:</label>
                                                            <input type="password" class="form-control" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>New Password:</label>
                                                            <input type="password" id="txtPassword" class="form-control" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Re-enter New Password:</label>
                                                            <input type="password" equalTo="#txtPassword" class="form-control" />
                                                        </div>

                                                        <div class="text-right">
                                                            <div class="form-group">
                                                                <input type="button" value="Save" class="btn btn-primary">
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
                    <!-- User profile -->

                </div>
            </div>
            <!-- /Main Content -->

        </div>
        <!-- /Page content -->
    </div>
    <!-- /Page container -->

    <script type="text/javascript">
        function editPassword(){
            var x = document.getElementById("changePass");
            var y = document.getElementById("updatePass");
            x.style.display = "none";
            y.style.display = "block";
        }

        function updatePassword(){
            var x = document.getElementById("changePass");
            var y = document.getElementById("updatePass");
            x.style.display = "block";
            y.style.display = "none";
        }
    </script>

</body>
</html>

