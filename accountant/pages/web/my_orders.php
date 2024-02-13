<?php
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
  header("location:/new/oba/common/user_login.php");
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/database.php"); ?>
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
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Harihar</span>
      </a>

      <!-- Sidebar -->
      <?php require_once("./layout/sidebar.php"); ?>
      <!-- /.sidebar -->
    </aside>
    <section class="content">
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">My Orders</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->

        </div>
        <!-- /.content-header -->

        <div class="container-fluid">
          <div class="card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="my-orders-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="new-order-tab" data-toggle="pill" href="#new" role="tab" aria-controls="new" aria-selected="true" onclick="Orders('New')">New</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pending-order-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="pending" aria-selected="false" onclick="Orders('Pending')">Pending</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="completed-order-tab" data-toggle="pill" href="#completed" role="tab" aria-controls="completed" aria-selected="false" onclick="Orders('Completed')">Completed</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="cancel-order-tab" data-toggle="pill" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false" onclick="Orders('Cancel')">Cancel</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="my-orders-tabContent">
                <div class="tab-pane fade active show" id="new" role="tabpanel" aria-labelledby="new-order-tab">
                  <table class="table table-striped table-bordered" id="new-table">
                    <thead>
                      <tr>
                        <th >S.No.</th>
                        <th >Date</th>
                        <th >Party Name</th>
                        <th >City</th>
                        <th >Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="load-New-orders">

                    </tbody>
                  </table>

                 
                </div>
                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-order-tab">
                  <table class="table table-striped table-bordered" id="pending-table">
                    <thead>
                      <tr>
                         <th>S.No.</th>
                        <th>Date</th>
                        <th>Party Name</th>
                        <th>City</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="load-Pending-orders">

                    </tbody>
                  </table>

                  
                </div>
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-order-tab">
                  <table class="table table-striped table-bordered" id="completed-table">
                    <thead>
                      <tr>
                         <th>S.No.</th>
                        <th>Date</th>
                        <th>Party Name</th>
                        <th>City</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="load-Completed-orders">

                    </tbody>
                  </table>

                  
                </div>
                <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-order-tab">
                  <table class="table table-striped table-bordered" id="cancel-table">
                    <thead>
                      <tr>
                       <th>S.No.</th>
                        <th>Date</th>
                        <th>Party Name</th>
                        <th>City</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="load-Cancel-orders">

                    </tbody>
                  </table>

                  
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <?php require_once("./layout/footer.php"); ?>
  <!----------------------------------------- Multiple Image Colse Modal-------------------------------------------------------------------------------->
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/pages/alert_messages.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <?php require_once("./layout/footer_links.php"); ?>

  <script src="/new/oba/accountant/js/my_orders.js"> </script>

</body>

</html>