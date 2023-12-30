<?php
session_start();
 require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/database.php");
 $db = new Database();
 $conn = $db->connect();

 //echo  $user_id;
  if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Salesman"){
   header("location:/new/oba/common/user_login.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./../common/mobile_layout/header.php");?>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-warning" onclick="orders('New')">
              <div class="inner">
                <h3 id="new-count"></h3>
                <h5>New Orders</h5>
              </div>
              <div class="icon">
                <i class="fas fa-cart-plus"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-info" onclick="orders('Pending')">
              <div class="inner">
                <h3 id="pending-count"></h3>
                <h5>Pending Orders</h5>
              </div>
              <div class="icon">
                <i class="fas fa-cart-plus"></i>
              </div>
              <a href="#" class="small-box-footer" id="pending-order">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-success" onclick="orders('Completed')">
              <div class="inner">
                <h3 id="approved-count"><sup style="font-size: 20px"></sup></h3>
                <h5>Completed Orders</h5>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-danger" onclick="orders('Cancel')">
              <div class="inner">
                <h3 id="cancel-count"><sup style="font-size: 20px"></sup></h3>
                <h5>Cancelled Orders</h5>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
         
         
        </div>

        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php require_once("./../common/mobile_layout/footer.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php require_once("./../common/mobile_layout/footer_links.php");?>
<script src="/new/oba/js/salesman/my_order_count.js"></script>
<script>
$("#heading").text("My Orders");

  </script>
</body>
</html>
