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
    <div class="container" id="load-single-customer">
        <div id="singleCustomerDetails"> </div>
        <div class="content-header">
        <div class="form-group">
          <div class="input-group-append">
            <button class="btn btn-lg btn-default" onclick="filterModal()">
              <i class="fa fa-filter"></i>
            </button>
          </div>
          <div class="modal fade" id="modal-status-select-box">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title">Select Status</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <select id="select-order-s" class="form-control">
                   <option>Select Order Status</option>
                   <option>New</option>
                   <option>Pending</option>
                   <option>Completed</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div id="customerOrder"></div>

        
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
  <script>
    //  $('.custom-button').append('<li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="sortData()">          <i class="fa fa-sort" aria-hidden="true"></i>        </a>      </li>');
      $("#heading").text("Customer Details");
  </script>
</body>

</html>