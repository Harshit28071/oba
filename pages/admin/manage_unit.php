<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
 if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
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
            <h1 class="m-0">Manage Unit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="#" id="add-new-unit" class="btn btn-primary">Add Unit</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
    <div class="card">
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
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
   </section>
  </div>
  <!----------------------------------------Edit Model------------------------------------------------>
  <div class="modal fade" id="modal-Edit-unit">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-edit-unit" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="edit-unit-form">
            <div class="modal-header">
              <h5 class="modal-title">EDIT UNIT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Unit</label>
                    <input type="text" class="form-control" name="editunitname" id="edit-unit" placeholder="Enter Unit" required>
                    <input type="text" class="form-control" name="editidunit" id="edit-id-unit" hidden>
                    <span id="validatione" class="text-danger"></span>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning" id="edit-unit-save">Save Changes</button> 
            </div>
            </form>
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
          <div id="loader-add-unit" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="add-unit-form">
            <div class="modal-header">
              <h5 class="modal-title">ADD UNIT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Unit</label>
                    <input type="text" class="form-control" name="Addunit" id="Add-unit" placeholder="Enter Unit" required>
                    <span id="validationu" class="text-danger"></span>
                  </div>
          </div>
          <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add-unit-sub">Add</button>
            
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
  <div class="modal fade" id="modal-remove-unit">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-remove-unit" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="add-remove-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE UNIT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"> 
                  <div class="form-group">
                  <input type="text" class="form-control" name="removeunitid" id="unit-remove-id" hidden>
                   <h5>Are you sure, You want to delete this unit ?</h5>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" id="remove-unit-sub">Remove</button>
            
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
function loadTableunit(){
    $("#load-table-unit").html("");
    $.ajax({
        url : "../../apis/select/admin/get_units.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            //console.log(data);
            $.each(data,function(key,value){
              html = html + ("<tr>"+
                                   "<td>" + value.uname +"</td>"+ 
                                  "<td><a href='#' class='edit-unit' data-uniteid='"+ value.uid +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-unit'  data-unitrid='"+ value.uid +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table-unit").html(html);  
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
       url :"../../apis/select/admin/fetch_single_unit.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#edit-id-unit").val(data[0].uid);
        $("#edit-unit").val(data[0].unitname);
       }
     })
    });
   //Update Role
    $("#edit-unit-form").on("submit",function(e){
      $("#loader-edit-unit").show();
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
        //e.preventDefault();
        var jsonobj =jsonData("#edit-unit-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
       // $("#validatione").html("Fill The Input");
       console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/update/admin/update_unit.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
              $("#loader-edit-unit").hide();
                //console.log(data);
                $("#edit-unit-form").trigger("reset")
                $('#modal-Edit-unit').modal('hide'); 
                loadTableunit();
                toastr.success('Unit Updated Succesfully');
               
                toastr .delay(1000)
                toastr .fadeOut(1000);
        },
        error: function(error) {
            toastr.error('Something went wrong.');
            }
        });
       }
       e.preventDefault();
    });

// //Update Role Close

// //Fetch Single Record : Show Model Close
//Add Unit
$(document).on("click","#add-new-unit",function(){
    $('#modal-add-unit').modal('show');
  });
    $("#add-unit-form").on("submit",function(e){
      $("#loader-add-unit").show();
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
      //  e.preventDefault();
        var jsonobj =jsonData("#add-unit-form");
        
       if(jsonobj == false ){
       
       console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/add/admin/add_unit.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
              $("#loader-add-unit").hide();
              $("#add-unit-form").trigger("reset");
                $('#modal-add-unit').modal('hide');
                loadTableunit();
                toastr.success('Unit Added Succesfully');
                toastr .delay(1000)
                toastr .fadeOut(1000);
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
        });
       }
       e.preventDefault();
    });

// //Add Unit Close
// //Delete Role 
$(document).on("click",".remove-unit",function(){
  $('#modal-remove-unit').modal('show');
    var unit_id  = $(this).data("unitrid");
    var obj = {unitid : unit_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_unit.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        console.log(data);
        $("#unit-remove-id").val(data[0].uid);
       
       }
    });
  });
     //delete role
    $("#add-remove-form").on("submit",function(e){
      $("#loader-remove-unit").show();
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
        e.preventDefault();
        var jsonobj =jsonData("#add-remove-form");
        //console.log(jsonobj);
        $.ajax({
            url : "../../apis/delete/admin/delete_unit.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                
                $("#loader-remove-unit").hide();
                $("#add-remove-form").trigger("reset")
                $('#modal-remove-unit').modal('hide');
                loadTableunit();
                toastr.success('Unit Deleted Succesfully');
                toastr .delay(1000)
                toastr .fadeOut(1000);
                  }
              },
              error: function(error) {
                $("#add-remove-form").trigger("reset")
                  $('#modal-remove-unit').modal('hide');
                  toastr.error('you can not delete this item.');
                
                  }
        });
       
    
   });
//Delete Role Close
    });
//claose document . ready function
</script>
</body>
</html>
