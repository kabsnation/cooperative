<?php
session_start();
if(!isset($_SESSION['idEvent'])){
    echo "<script>window.location='index.php';</script>";
}
$id = $_SESSION['idEvent'];
require("../config/config.php");
require("../Handlers/AccountHandler.php");
$handler = new AccountHandler();
$cooperativeProfile = $handler->getCoopAccounts($id);
$departmentProfile = $handler-> getDepartmentAccounts($id);
include('../UI/header/header_events.php');
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
                                                <div class="heading-elements">
                                                    <div class="heading-btn-group">
                                                        <button class="btn btn-primary" >Print <i class="icon-printer"></i></button>
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
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Contact Person</th>
                                                                        <th>Organization/Cooperative</th>
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