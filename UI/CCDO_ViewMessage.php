<?php
date_default_timezone_set('Asia/Manila');
session_start();
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
include('../UI/header/header_user.php');
$doc = new DocumentHandler();
$id = $_SESSION['idAccount'];
$connect = new Connect();
$con = $connect-> connectDB();
if(isset($_GET['idTracking'])){
	$idTracking = mysqli_real_escape_string($con,stripcslashes(trim($_GET['idTracking'])));
	//check if read or not
	$doc->checkIfRead($idTracking,$id);
	//check if need a reply
	$doc->checkReply($idTracking,$id);
	$infos = $doc->getInboxInfo($idTracking,$id);
	$firstRowLocation = $doc->getTrackingLocationById($idTracking,$id);
	$trackingLocation = $doc->getTrackingLocation($idTracking);
	$locations = '';
	if($trackingLocation){
		foreach ($trackingLocation as $location) {
			$locations.= $location['name']." (".$location['email'].") <br>";
		}
	}
	$type ="tracking";
}
else if(isset($_GET['idReply'])){
	$idReply = mysqli_real_escape_string($con,stripcslashes(trim($_GET['idReply'])));
	//check if read or not
	$check = $doc->checkIfReadReply($idReply,$id);
	$infos = $doc->getReplyInfo($idReply,$id);
	$firstRowLocation = $doc->getReplyLocationById($idReply,$id);
	$locations = '';
	$type = "reply";
}
else if(isset($_GET['idEvents'])){
	$idEvents = mysqli_real_escape_string($con,stripcslashes(trim($_GET['idEvents'])));
	//check if read or not
	$check = $doc->checkIfReadEvent($idEvents,$id);
	$infos = $doc->getEventInfo($idEvents,$id);
	$firstRowLocation = $doc->getEventLocationById($idEvents,$id);
	$eventLocation = $doc->getEventLocation($idEvents);
	$locations = '';
	if($eventLocation){
		foreach ($eventLocation as $location) {
			$locations.= $location['name']." (".$location['email'].") <br>";
		}
	}
	$type = "events";
}
?>
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default has-cover" style="border: 1px solid #ddd; border-bottom: 0;">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Inbox</span> - Message </h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
							</div>
						</div>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Media library -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<?php
								if($infos){
									foreach($infos as $info){
										if(isset($info['trackingNumber'])){
										$trackingNumber = $info['trackingNumber'];}
										$receiverId = $info['receiverId'];
										$title = $info['title'];
							?>
							<h4 class="panel-title text-semibold"><?php echo $info['title']; ?></h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li class="label" style="color: #000000; font-size: 12px;">DATE/TIME: <?php echo $info['DateTime'];?></li>
									
								</ul>
		                	</div>
						</div>
						<div class="panel-body">

							<div class="col-lg-6">
								<ul class="media-list media-list-bordered">

									<li class="media">
										<div class="media-left">
											<a href="#"><label></label></a>
										</div>
										<div class="media-body">
											<h6 class="media-heading text-semibold"><?php echo $info['name'];?> (<?php echo $info['email'];?>)</h6>
											<?php if($firstRowLocation){
												$counter = 0;
												foreach ($firstRowLocation as $location) {
											?>
											to <?php echo $location['name'].' ('.$location['email'].')'; }}?>
											<a class="btn btn-link btn-sm" data-popup="popover" data-placement="left" title="Message Details" data-html="true" data-content="from: <br><?php echo $info['name'];?> <br> to:<br> <?php echo $locations;?>">
												<i class=" icon-chevron-down position-right"></i>
											</a>
										</div>
									</li>
								</ul>
							</div>

							<div class="col-lg-6">
								<ul class="media-list media-list-bordered">

									<li class="media">
										<div class="media-body">
											<div class="text-right">
												<ul class="icons-list">
													<?php if(isset($info['trackingNumber'])){?>
													<li class="label" style="color: #000000; font-size: 12px;">TRACKING NO: <?php echo $info['trackingNumber'];?></li>
													<br/>
													<?php } if(isset($info['Document'])){?>
													<li class="label" style="color: #000000; font-size: 12px;">DOCUMENT TYPE: <?php echo $info['Document'];?></li>
													<?php }?>
							                	</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<ul class="media-list media-list-bordered">
										<li class="media"></li>
										<li class="media-header"></li>
									</ul>
								</div>
								
							</div>

							<div class="col-lg-12">

								<?php 
									if(isset($_GET['idEvents'])){?>
									<h6><strong>Start Date and Time : </strong><?php echo $info['startDateTime'];?></h6>
									<h6><strong>End Date and Time : </strong><?php echo $info['endDateTime'];?></h6>
									<h6><strong>Event Location : </strong><?php echo $info['eventLocation'];?></h6>
									<h6><strong>Event Details : </strong> <?php echo $info['message']?></h6>
									<?php }else{

									echo $info['message'];} 
									if(isset($info['filePath']) && $info['filePath']!=NULL){
								?>
								<br>
								<form action="downloadFunction.php" method="POST">
									<input type="hidden" name="trackingId" value="<?php echo $info['idTracking'];?>">
									<input type="hidden" name="link" value="<?php echo $info['filePath'];?>">
									<input type="submit" name="inbox" value="Download Attached File" class="btn-link">
								</form>
								<?php }?>
							</div>
							
						</div>
                    </div>
                    <!-- /media library -->
<?php if(isset($info['needReply']) && $info['needReply']=='1' || $type=='reply'){ ?>
				<form action="replyFunction.php" id='form1' method="POST">
                    <!-- Summernote editor -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">Reply</h5>
						</div>

						<div class="panel-body">
							<div>
									<textarea type="text" class="summernote" id="reply" name="reply" required="required"></textarea>
								
							</div>


							<div class="text-right">
									<input type="hidden" name="response" id="response" value="0">
									<input type="hidden" name="idTracking" value="<?php if(isset($idTracking)) echo $idTracking;else echo 'null';?>">
									<input type="hidden" name="idReply" value="<?php echo $idReply;?>">
									<input type="hidden" name="trackingNumber" value="<?php echo $trackingNumber;?>">
									<input type="hidden" name="type" value="reply">
									<input type="hidden" name="receiverId" value="<?php echo $receiverId;?>">
									<input type="hidden" name="title" value="<?php echo $title;?>">
									<input type="hidden" name="id" value="<?php echo $id;?>">
									<input type="button" id="send" onclick="confirm(1)" class="btn bg-teal" value="Send" name="send"/>
					</div>
					
					<!-- /summernote editor -->
				</form>
				</div>
				<!-- /content area -->
<?php } else if($type == 'events'){?>
	<form action="replyFunction.php" id='form1' method="POST">
                    <!-- Summernote editor -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">Reply</h5>
						</div>

						<div class="panel-body">
							<div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="radio-inline radio-right">
                                            <input type="radio" name="replyEvent" value="GOING" class="styled" checked="checked">
                                            Going
                                        </label>

                                        <label class="radio-inline radio-right">
                                            <input type="radio" name="replyEvent" value="NOT GOING" class="styled">
                                            Not Going
                                        </label>
                                    </div>
                                </div>
								
							</div>


							<div class="text-right">
									<input type="hidden" name="idEvents" value="<?php echo $idEvents;?>">
									<input type="hidden" name="type" value="<?php echo $type?>">
									<input type="hidden" name="receiverId" value="<?php echo $receiverId;?>">
									<input type="hidden" name="id" value="<?php echo $id;?>">
									<input type="button" id="send" onclick="confirm()" class="btn bg-teal" value="Send" name="send"/>
					</div>
					
					<!-- /summernote editor -->
				</form>
				</div>
<?php }}} ?>
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
<script type="text/javascript">
	$('#reply').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
});
	function disableButton(){
		var btn = $('#acknowledge');
		var send = $('#send');
		var response = $('#response');
		if(btn.val() =='UNDO'){
			btn.val('ACKNOWLEDGE');
			btn.prop('class','btn bg-info-400');
			send.prop('disabled',true);
			response.val('0');

		}
		else{
			btn.val('UNDO');
			btn.prop('class','btn btn-danger');
			send.prop('disabled',false);
			response.val('1');
		}
	}
	function enableButton(){
		var send = $('#send');
			send.prop('class','btn bg-teal');
			send.prop('disabled',false);
	}
	 function confirm(val=""){
        swal({
                    title: "Are you sure?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF7043",
                    confirmButtonText: "Submit",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
            function(isConfirm){
                if(isConfirm){
                	var checkk ='';
                	if(val==1){
                		var rep = $('#reply').val();
                		if(rep=='' || rep == ' ')
                			checkk='1';
                	}
                	if(checkk !='1'){
                		var form_data = $('#form1').serialize();
	                    $.ajax({
	                        type: "POST",
	                        url: "replyFunction.php",
	                        data: form_data,
	                        success: function(data){
	                           success(data);
	                        }
	                    });
                	}
                	else
                		validate();
                    
           }
        });
    }
    function validate(){
                setTimeout(function(){
                    swal({
                        title: "Failed!",
                        text: "Fill out reply field.",
                        confirmButtonColor: "#EF5350",
                        type: "error"
                    });},500);
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
                text: "Some items has not yet been responded",
                type: "warning"
                },
                function(isConfirm){});},500);
    }
</script>