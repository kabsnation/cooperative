<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CCDO - Dashboard</title>

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
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="assets/js/pages/components_page_header.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/dashboard.js"></script>

	<script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js"></script>
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
                        <span><?php echo 'Name';?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
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
    </script>
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
									<span class="media-heading text-semibold">Paolo Velasco</span>
									<div class="text-size-mini text-muted">
										Department Head - CCDO
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

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li class="active"><a href="SuperAdmin_Dashboard.php"><i class="icon-home2"></i> <span>Dashboard</span></a></li>

                                <li class="navigation-header"><span>Monitoring</span> <i class="icon-menu" title="Monitoring"></i></li>
                                <li ><a href="SuperAdmin_DocumentTracker.php"><i class="icon-file-eye2"></i> <span>Document Tracker</span></a></li>
								<li><a href="SuperAdmin_EventList.php"><i class="icon-calendar22"></i> <span>Event Viewer</span></a></li>

								<li class="navigation-header"><span>Accounts</span> <i class="icon-menu" title="Accounts"></i></li>

								<li><a href="SuperAdmin_AccountsList.php"><i class="icon-users4"></i> <span>Accounts List</span></a></li>


							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4> <span class="text-semibold">Welcome!</span> - Administrator</h4>
						</div>

					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Shortcut boxes -->
					<div class="row">
						<div class="col-lg-3">

							<a href="SuperAdmin_DocumentTracker.php" style="color: #fff">
								<div class="panel bg-primary">
									<div class="panel-body">
										<h3 class="no-margin"><?php echo '10' ?></h3>
										Pending Documents
										<div class="text-muted text-size-small"><p class="text-muted btn-link"><i class="icon-eye"></i> Click to View</p></div>
									</div>
								</div>
							</a>

						</div>

						<div class="col-lg-3">

							<a href="SuperAdmin_DocumentTracker.php" style="color: #fff">
								<div class="panel bg-success-400">
									<div class="panel-body">
										<h3 class="no-margin"><?php echo '7' ?></h3>
										Finished Documents
										<div class="text-muted text-size-small"><p class="text-muted btn-link"><i class="icon-eye"></i> Click to View</p></div>
									</div>
								</div>
							</a>

						</div>

						<div class="col-lg-3">

							<a href="SuperAdmin_AccountsList.php" style="color: #fff">
								<div class="panel bg-info-400">
									<div class="panel-body">

										<h3 class="no-margin"><?php echo '23' ?></h3>
										Registered Users
										<div class="text-muted text-size-small"><p class="text-muted btn-link"><i class="icon-eye"></i> Click to View</p></div>
									</div>
								</div>
							</a>

						</div>

						<div class="col-lg-3">

							<a href="SuperAdmin_EventList.php" style="color: #fff">
								<div class="panel bg-indigo-400">
									<div class="panel-body">

										<h3 class="no-margin"><?php echo 'February 1, 2018' ?></h3>
										Upcoming Event
										<div class="text-muted text-size-small"><p class="text-muted btn-link"><i class="icon-eye"></i> Click to View</p></div>
									</div>
								</div>
							</a>

						</div>
					</div>
					<!-- /Shortcut boxes -->

					<div class="row">
						<!-- Document Tracker -->
						<div class="col-lg-9">
							<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Document Tracker</h6>
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th style="width: 50px">Due</th>
												<th style="width: 300px;">Sender</th>
												<th>Document Description</th>
												<th class="text-center" style="width: 20px;">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr class="active border-double">
												<td colspan="3">Documents On Process</td>
												<td class="text-right">
													<span class="badge bg-blue"><?php echo "1"; ?> </span>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<h6 class="no-margin">12 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Mark Dherrick Cuevas</a>
														<!-- Online Marker -->
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Online</div>
														<!-- Offline Marker -->
														<!-- <div class="text-muted text-size-small"><span class="status-mark border-slate position-left"></span> Offline</div> -->
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#CCDO-0023] Document Title</span>
														<span class="display-block text-muted">Message...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-history"></i> View History</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr class="active border-double">
												<td colspan="3">Finished Documents</td>
												<td class="text-right">
													<span class="badge bg-success">1</span>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<i class="icon-checkmark3 text-success"></i>
												</td>
												<td>
													<div class="media-body">
														<a href="#" class="display-inline-block text-default letter-icon-title">Christian Philip Polidan</a>
														<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span> Finished</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#CCDO-0025] Document Title</span>
														<span class="display-block text-muted">Message...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-history"></i> View history</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-lg-3">
							<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Upcoming Event</h6>
								</div>

								<div class="panel-body">
									<h5 class="text-semibold">Event Name <small class="display-block"></small></h5>
				                	<p class="content-group">Event Details</p>

				                	<ul class="list content-group">
				                		<li><span class="text-semibold">Administered by:</span><br/> Daniel Lance Red </li>
				                		<li><span class="text-semibold">Date:</span> February 1, 2018 </li>
				                		<li><span class="text-semibold">Time Start:</span> 9:00 AM</li>
				                		<li><span class="text-semibold">End Time:</span> 12:00 PM</li>
				                	</ul>
								</div>
							</div>
						</div>
						
						<!-- /Document TRacker -->
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

</body>
</html>