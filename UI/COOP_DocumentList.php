<?php
session_start();
if(!isset($_SESSION['idAccount'])){
    echo "<script>window.location='index.php';</script>";
}
$id = $_SESSION['idAccount'];
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$doc = new DocumentHandler();
$trackingNumber = $doc->getTrackingNumber();
include('../UI/header/header_user.php');
?>

                    <!-- Main content -->
                    <div class="content-wrapper">
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
                                                    <table class="table datatable-html" id="tableCoopeartiveAccount" style="font-size: 13px; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>Tracking No.</th>
                                                                <th>Type</th>
                                                                <th>Date Added</th>
                                                                <th class="text-center">Actions</th>
                                                            </tr>
                                                        </thead>
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
<script>
    var table = $('#tableCoopeartiveAccount').DataTable({
        "order": [[ 0, "desc" ]]
    });
    table.columns.adjust().draw();
    function realTime(){
        setTimeout(realTime,1000);
        var tablee = $('#tableCoopeartiveAccount').DataTable();
        var info = tablee.page.info();
         $.ajax({
            type: "POST",
            url: "checker.php",
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
            url: "realtimeFunction.php",
            data: "id="+<?php echo $id;?>,
            success: function(data){
                var tablee = $('#tableCoopeartiveAccount').DataTable();
                tablee.clear().draw();
                for (var i = 0; i < data[0].length; i++) {
                    var table = $('#tableCoopeartiveAccount').DataTable();
                    var trackingNumber ="<td>"+data[0][i]+"</td>";
                    var type = "<td>"+data[2][i]+"</td>";
                    var date = "<td>"+data[1][i]+"</td>";
                    var action = "<a href='ViewTracking.php?trackingId="+data[0][i]+"'>View</a>";
                    table.row.add([trackingNumber,type,date, action]).draw(false);
                }
                realTime();
            },
            dataType: "json"
        });
    } 
    realTime();
</script>
</html>