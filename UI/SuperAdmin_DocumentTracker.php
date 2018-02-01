<?php
session_start();
if(!isset($_SESSION['idSuperAdmin'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$doc = new DocumentHandler();
if(isset($_GET['key'])){
    if($_GET['key']=='gxt') 
        $tracking =  $doc->getOngoingTracking();
    else
        $tracking =  $doc->getFinishedTracking();
}
else
    $tracking =  $doc->getAllTracking();
include('../UI/header/header_sadmin.php');
?>
            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4> <span class="text-semibold">Administrator</span> - Document Tracker</h4>
                        </div>

                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-white" id="panelEventList">

                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h1 class="panel-title">Documents</h1>
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
                                                        <th>Tracking No.</th>
                                                        <th>Title</th>
                                                        <th>Sender</th>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                        <th>Date and Time</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($tracking){
                                                        foreach($tracking as $track){?>
                                                        <tr>
                                                            <td><?php echo $track['trackingNumber'];?></td>
                                                            <td><?php echo $track['title'];?></td>
                                                            <td><?php echo $track['username'];?></td>
                                                            <td><?php echo $track['Document'];?></td>
                                                            <td><?php echo $track['Status'];?></td>
                                                            <td><?php echo $track['DateTime'];?></td>
                                                            <td><a href="ViewTracking.php?trackingId=<?php echo $track['trackingNumber'];?>">View</a></td>
                                                        </tr>
                                                        <?php }} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
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
<script type="text/javascript">
     var table = $('#table').DataTable({
        "order": [[ 0, "desc" ]]
    });
    table.columns.adjust().draw();
</script>
</body>
</html>