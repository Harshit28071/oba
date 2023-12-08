<?php
session_start();

//echo  $user_id;
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4") {
  header("location:../../common/user_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./../common/mobile_layout/header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php
    require_once("./../common/mobile_layout/navbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="form-group">
          <form id="search-customer-by-name">
            <div class="input-group input-group-lg">
              <input type="search" class="form-control form-control-lg" placeholder="Type Customer Name" id="customer-name">
              <div class="input-group-append">
                <button type="submit" class="btn btn-lg btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </div>
          </form>
          <div class="input-group-append">
            <button class="btn btn-lg btn-default" id="filter">
              <i class="fa fa-filter"></i>
            </button>
          </div>
       
        </div>
      </div> 
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container" id="load-customer">

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once("./../common/mobile_layout/footer.php"); ?>
  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
  <!-- ./wrapper -->
  <div class="modal fade" id="modal-city-select-box">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title">Select City</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <select id="select-city" class="form-control">

                  </select>
                </div>
              </div>
            </div>
          </div>
  <!-- jQuery -->
  <?php require_once("./../common/mobile_layout/alert_messages.php"); ?>
  <?php require_once("./../common/mobile_layout/footer_links.php"); ?>
  <script src="../../js/salesman/common.js"></script>
  <script src="../../js/salesman/all_customers.js"></script>
  <script>
      $("#filter").on("click", function(event) {
        event.preventDefault();
        //debugger;
        $("#modal-city-select-box").modal("show");
      });   
      $('.custom-button').append('<li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="sortData()">          <i class="fa fa-sort" aria-hidden="true"></i>        </a>      </li>');
   
  </script>
</body>

</html>