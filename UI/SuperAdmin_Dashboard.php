<?php
session_start();
if(!isset($_SESSION['idSuperAdmin'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
include('../UI/header/header_sadmin.php');
?>

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4> <span class="text-semibold">Welcome!</span> - Administrator </h4>
						</div>


						<div class="heading-elements">
							<div class="content-group-lg">
								<h6 style="float: left; margin-right: 10px;">Select Date:</h6>
								<div class="input-group">
									<input id="date_picker" type="text" onchange="realtime()" class="form-control daterange-single" value="">
								</div>
							</div>
							
						</div>

					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Shortcut boxes -->
					<div class="row">
						<div class="col-lg-3">

							<a href="SuperAdmin_DocumentTracker.php?key=gxt" style="color: #fff">
								<div class="panel bg-primary">
									<div class="panel-body">
										<h3 class="no-margin" id="pending">0</h3>
										Ongoing Documents
										<div class="text-muted text-size-small"><p class="text-muted btn-link"><i class="icon-eye"></i> Click to View</p></div>
									</div>
								</div>
							</a>

						</div>

						<div class="col-lg-3">

							<a href="SuperAdmin_DocumentTracker.php?key=gtx" style="color: #fff">
								<div class="panel bg-success-400">
									<div class="panel-body">
										<h3 class="no-margin" id="done">0</h3>
										Finished Documents
										<div class="text-muted text-size-small"><p class="text-muted btn-link"><i class="icon-eye"></i> Click to View</p></div>
									</div>
								</div>
							</a>

						</div>

						<div class="col-lg-3">

							<a href="SuperAdmin_DocumentTracker.php" style="color: #fff">
								<div class="panel bg-info-400">
									<div class="panel-body">

										<h3 class="no-margin" id="registered">0</h3>
										Total Documents
										<div class="text-muted text-size-small"><p class="text-muted btn-link"><i class="icon-eye"></i> Click to View</p></div>
									</div>
								</div>
							</a>

						</div>

						<div class="col-lg-3">

							<a id="link" style="color: #fff">
								<div class="panel bg-indigo-400">
									<div class="panel-body">

										<h3 class="no-margin" id="event">None</h3>
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
									<h6 class="panel-title text-semibold">Document Tracker</h6>


								</div>

								<div class="table-responsive">
									<table class="table" style="font-size: 12px">
										<thead>
											<tr>
												<th style="width: 10%">Due</th>
												<th style="width: 18%">Tracking No.</th>
												<th style="width: 20%">Title</th>
												<th style="width: 20%;">Sender</th>
												<th style="width: 30%">Date and Time</th>
												<th class="text-center" style="width: 5%;">Action</th>
											</tr>
										</thead>
										<tbody id="bod">
											<tr class="active border-double">
											<td colspan="5">Ongoing Documents</td>
											<td class="text-right">
												<label id="badge" class="badge bg-blue-400">0</label>
											</td>
										</tr>
										<tr class="active border-double">
										<td colspan="5">Finished Documents</td>
										<td class="text-right">
											<label id="badge1" class="badge bg-success">0</label>
										</td></tr>
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

								<div class="panel-body" id="upcoming">
									<h5 class="text-semibold">Event Name <small class="display-block"></small></h5>
				                	<p class="content-group">Event Location</p>

				                	<ul class="list content-group">
				                		<li><span class="text-semibold">Administered by:</span><br/> </li>
				                		<li><span class="text-semibold">Start Date and Time:</span> </li>
				                		<li><span class="text-semibold">End Date and Time:</span> </li>
				                	</ul>
								</div>
							</div>
						</div>
						
						<!-- /Document TRacker -->
					</div>
					<input type="hidden" name="">

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
<script type="text/javascript">
	setInterval(realtime,1000);
	function realtime(){
		var date = $('#date_picker').val();
		$.ajax({
			type: "POST",
            url: "realtimeDashboard.php",
            data: "date="+date,
            dataType: "json",
            success:function(data){
            	$('#pending').html(data[0]);
            	$('#done').html(data[1]);
            	$('#registered').html(data[2]);
            	$('#event').html(data[3]);
            	$('#bod').html(data[4]);
            	$('#upcoming').html(data[5]);
            	document.getElementById("link").href="SuperAdmin_EventList.php?Id="+data[6]+"&dash=true"; 
            	console.log(data);
            },
           	error:function(data){
           		console.log(data);
           	}
		});
	}

</script>
</body>
</html>