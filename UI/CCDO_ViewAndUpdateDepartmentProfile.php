<?php 
session_start();
require("../Handlers/AccountHandler.php");
require("../config/config.php");
if(isset($_SESSION['idAccountAdmin'])){
    include('../UI/header/header_admin.php');
}
else if(isset($_SESSION['idSuperAdmin'])){
    include('../UI/header/header_sadmin.php');
}
else 
{ echo "<script>window.location='index.php';</script>";
}
$handler = new AccountHandler();
$id = $_GET['id'];
$typeDepartment = $handler->getTypeOfDepartment();
$account = $handler->getDepartmentAccount($id);
?>

	<form class="form-validate-jquery" id="form1">
 <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main Content -->
                <div class="content-wrapper">
                    <div class="content">
                        <?php if($account){
                            foreach($account as $acc){?>
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <h3 class="panel-title"><?php echo $acc['name'];?></h3>
                                </div>
                            </div>               

                            <div class="panel-body">
                            	<fieldset class="content-group">
                                    <legend>
                                        <h5 class="text-bold"><i class=" icon-person" style="margin-right: 10px"></i>Personal Information
                                        	<button id="btnEditPersonal" type="button" class="btn btn-primary" style="float: right" onclick="editPersonal()" >Edit</button>
                                        </h5>
                                    </legend>
                                    <input type="hidden" id="idinfo" value="<?php echo $acc['idAccount_Info'];?>">
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Last Name:</strong></label>
                                                    <input ID="txtLastname" name="lastname" class="form-control" required="required" readonly="true" value="<?php echo $acc['Last_Name'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>First Name:</strong></label>
                                                    <input ID="txtFirstName" name="firstname" class="form-control" required="required" readonly="true" value="<?php echo $acc['First_Name'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Middle Name:</strong></label>
                                                    <input ID="txtMiddleName" name ="middlename" class="form-control" required="required" readonly="true" value="<?php echo $acc['Middle_Name'];?>"></input>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Cellphone Number:</strong></label>
                                                    <input type="text" id="txtCellphoneNumber" name="number" class="form-control" data-mask="(+63)99-999-9999" placeholder="(+63)99-999-9999" readonly="true" value="<?php echo $acc['Cellphone_number'];?>"></input>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                    <input type="email" id="txtEmail" name="email" class="form-control" readonly="true" value="<?php echo $acc['Email_Address'];?>" ></input>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="optionPersonal" style="display: none; margin-bottom: 20px;">
	                                        <hr/>
	                                        <div class="text-right">
	                                            <button type="button" class="btn btn-info" id="btnSaveRespondent" onclick="updateInfo()">Save</button>
	                                            <button type="button" class="btn btn-danger" id="btnCancelRespondent" onclick="cancelPersonal()">Cancel</button>
	                                        </div>
	                                    </div>

                                        <br/><br/>

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
                                                        <input ID="txtUsername" name="username" class="form-control" MinLength="6" readonly="true" value="<?php echo $acc['Username'];?>"></input>
                                                        <div class="form-control-feedback">
                                                            <i class=" icon-user text-muted"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback">
                                                        <label><span class="text-danger">* </span><strong>Password:</strong></label>
                                                        <input ID="txtPassword" name="password" class="form-control" type="password" required="required" MinLength="6" readonly="true" value="<?php echo $acc['Password'];?>"></input>
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
                                                           <?php foreach($typeDepartment as $type){
                                                            if($type['idDepartment']==$acc['idDepartment']){?>
                                                           <option value="<?php echo $type['idDepartment'];?>" selected><?php echo $type['Department'];?></option>
                                                           <?php }
                                                           else{?>
                                                           <option value="<?php echo $type['idDepartment'];?>"><?php echo $type['Department'];?></option>
                                                           <?php }} ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group has-feedback" id="reenter" hidden="hidden">
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
                                                    <button type="button" class="btn btn-info" id="btnSaveRespondent" onclick="updateAccount()">Save</button>
                                                    <button type="button" class="btn btn-danger" id="btnCancelRespondent" onclick="cancelAccount()">Cancel</button>
                                                </div>
                                            </div>
    <?php }}?>
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
            window.location=window.location;
    	}

    	function editAccount(){
    		var x = document.getElementById("btnEditAccount");
            var y = document.getElementById("optionAccount");
            var z = document.getElementById("reenter");
            x.style.display = "none";
            y.style.display = "block";
            z.style.display="block";
            $('#ddlDepartment').prop('disabled', false);
            $('#txtPassword').prop('readonly',false);
            $('#txtRepeatPassword').prop('readonly',false);
    	}

    	function cancelAccount(){
    		var x = document.getElementById("btnEditAccount");
            var y = document.getElementById("optionAccount");
            var z = document.getElementById("reenter");
            x.style.display = "block";
            y.style.display = "none";
            z.style.display="none";
            $('#ddlDepartment').prop('disabled', true);
            $('#txtPassword').prop('readonly',true);
            $('#txtRepeatPassword').prop('readonly',true);
            window.location=window.location;
    	}
        function success(){
                setTimeout(function(){
                    swal({
                        title: "Success!",
                        text: "",
                        type: "success"
                        },
                        function(isConfirm){
                            window.location=window.location;
                        });},500); 
            }
            function failed(){
                setTimeout(function(){
                    swal({
                        title: "Failed!",
                        text: "",
                        type: "warning"
                        },
                        function(isConfirm){});},500);
            }
        function updateInfo(){
            var form_data = $('#form1').serialize();
            var idinfo = $('#idinfo').val();
                $.ajax({
                    type: "POST",
                    url: "updateDeptFunction.php",
                    data: form_data+"&id="+<?php echo $id?>+"&idinfo="+idinfo,
                    success: function(data){
                        success();
                    },
                    error: function(data){
                    }
                });
        }
        function updateAccount(){
            var form_data = $('#form1').serialize();
                $.ajax({
                    type: "POST",
                    url: "updateDeptFunction.php",
                    data: form_data+"&id="+<?php echo $id?>,
                    success: function(data){                        
                        success();
                    },
                    error: function(data){
                    }
                });
        }
    </script>
</body>
</html>
