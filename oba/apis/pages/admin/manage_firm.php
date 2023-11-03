<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "1"){
    header("location:./user_login.php");
    }
    $quary ="SELECT id,name FROM category";
    $stmt = $conn->prepare($quary);
    $stmt->execute();
    $stmt->bind_result($id,$name);
    $options = "";
    $options_edit ="";
    while($stmt->fetch()){
        $options .="<option value='$id'>$name</option>";
        $options_edit .="<option value='$id' selected>$name</option>";

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
            <h1 class="m-0">Manage Firm</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="./add_firm.php" id="add-new-firm" class="btn btn-primary">Add Firm</a></li>
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
                      <th>Firm Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="load-table-firm">
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
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-remove-firm">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="remove-firm-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE FIRM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="" name="firmremoveid" autocomplete="off" id="f-id-remove">
                  <input type="hidden" class="form-control" id="logo-image-remove" name="removelogoimgold" >
                  <input type="hidden" class="form-control" id="sign-image-remove" name="removesignimgold" >
                   <h5>Are you sure, You want to delete this Firm Record ?</h5>
                  </div>              
            </div>
            <div class="modal-footer justify-content-between">
                  <input type="submit" class="btn btn-danger" id="remove-role-sub" value="Remove">               
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
  function validation(){
    var fname =document.getElementById('f-name').value;
    var fgst =document.getElementById('f-gst').value;
    var fadd =document.getElementById('f-add').value;
    var fssai =document.getElementById('f-fssai').value;
    var mobile =document.getElementById('f-mobile').value;
    var bankname =document.getElementById('f-bankname').value;
    var faccno =document.getElementById('f-acc-no').value;
    var bifsc =document.getElementById('f-ifsc').value;
    var fbankadd =document.getElementById('f-bank-add').value;
    var fstate =document.getElementById('f-state').value;
    var fstatecode =document.getElementById('f-state-code').value;
    if(fname == ""){
      document.getElementById('name-val').innerHTML = "*Field is required*";
      return false;
    }
    if(fgst == ""){
      document.getElementById('G-val').innerHTML = "*Field is required*";
      return false;
    } if(fadd == ""){
      document.getElementById('add-val').innerHTML = "*Field is required*";
      return false;
    } if(fssai == ""){
      document.getElementById('fssai-val').innerHTML = "*Field is required*";
      return false;
    } 
    if(mobile == ""){
      document.getElementById('mo-val-al').innerHTML = "*Field is required*";
      return false;
    }
    if(bankname == ""){
      document.getElementById('bank-name-val').innerHTML = "*Field is required*";
      return false;
    } 
    if(faccno == ""){
      document.getElementById('acc-val').innerHTML = "*Field is required*";
      return false;
    }
     if(bifsc == ""){
      document.getElementById('ifsc-val').innerHTML = "*Field is required*";
      return false;
    }
    if(fbankadd == ""){
      document.getElementById('bank-add-val').innerHTML = "*Field is required*";
      return false;
    }
    if(fstate == ""){
      document.getElementById('state-val').innerHTML = "*Field is required*";
      return false;
    }
    if(fstatecode == ""){
      document.getElementById('state-val-code').innerHTML = "*Field is required*";
      return false;
    }
  }
    $(document).ready(function(){
    //Add Firm
    $(document).on("click","#add-new-firm",function(){
        $('#modal-add-firm').modal('show');
       // validation();
        $('#add-firm-form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/add/add_firm.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response.status == 1){
                    $('#add-firm-form')[0].reset();
                    $('#modal-add-firm').modal('hide');
                    loadTableFirm();
                   
                }else{
                  var error = response.message;
                  $("#validation_cat_edit").html(error);
                }
                
            }
            })
        });
    });
//Fetch All Records
function loadTableFirm(){
    $("#load-table-firm").html("");
    $.ajax({
        url : "../../apis/select/get_firm.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              imgurl =value.image_url;
              html = html +("<tr>"+
                                   "<td>" + value.name +"</td>"+ 
                                  "<td><a href='viewfirmdetails.php?id= "+ value.id +"' class='View-firm' data-firmviewid='"+ value.id +"'><i class='fas fa-eye'></i></a>  &nbsp; &nbsp; <a href='edit_firm.php?id="+ value.id +"' class='edit-firm' data-firmviewid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-firm'  data-firmviewid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true'style='color:red;'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table-firm").html(html);  
        }
    });
}
loadTableFirm();
// fetch singlr record for remove product firm
$(document).on("click",".remove-firm",function(){
  $('#modal-remove-firm').modal('show');
    var remove_firm_id = $(this).data("firmviewid");
    var obj = {firmviewid: remove_firm_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/fetch_single_firm.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#f-id-remove").val(data[0].id);
           $("#logo-image-remove").val(data[0].logo);
           $("#sign-image-remove").val(data[0].signature_image);
        
       }
    });

   });
// //
// //Delete Firm 
$('#remove-firm-form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/delete/delete_firm.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response == 1){
                  //  $('#edit-category-form')[0].reset();
                    $('#modal-remove-firm').modal('hide');
                    loadTableFirm();
                }
                
            }
            })
        });
    });
     //Delete Role Close
</script>
</body>
</html>
