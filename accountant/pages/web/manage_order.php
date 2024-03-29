<?php
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
  header("location:/new/oba/common/user_login.php");
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/database.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php"); ?>
<style>
  .margin-5{
    margin-top:5%;
  }
  .margin-right{
    margin-right: 5px;
  }
</style>
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
                <h1 class="m-0">All Orders</h1>
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
              <ul class="nav nav-tabs" id="order-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="pill" href="#Pending-tab" role="tab" aria-controls="Pending-tab" aria-selected="true" onclick="Orders('Pending')">Pending
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#Completed-tab" role="tab" aria-controls="Completed-tab" aria-selected="false" onclick="Orders('Completed')">Completed</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  data-toggle="pill" href="#Cancel-tab" role="tab" aria-controls="Cancel-tab" aria-selected="false" onclick="Orders('Cancel')">Cancelled</a>
                </li>
 
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="order-tabsContent">
                <div class="tab-pane fade active show" id="Pending-tab" role="tabpanel" aria-labelledby="Pending-tab-tab">
                  <table class="table table-striped table-bordered" id="Pending">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Party Name</th>
                        <th>Amount</th>
                        <th>Created By</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="load-Pending-orders">

                    </tbody>
                  </table>

                 
                </div>
                <div class="tab-pane fade" id="Completed-tab" role="tabpanel" aria-labelledby="Completed-tab-tab">
                  <table class="table table-striped table-bordered" id="Completed">
                    <thead>
                      <tr>
                      <th>ID</th>
                        <th>Date</th>
                        <th>Party Name</th>
                        <th>Amount</th>
                        <th>Created By</th>
                        <th>Invoice / Action</th>
                      
                      </tr>
                    </thead>
                    <tbody id="load-Completed-orders">

                    </tbody>
                  </table>

                  
                </div>
                <div class="tab-pane fade" id="Cancel-tab" role="tabpanel" aria-labelledby="Cancel-tab-tab">
                  <table class="table table-striped table-bordered" id="Cancel">
                    <thead>
                      <tr>
                      <th>ID</th>
                        <th>Date</th>
                        <th>Party Name</th>
                        <th>Amount</th>
                        <th>Created By</th>
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
 
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <?php require_once("./layout/footer_links.php"); ?>

  <script src="/new/oba/accountant/js/manage_web_order.js"> </script>
<script>

  </script>
</body>

</html>