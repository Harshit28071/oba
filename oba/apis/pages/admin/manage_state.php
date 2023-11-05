<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
 if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "1"){
  header("location:./user_login.php");
  
}
 ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/haeder.php");?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php 
  require_once("./layout/navbar.php") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Harihar</span>
    </a>

    <!-- Sidebar -->
    <?php require_once("./layout/sidebar.php");?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage State</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active"><a href="#" id="add-new-state" class="btn btn-primary">Add State</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
    <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>State</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="load-table-state">
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
   <!-- /.content -->
    </div>
    </section>
  </div>
  <!----------------------------------------Edit Model------------------------------------------------>
  <div class="modal fade" id="modal-Edit-state">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="edit-state-form">
            <div class="modal-header">
              <h5 class="modal-title">EDIT STATES</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                    <label for="#">State</label>
                    <input type="text" class="form-control" name="editstatename" id="edit-state" placeholder="Enter State" required>
                    <input type="text" class="form-control" name="editidstate" id="edit-id-states" hidden>
                    <span id="validation-state-edit" class="text-danger"></span>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning" id="edit-state-save">Save Changes</button>
            </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      <!-- /.modal -->
  <!----------------------------------------Edit Model Close------------------------------------------------>
  <!----------------------------------------Add Model------------------------------------------------>
  <div class="modal fade" id="modal-add-state">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="addstateform">
            <div class="modal-header">
              <h5 class="modal-title">ADD STATES</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input type="text" class="form-control" name="Addstate" id="Add-state" placeholder="Enter State" required>
                    <span id="validationsa" class="text-danger"></span>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add-state-sub">Add</button> 
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Add Model Close------------------------------------------------>
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-remove-state">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="state-remove-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE STATE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                  <input type="text" class="form-control" name="removestateid" id="remove-state-id" hidden>
                   <h5>Are you sure, You want to delete this State?</h5>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" id="remove-state-sub">Remove</button>  
           </div>
           </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Remove Model Close-------------------------------------------------------------->
  <!-- /.content-wrapper -->
 <?php require_once("./layout/footer.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php require_once("./layout/footer_links.php");?>
<script type="text/javascript">
    $(document).ready(function(){
       
//Fetch All Records
function loadTableState(){
    $("#load-table-state").html("");
    $.ajax({
        url : "../../apis/select/get_states.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              html = html + ("<tr>"+
                                   "<td>" + value.statename +"</td>"+ 
                                  "<td><a href='#' class='edit-state' data-stateid='"+ value.sid +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-state'  data-stateremoveid='"+ value.sid +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table-state").html(html);  
        }
    });
}
loadTableState();
//Fetch All Records Close
//function for form data to json object
function jsonData(targetform){
    var arr =$(targetform).serializeArray();
      //  console.log(arr);
      var obj ={};
      for(var a=0; a < arr.length; a++){
        if(arr[a].value == ""){
            return false;
        }
            obj[arr[a].name] = arr[a].value;
        }
      //  console.log(obj);
        var json_string = JSON.stringify(obj);
       // console.log(json_string);
        return json_string;
}
// //Fetch Single Record : Show Model
$(document).on("click",".edit-state",function(){
    $('#modal-Edit-state').modal('show');
    var state_id = $(this).data("stateid");
    var obj = {stateid : state_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_state.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#edit-id-states").val(data[0].sid);
        $("#edit-state").val(data[0].statename);
       }
    })
    //Update Role
    $("#edit-state-save").on("click",function(){
       // e.preventDefault();
        var jsonobj =jsonData("#edit-state-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        //$("#validation-state-edit").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/update/update_state.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                $('#modal-Edit-state').modal('hide');
                loadTableState();}
        }
        });
       }
    });

// //Update State Close
 });
// //Fetch Single Record : Show Model Close

// //Add State
$(document).on("click","#add-new-state",function(){
    $('#modal-add-state').modal('show');
    $("#add-state-sub").on("click",function(){
      //  e.preventDefault();
        var jsonobj =jsonData("#addstateform");
        console.log(jsonobj);
       if(jsonobj == false ){
        //$("#validationsa").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/add/add_state.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
              $("#addstateform").trigger("reset")
                $('#modal-add-state').modal('hide');
                loadTableState();
            }
        });
       }
    })
});
// //Add Role Close
// //Delete Role 
$(document).on("click",".remove-state",function(){
  $('#modal-remove-state').modal('show');
    var state_id = $(this).data("stateremoveid");
    var obj = {stateid : state_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/fetch_single_state.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#remove-state-id").val(data[0].sid);
        
       }
    });
//     //delete role
    $("#remove-state-sub").on("click",function(e){
        e.preventDefault();
        var jsonobj =jsonData("#state-remove-form");
        //console.log(jsonobj);
        $.ajax({
            url : "../../apis/delete/delete_state.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                $('#modal-remove-state').modal('hide');
                loadTableState();
              }
        }
        });
       
    });
 });
//Delete Role Close
    });
</script>
</body>
</html>
