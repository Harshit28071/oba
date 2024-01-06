<?php
session_start();

//echo  $user_id;
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Salesman") {
  header("location:/new/oba/common/user_login.php");
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
                <input type="hidden" class="form-control" placeholder="" name="salesmanidtid" autocomplete="off" id="Cust-id-edit" required>
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" name="SalesmanName" autocomplete="off" id="salesman-name" required>
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Mobile</label>
                    <input type="number" class="form-control" placeholder="salesman Mobile" name="SalesmanMobile" autocomplete="off" id="salesman-Mobile">
                  </div>
                  <div class="col-md-6 form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="salesman Mobile" name="SalesmanEmail" autocomplete="off" id="salesman-email">
                  </div>
                </div>
                <input type="submit"  class="btn btn-primary btn-lg float-right" id="edit-salesman" value="Edit"> 
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
  <!-- <script src="/new/oba/salesman/js/customer_profile.js"></script> -->
  <script src="/new/oba/salesman/js/edit_salesman_profile.js"></script>
  <script>
   
    // $('.custom-button').append('<li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="editCustomerDetails(' + id +')"><i class="fa fa-edit"></i></a></li>');
      $("#heading").text("Edit Profile");
  </script>
</body>

</html>