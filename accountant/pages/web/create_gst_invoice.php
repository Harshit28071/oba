<?php
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
  header("location:/new/oba/common/user_login.php");
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/pages/fetch_master_data.php");

$options_city = loadCity();
$firms = loadFirms();


?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed ">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px">
      <!-- Left navbar links -->
      <ul class="navbar-nav" style="margin-left:10px">
        <li class="nav-item">
          <h4 class="m-0">Create GST Invoice</h4>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a href="./add_customer.php" id="add-cust"><button type="button" class="btn btn-primary btn-sm">Add New Customer</button></a>
        </li>
        <li class="nav-item">
          <a onclick="cancelInvoice()" id="add-cust"><button type="button" style="margin-left:10px;" class="btn btn-danger btn-sm">Cancel</button></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->




    <!-- Content Wrapper. Contains page content -->
    <div class="content" style="margin-left:0px">
      <section class="container" style="padding-top:20px">
        <div class="row">
          <div class="col-8">
            <form role="form">
              <div class="form-group">
                <select class="form-control-sm" id="show-firm">
                  <?php echo  $firms ?>
                </select>
                <select class="form-control-sm" id="city-value">

                  <?php echo  $options_city ?>
                </select>
                <select class="form-control-sm" id="show-customer">
                  <option selected style="text-align: center;" value="">SELECT CUSTOMER </option>
                </select>

              </div>
            </form>
          </div>
          <div class="col-4" style="text-align: end;">
            <a onclick="saveInvoice()"><button type="button" id="save-invoice" class="btn btn-danger btn-sm">Save Invoice</button></a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6" id="customerData"></div>
          <div class="col-md-6">
            <p style="text-align: end"><b>Invoice No.: </b><span id="prefix"></span><input type="number" id="suffix" style="max-width:70px;" /></p>
            <p style="text-align: end"><b>Date: </b><input type="date" id="invoiceDate" value="<?php echo date("Y-m-d"); ?>" style="max-width:150px;" /></p>  
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Item</th>
                  <th>HSN</th>
                  <th>Qty</th>
                  <th>Unit</th>
                  <th>Rate</th>
                  <th>Tax Rate(%)</th>
                  <th>Tax Amount(Rs.)</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody id="invoiceItems">

              </tbody>
            </table>


          </div>
        </div>



      </section>
    </div>


  </div>
  <!-- ./wrapper -->
  <div class="modal fade" id="modal-add-item">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="additemForm">
          <div class="modal-header">
            <h5 class="modal-title">Select Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Select Category</label>
              <select class="custom-select" id="mainCategory"></select>
            </div>
            <div id="sub-category"></div>
            <div class="form-group">
              <label for="exampleInputEmail1">Select Item</label>
              <select class="custom-select" id="items"></select>
            </div>
            <div id="units"></div>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" onclick="addNewItem()" id="edit-unit-save">ADD</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/pages/alert_messages.php"); ?>
  <!-- jQuery -->
  <?php require_once("./layout/footer_links.php"); ?>
  <script>
    if (localStorage.getItem('generate_invoice') == 'true') {
      $("#city-value").prop("disabled", true);
      $("#show-customer").prop("disabled", true);
      $("#show-firm").prop("disabled", true);
    }
  </script>
  <script src="/new/oba/accountant/js/common.js"></script>
  <script src="/new/oba/accountant/js/create_web_gst_invoice.js"></script>

</body>

</html>