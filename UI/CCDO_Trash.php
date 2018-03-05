<?php
session_start();
require("../Handlers/DocumentHandler.php");
require("../Handlers/AccountHandler.php");
require("../config/config.php");
$doc = new DocumentHandler();
if(isset($_SESSION['idAccount'])){
    include('../UI/header/header_user.php');
    $id = $_SESSION['idAccount'];
}
else if(isset($_SESSION['idSuperAdmin'])){
    include('../UI/header/header_sadmin.php');
    $id = $_SESSION['idSuperAdmin'];
}
else if(isset($_SESSION['idEvent'])){
    include('../UI/header/header_events.php');
    $id = $_SESSION['idEvent'];
}
else{
    echo "<script>window.location='index.php';</script>";
}
$result = $doc->inboxCoopById($id,1);
?>
            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default has-cover" style="border: 1px solid #ddd; border-bottom: 0;">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-mail5 position-left"></i><span class="text-semibold">Messages</span> - Trash</h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                               <a  id="mark" onclick="showDelete()" class="btn btn-link btn-float has-text"><i class="icon-checkmark text-primary"></i> <span>Mark Item</span></a>
                                <a  id="delt" onclick="deleteAll()" class="btn btn-link btn-float has-text" hidden="true" style="margin-left: -100px;"><i class="icon-trash text-danger" ></i> <span>Delete</span></a>
                                <a  id="cancel" onclick="cancel()" class="btn btn-link btn-float has-text" hidden="true" style="margin-top: -64px;"><i class="icon-cross text-danger" ></i> <span>Cancel</span></a>
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
                                        <tbody>
                                            <?php if($result){foreach($result as $info){?>
                                            <tr>
                                                <td><input type='checkbox' id='check' name='checkbox[]' value='<?php echo $info['idlocation']?>'></td>
                                                <td><?php echo $info['title'];?></td>
                                                <td><?php echo $info['name'];?></td>
                                                <td><?php echo $info['DateTime'];?></td>
                                                <td class="text-center">
                                                    <?php if($info['idTracking']==null){?>
                                                        <a href='CCDO_ViewMessage.php?idReply=<?php echo $info['idreply'];?>'><i class='icon-mail-read'></i> Open </a></li><a href='#' class='text-danger' onclick='promptDelete(<?php echo $info['idlocation'];?>);'><i class='icon-trash'></i> Delete </a></li>
                                                    <?php }else{?>
                                                        <a href='CCDO_ViewMessage.php?idTracking=<?php echo $info['idTracking'];?>'><i class='icon-mail-read'></i> Open </a></li><a href='#' class='text-danger' onclick='promptDelete(<?php echo $info['idTracking'];?>);'><i class='icon-trash'></i> Delete </a></li>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <!-- /media library -->

                    <!-- Footer -->
                                <?php include '../UI/copyright_footer.php' ?>
                            <!-- /footer -->

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
<script type="text/javascript">
    var tabl = $('#tableInbox').DataTable();
    cancel();
    function showDelete(){
        tabl.column( 0 ).visible( true );
        tabl.column( 4 ).visible( false );
        document.getElementById("mark").style.display = "none";
        document.getElementById("delt").style.display = "block";
        document.getElementById("cancel").style.display = "block";
         var counter = 0;
         $('#select-all').click(function(event) {   
                if(counter ==0){
                    $(':checkbox').each(function() {
                        this.checked = true;                   
                    });
                    counter = 1;
                    }
                else{
                    $(':checkbox').each(function() {
                            this.checked = false;                        
                        });
                    counter = 0;
                    }
        });
    }
    function cancel(){
        tabl.column( 0 ).visible( false );
        tabl.column( 4 ).visible( true );
        document.getElementById("mark").style.display = "block";
        document.getElementById("delt").style.display = "none";
        document.getElementById("cancel").style.display = "none";
    }
    var counter2 = 0;
    function selectAll(){
        if(counter2 ==0){
             var counter = 0;
             $('#select-all').click(function(event) {   
                    if(counter ==0){
                        $(':checkbox').each(function() {
                            this.checked = true;                   
                        });
                        counter = 1;
                        }
                    else{
                        $(':checkbox').each(function() {
                                this.checked = false;                        
                            });
                        counter = 0;
                        }
            });
             counter2=1;
        }
        else{
             var counter = 0;
             $('#select-all').click(function(event) {   
                    if(counter ==0){
                        $(':checkbox').each(function() {
                            this.checked = false;                   
                        });
                        counter = 1;
                        }
                    else{
                        $(':checkbox').each(function() {
                                this.checked = true;                        
                            });
                        counter = 0;
                        }
            });
             counter2 = 0;
        }
    }
     function promptDelete(val){
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this information!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF7043",
                    confirmButtonText: "Delete",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
            function(isConfirm){
                if(isConfirm){
                    deleteFunction(val);

           }
        });
    }
    function deleteFunction(val){
        //put ajax delete
        $.ajax({
            type: "POST",
            url: "deleteInbox.php",
            data: "id="+val+"&check=0&del=2",
            success: function(data){
                success();
            }
        });
    }
    function deleteAll(){
        var checkboxes = $('input[type=checkbox]:checked');
        var ids = [];
        if(checkboxes != 0){
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this information!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#FF7043",
                        confirmButtonText: "Delete",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                   function(isConfirm){
                        if(isConfirm){
                            var count = 0;
                            $.each($('input[type=checkbox]:checked'), function(){
                                if(this.value !='on'){
                                    ids[count] = this.value;
                                    count++;
                                }
                            });
                            var jsonString = JSON.stringify(ids);
                            $.ajax({
                                    type: "POST",
                                    url: "deleteInbox.php",
                                    data: {id : jsonString,del : 2},
                                    success: function(data){
                                        if(data == '1'){
                                            failed();
                                        }
                                        else{
                                            success();
                                        }
                                    }
                                });
                        }
                });
            }
    }
    function success(){
        setTimeout(function(){
            swal({
                title: "Success!",
                text: "",
                type: "success"
                },
                function(isConfirm){
                    window.location='CCDO_Trash.php';
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
</script>