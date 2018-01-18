<?php 
session_start();
if(!isset($_SESSION['idAccountAdmin'])){
    echo "<script>window.location='index.php';</script>";
}
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$handler = new AccountHandler();
$typeCooperative = $handler->getTypeOfCooperative();
$membership = $handler->getMembership();
$area = $handler->getAreaOfOperation();
$composition = $handler->getMembershipComposition();
$id = $_GET['id'];
$info = $handler->getCoopAccountById($id);
include('../UI/header/header_admin.php');
?>

	<form class="form-validate-jquery">
 <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main Content -->
                <div class="content-wrapper">
                    <div class="content">

                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <h3 class="panel-title">Full Name</h3>
                                </div>
                            </div>               

                            <div class="panel-body">
                            	<fieldset class="content-group">
                                    <legend>
                                        <h5 class="text-bold"><i class=" icon-person" style="margin-right: 10px"></i>Personal Information
                                        	<button id="btnEditPersonal" type="button" class="btn btn-primary" style="float: right" onclick="editPersonal()">Edit</button>
                                        </h5>
                                    </legend>
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Last Name:</strong></label>
                                                    <input ID="txtLastname" name="txtLastname" class="form-control" required="required" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>First Name:</strong></label>
                                                    <input ID="txtFirstName" name="txtFirstName" class="form-control" required="required" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Middle Name:</strong></label>
                                                    <input ID="txtMiddleName" name ="txtMiddleName" class="form-control" required="required" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Suffix:</strong></label>
                                                    <select ID="ddlNameSuffix" name="ddlNameSuffix" class="form-control" disabled="true">
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
                                                    <input type="text" id="txtCellphoneNumber" name="txtCellphoneNumber" class="form-control" data-mask="(+63)99-999-9999" placeholder="(+63)99-999-9999" readonly="true"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                    <input type="email" id="txtEmail" name="txtEmail" class="form-control" readonly="true"></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionPersonal" style="display: none;">
	                                        <hr/>
	                                        <div class="text-right">
	                                            <button type="button" class="btn btn-info" id="btnSaveRespondent">Save</button>
	                                            <button type="button" class="btn btn-danger" id="btnCancelRespondent" onclick="cancelPersonal()">Cancel</button>
	                                        </div>
	                                    </div>

                                    </div>
                                </fieldset>

                                <fieldset class="content-group">
                                    <legend>
                                        <h5 class="text-bold"><i class=" icon-user-plus" style="margin-right: 10px"></i>Account Information
                                        	<button id="btnEditAccount" type="button" class="btn btn-primary" style="float: right" onclick="editAccount()">Edit</button>
                                        </h5>
                                    </legend>
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Username:</strong></label>
                                                    <input ID="txtUsername" name="txtUsername" class="form-control" MinLength="6" required="required" readonly="true"></input>
                                                    <div class="form-control-feedback">
                                                        <i class=" icon-user text-muted"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Password:</strong></label>
                                                    <input ID="txtPassword" name="txtPassword" class="form-control" type="password" required="required" MinLength="6" readonly="true"></input>
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
                                                    <select  ID="ddlDepartment" name="ddlDepartment" required="required" class="form-control" disabled="true">
                                                       <?php foreach($typeDepartment as $type){?>
                                                       <option value="<?php echo $type['idDepartment'];?>"><?php echo $type['Department'];?></option>
                                                       <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Re-enter Password:</strong></label>
                                                    <input ID="txtRepeatPassword" name="txtRepeatPassword" class="form-control" type="password" MinLength="6" required="required" equalTo="#txtPassword" readonly="true"></input>
                                                    <div class="form-control-feedback">
                                                        <i class="icon-lock text-muted"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-12" id="optionAccount" style="display: none;">
	                                        <hr/>
	                                        <div class="text-right">
	                                            <button type="button" class="btn btn-info" id="btnSaveRespondent">Save</button>
	                                            <button type="button" class="btn btn-danger" id="btnCancelRespondent" onclick="cancelAccount()">Cancel</button>
	                                        </div>
	                                    </div>

                                    </div>
                                </fieldset>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /Main Content -->

            </div>
            <!-- /Page content -->

        </div>
        <!-- /Page container -->

    </form>

    <script type="text/javascript">

    	jQuery(function ($) {
            $("#txtCellphoneNumber").mask("(+63) 999-999-9999");
        });
    	
    	function editPersonal(){
    		var x = document.getElementById("btnEditPersonal");
            var y = document.getElementById("optionPersonal");
            x.style.display = "none";
            y.style.display = "block";
            $('#txtLastname').prop('readonly', false);
            $('#txtFirstName').prop('readonly', false);
            $('#txtMiddleName').prop('readonly', false);
            $('#ddlNameSuffix').prop('disabled', false);
            $('#txtCellphoneNumber').prop('readonly', false);
            $('#txtEmail').prop('readonly', false);
    	}

    	function cancelPersonal(){
    		var x = document.getElementById("btnEditPersonal");
            var y = document.getElementById("optionPersonal");
            x.style.display = "block";
            y.style.display = "none";
            $('#txtLastname').prop('readonly', true);
            $('#txtFirstName').prop('readonly', true);
            $('#txtMiddleName').prop('readonly', true);
            $('#ddlNameSuffix').prop('disabled', true);
            $('#txtCellphoneNumber').prop('readonly', true);
            $('#txtEmail').prop('readonly', true);
    	}

    	function editAccount(){
    		var x = document.getElementById("btnEditAccount");
            var y = document.getElementById("optionAccount");
            x.style.display = "none";
            y.style.display = "block";
            $('#ddlDepartment').prop('disabled', false);
    	}

    	function cancelAccount(){
    		var x = document.getElementById("btnEditAccount");
            var y = document.getElementById("optionAccount");
            x.style.display = "block";
            y.style.display = "none";
            $('#ddlDepartment').prop('disabled', true);
    	}
    </script>
</body>
</html>
