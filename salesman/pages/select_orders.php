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
        <div class="form-group">
          <form id="search-customer-by-name">
            <div class="input-group input-group-lg">
              <input type="search" class="form-control form-control-lg" placeholder="Type Customer Name" id="customer-name">
              <div class="input-group-append">
                <button type="submit" class="btn btn btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </div>
          </form>
          <div class="input-group-append">
            <button class="btn btn btn-default" id="filter">
              <i class="fa fa-filter"></i>
            </button>
          </div>
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
        </div>
      </div>
      <div class="container" id="load-orders">

    </div>
    <div class="container">
    <button type="button" onclick="createOrder()" class="btn btn-block btn-danger btn-sm">Create Order</button>
    </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
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
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/pages/alert_messages.php"); ?>
  <?php require_once("./layout/footer_links.php"); ?>
  <script src="/new/oba/salesman/js/common.js"></script>
  <script src="/new/oba/salesman/js/select_order.js"></script>
  
  <script>
      $("#filter").on("click", function(event) {
        event.preventDefault();
        //debugger;
        $("#modal-city-select-box").modal("show");
      });   
    $("#heading").text("Select Orders");
    $('.custom-button').append('<li class="nav-item">'+
    '<button type="button" onclick="createOrder()" class="btn btn-block btn-danger btn-sm">Create Order</button>'+
    '</li>');
  </script>
</body>

</html>