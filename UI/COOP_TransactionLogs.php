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
$trackings = $doc->getTransactionLogs($id);
$history = $doc->getHistory($id);
}
else if(isset($_SESSION['idEvent'])){
    include('../UI/header/header_events.php');
    $id = $_SESSION['idEvent'];
    $events = $event->getEventTransacLogs($id);
    $history = $event->getHistory($id);
}
else{
    echo "<script>window.location='index.php';</script>";
}
?>
<form action="print.php" id="form1" method="POST">

                    <!-- Main content -->    
                    <div class="content-wrapper">
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="panel panel-white" id="panelEventList">

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h1 class="panel-title">Transaction Logs</h1>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-elements">
                                                    <div class="heading-btn-group">
                                                        <button class="btn btn-primary" type="button" onclick="printt()" >Print <i class="icon-printer"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body" onload="load();">

                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="col-lg-9">
                                                            <div class="row">
                                                                <label class="col-lg-1 control-label">From:</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" id="min-date" name="mindate" class="form-control daterange-single" value="<?php echo date('m/d/Y');?>"/>
                                                                </div>

                                                                <label class="col-lg-1 control-label">To:</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" id="max-date" name="maxdate" class="form-control daterange-single" value="<?php echo date('m/d/Y');?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="row">
                                                                <label class="text-muted">Note: Please take note that the selection of From and To Date will sort the table based on the column of Date Added.</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-lg-12" style="margin-top: 20px">

                                                    <div class="form-group">

                                                        <div class="col-lg-12">
                                                            <table class="table datatable-html" id="my-table" style="font-size: 13px; width: 100%;">
                                                                <?php if(isset($_SESSION['idAccount'])){?>
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tracking No.</th>
                                                                        <th>Title</th>
                                                                        <th>Type</th>
                                                                        <th>Date Added</th>
                                                                        <th>Date Completed</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if(isset($trackings)){foreach($trackings as $tracking){?>
                                                                    <tr>
                                                                       
                                                                        <td><?php echo $tracking['trackingNumber'];?></td>
                                                                        <td><?php echo $tracking['title'];?></td>
                                                                        <td><?php echo $tracking['Document'];?></td>
                                                                        <td><?php echo $tracking['dateadded'];?></td>
                                                                        <td><?php echo $tracking['datecompleted'];?></td>
                                                                    </tr>
                                                                    <?php }}?>
                                                                </tbody>
                                                                <?php }else if(isset($_SESSION['idEvent'])){?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Title</th>
                                                                            <th>Location</th>
                                                                            <th>Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if(isset($events)){ foreach($events as $eventt){?>
                                                                     <tr>
                                                                        <td><?php echo $eventt['title'];?></td>
                                                                        <td><?php echo $eventt['location'];?></td>
                                                                        <td><?php echo $eventt['date'];?></td>
                                                                    </tr>
                                                                    <?php }}?>
                                                                </tbody>
                                                                <?php }?>
                                                            </table>
                                                        </div>
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
 table = $('#my-table').DataTable({});
         $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min  = $('#min-date').val();
                    var max  = $('#max-date').val();
                    <?php if(isset($trackings)){?>
                    var createdAt = data[3] || 0;
                    <?php }else {?>

                    var createdAt = data[2] || 0;
                    <?php }?>
                    if  ( 
                            ( min == "" || max == "" )
                            || 
                            ( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) ) 
                        )
                    {
                        return true;
                    }
                    return false;
                }
            );

            $('.daterange-single').change( function() {
                table.columns.adjust().draw();
            } );
     function printt(){
        var mindate = $('#min-date').val();
        var maxdate = $('#max-date').val();

        var tablee = $('#my-table').DataTable();
        var info = tablee.page.info();
        if(info.recordsDisplay!=0){
           $('#form1').submit();
        }
        else{
             $.ajax({
                type: "POST",
                url: "",
                data: "",
                success: function(data){
                    failed();
                }
            });
        }
    }
    function failed(){
        setTimeout(function(){
            swal({
                title: "Failed!",
                text: "No data available in table",
                type: "warning"
                },
                function(isConfirm){});},500);
    }
    // var table1 = $('#tableHistory').DataTable({
    //  "order": [[ 0, "desc" ]]});
    // var tablee = $('#my-table').DataTable({});
    // tablee.column(0).visible(false);

</script>