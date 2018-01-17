<?php
session_start();
if(!isset($_SESSION['idAccountAdmin'])){
   echo "<script>window.location='index.php';</script>";
}
require("../config/config.php");
require("../Handlers/AccountHandler.php");
$handler = new AccountHandler();
$typeDepartment = $handler->getTypeOfDepartment();
include('../UI/header/header_admin.php');
?>
<form action="addDepartmentAccountFunction.php" method="POST">
                        <!-- Page header -->
                        <div class="page-header page-header-default">
                            <div class="page-header-content">
                                <div class="page-title">
                                    <h4><span class="text-semibold">Manage Department Accounts</span> - Add Department Accounts</h4>
                                </div>
                            </div>
                        </div>
                        <!-- /page header -->

                        <!-- Content area -->
                        <div class="content">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="panel panel-white">

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h1 class="panel-title">Add Department Account</h1>
                                            </div>


                                            <div class="heading-elements">
                                                <div class="heading-btn-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <fieldset class="content-group">
                                                <legend>
                                                    <h5 class="text-bold"><i class=" icon-person" style="margin-right: 10px"></i>Personal Information</h5>
                                                </legend>
                                                <div class="col-lg-12">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Last Name:</strong></label>
                                                                <input ID="txtLastname" name="txtLastname" class="form-control" required="required"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>First Name:</strong></label>
                                                                <input ID="txtFirstName" name="txtFirstName" class="form-control" required="required"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Middle Name:</strong></label>
                                                                <input ID="txtMiddleName" name ="txtMiddleName" class="form-control" required="required"></input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Suffix:</strong></label>
                                                                <select ID="ddlNameSuffix" name="ddlNameSuffix" class="form-control">
                                                                    <option></option>
                                                                    <option Value="Jr.">Jr.</option>
                                                                    <option Value="Sr.">Sr.</option>
                                                                    <option Value="III">III</option>
                                                                    <option Value="IV">IV</option>
                                                                    <option Value="V">V</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Cellphone Number:</strong></label>
                                                                <input type="text" id="txtCellphoneNumber" name="txtCellphoneNumber" class="form-control" data-mask="(+63)99-999-9999" placeholder="(+63)99-999-9999">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                                <input type="email" id="txtEmail" name="txtEmail" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>

                                            <!-- <fieldset class="content-group">
                                                <legend>
                                                    <h5 class="text-bold"><i class=" icon-phone2" style="margin-right: 10px"></i>Contact Information</h5>
                                                </legend>
                                                <div class="col-lg-12">

                                                    <div class="row">

                                                        <div class=" col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Block/Lot/House No./Street:</strong></label>
                                                                <input ID="txtHouseNo" name="txtHouseNo" class="form-control" required="required"></input>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Barangay:</strong></label>
                                                                <select ID="ddlBarangay" name="ddlBarangay" class="form-control" placeholder="Barangay" DataTextField="Barangay" required="required">
                                                                    <option Text="" Value=""></option>
                                                                    <option Text="Balibago" Value="1"></option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>City:</strong></label>
                                                                <select ID="ddlCity" name="ddlCity" class="form-control" placeholder="Barangay" DataTextField="Barangay" required="required">
                                                                    <option Text="" Value=""></option>
                                                                    <option Text="Santa Rosa" Value="1"></option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                                <input ID="txtEmail" name ="txtEmail" type="email" class="form-control" required="required"></input>
                                                                <div class="form-control-feedback">
                                                                    <i class=" icon-mention text-muted"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Cellphone Number:</strong></label>
                                                                <input ID="txtCellphoneNumber" name="txtCellphoneNumber" class="form-control" required="required"></input>
                                                                <div class="form-control-feedback">
                                                                    <i class=" icon-phone text-muted"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </fieldset> -->

                                            <fieldset class="content-group">
                                                <legend>
                                                    <h5 class="text-bold"><i class=" icon-user-plus" style="margin-right: 10px"></i>Account Information</h5>
                                                </legend>
                                                <div class="col-lg-12">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Username:</strong></label>
                                                                <input ID="txtUsername" name="txtUsername" class="form-control" MinLength="6" required="required"></input>
                                                                <div class="form-control-feedback">
                                                                    <i class=" icon-user text-muted"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Password:</strong></label>
                                                                <input ID="txtPassword" name="txtPassword" class="form-control" type="password" required="required" MinLength="6"></input>
                                                                <div class="form-control-feedback">
                                                                    <i class=" icon-lock text-muted"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Department:</strong></label>
                                                                <select  ID="ddlDepartment" name="ddlDepartment" required="required" class="form-control">
                                                                   <?php foreach($typeDepartment as $type){?>
                                                                   <option value="<?php echo $type['idDepartment'];?>"><?php echo $type['Department'];?></option>
                                                                   <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Re-enter Password:</strong></label>
                                                                <input ID="txtRepeatPassword" name="txtRepeatPassword" class="form-control" type="password" MinLength="6" required="required" equalTo="#txtPassword"></input>
                                                                <div class="form-control-feedback">
                                                                    <i class="icon-lock text-muted"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </fieldset>

                                            <div class="text-right">
                                                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                <input type="submit" ID="btnSubmit" class="btn btn-primary" Text="Submit" />
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
