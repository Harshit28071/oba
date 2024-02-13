<?php
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
  header("location:/new/oba/common/user_login.php");
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/new/oba/common/pages/fetch_master_data.php");

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
          <h4 class="m-0">View Order</h4>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        
        <li class="nav-item">
          <a onclick="history.back()" id="add-cust"><button type="button" style="margin-left:10px;" class="btn btn-danger btn-sm">Back</button></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->




    <!-- Content Wrapper. Contains page content -->
    <div class="content" style="margin-left:0px">
      <section class="container" style="padding-top:20px">
        <div class="row">
          <div class="col-6" id="customerDetails">
            
          </div>
          <div class="col-6" style="text-align: end;">
          <a href="./edit_order.php" id="editOrder"><button type="button" id="save-order" class="btn btn-danger btn-sm">Edit Order</button></a>
          <button type="button" id="generateInvoice" style="display: none"; onclick="generateInvoice()" class="btn btn-success btn-sm">Generate Invoice</button>
            <button type="button" id="cancelOrder" style="display: none"; onclick="cancelOrder()" class="btn btn-danger btn-sm">Cancel Order</button>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                <th style="width: 10px">#</th>
                  <th>Item</th>
                  <th>Qty</th>
                  <th>Unit</th>
                  <th>Rate</th>
                  <th>Discount(&#x20B9;)</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody id="orderItems">
               
              </tbody>
            </table>

            
          </div>
        </div>



      </section>
    </div>


  </div>
  <!-- ./wrapper -->
  
  <?php require_once("./layout/footer_links.php"); ?>
<script>
 function cancelOrder() {

let text = "Are you sure you want to cancel the order?";
if (confirm(text) == true) {
  $.ajax({
    url: "/new/oba/accountant/apis/update/cancel_order.php",
    type: 'POST',
    data: {
      id: localStorage.getItem('order_id')
    },
    dataType: "json",
    success: function(result) {
      if (result > 0) {
        alert('Order Cancelled');
      }
      window.history.back();

    }

  });
}


}

function generateInvoice() {

$.ajax({
  url: "/new/oba/accountant/apis/select/get_selected_products_for_invoice.php",
  type: "POST",
  data: {
    orderId: localStorage.getItem('order_id'),
    customerId: localStorage.getItem('customer_id')
  },
  dataType: "json",
  success: function(data) {
    if (data.length > 0) {
      selectedProducts = data;
      localStorage.setItem('selectedProducts', JSON.stringify(data));
      window.location.replace('./create_invoice.php');
      
    } else {
      alert('You can not generate invoice for this order.');
      history.back();
    }
  }
});
}
debugger;
if(localStorage.getItem('generate_invoice') == 'true'){
  $("#editOrder").css('display',"none");
  $("#generateInvoice").css('display',"inline");
  $("#cancelOrder").css('display',"inline");
}

if(localStorage.getItem('can_edit') == 'false'){
  $("#editOrder").css('display',"none");
}

  /*$("#editOrder").css('display',"inline");
  $("#generateInvoice").css('display',"none");
  $("#cancelOrder").css('display',"none");
  generateInvoice = undefined;
  cancelOrder = undefined;
*/


</script>
  <script src="/new/oba/accountant/js/view_web_order.js"></script>
<script>


</script>
</body>

</html>