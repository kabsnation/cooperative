<?php
session_start();
if(!isset($_SESSION['idAccount'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
include('../UI/header/header_user.php');
$doc = new DocumentHandler();
$id = $_SESSION['idAccount'];
?>
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default has-cover" style="border: 1px solid #ddd; border-bottom: 0;">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Messages</span> - Inbox</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								<a  id="mark" onclick="showDelete()" class="btn btn-link btn-float has-text"><i class="icon-checkmark text-primary"></i> <span>Mark Item</span></a>
								<a  id="delt" onclick="deleteAll()" class="btn btn-link btn-float has-text" hidden="true" style="margin-left: -100px;"><i class="icon-trash text-danger" ></i> <span>Delete</span></a>
								<a  id="cancel" onclick="cancel()" class="btn btn-link btn-float has-text" hidden="true" style="margin-top: -64px;"><i class="icon-cross text-danger" ></i> <span>Cancel</span></a>
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
							<h6 class="panel-title text-semibold">Inbox</h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="reload"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							<div class="col-lg-12">
								<table class="table datatable-html" id="tableInbox">
			                        <thead>
			                            <tr>
			                            	<th><input type="checkbox" id="select-all" onclick="selectAll()" class="styled"></th>
			                            	<th>Subject</th>
			                                <th>From</th>
			                                <th>Date</th>
			                                <th class="text-center">Actions</th>
			                            </tr>
			                        </thead>
			                    </table>
							</div>
						</div>

						
                    </div>
                    <!-- /media library -->

                    <!-- Footer -->
	                    <?php include '../UI/copyright_footer.php' ?>
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
<script>
	var tabl = $('#tableInbox').DataTable();
	cancel();
	function showDelete(){
		tabl.column( 0 ).visible( true );
		tabl.column( 4 ).visible( false );
		document.getElementById("mark").style.display = "none";
		document.getElementById("delt").style.display = "block";
		document.getElementById("cancel").style.display = "block";
		 var counter = 0;
		 $('#select-all').click(function(event) {   
		        if(counter ==0){
		            $(':checkbox').each(function() {
		                this.checked = true;                   
		            });
		            counter = 1;
		            }
		        else{
		            $(':checkbox').each(function() {
		                    this.checked = false;                        
		                });
		            counter = 0;
		            }
		});
	}
	function cancel(){
		tabl.column( 0 ).visible( false );
		tabl.column( 4 ).visible( true );
		document.getElementById("mark").style.display = "block";
		document.getElementById("delt").style.display = "none";
		document.getElementById("cancel").style.display = "none";
	}
	var counter2 = 0;
	function selectAll(){
		if(counter2 ==0){
			 var counter = 0;
			 $('#select-all').click(function(event) {   
			        if(counter ==0){
			            $(':checkbox').each(function() {
			                this.checked = true;                   
			            });
			            counter = 1;
			            }
			        else{
			            $(':checkbox').each(function() {
			                    this.checked = false;                        
			                });
			            counter = 0;
			            }
			});
			 counter2=1;
		}
		else{
			 var counter = 0;
			 $('#select-all').click(function(event) {   
			        if(counter ==0){
			            $(':checkbox').each(function() {
			                this.checked = false;                   
			            });
			            counter = 1;
			            }
			        else{
			            $(':checkbox').each(function() {
			                    this.checked = true;                        
			                });
			            counter = 0;
			            }
			});
			 counter2 = 0;
		}
	}
	// if(typeof(EventSource) !== "undefined") {
	// 	var tablee = $('#tableInbox').DataTable();
 //        var info = tablee.page.info();
	//     var source = new EventSource("checkerInbox.php?id=1&count="+info.recordsTotal);
	//     source.onmessage = function(event) {
	//     	if(event.data == 1){
	//     		addRow();
	//     	}
	//     }
	// } 
	// else {
	//    alert('please download chrome in latest version. Thank you.')
	// }
	setInterval(realTime,1000);
    function realTime(){
        var tablee = $('#tableInbox').DataTable();
        var info = tablee.page.info();
         $.ajax({
            type: "POST",
            url: "checkerInbox.php",
            data: "count="+info.recordsTotal+"&id="+<?php echo $id;?>,
            success: function(data){
                 if(data == 1){
                    addRow();
                }
            },
            error: function(data){
	        	window.location = "Offline.php";
	        },
            dataType: "json"
        });
    }  
    function addRow(){
         $.ajax({
            type: "POST",
            url: "realtimeInboxFunction.php",
            data: "id="+<?php echo $id;?>,
            success: function(data){
                var tablee = $('#tableInbox').DataTable();
                tablee.clear().draw();
                for (var i = 0; i < data[0].length; i++) {
                	if(data[5][i]==0){
						var title ="<td><strong>"+data[0][i]+"</strong></td>";
                	}
                	else
                		var title ="<td>"+data[0][i]+"</td>";
                    var table = $('#tableInbox').DataTable();
                    var checkbox = "<td style='width:5%''><input type='checkbox' id='check' name='checkbox[]' value='"+data[4][i]+"' class='styled'></td>";
                    
                    var type = "<td>"+data[1][i]+"</td>";
                    var date = "<td>"+data[2][i]+"</td>";
                    if(data[6][i]=='0'){
                    	  var action = "<td class='text-center'><a href='CCDO_ViewMessage.php?"+data[3][i]+"'><i class='icon-mail-read'></i> Open </a></li>";
                    }
                    else{
                    	var action = "<a href='CCDO_ViewMessage.php?"+data[3][i]+"' class='text-center'><i class='icon-mail-read'></i> Open </a></li><a href='#' class='text-danger' onclick='promptDelete("+data[4][i]+");'><i class='icon-trash'></i> Delete </a></li>";
                    }
                    table.row.add([checkbox,title,type,date, action]).draw(false);
                }
            },
            dataType: "json"
        });
    } 
    function promptDelete(val){
			swal({
			    	title: "Are you sure?",
			        text: "You will not be able to recover this information!",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#FF7043",
			        confirmButtonText: "Delete",
			        closeOnConfirm: true,
			        closeOnCancel: true
			   	},
		    function(isConfirm){
		       	if(isConfirm){
		       		deleteFunction(val);

		   }
		});
	}
    function deleteFunction(val){
    	//put ajax delete
    	$.ajax({
            type: "POST",
            url: "deleteInbox.php",
            data: "id="+val+"&check=0&del=1",
            success: function(data){
            	success();
            }
        });
    }
    function deleteAll(){
    	var checkboxes = $('input[type=checkbox]:checked');
    	var check = $('#check').checked;
    	var ids = [];
	    if(checkboxes != 0 || check == true){
	    		swal({
				    	title: "Are you sure?",
				        text: "You will not be able to recover this information!",
				        type: "warning",
				        showCancelButton: true,
				        confirmButtonColor: "#FF7043",
				        confirmButtonText: "Delete",
				        closeOnConfirm: true,
				        closeOnCancel: true
				   	},
				   function(isConfirm){
				      	if(isConfirm){
				      		var count = 0;
				      		$.each($('input[type=checkbox]:checked'), function(){
				      			if(this.value !='on'){
				      				ids[count] = this.value;
				      				count++;
				      			}
				      		});
				      		var jsonString = JSON.stringify(ids);
				      		$.ajax({
						            type: "POST",
						            url: "deleteInbox.php",
						            data: {id : jsonString,del :1},
						            success: function(data){
						            	if(data == '1'){
						            		failed();
						            	}
						            	else{
						            		success();
						            	}
						            }
						        });
				  		}
				});
    		}
    }
    function success(){
    	setTimeout(function(){
			swal({
				title: "Success!",
				text: "",
				type: "success"
				},
				function(isConfirm){
					window.location='CCDO_Inbox.php';
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