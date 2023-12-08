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
            <h3 class="m-0">Add Firm</h3>
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
      <div class="card-body">
                <form id="add-firm-form">
                <div class="row">
                  <div class="col-4 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Firm Name" name="firmname" autocomplete="off" id="f-name" required>
                    <span id="name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="gstin" autocomplete="off" id="f-gst" required>
                    <span id="G-val" class="text-danger font-weight-bold"></span>
                  </div>
                 
                  <div class="col-4 form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Enter Address"name="address" autocomplete="off" id="f-add" required>
                    <span id="add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>FSSAI</label>
                    <input type="text" class="form-control" placeholder="Enter FSSAI " name="fssai" autocomplete="off" id="f-fssai" required>
                    <span id="fssai-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile" autocomplete="off" id="f-mobile" required>
                    <span id="mo-val-al" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off">
                  </div>
                  <div class="col-4 form-group">
                  <label>Bank Name</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="bankname" autocomplete="off" id="f-bankname" required>
                    <span id="bank-name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Account Number</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" name="accountnumber" autocomplete="off" id="f-acc-no" required>
                    <span id="acc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>IFSC</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifsc" autocomplete="off" id="f-ifsc" required>
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-12 form-group">
                  <label>Bank Address</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Address " name="bankaddress" autocomplete="off" id="f-bank-add" required>
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State</label>
                    <input type="text" class="form-control" placeholder="Enter State" name="state" autocomplete="off" id="f-state" required>
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State Code</label>
                    <input type="text" class="form-control" placeholder="Enter State Code" name="statecode" autocomplete="off" id="f-state-code" required>
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
                
                
                <input type="submit"  class="btn btn-primary btn-lg float-right " id="add-firm-sub" value="Add">               
               
              </form>
              </div>
               <!-- /.card-body -->
              </div>
   <!-- /.content -->
      </div>
      </section>
      </div>
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
$(document).ready(function(){
   
       // validation();
        $('#add-firm-form').on('submit',function(e){
          toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/add/admin/add_firm.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response.status == 1){
                    $('#add-firm-form')[0].reset();
                    toastr.success('Firm Added Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                    //window.location.replace("./manage_firm.php");
                    loadTableFirm();
                   
                }
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        });
        $('#logo-img').on('change',function(){
          //get the file name
                var fileNamelogo = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileNamelogo);
            });
            $('#sign-image').on('change',function(){
          //get the file name
                var fileNamesing = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileNamesing);
            });
    });

    
</script>
</body>
</html>
