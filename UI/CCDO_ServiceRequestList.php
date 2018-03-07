<?php
session_start();
require("../config/config.php");
require("../Handlers/AccountHandler.php");
require("../Handlers/ServiceRequestHandler.php");
if(isset($_SESSION['idSuperAdmin'])){
    include('../UI/header/header_sadmin.php');
    $id = $_SESSION['idSuperAdmin'];
}
else if(isset($_SESSION['idEvent'])){
    include('../UI/header/header_events.php');
    $id = $_SESSION['idEvent'];
}
else{
    echo "<script>window.location='index.php';</script>";
}
$handler = new ServiceRequestHandler();
$serviceList = $handler->getServiceRequestList();
?>


                    <!-- Main content -->
                    <div class="content-wrapper">

                        <!-- Content area -->
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="panel panel-white" id="panelEventList">

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h1 class="panel-title">Service Request List</h1>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <table class="table datatable-html" id="table" style="font-size: 13px; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Contact Person</th>
                                                                <th>Organization</th>
                                                                <th>Request Date</th>
                                                                <th>Status</th>
                                                                <th class="text-center">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if($serviceList){
                                                                foreach($serviceList as $service){?>
                                                            <tr>
                                                                <td><?php echo $service['idservice_request'];?></td>
                                                                <td><?php echo $service['contact_person'];?></td>
                                                                <td><?php echo $service['organization'];?></td>
                                                                <td><?php echo $service['activity_date'];?></td>
                                                                <td><?php echo $service['status'];?></td>
                                                                 <td class="text-center">
                                                                    <ul class="icons-list">
                                                                        <li class="dropdown">
                                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                                <i class="icon-menu9"></i>
                                                                            </a>

                                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                                <li><a href="ViewServiceRequest.php?id=<?php echo $service['idservice_request'];?>" onclick="viewCooperative()"><i class="icon-eye"></i> View</a></li>
                                                                                <li><a onclick="promptDelete(<?php echo $service['idservice_request'];?>);"><i class="icon-user-minus"></i> Delete</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <?php }}?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- /Content area -->
                    </div>
                    <!-- /Main content -->

                </div>
                <!-- /Page content -->

            </div>
            <!-- /Page container -->
        </div>

    </form>
</body>
</html>
<script type="text/javascript">
      $('#table').dataTable( {
              "columnDefs": [ {
                "targets": 0,
                "orderable": true
                } ],
                "columnDefs":[{
                    "targets": 5,
                    "orderable": false
                }]
            } );
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
                            deletee(val);
                        }
                });
            }

            function deletee(val){
                $.ajax({
                type: "POST",
                url: "deleteFunction.php",
                data: 'id=' + val,
                    success: function(data){
                        success();
                    }
                });
            }
              function success(){
                setTimeout(function(){
                    swal({
                        title: "Success!",
                        text: "",
                        type: "success"
                        },
                        function(isConfirm){
                            window.location='CCDO_ServiceRequestList.php';
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