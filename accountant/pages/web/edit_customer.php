<?php
session_start();
if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
  header("location:/new/oba/common/user_login.php");
  }
 require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/database.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/pages/fetch_master_data.php");


 $options = loadState();
 $options_city = loadCity();
 ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php");?>
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
          <div class="col-6">
            <h3 class="m-0">Edit Customer</h3>
          </div><!-- /.col -->
        <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
      <div class="card-body">
      <div id="loader-edit-customer" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="edit-customer-form">
                <input type="hidden" class="form-control" placeholder="Customer id" name="Custid" autocomplete="off" id="Cust-id-v" required>
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" readonly placeholder="Customer Name" name="CustName" autocomplete="off" id="Cust-name" required>
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Mobile</label>
                    <input type="number" class="form-control" placeholder="Customer Mobile" name="CustMobile" autocomplete="off" id="Cust-Mobile">
                  </div>
                  <div class="col-md-6 form-group">
                   <div class="col-md-12 form-group">
                        <label>Select State</label>
                        <select class="form-control" name="custstate">
                          <?php 
                          echo $options;
                          ?>
                        </select>
                      </div> 
                      
                      <div class="col-md-12 form-group">
                                       <!-- <input type="text" class="form-control" placeholder="Enter City" name="custcity" autocomplete="off" id="cust-city"> -->
                    <label>Select City</label>
                        <select class="form-control" name="custcity" id="cust-city" required>
                          <?php 
                          echo $options_city;                        
                          ?>
                        </select>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="col-md-12 ">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="5" placeholder="Enter ..." id="cust-add" name="custAddress"></textarea>
                      </div>
                    </div>
                  </div>
                   
                      <div class="col-md-6 form-group">
                        <label>Type</label>
                        <select class="form-control" name="custType" id="disop">
                          <option value="Retailer" selected>Retailer</option>
                          <option value="Distributor">Distributor</option>
                          <option value="Wholesaler">Wholesaler</option>
                          <option value="Oth">Other</option>
                        </select>
                      </div>
                      <div class="col-md-6 form-group">
                    <label>Distributor (Goods Source)</label>
                    
                    <select class="form-control" name="disName" id="dis-select-box" required>
                    <option selected style="text-align: center;">Select Distributor </option>
                        </select>
                    
                  </div>
                
                  <div class="col-md-6 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="custgstin" autocomplete="off" id="c-gstin">
                  </div>

                </div>
                <input type="submit"  class="btn btn-primary btn-md float-right" id="edit-customer" value="Update"> 
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
<script src="/new/oba/accountant/js/edit_customer.js"></script>
</body>
</html>
