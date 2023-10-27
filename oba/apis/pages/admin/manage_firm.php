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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="#" id="add-new-firm" class="btn btn-primary">Add Firm</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Firm </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                     
                      <th>ID</th>
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
  <!-----------------------------------------View Modal---------------------------------------------------------->
  <div class="modal fade" id="modal-view-firm">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">VIEW FIRM DETAILS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                
                <div class="card-body">
                <form id="view-firm-form">
                <div class="row">
                  <div class="col-4 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Firm Name" name="firmname" readonly id="f-name-v">
                    <span id="name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="gstin" readonly id="f-gst-v">
                    <span id="G-val" class="text-danger font-weight-bold"></span>
                  </div>
                 
                  <div class="col-4 form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Enter Address"name="address" readonly id="f-add-v">
                    <span id="add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>FSSAI</label>
                    <input type="text" class="form-control" placeholder="Enter FSSAI " name="fssai" readonly id="f-fssai-v">
                    <span id="fssai-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile" readonly id="f-mobile-v">
                    <span id="mo-val-al" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" readonly id="v-email">
                  </div>
                  <div class="col-4 form-group">
                  <label>Bank Name</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="bankname" readonly id="f-bankname-v">
                    <span id="bank-name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Account Number</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" name="accountnumber" readonly id="f-acc-no-v">
                    <span id="acc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>IFSC</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifsc" readonly id="f-ifsc-v">
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-12 form-group">
                  <label>Bank Address</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Address " name="bankaddress" readonly id="f-bank-add-v">
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State</label>
                    <input type="text" class="form-control" placeholder="Enter State" name="state" readonly id="f-state-v">
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State Code</label>
                    <input type="text" class="form-control" placeholder="Enter State Code" name="statecode" readonly id="f-state-code-v">
                    <span id="state-val-code" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Firm Logo</label>
                    <div class="input-group">
                      <img src=""  id="logo-img-view" style="width: 120px; height:90px"/>
                    </div>
                  </div>
                  <div class="col-6 form-group">
                    <label>Signture</label>
                    <div class="input-group">
                    <img src=""  id="signture-img-view" style="width: 120px; height:90px"/>
                    </div>
                  </div>
                </div>
                
                
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                <!-- <input type="submit"  class="btn btn-primary btn-lg" id="add-firm-sub" value="Add">                -->
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
                
              </form>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!-----------------------------------------View Modal Close------------------------------------------------------>
  <!----------------------------------------Edit Model------------------------------------------------>
  <div class="modal fade" id="modal-edit-firm">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDIT FIRM DETAILS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                
                <div class="card-body">
                <form id="edit-firm-form">
                <div class="row">
                  <div class="col-4 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Firm Name" name="firmnameedit" autocomplete="off" id="f-name-edit">
                    <input type="hidden" class="form-control" placeholder="Firm Name" name="firmeditid" autocomplete="off" id="f-id-edit">

                    <span id="name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="gstinedit" autocomplete="off" id="f-gst-edit">
                    <span id="G-val" class="text-danger font-weight-bold"></span>
                  </div>
                 
                  <div class="col-4 form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Enter Address"name="addressedit" autocomplete="off" id="f-add-edit">
                    <span id="add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>FSSAI</label>
                    <input type="text" class="form-control" placeholder="Enter FSSAI " name="fssaiedit" autocomplete="off" id="f-fssai-edit">
                    <span id="fssai-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" name="mobileedit" autocomplete="off" id="f-mobile-edit">
                    <span id="mo-val-al" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="emailedit" autocomplete="off" id="v-email-edit">
                  </div>
                  <div class="col-4 form-group">
                  <label>Bank Name</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="banknameedit" autocomplete="off" id="f-bankname-edit">
                    <span id="bank-name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Account Number</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" name="accountnumberedit" autocomplete="off" id="f-acc-no-edit">
                    <span id="acc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>IFSC</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifscedit" autocomplete="off" id="f-ifsc-edit">
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-12 form-group">
                  <label>Bank Address</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Address " name="bankaddressedit" autocomplete="off" id="f-bank-add-edit">
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State</label>
                    <input type="text" class="form-control" placeholder="Enter State" name="stateedit" autocomplete="off" id="f-state-edit">
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State Code</label>
                    <input type="text" class="form-control" placeholder="Enter State Code" name="statecodeedit" autocomplete="off" id="f-state-code-edit">
                    <span id="state-val-code" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputFile"> Edit Logo Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo-img-edit" name="logoimageedit" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <span id="logo-image-validation" class="text-danger"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputFile">Edit Signature Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="sign-image-edit" name="signimgedit" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 form-group">
                  <label>Firm Logo</label>
                    <div class="input-group">
                      <img src=""  id="logo-img-view-edit" style="width: 120px; height:90px"/>
                      <input type="hidden" class="form-control" id="logo-image-h" name="logoimgold" >
                     
                    </div>
                  </div>
                  <div class="col-6 form-group">
                    <label>Signture</label>
                    <div class="input-group">
                    <img src=""  id="signture-img-view-edit" style="width: 120px; height:90px"/>
                    <input type="hidden" class="form-control" id="sign-image-h" name="signimgold" >
                    </div>
                  </div>
                </div>
                
                
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                <input type="submit"  class="btn btn-warning btn-lg" id="add-firm-sub" value="Save Changes">               
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
                
              </form>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Edit Model Close------------------------------------------------>
  <!----------------------------------------Add Model------------------------------------------------>
  <div class="modal fade" id="modal-add-firm">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">ADD PRODUCT CATEGORY</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                
                <div class="card-body">
                <form id="add-firm-form" onsubmit="return validation()">
                <div class="row">
                  <div class="col-4 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Firm Name" name="firmname" autocomplete="off" id="f-name">
                    <span id="name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="gstin" autocomplete="off" id="f-gst">
                    <span id="G-val" class="text-danger font-weight-bold"></span>
                  </div>
                 
                  <div class="col-4 form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Enter Address"name="address" autocomplete="off" id="f-add">
                    <span id="add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>FSSAI</label>
                    <input type="text" class="form-control" placeholder="Enter FSSAI " name="fssai" autocomplete="off" id="f-fssai">
                    <span id="fssai-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile" autocomplete="off" id="f-mobile">
                    <span id="mo-val-al" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off">
                  </div>
                  <div class="col-4 form-group">
                  <label>Bank Name</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="bankname" autocomplete="off" id="f-bankname">
                    <span id="bank-name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Account Number</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" name="accountnumber" autocomplete="off" id="f-acc-no">
                    <span id="acc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>IFSC</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifsc" autocomplete="off" id="f-ifsc">
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-12 form-group">
                  <label>Bank Address</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Address " name="bankaddress" autocomplete="off" id="f-bank-add">
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State</label>
                    <input type="text" class="form-control" placeholder="Enter State" name="state" autocomplete="off" id="f-state">
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State Code</label>
                    <input type="text" class="form-control" placeholder="Enter State Code" name="statecode" autocomplete="off" id="f-state-code">
                    <span id="state-val-code" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                    <label for="exampleInputFile">Upload Logo Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo-img" name="logoimage" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <span id="logo-image-validation" class="text-danger"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputFile">Upload Signature Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="sign-image" name="signimg" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <span id="validation_cat_edit" class="text-danger font-weight-bold"></span>
                
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                <input type="submit"  class="btn btn-primary btn-lg" id="add-firm-sub" value="Add">               
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
                
              </form>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Add Model Close------------------------------------------------>
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-remove-firm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REMOVE PRODUCT CATEGORY</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                <form id="remove-firm-form">
                <div class="card-body">
                  <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="" name="firmremoveid" autocomplete="off" id="f-id-remove">
                  <input type="hidden" class="form-control" id="logo-image-remove" name="removelogoimgold" >
                  <input type="hidden" class="form-control" id="sign-image-remove" name="removesignimgold" >
                  

                   <h3>Are you sure, You want to delete this Firm Record ?</h3>
                    
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                <input type="submit" class="btn btn-danger" id="remove-role-sub" value="Remove">               
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
                                  "<td>" + value.id +"</td>" +
                                   "<td>" + value.name +"</td>"+ 
                                  "<td><a href='#' class='View-firm' data-firmviewid='"+ value.id +"'><i class='fas fa-eye'></i></a>  &nbsp; &nbsp; <a href='#' class='edit-firm' data-firmviewid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-firm'  data-firmviewid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table-firm").html(html);  
        }
    });
}
loadTableFirm();
// //Fetch All Records Close
//Fetch Single Record : Show Model
//view model open
$(document).on("click",".View-firm",function(){
    $('#modal-view-firm').modal('show');
    var firm_id = $(this).data("firmviewid");
    var obj = {firmviewid : firm_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_firm.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        $("#f-name-v").val(data[0].name);
        $("#f-gst-v").val(data[0].gstin);
        $("#f-add-v").val(data[0].address);
        $("#f-fssai-v").val(data[0].fssai);
        $("#f-mobile-v").val(data[0].mobile);
        $("#v-email").val(data[0].email);
        $("#f-bankname-v").val(data[0].bank_name);
        $("#f-acc-no-v").val(data[0].account_number);
        $("#f-ifsc-v").val(data[0].ifsc);
        $("#f-bank-add-v").val(data[0].bank_address);
        $("#f-state-v").val(data[0].state);
        $("#f-state-code-v").val(data[0].state_code);
        $("#logo-img-view").val(data[0].logo);
        $("#signture-img-view").val(data[0].signature_image);
        var logoimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].logo;
        $('#logo-img-view').attr("src",logoimg);
        var signimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].signature_image;
        $('#signture-img-view').attr("src",signimg);      
       }
    });
  });
  //view model close
  //    //Fetch Single Record : Show Model
