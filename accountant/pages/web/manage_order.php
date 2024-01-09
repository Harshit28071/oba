<?php
session_start();
if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant"){
  header("location:/new/oba/common/user_login.php");
  }
 require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/database.php");?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php");?>
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
    <?php require_once("./layout/sidebar.php");?>
    <!-- /.sidebar -->
  </aside>
  <section class="content">
  <div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0">Manage Orders</h1>
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
<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" onclick="Orders('Pending')">Pending
</a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="Orders('Completed')">Completed</a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false" onclick="Orders('Cancel')">Cancel</a>
</li>

</ul>
</div>
<div class="card-body">
<div class="tab-content" id="custom-tabs-one-tabContent">
<div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
<table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Order Date</th>
                      <th>Party Name</th>
                      <th>Order Ammount</th>
                      <th>Order Create By</th>
                    </tr>
                  </thead>
                  <tbody id="load-Pending-orders">

                  </tbody>
                </table>

                <button id="btn-load-more-Pending" class="btn btn-primary" onclick="loadMoreOrders('Pending','Pending')">Load More</button>
</div>
<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
<table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Order Date</th>
                      <th>Party Name</th>
                      <th>Order Ammount</th>
                      <th>Order Create By</th>
                    </tr>
                  </thead>
                  <tbody id="load-Completed-orders">

                  </tbody>
                </table>

                <button id="btn-load-more-Completed" class="btn btn-primary" onclick="loadMoreOrders('Completed','Completed')">Load More</button>
</div>
<div class="tab-pane fade active show" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
<table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Order Date</th>
                      <th>Party Name</th>
                      <th>Order Ammount</th>
                      <th>Order Create By</th>
                    </tr>
                  </thead>
                  <tbody id="load-Cancel-orders">

                  </tbody>
                </table>

                <button id="btn-load-more-Cancel" class="btn btn-primary" onclick="loadMoreOrders('Cancel','Cancel')">Load More</button>
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
<?php require_once("./layout/footer_links.php");?>

<script src="/new/oba/accountant/js/manage_web_order.js"> </script>
   
</body>
</html>
