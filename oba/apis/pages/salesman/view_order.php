<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4"){
    header("location:./user_login.php");
    }
 ?>
<!DOCTYPE html>
<html lang="en"> <?php require_once("./layout/header.php");?> <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div>
      <!-- Navbar --> <?php 
  require_once("./layout/navbar.php") ?>
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <br>
        <!-- /.content-header -->
        <section class="content">
          <div class="container-fluid">
            <div id="customerDetails"></div>
            <div id="tab-view"></div>
            
            <button type="button" onclick="editOrder()" class="btn btn-block btn-info">
              <i class="fa fa-pencil"></i> Edit Order </button>
            <br>
          </div>
        </section>
      </div> <?php require_once("./layout/footer.php"); ?>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <!---- MODALs--->
  
    <!-----> <?php require_once("./layout/footer_links.php");?> <script>
      $("#heading").text("Order Details");
      
      function showAddModal() {
        $('#modal-add-item').modal('show');
      }
    </script>
    <script src="../js/salesman js/view_order.js"></script>
  </body>
</html>