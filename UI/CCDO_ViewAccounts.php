<?php
session_start();
if(!isset($_SESSION['idAccountAdmin'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$cooperativeProfile = $handler->getCoopAccounts($_SESSION['idAccountAdmin']);
$departmentProfile = $handler-> getDepartmentAccounts($_SESSION['idAccountAdmin']);
include('../UI/header/header_admin.php');
?>

                    <!-- Content area -->
                    <div class="content">
                        <div class="row">


                            <div class="col-md-12">
                                <!-- Panel Accounts -->
                                <div class="panel panel-white" id="panelAccounts">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h3 class="panel-title"><strong>Accounts List</strong></h3>
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
                                                                                        <li><a href="CCDO_ViewAndUpdateCooperativeProfile.php?<?php echo $coop['idCooperative_Profile'];?>" onclick="viewCooperative()"><i class="icon-eye"></i> View</a></li>
                                                                                        <li><a href="CCDO_ViewAndUpdateCooperativeProfile.php?<?php echo $coop['idCooperative_Profile'];?>"><i class="icon-pencil7"></i> Update</a></li>
                                                                                        <li><a href="#"><i class="icon-user-minus"></i> Delete</a></li>
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
                                                                                            <li><a href="#"><i class="icon-eye"></i> View</a></li>
                                                                                            <li><a href="#"><i class="icon-pencil7"></i> Update</a></li>
                                                                                            <li><a href="#"><i class="icon-user-minus"></i> Delete</a></li>
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
                    </div>
                    <!-- /Content area -->
                </div>
                <!-- Main content -->
            </div>
        </div>

    </div>
</form>
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
</script>