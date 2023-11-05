<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
 if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "1"){
  header("location:./user_login.php");
  
}
$quary ="SELECT id,role FROM roles";
    $stmt = $conn->prepare($quary);
    $stmt->execute();
    $stmt->bind_result($id,$role);
    $options = "";
    $options_edit ="";
    while($stmt->fetch()){
        $options .="<option value='$id'>$role</option>";
        $options_edit .="<option value='$id' selected>$role</option>";

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
            <h1 class="m-0">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="#" id="add-new-user" class="btn btn-primary">Add User</a></li>
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
                      <th>User</th>
                      <th>Mobile Number</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="load-table-user">
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
  <div class="modal fade" id="modal-Edit-user">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="edit-user-form">
            <div class="modal-header">
              <h5 class="modal-title">EDIT USER</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="hidden" class="form-control" name="id" id="user-id-edit" placeholder="Enter Username" autocomplete="off">
                    <input type="text" class="form-control" name="usernameedit" id="user-name-edit" placeholder="Enter Username" autocomplete="off" required>
                    <span id="unamevedit" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Set Password</label>
                    <input type="password" class="form-control" name="passwordedit" id="pass-word-edit" placeholder="Enter Password" autocomplete="off" required>
                    <span id="upwdvedit" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Enter Mobile</label>
                    <input type="text" class="form-control" name="mobile_numberedit" id="mobile-number-edit" placeholder="Enter Mobile Number" autocomplete="off" required>
                    <span id="umobilevedit" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Enter Email</label>
                    <input type="email" class="form-control" name="emailedit" id="user-email-edit" placeholder="Enter Email" autocomplete="off" required>
                  </div>
                  <div class="col-12  form-group">
                        <label>Select Role</label>
                        <select class="form-control" name="roleedit" id="user-role-edit">
                         <?php echo $options_edit; ?>
                         <!-- <option value="0">Defult</option> -->
                        </select>
                      </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="edit-user-save">Submit</button>
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
  <div class="modal fade" id="modal-add-user">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="add-user-form">
            <div class="modal-header">
              <h5 class="modal-title">ADD NEW USER</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Username</label>
                  
                    <input type="text" class="form-control" name="username" id="user-name" placeholder="Enter Username" autocomplete="off" required>

                    <span id="unamev" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Set Password</label>
                    <input type="text" class="form-control" name="password" id="pass-word" placeholder="Enter Password" autocomplete="off" required>
                    <span id="upwdv" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Enter Mobile</label>
                    <input type="text" class="form-control" name="mobile_number" id="mobile-number" placeholder="Enter Mobile Number" autocomplete="off" required>
                    <span id="umobilev" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputEmail1">Enter Email</label>
                    <input type="text" class="form-control" name="email" id="user-email" placeholder="Enter Email" autocomplete="off" required>
                    <span id="uemailv" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-12  form-group">
                        <label>Select Role</label>
                        <select class="form-control" name="role" id="user-role" required>
                         <?php echo $options; ?>
                         <!-- <option value="0">Defult</option> -->
                        </select>
                      </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add-user-sub">Submit</button>
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
  <div class="modal fade" id="modal-remove-user">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="user-remove-form">
            <div class="modal-header">
              <h4 class="modal-title">REMOVE ROLE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                  <input type="hidden" class="form-control" name="id_remove_user" id="user-id-remove" autocomplete="off">
                   <h3>Are you sure, You want to delete this user?</h3>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" id="remove-user-sub">Remove</button>
            </div>
            </form>
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
       
//Fetch All Records Of Users
function loadTableUser(){
    $("#load-table-user").html("");
    $.ajax({
        url : "../../apis/select/get_user.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              html = html +("<tr>"+
                                  
                                   "<td>" + value.username+"</td>"+ 
                                   "<td>" + value.mobile+"</td>"+ 
                                   "<td>" + value.email+"</td>"+ 
                                   "<td>" + value.role +"</td>"+ 
                                  "<td><a href='#' class='edit-user' data-eid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-user'  data-rid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true'style='color:red;'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table-user").html(html);  
        }
    });
}
loadTableUser();
//Fetch All Records Close Of User
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
$(document).on("click",".edit-user",function(){
    $('#modal-Edit-user').modal('show');
    var user_id = $(this).data("eid");
    var obj = {userid : user_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_user.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#user-id-edit").val(data[0].id);
        $("#user-name-edit").val(data[0].username);
        $("#pass-word-edit").val(data[0].password);
        $("#mobile-number-edit").val(data[0].mobile_number);
        $("#user-email-edit").val(data[0].email);
        $("#user-role-edit").val(data[0].role);
        

       }
    })
//     //Update Role
    $("#edit-user-save").on("click",function(){
       
        var jsonobj =jsonData("#edit-user-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        // $("#unamevedit").html("Fill The Input");
        //  $("#upwdvedit").html("Fill The Input");
        //  $("#umobilevedit").html("Fill The Input"); 
        console.log("Fill The Input");         
       }else{
        $.ajax({
            url : "../../apis/update/update_user.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                $('#modal-Edit-user').modal('hide');
                loadTableUser();}
        }
        });
       }
    });

// //Update Role Close
});
// //Fetch Single Record : Show Model Close

// //Add Role
$(document).on("click","#add-new-user",function(){
    $('#modal-add-user').modal('show');
    $("#add-user-sub").on("click",function(){
        //e.preventDefault();
        var jsonobj =jsonData("#add-user-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        // $("#unamev").html("Fill The Input");
        // $("#upwdv").html("Fill The Input");
        // $("#umobilev").html("Fill The Input");
        // $("#uemailv").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/add/add_user.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                $("#add-user-form").trigger("reset");
                $('#modal-add-user').modal('hide');
                loadTableUser();
            }
        });
       }
    })
});
// //Add Role Close
// //Delete Role 
$(document).on("click",".remove-user",function(){
  $('#modal-remove-user').modal('show');
    var user_id = $(this).data("rid");
    var obj = {userid : user_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_user.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#user-id-remove").val(data[0].id);
       }
    })
//     //delete role
    $("#remove-user-sub").on("click",function(e){
        e.preventDefault();
        var jsonobj =jsonData("#user-remove-form");
        //console.log(jsonobj);
        $.ajax({
            url : "../../apis/delete/delete_user.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
                //console.log(data);
                if(data == 1){
                $('#modal-remove-user').modal('hide');
                loadTableUser();
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
