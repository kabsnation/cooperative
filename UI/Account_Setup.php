<?php
session_start();
if(!isset($_SESSION['idsetup']))
    echo "<script> window.location='index.php'</script>";
$id = $_SESSION['idsetup'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CCDO - Setting Up Your Account</title>

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
	<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/wizards/form_wizard/form.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/wizard_form.js"></script>
	<!-- /theme JS files -->

</head>
<body>

    <!-- Main navbar -->
    <div id="header" class="navbar navbar-inverse">

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">

            	<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img alt="">
						<span><i class="icon-cog"></i></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
				</li>
                <li class="dropdown dropdown-user">

                    
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->    <!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><span class="text-semibold">Setting up your Account</span></h4>
							<p>Since this your first time in using the system let's configure your account.</p>
						</div>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Wizard with validation -->
		            <div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">Account Configuration</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                	</ul>
		                	</div>
						</div>

<form action="addAccountAdmin.php" method="POST"  class="form-validation" >
							<fieldset class="step" id="validation-step1">
								<h6 class="form-wizard-title text-semibold">
									<span class="form-wizard-count">1</span>
									General Information
									<small class="display-block">Tell us a bit about yourself</small>
								</h6>

								<div class="row">
									<div class="col-lg-12"><legend class="text-bold">Personal Information</legend></div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label>Last Name: <span class="text-danger">*</span></label>
											<input type="text" id="txtLastName" name="txtLastName" class="form-control required" placeholder="Dela Cruz">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>First Name: <span class="text-danger">*</span></label>
											<input type="text" id="txtFirstName" name="txtFirstName" class="form-control required" placeholder="Juan">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Middle Name: <span class="text-danger">*</span></label>
											<input type="text" id="txtMiddleName" name="txtMiddleName" class="form-control required" placeholder="Protacio">
										</div>
									</div>

								</div>

								<br/>

								<div class="row">
									<div class="col-lg-12"><legend class="text-bold">Contact Information</legend></div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Email address: <span class="text-danger">*</span></label>
											<input type="email" id="txtEmail" name="txtEmail" class="form-control required" placeholder="your@email.com">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Cellphone Number:</label>
											<input type="text" id="txtPhone" name="txtPhone" class="form-control required" data-mask="(+63) 99-999-9999" placeholder="(+63) 99-999-9999">
										</div>
									</div>

								</div>

								<div class="form-wizard-actions">
									<button class="btn btn-default" id="validation-back" type="reset">Back</button>
									<button class="btn btn-info" id="validation-next" type="submit">Next</button>
								</div>

							</fieldset>

							<fieldset class="step" id="validation-step2">
								<h6 class="form-wizard-title text-semibold">
									<span class="form-wizard-count">2</span>
									Account Information
									<small class="display-block">Filling out your account details</small>
								</h6>

								<div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Username: <span class="text-danger">*</span></label>
                                            <input ID="txtUsername" name="txtUsername" class="form-control" MinLength="6" maxlength="20" required="required"></input>
                                            <div class="form-control-feedback">
                                                <i class=" icon-user text-muted"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Password: <span class="text-danger">*</span></label>
                                            <input ID="txtPassword" name="txtPassword" class="form-control" type="password" maxlength="20" required="required" MinLength="6"></input>
                                            <div class="form-control-feedback">
                                                <i class=" icon-lock text-muted"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                	<div class="col-md-6">

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Re-enter Password: <span class="text-danger">*</span></label>
                                            <input ID="txtRepeatPassword" name="txtRepeatPassword" class="form-control" type="password" MinLength="6"  maxlength="20" required="required" equalTo="#txtPassword"></input>
                                            <div class="form-control-feedback">
                                                <i class="icon-lock text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-wizard-actions">
									<button class="btn btn-default" id="validation-back" type="reset">Back</button>
									<input class="btn btn-info" id="validation-next" type="submit" value="Submit">
								</div>

							</fieldset>
							
						</form>
		            </div>
		            <!-- /wizard with validation -->

				</div>
				<!-- /Content area -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

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
    </script>

</body>