<?php
session_start();
if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
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
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/pages/manage_product_content.php"); ?>
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
<script src="/new/oba/common/js/manage_product.js"></script>
   
</body>
</html>
