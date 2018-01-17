<?php
session_start();
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
include('../UI/header/header_user.php');
$doc = new DocumentHandler();
$id = $_SESSION['idAccount'];
?>
            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default has-cover" style="border: 1px solid #ddd; border-bottom: 0;">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Messages</span> - Trash</h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a onclick="deleteAll()" class="btn btn-link btn-float has-text"><i class="icon-trash text-danger"></i> <span>Delete</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <!-- Media library -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title text-semibold">Trash</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="reload"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table datatable-html" id="tableInbox">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all" class="styled"></th>
                                                <th>Subject</th>
                                                <th>From</th>
                                                <th>Date</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <!-- /media library -->

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
