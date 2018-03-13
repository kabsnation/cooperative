<?php
$_SESSION['counter'] = 0;
session_start();

if(isset($_SESSION['idSuperAdmin']))
    echo "<script> window.location='SuperAdmin_Dashboard.php';</script>";
else if(isset($_SESSION['idAccountAdmin']))
    echo "<script> window.location='CCDO_AddCooperativeAccount.php'</script>";
else if(isset($_SESSION['idAccount']))
    echo "<script> window.location='COOP_AddDocument.php'</script>";
else if(isset($_SESSION['idEvent']))
    echo "<script> window.location='COOP_AddEvent.php'</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CCDO - Log In</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

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
    <!-- /theme JS files -->

</head>

<body class="login-container">

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <!-- Simple login form -->
                    <form method="POST" action="loginFunction.php">

                        <div class="panel panel-body login-form">

                            <div class="text-center">
                                <div><img class="image" src="assets/images/CCDO Logo.png" style="height: 80px" /></div>
                                <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" ID="username" name="username" class="form-control" maxlength="20" Placeholder="Username" required="required">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="password" ID="password" name="password" class="form-control"  maxlength="20" Placeholder="Password" required="required">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button id="btnSubmit" type="button" class="btn btn-info btn-block" onclick="submitLogin()">Sign in <i class="icon-circle-right2 position-right" ></i></button>
                            </div>

                        </div>

                    </form>
                    <!-- /simple login form -->


                    <!-- Footer -->
                    <div class="footer text-muted text-center">
                        &copy; 2018. <a href="#">Document Traking and Event Management System</a> by <a href="#">Polytechnic University of the Philippines - Santa Rosa Campus</a>
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
                console.log(data);
            },
            error:function(data){
                failed();
                console.log(data);
            },
            dataType: "json"
        });
    }
      function success(location){
            setTimeout(function(){
            setTimeout(window.location=location,5000);
                swal({
                    title: "Success!",
                    text: "",
                    type: "success"
                    },
                    function(isConfirm){
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

        $("#password").keyup(function(event) {
            if (event.keyCode === 13) {
                $("#btnSubmit").click();
            }
        });

        $("#username").keyup(function(event) {
            if (event.keyCode === 13) {
                $("#btnSubmit").click();
            }
        });
      var time =  localStorage.getItem("time");
      if(time == null){
        //get time
        $.ajax({
            type: "POST",
            url: "setting.php",
            data:"",
            success:function(data){
                localStorage.setItem("time", data);
                time =  localStorage.getItem("time");
                console.log(time);
            }
        });
      }
    console.log(time);
</script>