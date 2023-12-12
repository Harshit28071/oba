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
            <h1 class="m-0">Manage Suffix</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="#" id="add-suffix" class="btn btn-primary">Add</a></li>
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
                      <th>Name</th>
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
  <div class="modal fade" id="madal-edit-suffix">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-edit-suffix" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="edit-suffix-from">
            <div class="modal-header">
              <h5 class="modal-title">EDIT SUFFIX</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="editname" id="edit-suffix" placeholder="Enter Role" autocomplete="off" required>
                    <input type="text" class="form-control" name="editid" id="edit-id" hidden>
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
  <div class="modal fade" id="madal-add-suffix">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-suffix" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="add-suffix-form">
            <div class="modal-header">
              <h5 class="modal-title">ADD SUFFIX</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="Add-name" id="Add-role" placeholder="Enter Role"  autocomplete="off" required>
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
  <div class="modal fade" id="modal-remove-suffix">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-remove-suffix" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
           <form id="add-remove-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE ROLE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
              <input type="text" class="form-control" name="removeid" id="remove-id" hidden>
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
     //toaster message
 

  
//Fetch All Records
function loadTable(){
    $("#load-table").html("");
    $.ajax({
        url : "../../apis/select/admin/get_suffix.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              html = html +("<tr>"+
                                  
                                   "<td>" + value.suffix +"</td>"+ 
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
    $('#madal-edit-suffix').modal('show');
    var suffix_id = $(this).data("eid");
    var obj = {suffix_id : suffix_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_suffix.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#edit-id").val(data[0].id);
        $("#edit-suffix").val(data[0].suffix);
       }
    })
  });
    //Update Role
    
    $("#edit-suffix-from").on("submit",function(e){
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
        $("#loader-edit-suffix").show();
        var jsonobj =jsonData("#edit-suffix-from");
        //console.log(jsonobj);
       if(jsonobj == false ){
        //$("#validatione").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/update/admin/update_suffix.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
               
                $("#loader-edit-suffix").hide();
                if(data == 1)
                {
                $("#edit-suffix-from").trigger("reset");
                $('#madal-edit-suffix').modal('hide');
                loadTable();
                toastr.success('Updated Succesfully');
              }
           },
          error: function(error) {
            toastr.error('Something went wrong.');
            }
        });
       }
       e.preventDefault();
    });

//Update Role Close

//Fetch Single Record : Show Model Close

//Add Suffix

$(document).on("click","#add-suffix",function(){
    $('#madal-add-suffix').modal('show');
  });
    $("#add-suffix-form").on("submit",function(e){
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
      $("#loader-suffix").show();
        //e.preventDefault();
        var jsonobj =jsonData("#add-suffix-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        // $("#validation").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/add/admin/add_suffix.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                $("#loader-suffix").hide();
                if(data.status == 201)
                {
                $("#add-suffix-form").trigger("reset");
                $('#madal-add-suffix').modal('hide');
                loadTable();
                toastr.success('Data Added Succesfully');
                
                }
                
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
        });
       }
       e.preventDefault();
    })
   

//Add Suffix Close
//Delete Role 
$(document).on("click",".remove-role",function(){
  $('#modal-remove-suffix').modal('show');
    var suffix_id = $(this).data("rid");
    var obj = {suffix_id : suffix_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_suffix.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#remove-id").val(data[0].id);
        //$("#edit-role").val(data[0].role);
       }
    });
  });
    //delete role
    $("#add-remove-form").on("submit",function(e){
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
      $("#loader-remove-suffix").show();
        e.preventDefault();
        var jsonobj =jsonData("#add-remove-form");
        //console.log(jsonobj);
        $.ajax({
            url : "../../apis/delete/admin/delete_suffix.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
            $("#loader-remove-suffix").hide();              
                //console.log(data);
                if(data == 1){
                  $("#add-remove-form").trigger("reset");
                $('#modal-remove-suffix').modal('hide');
                loadTable();
                toastr.success('Deleted Succesfully');
                
              }
        },
        error: function(error) {
            toastr.error('Something went wrong.');
            }
        });
       
    });

//Delete Role Close

</script>
</body>
</html>
