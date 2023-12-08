<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
 if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
  header("location:./user_login.php");
}
  $quary_state ="SELECT id,state FROM state";
    $stmt = $conn->prepare($quary_state);
    $stmt->execute();
    $stmt->bind_result($id,$state);
    $options_state = "";
    $options_edit_state ="";
    while($stmt->fetch()){
        $options_state .="<option value='$id'>$state</option>";
        $options_edit_state .="<option value='$id' selected>$state</option>";

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
            <h1 class="m-0">Manage City</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active"><a href="#" id="add-new-city" class="btn btn-primary">Add City</a></li>
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
                      <th>City</th>
                      <th>State</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="load-table-city">
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
  <div class="modal fade" id="modal-Edit-city">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-edit-city" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="edit-city-form">
            <div class="modal-header">
              <h5 class="modal-title">EDIT STATES</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                        <label>Select State</label>
                        <select class="form-control" name="editstateid" id="state-id">
                          <?php echo $options_edit_state;?>
                        </select>
                      </div>
                    <div class="form-group">
                    <label for="#">City</label>
                    <input type="text" class="form-control" name="editcity" id="edit-city" placeholder="Enter State" required>
                    <input type="text" class="form-control" name="cityeditid" id="edit-id-city" hidden>
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
  <div class="modal fade" id="modal-add-city">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-add-city" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="addcityform">
            <div class="modal-header">
              <h5 class="modal-title">ADD CITY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                      <div class="form-group">
                        <label>Select State</label>
                        <select class="form-control" name="stateid">
                          <option value="0" selected >--Select--</option>
                          <?php echo $options_state;
                           $stmt->close();

                           $conn->close();
                           
                           ?>
                        </select>
                      </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" class="form-control" name="Addcity" id="Add-state" placeholder="Enter City" required>
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
  <div class="modal fade" id="modal-remove-city">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-remove-city" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="city-remove-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE CITY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                  <input type="text" class="form-control" name="removecityid" id="remove-city-id" hidden>
                   <h5>Are you sure, You want to delete this City?</h5>
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
function loadTableCity(){
    $("#load-table-city").html("");
    $.ajax({
        url : "../../apis/select/admin/get_city.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            //console.log(data);
            $.each(data,function(key,value){
              html = html + ("<tr>"+
                                   "<td>" + value.name +"</td>"+ 
                                   "<td>" + value.state +"</td>"+ 
                                  "<td><a href='#' class='edit-city' data-cityeid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-city'  data-cityeid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table-city").html(html);  
        }
    });
}
loadTableCity();
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
$(document).on("click",".edit-city",function(){
    $('#modal-Edit-city').modal('show');
    var city_id = $(this).data("cityeid");
    var obj = {Cityeid : city_id};
    var myJson = JSON.stringify(obj);
   console.log(myJson);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_city.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        console.log(data);
        $("#edit-id-city").val(data[0].id);
        $("#edit-city").val(data[0].name);
        $("#state-id").val(data[0].state_id);
        

       }
    })
  });
    //Update Role
    $("#edit-city-form").on("submit",function(e){
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
      $("#loader-edit-city").show();
        var jsonobj =jsonData("#edit-city-form");
        //console.log(jsonobj);
       if(jsonobj == false ){
        //$("#validation-state-edit").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/update/admin/update_city.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
              $("#loader-edit-city").hide();
                //console.log(data);
                if(data == 1){
                  $("#edit-city-form").trigger("reset")
                $('#modal-Edit-city').modal('hide');
                toastr.success('State Updated Succesfully');
                loadTableCity();
              }
        },
        error: function(error) {
            //$("#loader-edit-state").hide();
            toastr.error('Something went wrong.');
            }
        });
       }
       e.preventDefault();
       loadTableCity();
    });

// //Update State Close

// //Fetch Single Record : Show Model Close

// //Add City
$(document).on("click","#add-new-city",function(){
    $('#modal-add-city').modal('show');
  });
    $("#addcityform").on("submit",function(e){
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
      $("#loader-add-city").show();
        var jsonobj =jsonData("#addcityform");
       // console.log(jsonobj);
       if(jsonobj == false ){
        //$("#validationsa").html("Fill The Input");
        console.log("Fill The Input");
       }else{
        $.ajax({
            url : "../../apis/add/admin/add_city.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
              $("#loader-add-city").hide();
              $("#addcityform").trigger("reset");
                $('#modal-add-city').modal('hide');
                toastr.success('City Added Succesfully');
                
                // toastr .delay(1000)
                // toastr .fadeOut(1000);
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
        });
       }
       
       e.preventDefault();
       loadTableCity();
    })
   

// //Add City
// //Delete city
$(document).on("click",".remove-city",function(){
  $('#modal-remove-city').modal('show');
    var city_id = $(this).data("cityeid");
    var obj = {Cityeid : city_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_city.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#remove-city-id").val(data[0].id);
        
       }
    });
  });
//     //delete role
    $("#city-remove-form").on("submit",function(e){
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
      $("#loader-remove-city").show();
        e.preventDefault();
        var jsonobj =jsonData("#city-remove-form");
        //console.log(jsonobj);
        $.ajax({
            url : "../../apis/delete/admin/delete_city.php",
            type : "POST",
            data : jsonobj,
            dataType : "json", 
            success : function(data){
               $("#loader-remove-city").hide();
                //console.log(data);
                if(data == 1){
                  $("#city-remove-form").trigger("reset");
                $('#modal-remove-city').modal('hide');
                loadTableCity();
                toastr.success('City Deleted Succesfully');
                // toastr .delay(1000)
                // toastr .fadeOut(1000);
              }
        },
        error: function(error) {
            toastr.error('Something went wrong.');
            }
        });
       
    });

//Delete Role Close
    });
</script>
</body>
</html>
