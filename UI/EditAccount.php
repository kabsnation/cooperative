<?php
session_start();
require("../Handlers/AccountHandler.php");
require("../config/config.php");
if(isset($_SESSION['idSuperAdmin'])){
    include('../UI/header/header_sadmin.php');
    $id=$_SESSION['idSuperAdmin'];
}
else if(isset($_SESSION['idAccountAdmin'])){
    include('../UI/header/header_admin.php');
    $id=$_SESSION['idAccountAdmin'];
}
else if(isset($_SESSION['idAccount'])){
    include('../UI/header/header_user.php');
    $id=$_SESSION['idAccount'];
}
else if(isset($_SESSION['idEvent'])){
    include('../UI/header/header_events.php');
    $id=$_SESSION['idEvent'];
}
else
    echo "<script>window.location='index.php';</script>";
?>
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main Content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header">

                    <!-- Header content -->
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><span class="text-semibold">Account Settings</span></h4>
                        </div>
                    </div>
                    <!-- /header content -->


                    <!-- Toolbar -->
                    <div class="navbar navbar-default navbar-component navbar-xs">
                        <ul class="nav navbar-nav visible-xs-block">
                            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                        </ul>

                        <div class="navbar-collapse collapse" id="navbar-filter">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#activity" data-toggle="tab"><i class="icon-cogs position-left"></i> General</a></li>
                                <li><a href="#settings" data-toggle="tab"><i class="icon-lock2 position-left"></i> Security and Login</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /toolbar -->

                </div>
                <!-- /page header -->

                <div class="content">

                    <!-- User profile -->
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="tabbable">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="activity">
                                          <?php if($admin){foreach($admin as $info){?>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Name</h6>
                                                        <?php echo $info['name'];?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Username</h6>
                                                        <?php echo $info['Username'];?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane" id="settings">

                                        <div class="row" id="changePass" style="display: block;">
                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Change Password <a onclick="editPassword()" class="text-muted"><i class="icon-pencil4 pull-right"></i></a></h6>
                                                        It's a good idea to use a strong password that you're not using elsewhere
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="updatePass" style="display: none;">
                                            <div class="col-lg-4 col-sm-7">
                                                <div class="thumbnail">
                                                    <div class="caption">
                                                        <h6 class="no-margin-top text-semibold">Update Password <a onclick="updatePassword()" class="text-muted"><i class="icon-cross3 pull-right" title="Cancel"></i></a></h6>

                                                        <div class="form-group">
                                                            <label>Old Password:</label>
                                                            <input type="password" id="oldpass" class="form-control" />
                                                            <input type="hidden" name="oldpassword" id="oldpassword" value="<?php echo $info['Password'];?>" class="form-control" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>New Password:</label>
                                                            <input type="password" id="txtPassword" minlength="5" name="newpassword" class="form-control" required="required" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Re-enter New Password:</label>
                                                            <input type="password" equalTo="#txtPassword"  class="form-control" />
                                                        </div>

                                                        <div class="text-right">
                                                            <div class="form-group">
                                                                <input type="button" value="Save" onclick="updatePass();" class="btn btn-primary" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }}?>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User profile -->

                </div>
            </div>
            <!-- /Main Content -->

        </div>
        <!-- /Page content -->
    </div>
    <!-- /Page container -->

    <script type="text/javascript">
        function editPassword(){
            var x = document.getElementById("changePass");
            var y = document.getElementById("updatePass");
            x.style.display = "none";
            y.style.display = "block";
        }

        function updatePassword(){
            var x = document.getElementById("changePass");
            var y = document.getElementById("updatePass");
            x.style.display = "block";
            y.style.display = "none";
        }
        function updatePass(){
            var oldpass = $('#oldpass').val();
            var oldpassword = $('#oldpassword').val();
            var newpassword = $('#txtPassword').val();
            if(oldpass==oldpassword){
                 $.ajax({
                    type: "POST",
                    url: "updatePassword.php",
                    data: "id=<?php echo $id?>&password="+newpassword,
                    success: function(data){
                        alert("Success");
                        window.location= window.location;
                    }
                });
            }
            else{
                alert('Old Password is incorrect');
            }
           
        }
    </script>

</body>
</html>

