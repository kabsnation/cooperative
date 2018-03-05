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
                                                                <?php if($history){foreach($history as $hist){?>
                                                                <tr>
                                                                    <td><?php echo $hist['trackingNumber'];?></td>
                                                                    <td><?php echo $hist['title'];?></td>
                                                                    <td><?php echo $hist['status'];?></td>
                                                                    <td><?php echo $hist['datetime'];?></td>
                                                                    <td><?php echo $hist['name'];?></td>
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