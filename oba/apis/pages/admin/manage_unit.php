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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#" id="add-new-unit">Add Unit</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Unit</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                     
                      <th>ID</th>
                      <th>Unit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="load-table-unit">
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
   <!-- /.content -->
  </div>
  <!----------------------------------------Edit Model------------------------------------------------>
  <div class="modal fade" id="modal-Edit-unit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDIT Unit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
               <form id="edit-unit-form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Edit Unit</label>
                    <input type="text" class="form-control" name="editunitname" id="edit-unit" placeholder="Enter Unit">
                    <input type="text" class="form-control" name="editidunit" id="edit-id-unit" hidden>
                    <span id="validatione" class="text-danger"></span>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                  <button type="submit" class="btn btn-warning" id="edit-unit-save">Save Changes</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Edit Model Close------------------------------------------------>
  <!----------------------------------------Add Model------------------------------------------------>
  <div class="modal fade" id="modal-add-unit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">ADD UNIT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                <form id="add-unit-form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Add Unit</label>
                    <input type="text" class="form-control" name="Addunit" id="Add-unit" placeholder="Enter Unit">
                    <span id="validationu" class="text-danger"></span>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                  <button type="submit" class="btn btn-primary" id="add-unit-sub">Add</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Add Model Close------------------------------------------------>
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-remove-unit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REMOVE UNIT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                <form id="add-remove-form">
                <div class="card-body">
                  <div class="form-group">
                  <input type="text" class="form-control" name="removeunitid" id="unit-remove-id" hidden>
                   <h3>Are you sure, You want to delete this unit ?</h3>
                    
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                  <button type="submit" class="btn btn-danger" id="remove-unit-sub">Remove</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
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
function loadTableunit(){
    $("#load-table-unit").html("");
    $.ajax({
        url : "../../apis/select/get_units.php",
        type : "GET",
        dataType : "json",
        success : function(data){
            console.log(data);
            $.each(data,function(key,value){
             $("#load-table-unit").append("<tr>"+
                                  "<td>" + value.uid +"</td>" +
                                   "<td>" + value.uname +"</td>"+ 
                                  "<td><a href='#' class='edit-unit' data-uniteid='"+ value.uid +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-unit'  data-unitrid='"+ value.uid +"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>"+
                                  "</tr>");
            });
        }
    });
}
loadTableunit();
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
$(document).on("click",".edit-unit",function(){
    $('#modal-Edit-unit').modal('show');
    var unit_id = $(this).data("uniteid");
    var obj = {unitid : unit_id};
    var myJson = JSON.stringify(obj);
    console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_unit.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#edit-id-unit").val(data[0].uid);
        $("#edit-unit").val(data[0].unitname);
       }
     })
   //Update Role
    $("#edit-unit-save").on("click",function(e){
        e.preventDefault();
        var jsonobj =jsonData("#edit-unit-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        $("#validatione").html("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/update/update_unit.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                $('#modal-Edit-unit').modal('hide');
                loadTableunit();    
        }
        });
       }
    });

// //Update Role Close
});
// //Fetch Single Record : Show Model Close
//Add Role
$(document).on("click","#add-new-unit",function(){
    $('#modal-add-unit').modal('show');
    $("#add-unit-sub").on("click",function(e){
        e.preventDefault();
        var jsonobj =jsonData("#add-unit-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        $("#validationu").html("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/add/add_unit.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                $('#modal-add-unit').modal('hide');
                loadTableunit();
            }
        });
       }
    })
});
// //Add Role Close
// //Delete Role 
$(document).on("click",".remove-unit",function(){
  $('#modal-remove-unit').modal('show');
    var unit_id  = $(this).data("unitrid");
    var obj = {unitid : unit_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/fetch_single_unit.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        console.log(data);
        $("#unit-remove-id").val(data[0].uid);
       
       }
    });
     //delete role
    $("#remove-unit-sub").on("click",function(e){
        e.preventDefault();
        var jsonobj =jsonData("#add-remove-form");
        //console.log(jsonobj);
        $.ajax({
            url : "../../apis/delete/delete_unit.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                $('#modal-remove-unit').modal('hide');
                loadTableunit();
            }
        }
        });
       
    });
   });
//Delete Role Close
    });
//claose document . ready function
</script>
</body>
</html>
