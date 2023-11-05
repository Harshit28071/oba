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
            <h1 class="m-0">Manage Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="#" id="add-new-role" class="btn btn-primary">Add Role</a></li>
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
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="load-table">
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
  <div class="modal fade" id="modal-Edit-role">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="edit-role-form">
            <div class="modal-header">
              <h5 class="modal-title">EDIT ROLE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Role</label>
                    <input type="text" class="form-control" name="editrolename" id="edit-role" placeholder="Enter Role" autocomplete="off" required>
                    <input type="text" class="form-control" name="editidrole" id="edit-id" hidden>
                    <span id="validatione" class="text-danger"></span>
                   </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning" id="edit-role-save">Save Changes</button>
           
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
  <div class="modal fade" id="modal-add-role">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="add-role-form">
            <div class="modal-header">
              <h5 class="modal-title">ADD ROLE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Role</label>
                    <input type="text" class="form-control" name="Addrole" id="Add-role" placeholder="Enter Role"  autocomplete="off" required>
                    <span id="validation" class="text-danger"></span>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="add-role-sub">Add</button>
                  
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
  <div class="modal fade" id="modal-remove-role">
        <div class="modal-dialog">
          <div class="modal-content">
           <form id="add-remove-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE ROLE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
              <input type="text" class="form-control" name="removeroleid" id="remove-id" hidden>
              <h5>Are you sure, You want to delete this role?</h5>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger" id="remove-role-sub">Remove</button>
            
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
function loadTable(){
    $("#load-table").html("");
    $.ajax({
        url : "../../apis/select/fetch_role.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              html = html +("<tr>"+
                                  
                                   "<td>" + value.role +"</td>"+ 
                                  "<td><a href='#' class='edit-role' data-eid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-role'  data-rid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table").html(html);  
        }
    });
}
loadTable();
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
//Fetch Single Record : Show Model
$(document).on("click",".edit-role",function(){
    $('#modal-Edit-role').modal('show');
    var role_id = $(this).data("eid");
    var obj = {roleid : role_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_role.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#edit-id").val(data[0].id);
        $("#edit-role").val(data[0].role);
       }
    })
    //Update Role
    $("#edit-role-form").on("submit",function(e){
       
        var jsonobj =jsonData("#edit-role-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        //$("#validatione").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/update/update_role.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                $('#modal-Edit-role').modal('hide');
                loadTable();}
        }
        });
       }
       e.preventDefault();
    });

//Update Role Close
});
//Fetch Single Record : Show Model Close

//Add Role
$(document).on("click","#add-new-role",function(){
    $('#modal-add-role').modal('show');
    $("#add-role-form").on("submit",function(e){
        //e.preventDefault();
        var jsonobj =jsonData("#add-role-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        // $("#validation").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/add/add_role.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                $("#add-role-form").trigger("reset");
                $('#modal-add-role').modal('hide');
                loadTable();
            }
        });
       }
       e.preventDefault();
    })
   
});
//Add Role Close
//Delete Role 
$(document).on("click",".remove-role",function(){
  $('#modal-remove-role').modal('show');
    var role_id = $(this).data("rid");
    var obj = {roleid : role_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/fetch_single_role.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#remove-id").val(data[0].id);
        //$("#edit-role").val(data[0].role);
       }
    });
    //delete role
    $("#remove-role-sub").on("click",function(e){
        e.preventDefault();
        var jsonobj =jsonData("#add-remove-form");
        //console.log(jsonobj);
        $.ajax({
            url : "../../apis/delete/delete_role.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                $('#modal-remove-role').modal('hide');
                loadTable();
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
