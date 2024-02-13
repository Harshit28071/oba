<?php
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
  header("location:/new/oba/common/user_login.php");
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/pages/fetch_master_data.php");

$options_city = loadCity();
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php"); ?>
<style>label { display:block }</style>
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
                <h1 class="m-0" id="heading">All Invoices</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col-md-3">
              <label for="city">City</label>
                <select class="form-control-sm" id="city">

                  <?php echo  $options_city ?>
                </select>
              </div>
              <div class="col-md-6">
              <label for="customer">Customer</label>
                <select class="form-control-sm" id="customer">
                  <option selected style="text-align: center;" value="">SELECT CUSTOMER </option>
                </select>
              </div>
              <div class="col-md-3">
              <label for="status">Status</label>
                <select class="form-control-sm" id="status">
                  <option selected style="text-align: center;" value="All">SELECT Status </option>
                  <option value="UnPaid">UnPaid</option>
                  <option value="Cancelled">Cancelled</option>
                  <option value="Paid">Paid</option>
                  <option value="Partial">Partial</option>
                </select>
              </div>
            </div>
          </div><!-- /.container-fluid -->

        </div>
        <!-- /.content-header -->

        <div class="container-fluid">
          <table class="table table-striped table-bordered" id="invoices">
            <thead>
              <tr>
                <th>Invoice</th>
                <th>Date</th>
                <th>Party Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <?php require_once("./layout/footer.php"); ?>
  <!----------------------------------------- Multiple Image Colse Modal-------------------------------------------------------------------------------->
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/pages/alert_messages.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <?php require_once("./layout/footer_links.php"); ?>

  <script src="/new/oba/accountant/js/all_invoices.js"> </script>

</body>

</html>