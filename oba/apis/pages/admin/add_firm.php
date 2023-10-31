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
              <li class="breadcrumb-item active"><a href="./manage_firm.php" id="back-firm" class="btn btn-primary">Back</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Firm</h3>
              </div>
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
   <!-- /.content -->
      </div>
      </div>
   </section>
  </div>
  
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
//Fetch Single Record : Show Model
//view model open
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
                    window.location.replace("http://localhost/oba/oba/oba/apis/pages/admin/manage_firm.php");
                    loadTableFirm();
                   
                }else{
                  var error = response.message;
                  $("#validation_cat_edit").html(error);
                }
                
            }
            })
        });
    });

    
</script>
</body>
</html>
