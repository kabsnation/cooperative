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
<form action="addDepartmentAccountFunction.php" method="POST" id="form1" class="form-validate-jquery">
                        
                        <!-- Page header -->
                        <div class="page-header page-header-default">
                            <div class="page-header-content">
                                <div class="page-title">
                                    <h4><span class="text-semibold">Manage Accounts</span> - Add Department Accounts</h4>
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
                                                                <input ID="txtLastname" name="txtLastname" class="form-control" required="required" maxlength="45" ></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>First Name:</strong></label>
                                                                <input ID="txtFirstName" name="txtFirstName" class="form-control" required="required" maxlength="45"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Middle Name:</strong></label>
                                                                <input ID="txtMiddleName" name ="txtMiddleName" class="form-control" required="required" maxlength="45"></input>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Cellphone Number:</strong></label>
                                                                <input type="text" id="txtCellphoneNumber" name="txtCellphoneNumber" class="form-control" data-mask="(+63)99-999-9999" placeholder="(+63)99-999-9999">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label><span class="text-danger">* </span><strong>Email Address:</strong></label>
                                                                <input type="email" id="txtEmail" name="txtEmail" class="form-control" maxlength="45">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <legend>
                                                        <h5 class="text-bold"><i class=" icon-user-plus" style="margin-right: 10px"></i>Account Information</h5>
                                                    </legend>

                                                    <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <label><span class="text-danger">* </span><strong>Username:</strong></label>
                                                                    <input ID="txtUsername" name="txtUsername" class="form-control" MinLength="6" maxlength="20" required="required"></input>
                                                                    <div class="form-control-feedback">
                                                                        <i class=" icon-user text-muted"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <label><span class="text-danger">* </span><strong>Password:</strong></label>
                                                                    <input ID="txtPassword" name="txtPassword" class="form-control" type="password" maxlength="20" required="required" MinLength="6"></input>
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
                                                                        <option></option>
                                                                       <?php foreach($typeDepartment as $type){?>
                                                                       <option value="<?php echo $type['idDepartment'];?>"><?php echo $type['Department'];?></option>
                                                                       <?php }?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <label><span class="text-danger">* </span><strong>Re-enter Password:</strong></label>
                                                                    <input ID="txtRepeatPassword" name="txtRepeatPassword" class="form-control" type="password" MinLength="6"  maxlength="20" required="required" equalTo="#txtPassword"></input>
                                                                    <div class="form-control-feedback">
                                                                        <i class="icon-lock text-muted"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="col-lg-12">
                                                
                                                <fieldset class="content-group">
                                                    
                                                </fieldset>

                                                <div class="text-right">
                                                    <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                    <input type='button' onclick="checkUsername()" ID="btnSubmit" class="btn btn-primary" value="Submit" required="required" />
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
    </form>

        <script type="text/javascript">
            jQuery(function ($) {
                $("#txtCellphoneNumber").mask("(+63) 999-999-9999");
            });
            function checkUsername(){
                var username = $('#txtUsername').val();
                if(username !=''){
                   $.ajax({
                            type: "POST",
                            url: "checkUsername.php",
                            data: "txtUsername="+username,
                            success: function(data){
                               if(data =='1'){
                                alert("Username already exist");
                               }
                               else{
                                    confirm();
                            }
                        }
                    });  
               }          
            }
             function confirm(){
                swal({
                            title: "Are you sure?",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#FF7043",
                            confirmButtonText: "Submit",
                            closeOnConfirm: true,
                            closeOnCancel: true
                    },
                function(isConfirm){
                    if(isConfirm){
                         //$('#form1').submit();
                         var status = validateForm();
                         if(status==1){
                            validate();
                         }
                         else{
                              $.ajax({
                                type: "POST",
                                url: "addDepartmentAccountFunction.php",
                                data: $('#form1').serialize(),
                                success: function(data){
                                    success();
                                },
                                error: function(data){
                                    failed();
                                }

                            });
                         }
                        
                    }
                });
            }
            function success(){
                setTimeout(function(){
                    swal({
                        title: "Success!",
                        text: "",
                        type: "success"
                        },
                        function(isConfirm){
                            window.location='CCDO_AddDepartmentAccount.php';
                        });},500); 
            }
            function failed(){
                setTimeout(function(){
                    swal({
                        title: "Failed!",
                        text: "Some items has not yet been responded",
                        type: "warning"
                        },
                        function(isConfirm){});},500);
            }
            function validateForm(){
                var inputs = document.getElementsByTagName('input');
                var selects  = document.getElementsByTagName('select');
                for(var i = 0; i<inputs.length; ++i){
                    for(var o = 0; o<selects.length; o++){
                        if(!selects[o].checkValidity()){
                            return 1;
                            break;
                        }
                    }
                    if(!inputs[i].checkValidity()){
                        return 1;
                        break;
                    }
                }
            }
            function validate(){
                setTimeout(function(){
                    swal({
                        title: "Failed!",
                        text: "Fill out all the required fields.",
                        confirmButtonColor: "#EF5350",
                        type: "error"
                    });},500);
            }
        </script>
</body>
</html>
