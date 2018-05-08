<?php
session_start();
if(!isset($_SESSION['idSuperAdmin'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$cooperativeProfile = $handler->getCoopAccounts($_SESSION['idSuperAdmin']);
$departmentProfile = $handler-> getDepartmentAccounts($_SESSION['idSuperAdmin']);
include('../UI/header/header_sadmin.php');
?>
            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><span class="text-semibold">Administrator</span> - Accounts</h4>
                        </div>

                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <div class="row">
                        <div class="col-lg-12">
                           <!-- Panel Accounts -->
                                <div class="panel panel-white" id="panelAccounts">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h3 class="panel-title">Accounts List</h3>
                                        </div>

                                        <div class="heading-elements">
                                            <div class="heading-btn-group">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="tabbable">
                                                <ul class="nav nav-tabs nav-tabs-bottom">
                                                    <li class="active"><a href="#coopAccounts" data-toggle="tab">Cooperative Accounts</a></li>
                                                    <li><a href="#deptAccounts" data-toggle="tab">Department Accounts</a></li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane animated fadeIn active" id="coopAccounts">
                                                        <div class="col-lg-12">
                                                            <table class="table datatable-html" id="tableCoopeartiveAccount">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Cooperative Name</th>
                                                                        <th>Chairman</th>
                                                                        <th>Address</th>
                                                                        <th>Telephone Number</th>
                                                                        <th class="text-center">Actions</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <?php if($cooperativeProfile){
                                                                        foreach($cooperativeProfile as $coop){?>
                                                                    <tr>
                                                                        <td><?php echo $coop['Cooperative_Name'];?></td>
                                                                        <td><?php echo $coop['BOD_Chairman'];?></td>
                                                                        <td><?php echo $coop['Address']?></td>
                                                                        <td><?php echo $coop['Telephone_Number']?></td>
                                                                        <td class="text-center">
                                                                            <ul class="icons-list">
                                                                                <li class="dropdown">
                                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                                        <i class="icon-menu9"></i>
                                                                                    </a>

                                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                                        <li><a href="CCDO_ViewAndUpdateCooperativeProfile.php?id=<?php echo $coop['idCooperative_Profile'];?>" onclick="viewCooperative()"><i class="icon-eye"></i> View</a></li>
                                                                                        <li><a href="CCDO_ViewAndUpdateCooperativeProfile.php?id=<?php echo $coop['idCooperative_Profile'];?>"><i class="icon-pencil7"></i> Update</a></li>
                                                                                            <li><a onclick="promptDelete(<?php echo $coop['idAccounts'];?>);"><i class="icon-user-minus"></i> Delete</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    <?php }} ?>
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane animated fadeIn" id="deptAccounts">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <table class="table datatable-html" id="tableDepartmentAccount" style="width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Department</th>
                                                                            <th class="text-center">Actions</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        <?php if($departmentProfile){
                                                                            foreach($departmentProfile as $dept){?>
                                                                        <tr>
                                                                            <td><?php echo $dept['Last_Name'].", ".$dept['First_Name']." ".$dept['Middle_Name'];?></td>
                                                                            <td><?php echo $dept['Department']?></td>
                                                                            <td class="text-center">
                                                                                <ul class="icons-list">
                                                                                    <li class="dropdown">
                                                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                                            <i class="icon-menu9"></i>
                                                                                        </a>

                                                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                                                            <li><a href="CCDO_ViewAndUpdateDepartmentProfile.php?id=<?php echo $dept['idAccounts'];?>"><i class="icon-eye"></i> View</a></li>
                                                                                            <li><a href="CCDO_ViewAndUpdateDepartmentProfile.php?id=<?php echo $dept['idAccounts'];?>"><i class="icon-pencil7"></i> Update</a></li>
                                                                                            <li><a onclick="promptDelete(<?php echo $dept['idAccounts'];?>);"><i class="icon-user-minus"></i> Delete</a></li>
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
                                </div>
                                <!-- Panel Accounts-->
                        </div>

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

<script type="text/javascript">
    $('#tableCoopeartiveAccount').dataTable( {
              "columnDefs": [ {
                "targets": 0,
                "orderable": true
                } ],
                "columnDefs":[{
                    "targets": 4,
                    "orderable": false
                }]
            } );
    $('#tableDepartmentAccount').dataTable( {
              "columnDefs": [ {
                "targets": 0,
                "orderable": true
                } ],
                "columnDefs":[{
                    "targets": 2,
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
                            window.location='SuperAdmin_AccountsList.php';
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