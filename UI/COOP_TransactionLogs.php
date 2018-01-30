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
$trackings = $doc->getTransactionLogs($id);
$history = $doc->getHistory($id);
?>

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
                                                <div class="heading-btn-group">
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
                                                                    <input type="text" id="min-date" class="form-control daterange-single" value="<?php echo date('m/d/Y');?>"/>
                                                                </div>

                                                                <label class="col-lg-1 control-label">To:</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" id="max-date" class="form-control daterange-single" value="<?php echo date('m/d/Y');?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12" style="margin-top: 20px">

                                                    <div class="form-group">

                                                        <div class="col-lg-12">
                                                            <table class="table datatable-html" id="my-table" style="font-size: 13px; width: 100%;">
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
                                                                    <?php if($trackings){foreach($trackings as $tracking){?>
                                                                    <tr>
                                                                       
                                                                         <td><?php echo $tracking['trackingNumber'];?></td>
                                                                        <td><?php echo $tracking['title'];?></td>
                                                                        <td><?php echo $tracking['Document'];?></td>
                                                                        <td><?php echo $tracking['dateadded'];?></td>
                                                                        <td><?php echo $tracking['datecompleted'];?></td>
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
                    var createdAt = data[4] || 0;

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
    
    // var table1 = $('#tableHistory').DataTable({
    //  "order": [[ 0, "desc" ]]});
    // var tablee = $('#my-table').DataTable({});
    // tablee.column(0).visible(false);

</script>