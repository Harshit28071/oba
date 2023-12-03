<?php
session_start();

//echo  $user_id;
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4") {
  header("location:../../common/user_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php"); ?>

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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
       
      </div>
       <!-- Main content -->
    <div class="container">
    <div class="card card-primary">
      <div class="card-body">
      <div id="loader-edit-customer" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="edit-customer-form" method="POST">
                <input type="hidden" class="form-control" placeholder="Customer id" name="Custid" autocomplete="off" id="Cust-id-edit" required>
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Customer Name" name="CustName" autocomplete="off" id="Cust-name" required>
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Mobile</label>
                    <input type="number" class="form-control" placeholder="Customer Mobile" name="CustMobile" autocomplete="off" id="Cust-Mobile">
                  </div>
                  <div class="col-md-6 form-group">
                        <label>Select State</label>
                        <select class="form-control" name="custstate" id="state"> </select>
                  </div>
                  <div class="col-md-6 form-group">        
                    <label>Select City</label>
                        <select class="form-control" name="custcity" id="city" > 
                        </select>
                  </div>
                  <div class="col-md-6">
                  
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="5" placeholder="Enter ..." id="cust-add" name="custAddress"></textarea>
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
                    <label>Select Firm</label>
                    <input type="text" class="form-control" placeholder="Enter Firm" name="FirmName" autocomplete="off" id="Firm" />
                  </div>
                  <div class="col-md-6 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="custgstin" autocomplete="off" id="c-gstin">
                  </div>

                </div>
                <input type="submit"  class="btn btn-primary btn-lg float-right" id="edit-customer" value="Edit"> 
              </form>
              </div>
        
        
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-header -->
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
  <!--  -->
  <?php require_once("./layout/footer_links.php"); ?>
  <script src="../js/salesman js/customer_profile.js"></script>
  <script src="../js/salesman js/edit_customer_details.js"></script>
  <script>
   
    // $('.custom-button').append('<li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="editCustomerDetails(' + id +')"><i class="fa fa-edit"></i></a></li>');
      $("#heading").text("Edit Customer Details");
  </script>
</body>

</html>