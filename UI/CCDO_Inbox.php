<?php
session_start();
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
								<a onclick="deleteAll()" class="btn btn-link btn-float has-text"><i class="icon-trash text-danger"></i> <span>Delete</span></a>
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

						<table class="table datatable-html" id="tableInbox">
	                        <thead>
	                            <tr>
	                            	<th><input type="checkbox" id="select-all" class="styled"></th>
	                            	<th>Subject</th>
	                                <th>From</th>
	                                <th>Date</th>
	                                <th class="text-center">Actions</th>
	                            </tr>
	                        </thead>
	                    </table>
                    </div>
                    <!-- /media library -->

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
    function realTime(){
        setTimeout(realTime,1000);
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
                    var action = "<td class='text-center'><a href='CCDO_ViewMessage.php?"+data[3][i]+"'><i class='icon-mail-read'></i> Open </a></li><a href='#' class='text-danger' onclick='promptDelete("+data[4][i]+");'><i class='icon-trash'></i> Delete </a></li>";
                    table.row.add([checkbox,title,type,date, action]).draw(false);
                }
                realTime();
            },
            dataType: "json"
        });
    } 
    realTime();
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
            data: "id="+val+"&check=0",
            success: function(data){
            	setTimeout(function(){
            		displayNext();
                        },100);
            }
        });
    }
    function displayNext(){
    	swal({
			  title: "Success!",
			  text: "",
			  type: "success"
			}
		);
    }
    function deleteAll(){
    	var checker = document.getElementById("check");
    	var checkboxes = $('#check');
    	if(checker.checked == true){
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
			       		$.each($('input[type=checkbox]:checked'), function(){
			       			if(this.value !='on'){
			       				$.ajax({
						            type: "POST",
						            url: "deleteInbox.php",
						            data: "id="+this.value,
						            success: function(data){
						            }
						        });
			       			}
			       		});
			       		setTimeout(function(){
			       			swal({
								  title: "Success!",
								  text: "",
								  type: "success"
								},
								 function(isConfirm){
			       					window.location='CCDO_Inbox.php';
								 }

							);
			       		},500);
			   		}
			});
    	}
    }
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
</script>