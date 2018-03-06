<?php
session_start();
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../Handlers/EventHandler.php");
require("../config/config.php");
$doc = new DocumentHandler();
$event = new EventHandler();
if(isset($_SESSION['idAccount'])){
    include('../UI/header/header_user.php');
    $id = $_SESSION['idAccount'];
$history = $doc->getHistory($id);
}
else if(isset($_SESSION['idEvent'])){
    include('../UI/header/header_events.php');
    $id = $_SESSION['idEvent'];
    $eventHistory = $event->getHistory($id);
}
else{
    echo "<script>window.location='index.php';</script>";
}
?>

                    <!-- Main content -->    
                    <div class="content-wrapper">
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="panel panel-white" id="panelEventList">

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h1 class="panel-title">History</h1>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="col-lg-12">
                                                <div class="form-group">

                                                    <div class="col-lg-12">
                                                        <table class="table datatable-html" id="tableHistory" style="font-size: 13px; width: 100%;">
                                                            <?php if(isset($history)){?>
                                                            <thead>
                                                                <tr>
                                                                    <th>Tracking No.</th>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th>Receipients</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($history as $hist){?>
                                                                <tr>
                                                                    <td><?php echo $hist['trackingNumber'];?></td>
                                                                    <td><?php echo $hist['title'];?></td>
                                                                    <td><?php echo $hist['status'];?></td>
                                                                    <td><?php echo $hist['datetime'];?></td>
                                                                    <td><?php echo $hist['name'];?></td>
                                                                </tr>
                                                                <?php }?>
                                                            </tbody>
                                                            <?php }else if(isset($eventHistory)){?>
                                                             <thead>
                                                                <tr>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th>Receipients</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($eventHistory as $hist){?>
                                                                <tr>
                                                                    <td><?php echo $hist['title'];?></td>
                                                                    <td><?php echo $hist['status'];?></td>
                                                                    <td><?php echo $hist['datetime'];?></td>
                                                                    <td><?php echo $hist['name'];?></td>
                                                                </tr>
                                                                <?php }?>
                                                            </tbody>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
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
     var table1 = $('#tableHistory').DataTable({
    "order": [[ 0, "desc" ]]});
    // var tablee = $('#my-table').DataTable({});
    // tablee.column(0).visible(false);

</script>