//   //Update Firm 
$(document).on("click",".edit-firm",function(){
    $('#modal-edit-firm').modal('show');
    var firm_id = $(this).data("firmviewid");
    var obj = {firmviewid : firm_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_firm.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        $("#f-id-edit").val(data[0].id);
        $("#f-name-edit").val(data[0].name);
        $("#f-gst-edit").val(data[0].gstin);
        $("#f-add-edit").val(data[0].address);
        $("#f-fssai-edit").val(data[0].fssai);
        $("#f-mobile-edit").val(data[0].mobile);
        $("#v-email-edit").val(data[0].email);
        $("#f-bankname-edit").val(data[0].bank_name);
        $("#f-acc-no-edit").val(data[0].account_number);
        $("#f-ifsc-edit").val(data[0].ifsc);
        $("#f-bank-add-edit").val(data[0].bank_address);
        $("#f-state-edit").val(data[0].state);
        $("#f-state-code-edit").val(data[0].state_code);
        $("#logo-image-h").val(data[0].logo);
        $("#sign-image-h").val(data[0].signature_image);
        var logoimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].logo;
        $('#logo-img-view-edit').attr("src",logoimg);
        var signimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].signature_image;
        $('#signture-img-view-edit').attr("src",signimg);      
       }
    });
    $('#edit-firm-form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/update/update_firm.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                if(response.status == 1){
                   //$('#edit-category-form')[0].reset();
                    $('#modal-edit-firm').modal('hide');
                    loadTableFirm();
                   
                }else{
                  var error = response.message;
                  $("#validation_cat_edit").html(error);
                }
                
            }
            })
        });
   

//Update Category Close
  });

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
