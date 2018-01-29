<?php
$_SESSION['counter'] = 0;
session_start();
if(isset($_SESSION['idSuperAdmin']))
    echo "<script> window.location='';</script>";
else if(isset($_SESSION['idAccountAdmin']))
    echo "<script> window.location='CCDO_AddCooperativeAccount.php'</script>";
else if(isset($_SESSION['idAccount']))
    echo "<script> window.location='COOP_AddDocument.php'</script>";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CCDO - Log in</title>
    <link rel="icon" href="assets/images/CCDO Logo.png" />

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
    <script type="text/javascript" src="assets/js/pages/components_modals.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_notifications_pnotify.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <!-- /theme JS files -->
</head>

<body class="login-container" style="background-color:#009688;">
    <form id="form1" action="loginFunction.php" method="POST" onsubmit="return validateForm()">
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content pb-20">

                        <div class="panel panel-body login-form">
                           
                            <div class="text-center">
                                <div class="icon">
                                    <img class="image" src="assets/images/CCDO Logo.png" style="height: 100px" /></div>
	                                <h5 class="content-group">Login to your account</h5>
	                                <div class="content-divider text-muted">
	                                	<span><small class="display-block">Enter your credentials</small></span>
		                            </div>
	                                <br />
                            </div>
                            <div class="validata">

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" ID="username" name="username" class="form-control" Placeholder="Username" required="required">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" ID="password" name="password" class="form-control" Placeholder="Password" required="required">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="content-divider text-muted"><span><small class="display-block"></small></span></div>
                            <br />

                            <div class="form-group">
                            	<input type="submit" onclick="submitLogin()"  class="btn bg-teal btn-block" value="Log In">
                            </div>

                        </div>

                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->
    </form>
</body>

</html>

<script type="text/javascript">
	function submitLogin(){
        var username = $('#username').val();
        var password = $('#password').val();
		$.ajax({
			type:"POST",
			url: "loginFunction.php",
			data:'password='+password+"&username="+username,
			success:function(data){
                if(data[0]==1){
                    success(data[1]);
                }
                else
                    failed();
			},
            error:function(data){
                failed();
            },
            dataType: "json"
		});
	}
      function success(location){
            setTimeout(function(){
                swal({
                    title: "Success!",
                    text: "",
                    type: "success"
                    },
                    function(isConfirm){
                        window.location=location;
                    });},500); 
        }
        function failed(){
            setTimeout(function(){
                swal({
                    title: "Failed!",
                    text: "Username or Password is incorrect",
                    type: "warning"
                    },
                    function(isConfirm){});},500);
        }
    function validateForm(){
        var fields = $(".validata")
                .find("select, textarea, input").serializeArray();
          
        $.each(fields, function(i, field) {
                swal({
                    title: "Failed!",
                    text: "Fill out all the required fields.",
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
           }); 
    }
</script>
