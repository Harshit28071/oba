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
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container" id="load-single-customer">

    <div id="singleCustomerDetails"> </div>

    <div id="customerOrder"></div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once("./layout/footer.php"); ?>
  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
  <!-- ./wrapper -->
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
                   <option class="text-center">All</option>
                   <option>New</option>
                   <option>Pending</option>
                   <option>Completed</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
  <!-- jQuery -->
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/pages/alert_messages.php"); ?>
  <?php require_once("./layout/footer_links.php"); ?>
  <script src="/new/oba/salesman/js/customer_profile.js"></script>
  <script>
     $('.custom-button').append('<li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="filterModal()">          <i class="fa fa-filter"></i>        </a>      </li>');
      $("#heading").text("Customer Details");
  </script>
</body>

</html>